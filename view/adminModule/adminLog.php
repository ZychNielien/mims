<?php

include "../../model/dbconnection.php";
include "navBar.php";

?>

<head>

    <title>Log History</title>
    <script src="../../public/js/jquery.js"></script>
    <link rel="stylesheet" href="../../public/css/table.css">

</head>

<section style="max-height: 90%;">

    <div class="welcomeDiv my-2">
        <h2 class="text-center" style="color: #900008; font-weight: bold;">Log History
        </h2>
    </div>

    <div class="mx-5">

        <div class="d-flex flex-wrap justify-content-evenly">
            <input type="text" id="search-box" placeholder="Search..." />
            <button id="export-btn" class="btn btn-success my-2">Export to Excel</button>
        </div>

        <?php
        $userName = $_SESSION['username'];

        $limit = 100;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
        $start_from = ($page - 1) * $limit;

        $sql = "SELECT * FROM tbl_log 
        WHERE dts >= NOW() - INTERVAL 60 DAY 
        ORDER BY dts DESC 
        LIMIT $start_from, $limit";
        $sql_query = mysqli_query($con, $sql);

        $total_query = mysqli_query($con, "SELECT COUNT(*) AS total FROM tbl_log WHERE dts >= NOW() - INTERVAL 60 DAY");
        $total_row = mysqli_fetch_assoc($total_query);
        $total_records = $total_row['total'];
        $total_pages = ceil($total_records / $limit);
        ?>
        <div class="d-flex flex-column-reverse">
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
                    if (mysqli_num_rows($sql_query) > 0) {
                        while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                            ?>
                            <tr class="table-row text-center" style="vertical-align: middle;">
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
                            <td colspan="5" class="text-center">No logs found</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

            <?php
            $max_visible_links = 5;
            $start_page = max(1, $page - floor($max_visible_links / 2));
            $end_page = min($total_pages, $start_page + $max_visible_links - 1);

            if ($end_page - $start_page < $max_visible_links - 1) {
                $start_page = max(1, $end_page - $max_visible_links + 1);
            }
            ?>

            <div class="text-center mt-3">
                <nav>
                    <ul class="pagination justify-content-center">

                        <?php if ($page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $page - 1; ?>">&laquo; Prev</a>
                            </li>
                        <?php endif; ?>

                        <?php if ($start_page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=1">1</a>
                            </li>
                            <?php if ($start_page > 2): ?>
                                <li class="page-item">
                                    <a class="page-link"
                                        href="?page=<?php echo $start_page - 1; ?>"><?php echo $start_page - 1; ?>...</a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                            <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($end_page < $total_pages): ?>
                            <?php if ($end_page + 1 < $total_pages): ?>
                                <li class="page-item">
                                    <a class="page-link"
                                        href="?page=<?php echo $end_page + 1; ?>">...<?php echo $end_page + 1; ?></a>
                                </li>
                            <?php endif; ?>
                            <li class="page-item">
                                <a class="page-link"
                                    href="?page=<?php echo $total_pages; ?>"><?php echo $total_pages; ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if ($page < $total_pages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next &raquo;</a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </nav>
            </div>
        </div>

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