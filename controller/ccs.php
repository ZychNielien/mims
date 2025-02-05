<?php
include "../model/dbconnection.php";
session_start();

if (isset($_POST['submit_cc'])) {
    $new_ccid = $_POST['new_ccid'];
    $new_ccid_name = $_POST['new_ccid_name'];
    $project_code = $_POST['project_code'];
    $project_name = $_POST['project_name'];
    $badge_one = $_POST['badge_one'];
    $badge_two = $_POST['badge_two'];
    $supervisor_one = $_POST['supervisor_one'];
    $supervisor_two = $_POST['supervisor_two'];

    $sql = "INSERT INTO `tbl_ccs` (ccid, ccid_name,project_code,project_name,badge_one,badge_two,supervisor_one,supervisor_two) VALUES ('$new_ccid','$new_ccid_name','$project_code','$project_name','$badge_one','$badge_two','$supervisor_one','$supervisor_two')";

    $sql_query = mysqli_query($con, $sql);

    if ($sql_query) {
        $_SESSION['status'] = "Submitted successfully!";
        $_SESSION['status_code'] = "success";
        header("Location: ../view/adminModule/accReg.php");
    }
}

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

    $sql = "UPDATE `tbl_ccs` SET ccid = '$new_ccid' , ccid_name = '$new_ccid_name' , project_code = '$project_code' , project_name = '$project_name' , badge_one = '$badge_one' , badge_two = '$badge_two' , supervisor_one = '$supervisor_one' , supervisor_two = '$supervisor_two' WHERE id = '$id'";

    $sql_query = mysqli_query($con, $sql);

    if ($sql_query) {
        $_SESSION['status'] = "Updated successfully!";
        $_SESSION['status_code'] = "success";
        header("Location: ../view/adminModule/accReg.php");
    }
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM `tbl_ccs` WHERE id = '$id'";
    $sql_query = mysqli_query($con, $sql);

    if ($sql_query) {
        $_SESSION['status'] = "Deleted successfully!";
        $_SESSION['status_code'] = "success";
        header("Location: ../view/adminModule/accReg.php");
    } else {
        $_SESSION['status'] = "Error deleting user.";
        $_SESSION['status_code'] = "error";
        header("Location: ../view/adminModule/accReg.php");
    }

}

?>