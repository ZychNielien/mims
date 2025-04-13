<?php

include "../../model/dbconnection.php";
include "navBar.php";

?>

<head>

    <title>Rejection History</title>
    <script src="../../public/js/jquery.js"></script>
    <link rel="stylesheet" href="../../public/css/table.css">

</head>

<section style="max-height: 90%;">

    <!-- Title Div -->
    <div class="welcomeDiv my-2">
        <h2 class="text-center" style="color: #900008; font-weight: bold;">Rejection History
        </h2>
    </div>

    <!-- Main Container -->
    <div class="mx-5">

        <!-- Rejection History Table -->
        <table class="table table-striped w-100">

            <thead>
                <tr class="text-center" style="background-color: #900008; color: white; vertical-align: middle;">
                    <th scope="col">Date / Time / Shift</th>
                    <th scope="col">Lot ID</th>
                    <th scope="col">Part Number</th>
                    <th scope="col">Item Description</th>
                    <th scope="col">Qty.</th>
                    <th scope="col">Batch Number</th>
                    <th scope="col">Machine No.</th>
                    <th scope="col">Withdrawal Reason</th>
                    <th scope="col">Requested By</th>
                    <th scope="col">Rejected By</th>

                </tr>
            </thead>
            <tbody id="data-table">

                <?php
                $userName = $_SESSION['username'];
                $sql = "SELECT * FROM tbl_requested WHERE status = 'rejected'  ORDER BY dts_rejected DESC";
                $sql_query = mysqli_query($con, $sql);

                if (mysqli_num_rows($sql_query) > 0) {
                    while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                        ?>
                        <tr class="table-row  text-center">

                            <td data-label="Date / Time / Shift"><?php echo $sqlRow['dts_rejected']; ?></td>
                            <td data-label="Lot Id"><?php echo $sqlRow['lot_id']; ?></td>
                            <td data-label="Part Name"><?php echo $sqlRow['part_name']; ?></td>
                            <td data-label="Part Desc"><?php echo $sqlRow['part_desc']; ?></td>
                            <td data-label="Quantity"><?php echo $sqlRow['part_qty']; ?></td>
                            <td data-label="Batch Number"><?php echo $sqlRow['batch_number']; ?></td>
                            <td data-label="Machine No"><?php echo $sqlRow['machine_no']; ?></td>
                            <td data-label="Reason"><?php echo $sqlRow['with_reason']; ?></td>
                            <td data-label="Requested By"><?php echo $sqlRow['req_by']; ?></td>
                            <td data-label="Rejected By"><?php echo $sqlRow['rejected_by']; ?></td>

                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="11" class="text-center">No items found</td>
                    </tr>
                    <?php
                }
                ?>

            </tbody>

        </table>

    </div>

</section>