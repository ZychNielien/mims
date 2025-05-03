<?php

session_start();
date_default_timezone_set('Asia/Manila');
include "../model/dbconnection.php";


if (isset($_POST['loginUser'])) {
    $username = $_POST['username'];
    $password = trim($_POST['password']);

    $username = mysqli_real_escape_string($con, $username);

    $checkUserSQL = "SELECT * FROM tbl_users WHERE username = '$username'";
    $checkUserQuery = mysqli_query($con, $checkUserSQL);

    if (mysqli_num_rows($checkUserQuery) == 0) {
        $_SESSION['status'] = "No such username exists.";
        $_SESSION['status_code'] = "error";
        header("location: ../view/index.php");
        exit();
    }

    $user = mysqli_fetch_assoc($checkUserQuery);
    $hashed_password = $user['password'];

    if (password_verify($password, $hashed_password)) {
        if ($user['usertype'] == '1') {
            $_SESSION['status'] = "We apologize, but your account is still awaiting approval from the supervisors.";
            $_SESSION['status_code'] = "error";
            header("location: ../view/index.php");
            exit();
        } else if ($user['usertype'] == '3') {
            $_SESSION['reason'] = $user['reason'];
            $_SESSION['status'] = "Unfortunately, your account application has been rejected due to the reason of " . $_SESSION['reason'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['status_code'] = "error";
            header("location: ../view/index.php");
            exit();
        } else if ($user['usertype'] == '2') {
            $_SESSION['status'] = "Login successful.";
            $_SESSION['status_code'] = "success";
            $_SESSION['user'] = $user['account_type'];
            $_SESSION['username'] = $user['username'];

            if ($user['account_type'] == 'Supervisor' || $user['account_type'] == 'Kitting') {
                header("location: ../view/adminModule/adminDashboard.php");
                exit();
            } else if ($user['account_type'] == 'User') {
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







if (isset($_POST['forgot_pass'])) {
    $forgot_username = $_POST['forgot_username'];

    $check = "SELECT * FROM `tbl_users` WHERE username = '$forgot_username'";
    $check_query = mysqli_query($con, $check);
    $checkRow = mysqli_fetch_assoc($check_query);
    $reason = $checkRow[''];

    if (mysqli_num_rows($check_query) > 0) {

        if ($checkRow['usertype'] == 2) {
            $sql = "UPDATE `tbl_users` SET forgot_pass = '1' WHERE username = '$forgot_username'";
            $sql_query = mysqli_query($con, $sql);

            if ($sql_query) {
                $dts = date('Y-m-d H:i:s');
                $mensahe = $forgot_username . ' has requested a password change.';
                $for = "adminOnly";

                $sql_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) 
                              VALUES ('$forgot_username', '$mensahe', 0, '$dts', '$for', 'Request password change')";
                $sql_notif_query = mysqli_query($con, $sql_notif);
                if ($sql_notif_query) {
                    $_SESSION['status'] = "Your password reset request has been submitted to the supervisor. Please proceed to the supervisor to have your password changed.";
                    $_SESSION['status_code'] = "success";
                    header("Location: ../view/index.php");
                    exit();
                }
            }

        } else if ($checkRow['usertype'] == 1) {
            $_SESSION['status'] = "Your account is currently pending approval.";
            $_SESSION['status_code'] = "error";
            header("Location: ../view/index.php");
            exit();
        } else if ($checkRow['usertype'] == 3) {
            $_SESSION['status'] = "We regret to inform you that your account has been rejected.";
            $_SESSION['status_code'] = "error";
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
    $username = $_POST['user_username'];

    if ($new_pass === $con_pass) {
        $hashed_pass = password_hash($new_pass, PASSWORD_DEFAULT);

        $update = "UPDATE `tbl_users` SET password = '$hashed_pass', forgot_pass = '0' WHERE id = '$id'";
        $update_query = mysqli_query($con, $update);

        if ($update_query) {

            $account_username = $_SESSION['username'];
            $description = $account_username . " has updated the password for " . $username . " account.";
            $dts = date('Y-m-d H:i:s');

            $sql_log = "INSERT INTO `tbl_log` (username, action, description, dts) VALUES ('$account_username', 'Password changed','$description' , '$dts')";
            $sql_log_query = mysqli_query($con, $sql_log);

            if ($sql_log_query) {
                $_SESSION['status'] = "Password has been changed successfully.";
                $_SESSION['status_code'] = "success";
                header("Location: ../view/adminModule/accReg.php?tab=password");
                exit();
            } else {
                $_SESSION['status'] = "Error logging the password change.";
                $_SESSION['status_code'] = "error";
                header("Location: ../view/adminModule/accReg.php?tab=password");
                exit();
            }
        } else {
            $_SESSION['status'] = "Error updating the password. Please try again.";
            $_SESSION['status_code'] = "error";
            header("Location: ../view/adminModule/accReg.php?tab=password");
            exit();
        }
    } else {
        $_SESSION['status'] = "The new password and confirm password do not match. Please ensure both fields are identical and try again.";
        $_SESSION['status_code'] = "error";
        header("Location: ../view/adminModule/accReg.php?tab=password");
        exit();
    }
}


?>