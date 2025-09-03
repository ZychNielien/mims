<?php

include "../model/dbconnection.php";
date_default_timezone_set('Asia/Manila');
session_start();

$dts = date('Y-m-d H:i:s');
$username = $_SESSION['username'];

// Admin Withdrawal Requests Approval 
if (isset($_POST['approve_submit'])) {
    if (isset($_POST['ids']) && isset($_POST['quantities']) && isset($_POST['reasons']) && isset($_POST['part_names']) && isset($_POST['request_bys']) && isset($_POST['batch_numbers'])) {
        $ids = $_POST['ids'];
        $quantities = $_POST['quantities'];
        $reasons = $_POST['reasons'];
        $part_names = $_POST['part_names'];
        $request_bys = $_POST['request_bys'];
        $batch_numbers = $_POST['batch_numbers'];
        $item_codes = $_POST['item_codes'];

        $success = true;

        for ($i = 0; $i < count($ids); $i++) {
            $id = intval($ids[$i]);
            $quantity = intval($quantities[$i]);
            $reason = mysqli_real_escape_string($con, $reasons[$i]);
            $current_part_name = $part_names[$i];
            $current_req_by = $request_bys[$i];
            $batch_number = $batch_numbers[$i];
            $item_code = $item_codes[$i];

            $checked = "SELECT batch_number FROM `tbl_requested` WHERE id = $id";
            $checked_sql = mysqli_query($con, $checked);
            $checkedBatchRow = mysqli_fetch_assoc($checked_sql);
            $checkedBatch = $checkedBatchRow['batch_number'];

            if ($checkedBatch === $batch_number) {

                $mensahe = $username . ' has approved ' . $quantity . ' of ' . $current_part_name . '. Click here for more details.';
                $sql_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) 
                          VALUES ('$username', '$mensahe', 0, '$dts', '$current_req_by','Approved')";

                if (!mysqli_query($con, $sql_notif)) {
                    $success = false;
                    break;
                }

                $updateQuery = "UPDATE tbl_requested 
                                SET approved_qty='$quantity', approved_reason='$reason', status='Approved' , approved_by = '$username' , dts_approve = '$dts' 
                                WHERE id='$id'";

                if (!mysqli_query($con, $updateQuery)) {
                    $success = false;
                    break;
                }

                $check_sql = "SELECT ts.part_name, ts.part_qty, ts.exp_date, ti.min_invent_req, ts.batch_number, ti.approver, ts.item_code
                    FROM tbl_stock ts
                    LEFT JOIN tbl_inventory ti ON ts.part_name = ti.part_name
                    WHERE ts.part_name = '$current_part_name' AND ts.item_code = '$item_code' AND ts.status = 'Active'
                    ORDER BY ts.exp_date ASC";

                $check_sql_query = mysqli_query($con, $check_sql);
                $part_qty_remaining = $quantity;
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

                if ($total_available_stock >= $quantity) {
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
                                     WHERE part_name = '$current_part_name' AND exp_date = '$expiration_date' AND batch_number = '$batch_number' AND item_code = '$item_code'";

                            if (!mysqli_query($con, $update_stock_sql)) {
                                echo "Error updating stock: " . mysqli_error($con) . "<br>";
                            }


                        }
                    }

                    if ($part_qty_remaining <= 0) {

                        $check_min_inventory_sql = "SELECT ti.min_invent_req, ti.approver FROM tbl_inventory ti WHERE ti.part_name = '$current_part_name'";
                        $min_invent_req_query = mysqli_query($con, $check_min_inventory_sql);
                        $min_invent_req_row = mysqli_fetch_assoc($min_invent_req_query);
                        $min_invent_req = $min_invent_req_row['min_invent_req'];
                        $approver = $min_invent_req_row['approver'];

                        $total_available_stock -= $updated_part_qty;

                        if ($total_available_stock < $min_invent_req) {
                            $mensahe_system = htmlspecialchars($current_part_name, ENT_QUOTES, 'UTF-8') . ' has reached the minimum inventory level and needs restocking.';

                            $update_admin_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) 
                                           VALUES ('System', '$mensahe_system', 0, '$dts', '$approver', 'Inventory')";
                            if (!mysqli_query($con, $update_admin_notif)) {
                                $success = false;
                                break;
                            }
                        }

                    }
                }

            } else {
                header('Content-Type: application/json');
                echo json_encode(["success" => false, "error" => "Batch Numbers are not the same."]);
                exit;
            }
        }

        header('Content-Type: application/json');
        echo json_encode(["success" => $success]);
    } else {
        echo json_encode(["success" => false, "error" => "Missing data"]);
    }
}

