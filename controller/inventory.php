<?php

include "../model/dbconnection.php";
session_start();
date_default_timezone_set('Asia/Manila');

if (isset($_POST['submit_new_part'])) {
    $new_part_number = $_POST['new_part_number'];
    $new_part_desc = $_POST['new_part_desc'];
    $new_cost_center = $_POST['new_cost_center'];
    $new_location = $_POST['new_location'];
    $new_min_invent_req = $_POST['new_min_invent_req'];
    $new_unit = $_POST['new_unit'];
    $new_option = $_POST['new_option'];

    $check_part_sql = "SELECT * FROM `tbl_inventory` WHERE part_name = '$new_part_number'";
    $check_part_query = mysqli_query($con, $check_part_sql);

    if (mysqli_num_rows($check_part_query) > 0) {
        $_SESSION['status'] = "We apologize, but a part with this name already exists in the system.";
        $_SESSION['status_code'] = "error";
        header("location: ../view/adminModule/adminInventory.php");
        exit();
    } else {
        $new_part_SQL = "INSERT INTO `tbl_inventory` (part_name, part_desc, cost_center, location, min_invent_req , unit , part_option) VALUES ('$new_part_number','$new_part_desc','$new_cost_center','$new_location','$new_min_invent_req','$new_unit', '$new_option')";
        $new_part_SQL_query = mysqli_query($con, $new_part_SQL);

        if ($new_part_SQL_query) {
            $account_username = $_SESSION['username'];
            $desciption = $account_username . " has registered a new material " . $new_part_number;
            $dts = date('Y-m-d H:i:s');

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

if (isset($_POST['update_part_qty'])) {
    $dts = date('Y-m-d H:i:s');
    $part_name = $_POST['part_name'];
    $part_qty = $_POST['part_qty'];
    $exp_date = $_POST['exp_date'];
    $kitting_id = $_POST['kitting_id'];
    $lot_id = $_POST['lot_id'];
    $username = $_SESSION['username'];
    $part_id = $_POST['part_id'];

    $sqlSelect = "SELECT part_qty FROM `tbl_inventory` WHERE part_name = '$part_name'";
    $sqlSelect_query = mysqli_query($con, $sqlSelect);
    $selectRow = mysqli_fetch_assoc($sqlSelect_query);
    $part_qty_old = $selectRow['part_qty'];
    $part_desc = $_POST['part_desc'];
    $new_part_qty = $part_qty + $part_qty_old;
    $sql = "INSERT `tbl_stock` (part_name,part_qty,exp_date,kitting_id,lot_id,dts,updated_by,status) VALUES ('$part_name','$part_qty','$exp_date','$kitting_id','$lot_id','$dts','$username','Active')";

    $sql_query = mysqli_query($con, $sql);

    if ($sql_query) {

        $sql_received = "INSERT INTO `tbl_history` (dts,part_desc,part_name,part_qty,exp_date,kitting_id,lot_id,updated_by, status) VALUES ('$dts','$part_desc','$part_name','$part_qty','$exp_date','$kitting_id','$lot_id','$username','Received')";

        $sql_received_query = mysqli_query($con, $sql_received);

        if ($sql_received_query) {
            $_SESSION['status'] = "Updated successfully!";
            $_SESSION['status_code'] = "success";
            header("location: ../view/adminModule/adminInventory.php");
            exit();
        }


    } else {
        echo "Error: " . mysqli_error($con);
    }
}
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
    $total_available_stock = 0;
    $updated_part_qty = 0;

    while ($checkedRow = mysqli_fetch_assoc($check_sql_query)) {
        $part_qty_in_stock = $checkedRow['part_qty'];
        $total_available_stock += $part_qty_in_stock;
    }

    if ($total_available_stock >= $part_qty) {
        mysqli_data_seek($check_sql_query, 0);

        while ($checkedRow = mysqli_fetch_assoc($check_sql_query)) {
            $part_name = $checkedRow['part_name'];
            $part_qty_in_stock = $checkedRow['part_qty'];
            $expiration_date = $checkedRow['exp_date'];
            $min_invent_req = $checkedRow['min_invent_req'];

            if ($part_qty_remaining > 0) {
                $quantity_to_deduct = min($part_qty_remaining, $part_qty_in_stock);
                $part_qty_remaining -= $quantity_to_deduct;
                $updated_part_qty += $quantity_to_deduct;

                echo "Deducting: $quantity_to_deduct from stock with expiration: $expiration_date<br>";

                $update_stock_sql = "UPDATE tbl_stock 
                                     SET part_qty = part_qty - $quantity_to_deduct
                                     WHERE part_name = '$part_name' AND exp_date = '$expiration_date'";

                if (!mysqli_query($con, $update_stock_sql)) {
                    echo "Error updating stock: " . mysqli_error($con) . "<br>";
                }
            }
        }

        if ($part_qty_remaining <= 0) {
            $sql = "INSERT INTO `tbl_requested` (dts, part_name, lot_id, part_desc, station_code, part_qty, machine_no, with_reason, req_by, status, cost_center, part_option) 
                    VALUES ('$dts', '$part_name', '$lot_id', '$part_desc', '$station_code', '$part_qty', '$machine_no', '$with_reason', '$req_by', '$status', '$cost_center', '$part_option')";

            if (mysqli_query($con, $sql)) {
                $mensahe = $req_by . ' has requested ' . $part_qty . ' of ' . $part_name . '. Click here for more details.';
                $for = "admin";

                $sql_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) 
                              VALUES ('$req_by', '$mensahe', 0, '$dts', '$for', 'Approval')";
                if (mysqli_query($con, $sql_notif)) {
                    // Check if the total available stock is below the minimum inventory requirement after the request
                    $check_min_inventory_sql = "SELECT ti.min_invent_req FROM tbl_inventory ti WHERE ti.part_name = '$part_name'";
                    $min_invent_req_query = mysqli_query($con, $check_min_inventory_sql);
                    $min_invent_req_row = mysqli_fetch_assoc($min_invent_req_query);
                    $min_invent_req = $min_invent_req_row['min_invent_req'];

                    // Recalculate total available stock after the request
                    $total_available_stock -= $updated_part_qty;

                    if ($total_available_stock < $min_invent_req) {
                        $mensahe_system = htmlspecialchars($part_name, ENT_QUOTES, 'UTF-8') . ' has reached the minimum inventory level and needs restocking.';
                        $update_admin_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) 
                                               VALUES ('System', '$mensahe_system', 0, '$dts', '$for', 'Inventory')";
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
            } else {
                echo "Error inserting request: " . mysqli_error($con) . "<br>";
            }
        } else {
            $_SESSION['status'] = "The quantity for this part is insufficient.";
            $_SESSION['status_code'] = "error";
            header("location: ../view/userModule/userDashboard.php");
            exit();
        }
    } else {
        $_SESSION['status'] = "The quantity for this part is insufficient.";
        $_SESSION['status_code'] = "error";
        header("location: ../view/userModule/userDashboard.php");
        exit();
    }
}

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

    $check_sql = "SELECT ts.part_name, ts.part_qty, ts.exp_date, ti.min_invent_req
                    FROM tbl_stock ts
                    LEFT JOIN tbl_inventory ti ON ts.part_name = ti.part_name
                    WHERE ts.part_name = '$part_id' AND status = 'Active'
                    ORDER BY ts.exp_date ASC";

    $check_sql_query = mysqli_query($con, $check_sql);
    $part_qty_remaining = $part_qty;
    $total_available_stock = 0;
    $updated_part_qty = 0;

    while ($checkedRow = mysqli_fetch_assoc($check_sql_query)) {
        $part_qty_in_stock = $checkedRow['part_qty'];
        $total_available_stock += $part_qty_in_stock;
    }

    if ($total_available_stock >= $part_qty) {
        mysqli_data_seek($check_sql_query, 0);

        while ($checkedRow = mysqli_fetch_assoc($check_sql_query)) {
            $part_name = $checkedRow['part_name'];
            $part_qty_in_stock = $checkedRow['part_qty'];
            $expiration_date = $checkedRow['exp_date'];
            $min_invent_req = $checkedRow['min_invent_req'];

            if ($part_qty_remaining > 0) {
                $quantity_to_deduct = min($part_qty_remaining, $part_qty_in_stock);
                $part_qty_remaining -= $quantity_to_deduct;
                $updated_part_qty += $quantity_to_deduct;

                echo "Deducting: $quantity_to_deduct from stock with expiration: $expiration_date<br>";

                $update_stock_sql = "UPDATE tbl_stock 
                                     SET part_qty = part_qty - $quantity_to_deduct
                                     WHERE part_name = '$part_name' AND exp_date = '$expiration_date'";

                if (!mysqli_query($con, $update_stock_sql)) {
                    echo "Error updating stock: " . mysqli_error($con) . "<br>";
                }
            }
        }

        if ($part_qty_remaining <= 0) {
            $sql = "INSERT INTO `tbl_requested` (dts, part_name, lot_id, part_desc, station_code, part_qty, machine_no, with_reason, req_by, status, cost_center, part_option) 
                    VALUES ('$dts', '$part_name', '$lot_id', '$part_desc', '$station_code', '$part_qty', '$machine_no', '$with_reason', '$req_by', '$status', '$cost_center', '$part_option')";

            if (mysqli_query($con, $sql)) {
                $mensahe = $req_by . ' has requested ' . $part_qty . ' of ' . $part_name . '. Click here for more details.';
                $for = "admin";

                $sql_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) 
                              VALUES ('$req_by', '$mensahe', 0, '$dts', '$for', 'Approval')";
                if (mysqli_query($con, $sql_notif)) {
                    $check_min_inventory_sql = "SELECT ti.min_invent_req FROM tbl_inventory ti WHERE ti.part_name = '$part_name'";
                    $min_invent_req_query = mysqli_query($con, $check_min_inventory_sql);
                    $min_invent_req_row = mysqli_fetch_assoc($min_invent_req_query);
                    $min_invent_req = $min_invent_req_row['min_invent_req'];

                    $total_available_stock -= $updated_part_qty;

                    if ($total_available_stock < $min_invent_req) {
                        $mensahe_system = htmlspecialchars($part_name, ENT_QUOTES, 'UTF-8') . ' has reached the minimum inventory level and needs restocking.';
                        $update_admin_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) 
                                               VALUES ('System', '$mensahe_system', 0, '$dts', '$for', 'Inventory')";
                        if (mysqli_query($con, $update_admin_notif)) {
                            $_SESSION['status'] = "Request sent successfully!";
                            $_SESSION['status_code'] = "success";
                            header("location: ../view/adminModule/adminInventory.php");
                            exit();
                        }
                    } else {
                        $_SESSION['status'] = "Request sent successfully!";
                        $_SESSION['status_code'] = "success";
                        header("location: ../view/adminModule/adminInventory.php");
                        exit();
                    }
                }
            } else {
                echo "Error inserting request: " . mysqli_error($con) . "<br>";
            }
        } else {
            $_SESSION['status'] = "The quantity for this part is insufficient.";
            $_SESSION['status_code'] = "error";
            header("location: ../view/adminModule/adminInventory.php");
            exit();
        }
    } else {
        $_SESSION['status'] = "The quantity for this part is insufficient.";
        $_SESSION['status_code'] = "error";
        header("location: ../view/adminModule/adminInventory.php");
        exit();
    }
}



