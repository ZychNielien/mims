<?php
include "../../model/dbconnection.php";
include "navBar.php";
?>

<head>
    <title>Receiving History</title>
    <script src="../../public/js/jquery.js"></script>
    <link rel="stylesheet" href="../../public/css/table.css">
</head>

<section style="max-height: 90%;">
    <div class="welcomeDiv my-2">
        <h2 class="text-center" style="color: #900008; font-weight: bold;">Receiving History</h2>
    </div>

    <div class="mx-5">
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
        $limit = 100;
        $offset = isset($_GET['offset']) ? (int) $_GET['offset'] : 0;

        $sql = "SELECT * FROM tbl_history 
                WHERE status = 'Received' AND dts >= CURDATE() - INTERVAL 60 DAY
                ORDER BY dts DESC 
                LIMIT $limit OFFSET $offset";
        $sql_query = mysqli_query($con, $sql);

        $total_query = mysqli_query($con, "SELECT COUNT(*) AS total FROM tbl_history WHERE status = 'Received' AND dts >= NOW() - INTERVAL 60 DAY");
        $total_row = mysqli_fetch_assoc($total_query);
        $total_records = $total_row['total'];
        ?>

        <div class="d-flex flex-column-reverse">
            <table class="table table-striped w-100">
                <thead>
                    <tr class="text-center" style="background-color: #900008; color: white; vertical-align: middle;">
                        <th>Date / Time / Shift</th>
                        <th>Part Name</th>
                        <th>Part Desc</th>
                        <th>Item Code</th>
                        <th>Batch Number</th>
                        <th>Quantity</th>
                        <th>Expiration Date</th>
                        <th>Kitting ID</th>
                        <th>Received By</th>
                    </tr>
                </thead>
                <tbody id="data-table">
                    <?php
                    if (mysqli_num_rows($sql_query) > 0) {
                        while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                            ?>
                            <tr class="table-row text-center" style="vertical-align: middle;">
                                <td data-label="Date / Time / Shift"><?php echo $sqlRow['dts']; ?></td>
                                <td data-label="Part Name"><?php echo $sqlRow['part_name']; ?></td>
                                <td data-label="Part Desc"><?php echo $sqlRow['part_desc']; ?></td>
                                <td data-label="Item Code"><?php echo $sqlRow['item_code']; ?></td>
                                <td data-label="Batch Number"><?php echo $sqlRow['batch_number']; ?></td>
                                <td data-label="Quantity"><?php echo $sqlRow['part_qty']; ?></td>
                                <td data-label="Expiration Date"><?php echo $sqlRow['exp_date']; ?></td>
                                <td data-label="Kitting ID"><?php echo $sqlRow['kitting_id']; ?></td>
                                <td data-label="Received By"><?php echo $sqlRow['updated_by']; ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="9" class="text-center">No items found</td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr id="no-results-row" style="display: none;">
                        <td colspan="9" class="text-center">No results found.</td>
                    </tr>
                </tbody>
            </table>

            <div id="loading-msg" class="text-center text-muted mt-3" style="display: none;">
                Loading more records...
            </div>
        </div>
    </div>
</section>

<!-- Excel Script -->
<script src="../../public/js/excel.js"></script>

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

        // Search filter
        function filterTable() {
            const searchValue = $('#search-box').val().toLowerCase();
            const startDate = $('#start-date').val();
            const endDate = $('#end-date').val();

            let anyVisible = false;

            $('#data-table .table-row').each(function () {
                const row = $(this);
                const rowText = row.text().toLowerCase();
                const rowDateStr = row.find('td:first').text().trim();

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

        // Export to Excel
        $('#export-btn').on('click', function () {
            let btn = $(this);
            btn.prop('disabled', true).text('Exporting...');

            let visibleRows = $('#data-table .table-row:visible');
            let table = $('<table></table>');
            let headerRow = $('table thead').clone(true);
            table.append(headerRow);

            visibleRows.each(function () {
                let newRow = $(this).clone(true);
                table.append(newRow);
            });

            let wb = XLSX.utils.table_to_book(table[0], { sheet: "Filtered Data" });
            XLSX.writeFile(wb, "ReceivingHistory.xlsx");

            btn.prop('disabled', false).text('Export to Excel');
        });
    });
</script>