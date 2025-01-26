<?php
date_default_timezone_set('Asia/Manila');

include "../../model/dbconnection.php";
include "navBar.php";
?>

<head>
    <title>Withdrawal History</title>

    <link rel="stylesheet" href="../../public/css/table.css">
</head>
<section>
    <div class="welcomeDiv my-2">
        <h2 class="text-center">Welcome, <?php echo $_SESSION['username'] ?>!</h2>
    </div>

    <div class="container  ">
        <form method="GET" action="" class="mb-4 text-center" id="date-filter-form">
            <div class="row d-flex justify-content-evenly w-100">
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" id="start_date" name="start_date" class="form-control"
                        value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>">
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" id="end_date" name="end_date" class="form-control"
                        value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>">
                </div>
            </div>
        </form>

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
                $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
                $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

                $userName = $_SESSION['username'];
                $sql = "SELECT * FROM tbl_requested WHERE req_by = '$userName' AND NOT status = 'Pending'  ORDER BY dts DESC";

                if ($start_date && $end_date) {
                    $start_date = $start_date . ' 00:00:00';
                    $end_date = $end_date . ' 23:59:59';
                    $sql .= " AND dts BETWEEN '$start_date' AND '$end_date'";
                } elseif ($start_date) {
                    $start_date = $start_date . ' 00:00:00';
                    $sql .= " AND dts >= '$start_date'";
                } elseif ($end_date) {
                    $end_date = $end_date . ' 23:59:59';
                    $sql .= " AND dts <= '$end_date'";
                }

                $sql_query = mysqli_query($con, $sql);

                if ($sql_query) {
                    while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                        ?>
                        <tr class="table-row text-center">
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
<script src="../../public/js/jquery.js"></script>
<script>
    $(document).ready(function () {
        $('#start_date').on('change', function () {
            var startDate = $(this).val();
            if (startDate) {
                $('#end_date').attr('min', startDate);
            }
        });

        $('#start_date, #end_date').on('change', function () {
            $('#date-filter-form').submit();
        });
    });
</script>