<?php
include "../model/dbconnection.php";
session_start();
date_default_timezone_set('Asia/Manila');
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);


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

            $sql_select = "SELECT part_name FROM `tbl_inventory` WHERE id='$id'";
            $sql_select_query = mysqli_query($con, $sql_select);
            $selectedPart = mysqli_fetch_assoc($sql_select_query);
            $selected = $selectedPart['part_name'];

            $sql = "UPDATE `tbl_inventory` SET part_name = '$partnumber' , part_desc = '$partdesc' , cost_center = '$costcenter' , location = '$location' , min_invent_req = '$inventreq' , unit = '$unit' , part_option = '$partype' ,part_category = '$partcategory', approver = '$approver' WHERE id = '$id '";

            if (mysqli_query($con, $sql)) {

                $sql_stocks = "UPDATE `tbl_stock` SET part_name = '$partnumber' WHERE part_name = '$selected'";
                if (!mysqli_query($con, $sql_stocks)) {
                    $success = false;
                    break;
                }

                $sql_requested = "UPDATE `tbl_requested` SET part_name = '$partnumber' WHERE part_name = '$selected'";
                if (!mysqli_query($con, $sql_requested)) {
                    $success = false;
                    break;
                }

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
    if (isset($_POST['ids']) && isset($_POST['part_names']) && isset($_POST['reasons']) && isset($_POST['item_codes'])) {
        $ids = $_POST['ids'];
        $partnumbers = $_POST['part_names'];
        $reasons = $_POST['reasons'];
        $item_codes = $_POST['item_codes'];
        $success = true;

        $account_username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Unknown User';
        $dts = date('Y-m-d H:i:s');

        for ($i = 0; $i < count($ids); $i++) {
            $id = intval($ids[$i]);
            $partnumber = mysqli_real_escape_string($con, $partnumbers[$i]);
            $item_code = mysqli_real_escape_string($con, $item_codes[$i]);
            $reason = mysqli_real_escape_string($con, $reasons[$i]);


            $check = "SELECT * FROM tbl_stock WHERE part_name = '$partnumber'";
            $check_query = mysqli_query($con, $check);

            if (mysqli_num_rows($check_query) > 1) {
                $description = "$account_username has deleted $partnumber ($item_code)";
                $sql_log = "INSERT INTO tbl_log (username, action, description, dts, reasons) 
                            VALUES ('$account_username', 'Material Deletion', '$description', '$dts', '$reason')";
                if (!mysqli_query($con, $sql_log)) {
                    $success = false;
                    break;
                }

                $delete_stock = "DELETE FROM tbl_stock WHERE part_name = '$partnumber' AND item_code = '$item_code'";
                if (!mysqli_query($con, $delete_stock)) {
                    $success = false;
                    break;
                }
            } else {
                $description = "$account_username has deleted $partnumber";
                $sql = "DELETE FROM tbl_inventory WHERE id = $id";
                if (mysqli_query($con, $sql)) {

                    $sql_log = "INSERT INTO tbl_log (username, action, description, dts, reasons) 
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
        }

        if ($success) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "Failed to delete one or more items"]);
        }
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