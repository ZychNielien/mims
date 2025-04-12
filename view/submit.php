<?php
header("Content-Type: application/json");
session_start();

include "../model/dbconnection.php";
date_default_timezone_set('Asia/Manila');

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || empty($data['items'])) {
    echo json_encode(["message" => "No data received"]);
    exit;
}

$duplicates = [];

foreach ($data['items'] as $item) {
    $part_number = mysqli_real_escape_string($con, $item['new_part_number'] ?? '');

    if (!$part_number)
        continue;

    $check_sql = "SELECT 1 FROM tbl_inventory WHERE part_name = '$part_number' LIMIT 1";
    $check_result = mysqli_query($con, $check_sql);

    if ($check_result && mysqli_num_rows($check_result) > 0) {
        $duplicates[] = $part_number;
    }
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

mysqli_close($con);
?>