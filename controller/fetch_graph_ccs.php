<?php
// Session Start
session_start();

// Manila Time Zone
date_default_timezone_set('Asia/Manila');

// Database Connection
include "../model/dbconnection.php";

$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : null;
$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : null;
$partName = isset($_GET['partName']) ? $_GET['partName'] : null;

// Selecting Cost Center Data Approved
$query = "
SELECT tc.ccid, COUNT(tr.cost_center) AS requested_count
FROM tbl_ccs tc
LEFT JOIN tbl_requested tr ON tr.cost_center = tc.ccid AND tr.status = 'APPROVED'
";

if ($startDate && $endDate) {
    $endDate = date('Y-m-d 23:59:59', strtotime($endDate));
    $query .= " WHERE tr.dts_approve BETWEEN '$startDate' AND '$endDate' ";
} elseif ($startDate) {
    $query .= " WHERE tr.dts_approve >= '$startDate' ";
} elseif ($endDate) {
    $endDate = date('Y-m-d 23:59:59', strtotime($endDate));
    $query .= " WHERE tr.dts_approve <= '$endDate' ";
}

if ($partName) {
    if ($startDate || $endDate) {
        $query .= " AND tr.part_name = '$partName' ";
    } else {
        $query .= " WHERE tr.part_name = '$partName' ";
    }
}

$query .= " GROUP BY tc.ccid";

$result = mysqli_query($con, $query);

$data = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = [
            'ccid' => $row['ccid'],
            'requested_count' => $row['requested_count']
        ];
    }
}

echo json_encode($data);
?>