<?php

// Session Start
session_start();

// Database Connection
include "../model/dbconnection.php";

$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';

$userName = $_SESSION['username'];

// Select Withdrawal Request Where Status is Rejected
$sql = "SELECT * FROM tbl_requested WHERE req_by = '$userName' AND status = 'rejected'";

if ($startDate && $endDate) {
    $startDateTime = $startDate . ' 00:00:00';
    $endDateTime = $endDate . ' 23:59:59';

    $sql .= " AND dts_rejected BETWEEN '$startDateTime' AND '$endDateTime'";
}

$sql_query = mysqli_query($con, $sql);

if (mysqli_num_rows($sql_query) > 0) {

    while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
        echo "<tr class='table-row text-center'>
                <td data-label='Date / Time / Shift'>{$sqlRow['dts_rejected']}</td>
                <td data-label='Lot Id'>{$sqlRow['lot_id']}</td>
                <td data-label='Part Name'>{$sqlRow['part_name']}</td>
                <td data-label='Part Desc'>{$sqlRow['part_desc']}</td>
                <td data-label='Quantity'>{$sqlRow['part_qty']}</td>
                <td data-label='Machine No'>{$sqlRow['machine_no']}</td>
                <td data-label='Reason'>{$sqlRow['with_reason']}</td>
                <td data-label='Requested By'>{$sqlRow['req_by']}</td>
                <td data-label='Status'>{$sqlRow['status']}</td>
                <td data-label='Rejected By'>{$sqlRow['rejected_by']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='10' class='text-center'>No rejected request found</td></tr>";
}
?>