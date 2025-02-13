<?php

include "../model/dbconnection.php";

session_start();

$userId = $_SESSION['username'];

$sql = "SELECT account_type FROM tbl_users WHERE username = '$userId'";
$result = mysqli_query($con, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row['account_type']);
} else {
    echo json_encode(["error" => "Error: " . mysqli_error($con)]);
}

mysqli_close($con);
?>