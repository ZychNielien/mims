<?php

include "../../model/dbconnection.php";
include "navBar.php";

?>

<head>

    <title>Scrap Material</title>
    <link rel="stylesheet" href="../../public/css/table.css">
    <link rel="stylesheet" href="../../public/css/sweetalert.min.css">
    <script src="../../public/js/sweetalert2@11.js"></script>
    <script src="../../public/js/jquery.js"></script>
    <script src="../../public/js/excel.js"></script>

</head>

<section>

    <div class="welcomeDiv my-4">
        <h2 class="text-center" style="color: #900008; font-weight: bold;">Return Materials
        </h2>
    </div>

    <div class="mx-5">

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">Items Awaiting
                    Receipt</button>
                <button class="nav-link" id="nav-returned-tab" data-bs-toggle="tab" data-bs-target="#nav-returned"
                    type="button" role="tab" aria-controls="nav-returned" aria-selected="false">Processed Returned
                    Materials</button>
                <button class="nav-link" id="nav-scrap-tab" data-bs-toggle="tab" data-bs-target="#nav-scrap"
                    type="button" role="tab" aria-controls="nav-scrap" aria-selected="false">Processed Scrap
                    Materials</button>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">

            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                <div class="mx-3 my-4">
                    <div class="mb-2">
                        <button class="btn btn-success" id="receive-btn">Receive Request</button>
                    </div>

                    <table class="table table-striped w-100">

                        <thead>
                            <tr class="text-center"
                                style="background-color: #900008; color: white; vertical-align: middle;">
                                <th scope="col"><input type="checkbox" id="select-all-receive"></th>
                                <th scope="col">Date/Time of Return</th>
                                <th scope="col">Lot ID</th>
                                <th scope="col">Part Number</th>
                                <th scope="col">Approved Qty.</th>
                                <th scope="col">UOM</th>
                                <th scope="col">Batch Number</th>
                                <th scope="col">Machine No.</th>
                                <th scope="col">Withdrawal Reason</th>
                                <th scope="col">Returned By</th>
                                <th scope="col">Return Qty</th>
                                <th scope="col">UOM</th>
                                <th scope="col">Return Type</th>
                                <th scope="col">Return Reason</th>
                            </tr>
                        </thead>

                        <tbody id="data-table">
                            <?php
                            $userType = $_SESSION['user'];
                            $designationType = $_SESSION['designation'];
                            $userName = $_SESSION['username'];
                            $sql = "SELECT tr.*, ti.approver, ti.unit FROM tbl_requested tr JOIN tbl_inventory ti ON tr.part_name = ti.part_name WHERE tr.status = 'returning' AND ti.approver ='$designationType' ORDER BY tr.dts_return DESC";


                            $sql_query = mysqli_query($con, $sql);

                            if (mysqli_num_rows($sql_query)) {
                                while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                                    ?>
                                    <tr class="table-row text-center" style="vertical-align: middle;">
                                        <td>
                                            <input type="checkbox" class="select-receive" data-id="<?php echo $sqlRow['id']; ?>"
                                                data-return_qty="<?php echo $sqlRow['return_qty']; ?>"
                                                data-req_by="<?php echo $sqlRow['req_by']; ?>"
                                                data-part_name="<?php echo $sqlRow['part_name']; ?>"
                                                data-batch_number="<?php echo $sqlRow['batch_number']; ?>"
                                                data-exp_date="<?php echo $sqlRow['exp_date']; ?>"
                                                data-return_reason="<?php echo $sqlRow['return_reason']; ?>"
                                                data-return_purpose="<?php echo $sqlRow['return_purpose']; ?>"
                                                data-item_code="<?php echo $sqlRow['item_code']; ?>"
                                                data-item_unit="<?php echo $sqlRow['unit']; ?>" />
                                        </td>
                                        <td data-label="Date / Time / Shift"><?php echo $sqlRow['dts_return']; ?></td>
                                        <td data-label="Lot Id"><?php echo $sqlRow['lot_id']; ?></td>
                                        <td data-label="Part Name"><?php echo $sqlRow['part_name']; ?></td>
                                        <td data-label="Quantity"><?php echo $sqlRow['approved_qty']; ?></td>
                                        <td data-label="Unit of Measure"><?php echo $sqlRow['unit']; ?></td>
                                        <td data-label="Batch Number"><?php echo $sqlRow['batch_number']; ?></td>
                                        <td data-label="Machine No"><?php echo $sqlRow['machine_no']; ?></td>
                                        <td data-label="Reason"><?php echo $sqlRow['with_reason']; ?></td>
                                        <td data-label="Return By"><?php echo $sqlRow['req_by']; ?></td>
                                        <td data-label="Return Qty"><?php echo $sqlRow['return_qty']; ?></td>
                                        <td data-label="Unit of Measure"><?php echo $sqlRow['unit']; ?></td>
                                        <td data-label="Return Type"><?php echo $sqlRow['return_purpose']; ?></td>
                                        <td data-label="Return Reason"><?php echo $sqlRow['return_reason']; ?></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="14" class="text-center">No items found</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>

                    </table>

                </div>

            </div>

            <!-- Returned Materials -->
            <div class="tab-pane fade" id="nav-returned" role="tabpanel" aria-labelledby="nav-returned-tab">

                <div class="mx-3 my-4">
                    <div class="d-flex flex-wrap justify-content-evenly align-items-end text-center mb-2">
                        <div>
                            <label for="start-date" class="me-2 fw-bold">Start Date:</label>
                            <input type="date" class="form-control" id="start-date" />
                        </div>
                        <div>
                            <label for="end-date" class="me-2 fw-bold">End Date:</label>
                            <input type="date" class="form-control" id="end-date" />
                        </div>
                        <div>
                            <button id="export-btn-return" class="btn btn-success">Export to Excel</button>

                        </div>
                    </div>

                    <table class="table table-striped w-100" id="data-table-return">

                        <thead>
                            <tr class="text-center"
                                style="background-color: #900008; color: white; vertical-align: middle;">
                                <th scope="col">Date/Time of Received</th>
                                <th scope="col">Part Number</th>
                                <th scope="col">Batch Number</th>
                                <th scope="col">Lot ID</th>
                                <th scope="col">Item Code</th>
                                <th scope="col">Machine No.</th>
                                <th scope="col">Withdrawal Reason</th>
                                <th scope="col">Approved Qty.</th>
                                <th scope="col">UOM</th>
                                <th scope="col">Expiration</th>
                                <th scope="col">Return Qty</th>
                                <th scope="col">UOM</th>
                                <th scope="col">Return Reason</th>
                                <th scope="col">Returned By</th>
                                <th scope="col">Received By</th>
                            </tr>
                        </thead>

                        <tbody id="data-table-return">
                            <?php
                            $userType = $_SESSION['user'];
                            $userApprover = $_SESSION['designation'];
                            $userName = $_SESSION['username'];
                            $sql = "SELECT tr.*, ti.approver, ti.unit FROM tbl_requested tr JOIN tbl_inventory ti ON tr.part_name = ti.part_name WHERE tr.status = 'returned' AND ti.approver = '$userApprover' AND tr.return_purpose = 'Partial' ORDER BY dts_receive DESC";


                            $sql_query = mysqli_query($con, $sql);

                            if (mysqli_num_rows($sql_query)) {
                                while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                                    ?>
                                    <tr class="table-row table-row-return text-center" style="vertical-align: middle;">
                                        <td data-label="Date / Time / Shift"><?php echo $sqlRow['dts_receive']; ?></td>
                                        <td data-label="Part Name"><?php echo $sqlRow['part_name']; ?></td>
                                        <td data-label="Batch Number"><?php echo $sqlRow['batch_number']; ?></td>
                                        <td data-label="Lot Id"><?php echo $sqlRow['lot_id']; ?></td>
                                        <td data-label="Lot Id"><?php echo $sqlRow['lot_id']; ?></td>
                                        <td data-label="Machine No"><?php echo $sqlRow['machine_no']; ?></td>
                                        <td data-label="Reason"><?php echo $sqlRow['with_reason']; ?></td>
                                        <td data-label="Quantity"><?php echo $sqlRow['approved_qty']; ?></td>
                                        <td data-label="Unit of Measure"><?php echo $sqlRow['unit']; ?></td>
                                        <td data-label="Reason"><?php echo $sqlRow['exp_date']; ?></td>
                                        <td data-label="Return Qty"><?php echo $sqlRow['return_qty']; ?></td>
                                        <td data-label="Unit of Measure"><?php echo $sqlRow['unit']; ?></td>
                                        <td data-label="Return Reason"><?php echo $sqlRow['return_reason']; ?></td>
                                        <td data-label="Return By"><?php echo $sqlRow['req_by']; ?></td>
                                        <td data-label="Received By"><?php echo $sqlRow['received_by']; ?></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="15" class="text-center">No items found</td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr class="no-results text-center" style="display: none;">
                                <td colspan="15">No results founds</td>
                            </tr>
                        </tbody>

                    </table>

                </div>

            </div>

            <!-- Scrap Materials -->
            <div class="tab-pane fade" id="nav-scrap" role="tabpanel" aria-labelledby="nav-scrap-tab">

                <div class="mx-3 my-4">

                    <div class="d-flex flex-wrap justify-content-evenly align-items-end text-center mb-2">
                        <div>
                            <label for="start-date-scrap" class="me-2 fw-bold">Start Date:</label>
                            <input type="date" class="form-control" id="start-date-scrap" />
                        </div>
                        <div>
                            <label for="end-date-scrap" class="me-2 fw-bold">End Date:</label>
                            <input type="date" class="form-control" id="end-date-scrap" />
                        </div>
                        <div>
                            <button id="export-btn-scrap" class="btn btn-success">Export to Excel</button>
                        </div>
                    </div>


                    <table class="table table-striped w-100" id="data-table-scrap">

                        <thead>
                            <tr class="text-center"
                                style="background-color: #900008; color: white; vertical-align: middle;">
                                <th scope="col">Date/Time of Received</th>
                                <th scope="col">Part Number</th>
                                <th scope="col">Batch Number</th>
                                <th scope="col">Lot ID</th>
                                <th scope="col">Item Code</th>
                                <th scope="col">Machine No.</th>
                                <th scope="col">Withdrawal Reason</th>
                                <th scope="col">Approved Qty.</th>
                                <th scope="col">UOM</th>
                                <th scope="col">Expiration</th>
                                <th scope="col">Return Qty</th>
                                <th scope="col">UOM</th>
                                <th scope="col">Return Reason</th>
                                <th scope="col">Returned By</th>
                                <th scope="col">Received By</th>
                            </tr>
                        </thead>

                        <tbody id="data-table-scrap">
                            <?php
                            $userType = $_SESSION['user'];
                            $userApprover = $_SESSION['designation'];
                            $userName = $_SESSION['username'];
                            $sql = "SELECT tr.*, ti.approver, ti.unit FROM tbl_requested tr JOIN tbl_inventory ti ON tr.part_name = ti.part_name WHERE tr.status = 'returned' AND ti.approver = '$userApprover' AND tr.return_purpose = 'Scrap' ORDER BY dts_receive DESC";


                            $sql_query = mysqli_query($con, $sql);

                            if (mysqli_num_rows($sql_query)) {
                                while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                                    ?>
                                    <tr class="table-row table-row-scrap text-center" style="vertical-align: middle;">
                                        <td data-label="Date / Time / Shift"><?php echo $sqlRow['dts_receive']; ?></td>
                                        <td data-label="Part Name"><?php echo $sqlRow['part_name']; ?></td>
                                        <td data-label="Batch Number"><?php echo $sqlRow['batch_number']; ?></td>
                                        <td data-label="Lot Id"><?php echo $sqlRow['lot_id']; ?></td>
                                        <td data-label="Lot Id"><?php echo $sqlRow['lot_id']; ?></td>
                                        <td data-label="Machine No"><?php echo $sqlRow['machine_no']; ?></td>
                                        <td data-label="Reason"><?php echo $sqlRow['with_reason']; ?></td>
                                        <td data-label="Quantity"><?php echo $sqlRow['approved_qty']; ?></td>
                                        <td data-label="Unit of Measure"><?php echo $sqlRow['unit']; ?></td>
                                        <td data-label="Reason"><?php echo $sqlRow['exp_date']; ?></td>
                                        <td data-label="Return Qty"><?php echo $sqlRow['return_qty']; ?></td>
                                        <td data-label="Unit of Measure"><?php echo $sqlRow['unit']; ?></td>
                                        <td data-label="Return Reason"><?php echo $sqlRow['return_reason']; ?></td>
                                        <td data-label="Return By"><?php echo $sqlRow['req_by']; ?></td>
                                        <td data-label="Received By"><?php echo $sqlRow['received_by']; ?></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="15" class="text-center">No items found</td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr class="no-results text-center" style="display: none;">
                                <td colspan="15">No results founds</td>
                            </tr>
                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- Withdrawal Receive Modal -->
<div class="modal fade" id="receiveModal" tabindex="-1" aria-labelledby="receiveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="receiveModalLabel">Receiving of Selected Requests</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="receiveForm">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="text-center text-white"
                                style="background-color: #900008; vertical-align: middle">
                                <tr>
                                    <th>Returning By</th>
                                    <th>Part Number</th>
                                    <th>Item Code</th>
                                    <th>Batch Number</th>
                                    <th>Returning Reason</th>
                                    <th>Receiving Quantity</th>
                                    <th>UOM</th>
                                    <th>Actual Batch Number</th>
                                    <th>Return Purpose</th>
                                </tr>
                            </thead>
                            <tbody id="modalReceiveList">
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success" name="receive_submit">Receive</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        // Select Receive
        $('#select-all-receive').on('change', function () {
            $('.select-receive').prop('checked', $(this).prop('checked'));
        });

        // Receive Withdrawal Request Button
        $("#receive-btn").click(function () {
            $("#modalReceiveList").empty();

            let selectedItems = $(".select-receive:checked");

            if (selectedItems.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No items selected',
                    text: 'Please select at least one request to receive.',
                    confirmButtonText: 'Ok'
                });
                return;
            }

            selectedItems.each(function () {
                let id = $(this).data("id");
                let partName = $(this).data("part_name");
                let approved_qty = $(this).data("approved_qty");
                let req_by = $(this).data("req_by");
                let batch_number = $(this).data("batch_number");
                let exp_date = $(this).data("exp_date");
                let return_qty = $(this).data("return_qty");
                let return_reason = $(this).data("return_reason");
                let return_purpose = $(this).data("return_purpose");
                let item_code = $(this).data("item_code");
                let item_unit = $(this).data("item_unit");

                let row = `
                    <tr class="text-center" style="vertical-align: middle;">
                        <td>${req_by}</td>
                        <td>${partName}</td>
                        <td>${item_code}</td>
                        <td>${batch_number}</td>
                        <td>${return_reason}</td>
                        <td><input type="number" name="quantities[]" value="${return_qty}" class="form-control" min="1" max="${return_qty}" required></td>
                        <td>${item_unit}</td>
                        <td><input type="text" name="batchnumbers[]" class="form-control" placeholder="Actual Batch Number" autocomplete="off" required></td>
                        <td>
                            <select class="form-select" name="return_purposes[]">
                                <option value="" ${!return_purpose ? 'selected' : ''}>Return Purpose</option>
                                <option value="Partial" ${return_purpose === 'Partial' ? 'selected' : ''}>Partial</option>
                                <option value="Scrap" ${return_purpose === 'Scrap' ? 'selected' : ''}>Scrap</option>
                            </select>
                        </td>
                        <td style="display:none;"> 
                            <input type="hidden" name="actualBNs[]" value="${batch_number}">
                            <input type="hidden" name="item_codes[]" value="${item_code}">
                            <input type="hidden" name="ids[]" value="${id}">
                            <input type="hidden" name="part_names[]" value="${partName}">
                            <input type="hidden" name="req_bys[]" value="${req_by}">
                            <input type="hidden" name="exp_dates[]" value="${exp_date}">
                        </td>
                    </tr>

                `;
                $("#modalReceiveList").append(row);
            });
            $("#receiveModal").modal("show");
        });

        // Receive Withdrawal Request Submit
        $("#receiveForm").submit(function (e) {
            e.preventDefault();

            let formData = $(this).serialize();
            formData += "&receive_submit=1";

            $.ajax({
                url: '../../controller/update_status.php',
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Received!',
                            confirmButtonText: 'Ok'
                        }).then(() => {
                            window.location.href = 'adminScrap.php';
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

        // Return Materials Export to Excel Script
        $('#export-btn-return').on('click', function () {
            var visibleRows = $('#data-table-return .table-row-return:visible');
            var table = $('<table></table>');
            var headerRow = $('#data-table-return thead').clone(true);
            table.append(headerRow);

            visibleRows.each(function () {
                var newRow = $(this).clone(true);
                table.append(newRow);
            });

            var wb = XLSX.utils.table_to_book(table[0], { sheet: "Return Data" });
            XLSX.writeFile(wb, "return_materials.xlsx");
        });

        // Scrap Materials Export to Excel Script
        $('#export-btn-scrap').on('click', function () {
            var visibleRows = $('#data-table-scrap .table-row-scrap:visible');
            var table = $('<table></table>');
            var headerRow = $('#data-table-scrap thead').clone(true);
            table.append(headerRow);

            visibleRows.each(function () {
                var newRow = $(this).clone(true);
                table.append(newRow);
            });

            var wb = XLSX.utils.table_to_book(table[0], { sheet: "Scrap Data" });
            XLSX.writeFile(wb, "scrap_materials.xlsx");
        });

        function filterRows(tableSelector, startDateSelector, endDateSelector) {
            var startDate = $(startDateSelector).val();
            var endDate = $(endDateSelector).val();
            var hasVisible = false;

            $(tableSelector + ' tbody tr').not('.no-results').each(function () {
                var rowDateText = $(this).find('td').eq(0).text().trim();
                var rowDate = rowDateText.split(' ')[0];

                var showRow = true;
                if (startDate && rowDate < startDate) showRow = false;
                if (endDate && rowDate > endDate) showRow = false;

                $(this).toggle(showRow);
                if (showRow) hasVisible = true;
            });

            if (!hasVisible) {
                $(tableSelector + ' tbody .no-results').show();
            } else {
                $(tableSelector + ' tbody .no-results').hide();
            }
        }

        $('#start-date, #end-date').on('input', function () {
            filterRows('#data-table-return', '#start-date', '#end-date');
        });

        $('#start-date-scrap, #end-date-scrap').on('input', function () {
            filterRows('#data-table-scrap', '#start-date-scrap', '#end-date-scrap');
        });

    });


</script>