<?php

include "../model/dbconnection.php";
session_start();
date_default_timezone_set('Asia/Manila');

// Material Deletion for Admin
if (isset($_POST['selected_ids']) && isset($_POST['part_quantities']) && isset($_POST['part_names']) && isset($_POST['exp_dates'])) {

    $selectedIds = $_POST['selected_ids'];
    $partQuantities = $_POST['part_quantities'];
    $partNames = $_POST['part_names'];
    $expDates = $_POST['exp_dates'];

    $total_quantity_to_add = 0;

    for ($i = 0; $i < count($selectedIds); $i++) {
        $id = $selectedIds[$i];
        $quantity = $partQuantities[$i];
        $part_name = $partNames[$i];
        $expDate = $expDates[$i];
        $total_quantity_to_add += $quantity;

        $sql = "DELETE FROM tbl_requested WHERE id = $id";
        $delete_result = mysqli_query($con, $sql);

        if (!$delete_result) {
            echo "Error deleting record with ID: $id";
            exit;
        }

        $update_inventory_sql = "UPDATE tbl_stock SET part_qty = part_qty + $quantity WHERE part_name = '$part_name' AND exp_date = '$expDate' ";
        $update_result = mysqli_query($con, $update_inventory_sql);


        if ($update_result) {
            $username = $_SESSION['username'];
            $dts = date('Y-m-d H:i:s');
            $mensahe = $username . " has canceled the withdrawal request for the " . $part_name . " with a quantity of " . $quantity . ".";
            $update_admin_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) 
            VALUES ('$username', '$mensahe', 0, '$dts', 'admin', 'Inventory')";
            if (mysqli_query($con, $update_admin_notif)) {
                $_SESSION['status'] = "Your material withdrawal request has been successfully deleted.";
                $_SESSION['status_code'] = "success";
                header("location: ../view/adminModule/adminWithdrawal.php");
                exit();
            }
        }
        if (!$update_result) {
            echo "Error updating inventory for part: $part_name";
            exit;
        }
    }

} else {
    $_SESSION['status'] = "No material withdrawal request for deletion";
    $_SESSION['status_code'] = "warning";
    header("location: ../view/adminModule/adminWithdrawal.php");
    exit();
}
?>