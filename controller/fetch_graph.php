<?php
session_start();
date_default_timezone_set('Asia/Manila');

include "../model/dbconnection.php";

if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];

    $start_date = mysqli_real_escape_string($con, $start_date);
    $end_date = mysqli_real_escape_string($con, $end_date);

    if ($start_date && $end_date) {
        $select_material = "
            SELECT part_name, part_qty, part_option, return_qty 
            FROM tbl_requested 
            WHERE NOT status = 'Pending' 
            AND dts_approve BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59'
            ORDER BY id ASC
        ";
    } else {
        $select_material = "
            SELECT part_name, part_qty, part_option, return_qty 
            FROM tbl_requested 
            WHERE NOT status = 'Pending' 
            ORDER BY id ASC
        ";
    }

    $select_material_query = mysqli_query($con, $select_material);

    $grouped_data = [];

    if ($select_material_query) {
        while ($selected_row = mysqli_fetch_assoc($select_material_query)) {
            $part_name = $selected_row['part_name'];
            $part_qty = (int) $selected_row['part_qty'];
            $return_qty = (int) $selected_row['return_qty'];

            if (!isset($grouped_data[$part_name])) {
                $grouped_data[$part_name] = [
                    'part_qty' => 0,
                    'return_qty' => 0
                ];
            }

            $grouped_data[$part_name]['part_qty'] += $part_qty;
            $grouped_data[$part_name]['return_qty'] += $return_qty;
        }
    }

    $part_names = array_keys($grouped_data);
    $part_qtys = array_column($grouped_data, 'part_qty');
    $return_qtys = array_column($grouped_data, 'return_qty');

    echo json_encode([
        'part_names' => $part_names,
        'part_qtys' => $part_qtys,
        'return_qtys' => $return_qtys
    ]);
}
?>