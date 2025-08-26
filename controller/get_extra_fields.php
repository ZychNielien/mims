<?php
include '../model/dbconnection.php';
header('Content-Type: application/json');

$searchSQL = "WHERE status = 'Active'";

if (!empty($_GET['search'])) {
    $search = mysqli_real_escape_string($con, $_GET['search']);
    $searchSQL .= " AND (
        part_name LIKE '%$search%' OR
        batch_number LIKE '%$search%' OR
        item_code LIKE '%$search%' OR
        lot_id LIKE '%$search%'
    )";
}

$sql = "SELECT 
            part_name, 
            part_qty, 
            exp_date, 
            batch_number, 
            item_code, 
            kitting_id, 
            lot_id, 
            dts 
        FROM tbl_stock
        $searchSQL
        ORDER BY dts DESC";

$result = mysqli_query($con, $sql);
$data = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

echo json_encode($data);
?>