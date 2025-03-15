<?php

// Database Connection
include "../model/dbconnection.php";

// Manila Time Zone
date_default_timezone_set('Asia/Manila');
$inventoryData = [];

$today = date('Y-m-d');

// Updating Expired Stocks
$update_expired_sql = "UPDATE tbl_stock SET status = 'Expired' WHERE exp_date <= '$today' AND status != 'Expired'";
mysqli_query($con, $update_expired_sql);

// Selecting All Active Stocks
$sql = "SELECT ti.*, 
       IFNULL(MIN(CASE WHEN ts.status = 'Active' THEN ts.exp_date END), '') AS least_exp_date, 
       IFNULL(SUM(CASE WHEN ts.status = 'Active' THEN ts.part_qty END), 0) AS total_part_qty,
       SUM(CASE WHEN ts.status = 'Expired' THEN ts.part_qty ELSE 0 END) AS expired_qty
        FROM tbl_inventory ti
        LEFT JOIN tbl_stock ts ON ti.part_name = ts.part_name
        GROUP BY ti.part_name, ti.part_desc, ti.min_invent_req
        ORDER BY ti.id ASC";
$sql_query = mysqli_query($con, $sql);

if ($sql_query) {
    while ($sql_row = mysqli_fetch_assoc($sql_query)) {
        $min_invent_req = $sql_row['min_invent_req'];
        $total_qty = $sql_row['total_part_qty'];
        $expired_qty = $sql_row['expired_qty'];
        $part_name = $sql_row['part_name'];
        $part_desc = $sql_row['part_desc'];

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
                'location' => $sql_row['location'],
                'unit' => $sql_row['unit'],
                'least_exp_date' => $sql_row['least_exp_date'],
                'total_part_qty' => $total_qty,
                'expired_qty' => $expired_qty
            ];

            if ($expired_qty > 0) {

                // Selecting Expired Notif
                $check_notification_sql = "SELECT * FROM tbl_notif WHERE message LIKE '%$part_name%' AND for_who = 'admin' AND destination = 'Expired' AND DATE(created_at) = '$today'";
                $check_notification_query = mysqli_query($con, $check_notification_sql);

                if (mysqli_num_rows($check_notification_query) == 0) {
                    $dts = date('Y-m-d H:i:s');
                    $message = htmlspecialchars($part_name, ENT_QUOTES, 'UTF-8') . ' has expired. Total expired quantity: ' . $expired_qty;
                    $for = "admin";

                    // Inserting Expired Notification
                    $sql_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) 
                                  VALUES ('System', '$message', 0, '$dts', '$for', 'Expired')";
                    $sql_notif_query = mysqli_query($con, $sql_notif);

                    if (!$sql_notif_query) {
                        echo "Error creating notification: " . mysqli_error($con);
                    }
                }
            }
        }
    }
}

header('Content-Type: application/json');
echo json_encode($inventoryData);

?>