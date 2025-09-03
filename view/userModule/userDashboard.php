<?php

include "../../model/dbconnection.php";
include "navBar.php";

$sql_withreason = "SELECT reason FROM tbl_withdrawal_reason";
$sql_withreason_query = mysqli_query($con, $sql_withreason);
$withdraw_option = "";

if ($sql_withreason_query) {
    while ($withreasonRow = mysqli_fetch_assoc($sql_withreason_query)) {
        $withdraw_option .= '<option value="' . $withreasonRow['reason'] . '">' . $withreasonRow['reason'] . '</option>';
    }
}

$sql_machine = "SELECT machine_number FROM tbl_machine";
$sql_machine_query = mysqli_query($con, $sql_machine);
$machine_option = "";

if ($sql_machine_query) {
    while ($machineRow = mysqli_fetch_assoc($sql_machine_query)) {
        $machine_option .= '<option value="' . $machineRow['machine_number'] . '">' . $machineRow['machine_number'] . '</option>';
    }
}

?>

<head>

    <title>Material Withdrawal</title>
    <link rel="stylesheet" href="../../public/css/responsiveWithdrawal.css">
    <script src="../../public/js/jquery.js"></script>
    <script src="../../public/js/jquery-3.6.js"></script>
    <link rel="stylesheet" href="../../public/css/jquery-ui.css">
    <script src="../../public/js/jquery-ui.min.js"></script>

</head>

