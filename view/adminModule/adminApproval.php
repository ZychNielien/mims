<?php

include "../../model/dbconnection.php";
include "navBar.php";

?>

<head>

    <title>Material Approval</title>
    <link rel="stylesheet" href="../../public/css/table.css">
    <link rel="stylesheet" href="../../public/css/sweetalert.min.css">
    <script src="../../public/js/sweetalert2@11.js"></script>
    <script src="../../public/js/jquery.js"></script>

</head>
<section>

    <div class="welcomeDiv my-4">
        <h2 class="text-center" style="color: #900008; font-weight: bold;">Withdrawal Authorization
        </h2>
    </div>

    <div class="mx-5">

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
                    <th scope="col">Part Number</th>
                    <th scope="col">Item Description</th>
                    <th scope="col">Item Code</th>
                    <th scope="col">Qty.</th>
                    <th scope="col">Batch Number</th>
                    <th scope="col">Machine No.</th>
                    <th scope="col">Withdrawal Reason</th>
                    <th scope="col">Requested By</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $userName = $_SESSION['username'];
                $approver = $_SESSION['user'];
                $sql = "SELECT tr.*, ti.approver, ts.item_code FROM tbl_requested tr 
                            LEFT JOIN tbl_inventory ti ON tr.part_name = ti.part_name
                            LEFT JOIN tbl_stock ts ON tr.part_name = ts.part_name AND tr.exp_date = ts.exp_date AND tr.batch_number = ts.batch_number AND tr.item_code = ts.item_code
                            WHERE tr.status = 'Pending' AND ti.approver = '$approver' 
                            ORDER BY dts DESC";
                $sql_query = mysqli_query($con, $sql);

                if (mysqli_num_rows($sql_query) > 0) {
                    while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                        ?>
                        <tr class=" text-center">
                            <td data-label="Action">
                                <input type="checkbox" class="select-row"
                                    data-id="<?php echo htmlspecialchars($sqlRow['id']); ?>"
                                    data-qty="<?php echo htmlspecialchars($sqlRow['part_qty']); ?>"
                                    data-part_name="<?php echo htmlspecialchars($sqlRow['part_name']); ?>"
                                    data-req_by="<?php echo htmlspecialchars($sqlRow['req_by']); ?>"
                                    data-exp_date="<?php echo htmlspecialchars($sqlRow['exp_date']); ?>"
                                    data-batch_number="<?php echo htmlspecialchars($sqlRow['batch_number']); ?>"
                                    data-item_code="<?php echo htmlspecialchars($sqlRow['item_code']); ?>">

                            </td>
                            <td data-label="Date / Time / Shift"><?php echo $sqlRow['dts']; ?></td>
                            <td data-label="Lot Id"><?php echo $sqlRow['lot_id']; ?></td>
                            <td data-label="Part Name"><?php echo $sqlRow['part_name']; ?></td>
                            <td data-label="Part Desc"><?php echo $sqlRow['part_desc']; ?></td>
                            <td data-label="Part Desc"><?php echo $sqlRow['item_code']; ?></td>
                            <td data-label="Quantity"><?php echo $sqlRow['part_qty']; ?></td>
                            <td data-label="Quantity"><?php echo $sqlRow['batch_number']; ?></td>
                            <td data-label="Machine No"><?php echo $sqlRow['machine_no']; ?></td>
                            <td data-label="Reason"><?php echo $sqlRow['with_reason']; ?></td>
                            <td data-label="Requested By"><?php echo $sqlRow['req_by']; ?></td>
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

    <!-- Approval Modal -->
    <div class="modal fade" id="approvalModal" tabindex="-1" aria-labelledby="approvalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approvalModalLabel">Approve Selected Requests</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="approvalForm">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="text-center text-white" style="background-color: #900008;">
                                    <tr style="vertical-align: middle;">
                                        <th>Requested By</th>
                                        <th>Part Number</th>
                                        <th>Item Code</th>
                                        <th>Approved Quantity</th>
                                        <th>Batch Number</th>
                                        <th>Actual Batch Number</th>
                                        <th>Reason</th>
                                    </tr>
                                </thead>
                                <tbody id="modalItemList">
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success" name="approve_submit">Approve</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Rejection Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">Reject Selected Requests</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="rejectForm">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="text-center text-white" style="background-color: #900008;">
                                    <tr>
                                        <th>Requested By</th>
                                        <th>Part Number</th>
                                        <th>Item Code</th>
                                        <th>Batch Number</th>
                                        <th>Requested Quantity</th>
                                        <th>Rejection Reason</th>
                                    </tr>
                                </thead>
                                <tbody id="modalRejectItemList">
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger" name="reject_submit">Reject</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</section>

<script>

    $(document).ready(function () {

        // Select All Approval Request 
        $('#select-all').on('change', function () {
            $('.select-row').prop('checked', $(this).prop('checked'));
        });

        // Approve Request Button
        $("#approve-btn").click(function () {
            $("#modalItemList").empty();

            let selectedItems = $(".select-row:checked");

            if (selectedItems.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No items selected',
                    text: 'Please select at least one request to approve.',
                    confirmButtonText: 'Ok'
                });
                return;
            }

            selectedItems.each(function () {
                let id = $(this).data("id");
                let reqBy = $(this).data("req_by");
                let partName = $(this).data("part_name");
                let qty = $(this).data("qty");
                let batch_number = $(this).data("batch_number");
                let item_code = $(this).data("item_code");

                let row = `
                    <tr class=" text-center" style="vertical-align: middle;">
                        <td>${reqBy}</td>
                        <td>${partName} <input type="hidden" name="ids[]" value="${id}"></td>
                        <td style="display:none;"> 
                        <input type="hidden" name="part_names[]" value="${partName}">
                        <input type="hidden" name="request_bys[]" value="${reqBy}">
                        <input type="hidden" name="item_codes[]" value="${item_code}">
                        </td>
                        <td>${item_code}</td>
                        <td><input type="number" name="quantities[]" value="${qty}" max="${qty}" class="form-control" min="1" step="1" required></td>
                        <td>${batch_number}</td>
                        <td>
                            <input type="text" name="batch_numbers[]" class="form-control" placeholder="Actual Batch Number" autocomplete="off">
                        </td>
                        <td>
                        <input type="text" name="reasons[]" class="form-control" placeholder="Reason (Optional)" autocomplete="off">

                        </td>
                    </tr>
                `;
                $("#modalItemList").append(row);
            });

            $("#approvalModal").modal("show");
        });

        // Approve Request Submit
        $("#approvalForm").submit(function (e) {
            e.preventDefault();

            let formData = $(this).serialize();
            formData += "&approve_submit=1";

            $.ajax({
                url: '../../controller/update_status.php',
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (response) {

                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Requests approved successfully!',
                            confirmButtonText: 'Ok'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.error || 'An unexpected error occurred.',
                            confirmButtonText: 'Ok'
                        });
                    }
                },
                error: function (xhr, status, error) {

                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to process approval',
                        text: 'See console for details.',
                        confirmButtonText: 'Ok'
                    });
                }
            });
        });

        // Reject Request Button
        $("#reject-btn").click(function () {
            $("#modalRejectItemList").empty();

            let selectedItems = $(".select-row:checked");

            if (selectedItems.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No items selected',
                    text: 'Please select at least one request to reject.',
                    confirmButtonText: 'Ok'
                });
                return;
            }

            selectedItems.each(function () {
                let id = $(this).data("id");
                let reqBy = $(this).data("req_by");
                let partName = $(this).data("part_name");
                let qty = $(this).data("qty");
                let exp_date = $(this).data("exp_date");
                let batch_number = $(this).data("batch_number");
                let item_code = $(this).data("item_code");

                let row = `
                    <tr class=" text-center" style="vertical-align: middle;">
                        <td>${reqBy}</td>
                        <td>${partName} <input type="hidden" name="ids[]" value="${id}"></td>
                        <td>${item_code}</td>
                        <td>${batch_number}</td>
                        <td>${qty}</td>
                        <td style="display:none;"> 
                            <input type="hidden" name="part_names[]" value="${partName}">
                            <input type="hidden" name="request_bys[]" value="${reqBy}">
                            <input type="hidden" name="quantities[]" value="${qty}">
                            <input type="hidden" name="exp_dates[]" value="${exp_date}">
                            <input type="hidden" name="item_codes[]" value="${item_code}">
                            <input type="hidden" name="batch_numbers[]" value="${batch_number}">
                        </td>
                        <td>
                            <input type="text" name="reasons[]" class="form-control" placeholder="Reason for rejection">
                        </td>
                    </tr>
                `;
                $("#modalRejectItemList").append(row);
            });

            $("#rejectModal").modal("show");
        });

        // Reject Request Submit
        $("#rejectForm").submit(function (e) {
            e.preventDefault();

            let formData = $(this).serialize();
            formData += "&reject_submit=1";

            $.ajax({
                url: '../../controller/update_status.php',
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Rejected!',
                            text: 'Requests have been rejected successfully.',
                            confirmButtonText: 'Ok'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.error || 'An unexpected error occurred.',
                            confirmButtonText: 'Ok'
                        });
                    }
                },
            });
        });

    });
</script>