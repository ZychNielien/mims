<?php
include "../../model/dbconnection.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['cost_center_id'])) {
    $cost_center_id = $_GET['cost_center_id'];

    $query = "SELECT supervisor_one, supervisor_two FROM tbl_ccs WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('i', $cost_center_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode([
                'supervisor_one' => $row['supervisor_one'],
                'supervisor_two' => $row['supervisor_two']
            ]);
        } else {
            echo json_encode([
                'supervisor_one' => '',
                'supervisor_two' => ''
            ]);
        }
    } else {
        echo json_encode(['error' => 'Database query failed']);
    }
} else {
    echo json_encode(['error' => 'cost_center_id is required']);
}
?>