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

    <div class="mx-5">

        <div class="welcomeDiv my-2">
            <h2 class="text-center" style="color: #900008; font-weight: bold;">Expired Part History
            </h2>
        </div>

        <div class="d-flex flex-wrap justify-content-evenly align-items-end text-center mb-2">
            <div>
                <input type="text" id="search-box" class="form-control m-0 " style="padding: 6px 12px;"
                    placeholder="Search..." />
            </div>
            <div>
                <label for="start-date" class="me-2 fw-bold">Start Date:</label>
                <input type="date" class="form-control" id="start-date" />
            </div>
            <div>
                <label for="end-date" class="me-2 fw-bold">End Date:</label>
                <input type="date" class="form-control" id="end-date" />
            </div>
            <div>
                <button id="export-btn" class="btn btn-success">Export to Excel</button>
            </div>
        </div>

        <?php
        $userName = $_SESSION['username'];

        $limit = 100;
        $offset = isset($_GET['offset']) ? $_GET['offset'] : 0;

        $sql = "SELECT ts.*, SUM(ts.part_qty) AS total_part_qty, ti.unit FROM tbl_stock ts
        JOIN tbl_inventory ti 
        ON ts.part_name = ti.part_name
        WHERE status = 'Expired'
        GROUP BY part_name, exp_date
        ORDER BY exp_date DESC 
        LIMIT $limit OFFSET $offset";
        $sql_query = mysqli_query($con, $sql);

        $total_query = mysqli_query($con, "SELECT COUNT(*) AS total FROM tbl_stock ");
        $total_row = mysqli_fetch_assoc($total_query);
        $total_records = $total_row['total'];
        ?>
        <div class="d-flex flex-column-reverse">
            <table class="table table-striped w-100">
                <thead>
                    <tr class="text-center" style="background-color: #900008; color: white; vertical-align: middle;">
                        <th scope="col">Part Number</th>
                        <th scope="col">Item Code</th>
                        <th scope="col">Batch Number</th>
                        <th scope="col">Part Quantity</th>
                        <th scope="col">UOM</th>
                        <th scope="col">Expiration Date</th>
                        <th scope="col">Kitting ID</th>
                        <th scope="col">Added By</th>

                    </tr>
                </thead>

                <tbody id="data-table">
                    <?php
                    if (mysqli_num_rows($sql_query) > 0) {
                        while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                            ?>
                            <tr class="table-row  text-center" style="vertical-align: middle;">
                                <td data-label="Part Name"><?php echo $sqlRow['part_name']; ?></td>
                                <td data-label="Item Code"><?php echo $sqlRow['item_code']; ?></td>
                                <td data-label="Batch Number"><?php echo $sqlRow['batch_number']; ?></td>
                                <td data-label="Quantity"><?php echo $sqlRow['total_part_qty']; ?></td>
                                <td data-label="UOM"><?php echo $sqlRow['unit']; ?></td>
                                <td data-label="Expiration Date"><?php echo $sqlRow['exp_date']; ?></td>
                                <td data-label="Kitting ID"><?php echo $sqlRow['kitting_id']; ?></td>
                                <td data-label="Added By"><?php echo $sqlRow['updated_by']; ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="7" class="text-center">No expired materials found.</td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr id="no-results-row" style="display: none;">
                        <td colspan="7" class="text-center">No results found.</td>
                    </tr>
                </tbody>
            </table>

            <div id="loading-msg" class="text-center text-muted mt-3" style="display: none;">
                Loading more records...
            </div>

        </div>

    </div>

</section>

<script>
    $(document).ready(function () {

        let offset = <?php echo $offset; ?>;
        let limit = <?php echo $limit; ?>;
        let totalRecords = <?php echo $total_records; ?>;
        let isLoading = false;
        let noMoreData = false;

        $(window).scroll(function () {
            if (noMoreData || isLoading) return;

            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                if (offset + limit < totalRecords) {
                    isLoading = true;
                    $('#loading-msg').show();
                    offset += limit;

                    $.ajax({
                        url: '<?php echo $_SERVER['PHP_SELF']; ?>',
                        type: 'GET',
                        data: { offset: offset },
                        success: function (response) {
                            let newRows = $(response).find('#data-table').children();

                            if (newRows.length === 0 || newRows.text().includes('No items found')) {
                                noMoreData = true;
                            } else {
                                $('#data-table').append(newRows);
                            }

                            $('#loading-msg').hide();
                            isLoading = false;
                        }
                    });
                } else {
                    noMoreData = true;
                }
            }
        });

        // Search Input Script
        function filterTable() {
            const searchValue = $('#search-box').val().toLowerCase();
            const startDate = $('#start-date').val();
            const endDate = $('#end-date').val();

            let anyVisible = false;

            $('#data-table .table-row').each(function () {
                const row = $(this);
                const rowText = row.text().toLowerCase();
                const rowDateStr = row.find('td:eq(4)').text().trim();

                const rowDate = new Date(rowDateStr);
                let showRow = true;

                if (searchValue && !rowText.includes(searchValue)) {
                    showRow = false;
                }

                if (startDate) {
                    const start = new Date(startDate);
                    if (rowDate < start) {
                        showRow = false;
                    }
                }

                if (endDate) {
                    const end = new Date(endDate);
                    end.setHours(23, 59, 59, 999);
                    if (rowDate > end) {
                        showRow = false;
                    }
                }

                row.toggle(showRow);
                if (showRow) anyVisible = true;
            });

            $('#no-results-row').toggle(!anyVisible);
        }

        $('#search-box, #start-date, #end-date').on('input change', filterTable);

        // Export to Excel Script
        $('#export-btn').on('click', function () {
            const searchValue = $('#search-box').val();
            const startDate = $('#start-date').val();
            const endDate = $('#end-date').val();

            let url = `../../controller/export/export_expired.php?search=${encodeURIComponent(searchValue)}&start_date=${startDate}&end_date=${endDate}`;
            window.location.href = url;
        });

    });
</script>