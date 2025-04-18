<?php

include "../model/dbconnection.php";
date_default_timezone_set('Asia/Manila');

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');

function sendSSEData($data)
{
    echo "data: " . json_encode($data) . "\n\n";
    ob_flush();
    flush();
}

while (true) {
    $inventoryData = [];
    $today = date('Y-m-d');

    $update_expired_sql = "UPDATE tbl_stock SET status = 'Expired' WHERE exp_date <= '$today' AND status != 'Expired'";
    mysqli_query($con, $update_expired_sql);

    $sql = "SELECT ti.*, ts.exp_date,
           IFNULL(MIN(CASE WHEN ts.status = 'Active' AND ts.part_qty > 0 THEN ts.exp_date END), '') AS least_exp_date, 
           IFNULL(SUM(CASE WHEN ts.status = 'Active' THEN ts.part_qty END), 0) AS total_part_qty,
           SUM(CASE WHEN ts.status = 'Expired' THEN ts.part_qty ELSE 0 END) AS expired_qty
            FROM tbl_inventory ti
            LEFT JOIN tbl_stock ts ON ti.part_name = ts.part_name
            GROUP BY ti.part_name, ti.part_desc, ti.min_invent_req
            ORDER BY ti.part_name ASC";

    $sql_query = mysqli_query($con, $sql);

    if ($sql_query) {
        while ($sql_row = mysqli_fetch_assoc($sql_query)) {
            $min_invent_req = $sql_row['min_invent_req'];
            $total_qty = $sql_row['total_part_qty'];
            $expired_qty = $sql_row['expired_qty'];
            $part_name = $sql_row['part_name'];
            $part_desc = $sql_row['part_desc'];
            $part_category = $sql_row['part_category'];
            $approver = $sql_row['approver'];

            if ($min_invent_req) {
                $inventoryData[] = [
                    'id' => $sql_row['id'],
                    'part_name' => $part_name,
                    'part_desc' => $part_desc,
                    'part_qty' => $sql_row['part_qty'],
                    'min_invent_req' => $min_invent_req,
                    'exp_date' => $sql_row['exp_date'],
                    'cost_center' => $sql_row['cost_center'],
                    'part_option' => $sql_row['part_option'],
                    'part_category' => $sql_row['part_category'],
                    'location' => $sql_row['location'],
                    'unit' => $sql_row['unit'],
                    'approver' => $sql_row['approver'],
                    'least_exp_date' => $sql_row['least_exp_date'],
                    'total_part_qty' => $total_qty,
                    'expired_qty' => $expired_qty
                ];
            }
        }
    }

    sendSSEData($inventoryData);

    sleep(5);
}
