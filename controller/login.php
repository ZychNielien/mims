<?php

// Session Start
session_start();

// Database Connection
include "../model/dbconnection.php";

if (isset($_POST['loginUser'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Selecting Existing Username
    $checkUserSQL = "SELECT * FROM tbl_users WHERE username = ?";
    $stmt = mysqli_prepare($con, $checkUserSQL);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $checkUserQuery = mysqli_stmt_get_result($stmt);

    // Checking if there's an existing username
    if (mysqli_num_rows($checkUserQuery) == 0) {
        $_SESSION['status'] = "No such username exists.";
        $_SESSION['status_code'] = "error";
        header("location: ../view/index.php");
        exit();
    } else {

        // Selecting Username and Password
        $loginSQL = "SELECT * FROM tbl_users WHERE username = ? AND password = ?";
        $stmt = mysqli_prepare($con, $loginSQL);
        mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
        mysqli_stmt_execute($stmt);
        $loginSQL_query = mysqli_stmt_get_result($stmt);

        // Checking if there's Username and Password
        if (mysqli_num_rows($loginSQL_query) == 1) {

            while ($whichUser = mysqli_fetch_assoc($loginSQL_query)) {

                // Approved Accounts
                if ($whichUser['usertype'] == '2') {
                    $_SESSION['status'] = "Login successfully.";
                    $_SESSION['status_code'] = "success";
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
                    // Accounts Awaiting Approval
                } else if ($whichUser['usertype'] == '1') {
                    $_SESSION['status'] = "We apologize, but your account is still awaiting approval from the supervisors.";
                    $_SESSION['status_code'] = "error";
                    header("location: ../view/index.php");
                    exit();

                    // Rejected Accounts
                } else if ($whichUser['usertype'] == '3') {
                    $_SESSION['status'] = "Unfortunately, your account has been rejected.";
                    $_SESSION['username'] = $whichUser['username'];
                    $_SESSION['status_code'] = "error";
                    header("location: ../view/index.php");
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




if (isset($_POST['forgot_pass'])) {
    $forgot_username = $_POST['forgot_username'];

    $check = "SELECT * FROM `tbl_users` WHERE username = '$forgot_username'";
    $check_query = mysqli_query($con, $check);

    if (mysqli_num_rows($check_query) > 0) {

        $sql = "UPDATE `tbl_users` SET forgot_pass = '1' WHERE username = '$forgot_username'";
        $sql_query = mysqli_query($con, $sql);

        if ($sql_query) {
            $_SESSION['status'] = "Your password reset request has been submitted to the supervisor. Please proceed to the supervisor to have your password changed.";
            $_SESSION['status_code'] = "success";
            header("Location: ../view/index.php");
            exit();
        }
    } else {
        $_SESSION['status'] = "It appears that no username was found.";
        $_SESSION['status_code'] = "error";
        header("Location: ../view/index.php");
        exit();
    }

}

if (isset($_POST['change_pass'])) {
    $id = $_POST['user_id'];
    $new_pass = $_POST['new_pass'];
    $con_pass = $_POST['con_pass'];

    if ($new_pass === $con_pass) {
        $update = "UPDATE `tbl_users` SET password = '$new_pass', forgot_pass = '0' WHERE id = '$id'";
        $update_query = mysqli_query($con, $update);
        if ($update_query) {
            $_SESSION['status'] = "Password has been changed successfully.";
            $_SESSION['status_code'] = "success";
            header("Location: ../view/adminModule/accReg.php");
            exit();
        }
    } else {
        $_SESSION['status'] = "The new password and confirm password do not match. Please ensure both fields are identical and try again.";
        $_SESSION['status_code'] = "error";
        header("Location: ../view/adminModule/accReg.php");
        exit();
    }
}

?>