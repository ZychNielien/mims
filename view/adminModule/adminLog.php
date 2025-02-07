<?php
include "navBar.php";
include "../../model/dbconnection.php";
?>

<head>
    <title>Issuance History</title>
    <script src="../../public/js/jquery.js"></script>

    <link rel="stylesheet" href="../../public/css/table.css">
</head>

<section style="max-height: 90%;">
    <div class="welcomeDiv my-2">
        <h2 class="text-center" style="color: #900008; font-weight: bold;">Log History
        </h2>
    </div>

    <div class="container">
        <div class="d-flex justify-content-end m-2">
            <button id="export-btn" class="btn btn-success my-1">Export to Excel</button>
        </div>
        <table class="table table-striped w-100">
            <thead>
                <tr class="text-center" style="background-color: #900008; color: white; vertical-align: middle;">
                    <th scope="col">Date / Time / Shift</th>
                    <th scope="col">Username</th>
                    <th scope="col">Action</th>
                    <th scope="col">Description</th>
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
                            <td data-label="Part Name"><?php echo $sqlRow['username']; ?></td>
                            <td data-label="Part Desc"><?php echo $sqlRow['action']; ?></td>
                            <td data-label="Quantity"><?php echo $sqlRow['description']; ?></td>
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

<script src="../../public/js/excel.js"></script>

<script>
    $('#export-btn').on('click', function () {
        var visibleRows = $('#data-table .table-row');
        var filteredRows = [];

        visibleRows.each(function () {
            if ($(this).css('display') !== 'none') {
                filteredRows.push(this);
            }
        });

        var table = $('<table></table>');
        var headerRow = $('table thead').clone();
        table.append(headerRow);

        $(filteredRows).each(function () {
            var newRow = $(this).clone();
            table.append(newRow);
        });

        var wb = XLSX.utils.table_to_book(table[0], { sheet: "Filtered Data" });
        XLSX.writeFile(wb, "ReceivingHistory.xlsx");
    });

</script>