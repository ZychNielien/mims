<?php
session_start();
include "../model/dbconnection.php";


// Query to update all unread notifications as read
$sql = "UPDATE tbl_notif SET is_read = 1 WHERE is_read = 0";
$stmt = $con->prepare($sql);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Failed to mark notifications as read']);
}

$stmt->close();
$con->close();
?>