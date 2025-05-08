<?php
include "../model/dbconnection.php";
session_start();
date_default_timezone_set('Asia/Manila');
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

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
    $part_item_code = $_POST['part_item_code'];

    $check_sql = "SELECT ts.part_name, ts.part_qty, ts.exp_date, ti.min_invent_req, ts.batch_number, ti.approver, ts.item_code
                    FROM tbl_stock ts
                    LEFT JOIN tbl_inventory ti ON ts.part_name = ti.part_name
                    WHERE ts.part_name = '$part_id' AND ts.item_code = '$part_item_code' AND ts.status = 'Active'
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
                                     WHERE part_name = '$part_id' AND exp_date = '$expiration_date' AND batch_number = '$batch_number' AND item_code = '$part_item_code'";

                if (!mysqli_query($con, $update_stock_sql)) {
                    echo "Error updating stock: " . mysqli_error($con) . "<br>";
                }

                $sql = "INSERT INTO `tbl_requested` (dts, part_name, lot_id, part_desc, station_code, part_qty, machine_no, with_reason, req_by, status, cost_center, part_option, exp_date, batch_number, item_code) 
                        VALUES ('$dts', '$part_id', '$lot_id', '$part_desc', '$station_code', '$quantity_to_deduct', '$machine_no', '$with_reason', '$req_by', '$status', '$cost_center', '$part_option', '$expiration_date','$batch_number','$part_item_code')";

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

// UPDATE MATERIALS
if (isset($_POST['update_submit'])) {
    if (isset($_POST['ids']) && isset($_POST['partnumbers']) && isset($_POST['partdescs']) && isset($_POST['partypes']) && isset($_POST['partcategories']) && isset($_POST['costcenters']) && isset($_POST['locations']) && isset($_POST['inventreqs']) && isset($_POST['units']) && isset($_POST['approvers'])) {
        $ids = $_POST['ids'];
        $partnumbers = $_POST['partnumbers'];
        $partdescs = $_POST['partdescs'];
        $partypes = $_POST['partypes'];
        $partcategories = $_POST['partcategories'];
        $costcenters = $_POST['costcenters'];
        $locations = $_POST['locations'];
        $inventreqs = $_POST['inventreqs'];
        $units = $_POST['units'];
        $approvers = $_POST['approvers'];
        $success = true;

        for ($i = 0; $i < count($ids); $i++) {
            $id = intval($ids[$i]);
            $partnumber = $partnumbers[$i];
            $partdesc = $partdescs[$i];
            $partype = $partypes[$i];
            $partcategory = $partcategories[$i];
            $costcenter = $costcenters[$i];
            $location = $locations[$i];
            $inventreq = $inventreqs[$i];
            $unit = $units[$i];
            $approver = $approvers[$i];
            $account_username = $_SESSION['username'];
            $desciption = $account_username . " has updated the details of material " . $partnumber;
            $dts = date('Y-m-d H:i:s');

            $sql = "UPDATE `tbl_inventory` SET part_name = '$partnumber' , part_desc = '$partdesc' , cost_center = '$costcenter' , location = '$location' , min_invent_req = '$inventreq' , unit = '$unit' , part_option = '$partype' ,part_category = '$partcategory', approver = '$approver' WHERE id = '$id '";

            if (mysqli_query($con, $sql)) {

                $sql_log = "INSERT INTO `tbl_log` (username, action, description, dts) VALUES ('$account_username', 'Edit Material Details','$desciption' , '$dts')";
                if (!mysqli_query($con, $sql_log)) {
                    $success = false;
                    break;
                }
            }
        }
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Missing data"]);
    }

}

