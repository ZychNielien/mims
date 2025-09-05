<?php
session_start();
include "../model/dbconnection.php";

$username = $_SESSION['username'];

if ($_SESSION['designation'] == 'Kitting' || $_SESSION['designation'] == 'Supervisor' || $_SESSION['designation'] == 'Maintenance Supervisor') {

    $sql = "UPDATE tbl_notif SET is_read = 1 WHERE is_read = 0 AND (for_who = '$username' OR for_who = 'admin'";

    if ($_SESSION['designation'] == 'Supervisor') {
        $sql .= " OR for_who = 'adminOnly' OR for_who = 'Supervisor'";
    } else if ($_SESSION['designation'] == 'Kitting') {
        $sql .= " OR for_who = 'Kitting'";
    } else if ($_SESSION['designation'] == 'Maintenance Supervisor') {
        $sql .= " OR for_who = 'Maintenance Supervis'";
    }

    $sql .= ")";

    if (mysqli_query($con, $sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to mark notifications as read']);
    }
} else {

    $sql = "UPDATE tbl_notif SET is_read = 1 WHERE is_read = 0 AND for_who = '$username'";
    if (mysqli_query($con, $sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to mark notifications as read']);
    }

}

mysqli_close($con);
?>