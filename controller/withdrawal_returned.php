<?php

session_start();
include "../model/dbconnection.php";
$userName = $_SESSION['username'];

$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$itemsPerPage = 50;
$offset = ($page - 1) * $itemsPerPage;

$sql = "SELECT * FROM tbl_requested WHERE req_by = '$userName' AND status = 'returned'";


if ($startDate && $endDate) {
    $startDateTime = $startDate . ' 00:00:00';
    $endDateTime = $endDate . ' 23:59:59';
    $sql .= " AND dts_return BETWEEN '$startDateTime' AND '$endDateTime'";
}

$sql .= " ORDER BY dts_return DESC LIMIT " . ($itemsPerPage + 1) . " OFFSET $offset";

$result = mysqli_query($con, $sql);

$tableRows = '';
$count = 0;
$hasMore = false;

while ($sqlRow = mysqli_fetch_assoc($result)) {
    $count++;
    if ($count > $itemsPerPage) {
        $hasMore = true;
        break;
    }

    $tableRows .= "
        <tr class='table-row text-center'>
            <td data-label='Date / Time / Shift'>{$sqlRow['dts_return']}</td>
            <td data-label='Lot Id'>{$sqlRow['lot_id']}</td>
            <td data-label='Part Name'>{$sqlRow['part_name']}</td>
            <td data-label='Part Name'>{$sqlRow['item_code']}</td>
            <td data-label='Batch Number'>{$sqlRow['batch_number']}</td>
            <td data-label='Approved Qty'>{$sqlRow['approved_qty']}</td>
            <td data-label='Machine Number'>{$sqlRow['machine_no']}</td>
            <td data-label='Cost Center'>{$sqlRow['cost_center']}</td>
            <td data-label='Qithdrawal Reason'>{$sqlRow['with_reason']}</td>
            <td data-label='Return Qty'>{$sqlRow['return_qty']}</td>
            <td data-label='Return Type'>{$sqlRow['return_purpose']}</td>
            <td data-label='Return Reason'>{$sqlRow['return_reason']}</td>
            <td data-label='Receieved By'>{$sqlRow['received_by']}</td>
        </tr>
    ";
}

if ($count === 0) {
    $tableRows = "<tr><td colspan='12' class='text-center'>No returned request found</td></tr>";
}

echo json_encode([
    'table' => $tableRows,
    'has_more' => $hasMore
]);

?>