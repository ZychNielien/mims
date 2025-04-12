<?php

include "../../model/dbconnection.php";
include "navBar.php";

?>

<head>

    <title>Expired Part History</title>
    <link rel="stylesheet" href="../../public/css/table.css">
    <script src="../../public/js/jquery.js"></script>
    <script src="../../public/js/excel.js"></script>

</head>

<section style="max-height: 90%;">

    <!-- Main Container -->
    <div class="mx-5">

        <!-- Title Div -->
        <div class="welcomeDiv my-2">
            <h2 class="text-center" style="color: #900008; font-weight: bold;">Expired Part History
            </h2>
        </div>

        <!-- Export to Excel -->
        <div class="d-flex flex-wrap justify-content-evenly">
            <input type="text" id="search-box" placeholder="Search..." />
            <button id="export-btn" class="btn btn-success my-2">Export to Excel</button>
        </div>

        <!-- Expired Part Table -->
        <table class="table table-striped w-100">

            <thead>
                <tr class="text-center" style="background-color: #900008; color: white; vertical-align: middle;">
                    <th scope="col">Part Number</th>
                    <th scope="col">Part Quantity</th>
                    <th scope="col">Expiration Date</th>
                    <th scope="col">Batch Number</th>
                    <th scope="col">Kitting ID</th>
                    <th scope="col">Added By</th>

                </tr>
            </thead>

            <tbody id="data-table">
                <?php
                $userName = $_SESSION['username'];
                $sql = "SELECT *, SUM(part_qty) AS total_part_qty
            FROM tbl_stock
            WHERE status = 'Expired'
            GROUP BY part_name, exp_date ORDER BY exp_date DESC";
                $sql_query = mysqli_query($con, $sql);

                if (mysqli_num_rows($sql_query) > 0) {
                    while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                        ?>
                        <tr class="table-row  text-center">

                            <td data-label="Part Name"><?php echo $sqlRow['part_name']; ?></td>
                            <td data-label="Quantity"><?php echo $sqlRow['total_part_qty']; ?></td>
                            <td data-label="Expiration Date"><?php echo $sqlRow['exp_date']; ?></td>
                            <td data-label="Batch Number"><?php echo $sqlRow['batch_number']; ?></td>
                            <td data-label="Kitting ID"><?php echo $sqlRow['kitting_id']; ?></td>
                            <td data-label="Added By"><?php echo $sqlRow['updated_by']; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="10" class="text-center">No items found</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>

        </table>

    </div>

</section>

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
            XLSX.writeFile(wb, "expired_part.xlsx");
        });

    });
</script>