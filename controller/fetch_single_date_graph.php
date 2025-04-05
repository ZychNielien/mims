<?php
session_start();
date_default_timezone_set('Asia/Manila');
include "../model/dbconnection.php";

$startDate = $_GET['startDate'];
$endDate = $_GET['endDate'];
$partName = $_GET['partName'];
$selectedDate = isset($_GET['selectedDate']) ? $_GET['selectedDate'] : null;

$query = "SELECT tc.ccid, tr.requested_count, tr.date
          FROM tbl_ccs tc
          LEFT JOIN tbl_requested tr ON tr.cost_center = tc.ccid
          WHERE tr.part_name = ? AND tr.date BETWEEN ? AND ?";

$params = [$partName, $startDate, $endDate];

if ($selectedDate) {
    $query .= " AND tr.date = ?";
    $params[] = $selectedDate;
}

if ($stmt = mysqli_prepare($con, $query)) {
    $stmt->bind_param('sss', ...$params);

    $stmt->execute();

    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);

    $stmt->close();
} else {
    echo json_encode(array("error" => "Query preparation failed"));
}

$con->close();
?>