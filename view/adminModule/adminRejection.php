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

    <div class="welcomeDiv my-2">
        <h2 class="text-center" style="color: #900008; font-weight: bold;">Rejection History
        </h2>
    </div>

    <div class="mx-5">

        <?php
        $userName = $_SESSION['username'];

        $limit = 100;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
        $start_from = ($page - 1) * $limit;

        $sql = "SELECT * FROM tbl_requested 
        WHERE  status = 'rejected' AND dts_rejected >= NOW() - INTERVAL 60 DAY
        ORDER BY dts_rejected DESC 
        LIMIT $start_from, $limit";
        $sql_query = mysqli_query($con, $sql);

        $total_query = mysqli_query($con, "SELECT COUNT(*) AS total FROM tbl_requested WHERE dts_rejected >= NOW() - INTERVAL 60 DAY");
        $total_row = mysqli_fetch_assoc($total_query);
        $total_records = $total_row['total'];
        $total_pages = ceil($total_records / $limit);
        ?>
        <div class="d-flex flex-column-reverse">
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
                    if (mysqli_num_rows($sql_query) > 0) {
                        while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                            ?>
                            <tr class="table-row  text-center" style="vertical-align: middle;">
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
                            <td colspan="10" class="text-center">No items found</td>
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