<?php
// Session Start
session_start();

// Database Connection
include "../model/dbconnection.php";



if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $username = mysqli_real_escape_string($con, $username);

    $sql = "DELETE FROM `tbl_users` WHERE `username` = '$username'";

    if (mysqli_query($con, $sql)) {
        $_SESSION['status'] = "You may now proceed with creating your new account by visiting the Registration tab.";
        $_SESSION['status_code'] = "success";
        header("Location: ../view/index.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
}

?>