<section>

    <div class="welcomeDiv my-2">
        <h2 class="text-center">Welcome, <?php echo $_SESSION['employee_name'] ?>!</h2>
    </div>

    <div class="px-5 hatian d-flex justify-between align-center">

        <div class="divWithdrawal px-3 w-25">

            <div class="containerTitle">
                <h4>Material Withdrawal</h4>
            </div>

            <form method="POST" action="../../controller/withdrawal.php">
                <?php
                $selected_username = $_SESSION['username'];
                $select_user = "SELECT * FROM tbl_users WHERE username = '$selected_username'";
                $select_user_query = mysqli_query($con, $select_user);
                $select_user_row = mysqli_fetch_assoc($select_user_query);


                $query = "SELECT 
                                    ti.id,
                                    ti.part_name,
                                    ts.item_code,
                                    SUM(ts.part_qty) AS total_qty
                                FROM 
                                    tbl_inventory ti
                                LEFT JOIN 
                                    tbl_stock ts ON ti.part_name = ts.part_name
                                WHERE 
                                    ts.status = 'Active'
                                GROUP BY 
                                    ti.part_name
                                HAVING 
                                    total_qty > 0
                                ORDER BY 
                                    REGEXP_REPLACE(ti.part_name, '[0-9]+$', ''), 
                                    CAST(REGEXP_SUBSTR(ti.part_name, '[0-9]+$') AS UNSIGNED)
                                ";

                $result = mysqli_query($con, $query);
                ?>
                <input type="hidden" value="<?php echo $select_user_row['cost_center'] ?>" name="cost_center">

                <div class="mb-1">
                    <label for="partSelect" class="form-label">Part Number</label>
                    <select class="form-select" id="partSelect">
                        <option value="">Select a Part Number</option>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['id'] . '" data-part_name="' . htmlspecialchars($row['part_name']) . '">' . htmlspecialchars($row['part_name']) . '</option>';
                            }
                        } else {
                            echo '<option value="">No parts available</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-1">
                    <label for="part_desc_input" class="form-label">Part Description</label>
                    <input type="text" class="form-control" id="part_desc_input" placeholder="Type item description">
                </div>

                <div id="itemDetails" style="display: none;">
                    <input type="hidden" id="part_name" name="part_name" />
                    <div class="mb-1" style="display: none;">
                        <label for="part_desc" class="form-label">Item Description</label>
                        <textarea class="form-control" id="part_desc" rows="2" name="part_desc" readonly></textarea>
                    </div>
                    <div class="">
                        <label for="part_item_code" class="form-label">Item Code</label>
                        <select class="form-select" id="part_item_code" name="part_item_code" required>
                        </select>
                    </div>
                    <div class="">
                        <label for="part_batch_number" class="form-label">Batch Number</label>
                        <input type="text" class="form-control" id="part_batch_number"
                            placeholder="Auto-filled after selecting item code" readonly>
                    </div>

                    <div>
                        <label for="part_option" class="form-label">Material Type</label>
                        <input type="text" class="form-control" id="part_option" name="part_option" readonly>
                    </div>

                    <div>
                        <label for="part_unit" class="form-label">Unit of Measure</label>
                        <input type="text" class="form-control text-uppercase" id="part_unit" readonly>
                    </div>
                    <div>
                        <label for="part_qty" class="form-label">Item Quantity</label>
                        <input type="number" class="form-control" id="part_qty" name="part_qty"
                            placeholder="Enter Item Quantity" required>
                    </div>
                    <div>
                        <label for="station_code" class="form-label">Station Code</label>
                        <select class="form-select" id="station_code" name="station_code" required>
                            <option value="">Select Station Code</option>
                            <?php
                            $sql_station = "SELECT station_code FROM tbl_station_code";
                            $sql_station_query = mysqli_query($con, $sql_station);
                            if ($sql_station_query) {
                                while ($statiobRow = mysqli_fetch_assoc($sql_station_query)) {
                                    ?>

                                    <option value="<?php echo $statiobRow['station_code'] ?>">
                                        <?php echo $statiobRow['station_code'] ?>
                                    </option>

                                    <?php
                                }
                            }
                            ?>
                        </select>

                    </div>
                    <div style="display: none;">
                        <label for="req_by" class="form-label">Req By</label>
                        <input type="text" class="form-control" id="req_by" value="<?php echo $_SESSION['username'] ?>"
                            name="req_by">
                    </div>

                    <div>
                        <label for="machine_no" class="form-label">Machine Number</label>
                        <select class="form-select" id="machine_no" name="machine_no" required>
                            <option value="">Select Machine Number</option>
                            <?php
                            $sql_machine = "SELECT machine_number FROM tbl_machine";
                            $sql_machine_query = mysqli_query($con, $sql_machine);
                            if ($sql_machine_query) {
                                while ($machineRow = mysqli_fetch_assoc($sql_machine_query)) {
                                    ?>

                                    <option value="<?php echo $machineRow['machine_number'] ?>">
                                        <?php echo $machineRow['machine_number'] ?>
                                    </option>

                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="lot_id" class="form-label">Lot ID</label>
                        <input type="text" class="form-control" id="lot_id" name="lot_id" placeholder="Enter Lot ID"
                            required autocomplete="off">
                    </div>
                    <div class="mb-1">
                        <label for="with_reason" class="form-label">Withdrawal Reason</label>
                        <select class="form-select" id="with_reason" name="with_reason" required>
                            <option value="">Select Withdrawal Reason</option>
                            <?php
                            $sql_withreason = "SELECT reason FROM tbl_withdrawal_reason";
                            $sql_withreason_query = mysqli_query($con, $sql_withreason);
                            if ($sql_withreason_query) {
                                while ($withreasonRow = mysqli_fetch_assoc($sql_withreason_query)) {
                                    ?>

                                    <option value="<?php echo $withreasonRow['reason'] ?>">
                                        <?php echo $withreasonRow['reason'] ?>
                                    </option>

                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success" name="mat_req_part">Submit</button>
                </div>


            </form>

        </div>

        <div class="divReq p-3 w-75" style="max-height: 750px; overflow: auto;">

            <div class="containerTitle">
                <h4 class="text-center">Requested Parts</h4>
            </div>

            <div class="d-flex justify-content-start gap-3 w-100 mb-3">
                <div>
                    <button class="btn btn-primary" id="update-btn">Edit Request</button>
                </div>
                <div>
                    <button class="btn btn-danger" id="delete-btn">Delete Request</button>
                </div>
            </div>

            <table class="table table-striped">

                <thead>
                    <tr class="text-center" style="background-color: #900008; color: white; vertical-align: middle;">
                        <th scope="col"><input type="checkbox" id="select-all"></th>
                        <th scope="col">Date / Time / Shift</th>
                        <th scope="col">Lot ID</th>
                        <th scope="col">Part Number</th>
                        <th scope="col">Item Description</th>
                        <th scope="col">Item Code</th>
                        <th scope="col">Batch Number</th>
                        <th scope="col">Qty.</th>
                        <th scope="col">UOM</th>
                        <th scope="col">Machine No.</th>
                        <th scope="col">Cost Center</th>
                        <th scope="col">Withdrawal Reason</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $userName = $_SESSION['username'];
                    $sql = "SELECT tr.*, ts.item_code, ts.part_qty AS total_qty , ti.unit 
                            FROM tbl_requested tr 
                            JOIN tbl_stock ts 
                            ON tr.part_name = ts.part_name AND tr.exp_date = ts.exp_date AND tr.batch_number = ts.batch_number AND tr.item_code = ts.item_code
                            JOIN tbl_inventory ti
                            ON tr.part_name = ti.part_name
                            WHERE tr.req_by = '$userName' AND tr.status = 'Pending'  
                            ORDER BY tr.dts DESC";
                    $sql_query = mysqli_query($con, $sql);

                    if (mysqli_num_rows($sql_query) > 0) {
                        while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                            ?>
                            <tr class="text-center" style="vertical-align: middle;">
                                <td>
                                    <input type="checkbox" class="select-row" data-id="<?php echo $sqlRow['id']; ?>"
                                        data-qty="<?php echo $sqlRow['part_qty']; ?>" data-dts="<?php echo $sqlRow['dts']; ?>"
                                        data-part_name="<?php echo $sqlRow['part_name']; ?>"
                                        data-exp_date="<?php echo $sqlRow['exp_date']; ?>"
                                        data-lot_id="<?php echo $sqlRow['lot_id']; ?>"
                                        data-machine="<?php echo $sqlRow['machine_no']; ?>"
                                        data-withdrawal="<?php echo $sqlRow['with_reason']; ?>"
                                        data-total_qty="<?php echo $sqlRow['total_qty']; ?>"
                                        data-item_code="<?php echo $sqlRow['item_code']; ?>"
                                        data-batch_number="<?php echo $sqlRow['batch_number']; ?>"
                                        data-item_unit="<?php echo $sqlRow['unit']; ?>">
                                </td>
                                <td data-label="Date / Time / Shift"><?php echo $sqlRow['dts'] ?></td>
                                <td data-label="Lot Id"><?php echo $sqlRow['lot_id'] ?></td>
                                <td data-label="Part Name"><?php echo $sqlRow['part_name'] ?></td>
                                <td data-label="Part Desc"><?php echo $sqlRow['part_desc'] ?></td>
                                <td data-label="Item Code"><?php echo $sqlRow['item_code'] ?></td>
                                <td data-label="Batch Number"><?php echo $sqlRow['batch_number'] ?></td>
                                <td data-label="Quantity"><?php echo $sqlRow['part_qty'] ?></td>
                                <td data-label="UOM"><?php echo $sqlRow['unit'] ?></td>
                                <td data-label="Machine No"><?php echo $sqlRow['machine_no'] ?></td>
                                <td data-label="Cost Center"><?php echo $sqlRow['cost_center'] ?></td>
                                <td data-label="Reason"><?php echo $sqlRow['with_reason'] ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="11" class="text-center">No withdrawal request found</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>

            </table>

        </div>

    </div>

</section>

<!-- Modification of Withdrawal Request Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Selected Requests</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateForm">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="text-center text-white"
                                style="background-color: #900008; vertical-align: middle;">
                                <tr>
                                    <th>Date / Time / Shift</th>
                                    <th>Lot ID</th>
                                    <th>Part Number</th>
                                    <th>Item Code</th>
                                    <th>Batch Number</th>
                                    <th>Part Quantity</th>
                                    <th>UOM</th>
                                    <th>Machine Number</th>
                                    <th>Withdrawal Reason</th>
                                </tr>
                            </thead>
                            <tbody id="modalItemList">

                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="update_submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Deletion of Withdrawal Request Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Deletion of Selected Requests</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="deleteForm">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="text-center text-white"
                                style="background-color: #900008; vertical-align: middle;">
                                <tr>
                                    <th>Date / Time / Shift</th>
                                    <th>Lot ID</th>
                                    <th>Part Number</th>
                                    <th>Part Quantity</th>
                                    <th>UOM</th>
                                    <th>Machine Number</th>
                                    <th>Withdrawal Reason</th>
                                </tr>
                            </thead>
                            <tbody id="modalDeleteItemList">
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger" name="delete_submit">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {

        // Select Part Number shows Part Description
        $('#partSelect').on('change', function () {
            var partId = $(this).val();


            if (partId) {
                var partName = $(this).find('option:selected').data('part_name');
                $('#part_name').val(partName);

                $('#part_item_code').empty().append('<option value="">Select Item Code</option>');
                $('#part_batch_number').val('');
                $('#part_qty').val('').removeAttr('max').attr('placeholder', 'Enter Item Quantity');

                $.ajax({
                    url: '../../controller/fetch_part_desc.php',
                    type: 'GET',
                    data: { part_id: partId },
                    dataType: 'json',
                    success: function (data) {
                        $('#itemDetails').show();

                        if (data.part_desc) {
                            $('#part_desc').val(data.part_desc);
                            $('#part_desc_input').val(data.part_desc);
                        } else {
                            $('#part_desc').val('No description available');
                            $('#part_desc_input').val('');
                        }

                        if (data.unit) {
                            $('#part_unit').val(data.unit);
                        } else {
                            $('#part_unit').val('No unit available');
                        }

                        if (data.part_option) {
                            $('#part_option').val(data.part_option);
                        } else {
                            $('#part_option').val('No option available');
                        }

                        if (data.item_codes && data.item_codes.length > 0) {
                            $('#part_item_code').empty().append('<option value="">Select Item Code</option>');
                            data.item_codes.forEach(function (item) {
                                $('#part_item_code').append(
                                    '<option value="' + item.code + '" data-max="' + item.qty + '" data-batch="' + item.batch + '">' + item.code + ' (' + item.batch + ')' + '</option>'
                                );
                            });

                        } else {
                            $('#part_item_code').empty().append('<option value="">No item codes available</option>');
                        }

                        $('#part_item_code').on('change', function () {
                            var selected = $(this).find('option:selected');
                            var maxQty = selected.data('max');
                            var batchNumber = selected.data('batch');

                            if (maxQty !== undefined) {
                                $('#part_qty').attr('max', maxQty);
                                $('#part_qty').attr('placeholder', 'Enter quantity (maximum allowed: ' + maxQty + ')');
                            } else {
                                $('#part_qty').removeAttr('max').attr('placeholder', 'Enter Item Quantity');
                            }

                            if (batchNumber !== undefined) {
                                $('#part_batch_number').val(batchNumber);
                            } else {
                                $('#part_batch_number').val('');
                            }
                        });



                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX error: ' + error);
                    }
                });
            } else {
                $('#itemDetails').hide();
                $('#part_desc').val('');
                $('#part_desc_input').val('');
                $('#part_option').val('');
                $('#part_name').val('');
                $('#part_item_code').empty().append('<option value="">Select Item Code</option>');
            }
        });

        $("#part_desc_input").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "../../controller/part_desc.php",
                    type: "GET",
                    dataType: "json",
                    data: { term: request.term },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            select: function (event, ui) {
                $("#part_desc_input").val(ui.item.label);

                $("#partSelect").val(ui.item.id).trigger("change");

                return false;
            }
        });

        // Select All for Request Deletion
        $('#select-all').on('change', function () {
            $('.select-row').prop('checked', $(this).prop('checked'));
        });

        // Update Withdrawal Request Button
        $("#update-btn").click(function () {
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
                let partName = $(this).data("part_name");
                let qty = $(this).data("qty");
                let exp_date = $(this).data("exp_date");
                let lot_id = $(this).data("lot_id");
                let machine = $(this).data("machine");
                let withdrawal = $(this).data("withdrawal");
                let dts = $(this).data("dts");
                let total_qty = $(this).data("total_qty");
                let withdraw_options = '<?php echo $withdraw_option; ?>';
                let machine_options = '<?php echo $machine_option; ?>';
                let batch_number = $(this).data("batch_number");
                let item_code = $(this).data("item_code");
                let item_unit = $(this).data("item_unit");



                let row = `
                            <tr class="text-center" style="vertical-align: middle;">
                                <td>${dts}</td>
                                <td>${lot_id}</td>
                                <td>${partName}</td>
                                <td>${item_code}</td>
                                <td>${batch_number}</td>
                                <td><input type="number" name="quantities[]" value="${qty}" class="form-control" min="1" max="${total_qty + qty}" step="1" required></td>
                                <td>${item_unit}</td>
                                <td>                    
                                    <select class="form-select" name="machines[]" required>
                                        <option value="">Select Machine</option>
                                        <?php
                                        $sql_machine = "SELECT machine_number FROM tbl_machine";
                                        $sql_machine_query = mysqli_query($con, $sql_machine);
                                        $machine_option = "";
                                        if ($sql_machine_query) {
                                            while ($machineRow = mysqli_fetch_assoc($sql_machine_query)) {
                                                $machine_option .= '<option value="' . $machineRow['machine_number'] . '">' . $machineRow['machine_number'] . '</option>';
                                            }
                                        }
                                        echo $machine_option;
                                        ?>
                                    </select>
                                </td>
                                <td> 
                                    <select class="form-select" name="with_reasons[]" required>
                                        <option value="">Select Withdrawal Reason</option>
                                        <?php
                                        $sql_withreason = "SELECT reason FROM tbl_withdrawal_reason";
                                        $sql_withreason_query = mysqli_query($con, $sql_withreason);
                                        $withdraw_option = "";

                                        if ($sql_withreason_query) {
                                            while ($withreasonRow = mysqli_fetch_assoc($sql_withreason_query)) {
                                                $withdraw_option .= '<option value="' . $withreasonRow['reason'] . '">' . $withreasonRow['reason'] . '</option>';
                                            }
                                        }
                                        echo $withdraw_option;
                                        ?>
                                    </select>
                                </td>
                                <td style="display:none;"> 
                                    <input type="hidden" name="batch_numbers[]" value="${batch_number}">
                                    <input type="hidden" name="item_codes[]" value="${item_code}">
                                    <input type="hidden" name="ids[]" value="${id}">
                                    <input type="hidden" name="part_names[]" value="${partName}">
                                    <input type="hidden" name="exp_dates[]" value="${exp_date}">
                                </td>
                            </tr>

                        `;
                $("#modalItemList").append(row);
                let lastRow = $("#modalItemList tr:last-child");
                lastRow.find('select[name="machines[]"]').val(machine);
                lastRow.find('select[name="with_reasons[]"]').val(withdrawal);
            });
            $("#updateModal").modal("show");
        });

        // Delete Withdrawal Request Button
        $("#delete-btn").click(function () {
            $("#modalDeleteItemList").empty();

            let selectedItems = $(".select-row:checked");

            if (selectedItems.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No items selected',
                    text: 'Please select at least one request to delete.',
                    confirmButtonText: 'Ok'
                });
                return;
            }

            selectedItems.each(function () {
                let id = $(this).data("id");
                let partName = $(this).data("part_name");
                let qty = $(this).data("qty");
                let exp_date = $(this).data("exp_date");
                let lot_id = $(this).data("lot_id");
                let machine = $(this).data("machine");
                let withdrawal = $(this).data("withdrawal");
                let dts = $(this).data("dts");
                let batch_number = $(this).data("batch_number");
                let item_code = $(this).data("item_code");
                let item_unit = $(this).data("item_unit");

                let row = `
                    <tr class=" text-center" style="vertical-align: middle;">
                        <td data-label="Date / Time / Shift">${dts}</td>
                        <td data-label="Lot ID">${lot_id}</td>
                        <td data-label="Part Number">${partName} <input type="hidden" name="ids[]" value="${id}"></td>
                        <td data-label="Part Quantity">${qty}</td>
                        <td>${item_unit}</td>
                        <td data-label="Machine Number">${machine}</td>
                        <td data-label="Withdrawal Reason">${withdrawal}</td>

                        <td style="display:none;"> 
                            <input type="hidden" name="batch_numbers[]" value="${batch_number}">
                            <input type="hidden" name="item_codes[]" value="${item_code}">
                            <input type="hidden" name="part_names[]" value="${partName}">
                            <input type="hidden" name="quantities[]" value="${qty}">
                            <input type="hidden" name="exp_dates[]" value="${exp_date}">
                        </td>
                    </tr>
                `;
                $("#modalDeleteItemList").append(row);
            });

            $("#deleteModal").modal("show");
        });

        // Handle Form Submission Function
        function handleFormSubmission(formSelector, actionType, successMessage, redirectUrl, errorMessage) {
            $(formSelector).submit(function (e) {
                e.preventDefault();

                let formData = $(this).serialize();
                formData += `&${actionType}=1`;

                $.ajax({
                    url: '../../controller/user_query.php',
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: successMessage,
                                confirmButtonText: 'Ok'
                            }).then(() => {
                                window.location.href = redirectUrl;
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.error || errorMessage,
                                confirmButtonText: 'Ok'
                            });
                        }
                    }
                });
            });
        }

        // Handle Form Submission Function for Update Request
        handleFormSubmission("#updateForm", "update_submit", "Requests have been updated successfully.", "userDashboard.php", "An unexpected error occurred while updating.");

        // Handle Form Submission Function for Delete Request
        handleFormSubmission("#deleteForm", "delete_submit", "Requests have been deleted successfully.", "userDashboard.php", "An unexpected error occurred while deleting.");

    });


</script>