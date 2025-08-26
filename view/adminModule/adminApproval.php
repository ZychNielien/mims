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

        <?php
        $userName = $_SESSION['username'];
        $approver = $_SESSION['designation'];
        $limit = 100;
        $offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
        $sql = "SELECT tr.*, ti.approver, ts.item_code, ti.unit 
                FROM tbl_requested tr 
                LEFT JOIN tbl_inventory ti ON tr.part_name = ti.part_name
                LEFT JOIN tbl_stock ts ON tr.part_name = ts.part_name AND tr.exp_date = ts.exp_date AND tr.batch_number = ts.batch_number AND tr.item_code = ts.item_code
                WHERE tr.status = 'Pending' AND ti.approver = '$approver' 
                ORDER BY dts DESC 
                LIMIT $limit OFFSET $offset";
        $sql_query = mysqli_query($con, $sql);

        $total_query = mysqli_query($con, "SELECT COUNT(*) AS total, tr.*, ti.approver, ts.item_code FROM tbl_requested tr 
                            LEFT JOIN tbl_inventory ti ON tr.part_name = ti.part_name
                            LEFT JOIN tbl_stock ts ON tr.part_name = ts.part_name AND tr.exp_date = ts.exp_date AND tr.batch_number = ts.batch_number AND tr.item_code = ts.item_code
                            WHERE tr.status = 'Pending' AND ti.approver = '$approver' ");
        $total_row = mysqli_fetch_assoc($total_query);
        $total_records = $total_row['total'];
        ?>

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
                    <th scope="col">UOM</th>
                    <th scope="col">Batch Number</th>
                    <th scope="col">Machine No.</th>
                    <th scope="col">Cost Center</th>
                    <th scope="col">Withdrawal Reason</th>
                    <th scope="col">Requested By</th>
                </tr>
            </thead>

            <tbody id="data-table-approval">
                <?php
                if (mysqli_num_rows($sql_query) > 0) {
                    while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                        $stock_part_name = $sqlRow['part_name'];
                        $stock_exp_date = $sqlRow['exp_date'];
                        $stock_batch_number = $sqlRow['batch_number'];
                        $stock_item_code = $sqlRow['item_code'];

                        $select_stock = "SELECT SUM(part_qty) AS total_qty 
                 FROM tbl_stock 
                 WHERE part_name = '$stock_part_name' 
                   AND exp_date = '$stock_exp_date' 
                   AND batch_number = '$stock_batch_number' 
                   AND item_code = '$stock_item_code'";

                        $select_stock_query = mysqli_query($con, $select_stock);
                        $selected_stock = mysqli_fetch_assoc($select_stock_query);
                        $stocks = $selected_stock['total_qty'];


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
                                    data-item_code="<?php echo htmlspecialchars($sqlRow['item_code']); ?>"
                                    data-total="<?php echo htmlspecialchars($stocks); ?>">

                            </td>
                            <td data-label="Date / Time / Shift"><?php echo $sqlRow['dts']; ?></td>
                            <td data-label="Lot Id"><?php echo $sqlRow['lot_id']; ?></td>
                            <td data-label="Part Name"><?php echo $sqlRow['part_name']; ?></td>
                            <td data-label="Part Desc"><?php echo $sqlRow['part_desc']; ?></td>
                            <td data-label="Part Desc"><?php echo $sqlRow['item_code']; ?></td>
                            <td data-label="Quantity"><?php echo $sqlRow['part_qty']; ?></td>
                            <td data-label="UOM"><?php echo $sqlRow['unit']; ?></td>
                            <td data-label="Batch Number"><?php echo $sqlRow['batch_number']; ?></td>
                            <td data-label="Machine No"><?php echo $sqlRow['machine_no']; ?></td>
                            <td data-label="Cost Center"><?php echo $sqlRow['cost_center']; ?></td>
                            <td data-label="Withdrawal Reason"><?php echo $sqlRow['with_reason']; ?></td>
                            <td data-label="Requested By"><?php echo $sqlRow['req_by']; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="13" class="text-center">No approval found</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>

        </table>

        <div id="loading-msg" class="text-center text-muted mt-3" style="display: none;">
            Loading more records...
        </div>

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
                            let newRows = $(response).find('#data-table-approval').children();

                            if (newRows.length === 0 || newRows.text().includes('No items found')) {
                                noMoreData = true;
                            } else {
                                $('#data-table-approval').append(newRows);
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

        // Approval Function
        function handleItemSelection(buttonType) {
            let selectedItems = $(".select-row:checked");
            let modalListSelector = buttonType === "approve" ? "#modalItemList" : "#modalRejectItemList";
            let modalSelector = buttonType === "approve" ? "#approvalModal" : "#rejectModal";

            $(modalListSelector).empty();

            if (selectedItems.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No items selected',
                    text: `Please select at least one request to ${buttonType}.`,
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
                let exp_date = $(this).data("exp_date");
                let total = $(this).data("total");

                let row;

                if (buttonType === "approve") {
                    row = `
            <tr class="text-center" style="vertical-align: middle;">
                <td>${reqBy}</td>
                <td>${partName} <input type="hidden" name="ids[]" value="${id}"></td>
                <td style="display:none;"> 
                    <input type="hidden" name="part_names[]" value="${partName}">
                    <input type="hidden" name="request_bys[]" value="${reqBy}">
                    <input type="hidden" name="item_codes[]" value="${item_code}">
                </td>
                <td>${item_code}</td>
                <td><input type="number" name="quantities[]" value="${qty}" max="${total}" class="form-control" min="1" step="1" required></td>
                <td>${batch_number}</td>
                <td><input type="text" name="batch_numbers[]" class="form-control" placeholder="Actual Batch Number" autocomplete="off"></td>
                <td><input type="text" name="reasons[]" class="form-control" placeholder="Reason (Optional)" autocomplete="off"></td>
            </tr>
        `;
                } else {
                    row = `
            <tr class="text-center" style="vertical-align: middle;">
                <td>${reqBy}</td>
                <td>${partName} <input type="hidden" name="ids[]" value="${id}"></td>
                <td>${item_code}</td>
                <td>${batch_number}</td>
                <td>${qty}</td>
                <td style="display:none;"> 
                    <input type="hidden" name="part_names[]" value="${partName}">
                    <input type="hidden" name="request_bys[]" value="${reqBy}">
                    <input type="hidden" name="quantities[]" value="${qty}">
                    <input type="hidden" name="exp_dates[]" value="${exp_date || ''}">
                    <input type="hidden" name="item_codes[]" value="${item_code}">
                    <input type="hidden" name="batch_numbers[]" value="${batch_number}">
                </td>
                <td><input type="text" name="reasons[]" class="form-control" placeholder="Reason for rejection"></td>
            </tr>
        `;
                }

                $(modalListSelector).append(row);
            });

            $(modalSelector).modal("show");

            let itemAllocations = {};

            $(`${modalListSelector} input[name='item_codes[]']`).each(function () {
                let itemCode = $(this).val();
                let $row = $(this).closest("tr");
                let $qtyInput = $row.find("input[name='quantities[]']");
                let max = parseInt($qtyInput.attr("max")) || 0;

                if (!itemAllocations[itemCode]) {
                    itemAllocations[itemCode] = {
                        maxQty: max,
                        inputs: []
                    };
                }

                itemAllocations[itemCode].inputs.push($qtyInput);
            });

            function updateMaxForItemCode(itemCode) {
                let group = itemAllocations[itemCode];
                let totalQty = group.maxQty;

                let totalAllocated = group.inputs.reduce((sum, $input) => {
                    return sum + (parseInt($input.val()) || 0);
                }, 0);

                group.inputs.forEach(($input) => {
                    let currentVal = parseInt($input.val()) || 0;
                    let remaining = totalQty - (totalAllocated - currentVal);
                    $input.attr("max", remaining);
                });
            }

            Object.keys(itemAllocations).forEach(itemCode => {
                itemAllocations[itemCode].inputs.forEach($input => {
                    $input.on("input", () => {
                        updateMaxForItemCode(itemCode);
                    });
                });

                updateMaxForItemCode(itemCode);
            });
        }


        // Approval Function for Approve
        $("#approve-btn").click(function () {
            handleItemSelection("approve");
        });

        // Approval Function for Reject
        $("#reject-btn").click(function () {
            handleItemSelection("reject");
        });


        // Form Submission Function
        function handleFormSubmit(formSelector, actionFlag, successMsg, errorMsg) {
            $(formSelector).submit(function (e) {
                e.preventDefault();

                let formData = $(this).serialize();
                formData += `&${actionFlag}=1`;

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
                                text: successMsg,
                                confirmButtonText: 'Ok'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.error || errorMsg,
                                confirmButtonText: 'Ok'
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Request Failed',
                            text: 'Failed to communicate with server. Please check the console.',
                            confirmButtonText: 'Ok'
                        });
                    }
                });
            });
        }

        // Form Submission Function for Approval
        handleFormSubmit("#approvalForm", "approve_submit", "Requests approved successfully!", "Failed to approve requests.");

        // Form Submission Function for Rejection
        handleFormSubmit("#rejectForm", "reject_submit", "Requests have been rejected successfully.", "Failed to reject requests.");

    });
</script>