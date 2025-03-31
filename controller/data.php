<?php

// Database Connection
include "../model/dbconnection.php";

// Session Start
session_start();

// INSERT MACHINE NUMBER
if (isset($_POST['machine_submit'])) {
    $machine = strtoupper($_POST['machine']);

    $machine_check = "SELECT * FROM `tbl_machine` WHERE machine_number = '$machine'";
    if (mysqli_num_rows(mysqli_query($con, $machine_check)) == 0) {
        $machine_sql = "INSERT INTO `tbl_machine` (machine_number) VALUES  ('$machine')";
        if (mysqli_query($con, $machine_sql)) {
            $_SESSION['status'] = "Machine number " . strtoupper($machine) . " has been successfully added to the system.";
            $_SESSION['status_code'] = "success";
            header("Location: ../view/adminModule/adminData.php");
        }
    } else {
        $_SESSION['status'] = "The machine number " . strtoupper($machine) . " already exists in the system.";
        $_SESSION['status_code'] = "error";
        header("Location: ../view/adminModule/adminData.php");
    }
}

// UPDATE MACHINE NUMBER
if (isset($_POST['machine_update'])) {
    $id = $_POST['machine_id'];
    $machine = strtoupper($_POST['machine_number']);
    $machine_check = "SELECT * FROM `tbl_machine` WHERE machine_number = '$machine'";
    if (mysqli_num_rows(mysqli_query($con, $machine_check)) == 0) {
        $machine_sql = "UPDATE `tbl_machine` SET machine_number = '$machine' WHERE id = '$id'";
        if (mysqli_query($con, $machine_sql)) {
            $_SESSION['status'] = "The machine number " . strtoupper($machine) . " has been successfully updated in the system.";
            $_SESSION['status_code'] = "success";
            header("Location: ../view/adminModule/adminData.php");
        }
    } else {
        $_SESSION['status'] = "The machine number " . strtoupper($machine) . " already exists in the system.";
        $_SESSION['status_code'] = "error";
        header("Location: ../view/adminModule/adminData.php");
    }
}

// DELETE MACHINE NUMBER
if (isset($_GET['machine_id'])) {
    $id = mysqli_real_escape_string($con, $_GET['machine_id']);
    $machine_check = "SELECT * FROM `tbl_machine` WHERE id = '$id'";
    $machine_query = mysqli_query($con, $machine_check);

    if (mysqli_num_rows($machine_query) > 0) {
        $machine_row = mysqli_fetch_assoc($machine_query);
        $machine = $machine_row['machine_number'];
        $machine_sql = "DELETE FROM `tbl_machine` WHERE id = '$id'";
        if (mysqli_query($con, $machine_sql)) {
            $_SESSION['status'] = "Machine number " . strtoupper($machine) . " has been successfully deleted.";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Failed to delete machine number " . strtoupper($machine) . ".";
            $_SESSION['status_code'] = "error";
        }
    } else {
        $_SESSION['status'] = "Machine number not found.";
        $_SESSION['status_code'] = "error";
    }

    header("Location: ../view/adminModule/adminData.php");
    exit();
}

// INSERT STATION CODE
if (isset($_POST['station_submit'])) {
    $station = strtoupper($_POST['station_code']);

    $station_check = "SELECT * FROM `tbl_station_code` WHERE station_code = '$station'";
    if (mysqli_num_rows(mysqli_query($con, $station_check)) == 0) {
        $station_sql = "INSERT INTO `tbl_station_code` (station_code) VALUES ('$station')";
        if (mysqli_query($con, $station_sql)) {
            $_SESSION['status'] = "The station code $station has been successfully added to the system.";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Error adding station code.";
            $_SESSION['status_code'] = "error";
        }
    } else {
        $_SESSION['status'] = "The station code $station already exists in the system.";
        $_SESSION['status_code'] = "error";
    }

    header("Location: ../view/adminModule/adminData.php?tab=station");
    exit();
}

// UPDATE STATION CODE
if (isset($_POST['station_update'])) {
    $station = strtoupper($_POST['station_code']);
    $id = $_POST['station_id'];

    $station_check = "SELECT * FROM `tbl_station_code` WHERE station_code = '$station'";
    if (mysqli_num_rows(mysqli_query($con, $station_check)) == 0) {
        $station_sql = "UPDATE `tbl_station_code` SET station_code = '$station' WHERE id = '$id'";
        if (mysqli_query($con, $station_sql)) {
            $_SESSION['status'] = "The station code " . strtoupper($station) . " has been successfully updated in the system.";
            $_SESSION['status_code'] = "success";
            header("Location: ../view/adminModule/adminData.php?tab=station");
        }
    } else {
        $_SESSION['status'] = "The station code " . strtoupper($station) . " already exists in the system.";
        $_SESSION['status_code'] = "error";
        header("Location: ../view/adminModule/adminData.php?tab=station");
    }
}

