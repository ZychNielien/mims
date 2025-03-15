<?php
// Database Connection
include "../model/dbconnection.php";

// Session Start
session_start();

// Manila Time Zone
date_default_timezone_set('Asia/Manila');

// Admin Submit New Part Number
if (isset($_POST['submit_new_part'])) {
    $new_part_number = $_POST['new_part_number'];
    $new_part_desc = $_POST['new_part_desc'];
    $new_cost_center = $_POST['new_cost_center'];
    $new_location = $_POST['new_location'];
    $new_min_invent_req = $_POST['new_min_invent_req'];
    $new_unit = $_POST['new_unit'];
    $new_option = $_POST['new_option'];

    // Checking if there's an Existing Part Number
    $check_part_sql = "SELECT * FROM `tbl_inventory` WHERE part_name = '$new_part_number'";
    $check_part_query = mysqli_query($con, $check_part_sql);

    if (mysqli_num_rows($check_part_query) > 0) {
        $_SESSION['status'] = "We apologize, but a part with this name already exists in the system.";
        $_SESSION['status_code'] = "error";
        header("location: ../view/adminModule/adminInventory.php");
        exit();
    } else {

        // Inserting New Part Number in Inventory Table
        $new_part_SQL = "INSERT INTO `tbl_inventory` (part_name, part_desc, cost_center, location, min_invent_req , unit , part_option) VALUES ('$new_part_number','$new_part_desc','$new_cost_center','$new_location','$new_min_invent_req','$new_unit', '$new_option')";
        $new_part_SQL_query = mysqli_query($con, $new_part_SQL);

        if ($new_part_SQL_query) {
            $account_username = $_SESSION['username'];
            $desciption = $account_username . " has registered a new material " . $new_part_number;
            $dts = date('Y-m-d H:i:s');

            // Inserting Log 
            $sql_log = "INSERT INTO `tbl_log` (username, action, description, dts) VALUES ('$account_username', 'Material Registration','$desciption' , '$dts')";
            $sql_log_query = mysqli_query($con, $sql_log);

            if ($sql_log_query) {
                $_SESSION['status'] = "The new part has been successfully added";
                $_SESSION['status_code'] = "success";
                header("location: ../view/adminModule/adminInventory.php");
                exit();
            }
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
}

// Admin Update Stocks
if (isset($_POST['update_part_qty'])) {
    $dts = date('Y-m-d H:i:s');
    $part_name = $_POST['part_name'];
    $part_qty = $_POST['part_qty'];
    $exp_date = $_POST['exp_date'];
    $kitting_id = $_POST['kitting_id'];
    $lot_id = $_POST['lot_id'];
    $username = $_SESSION['username'];
    $part_id = $_POST['part_id'];
    $part_desc = $_POST['part_desc'];
    $username = $_SESSION['username'];

    // Check if Part Number already exists with the same part_name and exp_date
    $sqlSelect = "SELECT part_qty FROM `tbl_stock` WHERE part_name = '$part_name' AND exp_date = '$exp_date' AND status = 'Active'";
    $sqlSelect_query = mysqli_query($con, $sqlSelect);

    if ($sqlSelect_query && mysqli_num_rows($sqlSelect_query) > 0) {
        // If the part exists, update the quantity
        $selectRow = mysqli_fetch_assoc($sqlSelect_query);
        $part_qty_old = $selectRow['part_qty'];
        $new_part_qty = $part_qty + $part_qty_old;

        // Update the existing record with the new quantity
        $update_sql = "UPDATE `tbl_stock` 
                       SET part_qty = '$new_part_qty', updated_by = '$username', dts = '$dts'
                       WHERE part_name = '$part_name' AND exp_date = '$exp_date' AND status = 'Active'";

        $update_sql_query = mysqli_query($con, $update_sql);

        if ($update_sql_query) {
            // Insert into history after updating the stock
            $sql_received = "INSERT INTO `tbl_history` (dts, part_desc, part_name, part_qty, exp_date, kitting_id, lot_id, updated_by, status) 
                             VALUES ('$dts', '$part_desc', '$part_name', '$part_qty', '$exp_date', '$kitting_id', '$lot_id', '$username', 'Received')";

            $sql_received_query = mysqli_query($con, $sql_received);

            if ($sql_received_query) {
                $mensahe = $username . " has updated the inventory for " . $part_name . " with an addition of " . $part_qty . " items.";

                $sql_log = "INSERT INTO tbl_log (username, action, description,dts) VALUES ('$username','Update Inventory','$mensahe','$dts')";
                $sql_log_query = mysqli_query($con, $sql_log);

                if ($sql_log_query) {
                    $_SESSION['status'] = "Updated successfully!";
                    $_SESSION['status_code'] = "success";
                    header("location: ../view/adminModule/adminInventory.php");
                    exit();
                }

            } else {
                echo "Error inserting into history: " . mysqli_error($con);
            }
        } else {
            echo "Error updating stock: " . mysqli_error($con);
        }
    } else {
        // If the part doesn't exist, insert it as a new record
        $sql = "INSERT INTO `tbl_stock` (part_name, part_qty, exp_date, kitting_id, lot_id, dts, updated_by, status) 
                VALUES ('$part_name', '$part_qty', '$exp_date', '$kitting_id', '$lot_id', '$dts', '$username', 'Active')";

        $sql_query = mysqli_query($con, $sql);

        if ($sql_query) {
            // Insert into history after inserting the new stock
            $sql_received = "INSERT INTO `tbl_history` (dts, part_desc, part_name, part_qty, exp_date, kitting_id, lot_id, updated_by, status) 
                             VALUES ('$dts', '$part_desc', '$part_name', '$part_qty', '$exp_date', '$kitting_id', '$lot_id', '$username', 'Received')";

            $sql_received_query = mysqli_query($con, $sql_received);

            if ($sql_received_query) {
                $mensahe = $username . " has updated the inventory for " . $part_name . " with an addition of " . $part_qty . " items.";

                $sql_log = "INSERT INTO tbl_log (username, action, description,dts) VALUES ('$username','Update Inventory','$mensahe','$dts')";
                $sql_log_query = mysqli_query($con, $sql_log);

                if ($sql_log_query) {
                    $_SESSION['status'] = "Updated successfully!";
                    $_SESSION['status_code'] = "success";
                    header("location: ../view/adminModule/adminInventory.php");
                    exit();
                }

            } else {
                echo "Error inserting into history: " . mysqli_error($con);
            }
        } else {
            echo "Error inserting stock: " . mysqli_error($con);
        }
    }
}

// Admin Withdrawal Request
if (isset($_POST['mat_req_part'])) {
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

    // Checking stock details for the requested Part Number
    $check_sql = "SELECT ts.part_name, ts.part_qty, ts.exp_date, ti.min_invent_req
                    FROM tbl_stock ts
                    LEFT JOIN tbl_inventory ti ON ts.part_name = ti.part_name
                    WHERE ts.part_name = '$part_id' AND status = 'Active'
                    ORDER BY ts.exp_date ASC";

    $check_sql_query = mysqli_query($con, $check_sql);
    $part_qty_remaining = $part_qty;
    $updated_part_qty = 0;
    $expiration_data = [];

    // Fetch available stock and expiration dates
    while ($checkedRow = mysqli_fetch_assoc($check_sql_query)) {
        $expiration_data[] = [
            'part_qty' => $checkedRow['part_qty'],
            'exp_date' => $checkedRow['exp_date']
        ];
    }

    // Check if total available stock is sufficient
    $total_available_stock = array_sum(array_column($expiration_data, 'part_qty'));

    if ($total_available_stock >= $part_qty) {
        foreach ($expiration_data as $data) {
            $part_qty_in_stock = $data['part_qty'];
            $expiration_date = $data['exp_date'];

            if ($part_qty_remaining > 0 && $part_qty_in_stock > 0) {
                // Deduct the quantity from this batch
                $quantity_to_deduct = min($part_qty_remaining, $part_qty_in_stock);
                $part_qty_remaining -= $quantity_to_deduct;
                $updated_part_qty += $quantity_to_deduct;

                // Update the stock table for the deduction
                $update_stock_sql = "UPDATE tbl_stock 
                                     SET part_qty = part_qty - $quantity_to_deduct
                                     WHERE part_name = '$part_id' AND exp_date = '$expiration_date'";

                if (!mysqli_query($con, $update_stock_sql)) {
                    echo "Error updating stock: " . mysqli_error($con) . "<br>";
                }

                // Insert into tbl_requested for each deduction
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

            // Insert notification for the admin
            $sql_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) 
                          VALUES ('$req_by', '$mensahe', 0, '$dts', '$for', 'Approval')";
            if (mysqli_query($con, $sql_notif)) {
                $check_min_inventory_sql = "SELECT ti.min_invent_req FROM tbl_inventory ti WHERE ti.part_name = '$part_id'";
                $min_invent_req_query = mysqli_query($con, $check_min_inventory_sql);
                $min_invent_req_row = mysqli_fetch_assoc($min_invent_req_query);
                $min_invent_req = $min_invent_req_row['min_invent_req'];

                $total_available_stock -= $updated_part_qty;

                // After inserting requests, check if minimum inventory level is reached
                if ($total_available_stock < $min_invent_req) {
                    $mensahe_system = htmlspecialchars($part_id, ENT_QUOTES, 'UTF-8') . ' has reached the minimum inventory level and needs restocking.';

                    // Insert Reach Minimum Requirement notification for the admin
                    $update_admin_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) 
                                           VALUES ('System', '$mensahe_system', 0, '$dts', 'admin', 'Inventory')";
                    if (mysqli_query($con, $update_admin_notif)) {
                        $_SESSION['status'] = "Request sent successfully!";
                        $_SESSION['status_code'] = "success";
                        header("location: ../view/adminModule/adminWithdrawal.php");
                        exit();
                    }
                } else {
                    $_SESSION['status'] = "Request sent successfully!";
                    $_SESSION['status_code'] = "success";
                    header("location: ../view/adminModule/adminWithdrawal.php");
                    exit();
                }
            }
        }
    } else {
        $_SESSION['status'] = "The quantity for this part is insufficient.";
        $_SESSION['status_code'] = "error";
        header("location: ../view/adminModule/adminWithdrawal.php");
        exit();
    }
}

// Admin Deleting 
if (isset($_POST['delete_multiple']) && isset($_POST['selected_items'])) {

    $username = $_SESSION['username'];
    $check_type = "SELECT account_type FROM `tbl_users` WHERE username = '$username'";
    $check_type_query = mysqli_query($con, $check_type);
    $checked_row = mysqli_fetch_assoc($check_type_query);

    if ($checked_row['account_type'] == 'Kitting') {
        echo json_encode([
            'success' => false,
            'message' => 'I apologize, but this function is exclusively available to supervisors.'
        ]);

    } else {
        $selected_items = json_decode($_POST['selected_items']);

        $ids = implode(",", array_map('intval', $selected_items));

        foreach ($selected_items as $item_id) {
            $sql_user = "SELECT part_name FROM `tbl_inventory` WHERE id = $item_id";
            $sql_user_query = mysqli_query($con, $sql_user);

            if ($sql_user_query) {
                $userRow = mysqli_fetch_assoc($sql_user_query);

                if ($userRow && isset($userRow['part_name'])) {
                    $part_name = $userRow['part_name'];

                    $account_username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Unknown User';

                    $description = $account_username . " has deleted " . $part_name;
                    $dts = date('Y-m-d H:i:s');

                    $sql_log = "INSERT INTO `tbl_log` (username, action, description, dts) 
                                VALUES ('$account_username', 'Material Deletion', '$description', '$dts')";

                    if (!mysqli_query($con, $sql_log)) {
                        error_log("Failed to insert log: " . mysqli_error($con) . " SQL: $sql_log");
                        echo "Error: " . mysqli_error($con);
                    }
                } else {
                    error_log("No part_name found for ID: $item_id");
                }
            } else {
                error_log("Query failed for item ID $item_id: " . mysqli_error($con));
                echo "Query error: " . mysqli_error($con);
            }
        }

        $sql_delete = "DELETE FROM `tbl_inventory` WHERE `id` IN ($ids)";

        if (mysqli_query($con, $sql_delete)) {
            echo json_encode([
                'success' => true,
                'message' => 'Selected items deleted successfully.'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Error deleting items: ' . mysqli_error($con)
            ]);
        }
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'No items selected for deletion.'
    ]);
}

