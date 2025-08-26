<?php
date_default_timezone_set('Asia/Manila');
include "../../model/dbconnection.php";
include "navBar.php";

?>

<head>

    <title>Withdrawal History</title>
    <link rel="stylesheet" href="../../public/css/table.css">
    <script src="../../public/js/jquery.js"></script>

</head>

<section>

    <div class="mx-5 my-3">

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="approved-tab" data-bs-toggle="tab"
                    data-bs-target="#approved-tab-pane" type="button" role="tab" aria-controls="approved-tab-pane"
                    aria-selected="true">Approved Request</button>
                <button class="nav-link" id="rejected-tab" data-bs-toggle="tab" data-bs-target="#rejected-tab-pane"
                    type="button" role="tab" aria-controls="rejected-tab-pane" aria-selected="false">Rejected
                    Request</button>
                <button class="nav-link" id="returned-tab" data-bs-toggle="tab" data-bs-target="#returned-tab-pane"
                    type="button" role="tab" aria-controls="returned-tab-pane" aria-selected="false">Returned
                    Request</button>
            </div>
        </nav>

        <div class="tab-content mt-3" id="nav-tabContent">

            <!-- Approve Request Tab -->
            <div class="tab-pane fade show active" id="approved-tab-pane" role="tabpanel"
                aria-labelledby="approved-tab">

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
                                <th scope="col">UOM</th>
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
                                <th scope="col">UOM</th>
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
                                <th scope="col">UOM</th>
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



</section>

<script>

    $(document).ready(function () {

        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = urlParams.get('tab') || 'approved';
        $('.nav-link').removeClass('active');
        $('.tab-pane').removeClass('show active');
        $(`#${activeTab}-tab`).addClass('active');
        $(`#${activeTab}-tab-pane`).addClass('show active');

        // Select Return
        $('#select-all-return').on('change', function () {
            let isChecked = $(this).prop('checked');

            $('.select-return').each(function () {
                if (!$(this).prop('disabled')) {
                    $(this).prop('checked', isChecked);
                }
            });
        });

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
                            <input type="text" name="ids[]" value="${id}">
                            <input type="text" name="part_names[]" value="${partName}">
                            <input type="text" name="req_bys[]" value="${req_by}">
                        </td>
                    </tr>

                `;
                $("#modalReturnList").append(row);
            });
            $("#returnModal").modal("show");
        });

        // Return Withdrawal Request Submit
        $("#returnForm").submit(function (e) {
            e.preventDefault();

            let formData = $(this).serialize();
            formData += "&return_submit=1";

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
                            text: 'You are now authorized to return the part number(s)',
                            confirmButtonText: 'Ok'
                        }).then(() => {
                            window.location.href = 'userHistory.php?tab=approved';
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