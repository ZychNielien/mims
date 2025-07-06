<?php

session_start();
include "../model/dbconnection.php";

$userName = $_SESSION['username'];

$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$itemsPerPage = 15;
$offset = ($page - 1) * $itemsPerPage;

$sql = "SELECT * FROM tbl_requested WHERE req_by = '$userName' AND status = 'approved'";

if ($startDate && $endDate) {
    $startDateTime = $startDate . ' 00:00:00';
    $endDateTime = $endDate . ' 23:59:59';
    $sql .= " AND dts_approve BETWEEN '$startDateTime' AND '$endDateTime'";
}

$sql .= " ORDER BY dts_approve DESC LIMIT " . ($itemsPerPage + 1) . " OFFSET $offset";

$result = mysqli_query($con, $sql);

$tableRows = '';
$count = 0;
$hasMore = false;

while ($row = mysqli_fetch_assoc($result)) {
    $count++;
    if ($count > $itemsPerPage) {
        $hasMore = true;
        break;
    }

    $approveDate = new DateTime($row['dts_approve']);
    $now = new DateTime();
    $interval = $approveDate->diff($now);
    $isDisabled = $interval->days > 7 ? 'disabled' : '';

    $tableRows .= "<tr class='table-row text-center' style='vertical-align: middle;'>
        <td>
            <input type='checkbox' class='select-return' data-id='{$row['id']}'
                data-approved_qty='{$row['approved_qty']}' data-req_by='{$row['req_by']}' data-item_code='{$row['item_code']}' data-batch_number='{$row['batch_number']}'
                data-part_name='{$row['part_name']}' {$isDisabled} />
        </td>
        <td data-label='Date / Time / Shift'>{$row['dts_approve']}</td>
        <td data-label='Lot Id'>{$row['lot_id']}</td>
        <td data-label='Part Name'>{$row['part_name']}</td>
        <td data-label='Part Desc'>{$row['part_desc']}</td>
        <td data-label='Item Code'>{$row['item_code']}</td>
        <td data-label='Batch Number'>{$row['batch_number']}</td>
        <td data-label='Part Qty'>{$row['part_qty']}</td>
        <td data-label='Machine Number'>{$row['machine_no']}</td>
        <td data-label='Cost Center'>{$row['cost_center']}</td>
        <td data-label='Withdrawal Reason'>{$row['with_reason']}</td>
        <td data-label='Approved Qty'>{$row['approved_qty']}</td>
        <td data-label='Approved Reason'>{$row['approved_reason']}</td>
        <td data-label='Return Qty'>{$row['approved_by']}</td>
    </tr>";
}

if ($count === 0) {
    $tableRows = "<tr><td colspan='13' class='text-center'>No approved request found</td></tr>";
}

// Return JSON
echo json_encode([
    'table' => $tableRows,
    'has_more' => $hasMore
]);

?>