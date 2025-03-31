<?php

// Database Connection
include "../model/dbconnection.php";

// Manila Time Zone
date_default_timezone_set('Asia/Manila');

// Session Start
session_start();

// Admin Withdrawal Requests Approval 
if (isset($_POST['action']) && isset($_POST['ids']) && !empty($_POST['ids'])) {
    $ids = $_POST['ids'];
    $status = $_POST['action'] == 'approve' ? 'approved' : 'rejected';

    $dts = date('Y-m-d H:i:s');
    $req_by = $_POST['req_by'];
    $approved_by = $_SESSION['username'];

    // Check if the Action is Approve
    if ($status === 'approved') {

        $qty = $_POST['qty'];
        $part_name = $_POST['part_name'];

        $ids_str = implode(',', $ids);

        // Update the Request to Approve
        $sql = "UPDATE tbl_requested SET status = 'approved' , approved_by = '$approved_by' , dts_approve = '$dts' WHERE id IN ($ids_str)";
        if (mysqli_query($con, $sql)) {

            for ($i = 0; $i < count($ids); $i++) {
                $current_qty = $qty[$i];
                $current_part_name = $part_name[$i];
                $current_req_by = $req_by[$i];

                $mensahe = $approved_by . ' has approved ' . $current_qty . ' of ' . $current_part_name . '. Click here for more details.';
                $for = "user";

                // Insert Notification to the Requester
                $sql_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) 
                              VALUES ('$approved_by', '$mensahe', 0, '$dts', '$current_req_by','Approved')";

                if (mysqli_query($con, $sql_notif)) {
                } else {
                    echo "Error inserting notification for $current_part_name";
                }
            }
            echo "Success";
        } else {
            echo "Error: " . mysqli_error($con);
        }

        // Checking if the Action is Reject
    } else if ($status === 'rejected') {

        $qty = $_POST['qty'];
        $part_name = $_POST['part_name'];
        $req_by = $_POST['req_by'];
        $ids = $_POST['ids'];
        $exp_date = $_POST['exp_date'];

        if (empty($qty) || empty($part_name) || empty($req_by) || empty($ids) || empty($exp_date)) {
            $_SESSION['status'] = "Invalid data provided.";
            $_SESSION['status_code'] = "error";
            header("location: ../view/adminModule/adminApproval.php");
            exit();
        }

        $total_rejected_qty = array_sum($qty);
        echo "Total quantity rejected: " . $total_rejected_qty;

        for ($i = 0; $i < count($ids); $i++) {
            $current_qty = $qty[$i];
            $current_part_name = $part_name[$i];
            $current_req_by = $req_by[$i];
            $current_id = $ids[$i];
            $current_exp_date = $exp_date[$i];

            // Update the Stocks: Increase the part quantity by the rejected amount
            $qty_update = "UPDATE tbl_stock SET part_qty = part_qty + $current_qty WHERE part_name = '$current_part_name' AND exp_date = '$current_exp_date'";

            if (mysqli_query($con, $qty_update)) {

                $mensahe = $approved_by . ' has rejected ' . $current_qty . ' of ' . $current_part_name . '. Click here for more details.';
                $for = $current_req_by;

                // Insert notification for the user who requested the part
                $sql_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) 
                              VALUES ('$approved_by', '$mensahe', 0, '$dts', '$for' , 'Rejected')";

                if (mysqli_query($con, $sql_notif)) {

                    // Update the request status to Rejected
                    $sql = "UPDATE tbl_requested SET status = 'rejected', rejected_by = '$approved_by' , dts_rejected = '$dts' WHERE id = $current_id";
                    mysqli_query($con, $sql);
                } else {
                    echo "Error inserting notification for $current_part_name<br>";
                }
            } else {
                echo "Error updating inventory for part: $current_part_name<br>";
            }
        }

        $_SESSION['status'] = "Rejection processed successfully!";
        $_SESSION['status_code'] = "success";
        header("location: ../view/adminModule/adminWithdrawal.php");
        exit();
    }

}

// Admin Withdrawal Requests Return
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lot_id = $_POST['lot_id'];
    $return_qty = $_POST['return_qty'];
    $return_reason = $_POST['return_reason'];
    $dts = date('Y-m-d H:i:s');
    $req_by = $_POST['req_by'];
    $part_name = $_POST['part_name'];
    $mensahe = $req_by . ' is returning ' . $return_qty . ' of ' . $part_name . '. Click here for more details.';
    $for = "admin";

    if ($return_qty <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid quantity.']);
        exit();
    }

    // Update the status of the request to Returning
    $sql = "UPDATE tbl_requested 
            SET status = 'returning', return_reason = '$return_reason', dts_return = '$dts', return_qty = '$return_qty'
            WHERE id = '$lot_id' AND status = 'approved'";

    if (mysqli_query($con, $sql)) {

        // Insert Notification to the admin
        $sql_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at,for_who, destination) VALUES ('$req_by', '$mensahe',0,'$dts','$for', 'Scrap')";
        $sql_notif_query = mysqli_query($con, $sql_notif);

        if ($sql_notif_query) {
            echo json_encode(['status' => 'success', 'message' => 'You are now authorized to return the ' . $part_name . ' with a quantity of ' . $return_qty]);
        }

    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error updating item: ' . mysqli_error($con)]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}


?>