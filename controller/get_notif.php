<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

include "../model/dbconnection.php";

header('Content-Type: application/json');

if ($con->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

$username = $_SESSION['username'] ?? '';
$designation = $_SESSION['designation'] ?? '';

$notifications = [];

if ($designation === 'Supervisor' || $designation === 'Kitting' || $designation === 'Maintenance Supervisor') {
    $sql = "SELECT * FROM tbl_notif WHERE for_who = '$username'";

    if ($designation === 'Supervisor') {
        $sql .= " OR for_who = 'adminOnly' OR for_who = 'Supervisor'";
    } elseif ($designation === 'Kitting') {
        $sql .= " OR for_who = 'Kitting'";
    } elseif ($designation === 'Maintenance Supervisor') {
        $sql .= " OR for_who = 'Maintenance Supervis'";
    }

    $sql .= " ORDER BY created_at DESC LIMIT 50";

    $result = $con->query($sql);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $notifications[] = $row;
        }
    }

} else {
    $sql = "SELECT * FROM tbl_notif 
            WHERE for_who = 'user' OR for_who = '$username' 
            ORDER BY created_at DESC";

    $result = $con->query($sql);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $notifications[] = $row;
        }
    }
}

if (empty($notifications)) {
    echo json_encode(['message' => 'No notifications']);
} else {
    echo json_encode($notifications);
}

$con->close();
