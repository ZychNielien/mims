<?php

session_start();
include "../model/dbconnection.php";

$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';

$userName = $_SESSION['username'];

$sql = "SELECT * FROM tbl_requested WHERE req_by = '$userName' AND status = 'returned' ORDER BY dts_return DESC";

if ($startDate && $endDate) {
    $startDateTime = $startDate . ' 00:00:00';
    $endDateTime = $endDate . ' 23:59:59';

    $sql .= " AND dts_return BETWEEN '$startDateTime' AND '$endDateTime'";
}

$sql_query = mysqli_query($con, $sql);

if (mysqli_num_rows($sql_query) > 0) {

    while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
        echo "<tr class='table-row text-center'>
                <td data-label='Date / Time / Shift'>{$sqlRow['dts_return']}</td>
                <td data-label='Lot Id'>{$sqlRow['lot_id']}</td>
                <td data-label='Part Name'>{$sqlRow['part_name']}</td>
                <td data-label='Approved Qty'>{$sqlRow['approved_qty']}</td>
                 <td data-label='Batch Number'>{$sqlRow['batch_number']}</td>
                <td data-label='Machine Number'>{$sqlRow['machine_no']}</td>
                <td data-label='Qithdrawal Reason'>{$sqlRow['with_reason']}</td>
                <td data-label='Return Qty'>{$sqlRow['return_qty']}</td>
                <td data-label='Return Reason'>{$sqlRow['return_reason']}</td>
                <td data-label='Receieved By'>{$sqlRow['received_by']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='11' class='text-center'>No returned request found</td></tr>";
}
?>