<?php
include "../../model/dbconnection.php";
header('Content-Type: application/json'); // Ensure the response is sent as JSON

$response = array(); // Initialize the response array

// Check if 'part_id' is set and not empty
if (isset($_GET['part_id']) && !empty($_GET['part_id'])) {
    $part_id = mysqli_real_escape_string($con, $_GET['part_id']); // Sanitize the input

    // Query to fetch part description based on the part_id
    $query = "SELECT part_desc FROM tbl_inventory WHERE id = '$part_id'";
    $result = mysqli_query($con, $query);

    // If the query is successful
    if ($result) {
        // Check if any result is returned
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $response['part_desc'] = $row['part_desc'];
        } else {
            // If no record is found, set part_desc to null
            $response['part_desc'] = null;
        }
    } else {
        // Query failed, set error in response
        $response['error'] = 'Failed to retrieve data from database';
    }
} else {
    // If 'part_id' is not provided, return an error
    $response['error'] = 'part_id is required';
}

// Send the response as JSON
echo json_encode($response);
?>