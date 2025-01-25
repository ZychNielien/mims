<?php
include "../model/dbconnection.php";
session_start();

if (isset($_POST['register'])) {

    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

    if ($password === $confirm_password) {

        $checkUsernameSQL = "SELECT * FROM tbl_users WHERE username = '$username'";
        $checkUsernameQuery = mysqli_query($con, $checkUsernameSQL);

        if (mysqli_num_rows($checkUsernameQuery) > 0) {

            $_SESSION['status'] = "Username is already taken, please choose another one.";
            $_SESSION['status_code'] = "error";
            header("Location: ../view/adminModule/accReg.php");
        } else {

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO tbl_users (username, password, usertype) VALUES ('$username', '$password', 2)";
            if (mysqli_query($con, $sql)) {
                $_SESSION['status'] = "User registered successfully!";
                $_SESSION['status_code'] = "success";
                header("Location: ../view/adminModule/accReg.php");
            } else {
                $_SESSION['status'] = "Error registering user.";
                $_SESSION['status_code'] = "error";
                header("Location: ../view/adminModule/accReg.php");
            }
        }
    } else {
        $_SESSION['status'] = "Passwords do not match.";
        $_SESSION['status_code'] = "error";
        header("Location: ../view/adminModule/accReg.php");
    }
}


if (isset($_POST['editUser'])) {
    $user_id = $_POST['user_id'];
    $username = mysqli_real_escape_string($con, $_POST['username']);

    $sql = "UPDATE tbl_users SET username = '$username' WHERE id = '$user_id'";

    if (mysqli_query($con, $sql)) {
        $_SESSION['status'] = "User details updated successfully!";
        $_SESSION['status_code'] = "success";
        header("Location: ../view/adminModule/accReg.php");
    } else {
        $_SESSION['status'] = "Error updating user details.";
        $_SESSION['status_code'] = "error";
        header("Location: ../view/adminModule/accReg.php");
    }
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $sql = "DELETE FROM tbl_users WHERE id = '$user_id'";

    if (mysqli_query($con, $sql)) {
        $_SESSION['status'] = "User deleted successfully!";
        $_SESSION['status_code'] = "success";
        header("Location: ../view/adminModule/accReg.php");
    } else {
        $_SESSION['status'] = "Error deleting user.";
        $_SESSION['status_code'] = "error";
        header("Location: ../view/adminModule/accReg.php");
    }
}


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

        if ($oldPassword === $storedPassword) {
            if ($newPassword === $confirmPassword) {

                $updateSql = "UPDATE tbl_users SET password = '$newPassword' WHERE username = '$userId'";

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

        if ($oldPassword === $storedPassword) {
            if ($newPassword === $confirmPassword) {

                $updateSql = "UPDATE tbl_users SET password = '$newPassword' WHERE username = '$userId'";

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

?>