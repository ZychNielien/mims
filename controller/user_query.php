<?php

session_start();
include "../model/dbconnection.php";
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

    $check_sql = "SELECT ts.part_name, ts.part_qty, ts.exp_date, ti.min_invent_req, ts.batch_number, ti.approver, ts.item_code
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
            'exp_date' => $checkedRow['exp_date'],
            'batch_number' => $checkedRow['batch_number'],
            'item_code' => $checkedRow['item_code'],
            'approver' => $checkedRow['approver'],
        ];
    }

    $total_available_stock = array_sum(array_column($expiration_data, 'part_qty'));

    if ($total_available_stock >= $part_qty) {
        foreach ($expiration_data as $data) {
            $part_qty_in_stock = $data['part_qty'];
            $expiration_date = $data['exp_date'];
            $batch_number = $data['batch_number'];
            $item_code = $data['item_code'];

            if ($part_qty_remaining > 0 && $part_qty_in_stock > 0) {

                $quantity_to_deduct = min($part_qty_remaining, $part_qty_in_stock);
                $part_qty_remaining -= $quantity_to_deduct;
                $updated_part_qty += $quantity_to_deduct;

                $update_stock_sql = "UPDATE tbl_stock 
                                     SET part_qty = part_qty - $quantity_to_deduct
                                     WHERE part_name = '$part_id' AND exp_date = '$expiration_date' AND batch_number = '$batch_number' AND item_code = '$item_code'";

                if (!mysqli_query($con, $update_stock_sql)) {
                    echo "Error updating stock: " . mysqli_error($con) . "<br>";
                }

                $sql = "INSERT INTO `tbl_requested` (dts, part_name, lot_id, part_desc, station_code, part_qty, machine_no, with_reason, req_by, status, cost_center, part_option, exp_date, batch_number) 
                        VALUES ('$dts', '$part_id', '$lot_id', '$part_desc', '$station_code', '$quantity_to_deduct', '$machine_no', '$with_reason', '$req_by', '$status', '$cost_center', '$part_option', '$expiration_date','$batch_number')";

                if (!mysqli_query($con, $sql)) {
                    echo "Error inserting request: " . mysqli_error($con) . "<br>";
                }
            }
        }

        if ($part_qty_remaining <= 0) {
            $approver = $data['approver'];
            $mensahe = $req_by . ' has requested ' . $part_qty . ' of ' . $part_id . '. Click here for more details.';
            $for = $approver;

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
if (isset($_POST['delete_submit'])) {
    if (isset($_POST['ids']) && isset($_POST['part_names']) && isset($_POST['quantities']) && isset($_POST['exp_dates']) && isset($_POST['batch_numbers']) && isset($_POST['item_codes'])) {
        $ids = $_POST['ids'];
        $part_names = $_POST['part_names'];
        $quantities = $_POST['quantities'];
        $exp_dates = $_POST['exp_dates'];
        $username = $_SESSION['username'];
        $batch_numbers = $_POST['batch_numbers'];
        $item_codes = $_POST['item_codes'];
        $success = true;

        for ($i = 0; $i < count($ids); $i++) {
            $id = intval($ids[$i]);
            $quantity = intval($quantities[$i]);
            $current_part_name = $part_names[$i];
            $exp_date = $exp_dates[$i];
            $batch_number = $batch_numbers[$i];
            $item_code = $item_codes[$i];
            $dts = date('Y-m-d H:i:s');
            $mensahe = $username . " has canceled the withdrawal request for the " . $current_part_name . " with a quantity of " . $quantity . ".";

            $select = "SELECT approver FROM tbl_inventory WHERE part_name = '$current_part_name'";
            $select_query = mysqli_query($con, $select);
            $selectedApprover = mysqli_fetch_assoc($select_query);
            $approver = $selectedApprover['approver'];

            $delete_req = "DELETE FROM `tbl_requested` WHERE id = '$id'";
            if (mysqli_query($con, $delete_req)) {

                $update_Stock = "UPDATE `tbl_stock` SET part_qty = part_qty + '$quantity' WHERE part_name = '$current_part_name' AND exp_date = '$exp_date' AND batch_number = '$batch_number' AND item_code = '$item_code'";
                if (!mysqli_query($con, $update_Stock)) {
                    $success = false;
                    break;

                }
                $update_admin_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) 
                VALUES ('$username', '$mensahe', 0, '$dts', '$approver', 'Inventory')";
                if (!mysqli_query($con, $update_admin_notif)) {
                    $success = false;
                    break;

                }
            }
        }

        echo json_encode(["success" => $success]);
    } else {
        echo json_encode(["success" => false, "error" => "Missing data"]);
    }
}

// USER UPDATE WITHDRAWAL REQUEST
if (isset($_POST['update_submit'])) {
    if (isset($_POST['ids']) && isset($_POST['part_names']) && isset($_POST['quantities']) && isset($_POST['exp_dates']) && isset($_POST['machines']) && isset($_POST['with_reasons']) && isset($_POST['batch_numbers']) && isset($_POST['item_codes'])) {
        $ids = $_POST['ids'];
        $part_names = $_POST['part_names'];
        $quantities = $_POST['quantities'];
        $exp_dates = $_POST['exp_dates'];
        $machines = $_POST['machines'];
        $with_reasons = $_POST['with_reasons'];
        $batch_numbers = $_POST['batch_numbers'];
        $item_codes = $_POST['item_codes'];
        $success = true;

        for ($i = 0; $i < count($ids); $i++) {
            $id = intval($ids[$i]);
            $quantity = intval($quantities[$i]);
            $part_name = $part_names[$i];
            $exp_date = $exp_dates[$i];
            $machine = $machines[$i];
            $batch_number = $batch_numbers[$i];
            $item_code = $item_codes[$i];
            $with_reason = $with_reasons[$i];

            $selectedID = "SELECT * FROM `tbl_requested` WHERE id = '$id'";
            $selectedID_query = mysqli_query($con, $selectedID);
            if ($selectedID_query) {
                while ($selectedRow = mysqli_fetch_assoc($selectedID_query)) {
                    $selectQty = $selectedRow['part_qty'];


                    if ($selectQty > $quantity) {
                        $totalQty = $selectQty - $quantity;

                        $update_request = "UPDATE `tbl_requested` SET part_qty = '$quantity' , machine_no = '$machine' , with_reason = '$with_reason' WHERE id = '$id'";
                        if (!mysqli_query($con, $update_request)) {
                            echo json_encode(["success" => false, "error" => "Failed to update stock"]);
                            exit;
                        }
                        $update_stock = "UPDATE `tbl_stock` SET part_qty = part_qty + $totalQty WHERE part_name = '$part_name' AND exp_date = '$exp_date' AND batch_number = '$batch_number' AND item_code = '$item_code'";
                        if (!mysqli_query($con, $update_stock)) {
                            echo json_encode(["success" => false, "error" => "Failed to update stock"]);
                            exit;
                        }
                    } else if ($selectQty < $quantity) {
                        $totalQty = $quantity - $selectQty;

                        $select_stock = "SELECT part_qty FROM `tbl_stock` WHERE part_name = '$part_name' AND exp_date = '$exp_date' AND batch_number = '$batch_number' AND item_code = '$item_code'";
                        $select_Stock_Query = mysqli_query($con, $select_stock);
                        $stockQTYRow = mysqli_fetch_assoc($select_Stock_Query);
                        $stockQTY = $stockQTYRow['part_qty'];

                        if ($stockQTY >= $totalQty) {

                            $update_request = "UPDATE `tbl_requested` SET part_qty = '$quantity' , machine_no = '$machine' , with_reason = '$with_reason' WHERE id = '$id'";
                            if (!mysqli_query($con, $update_request)) {
                                echo json_encode(["success" => false, "error" => "Failed to update stock"]);
                                exit;
                            }

                            $update_stock = "UPDATE `tbl_stock` SET part_qty = part_qty - $totalQty WHERE part_name = '$part_name' AND exp_date = '$exp_date' AND batch_number = '$batch_number' AND item_code = '$item_code'";
                            if (!mysqli_query($con, $update_stock)) {
                                echo json_encode(["success" => false, "error" => "Failed to update stock"]);
                                exit;
                            }
                        } else {
                            if ($stockQTY > 0) {
                                echo json_encode([
                                    "success" => false,
                                    "error" => "Apologies, but the quantity of this " . $part_name . " is " . $stockQTY . " for the expiration date " . $exp_date . ". If you prefer, you may request a new batch or select a different expiration date."
                                ]);

                                exit;
                            } else {

                                echo json_encode(["success" => false, "error" => "Insufficient Stock"]);
                                exit;
                            }



                        }
                    } else {
                        $update_request = "UPDATE `tbl_requested` SET machine_no = '$machine' , with_reason = '$with_reason' WHERE id = '$id'";
                        if (!mysqli_query($con, $update_request)) {
                            echo json_encode(["success" => false, "error" => "Failed to update machine or reason"]);
                            exit;
                        }
                    }

                }
            }
        }

        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Missing data"]);
    }
}


?>