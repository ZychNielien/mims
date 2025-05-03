<?php
include '../model/dbconnection.php';

$sql = "SELECT part_name, part_qty, exp_date, batch_number, item_code, kitting_id, lot_id, dts 
        FROM tbl_stock WHERE status ='Active'
        ORDER BY dts DESC";

$result = mysqli_query($con, $sql);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
?>