// Update Part Number Details
if (isset($_POST['update_namedesc'])) {
    $part_id = $_POST['id'];
    $part_name = $_POST['part_name'];
    $part_desc = $_POST['part_desc'];
    $part_cost_center = $_POST['cost_center'];
    $part_location = $_POST['location'];
    $part_min_invent_req = $_POST['min_invent_req'];
    $part_unit = $_POST['unit'];
    $part_option = $_POST['part_option'];

    // Updating Part Number Details
    $sql = "UPDATE `tbl_inventory` SET part_name = '$part_name' , part_desc = '$part_desc' , cost_center = '$part_cost_center' , location = '$part_location' , min_invent_req = '$part_min_invent_req' , unit = '$part_unit' , part_option = '$part_option' WHERE id = '$part_id'";
    $sql_query = mysqli_query($con, $sql);
    if ($sql_query) {

        $account_username = $_SESSION['username'];
        $desciption = $account_username . " has updated the details of material " . $part_name;
        $dts = date('Y-m-d H:i:s');

        // Inserting Log
        $sql_log = "INSERT INTO `tbl_log` (username, action, description, dts) VALUES ('$account_username', 'Edit Material Details','$desciption' , '$dts')";
        $sql_log_query = mysqli_query($con, $sql_log);

        if ($sql_log_query) {
            $_SESSION['status'] = "Updated successfully!";
            $_SESSION['status_code'] = "success";
            header("location: ../view/adminModule/adminInventory.php");
            exit();
        }
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

?>