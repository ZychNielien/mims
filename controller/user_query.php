<?php

// Session Start
session_start();

// Database Connection
include "../model/dbconnection.php";

// Manila Time Zone
date_default_timezone_set('Asia/Manila');

// USER REQUEST WITHDRAWAL
if (isset($_POST['req_part'])) {
    $part_id = $_POST['part_name'];
    $dts = date('Y-m-d H:i:s');
    $lot_id = $_POST['lot_id'];
    $part_desc = $_POST['part_desc'];
    $station_code = $_POST['station_code'];
    $part_qty = $_POST['part_qty'];
    $machine_no = $_POST['machine_no'];
    $with_reason = $_POST['with_reason'];
    $req_by = $_POST['req_by'];
    $status = 'Pending';
    $cost_center = $_POST['cost_center'];
    $part_option = $_POST['part_option'];

    $check_sql = "SELECT ts.part_name, ts.part_qty, ts.exp_date, ti.min_invent_req
                    FROM tbl_stock ts
                    LEFT JOIN tbl_inventory ti ON ts.part_name = ti.part_name
                    WHERE ts.part_name = '$part_id' AND status = 'Active'
                    ORDER BY ts.exp_date ASC";

    $check_sql_query = mysqli_query($con, $check_sql);
    $part_qty_remaining = $part_qty;
    $updated_part_qty = 0;
    $expiration_data = [];

    while ($checkedRow = mysqli_fetch_assoc($check_sql_query)) {
        $expiration_data[] = [
            'part_qty' => $checkedRow['part_qty'],
            'exp_date' => $checkedRow['exp_date']
        ];
    }

    $total_available_stock = array_sum(array_column($expiration_data, 'part_qty'));

    if ($total_available_stock >= $part_qty) {
        foreach ($expiration_data as $data) {
            $part_qty_in_stock = $data['part_qty'];
            $expiration_date = $data['exp_date'];

            if ($part_qty_remaining > 0 && $part_qty_in_stock > 0) {

                $quantity_to_deduct = min($part_qty_remaining, $part_qty_in_stock);
                $part_qty_remaining -= $quantity_to_deduct;
                $updated_part_qty += $quantity_to_deduct;

                $update_stock_sql = "UPDATE tbl_stock 
                                     SET part_qty = part_qty - $quantity_to_deduct
                                     WHERE part_name = '$part_id' AND exp_date = '$expiration_date'";

                if (!mysqli_query($con, $update_stock_sql)) {
                    echo "Error updating stock: " . mysqli_error($con) . "<br>";
                }

                $sql = "INSERT INTO `tbl_requested` (dts, part_name, lot_id, part_desc, station_code, part_qty, machine_no, with_reason, req_by, status, cost_center, part_option, exp_date) 
                        VALUES ('$dts', '$part_id', '$lot_id', '$part_desc', '$station_code', '$quantity_to_deduct', '$machine_no', '$with_reason', '$req_by', '$status', '$cost_center', '$part_option', '$expiration_date')";

                if (!mysqli_query($con, $sql)) {
                    echo "Error inserting request: " . mysqli_error($con) . "<br>";
                }
            }
        }

        if ($part_qty_remaining <= 0) {
            $mensahe = $req_by . ' has requested ' . $part_qty . ' of ' . $part_id . '. Click here for more details.';
            $for = "admin";

            $sql_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) 
                          VALUES ('$req_by', '$mensahe', 0, '$dts', '$for', 'Approval')";
            if (mysqli_query($con, $sql_notif)) {
                $check_min_inventory_sql = "SELECT ti.min_invent_req FROM tbl_inventory ti WHERE ti.part_name = '$part_id'";
                $min_invent_req_query = mysqli_query($con, $check_min_inventory_sql);
                $min_invent_req_row = mysqli_fetch_assoc($min_invent_req_query);
                $min_invent_req = $min_invent_req_row['min_invent_req'];

                $total_available_stock -= $updated_part_qty;

                if ($total_available_stock < $min_invent_req) {
                    $mensahe_system = htmlspecialchars($part_id, ENT_QUOTES, 'UTF-8') . ' has reached the minimum inventory level and needs restocking.';
                    $update_admin_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) 
                                           VALUES ('System', '$mensahe_system', 0, '$dts', 'admin', 'Inventory')";
                    if (mysqli_query($con, $update_admin_notif)) {
                        $_SESSION['status'] = "Request sent successfully!";
                        $_SESSION['status_code'] = "success";
                        header("location: ../view/userModule/userDashboard.php");
                        exit();
                    }
                } else {
                    $_SESSION['status'] = "Request sent successfully!";
                    $_SESSION['status_code'] = "success";
                    header("location: ../view/userModule/userDashboard.php");
                    exit();
                }
            }
        }
    } else {
        $_SESSION['status'] = "The quantity for this part is insufficient.";
        $_SESSION['status_code'] = "error";
        header("location: ../view/userModule/userDashboard.php");
        exit();
    }
}

// USER DELETE WITHDRAWAL REQUEST
if (isset($_POST['selected_ids']) && isset($_POST['part_quantities']) && isset($_POST['part_names']) && isset($_POST['exp_dates'])) {
    $selectedIds = $_POST['selected_ids'];
    $partQuantities = $_POST['part_quantities'];
    $partNames = $_POST['part_names'];
    $expDates = $_POST['exp_dates'];
    $username = $_SESSION['username'];
    $dts = date('Y-m-d H:i:s');
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
            $mensahe = $username . " has canceled the withdrawal request for the " . $part_name . " with a quantity of " . $quantity . ".";
            $update_admin_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) 
            VALUES ('$username', '$mensahe', 0, '$dts', 'admin', 'Inventory')";
            if (mysqli_query($con, $update_admin_notif)) {
                $_SESSION['status'] = "Your material withdrawal request has been successfully deleted.";
                $_SESSION['status_code'] = "success";
                header("location: ../view/userModule/userDashboard.php");
                exit();
            }
        }

        if (!$update_result) {
            echo "Error updating inventory for part: $part_name";
            exit;
        }
    }


}

// USER RETURNING ITEM WITHDREW
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lot_id = $_POST['lot_id'];
    $return_qty = $_POST['return_qty'];
    $return_reason = $_POST['return_reason'];
    $dts = date('Y-m-d H:i:s');
    $req_by = $_POST['req_by'];
    $part_name = $_POST['part_name'];
    $mensahe = $req_by . ' is returning ' . $return_qty . ' of ' . $part_name . '. Click here for more details.';
    $for = "admin";

    if ($return_qty <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid quantity.']);
        exit();
    }

    $sql = "UPDATE tbl_requested 
            SET status = 'returning', return_reason = '$return_reason', dts_return = '$dts', return_qty = '$return_qty'
            WHERE id = '$lot_id' AND status = 'approved'";

    if (mysqli_query($con, $sql)) {
        $sql_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at,for_who, destination) VALUES ('$req_by', '$mensahe',0,'$dts','$for', 'Scrap')";
        $sql_notif_query = mysqli_query($con, $sql_notif);

        if ($sql_notif_query) {
            echo json_encode(['status' => 'success', 'message' => 'You are now authorized to return the ' . $part_name . ' with a quantity of ' . $return_qty]);
        }

    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error updating item: ' . mysqli_error($con)]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>