// DELETE STATION CODE
if (isset($_GET['station_id'])) {
    $id = mysqli_real_escape_string($con, $_GET['station_id']);
    $station_check = "SELECT * FROM `tbl_station_code` WHERE id = '$id'";
    $station_query = mysqli_query($con, $station_check);

    if (mysqli_num_rows($station_query) > 0) {
        $station_row = mysqli_fetch_assoc($station_query);
        $station = $station_row['station_code'];
        $station_sql = "DELETE FROM `tbl_station_code` WHERE id = '$id'";
        if (mysqli_query($con, $station_sql)) {
            $_SESSION['status'] = "The station code " . strtoupper($station) . " has been successfully deleted.";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Failed to delete station code " . strtoupper($station) . ".";
            $_SESSION['status_code'] = "error";
        }
    } else {
        $_SESSION['status'] = "Station code not found.";
        $_SESSION['status_code'] = "error";
    }

    header("Location: ../view/adminModule/adminData.php?tab=station");
    exit();
}

// INSERT WITHDRAWAL REASON
if (isset($_POST['reason_submit'])) {
    $reason = strtoupper($_POST['withdrawal_reason']);

    $reason_check = "SELECT * FROM `tbl_withdrawal_reason` WHERE reason = '$reason'";
    if (mysqli_num_rows(mysqli_query($con, $reason_check)) == 0) {
        $reason_sql = "INSERT INTO `tbl_withdrawal_reason` (reason) VALUES ('$reason')";
        if (mysqli_query($con, $reason_sql)) {
            $_SESSION['status'] = "The withdrawal reason $reason has been successfully added to the system.";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Error adding withdrawal reason.";
            $_SESSION['status_code'] = "error";
        }
    } else {
        $_SESSION['status'] = "The withdrawal reason $reason already exists in the system.";
        $_SESSION['status_code'] = "error";
    }

    header("Location: ../view/adminModule/adminData.php?tab=withdraw");
    exit();
}

// UPDATE WITHDRAWAL REASON
if (isset($_POST['reason_update'])) {
    $reason = $_POST['withdrawal_reason'];
    $id = $_POST['reason_id'];

    $reason_check = "SELECT * FROM `tbl_withdrawal_reason` WHERE reason = '$reason'";
    if (mysqli_num_rows(mysqli_query($con, $reason_check)) == 0) {
        $reason_sql = "UPDATE `tbl_withdrawal_reason` SET reason = '$reason' WHERE id = '$id'";
        if (mysqli_query($con, $reason_sql)) {
            $_SESSION['status'] = "The withdrawal reason : " . strtoupper($reason) . " has been successfully updated in the system.";
            $_SESSION['status_code'] = "success";
            header("Location: ../view/adminModule/adminData.php?tab=withdraw");
        }
    } else {
        $_SESSION['status'] = "The withdrawal reason : " . strtoupper($reason) . " already exists in the system.";
        $_SESSION['status_code'] = "error";
        header("Location: ../view/adminModule/adminData.php?tab=withdraw");
    }
}

// DELETE WITHDRAWAL REASON
if (isset($_GET['reason_id'])) {
    $id = mysqli_real_escape_string($con, $_GET['reason_id']);
    $reason_check = "SELECT * FROM `tbl_withdrawal_reason` WHERE id = '$id'";
    $reason_query = mysqli_query($con, $reason_check);

    if (mysqli_num_rows($reason_query) > 0) {
        $reason_row = mysqli_fetch_assoc($reason_query);
        $reason = $reason_row['reason'];
        $reason_sql = "DELETE FROM `tbl_withdrawal_reason` WHERE id = '$id'";
        if (mysqli_query($con, $reason_sql)) {
            $_SESSION['status'] = "The station code " . strtoupper($reason) . " has been successfully deleted.";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Failed to delete station code " . strtoupper($reason) . ".";
            $_SESSION['status_code'] = "error";
        }
    } else {
        $_SESSION['status'] = "Station code not found.";
        $_SESSION['status_code'] = "error";
    }

    header("Location: ../view/adminModule/adminData.php?tab=withdraw");
    exit();
}
?>