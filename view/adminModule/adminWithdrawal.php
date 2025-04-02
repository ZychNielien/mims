<?php

// Database Connection
include "../../model/dbconnection.php";

// Navigation Bar
include "navBar.php";

?>

<head>

    <!-- Title -->
    <title>Material Withdrawal</title>

    <!-- Withdrawal Style -->
    <link rel="stylesheet" href="../../public/css/responsiveWithdrawal.css">

</head>

<section>

    <!-- Navigation Tabs -->
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
            <div class="px-5 hatian d-flex justify-between align-center w-100 my-3">
                <div class="divWithdrawal px-3 w-25">
                    <div class="containerTitle">
                        <h4>Material Withdrawal</h4>
                    </div>
                    <form method="POST" action="../../controller/inventory.php">
                        <?php
                        $selected_username = $_SESSION['username'];
                        $select_user = "SELECT * FROM tbl_users WHERE username = '$selected_username'";
                        $select_user_query = mysqli_query($con, $select_user);
                        $select_user_row = mysqli_fetch_assoc($select_user_query);


                        $query = "SELECT id, part_name FROM tbl_inventory ORDER BY part_name ASC";
                        $result = mysqli_query($con, $query);
                        ?>
                        <input type="hidden" value="<?php echo $select_user_row['cost_center'] ?>" name="cost_center">

                        <div class="mb-3">
                            <label for="partSelect" class="form-label">Part Number</label>
                            <select class="form-select" id="partSelect">
                                <option value="">Select a Part</option>
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

                        <div id="itemDetails" style="display: none;">
                            <input type="hidden" id="part_name" name="part_name" />
                            <div class="mb-1">
                                <label for="part_desc" class="form-label">Item Description</label>
                                <textarea class="form-control" id="part_desc" rows="2" name="part_desc"
                                    readonly></textarea>
                            </div>
                            <div class="mb-1">
                                <label for="part_option" class="form-label">Option</label>
                                <input type="text" class="form-control" id="part_option" name="part_option" readonly>
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
                            <button type="submit" class="btn btn-primary" name="mat_req_part">Submit</button>
                        </div>


                    </form>
                </div>
                <div class="divReq p-3 w-75" style="max-height: 750px; overflow: auto;">
                    <div class="containerTitle">
                        <h4 class="text-center">Requested Parts</h4>
                    </div>

                    <form action="../../controller/admin_withdrawal.php" method="post" id="delete-form">
                        <div class="d-flex justify-content-start w-100 my-2">

                            <button type="button" id="delete-btn" class="btn btn-danger">
                                Delete Selected
                            </button>

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
                                    <th scope="col">Qty.</th>
                                    <th scope="col">Expiration</th>
                                    <th scope="col">Machine No.</th>
                                    <th scope="col">Withdrawal Reason</th>
                                    <th scope="col">Requested By</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $userName = $_SESSION['username'];
                                $sql = "SELECT * FROM tbl_requested WHERE req_by = '$userName' AND status = 'Pending' ORDER BY dts DESC";
                                $sql_query = mysqli_query($con, $sql);

                                if (mysqli_num_rows($sql_query) > 0) {
                                    while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                                        ?>
                                        <tr class="text-center">
                                            <td>
                                                <input type="checkbox" class="select-row" data-id="<?php echo $sqlRow['id']; ?>"
                                                    data-qty="<?php echo $sqlRow['part_qty']; ?>"
                                                    data-part_name="<?php echo $sqlRow['part_name']; ?>"
                                                    data-exp_date="<?php echo $sqlRow['exp_date']; ?>">
                                            </td>

                                            <td data-label="Date / Time / Shift"><?php echo $sqlRow['dts']; ?></td>
                                            <td data-label="Lot Id"><?php echo $sqlRow['lot_id']; ?></td>
                                            <td data-label="Part Name"><?php echo $sqlRow['part_name']; ?></td>
                                            <td data-label="Part Desc"><?php echo $sqlRow['part_desc']; ?></td>
                                            <td data-label="Quantity"><?php echo $sqlRow['part_qty']; ?></td>
                                            <td data-label="Expiration"><?php echo $sqlRow['exp_date']; ?></td>
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
                                        <td colspan="11" class="text-center">No withdrawal request found</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>

        <!-- Approved Request Tab -->
        <div class="tab-pane fade" id="approved-tab-pane" role="tabpanel" aria-labelledby="approved-tab">

            <div class="container  ">

                <!-- Title Tab -->
                <h3 class="text-center fw-bold" style="color: #900008;">History of Approved Requests</h3>

                <!-- Approved Requests Selections -->
                <div class="d-flex justify-content-evenly mb-3 text-center">
                    <div>
                        <label for="start_date_approve" class="me-2 fw-bold">Start Date:</label>
                        <input type="date" id="start_date_approve" class="form-control" />
                    </div>
                    <div>
                        <label for="end_date_approve" class="ms-2 me-2 fw-bold">End Date:</label>
                        <input type="date" id="end_date_approve" class="form-control" />
                    </div>
                </div>

                <!-- Return Modal -->
                <div class="modal fade" id="returnModal" tabindex="-1" aria-labelledby="returnModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
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
                                        <input type="number" class="form-control" id="returnQty" name="return_qty"
                                            placeholder="Enter Quantity" required>
                                    </div>
                                    <div class="mb-3" style="display: none;">
                                        <label for="reqBy" class="form-label">Quantity</label>
                                        <input type="text" class="form-control" id="reqBy" name="req_by">
                                    </div>
                                    <div class="mb-3" style="display: none;">
                                        <label for="part_namereturn" class="form-label">Quantity</label>
                                        <input type="text" class="form-control" id="part_namereturn" name="part_name">
                                    </div>
                                    <div id="quantityMessage" class="alert alert-info">
                                        Your requested quantity for this part is [X]. Please return a quantity below
                                        [X].
                                    </div>
                                    <div class="mb-3">
                                        <label for="returnReason" class="form-label">Reason for Return</label>
                                        <textarea class="form-control" id="returnReason" name="return_reason" rows="3"
                                            placeholder="Enter Reason for Return" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="submitReturn">Submit
                                        Return</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Approved Requests Table -->
                <table class="table table-striped w-100">

                    <thead>
                        <tr class="text-center"
                            style="background-color: #900008; color: white; vertical-align: middle;">
                            <th scope="col">Approved Date / Time</th>
                            <th scope="col">Lot ID</th>
                            <th scope="col">Part Number</th>
                            <th scope="col">Item Description</th>
                            <th scope="col">Qty.</th>
                            <th scope="col">Machine No.</th>
                            <th scope="col">Withdrawal Reason</th>
                            <th scope="col">Requested By</th>
                            <th scope="col">Status</th>
                            <th scope="col">Approved By</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody id="data-table-approve">

                    </tbody>

                </table>

            </div>

        </div>

        <!-- Rejected Request Tab -->
        <div class="tab-pane fade" id="rejected-tab-pane" role="tabpanel" aria-labelledby="rejected-tab">

            <div class="container  ">

                <!-- Title Tab -->
                <h3 class="text-center fw-bold" style="color: #900008;">History of Rejected Requests</h3>

                <!-- Rejected Requests Selections -->
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

                <!-- Rejected Requests Table -->
                <table class="table table-striped w-100">

                    <thead>
                        <tr class="text-center"
                            style="background-color: #900008; color: white; vertical-align: middle;">
                            <th scope="col">Rejected Date / Time</th>
                            <th scope="col">Lot ID</th>
                            <th scope="col">Part Number</th>
                            <th scope="col">Item Description</th>
                            <th scope="col">Qty.</th>
                            <th scope="col">Machine No.</th>
                            <th scope="col">Withdrawal Reason</th>
                            <th scope="col">Requested By</th>
                            <th scope="col">Status</th>
                            <th scope="col">Rejected By</th>
                        </tr>
                    </thead>

                    <tbody id="data-table-reject">

                    </tbody>

                </table>

            </div>

        </div>

        <!-- Returned Request Tab -->
        <div class="tab-pane fade" id="returned-tab-pane" role="tabpanel" aria-labelledby="returned-tab">

            <div class="container  ">

                <!-- Title Tab -->
                <h3 class="text-center fw-bold" style="color: #900008;">History of Returned Requests</h3>

                <!-- Returned Requests Selections -->
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

                <!-- Returned Requests Table -->
                <table class="table table-striped w-100">

                    <thead>
                        <tr class="text-center"
                            style="background-color: #900008; color: white; vertical-align: middle;">
                            <th scope="col">Returned Date/Time</th>
                            <th scope="col">Lot ID</th>
                            <th scope="col">Part Number</th>
                            <th scope="col">Qty.</th>
                            <th scope="col">Machine No.</th>
                            <th scope="col">Withdrawal Reason</th>
                            <th scope="col">Returned By</th>
                            <th scope="col">Status</th>
                            <th scope="col">Return Qty</th>
                            <th scope="col">Return Reason</th>
                            <th scope="col">Received By</th>
                        </tr>
                    </thead>

                    <tbody id="data-table-return">

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</section>

<script>
    $(document).ready(function () {

        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = urlParams.get('tab') || 'withdraw';
        $('.nav-link').removeClass('active');
        $('.tab-pane').removeClass('show active');
        $(`#${activeTab}-tab`).addClass('active');
        $(`#${activeTab}-tab-pane`).addClass('show active');

        filterDataApprove();
        filterDataReject();
        filterDataReturn();

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
                        if (data.part_desc) {
                            $('#itemDetails').show();
                            $('#part_desc').val(data.part_desc);
                        } else {
                            $('#part_desc').val('No description available');
                        }

                        if (data.part_option) {
                            $('#part_option').val(data.part_option);
                        } else {
                            $('#part_option').val('No option available');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX error: ' + error);
                    }
                });
            } else {
                $('#itemDetails').hide();
                $('#part_desc').val('');
                $('#part_option').val('');
                $('#part_name').val('');
            }
        });

        // Select All Request
        $('#select-all').on('click', function () {
            $('.select-row').prop('checked', this.checked);
        });

        // Delete Specific or Multiple Request
        $('#delete-btn').on('click', function () {
            var selectedIds = [];
            var partQuantities = [];
            var partNames = [];
            var expDates = [];

            $('.select-row:checked').each(function () {
                selectedIds.push($(this).data('id'));
                partQuantities.push($(this).data('qty'));
                partNames.push($(this).data('part_name'));
                expDates.push($(this).data('exp_date'));
            });

            if (selectedIds.length === 0) {
                Swal.fire({
                    title: 'No Selection!',
                    text: 'Please select at least one record to delete.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this action!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.each(selectedIds, function (index, value) {
                        $('#delete-form').append('<input type="hidden" name="selected_ids[]" value="' + value + '">');
                    });

                    $.each(partQuantities, function (index, value) {
                        $('#delete-form').append('<input type="hidden" name="part_quantities[]" value="' + value + '">');
                    });

                    $.each(partNames, function (index, value) {
                        $('#delete-form').append('<input type="hidden" name="part_names[]" value="' + value + '">');
                    });

                    $.each(expDates, function (index, value) {
                        $('#delete-form').append('<input type="hidden" name="exp_dates[]" value="' + value + '">');  // Add expiration date
                    });

                    $('#delete-form').submit();
                }
            });
        });

        // Return Item Withdrew Data
        $(document).on('click', '.return-btn', function () {
            var Id = $(this).data('id');
            var partQty = $(this).data('part-qty');
            var reqBy = $(this).data('req-by');
            var partName = $(this).data('part-name');
            $('#part_namereturn').val(partName);
            $('#lot_id').val(Id);
            $('#reqBy').val(reqBy);
            $('#returnQty').attr('max', partQty);
            $('#returnQty').val('');

            $('#quantityMessage').text('Your requested quantity for this part is ' + partQty + '. Please return a quantity below or equal to this.');
        });

        // Return Item Submit Form
        $('#returnForm').submit(function (e) {
            e.preventDefault();

            var Id = $('#lot_id').val();
            var returnReason = $('#returnReason').val();
            var returnQty = $('#returnQty').val();
            var reqBy = $('#reqBy').val();
            var partNameReturn = $('#part_namereturn').val();

            $.ajax({
                url: '../../controller/update_status.php',
                type: 'POST',
                data: {
                    lot_id: Id,
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

        // Approve Request Date Selection
        $('#start_date_approve, #end_date_approve').on('change', function () {
            let startDate = $('#start_date_approve').val();
            let endDate = $('#end_date_approve').val();

            if (startDate && endDate) {
                filterDataApprove(startDate, endDate);
            }
        });

        // Approve Request AJAX
        function filterDataApprove(startDate, endDate) {
            $.ajax({
                url: '../../controller/withdrawal_approved.php',
                method: 'GET',
                data: {
                    start_date: startDate,
                    end_date: endDate
                },
                success: function (response) {
                    $('#data-table-approve').html(response);
                },
                error: function (xhr, status, error) {
                    console.log("Error: ", error);
                    alert('Error fetching data.');
                }
            });
        }

        // Rejected Request Date Selection
        $('#start_date_reject, #end_date_reject').on('change', function () {
            let startDate = $('#start_date_reject').val();
            let endDate = $('#end_date_reject').val();

            if (startDate && endDate) {
                filterDataReject(startDate, endDate);
            }
        });

        // Reject Request AJAX
        function filterDataReject(startDate, endDate) {
            $.ajax({
                url: '../../controller/withdrawal_rejected.php',
                method: 'GET',
                data: {
                    start_date: startDate,
                    end_date: endDate
                },
                success: function (response) {
                    $('#data-table-reject').html(response);
                },
                error: function (xhr, status, error) {
                    console.log("Error: ", error);
                    alert('Error fetching data.');
                }
            });
        }

        // Return Request Date Selection
        $('#start_date_return, #end_date_return').on('change', function () {
            let startDate = $('#start_date_return').val();
            let endDate = $('#end_date_return').val();

            if (startDate && endDate) {
                filterDataReturn(startDate, endDate);
            }
        });

        // Return Request AJAX
        function filterDataReturn(startDate, endDate) {
            $.ajax({
                url: '../../controller/withdrawal_returned.php',
                method: 'GET',
                data: {
                    start_date: startDate,
                    end_date: endDate
                },
                success: function (response) {
                    $('#data-table-return').html(response);
                },
                error: function (xhr, status, error) {
                    console.log("Error: ", error);
                    alert('Error fetching data.');
                }
            });
        }


    });

</script>