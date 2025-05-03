<?php
session_start();
include "../model/dbconnection.php";
$userName = $_SESSION['username'];

$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$itemsPerPage = 100;

$countSql = "SELECT COUNT(*) as total FROM tbl_requested WHERE req_by = '$userName' AND status = 'rejected'";

if ($startDate && $endDate) {
    $startDateTime = $startDate . ' 00:00:00';
    $endDateTime = $endDate . ' 23:59:59';
    $countSql .= " AND dts_rejected BETWEEN '$startDateTime' AND '$endDateTime'";
}

$countResult = mysqli_query($con, $countSql);
$totalRows = mysqli_fetch_assoc($countResult)['total'];
$totalPages = ceil($totalRows / $itemsPerPage);

$offset = ($page - 1) * $itemsPerPage;

$sql = "SELECT * FROM tbl_requested WHERE req_by = '$userName' AND status = 'rejected'";

if ($startDate && $endDate) {
    $sql .= " AND dts_rejected BETWEEN '$startDateTime' AND '$endDateTime'";
}

$sql .= " ORDER BY dts_rejected DESC LIMIT $itemsPerPage OFFSET $offset";

$sql_query = mysqli_query($con, $sql);

$tableRows = '';
if (mysqli_num_rows($sql_query) > 0) {
    while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
        $tableRows .= "<tr class='table-row text-center'>
                        <td data-label='Date / Time / Shift'>{$sqlRow['dts_rejected']}</td>
                        <td data-label='Lot Id'>{$sqlRow['lot_id']}</td>
                        <td data-label='Part Name'>{$sqlRow['part_name']}</td>
                        <td data-label='Part Desc'>{$sqlRow['part_desc']}</td>
                        <td data-label='Quantity'>{$sqlRow['part_qty']}</td>
                        <td data-label='Batch Number'>{$sqlRow['batch_number']}</td>
                        <td data-label='Machine No'>{$sqlRow['machine_no']}</td>
                        <td data-label='Reason'>{$sqlRow['with_reason']}</td>
                        <td data-label='Status'>{$sqlRow['rejected_reason']}</td>
                        <td data-label='Rejected By'>{$sqlRow['rejected_by']}</td>
                      </tr>";
    }
} else {
    $tableRows = "<tr><td colspan='10' class='text-center'>No rejected request found</td></tr>";
}

$pagination = '';
if ($totalPages > 1) {
    $pagination .= '<ul class="pagination justify-content-center">';

    if ($page > 1) {
        $pagination .= '<li class="page-item"><a class="page-link page-link-reject" href="?page=' . ($page - 1) . '&start_date=' . $startDate . '&end_date=' . $endDate . '">&laquo; Prev</a></li>';
    }

    for ($i = 1; $i <= $totalPages; $i++) {
        $pagination .= '<li class="page-item' . ($i == $page ? ' active' : '') . '"><a class="page-link page-link-reject" href="?page=' . $i . '&start_date=' . $startDate . '&end_date=' . $endDate . '">' . $i . '</a></li>';
    }

    if ($page < $totalPages) {
        $pagination .= '<li class="page-item"><a class="page-link page-link-reject" href="?page=' . ($page + 1) . '&start_date=' . $startDate . '&end_date=' . $endDate . '">Next &raquo;</a></li>';
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