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

    <div class="container">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">Approved</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Rejected</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                    type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Returned</button>
            </div>
        </nav>
        <div class="tab-content mt-3" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="container  ">
                    <form method="GET" action="" class="mb-4 text-center" id="date-filter-form-approve">
                        <div class="row d-flex justify-content-evenly w-100">
                            <div class="col-md-4">
                                <label for="start_dateapprove" class="form-label">Start Date</label>
                                <input type="date" id="start_dateapprove" name="start_date" class="form-control"
                                    value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="end_dateapprove" class="form-label">End Date</label>
                                <input type="date" id="end_dateapprove" name="end_date" class="form-control"
                                    value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>">
                            </div>
                        </div>
                    </form>

                    <div class="modal fade" id="returnModal" tabindex="-1" aria-labelledby="returnModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="returnModalLabel">Return Item</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="returnForm">
                                        <input type="hidden" name="lot_id" id="lot_id">
                                        <div class="mb-3">
                                            <label for="returnQty" class="form-label">Quantity</label>
                                            <input type="number" class="form-control" id="returnQty" name="return_qty">
                                        </div>
                                        <div class="mb-3" style="display: none;">
                                            <label for="reqBy" class="form-label">Quantity</label>
                                            <input type="text" class="form-control" id="reqBy" name="req_by">
                                        </div>
                                        <div class="mb-3" style="display: none;">
                                            <label for="part_namereturn" class="form-label">Quantity</label>
                                            <input type="text" class="form-control" id="part_namereturn"
                                                name="part_name">
                                        </div>
                                        <div id="quantityMessage" class="alert alert-info">
                                            Your requested quantity for this part is [X]. Please return a quantity below
                                            [X].
                                        </div>
                                        <div class="mb-3">
                                            <label for="returnReason" class="form-label">Reason for Return</label>
                                            <textarea class="form-control" id="returnReason" name="return_reason"
                                                rows="3" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit Return</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <table class="table table-striped w-100">
                        <thead>
                            <tr class="text-center"
                                style="background-color: #900008; color: white; vertical-align: middle;">
                                <th scope="col">Date / Time / Shift</th>
                                <th scope="col">Lot ID</th>
                                <th scope="col">Part Name</th>
                                <th scope="col">Item Description</th>
                                <th scope="col">Qty.</th>
                                <th scope="col">Machine No.</th>
                                <th scope="col">Withdrawal Reason</th>
                                <th scope="col">Requested By</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="data-table">
                            <?php
                            $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
                            $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

                            $userName = $_SESSION['username'];
                            $sql = "SELECT * FROM tbl_requested WHERE req_by = '$userName' AND status = 'approved'";

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
                                        <td data-label="Action">
                                            <button class="btn btn-primary return-btn" data-bs-toggle="modal"
                                                data-bs-target="#returnModal" data-lot-id="<?php echo $sqlRow['lot_id']; ?>"
                                                data-part-qty="<?php echo $sqlRow['part_qty']; ?>"
                                                data-req-by="<?php echo $sqlRow['req_by']; ?>"
                                                data-part-name="<?php echo $sqlRow['part_name']; ?>">Return</button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="container  ">
                    <form method="GET" action="" class="mb-4 text-center" id="date-filter-form-reject">
                        <div class="row d-flex justify-content-evenly w-100">
                            <div class="col-md-4">
                                <label for="start_datereject" class="form-label">Start Date</label>
                                <input type="date" id="start_datereject" name="start_date" class="form-control"
                                    value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="end_datereject" class="form-label">End Date</label>
                                <input type="date" id="end_datereject" name="end_date" class="form-control"
                                    value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>">
                            </div>
                        </div>
                    </form>

                    <table class="table table-striped w-100">
                        <thead>
                            <tr class="text-center"
                                style="background-color: #900008; color: white; vertical-align: middle;">
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
                            $sql = "SELECT * FROM tbl_requested WHERE req_by = '$userName' AND status = 'rejected'";

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
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class="container  ">
                    <form method="GET" action="" class="mb-4 text-center" id="date-filter-form-return">
                        <div class="row d-flex justify-content-evenly w-100">
                            <div class="col-md-4">
                                <label for="start_datereturn" class="form-label">Start Date</label>
                                <input type="date" id="start_datereturn" name="start_date" class="form-control"
                                    value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="end_datereturn" class="form-label">End Date</label>
                                <input type="date" id="end_datereturn" name="end_date" class="form-control"
                                    value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>">
                            </div>
                        </div>
                    </form>

                    <table class="table table-striped w-100">
                        <thead>
                            <tr class="text-center"
                                style="background-color: #900008; color: white; vertical-align: middle;">
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
                            $sql = "SELECT * FROM tbl_requested WHERE req_by = '$userName' AND status = 'returned'";

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
            </div>
        </div>
    </div>


</section>
<script src="../../public/js/jquery.js"></script>
<script>
    $(document).ready(function () {
        $('#start_dateApprove').on('change', function () {
            var startDate = $(this).val();
            if (startDate) {
                $('#end_dateApprove').attr('min', startDate);
            }
        });

        $('#start_dateApprove, #end_dateApprove').on('change', function () {
            $('#date-filter-form-approve').submit();
        });


        $('#start_datereject').on('change', function () {
            var startDate = $(this).val();
            if (startDate) {
                $('#end_datereject').attr('min', startDate);
            }
        });

        $('#start_datereject, #end_datereject').on('change', function () {
            $('#date-filter-form-reject').submit();
        });


        $('#start_datereturn').on('change', function () {
            var startDate = $(this).val();
            if (startDate) {
                $('#end_datereturn').attr('min', startDate);
            }
        });

        $('#start_datereturn, #end_datereturn').on('change', function () {
            $('#date-filter-form-return').submit();
        });
    });
</script>

<script>
    $(document).on('click', '.return-btn', function () {
        var lotId = $(this).data('lot-id');
        var partQty = $(this).data('part-qty');
        var reqBy = $(this).data('req-by');
        var partName = $(this).data('part-name');
        $('#part_namereturn').val(partName);
        $('#lot_id').val(lotId);
        $('#reqBy').val(reqBy);
        $('#returnQty').attr('max', partQty);
        $('#returnQty').val('');

        $('#quantityMessage').text('Your requested quantity for this part is ' + partQty + '. Please return a quantity below or equal to this.');
    });

    $('#returnForm').submit(function (e) {
        e.preventDefault();

        var lotId = $('#lot_id').val();
        var returnReason = $('#returnReason').val();
        var returnQty = $('#returnQty').val();
        var reqBy = $('#reqBy').val();
        var partNameReturn = $('#part_namereturn').val();

        $.ajax({
            url: '../../controller/update_status.php',
            type: 'POST',
            data: {
                lot_id: lotId,
                return_reason: returnReason,
                return_qty: returnQty,
                req_by: reqBy,
                part_name: partNameReturn

            },
            success: function (response) {
                console.log(response);
                try {
                    var data = JSON.parse(response);

                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.message,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            $('#returnModal').modal('hide');
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message,
                            confirmButtonText: 'OK'
                        });
                    }
                } catch (e) {
                    console.error("Error parsing JSON:", e);
                    Swal.fire({
                        icon: 'error',
                        title: 'Server Error',
                        text: 'There was an issue with the request. Please try again.',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX error:", status, error);
                Swal.fire({
                    icon: 'error',
                    title: 'AJAX Error',
                    text: 'There was an issue with the request. Please try again.',
                    confirmButtonText: 'OK'
                });
            }
        });

    });
</script>