if (isset($_POST['action']) && $_POST['action'] === 'delete_selected' && isset($_POST['ids'])) {
    $ids = $_POST['ids'];
    $qty = $_POST['qty'];
    $part_names = $_POST['part_name'];

    for ($i = 0; $i < count($ids); $i++) {
        $id = $ids[$i];
        $current_qty = $qty[$i];
        $current_part_name = $part_names[$i];

        $sql = "DELETE FROM tbl_requested WHERE id = $id";
        $delete_result = mysqli_query($con, $sql);

        if ($delete_result) {

            $update_inventory_sql = "UPDATE tbl_inventory SET part_qty = part_qty + $current_qty WHERE part_name = '$current_part_name'";
            mysqli_query($con, $update_inventory_sql);
        } else {
            echo "Error deleting record with ID: $id";
            exit;
        }
    }

}

if (isset($_POST['delete_multiple']) && isset($_POST['selected_items'])) {
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
} else {
    echo json_encode([
        'success' => false,
        'message' => 'No items selected for deletion.'
    ]);
}





if (isset($_POST['update_namedesc'])) {
    $part_id = $_POST['id'];
    $part_name = $_POST['part_name'];
    $part_desc = $_POST['part_desc'];
    $part_cost_center = $_POST['cost_center'];
    $part_location = $_POST['location'];
    $part_min_invent_req = $_POST['min_invent_req'];
    $part_unit = $_POST['unit'];
    $part_option = $_POST['part_option'];

    $sql = "UPDATE `tbl_inventory` SET part_name = '$part_name' , part_desc = '$part_desc' , cost_center = '$part_cost_center' , location = '$part_location' , min_invent_req = '$part_min_invent_req' , unit = '$part_unit' , part_option = '$part_option' WHERE id = '$part_id'";
    $sql_query = mysqli_query($con, $sql);
    if ($sql_query) {

        $account_username = $_SESSION['username'];
        $desciption = $account_username . " has updated the details of material " . $part_name;
        $dts = date('Y-m-d H:i:s');

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