<?php
include "../model/dbconnection.php";
date_default_timezone_set('Asia/Manila');
session_start();

if (isset($_POST['action']) && isset($_POST['ids']) && !empty($_POST['ids'])) {
    $ids = $_POST['ids'];
    $status = $_POST['action'] == 'approve' ? 'approved' : 'rejected';

    $dts = date('Y-m-d H:i:s');
    $req_by = $_POST['req_by'];

    if ($status === 'approved') {

        $qty = $_POST['qty'];
        $part_name = $_POST['part_name'];

        $ids_str = implode(',', $ids);
        $sql = "UPDATE tbl_requested SET status = 'approved' WHERE id IN ($ids_str)";
        if (mysqli_query($con, $sql)) {

            for ($i = 0; $i < count($ids); $i++) {
                $current_qty = $qty[$i];
                $current_part_name = $part_name[$i];
                $current_req_by = $req_by[$i];

                $mensahe = 'The Administrator has approved ' . $current_qty . ' of ' . $current_part_name . '. Click here for more details.';
                $for = "user";

                $sql_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who) 
                              VALUES ('$current_req_by', '$mensahe', 0, '$dts', '$for')";

                if (mysqli_query($con, $sql_notif)) {
                } else {
                    echo "Error inserting notification for $current_part_name";
                }
            }
            echo "Success";
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else if ($status === 'rejected') {

        $qty = $_POST['qty'];
        $part_name = $_POST['part_name'];

        $total_rejected_qty = array_sum($qty);
        echo "Total quantity rejected: " . $total_rejected_qty;

        for ($i = 0; $i < count($ids); $i++) {
            $current_qty = $qty[$i];
            $current_part_name = $part_name[$i];
            $current_req_by = $req_by[$i];

            $qty_update = "UPDATE tbl_inventory SET part_qty = part_qty + $current_qty WHERE part_name = '$current_part_name'";
            if (mysqli_query($con, $qty_update)) {

                $mensahe = 'The Administrator has rejected ' . $current_qty . ' of ' . $current_part_name . '. Click here for more details.';
                $for = "user";

                $sql_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who) 
                              VALUES ('$current_req_by', '$mensahe', 0, '$dts', '$for')";
                if (mysqli_query($con, $sql_notif)) {
                    $sql = "UPDATE tbl_requested SET status = 'rejected' WHERE id = {$ids[$i]}";
                    mysqli_query($con, $sql);
                } else {
                    echo "Error inserting notification for $current_part_name";
                }
            } else {
                echo "Error updating inventory for part: $current_part_name";
            }
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lot_id = $_POST['lot_id'];
    $return_qty = $_POST['return_qty'];
    $return_reason = $_POST['return_reason'];
    $dts = date('Y-m-d H:i:s');

    if ($return_qty <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid quantity.']);
        exit();
    }

    $sql = "UPDATE tbl_requested 
            SET status = 'returned', return_reason = '$return_reason', dts_return = '$dts', return_qty = '$return_qty'
            WHERE lot_id = '$lot_id' AND status = 'approved'";

    if (mysqli_query($con, $sql)) {
        echo json_encode(['status' => 'success', 'message' => 'Item successfully returned.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error updating item: ' . mysqli_error($con)]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}

?>