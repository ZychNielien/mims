<?php

// Database Connection
include "../model/dbconnection.php";

// Manila Time Zone
date_default_timezone_set('Asia/Manila');

// Session Start
session_start();

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $part_name = $_POST['part_name'];
    $part_qty = $_POST['part_qty'];
    $req_by = $_POST['req_by'];
    $user = $_SESSION['username'];
    $dts = date('Y-m-d H:i:s');

    $id = mysqli_real_escape_string($con, $id);

    // Updating Request to Return
    $update_sql = "UPDATE tbl_requested SET status = 'returned' , received_by = '$user' , dts_receive = '$dts' WHERE id = '$id'";

    if (mysqli_query($con, $update_sql)) {
        $mensahe = $user . ' has successfully received ' . $part_qty . ' of ' . $part_name . '. Click here for more details.';
        $for = "user";

        // Insert it to the Notification Table
        $sql_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) 
                              VALUES ('$req_by', '$mensahe', 0, '$dts', '$req_by' , 'Returned')";
        if (mysqli_query($con, $sql_notif)) {
            echo "Status updated successfully";
        }
    } else {
        echo "Error updating status: " . mysqli_error($con);
    }
}
?>