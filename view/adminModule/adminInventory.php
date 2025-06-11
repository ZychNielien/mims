<?php

include "../../model/dbconnection.php";
include "navBar.php";


?>

<head>
    <title>Material Inventory</title>
    <link rel="stylesheet" href="../../public/css/table.css">
    <link rel="stylesheet" href="../../public/css/sweetalert.min.css">
    <script src="../../public/js/sweetalert2@11.js"></script>
    <script src="../../public/js/jquery.js"></script>
    <script src="../../public/js/excel.js"></script>
    <script src="../../public/js/xlsx.js"></script>
    <style>
        #itemTable tbody tr td input,
        #itemTable tbody tr td select,
        #itemStockTable tbody tr td input,
        #itemStockTable tbody tr td select,
        #modalEditItemList tr td input,
        #modalEditItemList tr td select {
            min-width: max-content;
        }

        .text-orange-dark {
            color: #e67e22 !important;
            font-weight: bold;
        }
    </style>
</head>

<body data-user="<?php echo $_SESSION['user']; ?>">

    <section class="w-100" style="max-height: 90%;">

        <div class="mx-5 hatian d-flex flex-column justify-content-center align-center ">

            <h2 class="text-center" style="color: #900008; font-weight: bold;">Inventory of Parts
            </h2>

            <div class="px-3 my-3 d-flex flex-wrap justify-content-between align-items-center">
                <input type="text" id="search_inventory" class="form-control w-25" placeholder="Search Part Number"
                    autocomplete="off" />
                <button type="button" class="btn btn-success m-1" data-bs-toggle="modal"
                    data-bs-target="#materialRegistrationModal">Material Registration</button>

                <button type="button" class="btn btn-secondary m-1" data-bs-toggle="modal"
                    data-bs-target="#addToStockModal">Add to Stock</button>
                <button class="btn btn-primary" id="edit_material-btn">Edit Material(s)</button>
                <?php if ($_SESSION['user'] !== 'Kitting'): ?>
                    <button class="btn btn-danger" id="delete_material-btn">Delete Material(s)</button>
                <?php endif; ?>
                <button id="export-btn" class="btn btn-success my-1">Export to Excel</button>

            </div>
            <table class="table table-striped" id="data-table" data-username="<?php echo $_SESSION['user']; ?>">

                <thead>
                    <tr class="text-center" style="background-color: #900008; color: white; vertical-align: middle;">
                        <th scope="col">
                            <input type="checkbox" id="select-all">
                        </th>
                        <th>Part Number</th>
                        <th>Part Description</th>
                        <th>Minimum Inventory Requirement</th>
                        <th>Earliest Expiration Date</th>
                        <th>Existing Inventory</th>
                        <th>Unit of Measure</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody id="data-table-inventory">
                </tbody>

            </table>

            <div id="spinner" class="text-center my-3" style="display: none;">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>


        </div>

    </section>

    <!-- Add to Stock Modal -->
    <div class="modal fade" id="addToStockModal" tabindex="-1" aria-labelledby="addToStockModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " style="max-width: 1400px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addToStockModalLabel">Add to Stock</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4 d-flex flex-wrap gap-3 align-items-stretch justify-content-evenly">
                        <div class="d-flex flex-row justify-content-end" style="min-width: 200px;">
                            <div id="uploadBox_AddtoStock" class="border border-secondary rounded px-3 py-2 text-center"
                                style="cursor: pointer; background-color: #f8f9fa; height: 38px; display: flex; align-items: center; justify-content: center; flex-grow: 1;">
                                <span id="uploadText_AddtoStock" class="me-2">📁</span>
                                <small class="text-muted" id="fileNameText_AddtoStock">Drag or Upload File</small>
                                <small id="fileError_AddtoStock" style="color:red; display:none;">Please select an Excel
                                    file.</small>
                            </div>
                            <input type="file" id="excelFile_AddtoStock" accept=".xlsx" hidden>
                        </div>
                        <div class="d-flex flex-column justify-content-end" style="min-width: 200px;">
                            <button class="btn btn-primary" id="btnUpload_AddtoStock">Upload File</button>
                        </div>
                        <div class="d-flex flex-column justify-content-end" style="min-width: 200px;">
                            <a href="../../public/AddtoStock.xlsx" download class="btn btn-outline-success">
                                Download Template
                            </a>
                        </div>
                        <div class="d-flex flex-wrap gap-3 align-items-stretch justify-content-start">
                            <button class="btn btn-success" id="btnAddStockRow">Add Row</button>
                        </div>
                    </div>
                    <div class="table-responsive overflow-x-auto">
                        <table class=" table table-bordered table-striped text-center" id="itemStockTable">
                            <thead>
                                <tr class="text-center"
                                    style="background-color: #900008; color: white; vertical-align: middle;">
                                    <th>Part Number</th>
                                    <th>Part Description</th>
                                    <th>Batch Number</th>
                                    <th>Lot ID</th>
                                    <th>Item Code</th>
                                    <th>Quantity</th>
                                    <th>Has Expiration Date?</th>
                                    <th>Expiration Date</th>
                                    <th>Badge ID</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addtoStockButton">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Material Registration Modal -->
    <div class="modal fade" id="materialRegistrationModal" tabindex="-1"
        aria-labelledby="materialRegistrationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 1400px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="materialRegistrationModalLabel">Material Registration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-4 d-flex flex-wrap gap-3 align-items-stretch justify-content-evenly">
                        <div class="d-flex flex-row justify-content-end" style="min-width: 200px;">
                            <div id="uploadBox" class="border border-secondary rounded px-3 py-2 text-center"
                                style="cursor: pointer; background-color: #f8f9fa; height: 38px; display: flex; align-items: center; justify-content: center; flex-grow: 1;">
                                <span id="uploadText" class="me-2">📁</span>
                                <small class="text-muted" id="fileNameText">Drag or Upload File</small>
                                <small id="fileError" style="color:red; display:none;">Please select an Excel
                                    file.</small>
                            </div>
                            <input type="file" id="excelFile" accept=".xlsx" hidden>
                        </div>
                        <div class="d-flex flex-column justify-content-end" style="min-width: 200px;">
                            <button class="btn btn-primary" id="btnUpload">Upload File</button>
                        </div>
                        <div class="d-flex flex-column justify-content-end" style="min-width: 200px;">
                            <a href="../../public/Material_Registration.xlsx" download class="btn btn-outline-success">
                                Download Template
                            </a>
                        </div>

                        <div class="d-flex flex-column justify-content-end" style="min-width: 200px;">
                            <button class="btn btn-success" id="btnAddRow">Add Row</button>
                        </div>
                    </div>

                    <div class="table-responsive overflow-x-auto">
                        <table class="table table-striped table-bordered text-center w-100" id="itemTable">
                            <thead>
                                <tr class="text-center"
                                    style="background-color: #900008; color: white; vertical-align: middle;">
                                    <th>Part Number</th>
                                    <th>Part Description</th>
                                    <th>Material Type</th>
                                    <th>Material Category</th>
                                    <th>Cost Center</th>
                                    <th>Location</th>
                                    <th>Min Inventory Requirement</th>
                                    <th>Unit</th>
                                    <th>Approver</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnSubmit" name="submit_new_part">Submit</button>

                </div>
            </div>
        </div>
    </div>

    <!-- Edit Material Modal -->
    <div class="modal fade" id="editMaterialModal" tabindex="-1" aria-labelledby="editMaterialModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMaterialModalLabel">Update Selected Materials</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateForm">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="text-center text-white" style="background-color: #900008;">
                                    <tr style="vertical-align: middle;">
                                        <th>Part Number</th>
                                        <th>Part Description</th>
                                        <th>Material Type</th>
                                        <th>Material Category</th>
                                        <th>Cost Center</th>
                                        <th>Location</th>
                                        <th>Minimum Inventory Requirement</th>
                                        <th>Unit of Measure</th>
                                        <th>Approver</th>
                                    </tr>
                                </thead>
                                <tbody id="modalEditItemList">
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

    <!-- Delete Material Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Deletion of Selected Materials</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="deleteForm">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="text-center text-white" style="background-color: #900008;">
                                    <tr style="vertical-align: middle;">
                                        <th>Part Number</th>
                                        <th>Part Description</th>
                                        <th>Material Type</th>
                                        <th>Material Category</th>
                                        <th>Cost Center</th>
                                        <th>Reasons</th>
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

    <!-- Stocks Modal -->
    <div class="modal fade" id="stockModal" tabindex="-1" aria-labelledby="stockModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="stockModalLabel">Stock Details of <span
                            id="quantity_part_number"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editStocksQuanity">
                        <table class="table table-striped table-bordered">
                            <thead class="text-center text-white" style="background-color: #900008;">
                                <tr>
                                    <th>Part Number</th>
                                    <th>Item Code</th>
                                    <th>Batch Number</th>
                                    <th>Lot ID</th>
                                    <th>Quantity</th>
                                    <th>Expiration Date</th>
                                </tr>
                            </thead>
                            <tbody id="stockDetailsTableBody">
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" name="update_stocks">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

