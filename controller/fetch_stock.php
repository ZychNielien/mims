<?php
include "../model/dbconnection.php";
session_start();
date_default_timezone_set('Asia/Manila');
header('Content-Type: application/json');

$part_name = $_POST['part_name'] ?? '';
$response = [];

if (!empty($part_name) && !isset($_POST['update_stocks'])) {
    $part_name = mysqli_real_escape_string($con, $part_name);
    $sql = "SELECT * FROM tbl_stock WHERE part_name = '$part_name' AND status = 'Active' ORDER BY exp_date ASC";
    $result = mysqli_query($con, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $response[] = $row;
        }
    }

    echo json_encode($response);
    exit;
}

if (isset($_POST['update_stocks'])) {
    if (isset($_POST['ids']) && isset($_POST['part_quantities'])) {
        $ids = $_POST['ids'];
        $part_names = $_POST['part_names'];
        $item_codes = $_POST['item_codes'];
        $part_quantities = $_POST['part_quantities'];
        $batch_numbers = $_POST['batch_numbers'];
        $lot_ids = $_POST['lot_ids'];

        $success = true;
        $account_username = $_SESSION['username'] ?? 'Unknown';
        $dts = date('Y-m-d H:i:s');

        for ($i = 0; $i < count($ids); $i++) {
            $id = intval($ids[$i]);
            $part_name = mysqli_real_escape_string($con, $part_names[$i]);
            $item_code = mysqli_real_escape_string($con, $item_codes[$i]);
            $part_quantity = intval($part_quantities[$i]);
            $batch_number = mysqli_real_escape_string($con, $batch_numbers[$i]);
            $lot_id = mysqli_real_escape_string($con, $lot_ids[$i]);

            $sql = "UPDATE tbl_stock SET part_qty = '$part_quantity' WHERE id = '$id'";

            if (!mysqli_query($con, $sql)) {
                $success = false;
                break;
            }
            if ($part_quantity === 0) {
                $delete_stocks = "DELETE FROM tbl_stock WHERE id ='$id'";
                if (!mysqli_query($con, $delete_stocks)) {
                    $success = false;
                    break;
                }
            }
        }

        if ($success) {
            $updated_materials = array_unique($part_names);
            $material_list = implode(', ', $updated_materials);
            $description = "$account_username has updated the stock of " . mysqli_real_escape_string($con, $material_list);

            $sql_log = "INSERT INTO tbl_log (username, action, description, dts)
                        VALUES ('$account_username', 'Edit Stock Details', '$description', '$dts')";
            mysqli_query($con, $sql_log);
        }

        echo json_encode(["success" => $success]);
        exit;
    } else {
        echo json_encode(["success" => false, "error" => "Missing data"]);
        exit;
    }
}


echo json_encode(["error" => "Invalid request"]);
?>