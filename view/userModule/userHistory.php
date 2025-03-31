<?php
// PH Time
date_default_timezone_set('Asia/Manila');

// Database Connection
include "../../model/dbconnection.php";

// Navigation Bar
include "navBar.php";

?>

<head>

    <!-- Title -->
    <title>Withdrawal History</title>

    <!-- Table Style -->
    <link rel="stylesheet" href="../../public/css/table.css">

    <!-- Jquery Script -->
    <script src="../../public/js/jquery.js"></script>

</head>

<section>

    <!-- Welcome Div -->
    <div class="welcomeDiv my-2">
        <h2 class="text-center">Welcome, <?php echo $_SESSION['username'] ?>!</h2>
    </div>

    <div class="container">

        <!-- Navigation Tab for all Request Tab -->
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="approved-tab" data-bs-toggle="tab"
                    data-bs-target="#approved-tab-pane" type="button" role="tab" aria-controls="approved-tab-pane"
                    aria-selected="true">Approved</button>
                <button class="nav-link" id="rejected-tab" data-bs-toggle="tab" data-bs-target="#rejected-tab-pane"
                    type="button" role="tab" aria-controls="rejected-tab-pane" aria-selected="false">Rejected</button>
                <button class="nav-link" id="returned-tab" data-bs-toggle="tab" data-bs-target="#returned-tab-pane"
                    type="button" role="tab" aria-controls="returned-tab-pane" aria-selected="false">Returned</button>
            </div>
        </nav>

        <!-- Requests Tab -->
        <div class="tab-content mt-3" id="nav-tabContent">

            <!-- Approve Request Tab -->
            <div class="tab-pane fade show active" id="approved-tab-pane" role="tabpanel"
                aria-labelledby="approved-tab">

                <div class="container  ">

                    <!-- Approve Request Title -->
                    <h3 class="text-center fw-bold" style="color: #900008;">History of Approved Requests</h3>

                    <!-- Approve Request Date Selection -->
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

                    <!-- Return Item Withdrew Modal -->
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
                                                rows="3" required placeholder="Enter Reason for Return"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit Return</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Approve Request Table -->
                    <table class="table table-striped w-100">
                        <thead>
                            <tr class="text-center"
                                style="background-color: #900008; color: white; vertical-align: middle;">
                                <th scope="col">Date / Time / Shift</th>
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

                    <!-- Rejected Request Title -->
                    <h3 class="text-center fw-bold" style="color: #900008;">History of Rejected Requests</h3>

                    <!-- Rejected Request Date Selection -->
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

                    <!-- Rejected Request Table -->
                    <table class="table table-striped w-100">
                        <thead>
                            <tr class="text-center"
                                style="background-color: #900008; color: white; vertical-align: middle;">
                                <th scope="col">Date / Time / Shift</th>
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

                <div class="container">

                    <!-- Returned Request Title -->
                    <h3 class="text-center fw-bold" style="color: #900008;">History of Returned Requests</h3>

                    <!-- Returned Request Date Selection -->
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

                    <!-- Returned Request Table -->
                    <table class="table table-striped w-100">

                        <thead>
                            <tr class="text-center"
                                style="background-color: #900008; color: white; vertical-align: middle;">
                                <th scope="col">Date/Time of Return</th>
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
    </div>


</section>

<script>

    $(document).ready(function () {

        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = urlParams.get('tab') || 'approved';
        $('.nav-link').removeClass('active');
        $('.tab-pane').removeClass('show active');
        $(`#${activeTab}-tab`).addClass('active');
        $(`#${activeTab}-tab-pane`).addClass('show active');

        filterDataApprove();
        filterDataReject();
        filterDataReturn();

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
                url: '../../controller/user_query.php',
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

    });

</script>