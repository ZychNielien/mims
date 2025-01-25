<?php
include "navBar.php";
include "../../model/dbconnection.php";
?>

<head>
    <title>Material History</title>
    <script src="../../public/js/jquery.js"></script>

    <link rel="stylesheet" href="../../public/css/table.css">
</head>

<section style="max-height: 90%;">
    <div class="welcomeDiv my-2">
        <h2 class="text-center" style="color: #900008; font-weight: bold;">Welcome, <?php echo $_SESSION['username'] ?>!
        </h2>
    </div>

    <div class="container">

        <div class="d-flex justify-content-evenly">
            <input type="text" id="search-box" placeholder="Search..." />
            <button id="export-btn" class="btn btn-success my-2">Export to Excel</button>
        </div>

        <table class="table table-striped w-100">
            <thead>
                <tr class="text-center" style="background-color: #900008; color: white; vertical-align: middle;">
                    <th scope="col">Date / Time / Shift</th>
                    <th scope="col">Lot ID</th>
                    <th scope="col">Part Name</th>
                    <th scope="col">Item Description</th>
                    <th scope="col">Qty.</th>
                    <th scope="col">Machine No.</th>
                    <th scope="col">Withdrawal Reason</th>
                    <th scope="col">Requested By</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody id="data-table">
                <?php
                $userName = $_SESSION['username'];
                $sql = "SELECT * FROM tbl_requested WHERE NOT status = 'Pending'";
                $sql_query = mysqli_query($con, $sql);

                if ($sql_query) {
                    while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                        ?>
                        <tr class="table-row  text-center">

                            <td data-label="Date / Time / Shift"><?php echo $sqlRow['dts']; ?></td>
                            <td data-label="Lot Id"><?php echo $sqlRow['lot_id']; ?></td>
                            <td data-label="Part Name"><?php echo $sqlRow['part_name']; ?></td>
                            <td data-label="Part Desc"><?php echo $sqlRow['part_desc']; ?></td>
                            <td data-label="Quantity"><?php echo $sqlRow['part_qty']; ?></td>
                            <td data-label="Machine No"><?php echo $sqlRow['machine_no']; ?></td>
                            <td data-label="Reason"><?php echo $sqlRow['with_reason']; ?></td>
                            <td data-label="Requested By"><?php echo $sqlRow['req_by']; ?></td>
                            <td data-label="Status"><?php echo $sqlRow['status']; ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

<script src="../../public/js/excel.js"></script>

<script>
    document.getElementById('export-btn').addEventListener('click', function () {
        var visibleRows = document.querySelectorAll('#data-table .table-row');
        var filteredRows = [];

        visibleRows.forEach(function (row) {
            if (row.style.display !== 'none') {
                filteredRows.push(row);
            }
        });

        var table = document.createElement('table');
        var headerRow = document.querySelector('table thead').cloneNode(true);
        table.appendChild(headerRow);

        filteredRows.forEach(function (row) {
            var newRow = row.cloneNode(true);
            table.appendChild(newRow);
        });

        var wb = XLSX.utils.table_to_book(table, { sheet: "Filtered Data" });
        XLSX.writeFile(wb, "filtered_table_data.xlsx");
    });
</script>

<script>
    $(document).ready(function () {
        $('#search-box').on('keyup', function () {
            var value = $(this).val().toLowerCase();
            $('#data-table .table-row').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>