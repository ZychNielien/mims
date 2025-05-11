<?php
include "../model/dbconnection.php";
header('Content-Type: application/json');

$response = array();

if (isset($_GET['part_id']) && !empty($_GET['part_id'])) {
    $part_id = mysqli_real_escape_string($con, $_GET['part_id']);

    error_log("Received part_id: " . $part_id);

    $query = "SELECT part_desc, part_option FROM tbl_inventory WHERE id = '$part_id'";

    error_log("SQL Query: " . $query);

    $result = mysqli_query($con, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $response['part_desc'] = $row['part_desc'];
            $response['part_option'] = $row['part_option'];
        } else {
            $response['part_desc'] = null;
        }
    } else {
        $response['error'] = 'Failed to retrieve data from database';
    }
} else {
    $response['error'] = 'part_id is required';
}

echo json_encode($response);
?>