<?php
include "../model/dbconnection.php";
session_start();
date_default_timezone_set('Asia/Manila');

// USER ACCOUNT CREATION
if (isset($_POST['account_submit'])) {
    $employee_name = mysqli_real_escape_string($con, $_POST['employee_name']);
    $employee_username = mysqli_real_escape_string($con, $_POST['employee_username']);
    $employee_password_raw = $_POST['employee_password'];
    $badge_number = mysqli_real_escape_string($con, $_POST['badge_number']);
    $designation = mysqli_real_escape_string($con, $_POST['designation']);
    $account_type = mysqli_real_escape_string($con, $_POST['account_type']);
    $cost_center = mysqli_real_escape_string($con, $_POST['cost_center']);
    $supervisor_one = mysqli_real_escape_string($con, $_POST['supervisor_one']);
    $supervisor_two = mysqli_real_escape_string($con, $_POST['supervisor_two']);

    $employee_password = password_hash($employee_password_raw, PASSWORD_DEFAULT);

    $checkUsernameSQL = "SELECT * FROM tbl_users WHERE username = '$employee_username'";
    $checkUsernameQuery = mysqli_query($con, $checkUsernameSQL);

    if (mysqli_num_rows($checkUsernameQuery) > 0) {
        $_SESSION['status'] = "Username is already taken, please choose another one.";
        $_SESSION['status_code'] = "error";
        header("Location: ../view/index.php");
    } else {
        $sql = "INSERT INTO tbl_users 
                (employee_name, username, password, badge_number, designation, account_type, cost_center, supervisor_one, supervisor_two, usertype) 
                VALUES 
                ('$employee_name', '$employee_username', '$employee_password', '$badge_number', '$designation', '$account_type', '$cost_center', '$supervisor_one', '$supervisor_two', 1)";

        if (mysqli_query($con, $sql)) {
            $dts = date('Y-m-d H:i:s');
            $message = htmlspecialchars($employee_name, ENT_QUOTES, 'UTF-8') . " account registration is awaiting approval.";
            $for = "adminOnly";
            $destination = "Account Registration Pending Approval";

            $sql_notif = "INSERT INTO `tbl_notif` 
                          (username, message, is_read, created_at, for_who, destination) 
                          VALUES 
                          ('System', '$message', 0, '$dts', '$for', '$destination')";
            $sql_notif_query = mysqli_query($con, $sql_notif);

            if ($sql_notif_query) {
                $_SESSION['status'] = "Your account has been successfully created. Please await approval from the administrator before you can log in.";
                $_SESSION['status_code'] = "success";
                header("Location: ../view/index.php");
            }
        } else {
            $_SESSION['status'] = "Error registering user.";
            $_SESSION['status_code'] = "error";
            header("Location: ../view/index.php");
        }
    }
}


// CHANGE PASS NG SUPERVISOR/KITTING
if (isset($_POST['changePass'])) {
    $userId = mysqli_real_escape_string($con, $_POST['userID']);
    $oldPassword = mysqli_real_escape_string($con, $_POST['old_password']);
    $newPassword = mysqli_real_escape_string($con, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($con, $_POST['confirm_password']);

    $sql = "SELECT password FROM tbl_users WHERE username = '$userId'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['password'];

        if (password_verify($oldPassword, $storedPassword)) {
            if ($newPassword === $confirmPassword) {
                $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                $updateSql = "UPDATE tbl_users SET password = '$newHashedPassword' WHERE username = '$userId'";

                if (mysqli_query($con, $updateSql)) {
                    $_SESSION['status'] = "Password updated successfully!";
                    $_SESSION['status_code'] = "success";
                    header("Location: ../view/adminModule/adminDashboard.php");
                } else {
                    $_SESSION['status'] = "Error updating password. Please try again.";
                    $_SESSION['status_code'] = "error";
                    header("Location: ../view/adminModule/adminDashboard.php");
                }
            } else {
                $_SESSION['status'] = "New password and confirmation do not match.";
                $_SESSION['status_code'] = "error";
                header("Location: ../view/adminModule/adminDashboard.php");
            }
        } else {
            $_SESSION['status'] = "Old password is incorrect.";
            $_SESSION['status_code'] = "error";
            header("Location: ../view/adminModule/adminDashboard.php");
        }
    } else {
        $_SESSION['status'] = "User not found.";
        $_SESSION['status_code'] = "error";
        header("Location: ../view/adminModule/adminDashboard.php");
    }
}


// CHANGE PASS NG USER
if (isset($_POST['changePassUser'])) {
    $userId = mysqli_real_escape_string($con, $_POST['userID']);
    $oldPassword = mysqli_real_escape_string($con, $_POST['old_password']);
    $newPassword = mysqli_real_escape_string($con, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($con, $_POST['confirm_password']);

    $sql = "SELECT password FROM tbl_users WHERE username = '$userId'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['password'];

        if (password_verify($oldPassword, $storedPassword)) {
            if ($newPassword === $confirmPassword) {
                $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $updateSql = "UPDATE tbl_users SET password = '$newHashedPassword' WHERE username = '$userId'";

                if (mysqli_query($con, $updateSql)) {
                    $_SESSION['status'] = "Password updated successfully!";
                    $_SESSION['status_code'] = "success";
                    header("Location: ../view/userModule/userDashboard.php");
                } else {
                    $_SESSION['status'] = "Error updating password. Please try again.";
                    $_SESSION['status_code'] = "error";
                    header("Location: ../view/userModule/userDashboard.php");
                }
            } else {
                $_SESSION['status'] = "New password and confirmation do not match.";
                $_SESSION['status_code'] = "error";
                header("Location: ../view/userModule/userDashboard.php");
            }
        } else {
            $_SESSION['status'] = "Old password is incorrect.";
            $_SESSION['status_code'] = "error";
            header("Location: ../view/userModule/userDashboard.php");
        }
    } else {
        $_SESSION['status'] = "User not found.";
        $_SESSION['status_code'] = "error";
        header("Location: ../view/userModule/userDashboard.php");
    }
}



if (isset($_POST['ccid']) && !empty($_POST['ccid'])) {
    $ccid = $_POST['ccid'];

    $query = "SELECT supervisor_one, supervisor_two FROM tbl_ccs WHERE id = '$ccid'";
    $result = mysqli_query($con, $query);

    $response = array();

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $response['supervisor_one'] = $row['supervisor_one'];
        $response['supervisor_two'] = $row['supervisor_two'];
    } else {
        $response['supervisor_one'] = null;
        $response['supervisor_two'] = null;
    }

    echo json_encode($response);
}



?>