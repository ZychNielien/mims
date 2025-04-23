<?php

include "../../model/dbconnection.php";
include "navBar.php";

?>

<head>

    <title>Issuance History</title>
    <script src="../../public/js/jquery.js"></script>
    <link rel="stylesheet" href="../../public/css/table.css">

</head>

<section style="max-height: 90%;">

    <!-- Title Div -->
    <div class="welcomeDiv my-2">
        <h2 class="text-center" style="color: #900008; font-weight: bold;">Issuance History
        </h2>
    </div>

    <!-- Main Container -->
    <div class="mx-5">

        <!-- Search and Export to Excel -->
        <div class="d-flex flex-wrap justify-content-evenly">
            <input type="text" id="search-box" placeholder="Search..." />
            <button id="export-btn" class="btn btn-success my-2">Export to Excel</button>
        </div>

        <!-- Issuance History Table -->
        <table class="table table-striped w-100">

            <thead>
                <tr class="text-center" style="background-color: #900008; color: white; vertical-align: middle;">
                    <th scope="col">Date / Time / Shift</th>
                    <th scope="col">Lot ID</th>
                    <th scope="col">Part Number</th>
                    <th scope="col">Item Description</th>
                    <th scope="col">Qty.</th>
                    <th scope="col">Machine No.</th>
                    <th scope="col">Withdrawal Reason</th>
                    <th scope="col">Requested By</th>
                    <th scope="col">Approved Qty</th>
                    <th scope="col">Batch Number</th>
                    <th scope="col">Approved Reason</th>
                    <th scope="col">Approved By</th>
                </tr>
            </thead>

            <tbody id="data-table">
                <?php
                $userName = $_SESSION['username'];
                $sql = "SELECT * FROM tbl_requested WHERE status = 'Approved' ORDER BY dts_approve DESC";
                $sql_query = mysqli_query($con, $sql);

                if (mysqli_num_rows($sql_query) > 0) {
                    while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                        ?>
                        <tr class="table-row  text-center">

                            <td data-label="Date / Time / Shift"><?php echo $sqlRow['dts_approve']; ?></td>
                            <td data-label="Lot Id"><?php echo $sqlRow['lot_id']; ?></td>
                            <td data-label="Part Name"><?php echo $sqlRow['part_name']; ?></td>
                            <td data-label="Part Desc"><?php echo $sqlRow['part_desc']; ?></td>
                            <td data-label="Quantity"><?php echo $sqlRow['part_qty']; ?></td>
                            <td data-label="Machine No"><?php echo $sqlRow['machine_no']; ?></td>
                            <td data-label="Reason"><?php echo $sqlRow['with_reason']; ?></td>
                            <td data-label="Requested By"><?php echo $sqlRow['req_by']; ?></td>
                            <td data-label='Approved Qty'><?php echo $sqlRow['approved_qty']; ?></td>
                            <td data-label="Batch Number"><?php echo $sqlRow['batch_number']; ?></td>
                            <td data-label='Approved Reason'><?php echo $sqlRow['approved_reason']; ?></td>
                            <td data-label="Approved By"><?php echo $sqlRow['approved_by']; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="12" class="text-center">No issuance found</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>

        </table>

    </div>

</section>

<!-- Excel Script -->
<script src="../../public/js/excel.js"></script>

<script>
    $(document).ready(function () {

        // Search Input Script
        $('#search-box').on('keyup', function () {
            var value = $(this).val().toLowerCase();
            $('#data-table .table-row').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

        // Export to Excel Script
        $('#export-btn').on('click', function () {
            var visibleRows = $('#data-table .table-row:visible');
            var table = $('<table></table>');
            var headerRow = $('table thead').clone(true);
            table.append(headerRow);

            visibleRows.each(function () {
                var newRow = $(this).clone(true);
                table.append(newRow);
            });

            var wb = XLSX.utils.table_to_book(table[0], { sheet: "Filtered Data" });
            XLSX.writeFile(wb, "issuance_history.xlsx");
        });

    });

</script>