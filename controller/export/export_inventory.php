<?php
include "../../model/dbconnection.php";
header('Content-Type: application/json');

// handle search filter
$searchSQL = "";
if (!empty($_GET['search'])) {
    $search = mysqli_real_escape_string($con, $_GET['search']);
    $searchSQL = "WHERE (
                      ti.part_name LIKE '%$search%' OR
                      ti.part_desc LIKE '%$search%' OR
                      ts.item_code LIKE '%$search%'
                   )";
}

$query = "SELECT 
             ti.*, 
             ts.exp_date, 
             ts.item_code,
             IFNULL(
                 MIN(CASE 
                     WHEN ts.status = 'Active' AND ts.part_qty > 0 
                     THEN ts.exp_date 
                 END), 
                 ''
             ) AS least_exp_date, 
             IFNULL(
                 SUM(CASE 
                     WHEN ts.status = 'Active' 
                     THEN ts.part_qty 
                 END), 
                 0
             ) AS total_part_qty,
             SUM(CASE 
                 WHEN ts.status = 'Expired' 
                 THEN ts.part_qty 
                 ELSE 0 
             END) AS expired_qty
         FROM tbl_inventory ti
         LEFT JOIN tbl_stock ts ON ti.part_name = ts.part_name
         $searchSQL
         GROUP BY 
             ti.part_name, 
             ti.part_desc, 
             ti.min_invent_req
         ORDER BY 
             REGEXP_REPLACE(ti.part_name, '[0-9]+$', ''), 
             CAST(REGEXP_SUBSTR(ti.part_name, '[0-9]+$') AS UNSIGNED)";

$result = mysqli_query($con, $query);

$data = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

echo json_encode($data);
?>