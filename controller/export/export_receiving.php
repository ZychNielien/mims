<?php
include "../../model/dbconnection.php";
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$search = $_GET['search'] ?? '';
$startDate = $_GET['start_date'] ?? '';
$endDate = $_GET['end_date'] ?? '';

$sql = "SELECT * FROM tbl_history 
        WHERE status = 'Received'";

if (!empty($search)) {
    $search = mysqli_real_escape_string($con, $search);
    $sql .= " AND (
        part_name LIKE '%$search%'
    )";
}

if (!empty($startDate)) {
    $sql .= " AND DATE(dts) >= '$startDate'";
}

if (!empty($endDate)) {
    $sql .= " AND DATE(dts) <= '$endDate'";
}

$sql .= " ORDER BY dts DESC";

$result = mysqli_query($con, $sql);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$headers = ["Date/Time/Shift", "Part Number", "Part Description", "Item Code", "Batch Number", "Quantity", "Expiration Date", "Kitting ID", "Received By"];
$sheet->fromArray($headers, NULL, 'A1');

$rowNum = 2;
while ($row = mysqli_fetch_assoc($result)) {
    $sheet->fromArray([
        $row['dts'],
        $row['part_name'],
        $row['part_desc'],
        $row['item_code'],
        $row['batch_number'],
        $row['part_qty'],
        $row['exp_date'],
        $row['kitting_id'],
        $row['updated_by']
    ], NULL, 'A' . $rowNum);
    $rowNum++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="receiving_history.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
