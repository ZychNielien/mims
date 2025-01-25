<?php
session_start();

$_SESSION['status'] = "Logout Successfully";
$_SESSION['status-code'] = "success";
header('location: ../view/index.php');

session_destroy();
?>