<script>
    const LIMIT = 20;
    let currentPage = 0;
    let isLoading = false;
    let loadedKeys = new Set();
    let searchTerm = '';
    let noMoreData = false;
    let checkedItems = {};

    $(document).on('change', '#select-all', function () {
        const isChecked = $(this).is(':checked');

        $('#data-table-inventory tr:visible').each(function () {
            const checkbox = $(this).find('input.select-row');
            const partName = checkbox.data('part_name');
            const key = `${partName}`;

            checkbox.prop('checked', isChecked);

            if (isChecked) {
                checkedItems[key] = true;
            } else {
                delete checkedItems[key];
            }
        });
    });

    $(document).ready(function () {
        loadPage(currentPage);

        $('#search_inventory').on('input', function () {
            searchTerm = $(this).val().trim().toLowerCase();

            currentPage = 0;
            noMoreData = false;
            loadedKeys.clear();

            if (searchTerm.length > 0) {
                loadSearchResults(searchTerm);
            } else {
                $('#data-table-inventory').empty();
                loadPage(currentPage);
            }
        });

        $(window).on('scroll', function () {
            if (noMoreData || isLoading) return;

            if (searchTerm.length === 0 && $(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                loadPage(currentPage);
            }
        });

        $(document).on('change', '.select-row', function () {
            const partName = $(this).data('part_name');
            const key = `${partName}`;

            if ($(this).is(':checked')) {
                checkedItems[key] = true;
            } else {
                delete checkedItems[key];
            }
        });
    });

    function loadPage(page) {
        if (isLoading) return;
        isLoading = true;

        $('#spinner').show();

        $.get(`../../controller/check_inventory.php?page=${page}&limit=${LIMIT}`, function (data) {
            if (data.length === 0) {
                noMoreData = true;
                $('#spinner').hide();
                return;
            }

            updateTable(data, false);
            currentPage++;
            isLoading = false;
            $('#spinner').hide();
        }).fail(function () {
            isLoading = false;
            $('#spinner').hide();
        });
    }

    function loadSearchResults(term) {
        if (isLoading) return;
        isLoading = true;

        $('#spinner').show();

        $.get(`../../controller/check_inventory.php?search=${encodeURIComponent(term)}`, function (data) {
            if (data.length === 0) {
                noMoreData = true;
                $('#data-table-inventory').empty();
                $('#spinner').hide();
                updateTable([], false);
                isLoading = false;
                return;
            }

            $('#data-table-inventory').empty();
            loadedKeys.clear();
            noMoreData = false;

            updateTable(data, false);
            isLoading = false;
            $('#spinner').hide();
        }).fail(function () {
            isLoading = false;
            $('#spinner').hide();
        });
    }

    function updateTable(data, isLiveUpdate = false) {
        if (!isLiveUpdate && currentPage === 0) {
            $('#data-table-inventory').empty();
            loadedKeys.clear();
        }

        const seen = new Set();
        const uniqueData = [];

        for (const item of data) {
            const key = item.part_name;
            if (!seen.has(key)) {
                seen.add(key);
                uniqueData.push(item);
            }
        }


        $.each(uniqueData, function (index, item) {
            const key = item.part_name;
            const existingRow = $(`#data-table-inventory tr[data-key="${key}"]`);

            if (isLiveUpdate && !loadedKeys.has(key)) {
                return;
            }

            if (!isLiveUpdate) {
                loadedKeys.add(key);
            }

            const totalPartQty = parseFloat(item.total_part_qty);
            const minInventReq = parseFloat(item.min_invent_req);
            let rowClass = '';

            if (totalPartQty === 0) {
                rowClass = 'text-danger fw-bold';
            } else if (minInventReq > 0 && totalPartQty < minInventReq) {
                rowClass = 'text-orange-dark';
            }

            const isChecked = checkedItems[key] ? 'checked' : '';
            const buttonHTML = item.total_part_qty > 0
                ? `<button class="btn btn-primary view-stock-btn" data-part="${item.part_name}">Quantity</button>`
                : '';

            const row = `
            <tr class="table-row text-center" style="vertical-align: middle;" data-key="${key}">
                <td data-label="Action">
                    <input type="checkbox" class="select-row" data-id="${item.id}"
                        data-part_name="${item.part_name}"
                        data-part_desc="${item.part_desc}"
                        data-part_category="${item.part_category}"
                        data-cost_center="${item.cost_center}"
                        data-part_option="${item.part_option}" 
                        data-location="${item.location}"
                        data-min_invent_req="${item.min_invent_req}" 
                        data-unit="${item.unit}"
                        data-approver="${item.approver}"
                        data-batch_number="${item.batch_number}"
                        data-item_code="${item.item_code}"
                        ${isChecked}>
                </td>
                <td data-label="Part Name" class="${rowClass}">${item.part_name}</td>
                <td data-label="Part Desc" class="${rowClass}">${item.part_desc}</td>
                <td data-label="Min Invent Req" class="${rowClass}">${item.min_invent_req}</td>
                <td data-label="Exp Date" class="${rowClass}">${item.least_exp_date}</td>
                <td data-label="Part Qty" class="${rowClass}">${item.total_part_qty}</td>
                <td data-label="Unit of Measure" class="${rowClass}">${item.unit}</td>
                <td data-label="Action" class="${rowClass}">${buttonHTML}</td>
            </tr>
        `;

            if (existingRow.length > 0) {
                if (isLiveUpdate) {
                    existingRow.replaceWith(row);
                }
            } else {
                $('#data-table-inventory').append(row);
            }
        });

        if (uniqueData.length < LIMIT && searchTerm.length === 0) {
            noMoreData = true;
        }

        filterTableRows();
    }

    function filterTableRows() {
        let hasVisible = false;

        $('#data-table-inventory tr').each(function () {
            const partName = $(this).find('td').eq(1).text().toLowerCase();
            const partDesc = $(this).find('td').eq(2).text().toLowerCase();

            if (partName.indexOf(searchTerm) === -1 && partDesc.indexOf(searchTerm) === -1) {
                $(this).hide();
            } else {
                $(this).show();
                hasVisible = true;
            }
        });

        $('#no-results-row').remove();

        if (!hasVisible) {
            $('#data-table-inventory').append(`
            <tr id="no-results-row" style="display: none;">
                <td colspan="8" class="text-center">No results found</td>
            </tr>
        `);
            $('#no-results-row').fadeIn();
        }
    }

    if (!!window.EventSource) {
        const source = new EventSource('../../controller/check_inventory.php');

        source.onmessage = function (event) {
            try {
                const data = JSON.parse(event.data);
                updateTable(data, true);
            } catch (err) {
                console.error("Failed to parse SSE data:", event.data, err);
            }
        };
    }

    $(document).on('click', '.view-stock-btn', function () {
        const partName = $(this).data('part');
        $('#quantity_part_number').text(partName);

        $.ajax({
            url: '../../controller/fetch_stock.php',
            method: 'POST',
            data: { part_name: partName },
            dataType: 'json',
            success: function (response) {
                let rows = '';
                if (response.length > 0) {
                    response.forEach(item => {
                        rows += `
                        <tr class="table-row text-center" style="vertical-align: middle;">
                            <td>${item.part_name}</td>
                            <td>${item.item_code}</td>
                            <td>${item.batch_number}</td>
                            <td>${item.lot_id}</td>
                            <td>
                                <input type="number" class="form-control" value="${item.part_qty}" name="part_quantities[]" required min="0">
                            </td>
                            <td>${item.exp_date}</td>
                            <td style="display:none;">
                                <input type="text" class="form-control" value="${item.part_name}" name="part_names[]">
                                <input type="text" class="form-control" value="${item.id}" name="ids[]">
                                <input type="text" class="form-control" value="${item.item_code}" name="item_codes[]">
                                <input type="text" class="form-control" value="${item.batch_number}" name="batch_numbers[]">
                                <input type="text" class="form-control" value="${item.lot_id}" name="lot_ids[]">
                            </td>
                        </tr>
                    `;
                    });
                } else {
                    rows = `<tr><td colspan="6" class="text-center">No stocks found.</td></tr>`;
                }

                $('#stockDetailsTableBody').html(rows);
                $('#stockModal').modal('show');
            },
            error: function () {
                alert('Failed to fetch stock details.');
            }
        });
    });

    $("#editStocksQuanity").submit(function (e) {
        e.preventDefault();

        let formData = $(this).serialize();

        formData += "&update_stocks=1";

        $.ajax({
            url: '../../controller/fetch_stock.php',
            type: "POST",
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Material Updated',
                        text: 'Material stocks have been updated successfully.',
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
            }
        });
    });

    $(document).ready(function () {

        var today = new Date().toISOString().split('T')[0];
        $('#exp_date').attr('min', today);

        $('#new_min_invent_req').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        }).on('blur', function () {
            if (this.value === '' || parseInt(this.value, 10) < 1) {
                this.value = 1;
            }
        });

        $('#export-btn').click(function () {
            var visibleRows = $('#data-table-inventory .table-row');
            var filteredRows = [];

            visibleRows.each(function () {
                if ($(this).css('display') !== 'none') {
                    filteredRows.push(this);
                }
            });

            var wb = XLSX.utils.book_new();
            var table1 = $('<table></table>');
            var headerRow = $('#data-table thead').clone(true);
            headerRow.find('th').first().remove();
            headerRow.find('th').last().remove();
            table1.append(headerRow);

            $(filteredRows).each(function () {
                var newRow = $(this).clone(true);
                newRow.find('td').first().remove();
                newRow.find('td').last().remove();
                table1.append(newRow);
            });

            var ws1 = XLSX.utils.table_to_sheet(table1[0]);
            XLSX.utils.book_append_sheet(wb, ws1, "Total Inventory");

            $.ajax({
                url: '../../controller/get_extra_fields.php',
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    var dataSheet2 = [];

                    dataSheet2.push([
                        "Part Name",
                        "Batch Number",
                        "Lot ID",
                        "Item Code",
                        "Quantity",
                        "Expiration Date",
                        "Badge ID"
                    ]);

                    response.forEach(function (item) {
                        dataSheet2.push([
                            item.part_name || '',
                            item.batch_number || '',
                            item.lot_id || '',
                            item.item_code || '',
                            item.part_qty || '',
                            item.exp_date || '',
                            item.kitting_id || '',
                        ]);
                    });

                    var ws2 = XLSX.utils.aoa_to_sheet(dataSheet2);
                    XLSX.utils.book_append_sheet(wb, ws2, "Stocks");

                    XLSX.writeFile(wb, "Inventory.xlsx");
                },
                error: function () {
                    alert("Failed to fetch extra data.");
                }
            });
        });

        // Search Inventory
        let debounceTimeout;
        let searchTerm = '';

        $('#search_inventory').on('input', function () {
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(function () {
                searchTerm = $('#search_inventory').val().toLowerCase();
                filterTableRows();
            }, 300);
        });


        // Upload Excel Files
        function setupExcelUploader(config) {
            const {
                uploadBoxId,
                fileInputId,
                fileNameTextId,
                uploadTextId,
                errorId,
                buttonId,
                addRowFn,
                mapRowFn
            } = config;

            const $uploadBox = $(`#${uploadBoxId}`);
            const $fileInput = $(`#${fileInputId}`);
            const $fileNameText = $(`#${fileNameTextId}`);
            const $uploadText = $(`#${uploadTextId}`);
            const $error = $(`#${errorId}`);

            $uploadBox.on('click', () => $fileInput.click());

            $uploadBox.on('dragover', e => {
                e.preventDefault();
                $uploadBox.addClass('border-primary');
            });

            $uploadBox.on('dragleave', () => $uploadBox.removeClass('border-primary'));

            $uploadBox.on('drop', e => {
                e.preventDefault();
                $uploadBox.removeClass('border-primary');
                const files = e.originalEvent.dataTransfer.files;
                if (files.length) {
                    $fileNameText.text(files[0].name);
                    $uploadText.text('✅ File Ready');
                    $fileInput.prop('files', files);
                }
            });

            $fileInput.on('change', function () {
                const file = this.files[0];
                if (file) {
                    $fileNameText.text(file.name);
                    $uploadText.text('✅ File Ready');
                } else {
                    $fileNameText.text('No file selected');
                    $uploadText.text('📁 Drag or Upload File');
                }
            });

            $(`#${buttonId}`).on('click', function () {
                const file = $fileInput[0].files[0];
                if (!file) {
                    $fileInput.addClass('input-error');
                    $error.show();
                    $fileNameText.hide();
                    return;
                }

                $fileInput.removeClass('input-error');
                $error.hide();
                $fileNameText.text('File selected: ' + file.name).show();

                const reader = new FileReader();
                reader.onload = function (e) {
                    const data = new Uint8Array(e.target.result);
                    const workbook = XLSX.read(data, { type: "array" });
                    const sheet = workbook.Sheets[workbook.SheetNames[0]];
                    const rows = XLSX.utils.sheet_to_json(sheet, { header: 1 }).slice(1);

                    rows.forEach(row => {
                        const mapped = mapRowFn(row);
                        addRowFn(mapped);
                    });
                };

                reader.readAsArrayBuffer(file);
            });
        }

        function formatExcelDate(excelDate) {
            if (typeof excelDate === 'number') {
                const date = XLSX.SSF.parse_date_code(excelDate);
                if (date) {
                    const yyyy = date.y;
                    const mm = String(date.m).padStart(2, '0');
                    const dd = String(date.d).padStart(2, '0');
                    return `${yyyy}-${mm}-${dd}`;
                }
            } else if (typeof excelDate === 'string' && excelDate.includes('/')) {
                const parts = excelDate.split('/');
                if (parts.length === 3) {
                    const dd = parts[0].padStart(2, '0');
                    const mm = parts[1].padStart(2, '0');
                    const yyyy = parts[2];
                    return `${yyyy}-${mm}-${dd}`;
                }
            }
            return '';
        }

        // Add to Stock Excel Function
        setupExcelUploader({
            uploadBoxId: 'uploadBox_AddtoStock',
            fileInputId: 'excelFile_AddtoStock',
            fileNameTextId: 'fileNameText_AddtoStock',
            uploadTextId: 'uploadText_AddtoStock',
            errorId: 'fileError_AddtoStock',
            buttonId: 'btnUpload_AddtoStock',
            addRowFn: addStockRow,
            mapRowFn: row => ({
                add_part_number: row[0],
                add_batch_number: row[1],
                add_lot_id: row[2],
                add_item_code: row[3],
                add_quantity: row[4],
                add_has_expiration_date: row[5],
                add_expiration_date: formatExcelDate(row[6]),
                add_badge_id: row[7]
            })
        });

        // Material Registration Excel Function
        setupExcelUploader({
            uploadBoxId: 'uploadBox',
            fileInputId: 'excelFile',
            fileNameTextId: 'fileNameText',
            uploadTextId: 'uploadText',
            errorId: 'fileError',
            buttonId: 'btnUpload',
            addRowFn: addRow,
            mapRowFn: row => ({
                new_part_number: row[0],
                new_part_desc: row[1],
                new_option: row[2],
                new_category: row[3],
                new_cost_center: row[4],
                new_location: row[5],
                new_min_invent_req: parseInt(row[6]) || 0,
                new_unit: row[7],
                new_approver: row[8]
            })
        });

        // Button actions
        $("#btnAddRow").on("click", addRow);
        $("#btnAddStockRow").on("click", addStockRow);

        // Submit Material Registration
        $("#btnSubmit").on("click", function (e) {
            e.preventDefault();

            let data = [];
            let valid = true;

            $("#itemTable tbody tr").each(function () {
                let item = {};

                $(this).find("input, select").each(function () {
                    const input = $(this);
                    const name = input.attr("name");
                    const value = input.val().trim();

                    item[name] = value;

                    if (!value) {
                        valid = false;
                        input.addClass("is-invalid");
                    } else {
                        input.removeClass("is-invalid");
                    }
                });

                data.push(item);
            });

            if (!valid) {
                return Swal.fire("Error!", "Missing Inputs", "error");
            }

            if (data.length === 0) {
                return Swal.fire("Error!", "No data to submit.", "error");
            }

            $.ajax({
                url: "../../controller/inventory.php",
                method: "POST",
                contentType: "application/json",
                dataType: "json",
                data: JSON.stringify({
                    materialSubmit: true,
                    items: data
                }),

                success: res => {
                    if (res.duplicates) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Duplicate Part Number(s)',
                            text: `The following already exist: ${res.duplicates.join(", ")}`
                        });
                    } else if (res.message === "Material added successfully") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.message || 'Something went wrong.'
                        });
                    }
                }

            });
        });

        // Add Row Material Registration
        function addRow(data = {}) {
            const row = $("<tr></tr>");
            row.append(`
                <td>
                    <input type="text" name="new_part_number" class="form-control" value="${data.new_part_number || ''}" placeholder="Part Number" autocomplete="off" required>
                </td>
                <td>
                    <input type="text" name="new_part_desc" class="form-control" value="${data.new_part_desc || ''}" placeholder="Part Description" autocomplete="off" required>
                </td>
                <td>
                    <select name="new_option" class="form-select" required>                                            
                        <option value=""${!data.new_option ? 'selected' : ''}>Material Type</option>
                        <option value="Direct"${data.new_option === 'Direct' ? 'selected' : ''}>Direct</option>
                        <option value="Indirect"${data.new_option === 'Indirect' ? 'selected' : ''}>Indirect</option>
                    </select>
                </td>
                <td>
                    <select name="new_category" class="form-select w-100" required>                                            
                        <option value=""${!data.new_category ? 'selected' : ''}">Material Category</option>
                        <option value="Critical" ${data.new_category === 'Critical' ? 'selected' : ''}>Critical</option>
                        <option value="Non-critical" ${data.new_category === 'Non-critical' ? 'selected' : ''}>Non-critical</option>
                        <option value="General Supply Material" ${data.new_category === 'General Supply Material' ? 'selected' : ''}>General Supply Material</option>
                    </select>
                </td>
                <td>
                    <select name="new_cost_center" class="form-select w-100" required>  
                        <option value="" ${!data.new_cost_center ? 'selected' : ''}>Cost Center</option>
                        <?php
                        $select_ccid = "SELECT * FROM tbl_ccs";
                        $select_ccid_query = mysqli_query($con, $select_ccid);
                        if (mysqli_num_rows($select_ccid_query) > 0) {
                            while ($ccid_row = mysqli_fetch_assoc($select_ccid_query)) {
                                ?>
                                <option value="<?php echo $ccid_row['ccid'] ?>"
                                    data-id="<?php echo $ccid_row['id'] ?>"
                                    ${data.new_cost_center === '<?php echo $ccid_row['ccid'] ?>' ? 'selected' : ''}>
                                    <?php echo $ccid_row['ccid'] ?>
                                </option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <input type="text" name="new_location" class="form-control" value="${data.new_location || ''}" placeholder="Location" autocomplete="off" required>
                </td>
                <td>
                    <input type="number" name="new_min_invent_req" class="form-control" value="${data.new_min_invent_req || ''}" placeholder="Min. Inventory Requirement" autocomplete="off" required>
                </td>
                <td>                                        
                    <select class="form-select" name="new_unit" required>
                      <option value="" ${!data.new_unit ? 'selected' : ''}>Unit</option>
                        <?php
                        $select_unit = "SELECT * FROM tbl_unit";
                        $select_unit_query = mysqli_query($con, $select_unit);
                        if (mysqli_num_rows($select_unit_query) > 0) {
                            while ($unit_row = mysqli_fetch_assoc($select_unit_query)) {
                                ?>
                                <option value="<?php echo $unit_row['unit'] ?>"
                                    data-id="<?php echo $unit_row['id'] ?>"
                                    ${data.new_unit === '<?php echo $unit_row['unit'] ?>' ? 'selected' : ''}>
                                    <?php echo strtoupper($unit_row['unit']) ?>
                                </option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <select name="new_approver" class="form-select" required>                                            
                        <option value="" ${!data.new_approver ? 'selected' : ''}>Approver</option>
                        <option value="Supervisor" ${data.new_approver === 'Supervisor' ? 'selected' : ''}>Supervisor</option>
                        <option value="Kitting" ${data.new_approver === 'Kitting' ? 'selected' : ''}>Kitting</option>
                    </select>
                </td>
                <td>
                    <button class="btn btn-danger" onclick="this.closest('tr').remove()">Delete</button>
                </td>
            `);
            $("#itemTable tbody").append(row);
        }

        let rowCounter = 0;

        // Add Row add to Stock
        function addStockRow(data = {}) {
            rowCounter++;
            const rowId = 'row_' + rowCounter;
            const row = $("<tr></tr>").attr("id", rowId);

            row.append(`
                <td>
                    <select class="form-select partSelect" name="addPartNumber" data-row-id="${rowId}" required>
                        <option value="">Part Number</option>
                        <?php
                        $select_ccid = "SELECT id, part_name FROM tbl_inventory ORDER BY REGEXP_REPLACE(part_name, '[0-9]+$', ''), CAST(REGEXP_SUBSTR(part_name, '[0-9]+$') AS UNSIGNED)";
                        $select_ccid_query = mysqli_query($con, $select_ccid);
                        if (mysqli_num_rows($select_ccid_query) > 0) {
                            while ($ccid_row = mysqli_fetch_assoc($select_ccid_query)) {
                                ?>
                            <option value="<?= $ccid_row['part_name'] ?>" data-id="<?= $ccid_row['id'] ?>">
                                <?= $ccid_row['part_name'] ?>
                            </option>

                                <?php
                            }
                        }
                        ?>
                    </select>
                </td>
                <td><input type="text" class="form-control partDescription" name="addPartDesc" placeholder="Part Description" readonly></td>
                <td><input type="text" class="form-control" name="addBatchNumber" placeholder="Batch Number" autocomplete="OFF"></td>
                <td><input type="text" class="form-control" name="addLotID" placeholder="Lot ID" autocomplete="OFF"></td>
                <td><input type="text" class="form-control" name="addItemCode" placeholder="Item Code" autocomplete="OFF"></td>
                <td><input type="number" class="form-control" name="addPartQty" placeholder="Part Quantity" min="0" step="1"></td>
                <td>
                    <select class="form-select" name="addExpDateOption">
                        <option value="">Has Expiration Date?</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </td>
                <td><input type="text" class="form-control expDateInput" name="addExpDate" readonly disabled placeholder="Has Expiration Date?"></td>
                <td><input type="text" class="form-control" name="addKittingID" placeholder="Kitting ID" autocomplete="OFF"></td>
                <td><button class="btn btn-danger" onclick="this.closest('tr').remove()">Delete</button></td>
            `);

            $("#itemStockTable tbody").append(row);

            if (data.add_part_number) {
                const select = row.find('[name="addPartNumber"]');
                let matchFound = false;

                select.find('option').each(function () {
                    if ($(this).val().toLowerCase() === data.add_part_number.toLowerCase()) {
                        select.val($(this).val());
                        matchFound = true;
                        return false;
                    }
                });

                if (matchFound) {
                    select.trigger('change');
                }
            }

            if (data.add_batch_number) row.find('[name="addBatchNumber"]').val(data.add_batch_number);
            if (data.add_lot_id) row.find('[name="addLotID"]').val(data.add_lot_id);
            if (data.add_item_code) row.find('[name="addItemCode"]').val(data.add_item_code);
            if (data.add_quantity) row.find('[name="addPartQty"]').val(data.add_quantity);
            if (data.add_has_expiration_date) {
                const expDateOption = row.find('[name="addExpDateOption"]');
                expDateOption.val(data.add_has_expiration_date.toLowerCase());
                toggleExpDateInput(expDateOption[0]);
            }

            if (data.add_expiration_date) {
                const expDateInput = row.find('[name="addExpDate"]');
                expDateInput.val(data.add_expiration_date);
            }
            if (data.add_badge_id) row.find('[name="addKittingID"]').val(data.add_badge_id);
        }


        // Has Expiration Date?
        $(document).on('change', 'select[name="addExpDateOption"]', function () {
            toggleExpDateInput(this);
        });

        // Has Expiration Date? Function
        function toggleExpDateInput(select) {
            var row = $(select).closest('tr');
            var expInput = row.find('.expDateInput');

            if ($(select).val() === 'yes') {
                var today = new Date().toISOString().split('T')[0];
                expInput.prop('type', 'date');
                expInput.prop('readonly', false);
                expInput.prop('disabled', false);
                expInput.attr('min', today);
                expInput.val('');
            } else if ($(select).val() === 'no') {
                expInput.prop('type', 'text');
                expInput.val('NA');
                expInput.prop('readonly', true);
                expInput.prop('disabled', false);
                expInput.removeAttr('min');
            } else {
                expInput.val('');
                expInput.prop('type', 'text');
                expInput.prop('readonly', true);
                expInput.prop('disabled', true);
                expInput.removeAttr('min');
            }
        }


        // Fetch Material Description
        $(document).on('change', '.partSelect', function () {
            var partId = $(this).find('option:selected').data('id');
            var rowId = $(this).data('row-id');

            if (partId) {
                $.ajax({
                    url: '../../controller/fetch_part.php',
                    type: 'GET',
                    data: { part_id: partId },
                    success: function (response) {
                        var partDescriptionField = $('#' + rowId).find('.partDescription');

                        if (response.error) {
                            partDescriptionField.val(response.error);
                        } else {
                            if (response.part_desc) {
                                partDescriptionField.val(response.part_desc);
                            } else {
                                partDescriptionField.val('No description available');
                            }
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX Error: ' + status + ', ' + error);
                        $('#' + rowId).find('.partDescription').val('Error fetching data');
                    }
                });
            } else {
                $('#' + rowId).find('.partDescription').val('');
            }
        });

        // Add to Stock Button
        $('#addtoStockButton').on("click", function (e) {
            e.preventDefault();

            let data = [];
            let valid = true;

            $("#itemStockTable tbody tr").each(function () {
                let item = {};
                let validRow = true;

                $(this).find("input, select").each(function () {
                    const name = $(this).attr("name");
                    const value = $(this).val();

                    if (!value) {
                        valid = false;
                        $(this).addClass("is-invalid");
                    } else {
                        $(this).removeClass("is-invalid");
                    }

                    switch (name) {
                        case 'addPartNumber':
                            item['part_name'] = value;
                            break;
                        case 'addPartDesc':
                            item['part_desc'] = value;
                            break;
                        case 'addPartQty':
                            item['part_qty'] = value;
                            break;
                        case 'addBatchNumber':
                            item['batch_number'] = value;
                            break;
                        case 'addExpDate':
                            item['part_date'] = value;
                            break;
                        case 'addKittingID':
                            item['kitting_id'] = value;
                            break;
                        case 'addLotID':
                            item['lot_id'] = value;
                            break;
                        case 'addItemCode':
                            item['item_code'] = value;
                            break;
                    }
                });

                data.push(item);
            });

            if (!valid) {
                return Swal.fire('Error!', 'Missing Inputs', 'error');
            }

            if (data.length === 0) {
                return Swal.fire('Error!', 'No stock to submit.', 'error');
            }

            $.ajax({
                url: '../../controller/addtoStock.php',
                type: 'POST',
                data: { stock_data: JSON.stringify(data) },
                success: function (response) {
                    console.log("Server response:", response);
                    try {
                        let jsonResponse = JSON.parse(response);


                        if (jsonResponse.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: jsonResponse.message || 'Stocks added successfully!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: jsonResponse.error || 'There was an error processing your request.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    } catch (error) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong while processing your request.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            });
        });

        // Update Material Button
        $("#edit_material-btn").click(function () {
            $("#modalEditItemList").empty();

            let selectedItems = $(".select-row:checked");

            if (selectedItems.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No items selected',
                    text: 'Please select at least one material to update.',
                    confirmButtonText: 'Ok'
                });
                return;
            }

            selectedItems.each(function () {
                let id = $(this).data("id");
                let partName = $(this).data("part_name");
                let partDesc = $(this).data("part_desc");
                let partCategory = $(this).data("part_category");
                let partCostCenter = $(this).data("cost_center");
                let partType = $(this).data("part_option");
                let partLocation = $(this).data("location");
                let partInventReq = $(this).data("min_invent_req");
                let partUnit = $(this).data("unit");
                let partApprover = $(this).data("approver");

                let row = `
                    <tr class=" text-center" style="vertical-align: middle;">
                        <td style="display:none;">
                            <input type="text" class="form-control" name="ids[]" required value="${id}">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="partnumbers[]" required value="${partName}" autocomplete="off">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="partdescs[]" required value="${partDesc}">
                        </td>
                        <td>
                            <select class="form-select" name="partypes[]" required>
                                <option value="" ${!partType ? 'selected' : ''}>Material Type</option>
                                <option value="Direct" ${partType === 'Direct' ? 'selected' : ''}>Direct</option>
                                <option value="Indirect" ${partType === 'Indirect' ? 'selected' : ''}>Indirect</option>
                            </select>
                        </td>
                        <td> 
                            <select class="form-select" name="partcategories[]" required>
                                <option value="" ${!partCategory ? 'selected' : ''}>Material Category</option>
                                <option value="Critical" ${partCategory === 'Critical' ? 'selected' : ''}>Critical</option>
                                <option value="Non-critical" ${partCategory === 'Non-critical' ? 'selected' : ''}>Non-critical</option>
                                <option value="General Supply Material" ${partCategory === 'General Supply Material' ? 'selected' : ''}>General Supply Material</option>
                            </select>
                        </td>
                        <td>
                            <select name="costcenters[]" class="form-select w-100" required>  
                                <option value="" ${!partCostCenter ? 'selected' : ''}>Cost Center</option>
                                <?php
                                $select_ccid = "SELECT * FROM tbl_ccs";
                                $select_ccid_query = mysqli_query($con, $select_ccid);
                                if (mysqli_num_rows($select_ccid_query) > 0) {
                                    while ($ccid_row = mysqli_fetch_assoc($select_ccid_query)) {
                                        ?>
                                        <option value="<?php echo $ccid_row['ccid'] ?>"
                                            data-id="<?php echo $ccid_row['id'] ?>"
                                            ${partCostCenter === '<?php echo $ccid_row['ccid'] ?>' ? 'selected' : ''}>
                                            <?php echo $ccid_row['ccid'] ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="locations[]" required value="${partLocation}">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="inventreqs[]" required value="${partInventReq}">
                        </td>
                        <td>
                            <select class="form-select" name="units[]" required>
                            <option value="" ${!partUnit ? 'selected' : ''}>Unit</option>
                                <?php
                                $select_unit = "SELECT * FROM tbl_unit";
                                $select_unit_query = mysqli_query($con, $select_unit);
                                if (mysqli_num_rows($select_unit_query) > 0) {
                                    while ($unit_row = mysqli_fetch_assoc($select_unit_query)) {
                                        ?>
                                        <option value="<?php echo $unit_row['unit'] ?>"
                                            data-id="<?php echo $unit_row['id'] ?>"
                                            ${partUnit === '<?php echo $unit_row['unit'] ?>' ? 'selected' : ''}>
                                            <?php echo strtoupper($unit_row['unit']) ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                        <td> 
                            <select class="form-select" name="approvers[]" required>
                                <option value="" ${!partApprover ? 'selected' : ''}>Select Approver</option>
                                <option value="Supervisor" ${partApprover === 'Supervisor' ? 'selected' : ''}>Supervisor</option>
                                <option value="Kitting" ${partApprover === 'Kitting' ? 'selected' : ''}>Kitting</option>
                            </select>

                        </td>
                    </tr>
                `;
                $("#modalEditItemList").append(row);
            });

            $("#editMaterialModal").modal("show");
        });

        // Update Material Submit
        $("#updateForm").submit(function (e) {
            e.preventDefault();

            let formData = $(this).serialize();

            formData += "&update_submit=1";

            $.ajax({
                url: '../../controller/inventory.php',
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Material Updated',
                            text: 'Materials have been updated successfully.',
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
                }
            });
        });

        // Delete Material Button
        $("#delete_material-btn").click(function () {
            $("#modalDeleteItemList").empty();

            let selectedItems = $(".select-row:checked");

            if (selectedItems.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No items selected',
                    text: 'Please select at least one material to delete.',
                    confirmButtonText: 'Ok'
                });
                return;
            }

            selectedItems.each(function () {
                let id = $(this).data("id");
                let partName = $(this).data("part_name");
                let partDesc = $(this).data("part_desc");
                let partCategory = $(this).data("part_category");
                let partCostCenter = $(this).data("cost_center");
                let partType = $(this).data("part_option");
                let partLocation = $(this).data("location");
                let partInventReq = $(this).data("min_invent_req");
                let partUnit = $(this).data("unit");
                let partApprover = $(this).data("approver");
                let item_code = $(this).data("item_code");

                let row = `
            <tr class=" text-center" style="vertical-align: middle;">
                <td>${partName}</td>
                <td>${partDesc}</td>
                <td>${partCategory}</td>
                <td>${partCostCenter}</td>
                <td>${partType}</td>
                <td>
                <input type="hidden" name="item_codes[]" class="form-control" value="${item_code}" autocomplete="off">
                    <input type="hidden" name="ids[]" value="${id}">
                    <input type="hidden" name="part_names[]" value="${partName}">
                    <input type="text" name="reasons[]" class="form-control" placeholder="Reason for deletion" autocomplete="off">
                </td>
            </tr>
        `;
                $("#modalDeleteItemList").append(row);
            });

            $("#deleteModal").modal("show");
        });

        // Delete Material Submit
        $("#deleteForm").submit(function (e) {
            e.preventDefault();

            let formData = $(this).serialize();
            formData += "&delete_submit=1";

            $.ajax({
                url: '../../controller/inventory.php',
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Materials Deletion!',
                            text: 'Materials have been deleted successfully.',
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