<?php
include "../model/dbconnection.php";
session_start();
date_default_timezone_set('Asia/Manila');


// APPROVE ACCOUNTS
if (isset($_POST['approveacc_submit'])) {
    if (isset($_POST['ids']) && isset($_POST['employeenames']) && isset($_POST['accounttypes']) && isset($_POST['designations'])) {
        $ids = $_POST['ids'];
        $employeenames = $_POST['employeenames'];
        $accountypes = $_POST['accounttypes'];
        $designations = $_POST['designations'];
        $success = true;

        $account_username = $_SESSION['username'] ?? 'Unknown';
        $dts = date('Y-m-d H:i:s');
        $actionLog = "Account Approval Confirmed";

        for ($i = 0; $i < count($ids); $i++) {
            $id = intval($ids[$i]);
            $accountype = mysqli_real_escape_string($con, $accountypes[$i]);
            $employeename = mysqli_real_escape_string($con, $employeenames[$i]);
            $designation = mysqli_real_escape_string($con, $designations[$i]);

            $sql = "UPDATE tbl_users SET usertype = '2', account_type = '$accountype' , designation = '$designation' WHERE id = '$id'";
            if (!mysqli_query($con, $sql)) {
                $success = false;
                break;
            }

            $description = "$account_username has approved the account registration request of $employeename.";
            $sql_log = "INSERT INTO tbl_log (username, action, description, dts) VALUES ('$account_username', '$actionLog', '$description', '$dts')";
            if (!mysqli_query($con, $sql_log)) {
                $success = false;
                break;
            }
        }

        if ($success) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "A database error occurred."]);
        }

    } else {
        echo json_encode(["success" => false, "error" => "Missing data"]);
    }
}

// REJECT ACCOUNTS
if (isset($_POST['rejectacc_submit'])) {
    if (isset($_POST['ids']) && isset($_POST['employeenames']) && isset($_POST['reasons'])) {
        $ids = $_POST['ids'];
        $employeenames = $_POST['employeenames'];
        $reasons = $_POST['reasons'];
        $success = true;

        $account_username = $_SESSION['username'] ?? 'Unknown';
        $dts = date('Y-m-d H:i:s');
        $actionLog = "Account Rejection Confirmed";

        for ($i = 0; $i < count($ids); $i++) {
            $id = intval($ids[$i]);
            $employeename = mysqli_real_escape_string($con, $employeenames[$i]);
            $reason = mysqli_real_escape_string($con, $reasons[$i]);


            $sql = "UPDATE tbl_users SET usertype = '3' WHERE id = '$id'";
            if (!mysqli_query($con, $sql)) {
                $success = false;
                break;
            }

            $description = "$account_username has rejected the account registration request of $employeename.";
            $sql_log = "INSERT INTO tbl_log (username, action, description, dts, reasons) VALUES ('$account_username', '$actionLog', '$description', '$dts', '$reason')";
            if (!mysqli_query($con, $sql_log)) {
                $success = false;
                break;
            }
        }

        if ($success) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "A database error occurred."]);
        }

    } else {
        echo json_encode(["success" => false, "error" => "Missing data"]);
    }
}

?>