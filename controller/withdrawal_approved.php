<?php

session_start();
include "../model/dbconnection.php";
$userName = $_SESSION['username'];

$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$itemsPerPage = 100;

$countSql = "SELECT COUNT(*) as total FROM tbl_requested WHERE req_by = '$userName' AND status = 'approved'";

if ($startDate && $endDate) {
    $startDateTime = $startDate . ' 00:00:00';
    $endDateTime = $endDate . ' 23:59:59';
    $countSql .= " AND dts_approve BETWEEN '$startDateTime' AND '$endDateTime'";
}

$countResult = mysqli_query($con, $countSql);
$totalRows = mysqli_fetch_assoc($countResult)['total'];
$totalPages = ceil($totalRows / $itemsPerPage);

$offset = ($page - 1) * $itemsPerPage;

$sql = "SELECT * FROM tbl_requested WHERE req_by = '$userName' AND status = 'approved'";

if ($startDate && $endDate) {
    $sql .= " AND dts_approve BETWEEN '$startDateTime' AND '$endDateTime'";
}

$sql .= " ORDER BY dts_approve DESC LIMIT $itemsPerPage OFFSET $offset";

$sql_query = mysqli_query($con, $sql);

$tableRows = '';
if (mysqli_num_rows($sql_query) > 0) {
    while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
        $approveDate = new DateTime($sqlRow['dts_approve']);
        $now = new DateTime();
        $interval = $approveDate->diff($now);
        $isDisabled = $interval->days > 7 ? 'disabled' : '';

        $tableRows .= "<tr class='table-row text-center' style='vertical-align: middle;'>
            <td>
                <input type='checkbox' class='select-return' data-id='{$sqlRow['id']}'
                    data-approved_qty='{$sqlRow['approved_qty']}' data-req_by='{$sqlRow['req_by']}'
                    data-part_name='{$sqlRow['part_name']}' {$isDisabled} />
            </td>
            <td data-label='Date / Time / Shift'>{$sqlRow['dts_approve']}</td>
            <td data-label='Lot Id'>{$sqlRow['lot_id']}</td>
            <td data-label='Part Name'>{$sqlRow['part_name']}</td>
            <td data-label='Part Desc'>{$sqlRow['part_desc']}</td>
            <td data-label='Part Qty'>{$sqlRow['part_qty']}</td>
            <td data-label='Machine Number'>{$sqlRow['machine_no']}</td>
            <td data-label='Withdrawal Reason'>{$sqlRow['with_reason']}</td>
            <td data-label='Approved Qty'>{$sqlRow['approved_qty']}</td>
            <td data-label='Batch Number'>{$sqlRow['batch_number']}</td>
            <td data-label='Approved Reason'>{$sqlRow['approved_reason']}</td>
            <td data-label='Return Qty'>{$sqlRow['approved_by']}</td>
        </tr>";
    }
} else {
    $tableRows = "<tr><td colspan='12' class='text-center'>No approved request found</td></tr>";
}

$pagination = '';
if ($totalPages > 1) {
    $pagination .= '<ul class="pagination justify-content-center">';

    if ($page > 1) {
        $pagination .= '<li class="page-item"><a class="page-link page-link-approve" href="?page=' . ($page - 1) . '&start_date=' . $startDate . '&end_date=' . $endDate . '">&laquo; Prev</a></li>';
    }

    for ($i = 1; $i <= $totalPages; $i++) {
        $pagination .= '<li class="page-item' . ($i == $page ? ' active' : '') . '"><a class="page-link page-link-approve" href="?page=' . $i . '&start_date=' . $startDate . '&end_date=' . $endDate . '">' . $i . '</a></li>';
    }

    if ($page < $totalPages) {
        $pagination .= '<li class="page-item"><a class="page-link page-link-approve" href="?page=' . ($page + 1) . '&start_date=' . $startDate . '&end_date=' . $endDate . '">Next &raquo;</a></li>';
    }

    $pagination .= '</ul>';
}

$response = [
    'table' => $tableRows,
    'pagination' => $pagination,
    'total_pages' => $totalPages
];

echo json_encode($response);
?>