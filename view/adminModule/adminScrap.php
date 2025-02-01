<?php
include "navBar.php";
include "../../model/dbconnection.php";

?>

<head>
    <title>Scrap Material</title>
    <link rel="stylesheet" href="../../public/css/table.css">
    <link rel="stylesheet" href="../../public/css/sweetalert.min.css">
    <script src="../../public/js/sweetalert2@11.js"></script>
    <script src="../../public/js/jquery.js"></script>
</head>
<section>
    <div class="welcomeDiv my-2">
        <h2 class="text-center" style="color: #900008; font-weight: bold;">Welcome, <?php echo $_SESSION['username'] ?>!
        </h2>
    </div>
    <div class="container">
        <table class="table table-striped w-100">
            <thead>
                <tr class="text-center" style="background-color: #900008; color: white; vertical-align: middle;">
                    <th scope="col">Date/Time of Return</th>
                    <th scope="col">Lot ID</th>
                    <th scope="col">Part Name</th>
                    <th scope="col">Qty.</th>
                    <th scope="col">Machine No.</th>
                    <th scope="col">Withdrawal Reason</th>
                    <th scope="col">Returned By</th>
                    <th scope="col">Status</th>
                    <th scope="col">Return Qty</th>
                    <th scope="col">Return Reason</th>
                </tr>
            </thead>
            <tbody id="data-table">
                <?php
                $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
                $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

                $userName = $_SESSION['username'];
                $sql = "SELECT * FROM tbl_requested WHERE status = 'returned'";

                if ($start_date && $end_date) {
                    $start_date = $start_date . ' 00:00:00';
                    $end_date = $end_date . ' 23:59:59';
                    $sql .= " AND dts_return BETWEEN '$start_date' AND '$end_date'";
                } elseif ($start_date) {
                    $start_date = $start_date . ' 00:00:00';
                    $sql .= " AND dts_return >= '$start_date'";
                } elseif ($end_date) {
                    $end_date = $end_date . ' 23:59:59';
                    $sql .= " AND dts_return <= '$end_date'";
                }

                $sql_query = mysqli_query($con, $sql);

                if ($sql_query) {
                    while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                        ?>
                        <tr class="table-row text-center">
                            <td data-label="Date / Time / Shift"><?php echo $sqlRow['dts_return']; ?></td>
                            <td data-label="Lot Id"><?php echo $sqlRow['lot_id']; ?></td>
                            <td data-label="Part Name"><?php echo $sqlRow['part_name']; ?></td>
                            <td data-label="Quantity"><?php echo $sqlRow['part_qty']; ?></td>
                            <td data-label="Machine No"><?php echo $sqlRow['machine_no']; ?></td>
                            <td data-label="Reason"><?php echo $sqlRow['with_reason']; ?></td>
                            <td data-label="Return By"><?php echo $sqlRow['req_by']; ?></td>
                            <td data-label="Status"><?php echo $sqlRow['status']; ?></td>
                            <td data-label="Return Qty"><?php echo $sqlRow['return_qty']; ?></td>
                            <td data-label="Return Reason"><?php echo $sqlRow['return_reason']; ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</section>