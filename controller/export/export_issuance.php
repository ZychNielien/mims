<?php
include "../../model/dbconnection.php";
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$search = $_GET['search'] ?? '';
$startDate = $_GET['start_date'] ?? '';
$endDate = $_GET['end_date'] ?? '';

$sql = "SELECT tr.*, ti.unit FROM tbl_requested tr JOIN tbl_inventory ti ON tr.part_name = ti.part_name
        WHERE (status = 'Approved' OR status = 'returned')";

if (!empty($search)) {
    $search = mysqli_real_escape_string($con, $search);
    $sql .= " AND (
        part_name LIKE '%$search%'

    )";
}

if (!empty($startDate)) {
    $sql .= " AND DATE(dts_approve) >= '$startDate'";
}

if (!empty($endDate)) {
    $sql .= " AND DATE(dts_approve) <= '$endDate'";
}

$sql .= " ORDER BY dts_approve DESC";

$result = mysqli_query($con, $sql);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$headers = ["Date/Time/Shift", "Lot ID", "Part Number", "Part Description", "Item Code", "Batch Number", "Machine No.", "Withdrawal Reason", "Requested By", "Approved Qty", "Unit of Measure", "Cost Center", "Approved By"];
$sheet->fromArray($headers, NULL, 'A1');

$rowNum = 2;
while ($row = mysqli_fetch_assoc($result)) {
    $sheet->fromArray([
        $row['dts_approve'],
        $row['lot_id'],
        $row['part_name'],
        $row['part_desc'],
        $row['item_code'],
        $row['batch_number'],
        $row['machine_no'],
        $row['with_reason'],
        $row['req_by'],
        $row['approved_qty'],
        $row['unit'],
        $row['cost_center'],
        $row['approved_by']
    ], NULL, 'A' . $rowNum);
    $rowNum++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="issuance_history.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
