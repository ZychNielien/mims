<?php
include "../model/dbconnection.php";
header('Content-Type: application/json');

$response = array();

if (isset($_GET['part_id']) && !empty($_GET['part_id'])) {
    $part_id = mysqli_real_escape_string($con, $_GET['part_id']);

    $query = "SELECT ti.part_desc, ti.part_option, ts.batch_number, ts.item_code, ts.part_qty, ts.status, ti.unit
          FROM tbl_inventory ti
          LEFT JOIN tbl_stock ts ON ti.part_name = ts.part_name
          WHERE ti.id = '$part_id' AND ts.part_qty > 0 AND ts.status = 'Active'
          ORDER BY ts.item_code";


    $result = mysqli_query($con, $query);

    $response['item_codes'] = [];
    $response['part_desc'] = null;
    $response['part_option'] = null;

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (!$response['part_desc']) {
                $response['part_desc'] = $row['part_desc'];
                $response['part_option'] = $row['part_option'];
                $response['unit'] = $row['unit'];
            }

            $response['item_codes'][] = [
                'code' => $row['item_code'],
                'qty' => $row['part_qty'],
                'batch' => $row['batch_number'],
            ];
        }
    } else {
        $response['error'] = 'Database query failed';
    }
} else {
    $response['error'] = 'Missing part_id';
}

echo json_encode($response);
?>