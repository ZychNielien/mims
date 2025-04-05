<?php
header("Content-Type: application/json");

// Database Connection
include "../model/dbconnection.php";

$data = json_decode(file_get_contents("php://input"), true);
if (!$data || empty($data['items'])) {
    echo json_encode(["message" => "No data received"]);
    exit;
}

$sql = "INSERT INTO tbl_inventory (part_name, part_desc, part_option, cost_center, location, min_invenT_req, unit) VALUES ";

$values = [];
foreach ($data['items'] as $item) {
    $values[] = "('" . $con->real_escape_string($item['new_part_number']) . "',
                  '" . $con->real_escape_string($item['new_part_desc']) . "',
                  '" . $con->real_escape_string($item['new_option']) . "',
                  '" . $con->real_escape_string($item['new_cost_center']) . "',
                  '" . $con->real_escape_string($item['new_location']) . "',
                  " . intval($item['new_min_invent_req']) . ",
                  '" . $con->real_escape_string($item['new_unit']) . "')";
}

$sql .= implode(",", $values);

if ($con->query($sql) === TRUE) {
    echo json_encode(["message" => "Data inserted successfully"]);
} else {
    echo json_encode(["message" => "Error: " . $con->error]);
}

$con->close();
?>