<?php

include "../model/dbconnection.php";
session_start();

// Submit new Cost Center
if (isset($_POST['submit_cc'])) {
    $new_ccid = $_POST['new_ccid'];
    $new_ccid_name = $_POST['new_ccid_name'];
    $project_code = $_POST['project_code'];
    $project_name = $_POST['project_name'];
    $badge_one = $_POST['badge_one'];
    $badge_two = $_POST['badge_two'];
    $supervisor_one = $_POST['supervisor_one'];
    $supervisor_two = $_POST['supervisor_two'];

    // Inserting Cost Center
    $sql = "INSERT INTO `tbl_ccs` (ccid, ccid_name,project_code,project_name,badge_one,badge_two,supervisor_one,supervisor_two) VALUES ('$new_ccid','$new_ccid_name','$project_code','$project_name','$badge_one','$badge_two','$supervisor_one','$supervisor_two')";

    $sql_query = mysqli_query($con, $sql);

    if ($sql_query) {

        $account_username = $_SESSION['username'];
        $action = "Cost Center Registration";
        $description = $account_username . " has successfully registered a new " . $new_ccid_name . " in the system.";
        $dts = date('Y-m-d H:i:s');

        // Insert Log History
        $sql_log = "INSERT INTO `tbl_log` (username, action, description, dts) VALUES ('$account_username', '$action','$description' , '$dts')";
        $sql_log_query = mysqli_query($con, $sql_log);

        if ($sql_log_query) {
            $_SESSION['status'] = "Submitted successfully!";
            $_SESSION['status_code'] = "success";
            header("Location: ../view/adminModule/accReg.php?tab=costcenter");
        }
    }
}

// Edit Existing Cost Center
if (isset($_POST['submit_edit_cc'])) {
    $id = $_POST['id'];
    $new_ccid = $_POST['new_ccid'];
    $new_ccid_name = $_POST['new_ccid_name'];
    $project_code = $_POST['project_code'];
    $project_name = $_POST['project_name'];
    $badge_one = $_POST['badge_one'];
    $badge_two = $_POST['badge_two'];
    $supervisor_one = $_POST['supervisor_one'];
    $supervisor_two = $_POST['supervisor_two'];

    // Updating Cost Center
    $sql = "UPDATE `tbl_ccs` SET ccid = '$new_ccid' , ccid_name = '$new_ccid_name' , project_code = '$project_code' , project_name = '$project_name' , badge_one = '$badge_one' , badge_two = '$badge_two' , supervisor_one = '$supervisor_one' , supervisor_two = '$supervisor_two' WHERE id = '$id'";

    $sql_query = mysqli_query($con, $sql);

    if ($sql_query) {
        $account_username = $_SESSION['username'];
        $action = "Cost Center Modification";
        $description = $account_username . " has successfully updated the details of the " . $new_ccid_name . " in the system.";
        $dts = date('Y-m-d H:i:s');

        // Insert Log History
        $sql_log = "INSERT INTO `tbl_log` (username, action, description, dts) VALUES ('$account_username', '$action','$description' , '$dts')";
        $sql_log_query = mysqli_query($con, $sql_log);

        if ($sql_log_query) {
            $_SESSION['status'] = "Updated successfully!";
            $_SESSION['status_code'] = "success";
            header("Location: ../view/adminModule/accReg.php?tab=costcenter");
        }
    }
}

// Delete Existing Cost Center
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Select Cost Center CCID Name
    $select = "SELECT ccid_name FROM `tbl_ccs` WHERE id = '$id'";
    $select_query = mysqli_query($con, $select);
    $selectedRow = mysqli_fetch_assoc($select_query);
    $ccid_name = $selectedRow['ccid_name'];

    // Deleting Cost Center
    $sql = "DELETE FROM `tbl_ccs` WHERE id = '$id'";
    $sql_query = mysqli_query($con, $sql);

    if ($sql_query) {
        $account_username = $_SESSION['username'];
        $action = "Cost Center Deletion";
        $description = $account_username . " has successfully deleted the " . $ccid_name . " from the system.";
        $dts = date('Y-m-d H:i:s');

        // Insert Log History
        $sql_log = "INSERT INTO `tbl_log` (username, action, description, dts) VALUES ('$account_username', '$action','$description' , '$dts')";
        $sql_log_query = mysqli_query($con, $sql_log);

        if ($sql_log_query) {
            $_SESSION['status'] = "Deleted successfully!";
            $_SESSION['status_code'] = "success";
            header("Location: ../view/adminModule/accReg.php?tab=costcenter");
        }
    } else {
        $_SESSION['status'] = "Error deleting user.";
        $_SESSION['status_code'] = "error";
        header("Location: ../view/adminModule/accReg.php?tab=costcenter");
    }

}

?>