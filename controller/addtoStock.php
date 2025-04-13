<?php

include "../model/dbconnection.php";
session_start();
date_default_timezone_set('Asia/Manila');
$stockData = json_decode(file_get_contents("php://input"), true);

if (isset($_POST['stock_data'])) {
    $stockData = json_decode($_POST['stock_data'], true);

    $allSuccess = true;

    foreach ($stockData as $item) {
        $part_name = mysqli_real_escape_string($con, $item['part_name']);
        $part_desc = mysqli_real_escape_string($con, $item['part_desc']);
        $part_qty = mysqli_real_escape_string($con, $item['part_qty']);
        $batch_number = mysqli_real_escape_string($con, $item['batch_number']);
        $exp_date = mysqli_real_escape_string($con, $item['part_date']);
        $kitting_id = mysqli_real_escape_string($con, $item['kitting_id']);
        $lot_id = mysqli_real_escape_string($con, $item['lot_id']);
        $username = $_SESSION['username'];
        $today = date('Y-m-d');
        $dts = date('Y-m-d H:i:s');

        $sqlSelect = "SELECT part_qty FROM `tbl_stock` WHERE part_name = '$part_name' AND exp_date = '$exp_date' AND status = 'Active'";
        $sqlSelect_query = mysqli_query($con, $sqlSelect);

        if (!$sqlSelect_query) {
            echo json_encode(['error' => 'Error in SELECT query: ' . mysqli_error($con)]);
            exit;
        }

        if (mysqli_num_rows($sqlSelect_query) > 0) {
            $selectRow = mysqli_fetch_assoc($sqlSelect_query);
            $part_qty_old = $selectRow['part_qty'];
            $new_part_qty = $part_qty + $part_qty_old;

            $update_sql = "UPDATE `tbl_stock` 
                           SET part_qty = '$new_part_qty', updated_by = '$username', dts = '$dts'
                           WHERE part_name = '$part_name' AND exp_date = '$exp_date' AND status = 'Active' AND batch_number = '$batch_number'";

            if (!mysqli_query($con, $update_sql)) {
                echo json_encode(['error' => 'Error in UPDATE query: ' . mysqli_error($con)]);
                exit;
            }

            $sql_received = "INSERT INTO `tbl_history` (dts, part_desc, part_name, part_qty, exp_date, kitting_id, lot_id, updated_by, status, batch_number) 
                             VALUES ('$dts', '$part_desc', '$part_name', '$part_qty', '$exp_date', '$kitting_id', '$lot_id', '$username', 'Received' , '$batch_number')";

            if (!mysqli_query($con, $sql_received)) {
                echo json_encode(['error' => 'Error in INSERT history query: ' . mysqli_error($con)]);
                exit;
            }

            if ($exp_date <= $today) {
                $username = "System";
                $message = htmlspecialchars($part_name, ENT_QUOTES, 'UTF-8') . ' has expired. Total expired quantity: ' . $part_qty;
                $is_read = '0';
                $for_who = "admin";
                $destination = "Expired";
                $exp_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) 
                             VALUES ('$username','$message','$is_read','$dts','$for_who','$destination')";
                if (!mysqli_query($con, $exp_notif)) {
                    echo json_encode(['error' => 'Error in notification INSERT query: ' . mysqli_error($con)]);
                    exit;
                }
            }
        } else {
            $sql = "INSERT INTO `tbl_stock` (part_name, part_qty, exp_date, kitting_id, lot_id, dts, updated_by, status, batch_number) 
                    VALUES ('$part_name', '$part_qty', '$exp_date', '$kitting_id', '$lot_id', '$dts', '$username', 'Active','$batch_number')";

            if (!mysqli_query($con, $sql)) {
                echo json_encode(['error' => 'Error in INSERT stock query: ' . mysqli_error($con)]);
                exit;
            }

            $sql_received = "INSERT INTO `tbl_history` (dts, part_desc, part_name, part_qty, exp_date, kitting_id, lot_id, updated_by, status) 
                             VALUES ('$dts', '$part_desc', '$part_name', '$part_qty', '$exp_date', '$kitting_id', '$lot_id', '$username', 'Received')";

            if (!mysqli_query($con, $sql_received)) {
                echo json_encode(['error' => 'Error in INSERT history query: ' . mysqli_error($con)]);
                exit;
            }

            if ($exp_date <= $today) {
                $username = "System";
                $message = htmlspecialchars($part_name, ENT_QUOTES, 'UTF-8') . ' has expired. Total expired quantity: ' . $part_qty;
                $is_read = '0';
                $for_who = "admin";
                $destination = "Expired";
                $exp_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) 
                             VALUES ('$username','$message','$is_read','$dts','$for_who','$destination')";
                if (!mysqli_query($con, $exp_notif)) {
                    echo json_encode(['error' => 'Error in notification INSERT query: ' . mysqli_error($con)]);
                    exit;
                }
            }
        }
    }

    echo json_encode(['success' => true, 'message' => 'Stocks added successfully']);
} else {
    echo json_encode(['error' => 'No data received']);
}
?>