// Admin Withdrawal Requests Rejection 
if (isset($_POST['reject_submit'])) {
    if (isset($_POST['ids']) && isset($_POST['reasons']) && isset($_POST['part_names']) && isset($_POST['request_bys']) && isset($_POST['quantities']) && isset($_POST['exp_dates'])) {
        $ids = $_POST['ids'];
        $reasons = $_POST['reasons'];
        $part_names = $_POST['part_names'];
        $req_bys = $_POST['request_bys'];
        $quantities = $_POST['quantities'];
        $exp_dates = $_POST['exp_dates'];
        $batch_numbers = $_POST['batch_numbers'];
        $item_codes = $_POST['item_codes'];

        $success = true;

        for ($i = 0; $i < count($ids); $i++) {
            $id = intval($ids[$i]);
            $reason = mysqli_real_escape_string($con, $reasons[$i]);
            $quantity = intval($quantities[$i]);
            $current_part_name = $part_names[$i];
            $current_req_by = $req_bys[$i];
            $exp_date = $exp_dates[$i];
            $batch_number = $batch_numbers[$i];
            $item_code = $item_codes[$i];

            $updateQuery = "UPDATE tbl_requested SET rejected_reason='$reason', status='Rejected' , rejected_by = '$username' , dts_rejected = '$dts' WHERE id='$id'";
            if (mysqli_query($con, $updateQuery)) {
                $mensahe = $username . ' has rejected ' . $quantity . ' of ' . $current_part_name . '. Click here for more details.';
                $sql_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) 
                         VALUES ('$username', '$mensahe', 0, '$dts', '$current_req_by' , 'Rejected')";

                if (!mysqli_query($con, $sql_notif)) {
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

// Return Approved Request 
if (isset($_POST['return_submit'])) {
    if (isset($_POST['ids']) && isset($_POST['part_names']) && isset($_POST['quantities']) && isset($_POST['reasons']) && isset($_POST['req_bys']) && isset($_POST['return_purposes'])) {

        $ids = $_POST['ids'];
        $part_names = $_POST['part_names'];
        $quantities = $_POST['quantities'];
        $reasons = $_POST['reasons'];
        $req_bys = $_POST['req_bys'];
        $return_purposes = $_POST['return_purposes'];
        $success = true;

        for ($i = 0; $i < count($ids); $i++) {
            $id = intval($ids[$i]);
            $reason = mysqli_real_escape_string($con, $reasons[$i]);
            $req_by = mysqli_real_escape_string($con, $req_bys[$i]);
            $part_name = mysqli_real_escape_string($con, $part_names[$i]);
            $return_purpose = mysqli_real_escape_string($con, $return_purposes[$i]);
            $quantity = intval($quantities[$i]);
            $mensahe = $req_by . ' is returning ' . $quantity . ' of ' . $part_name . '. Click here for more details.';

            $sql_approver = "SELECT approver FROM `tbl_inventory` WHERE part_name = '$part_name'";
            $sql_approver_query = mysqli_query($con, $sql_approver);

            $approverRow = mysqli_fetch_assoc($sql_approver_query);
            $approver = $approverRow['approver'];

            if ($quantities <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid quantity.']);
                exit();
            }

            $sql = "UPDATE `tbl_requested` SET status = 'returning', return_reason='$reason' , return_purpose = '$return_purpose', dts_return = '$dts', return_qty = '$quantity' WHERE id = $id AND status = 'Approved'";
            if (mysqli_query($con, $sql)) {

                $sql_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at,for_who, destination) VALUES ('$req_by', '$mensahe', 0 ,'$dts','$approver', 'Scrap')";
                if (!mysqli_query($con, $sql_notif)) {
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

// Received Return Request 
if (isset($_POST['receive_submit'])) {
    if (isset($_POST['ids']) && isset($_POST['part_names']) && isset($_POST['quantities']) && isset($_POST['batchnumbers']) && isset($_POST['req_bys']) && isset($_POST['exp_dates']) && isset($_POST['actualBNs']) && isset($_POST['return_purposes'])) {

        $ids = $_POST['ids'];
        $part_names = $_POST['part_names'];
        $quantities = $_POST['quantities'];
        $batchnumbers = $_POST['batchnumbers'];
        $req_bys = $_POST['req_bys'];
        $exp_dates = $_POST['exp_dates'];
        $actualBNs = $_POST['actualBNs'];
        $return_purposes = $_POST['return_purposes'];
        $item_codes = $_POST['item_codes'];
        $success = true;

        for ($i = 0; $i < count($ids); $i++) {
            $id = intval($ids[$i]);
            $batchnumber = mysqli_real_escape_string($con, $batchnumbers[$i]);
            $req_by = mysqli_real_escape_string($con, $req_bys[$i]);
            $exp_date = mysqli_real_escape_string($con, $exp_dates[$i]);
            $part_name = mysqli_real_escape_string($con, $part_names[$i]);
            $actualBN = mysqli_real_escape_string($con, $actualBNs[$i]);
            $return_purpose = mysqli_real_escape_string($con, $return_purposes[$i]);
            $item_code = mysqli_real_escape_string($con, $item_codes[$i]);
            $quantity = intval($quantities[$i]);
            $mensahe = $username . ' has successfully received ' . $quantity . ' of ' . $part_name . '. Click here for more details.';

            if ($batchnumber === $actualBN) {
                $update_sql = "UPDATE tbl_requested SET status = 'returned' , received_by = '$username' , dts_receive = '$dts', return_purpose='$return_purpose' WHERE id = '$id'";

                if (mysqli_query($con, $update_sql)) {

                    if ($return_purpose === 'Partial') {
                        $update_stock = "UPDATE `tbl_stock` SET part_qty = part_qty + $quantity WHERE part_name = '$part_name' AND exp_date='$exp_date' AND batch_number = '$actualBN' AND item_code = '$item_code'";
                        if (!mysqli_query($con, $update_stock)) {
                            $success = false;
                            break;
                        }

                        $sql_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) VALUES ('$username', '$mensahe', 0, '$dts', '$req_by' , 'Returned')";
                        if (!mysqli_query($con, $sql_notif)) {
                            $success = false;
                            break;
                        }
                    } else if ($return_purpose === 'Scrap') {
                        $sql_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) VALUES ('$username', '$mensahe', 0, '$dts', '$req_by' , 'Returned')";
                        if (!mysqli_query($con, $sql_notif)) {
                            $success = false;
                            break;
                        }
                    }

                }
            } else {
                header('Content-Type: application/json');
                echo json_encode(["success" => false, "error" => "Batch Numbers are not the same."]);
                exit;
            }

        }
        echo json_encode(["success" => $success]);
    } else {
        echo json_encode(["success" => false, "error" => "Missing data"]);
    }

}
?>