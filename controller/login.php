<?php

include "../model/dbconnection.php";

session_start();

if (isset($_POST['loginUser'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $loginSQL = "SELECT * FROM tbl_users WHERE username = '$username' AND password = '$password'";

    $loginSQL_query = mysqli_query($con, $loginSQL);

    if ($loginSQL_query) {
        $numRows = mysqli_num_rows($loginSQL_query);
        if ($numRows == 1) {
            $_SESSION['status'] = "Login Successfully";
            $_SESSION['status_code'] = "success";
            while ($whichUser = mysqli_fetch_assoc($loginSQL_query)) {

                if ($whichUser['usertype'] == 1) {

                    $_SESSION['user'] = $whichUser['usertype'];
                    $_SESSION['username'] = $whichUser['username'];
                    header("location: ../view/adminModule/adminDashboard.php");

                } else if ($whichUser['usertype'] == 2) {
                    $_SESSION['user'] = $whichUser['usertype'];
                    $_SESSION['username'] = $whichUser['username'];
                    header("location: ../view/userModule/userDashboard.php");
                }

            }
        } else {
            $_SESSION['status'] = "Authentication Failed";
            $_SESSION['status_code'] = "error";
            header("location: ../view/index.php");
        }
    }
}

?>