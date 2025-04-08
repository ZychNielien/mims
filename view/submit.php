<?php
header("Content-Type: application/json");

include "../model/dbconnection.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || empty($data['items'])) {
    echo json_encode(["message" => "No data received"]);
    exit;
}

$duplicates = [];
foreach ($data['items'] as $item) {
    $part_number = $con->real_escape_string($item['new_part_number']);
    $check_sql = "SELECT 1 FROM tbl_inventory WHERE part_name = '$part_number' LIMIT 1";
    $check_result = $con->query($check_sql);

    if ($check_result && $check_result->num_rows > 0) {
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

$sql = "INSERT INTO tbl_inventory (part_name, part_desc, part_option, cost_center, location, min_invenT_req, unit, approver) VALUES ";
$values = [];

foreach ($data['items'] as $item) {
    $values[] = "('" . $con->real_escape_string($item['new_part_number']) . "',
                  '" . $con->real_escape_string($item['new_part_desc']) . "',
                  '" . $con->real_escape_string($item['new_option']) . "',
                  '" . $con->real_escape_string($item['new_cost_center']) . "',
                  '" . $con->real_escape_string($item['new_location']) . "',
                  " . intval($item['new_min_invent_req']) . ",
                  '" . $con->real_escape_string($item['new_unit']) . "', 
                  '" . $con->real_escape_string($item['new_approver']) . "')";
}

$sql .= implode(", ", $values);

if ($con->query($sql) === TRUE) {
    echo json_encode(["message" => "Data inserted successfully"]);
} else {
    echo json_encode([
        "message" => "Insert failed",
        "error" => $con->error,
        "sql" => $sql
    ]);
}

$con->close();
?>