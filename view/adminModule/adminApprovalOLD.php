<?php

// Database Connection
include "../../model/dbconnection.php";

// Navigation Bar
include "navBar.php";

?>

<head>

    <!-- Title -->
    <title>Material Approval</title>

    <!-- Table Style -->
    <link rel="stylesheet" href="../../public/css/table.css">

    <!-- Sweetalert Style -->
    <link rel="stylesheet" href="../../public/css/sweetalert.min.css">

    <!-- Sweetalert Script -->
    <script src="../../public/js/sweetalert2@11.js"></script>

    <!-- Jquery Script -->
    <script src="../../public/js/jquery.js"></script>

</head>
<section>

    <!-- Title Div -->
    <div class="welcomeDiv my-4">
        <h2 class="text-center" style="color: #900008; font-weight: bold;">Withdrawal Authorization
        </h2>
    </div>

    <!-- Main Container -->
    <div class="container">

        <!-- Approval Buttons -->
        <div class="d-flex justify-content-start gap-3 w-100">
            <div>
                <button class="btn btn-success" id="approve-btn">Approve</button>
            </div>
            <div>
                <button class="btn btn-danger" id="reject-btn">Reject</button>
            </div>
        </div>

        <!-- Approval Request Table -->
        <table class="table table-striped my-2">

            <thead>
                <tr class="text-center" style="background-color: #900008; color: white; vertical-align: middle;">
                    <th scope="col">
                        <input type="checkbox" id="select-all">
                    </th>
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

            <tbody>
                <?php
                $userName = $_SESSION['username'];
                $sql = "SELECT * FROM tbl_requested WHERE status = 'Pending' ORDER BY dts DESC";
                $sql_query = mysqli_query($con, $sql);

                if (mysqli_num_rows($sql_query) > 0) {
                    while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                        ?>
                        <tr class=" text-center">
                            <td data-label="Action">
                                <input type="checkbox" class="select-row" data-id="<?php echo $sqlRow['id']; ?>"
                                    data-qty="<?php echo $sqlRow['part_qty']; ?>"
                                    data-part_name="<?php echo $sqlRow['part_name']; ?>"
                                    data-req_by="<?php echo $sqlRow['req_by']; ?>"
                                    data-exp_date="<?php echo $sqlRow['exp_date']; ?>">
                            </td>
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
                } else {
                    ?>
                    <tr>
                        <td colspan="11" class="text-center">No approval found</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>

        </table>

    </div>

</section>

<script>

    $(document).ready(function () {

        // Select All Approval Request SCript
        $('#select-all').on('change', function () {
            $('.select-row').prop('checked', $(this).prop('checked'));
        });

        // Approve Button Script
        $('#approve-btn').on('click', function () {
            var selectedIds = [];
            var selectedQty = [];
            var selectedReq = [];
            var selectedPartNames = [];
            $('.select-row:checked').each(function () {
                selectedIds.push($(this).data('id'));
                selectedQty.push($(this).data('qty'));
                selectedReq.push($(this).data('req_by'));
                selectedPartNames.push($(this).data('part_name'));
            });

            if (selectedIds.length > 0) {
                $.ajax({
                    url: '../../controller/update_status.php',
                    type: 'POST',
                    data: {
                        action: 'approve',
                        ids: selectedIds,
                        qty: selectedQty,
                        req_by: selectedReq,
                        part_name: selectedPartNames
                    },
                    success: function (response) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Selected items have been approved.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while approving the selected items.',
                            icon: 'error',
                            confirmButtonText: 'Try Again'
                        });
                    }
                });
            } else {
                Swal.fire({
                    title: 'Warning!',
                    text: 'Please select at least one item to approve.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
            }
        });

        // Reject Button Script
        $('#reject-btn').on('click', function () {
            var selectedIds = [];
            var selectedQty = [];
            var selectedReq = [];
            var selectedPartNames = [];
            var selectedExpDates = [];

            $('.select-row:checked').each(function () {
                selectedIds.push($(this).data('id'));
                selectedQty.push($(this).data('qty'));
                selectedReq.push($(this).data('req_by'));
                selectedPartNames.push($(this).data('part_name'));
                selectedExpDates.push($(this).data('exp_date'));
            });

            if (selectedIds.length > 0) {
                $.ajax({
                    url: '../../controller/update_status.php',
                    type: 'POST',
                    data: {
                        action: 'reject',
                        ids: selectedIds,
                        qty: selectedQty,
                        req_by: selectedReq,
                        part_name: selectedPartNames,
                        exp_date: selectedExpDates
                    },
                    success: function (response) {
                        Swal.fire({
                            title: 'Rejected!',
                            text: 'Selected items have been rejected.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while rejecting the selected items.',
                            icon: 'error',
                            confirmButtonText: 'Try Again'
                        });
                    }
                });
            } else {
                Swal.fire({
                    title: 'Warning!',
                    text: 'Please select at least one item to reject.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
            }
        });

    });
</script>