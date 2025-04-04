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
    $values[] = "('" . $con->real_escape_string($item['part_number']) . "',
                  '" . $con->real_escape_string($item['part_description']) . "',
                  '" . $con->real_escape_string($item['option']) . "',
                  '" . $con->real_escape_string($item['cost_center']) . "',
                  '" . $con->real_escape_string($item['location']) . "',
                  " . intval($item['min_inventory']) . ",
                  '" . $con->real_escape_string($item['unit_of_measure']) . "')";
}

$sql .= implode(",", $values);

if ($con->query($sql) === TRUE) {
    echo json_encode(["message" => "Data inserted successfully"]);
} else {
    echo json_encode(["message" => "Error: " . $con->error]);
}

$con->close();
?>