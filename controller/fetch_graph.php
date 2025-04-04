<?php

session_start();
date_default_timezone_set('Asia/Manila');
include "../model/dbconnection.php";

if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
    $cost_center = isset($_GET['cost_center']) ? $_GET['cost_center'] : '';
    $station_code = isset($_GET['station_code']) ? $_GET['station_code'] : '';

    $start_date = mysqli_real_escape_string($con, $start_date);
    $end_date = mysqli_real_escape_string($con, $end_date);
    $cost_center = mysqli_real_escape_string($con, $cost_center);
    $station_code = mysqli_real_escape_string($con, $station_code);

    $select_material = "
    SELECT part_name, approved_qty, part_option, return_qty, dts_approve, cost_center, station_code 
    FROM tbl_requested 
    WHERE status IN ('approved', 'returned')
";

    if ($start_date && $end_date) {
        $select_material .= " AND dts_approve BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59'";
    }

    if (!empty($cost_center)) {
        $select_material .= " AND cost_center = '$cost_center'";
    }

    if (!empty($station_code)) {
        $select_material .= " AND station_code = '$station_code'";
    }

    $select_material .= " ORDER BY id ASC";

    $select_material_query = mysqli_query($con, $select_material);

    $grouped_data = [];
    $raw_data = [];

    if ($select_material_query) {
        while ($selected_row = mysqli_fetch_assoc($select_material_query)) {
            $part_name = $selected_row['part_name'];
            $part_qty = (int) $selected_row['approved_qty'];
            $return_qty = (int) $selected_row['return_qty'];

            $raw_data[] = [
                'dts_approve' => date('Y-m-d', strtotime($selected_row['dts_approve'])),
                'part_name' => $part_name,
                'part_qty' => $part_qty,
                'return_qty' => $return_qty,
                'cost_center' => $selected_row['cost_center'],
                'station_code' => $selected_row['station_code']
            ];

            if (!isset($grouped_data[$part_name])) {
                $grouped_data[$part_name] = [
                    'approved_qty' => 0,
                    'return_qty' => 0
                ];
            }

            $grouped_data[$part_name]['approved_qty'] += $part_qty;
            $grouped_data[$part_name]['return_qty'] += $return_qty;
        }
    }

    echo json_encode([
        'part_names' => array_keys($grouped_data),
        'part_qtys' => array_column($grouped_data, 'approved_qty'),
        'return_qtys' => array_column($grouped_data, 'return_qty'),
        'raw_data' => $raw_data
    ]);

}

?>