<?php

// Session Start
session_start();

// Database Connection
include "../model/dbconnection.php";

$username = $_SESSION['username'];

// Checking if the usertype is User
if ($_SESSION['user'] == 'User') {

    // Mark as Read if it is for user
    $sql = "UPDATE tbl_notif SET is_read = 1 WHERE is_read = 0 AND for_who = '$username'";
    $stmt = $con->prepare($sql);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to mark notifications as read']);
    }

    // Checking if the usertype is Supervisor or Kitting
} elseif ($_SESSION['user'] == 'Kitting' || $_SESSION['user'] == 'Supervisor') {

    // Mark as Read if it is for Supervisor/Kitting OR Admin
    $sql = "UPDATE tbl_notif SET is_read = 1 WHERE is_read = 0 AND (for_who = '$username' OR for_who = 'admin')";
    $stmt = $con->prepare($sql);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to mark notifications as read']);
    }
}


$stmt->close();
$con->close();
?>