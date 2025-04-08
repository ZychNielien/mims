<?php
include "../model/dbconnection.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['cost_center_id'])) {
    $cost_center_id = (int) $_GET['cost_center_id'];

    $query = "SELECT supervisor_one, supervisor_two FROM tbl_ccs WHERE id = $cost_center_id";

    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
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

mysqli_close($con);
?>