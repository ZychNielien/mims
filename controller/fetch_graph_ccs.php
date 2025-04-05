<?php

session_start();
date_default_timezone_set('Asia/Manila');
include "../model/dbconnection.php";

$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : null;
$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : null;
$partName = isset($_GET['partName']) ? $_GET['partName'] : null;

if ($endDate) {
    $endDate = date('Y-m-d 23:59:59', strtotime($endDate));
}

$queryRanking = "
SELECT 
    tc.ccid, 
    COUNT(tr.cost_center) AS requested_count
FROM tbl_ccs tc
LEFT JOIN tbl_requested tr 
    ON tr.cost_center = tc.ccid 
    AND tr.status = 'APPROVED'
";

$conditions = [];

if ($startDate && $endDate) {
    $conditions[] = "tr.dts_approve BETWEEN '$startDate' AND '$endDate'";
} elseif ($startDate) {
    $conditions[] = "tr.dts_approve >= '$startDate'";
} elseif ($endDate) {
    $conditions[] = "tr.dts_approve <= '$endDate'";
}

if ($partName) {
    $conditions[] = "tr.part_name = '$partName'";
}

if (!empty($conditions)) {
    $queryRanking .= " WHERE " . implode(" AND ", $conditions);
}

$queryRanking .= " GROUP BY tc.ccid ORDER BY requested_count DESC";

$resultRanking = mysqli_query($con, $queryRanking);

$rankingData = [];

if ($resultRanking) {
    while ($row = mysqli_fetch_assoc($resultRanking)) {
        $rankingData[] = [
            'ccid' => $row['ccid'],
            'requested_count' => $row['requested_count']
        ];
    }
}

$queryDateSpecific = "
SELECT 
    tc.ccid, 
    DATE(tr.dts_approve) AS approve_date, 
    COUNT(tr.cost_center) AS requested_count
FROM tbl_ccs tc
LEFT JOIN tbl_requested tr 
    ON tr.cost_center = tc.ccid 
    AND tr.status = 'APPROVED'
";

if (!empty($conditions)) {
    $queryDateSpecific .= " WHERE " . implode(" AND ", $conditions);
}

$queryDateSpecific .= " GROUP BY tc.ccid, approve_date ORDER BY approve_date ASC";

$resultDateSpecific = mysqli_query($con, $queryDateSpecific);

$dateSpecificData = [];

if ($resultDateSpecific) {
    while ($row = mysqli_fetch_assoc($resultDateSpecific)) {
        $dateSpecificData[] = [
            'ccid' => $row['ccid'],
            'requested_count' => $row['requested_count'],
            'date' => $row['approve_date']
        ];
    }
}

echo json_encode([
    'ranking' => $rankingData,
    'dateSpecific' => $dateSpecificData
]);
?>