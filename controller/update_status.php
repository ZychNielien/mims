<?php

// Database Connection
include "../model/dbconnection.php";

// Manila Time Zone
date_default_timezone_set('Asia/Manila');

// Session Start
session_start();

$dts = date('Y-m-d H:i:s');
$username = $_SESSION['username'];

// Admin Withdrawal Requests Approval 
if (isset($_POST['approve_submit'])) {
    if (isset($_POST['ids']) && isset($_POST['quantities']) && isset($_POST['reasons']) && isset($_POST['part_names']) && isset($_POST['request_bys'])) {
        $ids = $_POST['ids'];
        $quantities = $_POST['quantities'];
        $reasons = $_POST['reasons'];
        $part_names = $_POST['part_names'];
        $request_bys = $_POST['request_bys'];
        $success = true;

        for ($i = 0; $i < count($ids); $i++) {
            $id = intval($ids[$i]);
            $quantity = intval($quantities[$i]);
            $reason = mysqli_real_escape_string($con, $reasons[$i]);
            $current_part_name = $part_names[$i];
            $current_req_by = $request_bys[$i];

            $mensahe = $username . ' has approved ' . $quantity . ' of ' . $current_part_name . '. Click here for more details.';
            $sql_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) 
                          VALUES ('$username', '$mensahe', 0, '$dts', '$current_req_by','Approved')";

            if (!mysqli_query($con, $sql_notif)) {
                $success = false;
                break;
            }

            $updateQuery = "UPDATE tbl_requested SET approved_qty='$quantity', approved_reason='$reason', status='Approved' , approved_by = '$username' , dts_approve = '$dts' WHERE id='$id'";

            if (!mysqli_query($con, $updateQuery)) {
                $success = false;
                break;
            }

            $getPartQtyQuery = "SELECT part_qty, part_name, exp_date FROM tbl_requested WHERE id='$id'";
            $result = mysqli_query($con, $getPartQtyQuery);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $part_qty = $row['part_qty'];
                $part_name = $row['part_name'];
                $exp_date = $row['exp_date'];

                if ($quantity < $part_qty) {
                    $stockDiff = $part_qty - $quantity;

                    $updateStockQuery = "UPDATE tbl_stock SET part_qty = part_qty + '$stockDiff' WHERE part_name = '$part_name' AND exp_date = '$exp_date'";

                    if (!mysqli_query($con, $updateStockQuery)) {
                        $success = false;
                        break;
                    }
                }
            } else {
                $success = false;
                break;
            }
        }

        header('Content-Type: application/json');
        echo json_encode(["success" => $success]);
    } else {
        echo json_encode(["success" => false, "error" => "Missing data"]);
    }
}

// Admin Withdrawal Requests Rejection 
if (isset($_POST['reject_submit'])) {
    if (isset($_POST['ids']) && isset($_POST['reasons']) && isset($_POST['part_names']) && isset($_POST['request_bys']) && isset($_POST['quantities']) && isset($_POST['exp_dates'])) {
        $ids = $_POST['ids'];
        $reasons = $_POST['reasons'];
        $part_names = $_POST['part_names'];
        $req_bys = $_POST['request_bys'];
        $quantities = $_POST['quantities'];
        $exp_dates = $_POST['exp_dates'];

        $success = true;

        for ($i = 0; $i < count($ids); $i++) {
            $id = intval($ids[$i]);
            $reason = mysqli_real_escape_string($con, $reasons[$i]);
            $quantity = intval($quantities[$i]);
            $current_part_name = $part_names[$i];
            $current_req_by = $req_bys[$i];
            $exp_date = $exp_dates[$i];


            $qty_update = "UPDATE tbl_stock SET part_qty = part_qty + $quantity WHERE part_name = '$current_part_name' AND exp_date = '$exp_date'";

            if (mysqli_query($con, $qty_update)) {

                $mensahe = $username . ' has rejected ' . $quantity . ' of ' . $current_part_name . '. Click here for more details.';
                $sql_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at, for_who, destination) 
                         VALUES ('$username', '$mensahe', 0, '$dts', '$current_req_by' , 'Rejected')";

                if (!mysqli_query($con, $sql_notif)) {
                    $success = false;
                    break;
                }

                $updateQuery = "UPDATE tbl_requested SET rejected_reason='$reason', status='Rejected' , rejected_by = '$username' , dts_rejected = '$dts' WHERE id='$id'";
                if (!mysqli_query($con, $updateQuery)) {
                    $success = false;
                    break;
                }
            }
        }

        echo json_encode(["success" => $success]);
    } else {
        echo json_encode(["success" => false, "error" => "Missing data"]);
    }
}

// Admin Withdrawal Requests Return
if (isset($_POST['submitReturn'])) {
    $lot_id = $_POST['id'];
    $return_qty = $_POST['return_qty'];
    $return_reason = $_POST['return_reason'];
    $dts = date('Y-m-d H:i:s');
    $req_by = $_POST['req_by'];
    $part_name = $_POST['part_name'];
    $mensahe = $req_by . ' is returning ' . $return_qty . ' of ' . $part_name . '. Click here for more details.';
    $for = "admin";

    if ($return_qty <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid quantity.']);
        exit();
    }

    $sql = "UPDATE tbl_requested 
            SET status = 'returning', return_reason = '$return_reason', dts_return = '$dts', return_qty = '$return_qty'
            WHERE id = '$lot_id' AND status = 'Approved'";

    if (mysqli_query($con, $sql)) {
        $sql_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at,for_who, destination) VALUES ('$req_by', '$mensahe',0,'$dts','$for', 'Scrap')";
        $sql_notif_query = mysqli_query($con, $sql_notif);

        if ($sql_notif_query) {
            if ($_SESSION['user'] == "Supervisor" || $_SESSION['user'] == "Kitting") {
                $_SESSION['status'] = 'You are now authorized to return the ' . $part_name . ' with a quantity of ' . $return_qty;
                $_SESSION['status_code'] = "success";
                header("location: ../view/adminModule/adminWithdrawal.php?tab=approved");
                exit();
            } else if ($_SESSION['user'] == "User") {
                $_SESSION['status'] = 'You are now authorized to return the ' . $part_name . ' with a quantity of ' . $return_qty;
                $_SESSION['status_code'] = "success";
                header("location: ../view/userModule/userHistory.php?tab=approved");
                exit();
            }


        }

    }
}


?>