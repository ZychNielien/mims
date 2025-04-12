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
        <h2 class="text-center" style="color: #900008; font-weight: bold;">Log History
        </h2>
    </div>

    <!-- Main Div -->
    <div class="mx-5">

        <!-- Search Input and Export to Excel -->
        <div class="d-flex flex-wrap justify-content-evenly">
            <input type="text" id="search-box" placeholder="Search..." />
            <button id="export-btn" class="btn btn-success my-2">Export to Excel</button>
        </div>

        <!-- Log History -->
        <table class="table table-striped w-100">

            <thead>
                <tr class="text-center" style="background-color: #900008; color: white; vertical-align: middle;">
                    <th scope="col">Date / Time / Shift</th>
                    <th scope="col">Username</th>
                    <th scope="col">Action</th>
                    <th scope="col">Description</th>
                    <th scope="col">Reasons</th>
                </tr>
            </thead>

            <tbody id="data-table">
                <?php
                $userName = $_SESSION['username'];
                $sql = "SELECT * FROM tbl_log ORDER BY dts DESC";
                $sql_query = mysqli_query($con, $sql);

                if (mysqli_num_rows($sql_query) > 0) {
                    while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                        ?>
                        <tr class="table-row  text-center">
                            <td data-label="Date / Time / Shift"><?php echo $sqlRow['dts']; ?></td>
                            <td data-label="Username"><?php echo $sqlRow['username']; ?></td>
                            <td data-label="Action"><?php echo $sqlRow['action']; ?></td>
                            <td data-label="Description"><?php echo $sqlRow['description']; ?></td>
                            <td data-label="Reason"><?php echo $sqlRow['reasons']; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="11" class="text-center">No logs found</td>
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
            XLSX.writeFile(wb, "log_history.xlsx");
        });

    });
</script>