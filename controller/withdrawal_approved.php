<?php

// Session Start
session_start();

// Database Connection
include "../model/dbconnection.php";
$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';

$userName = $_SESSION['username'];

// Select Withdrawal Request Where Status is Approved
$sql = "SELECT * FROM tbl_requested WHERE req_by = '$userName' AND status = 'approved'";

if ($startDate && $endDate) {
    $startDateTime = $startDate . ' 00:00:00';
    $endDateTime = $endDate . ' 23:59:59';

    $sql .= " AND dts_approve BETWEEN '$startDateTime' AND '$endDateTime'";
}

$sql_query = mysqli_query($con, $sql);

if (mysqli_num_rows($sql_query) > 0) {

    while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
        ?>
        <tr class='table-row text-center' style="vertical-align: middle;">
            <td data-label='Date / Time / Shift'><?php echo $sqlRow['dts_approve']; ?></td>
            <td data-label='Lot Id'><?php echo $sqlRow['lot_id']; ?></td>
            <td data-label='Part Name'><?php echo $sqlRow['part_name']; ?></td>
            <td data-label='Part Desc'><?php echo $sqlRow['part_desc']; ?></td>
            <td data-label='Part Qty'><?php echo $sqlRow['part_qty']; ?></td>
            <td data-label='Machine Number'><?php echo $sqlRow['machine_no']; ?></td>
            <td data-label='Qithdrawal Reason'><?php echo $sqlRow['with_reason']; ?></td>
            <td data-label='Return By'><?php echo $sqlRow['req_by']; ?></td>
            <td data-label='Status'><?php echo $sqlRow['status']; ?></td>
            <td data-label='Return Qty'><?php echo $sqlRow['approved_by']; ?></td>
            <td data-label='Receieved By'> <button class="btn btn-primary return-btn" data-bs-toggle="modal"
                    data-bs-target="#returnModal" data-id="<?php echo $sqlRow['id']; ?>"
                    data-part-qty="<?php echo $sqlRow['part_qty']; ?>" data-req-by="<?php echo $sqlRow['req_by']; ?>"
                    data-part-name="<?php echo $sqlRow['part_name']; ?>">Return</button></td>
        </tr>
        <?php
    }
} else {
    echo "<tr><td colspan='11' class='text-center'>No approved request found</td></tr>";
}
?>