// DELETE MATERIALS
if (isset($_POST['delete_submit'])) {
    if (isset($_POST['ids']) && isset($_POST['part_names']) && isset($_POST['reasons'])) {
        $ids = $_POST['ids'];
        $partnumbers = $_POST['part_names'];
        $reasons = $_POST['reasons'];
        $success = true;
        for ($i = 0; $i < count($ids); $i++) {
            $id = intval($ids[$i]);
            $partnumber = $partnumbers[$i];
            $reason = $reasons[$i];
            $account_username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Unknown User';
            $description = $account_username . " has deleted " . $partnumber;
            $dts = date('Y-m-d H:i:s');

            $sql = "DELETE FROM tbl_inventory WHERE id = $id";
            if (mysqli_query($con, $sql)) {

                $sql_log = "INSERT INTO `tbl_log` (username, action, description, dts, reasons) 
                VALUES ('$account_username', 'Material Deletion', '$description', '$dts', '$reason')";
                if (!mysqli_query($con, $sql_log)) {
                    $success = false;
                    break;
                }

                $delete_stock = "DELETE FROM tbl_stock WHERE part_name = '$partnumber'";
                if (!mysqli_query($con, $delete_stock)) {
                    $success = false;
                    break;
                }
            }
        }
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Missing data"]);
    }

}

// MATERIAL REGISTRATION
if (isset($data['materialSubmit']) && is_array($data['items'])) {
    $duplicates = [];
    $seen_parts = [];

    foreach ($data['items'] as $item) {
        $part_number = trim(mysqli_real_escape_string($con, $item['new_part_number'] ?? ''));

        if (!$part_number)
            continue;

        if (in_array(strtolower($part_number), $seen_parts)) {
            $duplicates[] = $part_number;
            continue;
        }

        $check_sql = "SELECT 1 FROM tbl_inventory WHERE LOWER(TRIM(part_name)) = LOWER('$part_number') LIMIT 1";
        $check_result = mysqli_query($con, $check_sql);

        if ($check_result && mysqli_num_rows($check_result) > 0) {
            $duplicates[] = $part_number;
        }

        $seen_parts[] = strtolower($part_number);
    }


    if (!empty($duplicates)) {
        echo json_encode([
            "message" => "Duplicate part number(s) found",
            "duplicates" => $duplicates
        ]);
        exit;
    }

    $values = [];
    $logValues = [];

    $account_username = $_SESSION['username'] ?? 'unknown';
    $action = "Material Registration";
    $dts = date('Y-m-d H:i:s');

    foreach ($data['items'] as $item) {
        $partNumber = mysqli_real_escape_string($con, $item['new_part_number'] ?? '');
        $partDesc = mysqli_real_escape_string($con, $item['new_part_desc'] ?? '');
        $partOption = mysqli_real_escape_string($con, $item['new_option'] ?? '');
        $partCategory = mysqli_real_escape_string($con, $item['new_category'] ?? '');
        $partCostCenter = mysqli_real_escape_string($con, $item['new_cost_center'] ?? '');
        $partLocation = mysqli_real_escape_string($con, $item['new_location'] ?? '');
        $partInventReq = mysqli_real_escape_string($con, $item['new_min_invent_req'] ?? '');
        $partUnit = mysqli_real_escape_string($con, $item['new_unit'] ?? '');
        $partApprover = mysqli_real_escape_string($con, $item['new_approver'] ?? '');

        $values[] = "(
            '$partNumber',
            '$partDesc',
            '$partOption',
            '$partCategory',
            '$partCostCenter',
            '$partLocation',
            '$partInventReq',
            '$partUnit',
            '$partApprover'
        )";

        $description = mysqli_real_escape_string($con, "$account_username has registered a new material $partNumber.");
        $logValues[] = "('$account_username', '$action', '$description', '$dts')";
    }

    $sql = "INSERT INTO tbl_inventory 
        (part_name, part_desc, part_option, part_category, cost_center, location, min_invenT_req, unit, approver) 
        VALUES " . implode(", ", $values);

    $sql_log = "INSERT INTO tbl_log 
        (username, action, description, dts) 
        VALUES " . implode(", ", $logValues);

    $result1 = mysqli_query($con, $sql);
    $result2 = mysqli_query($con, $sql_log);

    if ($result1 && $result2) {
        echo json_encode(["message" => "Material added successfully"]);
    } else {
        echo json_encode([
            "message" => "Insert failed",
            "error" => mysqli_error($con)
        ]);
    }
}

?>