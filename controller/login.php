<?php
session_start();

include "../model/dbconnection.php";

if (isset($_POST['loginUser'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $checkUserSQL = "SELECT * FROM tbl_users WHERE username = ?";
    $stmt = mysqli_prepare($con, $checkUserSQL);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $checkUserQuery = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($checkUserQuery) == 0) {
        $_SESSION['status'] = "No such username exists.";
        $_SESSION['status_code'] = "error";
        header("location: ../view/index.php");
        exit();
    } else {
        $loginSQL = "SELECT * FROM tbl_users WHERE username = ? AND password = ?";
        $stmt = mysqli_prepare($con, $loginSQL);
        mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
        mysqli_stmt_execute($stmt);
        $loginSQL_query = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($loginSQL_query) == 1) {
            $_SESSION['status'] = "Login successfully.";
            $_SESSION['status_code'] = "success";
            while ($whichUser = mysqli_fetch_assoc($loginSQL_query)) {
                if ($whichUser['account_type'] == 'Supervisor') {
                    $_SESSION['user'] = $whichUser['account_type'];
                    $_SESSION['username'] = $whichUser['username'];
                    header("location: ../view/adminModule/adminDashboard.php");
                    exit();
                } else if ($whichUser['account_type'] == 'Kitting') {
                    $_SESSION['user'] = $whichUser['account_type'];
                    $_SESSION['username'] = $whichUser['username'];
                    header("location: ../view/adminModule/adminDashboard.php");
                    exit();
                } else if ($whichUser['account_type'] == 'User') {
                    $_SESSION['user'] = $whichUser['account_type'];
                    $_SESSION['username'] = $whichUser['username'];
                    header("location: ../view/userModule/userDashboard.php");
                    exit();
                }
            }
        } else {
            $_SESSION['status'] = "Incorrect password.";
            $_SESSION['status_code'] = "error";
            header("location: ../view/index.php");
            exit();
        }
    }
}
?>