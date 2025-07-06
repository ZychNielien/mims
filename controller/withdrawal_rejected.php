<?php
session_start();
include "../model/dbconnection.php";
$userName = $_SESSION['username'];

$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$itemsPerPage = 50;
$offset = ($page - 1) * $itemsPerPage;

$sql = "SELECT * FROM tbl_requested WHERE req_by = '$userName' AND status = 'rejected'";

if ($startDate && $endDate) {
    $startDateTime = $startDate . ' 00:00:00';
    $endDateTime = $endDate . ' 23:59:59';
    $sql .= " AND dts_rejected BETWEEN '$startDateTime' AND '$endDateTime'";
}

$sql .= " ORDER BY dts_rejected DESC LIMIT " . ($itemsPerPage + 1) . " OFFSET $offset";

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
    <tr class='table-row text-center' style='vertical-align: middle;'>
        <td data-label='Date / Time / Shift'>{$sqlRow['dts_rejected']}</td>
        <td data-label='Lot Id'>{$sqlRow['lot_id']}</td>
        <td data-label='Part Name'>{$sqlRow['part_name']}</td>
        <td data-label='Part Desc'>{$sqlRow['part_desc']}</td>
        <td data-label='Part Name'>{$sqlRow['item_code']}</td>
        <td data-label='Batch Number'>{$sqlRow['batch_number']}</td>
        <td data-label='Quantity'>{$sqlRow['part_qty']}</td>
        <td data-label='Machine No'>{$sqlRow['machine_no']}</td>
        <td data-label='Cost Center'>{$sqlRow['cost_center']}</td>
        <td data-label='Reason'>{$sqlRow['with_reason']}</td>
        <td data-label='Status'>{$sqlRow['rejected_reason']}</td>
        <td data-label='Rejected By'>{$sqlRow['rejected_by']}</td>
    </tr>
";
}

if ($count === 0) {
    $tableRows = "<tr><td colspan='11' class='text-center'>No rejected request found</td></tr>";
}

echo json_encode([
    'table' => $tableRows,
    'has_more' => $hasMore
]);

?>