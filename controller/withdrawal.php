<?php
include "../model/dbconnection.php";
date_default_timezone_set('Asia/Manila');
session_start();

$redirect = '';
$account_type = $_SESSION['user'] ?? '';

if ($account_type === 'Supervisor' || $account_type === 'Kitting') {
    $redirect = '../view/adminModule/adminWithdrawal.php';
} elseif ($account_type === 'User') {
    $redirect = '../view/userModule/userDashboard.php';
}

if (isset($_POST['mat_req_part'])) {
    $part_id = mysqli_real_escape_string($con, $_POST['part_name']);
    $dts = date('Y-m-d H:i:s');
    $lot_id = mysqli_real_escape_string($con, $_POST['lot_id']);
    $part_desc = mysqli_real_escape_string($con, $_POST['part_desc']);
    $station_code = mysqli_real_escape_string($con, $_POST['station_code']);
    $part_qty = mysqli_real_escape_string($con, $_POST['part_qty']);
    $machine_no = mysqli_real_escape_string($con, $_POST['machine_no']);
    $with_reason = mysqli_real_escape_string($con, $_POST['with_reason']);
    $req_by = mysqli_real_escape_string($con, $_POST['req_by']);
    $status = 'Pending';
    $cost_center = mysqli_real_escape_string($con, $_POST['cost_center']);
    $part_option = mysqli_real_escape_string($con, $_POST['part_option']);
    $part_item_code = mysqli_real_escape_string($con, $_POST['part_item_code']);

    $check_sql = "SELECT ti.approver, ts.batch_number, ts.item_code, ts.exp_date
                  FROM tbl_stock ts
                  LEFT JOIN tbl_inventory ti ON ts.part_name = ti.part_name
                  WHERE ts.part_name = '$part_id' 
                    AND ts.item_code = '$part_item_code' 
                    AND ts.status = 'Active'
                  ORDER BY ts.exp_date ASC";

    $check_sql_query = mysqli_query($con, $check_sql);
    $checked_row = mysqli_fetch_assoc($check_sql_query);

    if ($checked_row) {
        $batch_number = $checked_row['batch_number'];
        $expiration_date = $checked_row['exp_date'];
        $approver = $checked_row['approver'];

        $sql = "INSERT INTO tbl_requested 
                (dts, part_name, lot_id, part_desc, station_code, part_qty, machine_no, with_reason, req_by, status, cost_center, part_option, exp_date, batch_number, item_code) 
                VALUES 
                ('$dts', '$part_id', '$lot_id', '$part_desc', '$station_code', '$part_qty', '$machine_no', '$with_reason', '$req_by', '$status', '$cost_center', '$part_option', '$expiration_date', '$batch_number', '$part_item_code')";

        if (mysqli_query($con, $sql)) {

            $message = $req_by . ' has requested ' . $part_qty . ' of ' . $part_id . '. Click here for more details.';
            $notif_sql = "INSERT INTO tbl_notif 
                          (username, message, is_read, created_at, for_who, destination) 
                          VALUES 
                          ('$req_by', '$message', 0, '$dts', '$approver', 'Approval')";

            mysqli_query($con, $notif_sql);

            $_SESSION['status'] = "Request sent successfully!";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Error sending request: " . mysqli_error($con);
            $_SESSION['status_code'] = "error";
        }
    } else {
        $_SESSION['status'] = "No active stock found for this part.";
        $_SESSION['status_code'] = "error";
    }
} else {
    $_SESSION['status'] = "Something is missing.";
    $_SESSION['status_code'] = "error";
}

if ($redirect) {
    header("Location: $redirect");
    exit();
} else {
    echo "Redirect failed: invalid or missing account type.";
    exit();
}
