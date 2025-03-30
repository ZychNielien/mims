<?php

// Session Start
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database Connection
include "../model/dbconnection.php";

if ($con->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}
$username = $_SESSION['username'];

if ($_SESSION['user'] == 'Supervisor' || $_SESSION['user'] == 'Kitting') {

    $sql = "SELECT * FROM tbl_notif WHERE for_who = '$username' OR for_who = 'admin'";

    if ($_SESSION['user'] == 'Supervisor') {
        $sql .= " OR for_who = 'adminOnly'";
    }

    $sql .= " ORDER BY created_at DESC";

    $result = $con->query($sql);

    $notifications = [];

    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }

    if (empty($notifications)) {
        echo json_encode(['message' => 'No notifications']);
    } else {
        echo json_encode($notifications);
    }

} else if ($_SESSION['user'] == 'User') {

    $sql = "SELECT * FROM tbl_notif WHERE for_who = 'user'  or for_who = '$username' ORDER BY created_at DESC";

    $result = $con->query($sql);


    if ($result === false) {
        echo json_encode(['error' => 'Database query failed']);
        exit;
    }

    $notifications = [];

    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }

    if (empty($notifications)) {
        echo json_encode(['message' => 'No notifications']);
    } else {
        echo json_encode($notifications);
    }
}

$con->close();
?>