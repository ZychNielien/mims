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
                    </tr>
                </thead>

                <tbody id="data-table-inventory">
                </tbody>

            </table>


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
                    <div class="mb-2 d-flex flex-wrap gap-3 align-items-stretch justify-content-start">
                        <button class="btn btn-success" id="btnAddStockRow">Add Row</button>
                    </div>
                    <div class="table-responsive overflow-x-auto">
                        <table class=" table table-bordered table-striped text-center" id="itemStockTable">
                            <thead>
                                <tr class="text-center"
                                    style="background-color: #900008; color: white; vertical-align: middle;">
                                    <th>Part Number</th>
                                    <th>Part Description</th>
                                    <th>Quantity</th>
                                    <th>Batch Number</th>
                                    <th>Has Expiration Date?</th>
                                    <th>Expiration Date</th>
                                    <th>Kitting ID</th>
                                    <th>Lot ID</th>
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
</body>

<script>

    $(document).ready(function () {

        $('#select-all').on('change', function () {
            $('.select-row').prop('checked', $(this).prop('checked'));
        });

        var today = new Date().toISOString().split('T')[0];
        $('#exp_date').attr('min', today);

        // Minimum value of Minimum Requirement should equal to 1
        $('#new_min_invent_req').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        }).on('blur', function () {
            if (this.value === '' || parseInt(this.value, 10) < 1) {
                this.value = 1;
            }
        });

        // EXPORT BUTTON
        $('#export-btn').click(function () {
            var visibleRows = $('#data-table-inventory .table-row');
            var filteredRows = [];

            visibleRows.each(function () {
                if ($(this).css('display') !== 'none') {
                    filteredRows.push(this);
                }
            });

            var table = $('<table></table>');
            var headerRow = $('#data-table thead').clone(true);
            var ths = headerRow.find('th');
            ths.first().remove();
            table.append(headerRow);

            $(filteredRows).each(function () {
                var newRow = $(this).clone(true);
                var tds = newRow.find('td');
                tds.first().remove();
                table.append(newRow);
            });

            var wb = XLSX.utils.table_to_book(table[0], { sheet: "Filtered Data" });
            XLSX.writeFile(wb, "Inventory.xlsx");
        });

        $('#search_inventory').on('input', function () {
            var searchTerm = $(this).val().toLowerCase();
            $('#data-table-inventory tr').each(function () {
                var firstTdText = $(this).find('td:first').text().toLowerCase();
                if (firstTdText.indexOf(searchTerm) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        });

        function updateTable(data) {
            let checkedItems = {};
            $('#data-table-inventory input[type="checkbox"]:checked').each(function () {
                const partName = $(this).closest('tr').find('td[data-label="Part Name"]').text().trim();
                checkedItems[partName] = true;
            });

            $('#data-table-inventory').empty();

            if (data.length === 0) {
                var noDataRow = `
                    <tr>
                        <td colspan="7" class="text-center">No parts found</td>
                    </tr>
                `;
                $('#data-table-inventory').append(noDataRow);
            } else {
                $.each(data, function (index, item) {
                    var rowClass = '';
                    var totalPartQty = parseFloat(item.total_part_qty);
                    var minInventReq = parseFloat(item.min_invent_req);

                    if (totalPartQty === 0) {
                        rowClass = 'text-danger fw-bold';
                    } else if (minInventReq > 0 && totalPartQty < minInventReq) {
                        rowClass = 'text-warning';
                    }

                    const isChecked = checkedItems[item.part_name] ? 'checked' : '';


                    var row = `
                        <tr class="table-row text-center" style="vertical-align: middle;" data-part-qty="${item.part_qty}" data-min-invent-req="${item.min_invent_req}">

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
                                ${isChecked}>
                            </td>
                            <td data-label="Part Name" class="${rowClass}">${item.part_name}</td>
                            <td data-label="Part Desc" class="${rowClass}">${item.part_desc}</td>
                            <td data-label="Min Invent Req" class="${rowClass}">${item.min_invent_req} ${item.unit}(s)</td>
                            <td data-label="Exp Date" class="${rowClass}">${item.least_exp_date}</td>
                            <td data-label="Part Qty" class="${rowClass}">${item.total_part_qty} ${item.unit}(s)</td>
                        </tr>
                    `;

                    $('#data-table-inventory').append(row);
                });
            }
        }

        if (!!window.EventSource) {
            const source = new EventSource('../../controller/check_inventory.php');

            source.onmessage = function (event) {
                const data = JSON.parse(event.data);
                updateTable(data);
            };

            source.onerror = function (err) {
                console.error("SSE connection error:", err);
            };
        } else {
            console.warn("SSE not supported — fallback to polling");
        }

        $('#uploadBox').on('click', function () {
            $('#excelFile').click();
        });

        $('#uploadBox').on('dragover', function (e) {
            e.preventDefault();
            $(this).addClass('border-primary');
        });

        $('#uploadBox').on('dragleave', function (e) {
            $(this).removeClass('border-primary');
        });

        $('#uploadBox').on('drop', function (e) {
            e.preventDefault();
            $(this).removeClass('border-primary');

            const files = e.originalEvent.dataTransfer.files;
            if (files.length > 0) {
                $('#fileNameText').text(files[0].name);
                $('#uploadText').text('✅ File Ready');
                $('#excelFile').prop('files', files);
            }
        });

        $('#excelFile').on('change', function () {
            const file = this.files[0];
            if (file) {
                $('#fileNameText').text(file.name);
                $('#uploadText').text('✅ File Ready');
            } else {
                $('#fileNameText').text('No file selected');
                $('#uploadText').text('📁 Drag or Upload File');
            }
        });

        $("#btnAddRow").on("click", function () {
            addRow();
        });

        $("#btnAddStockRow").on("click", function () {
            addStockRow();
        });

        $("#btnUpload").on("click", function () {
            const fileInput = $("#excelFile");
            const file = $("#excelFile")[0].files[0];

            if (!file) {
                fileInput.addClass('input-error');
                $('#fileError').show();
                $('#fileNameText').hide();
                return;
            } else {
                fileInput.removeClass('input-error');
                $('#fileError').hide();
                $('#fileNameText').text('File selected: ' + file.name).show();
            }
            const reader = new FileReader();
            reader.onload = function (e) {
                const data = new Uint8Array(e.target.result);
                const workbook = XLSX.read(data, { type: "array" });
                const rows = XLSX.utils.sheet_to_json(workbook.Sheets[workbook.SheetNames[0]], { header: 1 }).slice(1);
                rows.forEach(row => addRow({
                    new_part_number: row[0],
                    new_part_desc: row[1],
                    new_option: row[2],
                    new_cost_center: row[3],
                    new_location: row[4],
                    new_min_invent_req: parseInt(row[5]) || 0,
                    new_unit: row[6]
                }));
            };
            reader.readAsArrayBuffer(file);
        });



        // Submit Material Registration
        $("#btnSubmit").on("click", function (e) {
            e.preventDefault();

            let data = [];
            let valid = true;

            $("#itemTable tbody tr").each(function () {
                let item = {};

                $(this).find("input").each(function () {
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

        function addStockRow() {
            rowCounter++;
            const rowId = 'row_' + rowCounter;
            const row = $("<tr></tr>").attr("id", rowId);

            row.append(`
                <td>
                    <select class="form-select partSelect" name="addPartNumber" data-row-id="${rowId}" required>
                        <option value="">Part Number</option> 
                        <?php
                        $select_ccid = "SELECT id, part_name FROM tbl_inventory";
                        $select_ccid_query = mysqli_query($con, $select_ccid);
                        if (mysqli_num_rows($select_ccid_query) > 0) {
                            while ($ccid_row = mysqli_fetch_assoc($select_ccid_query)) {
                                ?>
                                <option value="<?php echo $ccid_row['part_name'] ?>" data-id="<?php echo $ccid_row['id'] ?>">
                                    <?php echo $ccid_row['part_name'] ?>
                                </option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control partDescription" name="addPartDesc" placeholder="Part Description" readonly>
                </td>
                <td>
                    <input type="number" class="form-control" name="addPartQty" placeholder="Part Quantity" min="0" step="1" >
                </td>
                <td>
                    <input type="text" class="form-control" name="addBatchNumber" placeholder="Batch Number">
                </td>
                <td>
                    <select class="form-select" name="addExpDateOption">
                        <option value="">Has Expiration Date?</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </td>
                <td>
                     <input type="text" class="form-control expDateInput" name="addExpDate" placeholder="Expiration Date" readonly disabled>
                </td>
                </td>
                <td>
                    <input type="text" class="form-control" name="addKittingID" placeholder="Kitting ID" >
                </td>
                <td>
                    <input type="text" class="form-control" name="addLotID" placeholder="Lot ID" >
                </td>
                <td>
                    <button class="btn btn-danger" onclick="this.closest('tr').remove()">Delete</button>
                </td>
            `);

            $("#itemStockTable tbody").append(row);
        }

        $(document).on('change', 'select[name="addExpDateOption"]', function () {
            toggleExpDateInput(this);
        });

        function toggleExpDateInput(select) {
            var row = $(select).closest('tr');
            var expInput = row.find('.expDateInput');

            if ($(select).val() === 'yes') {
                expInput.prop('type', 'date');
                expInput.prop('readonly', false);
                expInput.prop('disabled', false);
                expInput.val('');
            } else if ($(select).val() === 'no') {
                expInput.prop('type', 'text');
                expInput.val('NA');
                expInput.prop('readonly', true);
                expInput.prop('disabled', false);
            } else {
                expInput.val('');
                expInput.prop('type', 'text');
                expInput.prop('readonly', true);
                expInput.prop('disabled', true);
            }
        }

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
                            <input type="text" class="form-control" name="partnumbers[]" required value="${partName}" readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="partdescs[]" required value="${partDesc}">
                        </td>
                        <td>
                            <select class="form-select" name="partypes[]" required>
                                <option value="${!partType ? 'selected' : ''}">Select Approver</option>
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
                                <option value="${!partCostCenter ? 'selected' : ''}">Cost Center</option>
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


        $("#delete_material-btn").click(function () {
            $("#modalRejectItemList").empty();

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

                let row = `
            <tr class=" text-center" style="vertical-align: middle;">
                <td>${partName}</td>
                <td>${partDesc}</td>
                <td>${partCategory}</td>
                <td>${partCostCenter}</td>
                <td>${partType}</td>
                <td>
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