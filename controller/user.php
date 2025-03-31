<?php
include "../model/dbconnection.php";
session_start();
date_default_timezone_set('Asia/Manila');

// ADMIN ACCOUNT CREATION
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

        $account_username = $_SESSION['username'];
        $desciption = $account_username . " has created an account for " . $employee_name;
        $dts = date('Y-m-d H:i:s');

        $sql_log = "INSERT INTO `tbl_log` (username, action, description, dts) VALUES ('$account_username', 'Account Registration','$desciption' , '$dts')";
        $sql_log_query = mysqli_query($con, $sql_log);

        if ($sql_log_query) {
            $sql = "INSERT INTO tbl_users (employee_name, username, password, badge_number, designation, account_type,cost_center,supervisor_one,supervisor_two ,usertype) VALUES ('$employee_name', '$username','$password', '$badge_number','$designation', '$account_type','$cost_center', '$supervisor_one','$supervisor_two',  2)";
            if (mysqli_query($con, $sql)) {
                $_SESSION['status'] = "User registered successfully!";
                $_SESSION['status_code'] = "success";
                header("Location: ../view/adminModule/accReg.php?tab=account");
            } else {
                $_SESSION['status'] = "Error registering user.";
                $_SESSION['status_code'] = "error";
                header("Location: ../view/adminModule/accReg.php?tab=account");
            }
        }


    }
}

// USER ACCOUNT CREATION
if (isset($_POST['account_submit'])) {
    $employee_name = mysqli_real_escape_string($con, $_POST['employee_name']);
    $employee_username = mysqli_real_escape_string($con, $_POST['employee_username']);
    $employee_password = mysqli_real_escape_string($con, $_POST['employee_password']);
    $badge_number = mysqli_real_escape_string($con, $_POST['badge_number']);
    $designation = mysqli_real_escape_string($con, $_POST['designation']);
    $account_type = mysqli_real_escape_string($con, $_POST['account_type']);
    $cost_center = mysqli_real_escape_string($con, $_POST['cost_center']);
    $supervisor_one = mysqli_real_escape_string($con, $_POST['supervisor_one']);
    $supervisor_two = mysqli_real_escape_string($con, $_POST['supervisor_two']);

    $checkUsernameSQL = "SELECT * FROM tbl_users WHERE username = '$employee_username'";
    $checkUsernameQuery = mysqli_query($con, $checkUsernameSQL);

    if (mysqli_num_rows($checkUsernameQuery) > 0) {

        $_SESSION['status'] = "Username is already taken, please choose another one.";
        $_SESSION['status_code'] = "error";
        header("Location: ../view/index.php");
    } else {

        $sql = "INSERT INTO tbl_users (employee_name, username, password, badge_number, designation, account_type,cost_center,supervisor_one,supervisor_two ,usertype) VALUES ('$employee_name', '$employee_username','$employee_password', '$badge_number','$designation', '$account_type','$cost_center', '$supervisor_one','$supervisor_two',  1)";
        if (mysqli_query($con, $sql)) {

            $dts = date('Y-m-d H:i:s');
            $message = htmlspecialchars($employee_name, ENT_QUOTES, 'UTF-8') . " account registration is awaiting approval.";
            $for = "adminOnly";
            $destination = "Account Registration Pending Approval";

            $sql_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) 
                          VALUES ('System', '$message', 0, '$dts', '$for', '$destination')";
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

// ACCOUNT APPROVAL
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['selected_ids']) && !empty($_POST['selected_ids'])) {
        $selected_ids = $_POST['selected_ids'];
        $action = $_POST['action'];

        $ids = implode(',', array_map('intval', $selected_ids));

        if ($action == 'approve') {
            $sql = "UPDATE tbl_users SET usertype = '2' WHERE id IN ($ids)";
            $sql_query = mysqli_query($con, $sql);

            if ($sql_query) {
                $sql_fetch = "SELECT id, employee_name FROM tbl_users WHERE id IN ($ids)";
                $fetch_query = mysqli_query($con, $sql_fetch);

                if ($fetch_query) {
                    $account_username = $_SESSION['username'];
                    $actionLog = "Account Approval Confirmed";
                    $dts = date('Y-m-d H:i:s');

                    while ($row = mysqli_fetch_assoc($fetch_query)) {
                        $employee_name = $row['employee_name'];
                        $sql_log = "INSERT INTO tbl_log (username, action, description, dts) VALUES ('$account_username', '$actionLog', '$account_username has approved the account registration request of $employee_name.', '$dts')";
                        mysqli_query($con, $sql_log);
                    }

                    $_SESSION['status'] = "Selected users have been approved.";
                    $_SESSION['status_code'] = "success";
                    header("Location: ../view/adminModule/accReg.php");
                }
            }
        } elseif ($action == 'reject') {
            $sql = "UPDATE tbl_users SET usertype = '3' WHERE id IN ($ids)";
            $sql_query = mysqli_query($con, $sql);

            if ($sql_query) {
                $sql_fetch = "SELECT id, employee_name FROM tbl_users WHERE id IN ($ids)";
                $fetch_query = mysqli_query($con, $sql_fetch);

                if ($fetch_query) {
                    $account_username = $_SESSION['username'];
                    $actionLog = "Account Rejection Confirmed";
                    $dts = date('Y-m-d H:i:s');

                    while ($row = mysqli_fetch_assoc($fetch_query)) {
                        $employee_name = $row['employee_name'];
                        $sql_log = "INSERT INTO tbl_log (username, action, description, dts) VALUES ('$account_username', '$actionLog', '$account_username has rejected the account registration request of $employee_name.', '$dts')";
                        mysqli_query($con, $sql_log);
                    }

                    $_SESSION['status'] = "Selected users have been rejected.";
                    $_SESSION['status_code'] = "success";
                    header("Location: ../view/adminModule/accReg.php");
                }
            }
        }
    } else {
        echo "No users selected.";
    }
}





