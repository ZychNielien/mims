<?php

session_start();
date_default_timezone_set('Asia/Manila');
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

            while ($whichUser = mysqli_fetch_assoc($loginSQL_query)) {
                if ($username === $whichUser['username'] && $password === $whichUser['password']) {

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
                    } else if ($whichUser['usertype'] == '1') {
                        $_SESSION['status'] = "We apologize, but your account is still awaiting approval from the supervisors.";
                        $_SESSION['status_code'] = "error";
                        header("location: ../view/index.php");
                        exit();

                    } else if ($whichUser['usertype'] == '3') {
                        $_SESSION['status'] = "Unfortunately, your account has been rejected.";
                        $_SESSION['username'] = $whichUser['username'];
                        $_SESSION['status_code'] = "error";
                        header("location: ../view/index.php");
                        exit();
                    }
                } else {
                    $_SESSION['status'] = "Wrong Credential.";
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
    $checkRow = mysqli_fetch_assoc($check_query);

    if (mysqli_num_rows($check_query) > 0) {

        if ($checkRow['usertype'] == 2) {
            $sql = "UPDATE `tbl_users` SET forgot_pass = '1' WHERE username = '$forgot_username'";
            $sql_query = mysqli_query($con, $sql);

            if ($sql_query) {
                $dts = date('Y-m-d H:i:s');
                $mensahe = $forgot_username . ' has requested a password change.';
                $for = "adminOnly";

                // Insert notification for the admin
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
        $update = "UPDATE `tbl_users` SET password = '$new_pass', forgot_pass = '0' WHERE id = '$id'";
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
            }
        }
    } else {
        $_SESSION['status'] = "The new password and confirm password do not match. Please ensure both fields are identical and try again.";
        $_SESSION['status_code'] = "error";
        header("Location: ../view/adminModule/accReg.php?tab=password");
        exit();
    }
}

?>