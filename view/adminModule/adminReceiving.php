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
        <h2 class="text-center" style="color: #900008; font-weight: bold;">Receiving History
        </h2>
    </div>

    <div class="container">
        <div class="d-flex flex-wrap justify-content-evenly">
            <input type="text" id="search-box" placeholder="Search..." />
            <button id="export-btn" class="btn btn-success my-2">Export to Excel</button>
        </div>
        <table class="table table-striped w-100">
            <thead>
                <tr class="text-center" style="background-color: #900008; color: white; vertical-align: middle;">
                    <th scope="col">Date / Time / Shift</th>
                    <th scope="col">Part Name</th>
                    <th scope="col">Part Desc</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Expiration Date</th>
                    <th scope="col">Kitting ID</th>
                    <th scope="col">Received By</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody id="data-table">
                <?php
                $userName = $_SESSION['username'];
                $sql = "SELECT * FROM tbl_history WHERE status = 'Received'  ORDER BY dts DESC";
                $sql_query = mysqli_query($con, $sql);

                if (mysqli_num_rows($sql_query) > 0) {
                    while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                        ?>
                        <tr class="table-row  text-center">

                            <td data-label="Date / Time / Shift"><?php echo $sqlRow['dts']; ?></td>
                            <td data-label="Part Name"><?php echo $sqlRow['part_name']; ?></td>
                            <td data-label="Part Desc"><?php echo $sqlRow['part_desc']; ?></td>
                            <td data-label="Quantity"><?php echo $sqlRow['part_qty']; ?></td>
                            <td data-label="Expiration Date"><?php echo $sqlRow['exp_date']; ?></td>
                            <td data-label="Kitting ID"><?php echo $sqlRow['kitting_id']; ?></td>
                            <td data-label="Received By"><?php echo $sqlRow['updated_by']; ?></td>
                            <td data-label="Status"><?php echo $sqlRow['status']; ?></td>
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

<script src="../../public/js/excel.js"></script>

<script>
    $(document).ready(function () {
        $('#search-box').on('keyup', function () {
            var value = $(this).val().toLowerCase();
            $('#data-table .table-row').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

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
            XLSX.writeFile(wb, "ReceivingHistory.xlsx");
        });

    });
</script>