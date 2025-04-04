<?php
// Session Start
session_start();

// Manila Time Zone
date_default_timezone_set('Asia/Manila');

// Database Connection
include "../model/dbconnection.php";

$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];
$partName = $_GET['partName'];
$selectedDate = isset($_GET['selectedDate']) ? $_GET['selectedDate'] : null; // Handle missing selectedDate

// Query the database using these parameters
$query = "SELECT tc.ccid, tr.requested_count, tr.date
          FROM tbl_ccs tc
          LEFT JOIN tbl_requested tr ON tr.cost_center = tc.ccid
          WHERE tr.part_name = ? AND tr.date BETWEEN ? AND ?";

// Array to hold query parameters
$params = [$partName, $startDate, $endDate];

// If selectedDate is provided, add it to the query
if ($selectedDate) {
    $query .= " AND tr.date = ?";
    $params[] = $selectedDate;
}

// Prepare the SQL statement
if ($stmt = mysqli_prepare($con, $query)) {
    // Bind the parameters to the SQL statement
    $stmt->bind_param('sss', ...$params);  // 'sss' assumes all parameters are strings

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch the results into an array
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Return the result as JSON
    echo json_encode($data);

    // Close the statement
    $stmt->close();
} else {
    echo json_encode(array("error" => "Query preparation failed"));
}

// Close the connection
$con->close();
?>