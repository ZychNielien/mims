<?php

include "../model/dbconnection.php";
session_start();
date_default_timezone_set('Asia/Manila');

if (isset($_POST['submit_new_part'])) {
    $new_part_name = $_POST['new_part_name'];
    $new_part_desc = $_POST['new_part_desc'];
    $new_part_qty = $_POST['new_part_qty'];

    $check_part_sql = "SELECT * FROM `tbl_inventory` WHERE part_name = '$new_part_name'";
    $check_part_query = mysqli_query($con, $check_part_sql);

    if (mysqli_num_rows($check_part_query) > 0) {
        $_SESSION['status'] = "We apologize, but a part with this name already exists in the system.";
        $_SESSION['status_code'] = "error";
        header("location: ../view/adminModule/adminDashboard.php");
        exit();
    } else {
        $new_part_SQL = "INSERT INTO `tbl_inventory` (part_name, part_desc, part_qty) VALUES ('$new_part_name','$new_part_desc','$new_part_qty')";
        $new_part_SQL_query = mysqli_query($con, $new_part_SQL);

        if ($new_part_SQL_query) {
            $_SESSION['status'] = "The new part has been successfully added";
            $_SESSION['status_code'] = "success";
            header("location: ../view/adminModule/adminDashboard.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
}

if (isset($_POST['update_part_qty'])) {
    $part_Id = $_POST['part_name'];
    $part_qty = $_POST['part_qty'];

    $sqlSelect = "SELECT part_qty FROM `tbl_inventory` WHERE id = '$part_Id'";
    $sqlSelect_query = mysqli_query($con, $sqlSelect);
    $selectRow = mysqli_fetch_assoc($sqlSelect_query);
    $part_qty_old = $selectRow['part_qty'];
    $new_part_qty = $part_qty + $part_qty_old;

    $sql = "UPDATE `tbl_inventory` SET part_qty = '$new_part_qty' WHERE id = '$part_Id'";
    $sql_query = mysqli_query($con, $sql);

    if ($sql_query) {
        $_SESSION['status'] = "Updated successfully!";
        $_SESSION['status_code'] = "success";
        header("location: ../view/adminModule/adminDashboard.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}


if (isset($_POST['req_part'])) {

    $part_id = $_POST['part_name'];
    $dts = date('Y-m-d H:i:s');
    $lot_id = $_POST['lot_id'];
    $part_desc = $_POST['part_desc'];
    $station_code = $_POST['station_code'];
    $part_qty = $_POST['part_qty'];
    $machine_no = $_POST['machine_no'];
    $with_reason = $_POST['with_reason'];
    $req_by = $_POST['req_by'];
    $status = 'Pending';


    $check_sql = "SELECT * FROM `tbl_inventory` WHERE id = '$part_id'";
    $check_sql_query = mysqli_query($con, $check_sql);
    $checkedRow = mysqli_fetch_assoc($check_sql_query);
    $part_name = $checkedRow['part_name'];
    $part_total_qty = $checkedRow['part_qty'];

    if ($part_qty < $part_total_qty) {

        $updated_part_qty = $checkedRow['part_qty'] - $part_qty;

        echo $updated_part_qty;

        $updated_qty = "UPDATE `tbl_inventory` SET part_qty = '$updated_part_qty' WHERE id = '$part_id'";
        $updated_qty_query = mysqli_query($con, $updated_qty);

        if ($updated_qty_query) {

            $sql = "INSERT INTO `tbl_requested` (dts,part_name, lot_id, part_desc, station_code, part_qty, machine_no, with_reason, req_by, status) VALUES ('$dts','$part_name','$lot_id','$part_desc','$station_code','$part_qty','$machine_no','$with_reason','$req_by','$status')";
            $sql_query = mysqli_query($con, $sql);

            if ($sql_query) {
                $mensahe = 'The ' . $req_by . ' has requested ' . $part_qty . ' of ' . $part_name . '. Click here for more details.';
                $for = "admin";


                $sql_notif = "INSERT INTO `tbl_notif` (username, message, is_read, created_at,for_who) VALUES ('$req_by', '$mensahe',0,'$dts','$for')";
                $sql_notif_query = mysqli_query($con, $sql_notif);

                if ($sql_notif_query) {
                    $_SESSION['status'] = "Request sent successfully!";
                    $_SESSION['status_code'] = "success";
                    header("location: ../view/userModule/userDashboard.php");
                    exit();
                }



            } else {
                echo "Error: " . mysqli_error($con);
            }
        } else {
            echo "Error: " . mysqli_error($con);
        }



    } else {
        $_SESSION['status'] = "The quantity for this part is insufficient.";
        $_SESSION['status_code'] = "error";
        header("location: ../view/userModule/userDashboard.php");
        exit();
    }
}


if (isset($_POST['action']) && $_POST['action'] === 'delete_selected' && isset($_POST['ids'])) {
    $ids = $_POST['ids'];
    $qty = $_POST['qty'];
    $part_names = $_POST['part_name'];

    for ($i = 0; $i < count($ids); $i++) {
        $id = $ids[$i];
        $current_qty = $qty[$i];
        $current_part_name = $part_names[$i];

        $sql = "DELETE FROM tbl_requested WHERE id = $id";
        $delete_result = mysqli_query($con, $sql);

        if ($delete_result) {

            $update_inventory_sql = "UPDATE tbl_inventory SET part_qty = part_qty + $current_qty WHERE part_name = '$current_part_name'";
            mysqli_query($con, $update_inventory_sql);
        } else {
            echo "Error deleting record with ID: $id";
            exit;
        }
    }

    echo "Success";
}


if (isset($_POST['delete_multiple']) && isset($_POST['selected_items'])) {

    $selected_items = json_decode($_POST['selected_items']);

    $ids = implode(",", array_map('intval', $selected_items));

    $sql = "DELETE FROM `tbl_inventory` WHERE `id` IN ($ids)";

    if (mysqli_query($con, $sql)) {
        echo json_encode([
            'success' => true,
            'message' => 'Selected items deleted successfully.'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error deleting items: ' . mysqli_error($con)
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'No items selected for deletion.'
    ]);
}

if (isset($_POST['update_namedesc'])) {
    $part_id = $_POST['id'];
    $part_name = $_POST['part_name'];
    $part_desc = $_POST['part_desc'];

    $sql = "UPDATE `tbl_inventory` SET part_name = '$part_name' , part_desc = '$part_desc' WHERE id = '$part_id'";
    $sql_query = mysqli_query($con, $sql);
    if ($sql_query) {
        $_SESSION['status'] = "Updated successfully!";
        $_SESSION['status_code'] = "success";
        header("location: ../view/adminModule/adminDashboard.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>