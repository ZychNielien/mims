<?php
include "../model/dbconnection.php";
session_start();

if (isset($_POST['register'])) {

    $employee_name = mysqli_real_escape_string($con, $_POST['employee_name']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $badge_number = mysqli_real_escape_string($con, $_POST['badge_number']);
    $designation = mysqli_real_escape_string($con, $_POST['designation']);
    $account_type = mysqli_real_escape_string($con, $_POST['account_type']);
    $cost_center = mysqli_real_escape_string($con, $_POST['cost_center']);
    $supervisor_one = mysqli_real_escape_string($con, $_POST['supervisor_one']);
    $supervisor_two = mysqli_real_escape_string($con, $_POST['supervisor_two']);




    $checkUsernameSQL = "SELECT * FROM tbl_users WHERE username = '$username'";
    $checkUsernameQuery = mysqli_query($con, $checkUsernameSQL);

    if (mysqli_num_rows($checkUsernameQuery) > 0) {

        $_SESSION['status'] = "Username is already taken, please choose another one.";
        $_SESSION['status_code'] = "error";
        header("Location: ../view/adminModule/accReg.php");
    } else {

        $sql = "INSERT INTO tbl_users (employee_name, username, password, badge_number, designation, account_type,cost_center,supervisor_one,supervisor_two ,usertype) VALUES ('$employee_name', '$username','$password', '$badge_number','$designation', '$account_type','$cost_center', '$supervisor_one','$supervisor_two',  2)";
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
}


if (isset($_POST['editUser'])) {
    $user_id = $_POST['user_id'];
    $employee_name = mysqli_real_escape_string($con, $_POST['employee_name']);
    $badge_number = mysqli_real_escape_string($con, $_POST['badge_number']);
    $designation = mysqli_real_escape_string($con, $_POST['designation']);
    $account_type = mysqli_real_escape_string($con, $_POST['account_type']);
    $cost_center = mysqli_real_escape_string($con, $_POST['cost_center']);
    $supervisor_one = mysqli_real_escape_string($con, $_POST['supervisor_one']);
    $supervisor_two = mysqli_real_escape_string($con, $_POST['supervisor_two']);

    $sql = "UPDATE tbl_users SET employee_name = '$employee_name' , badge_number = '$badge_number' , designation = '$designation' , account_type = '$account_type' , cost_center = '$cost_center' , supervisor_one = '$supervisor_one' , supervisor_two = '$supervisor_two' WHERE id = '$user_id'";

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

// Check if the ccid (Cost Center ID) is passed and is not empty
if (isset($_POST['ccid']) && !empty($_POST['ccid'])) {
    $ccid = $_POST['ccid'];  // Get the selected CCID from the POST data

    // Query to fetch supervisor information based on the selected CCID
    $query = "SELECT supervisor_one, supervisor_two FROM tbl_ccs WHERE id = '$ccid'";
    $result = mysqli_query($con, $query);

    $response = array();  // Prepare the response array

    // Check if query was successful and if any result is found
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Store the supervisor data in the response array
        $response['supervisor_one'] = $row['supervisor_one'];
        $response['supervisor_two'] = $row['supervisor_two'];
    } else {
        // If no supervisor data found, set the fields to null
        $response['supervisor_one'] = null;
        $response['supervisor_two'] = null;
    }

    // Return the response as JSON
    echo json_encode($response);
}
?>