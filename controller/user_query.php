<?php

session_start();
include "../model/dbconnection.php";
date_default_timezone_set('Asia/Manila');


// USER DELETE WITHDRAWAL REQUEST
if (isset($_POST['delete_submit'])) {
    if (isset($_POST['ids']) && isset($_POST['part_names']) && isset($_POST['quantities']) && isset($_POST['exp_dates']) && isset($_POST['batch_numbers']) && isset($_POST['item_codes'])) {
        $ids = $_POST['ids'];
        $part_names = $_POST['part_names'];
        $quantities = $_POST['quantities'];
        $exp_dates = $_POST['exp_dates'];
        $username = $_SESSION['username'];
        $batch_numbers = $_POST['batch_numbers'];
        $item_codes = $_POST['item_codes'];
        $success = true;

        for ($i = 0; $i < count($ids); $i++) {
            $id = intval($ids[$i]);
            $quantity = intval($quantities[$i]);
            $current_part_name = $part_names[$i];
            $exp_date = $exp_dates[$i];
            $batch_number = $batch_numbers[$i];
            $item_code = $item_codes[$i];
            $dts = date('Y-m-d H:i:s');
            $mensahe = $username . " has canceled the withdrawal request for the " . $current_part_name . " with a quantity of " . $quantity . ".";

            $select = "SELECT approver FROM tbl_inventory WHERE part_name = '$current_part_name'";
            $select_query = mysqli_query($con, $select);
            $selectedApprover = mysqli_fetch_assoc($select_query);
            $approver = $selectedApprover['approver'];

            $delete_req = "DELETE FROM `tbl_requested` WHERE id = '$id'";
            if (mysqli_query($con, $delete_req)) {

                $update_admin_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) 
                VALUES ('$username', '$mensahe', 0, '$dts', '$approver', 'Inventory')";
                if (!mysqli_query($con, $update_admin_notif)) {
                    $success = false;
                    break;

                }
            }
        }

        echo json_encode(["success" => $success]);
    } else {
        echo json_encode(["success" => false, "error" => "Missing data"]);
    }
}

// USER UPDATE WITHDRAWAL REQUEST
if (isset($_POST['update_submit'])) {
    if (isset($_POST['ids']) && isset($_POST['part_names']) && isset($_POST['quantities']) && isset($_POST['exp_dates']) && isset($_POST['machines']) && isset($_POST['with_reasons']) && isset($_POST['batch_numbers']) && isset($_POST['item_codes'])) {
        $ids = $_POST['ids'];
        $part_names = $_POST['part_names'];
        $quantities = $_POST['quantities'];
        $exp_dates = $_POST['exp_dates'];
        $machines = $_POST['machines'];
        $with_reasons = $_POST['with_reasons'];
        $batch_numbers = $_POST['batch_numbers'];
        $item_codes = $_POST['item_codes'];
        $success = true;

        for ($i = 0; $i < count($ids); $i++) {
            $id = intval($ids[$i]);
            $quantity = intval($quantities[$i]);
            $part_name = $part_names[$i];
            $exp_date = $exp_dates[$i];
            $machine = $machines[$i];
            $batch_number = $batch_numbers[$i];
            $item_code = $item_codes[$i];
            $with_reason = $with_reasons[$i];

            $update_request = "UPDATE `tbl_requested` SET part_qty = '$quantity' , machine_no = '$machine' , with_reason = '$with_reason' WHERE id = '$id'";
            if (!mysqli_query($con, $update_request)) {
                echo json_encode(["success" => false, "error" => "Failed to update stock"]);
                exit;
            }

        }

        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Missing data"]);
    }
}


?>