<?php

include "../../model/dbconnection.php";
include "navBar.php";

?>

<head>

    <title>Material Withdrawal</title>
    <link rel="stylesheet" href="../../public/css/responsiveWithdrawal.css">
    <script src="../../public/js/jquery-3.6.js"></script>
    <link rel="stylesheet" href="../../public/css/jquery-ui.css">
    <script src="../../public/js/jquery-ui.min.js"></script>

</head>

<section>

    <nav class="m-3">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="withdraw-tab" data-bs-toggle="tab" data-bs-target="#withdraw-tab-pane"
                type="button" role="tab" aria-controls="withdraw-tab-pane" aria-selected="true">Material
                Withdrawal</button>
            <button class="nav-link" id="approved-tab" data-bs-toggle="tab" data-bs-target="#approved-tab-pane"
                type="button" role="tab" aria-controls="approved-tab-pane" aria-selected="false">Approved
                Request</button>
            <button class="nav-link" id="rejected-tab" data-bs-toggle="tab" data-bs-target="#rejected-tab-pane"
                type="button" role="tab" aria-controls="rejected-tab-pane" aria-selected="false">Rejected
                Request</button>
            <button class="nav-link" id="returned-tab" data-bs-toggle="tab" data-bs-target="#returned-tab-pane"
                type="button" role="tab" aria-controls="returned-tab-pane" aria-selected="false">Returned
                Request</button>
        </div>
    </nav>

    <div class="tab-content mt-3" id="nav-tabContent">

        <!-- Material Withdrawal Tab -->
        <div class="tab-pane fade show active" id="withdraw-tab-pane" role="tabpanel" aria-labelledby="withdraw-tab">
            <div class="px-3 hatian d-flex justify-between align-center w-100 my-3">
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

                        <div class="mb-3">
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
                        <div class="mb-3">
                            <label for="part_desc_input" class="form-label">Part Description</label>
                            <input type="text" class="form-control" id="part_desc_input"
                                placeholder="Type item description">
                        </div>

                        <div id="itemDetails" style="display: none;">
                            <input type="hidden" id="part_name" name="part_name" />
                            <div class="mb-1" style="display: none;">
                                <label for="part_desc" class="form-label">Item Description</label>
                                <textarea class="form-control" id="part_desc" rows="2" name="part_desc"
                                    readonly></textarea>
                            </div>
                            <div class="mb-1">
                                <label for="part_option" class="form-label">Material Type</label>
                                <input type="text" class="form-control" id="part_option" name="part_option" readonly>
                            </div>
                            <div class="mb-1">
                                <label for="part_item_code" class="form-label">Item Code</label>
                                <select class="form-select" id="part_item_code" name="part_item_code" required>
                                </select>
                            </div>
                            <div class="mb-1">
                                <label for="part_qty" class="form-label">Item Quantity</label>
                                <input type="number" class="form-control" id="part_qty" name="part_qty"
                                    placeholder="Enter Item Quantity" required>
                            </div>
                            <div class="mb-1">
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
                            <div class="mb-1" style="display: none;">
                                <label for="req_by" class="form-label">Req By</label>
                                <input type="text" class="form-control" id="req_by"
                                    value="<?php echo $_SESSION['username'] ?>" name="req_by">
                            </div>

                            <div class="mb-1">
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
                            <div class="mb-1">
                                <label for="lot_id" class="form-label">Lot ID</label>
                                <input type="text" class="form-control" id="lot_id" name="lot_id"
                                    placeholder="Enter Lot ID" required autocomplete="off">
                            </div>
                            <div class="mb-3">
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
                            <tr class="text-center"
                                style="background-color: #900008; color: white; vertical-align: middle;">
                                <th scope="col"><input type="checkbox" id="select-all"></th>
                                <th scope="col">Date / Time / Shift</th>
                                <th scope="col">Lot ID</th>
                                <th scope="col">Part Number</th>
                                <th scope="col">Item Description</th>
                                <th scope="col">Item Code</th>
                                <th scope="col">Batch Number</th>
                                <th scope="col">Qty.</th>
                                <th scope="col">Batch Number</th>
                                <th scope="col">Machine No.</th>
                                <th scope="col">Cost Center</th>
                                <th scope="col">Withdrawal Reason</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            $userName = $_SESSION['username'];
                            $sql = "SELECT 
                                        tr.*, 
                                        ts.part_qty AS total_qty, 
                                        ts.item_code 
                                    FROM tbl_requested tr 
                                    JOIN tbl_stock ts 
                                    ON tr.part_name = ts.part_name 
                                        AND tr.exp_date = ts.exp_date 
                                        AND tr.batch_number = ts.batch_number 
                                        AND tr.item_code = ts.item_code
                                    WHERE tr.req_by = '$userName' 
                                        AND tr.status = 'Pending'  
                                    ORDER BY tr.dts DESC";
                            $sql_query = mysqli_query($con, $sql);

                            if (mysqli_num_rows($sql_query) > 0) {
                                while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                                    ?>
                                    <tr class="text-center">
                                        <td>
                                            <input type="checkbox" class="select-row" data-id="<?php echo $sqlRow['id']; ?>"
                                                data-qty="<?php echo $sqlRow['part_qty']; ?>"
                                                data-dts="<?php echo $sqlRow['dts']; ?>"
                                                data-part_name="<?php echo $sqlRow['part_name']; ?>"
                                                data-exp_date="<?php echo $sqlRow['exp_date']; ?>"
                                                data-lot_id="<?php echo $sqlRow['lot_id']; ?>"
                                                data-machine="<?php echo $sqlRow['machine_no']; ?>"
                                                data-withdrawal="<?php echo $sqlRow['with_reason']; ?>"
                                                data-total_qty="<?php echo $sqlRow['total_qty']; ?>"
                                                data-item_code="<?php echo $sqlRow['item_code']; ?>"
                                                data-batch_number="<?php echo $sqlRow['batch_number']; ?>" />
                                        </td>
                                        <td data-label="Date / Time / Shift"><?php echo $sqlRow['dts'] ?></td>
                                        <td data-label="Lot Id"><?php echo $sqlRow['lot_id'] ?></td>
                                        <td data-label="Part Name"><?php echo $sqlRow['part_name'] ?></td>
                                        <td data-label="Part Desc"><?php echo $sqlRow['part_desc'] ?></td>
                                        <td data-label="Item Code"><?php echo $sqlRow['item_code'] ?></td>
                                        <td data-label="Batch Number"><?php echo $sqlRow['batch_number'] ?></td>
                                        <td data-label="Quantity"><?php echo $sqlRow['part_qty'] ?></td>
                                        <td data-label="Batch Number"><?php echo $sqlRow['batch_number'] ?></td>
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
        </div>

        <!-- Approved Request Tab -->
        <div class="tab-pane fade" id="approved-tab-pane" role="tabpanel" aria-labelledby="approved-tab">

            <div class="mx-3">

                <h3 class="text-center fw-bold" style="color: #900008;">History of Approved Requests</h3>

                <div class="d-flex justify-content-evenly align-items-end mb-3 text-center">
                    <div>
                        <button class="btn btn-primary" id="return-btn">Return Request</button>
                    </div>
                    <div>
                        <label for="start_date_approve" class="me-2 fw-bold">Start Date:</label>
                        <input type="date" id="start_date_approve" class="form-control" />
                    </div>
                    <div>
                        <label for="end_date_approve" class="ms-2 me-2 fw-bold">End Date:</label>
                        <input type="date" id="end_date_approve" class="form-control" />
                    </div>

                </div>

                <table class="table table-striped w-100">
                    <thead>
                        <tr class="text-center"
                            style="background-color: #900008; color: white; vertical-align: middle;">
                            <th scope="col"><input type="checkbox" id="select-all-return"></th>
                            <th scope="col">Approved Date / Time</th>
                            <th scope="col">Lot ID</th>
                            <th scope="col">Part Number</th>
                            <th scope="col">Item Description</th>
                            <th scope="col">Item Code</th>
                            <th scope="col">Batch Number</th>
                            <th scope="col">Qty.</th>
                            <th scope="col">Machine No.</th>
                            <th scope="col">Cost Center</th>
                            <th scope="col">Withdrawal Reason</th>
                            <th scope="col">Approved Qty</th>
                            <th scope="col">Approved Reason</th>
                            <th scope="col">Approved By</th>
                        </tr>
                    </thead>
                    <tbody id="data-table-approve">

                    </tbody>
                </table>

                <div id="load-more-approve"></div>

            </div>

        </div>

        <!-- Rejected Request Tab -->
        <div class="tab-pane fade" id="rejected-tab-pane" role="tabpanel" aria-labelledby="rejected-tab">

            <div class="mx-3">

                <h3 class="text-center fw-bold" style="color: #900008;">History of Rejected Requests</h3>

                <div class="d-flex justify-content-evenly mb-3 text-center">
                    <div>
                        <label for="start_date_reject" class="me-2 fw-bold">Start Date:</label>
                        <input type="date" id="start_date_reject" class="form-control" />
                    </div>
                    <div>
                        <label for="end_date_reject" class="ms-2 me-2 fw-bold">End Date:</label>
                        <input type="date" id="end_date_reject" class="form-control" />
                    </div>
                </div>

                <table class="table table-striped w-100">

                    <thead>
                        <tr class="text-center"
                            style="background-color: #900008; color: white; vertical-align: middle;">
                            <th scope="col">Rejected Date / Time</th>
                            <th scope="col">Lot ID</th>
                            <th scope="col">Part Number</th>
                            <th scope="col">Item Description</th>
                            <th scope="col">Item Code</th>
                            <th scope="col">Batch Number</th>
                            <th scope="col">Qty.</th>
                            <th scope="col">Machine No.</th>
                            <th scope="col">Cost Center</th>
                            <th scope="col">Withdrawal Reason</th>
                            <th scope="col">Rejected Reason</th>
                            <th scope="col">Rejected By</th>
                        </tr>
                    </thead>

                    <tbody id="data-table-reject">

                    </tbody>

                </table>

                <div id="load-more-reject"></div>

            </div>

        </div>

        <!-- Returned Request Tab -->
        <div class="tab-pane fade" id="returned-tab-pane" role="tabpanel" aria-labelledby="returned-tab">

            <div class="mx-3">

                <h3 class="text-center fw-bold" style="color: #900008;">History of Returned Requests</h3>

                <div class="d-flex justify-content-evenly mb-3 text-center items-center">
                    <div>
                        <label for="start_date_return" class="me-2 fw-bold">Start Date:</label>
                        <input type="date" id="start_date_return" class="form-control" />
                    </div>
                    <div>
                        <label for="end_date_return" class="ms-2 me-2 fw-bold">End Date:</label>
                        <input type="date" id="end_date_return" class="form-control" />
                    </div>
                </div>

                <table class="table table-striped w-100">

                    <thead>
                        <tr class="text-center"
                            style="background-color: #900008; color: white; vertical-align: middle;">
                            <th scope="col">Returned Date/Time</th>
                            <th scope="col">Lot ID</th>
                            <th scope="col">Part Number</th>
                            <th scope="col">Item Code</th>
                            <th scope="col">Batch Number</th>
                            <th scope="col">Approved Qty.</th>
                            <th scope="col">Machine No.</th>
                            <th scope="col">Cost Center</th>
                            <th scope="col">Withdrawal Reason</th>
                            <th scope="col">Return Qty</th>
                            <th scope="col">Return Type</th>
                            <th scope="col">Return Reason</th>
                            <th scope="col">Received By</th>
                        </tr>
                    </thead>

                    <tbody id="data-table-return">

                    </tbody>

                </table>

                <div id="load-more-return"></div>

            </div>

        </div>

    </div>

</section>

<!-- Admin Withdrawal Modification -->
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
                        <table class="table table-striped table-bordered">
                            <thead class="text-center text-white" style="background-color: #900008;">
                                <tr style="vertical-align: middle;">
                                    <th>Date / Time / Shift</th>
                                    <th>Lot ID</th>
                                    <th>Part Number</th>
                                    <th>Item Code</th>
                                    <th>Batch Number</th>
                                    <th>Part Quantity</th>
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

<!-- Admin Withdrawal Deletion -->
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
                        <table class="table table-striped table-bordered">
                            <thead class="text-center text-white" style="background-color: #900008;">
                                <tr>
                                    <th>Date / Time / Shift</th>
                                    <th>Lot ID</th>
                                    <th>Part Number</th>
                                    <th>Part Quantity</th>
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

<!-- Admin Withdrawal Return -->
<div class="modal fade" id="returnModal" tabindex="-1" aria-labelledby="returnModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="returnModalLabel">Returning of Selected Requests</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="returnForm">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="text-center text-white" style="background-color: #900008;">
                                <tr>
                                    <th>Part Number</th>
                                    <th>Item Code</th>
                                    <th>Batch Number</th>
                                    <th>Returning Quantity</th>
                                    <th>Return Type</th>
                                    <th>Reason for Returning</th>
                                </tr>
                            </thead>
                            <tbody id="modalReturnList">
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="return_submit">Return</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = urlParams.get('tab') || 'withdraw';
        $('.nav-link').removeClass('active');
        $('.tab-pane').removeClass('show active');
        $(`#${activeTab}-tab`).addClass('active');
        $(`#${activeTab}-tab-pane`).addClass('show active');

        // Part Number shows Description
        $('#partSelect').on('change', function () {
            var partId = $(this).val();

            if (partId) {
                var partName = $(this).find('option:selected').data('part_name');
                $('#part_name').val(partName);

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

                        if (data.part_option) {
                            $('#part_option').val(data.part_option);
                        } else {
                            $('#part_option').val('No option available');
                        }

                        if (data.item_codes && data.item_codes.length > 0) {
                            $('#part_item_code').empty().append('<option value="">Select Item Code</option>');
                            data.item_codes.forEach(function (code) {
                                $('#part_item_code').append('<option value="' + code + '">' + code + '</option>');
                            });
                        } else {
                            $('#part_item_code').empty().append('<option value="">No item codes available</option>');
                        }
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

        // Select All Request
        $('#select-all').on('change', function () {
            $('.select-row').prop('checked', $(this).prop('checked'));
        });

        // Select Return
        $('#select-all-return').on('change', function () {
            let isChecked = $(this).prop('checked');

            $('.select-return').each(function () {
                if (!$(this).prop('disabled')) {
                    $(this).prop('checked', isChecked);
                }
            });
        });

        // Update Withdrawal Request Button
        $("#update-btn").click(function () {
            $("#modalItemList").empty();

            let selectedItems = $(".select-row:checked");

            if (selectedItems.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No items selected',
                    text: 'Please select at least one request to update.',
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
                let batch_number = $(this).data("batch_number");
                let item_code = $(this).data("item_code");

                let row = `
                    <tr class="text-center" style="vertical-align: middle;">
                        <td>${dts}</td>
                        <td>${lot_id}</td>
                        <td>${partName}</td>
                        <td>${item_code}</td>
                        <td>${batch_number}</td>
                        <td><input type="number" name="quantities[]" value="${qty}" class="form-control" min="1" max="${total_qty + qty}" step="1" required></td>
                        <td>                    
                            <select class="form-select" name="machines[]" required>
                                <option value="">Select Machine</option>
                                <?php
                                $select_machine = "SELECT * FROM tbl_machine";
                                $select_machine_query = mysqli_query($con, $select_machine);
                                if (mysqli_num_rows($select_machine_query) > 0) {
                                    while ($machine_row = mysqli_fetch_assoc($select_machine_query)) {
                                        ?>
                                        <option value="<?php echo $machine_row['machine_number'] ?>"
                                            data-id="<?php echo $machine_row['id'] ?>"
                                            ${machine === '<?php echo $machine_row['machine_number'] ?>' ? 'selected' : ''}>
                                            <?php echo $machine_row['machine_number'] ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                        <td> 
                            <select class="form-select" name="with_reasons[]" required>
                                 <option value="" ${!withdrawal ? 'selected' : ''}>Select Withdrawal Reason</option>
                                <?php
                                $select_reason = "SELECT * FROM tbl_withdrawal_reason";
                                $select_reason_query = mysqli_query($con, $select_reason);
                                if (mysqli_num_rows($select_reason_query) > 0) {
                                    while ($reason_row = mysqli_fetch_assoc($select_reason_query)) {
                                        ?>
                                        <option value="<?php echo $reason_row['reason'] ?>"
                                            ${withdrawal === '<?php echo $reason_row['reason'] ?>' ? 'selected' : ''}>
                                            <?php echo $reason_row['reason'] ?>
                                        </option>
                                        <?php
                                    }
                                }
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

                let row = `
                    <tr class=" text-center" style="vertical-align: middle;">
                        <td data-label="Date / Time / Shift">${dts}</td>
                        <td data-label="Lot ID">${lot_id}</td>
                        <td data-label="Part Number">${partName} <input type="hidden" name="ids[]" value="${id}"></td>
                        <td data-label="Part Quantity">${qty}</td>
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

        // Return Withdrawal Request Button
        $("#return-btn").click(function () {
            $("#modalReturnList").empty();

            let selectedItems = $(".select-return:checked");

            if (selectedItems.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No items selected',
                    text: 'Please select at least one request to return.',
                    confirmButtonText: 'Ok'
                });
                return;
            }

            selectedItems.each(function () {
                let id = $(this).data("id");
                let partName = $(this).data("part_name");
                let approved_qty = $(this).data("approved_qty");
                let req_by = $(this).data("req_by");
                let item_code = $(this).data("item_code");
                let batch_number = $(this).data("batch_number");

                let row = `
                    <tr class="text-center" style="vertical-align: middle;">
                        <td>${partName}</td>
                        <td>${item_code}</td>
                        <td>${batch_number}</td>
                        <td><input type="number" name="quantities[]" value="${approved_qty}" class="form-control" min="1" max="${approved_qty}" required></td>
                        <td>
                            <select class="form-select" name="return_purposes[]" required>
                                <option value="">Purpose of Return</option>
                                <option value="Partial">Partial</option>
                                <option value="Scrap">Scrap</option>
                            </select>
                        </td>
                        <td><input type="text" name="reasons[]" class="form-control" placeholder="Reason for Returning ${partName}" autocomplete="off" required></td>
                        <td style="display:none;"> 
                            <input type="hidden" name="ids[]" value="${id}">
                            <input type="hidden" name="part_names[]" value="${partName}">
                            <input type="hidden" name="req_bys[]" value="${req_by}">
                        </td>
                    </tr>

                `;
                $("#modalReturnList").append(row);
            });
            $("#returnModal").modal("show");
        });


        // Form Submission Function
        function handleForm(formSelector, submitKey, url, successTitle, successText, redirectUrl = null) {
            $(formSelector).submit(function (e) {
                e.preventDefault();

                let formData = $(this).serialize();
                formData += `&${submitKey}=1`;

                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: successTitle,
                                text: successText,
                                confirmButtonText: 'Ok'
                            }).then(() => {
                                if (redirectUrl) {
                                    window.location.href = redirectUrl;
                                } else {
                                    location.reload();
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.error || 'An unexpected error occurred.',
                                confirmButtonText: 'Ok'
                            });
                        }
                    }
                });
            });
        }

        // Form Submission Function for Update 
        handleForm("#updateForm", "update_submit", "../../controller/user_query.php", "Success!", "Requests updated successfully!");

        // Form Submission Function for Deletion
        handleForm("#deleteForm", "delete_submit", "../../controller/user_query.php", "Deleted!", "Requests have been deleted successfully.");

        // Form Submission Function for Return Request
        handleForm("#returnForm", "return_submit", "../../controller/update_status.php", "Success!", "You are now authorized to return the part number(s)", "adminWithdrawal.php?tab=approved");

        // Fetch Data Tables
        const scrollTables = {
            approve: {
                page: 1,
                hasMore: true,
                isLoading: false,
                startSelector: '#start_date_approve',
                endSelector: '#end_date_approve',
                url: '../../controller/withdrawal_approved.php',
                tableSelector: '#data-table-approve',
                sentinelId: '#load-more-approve'
            },
            reject: {
                page: 1,
                hasMore: true,
                isLoading: false,
                startSelector: '#start_date_reject',
                endSelector: '#end_date_reject',
                url: '../../controller/withdrawal_rejected.php',
                tableSelector: '#data-table-reject',
                sentinelId: '#load-more-reject'
            },
            return: {
                page: 1,
                hasMore: true,
                isLoading: false,
                startSelector: '#start_date_return',
                endSelector: '#end_date_return',
                url: '../../controller/withdrawal_returned.php',
                tableSelector: '#data-table-return',
                sentinelId: '#load-more-return'
            }
        };

        function loadMoreData(key) {
            const t = scrollTables[key];
            if (t.isLoading || !t.hasMore) return;

            t.isLoading = true;

            $.ajax({
                url: t.url,
                method: 'GET',
                data: {
                    start_date: $(t.startSelector).val(),
                    end_date: $(t.endSelector).val(),
                    page: t.page
                },
                success: function (response) {
                    const data = JSON.parse(response);
                    $(t.tableSelector).append(data.table);
                    t.hasMore = data.has_more;
                    t.page++;
                },
                error: function () {
                    alert(`Error loading more ${key} data.`);
                },
                complete: function () {
                    t.isLoading = false;
                }
            });
        }

        function setupInfiniteScroll(key) {
            const sentinel = document.querySelector(scrollTables[key].sentinelId);
            if (!sentinel) {
                console.warn(`Sentinel not found for ${key}:`, scrollTables[key].sentinelId);
                return;
            }

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        loadMoreData(key);
                    }
                });
            }, {
                root: null,
                threshold: 0.75
            });

            observer.observe(sentinel);
        }

        function resetAndFetch(key) {
            const t = scrollTables[key];
            t.page = 1;
            t.hasMore = true;
            $(t.tableSelector).html('');
            loadMoreData(key);
        }


        $(function () {
            setupInfiniteScroll('approve');
            setupInfiniteScroll('reject');
            setupInfiniteScroll('return');

            $('#start_date_approve, #end_date_approve').on('change', () => resetAndFetch('approve'));
            $('#start_date_reject, #end_date_reject').on('change', () => resetAndFetch('reject'));
            $('#start_date_return, #end_date_return').on('change', () => resetAndFetch('return'));

            resetAndFetch('approve');
            resetAndFetch('reject');
            resetAndFetch('return');
        });

    });

</script>