// EDIT USERS
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

        $account_username = $_SESSION['username'];
        $desciption = $account_username . " has made changes to the account of " . $employee_name;
        $dts = date('Y-m-d H:i:s');

        $sql_log = "INSERT INTO `tbl_log` (username, action, description, dts) VALUES ('$account_username', 'Account Modification','$desciption' , '$dts')";
        $sql_log_query = mysqli_query($con, $sql_log);

        if ($sql_log_query) {
            $_SESSION['status'] = "User details updated successfully!";
            $_SESSION['status_code'] = "success";
            header("Location: ../view/adminModule/accReg.php?tab=account");
        }
    } else {
        $_SESSION['status'] = "Error updating user details.";
        $_SESSION['status_code'] = "error";
        header("Location: ../view/adminModule/accReg.php?tab=account");
    }
}

// DELETE USER
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $sql = "DELETE FROM tbl_users WHERE id = '$user_id'";

    $sql_user = "SELECT employee_name FROM `tbl_users` WHERE id = '$user_id'";
    $sql_user_query = mysqli_query($con, $sql_user);
    $userRow = mysqli_fetch_assoc($sql_user_query);
    $employee_name = $userRow['employee_name'];

    if (mysqli_query($con, $sql)) {
        $account_username = $_SESSION['username'];
        $desciption = $account_username . " has deleted the account of " . $employee_name;
        $dts = date('Y-m-d H:i:s');

        $sql_log = "INSERT INTO `tbl_log` (username, action, description, dts) VALUES ('$account_username', 'Account Deletion','$desciption' , '$dts')";
        $sql_log_query = mysqli_query($con, $sql_log);

        if ($sql_log_query) {
            $_SESSION['status'] = "User deleted successfully!";
            $_SESSION['status_code'] = "success";
            header("Location: ../view/adminModule/accReg.php?tab=account");
        }
    } else {
        $_SESSION['status'] = "Error deleting user.";
        $_SESSION['status_code'] = "error";
        header("Location: ../view/adminModule/accReg.php?tab=account");
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