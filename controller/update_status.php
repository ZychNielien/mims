<?php
include "../model/dbconnection.php";

if (isset($_POST['action']) && isset($_POST['ids']) && !empty($_POST['ids'])) {
    $ids = $_POST['ids'];
    $status = $_POST['action'] == 'approve' ? 'approved' : 'rejected';

    if ($status === 'approved') {

        $ids_str = implode(',', $ids);
        $sql = "UPDATE tbl_requested SET status = 'approved' WHERE id IN ($ids_str)";
        if (mysqli_query($con, $sql)) {
            echo "Success";
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else if ($status === 'rejected') {

        $qty = $_POST['qty'];
        $part_name = $_POST['part_name'];

        $total_rejected_qty = array_sum($qty);
        echo "Total quantity rejected: " . $total_rejected_qty;

        for ($i = 0; $i < count($ids); $i++) {
            $current_qty = $qty[$i];
            $current_part_name = $part_name[$i];

            $qty_update = "UPDATE tbl_inventory SET part_qty = part_qty + $current_qty WHERE part_name = '$current_part_name'";
            if (mysqli_query($con, $qty_update)) {

                $sql = "UPDATE tbl_requested SET status = 'rejected' WHERE id = {$ids[$i]}";
                mysqli_query($con, $sql);
            } else {
                echo "Error updating inventory for part: $current_part_name";
            }
        }
    }
}
?>