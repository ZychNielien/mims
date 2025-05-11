<?php
include "../model/dbconnection.php";
date_default_timezone_set('Asia/Manila');

ini_set('output_buffering', 'off');
ini_set('zlib.output_compression', false);
while (ob_get_level() > 0) {
    ob_end_flush();
}
ob_implicit_flush(true);

$today = date('Y-m-d');
$update_sql = "UPDATE tbl_stock SET status = 'Expired' WHERE exp_date <= '$today' AND status != 'Expired'";
mysqli_query($con, $update_sql);

$isSSE = !isset($_GET['page']);

if ($isSSE) {
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    header('Connection: keep-alive');

    while (true) {
        sendInventoryData($con);
        sleep(5);
    }
} else {
    header('Content-Type: application/json');
    $page = isset($_GET['page']) ? intval($_GET['page']) : 0;
    $limit = 20;
    $offset = $page * $limit;
    $data = fetchInventory($con, $offset, $limit);
    echo json_encode($data);
    exit();
}

function fetchInventory($con, $offset = 0, $limit = 0)
{
    $limitSQL = ($limit > 0) ? "LIMIT $offset, $limit" : "";

    $sql = "SELECT 
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
            GROUP BY 
                ti.part_name, 
                ti.part_desc, 
                ti.min_invent_req, 
                ts.item_code
            ORDER BY 
                REGEXP_REPLACE(ti.part_name, '[0-9]+$', ''), 
                CAST(REGEXP_SUBSTR(ti.part_name, '[0-9]+$') AS UNSIGNED)
            $limitSQL
        ";

    $result = mysqli_query($con, $sql);
    $inventoryData = [];

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $inventoryData[] = [
                'id' => $row['id'],
                'part_name' => $row['part_name'],
                'part_desc' => $row['part_desc'],
                'part_qty' => $row['part_qty'],
                'min_invent_req' => $row['min_invent_req'],
                'exp_date' => $row['exp_date'],
                'cost_center' => $row['cost_center'],
                'part_option' => $row['part_option'],
                'part_category' => $row['part_category'],
                'location' => $row['location'],
                'unit' => $row['unit'],
                'approver' => $row['approver'],
                'least_exp_date' => $row['least_exp_date'],
                'total_part_qty' => $row['total_part_qty'],
                'expired_qty' => $row['expired_qty'],
                'item_code' => $row['item_code']
            ];
        }
    }

    return $inventoryData;
}

function sendInventoryData($con)
{
    $data = fetchInventory($con);
    echo "event: message\n";
    echo "data: " . json_encode($data) . "\n\n";
    ob_flush();
    flush();
}

?>