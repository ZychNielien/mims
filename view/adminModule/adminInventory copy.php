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

                <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal"
                    data-bs-target="#addToStockModal">Add to Stock</button>

                <button id="export-btn" class="btn btn-success my-1">Export to Excel</button>
            </div>

            <table class="table table-striped" id="data-table" data-username="<?php echo $_SESSION['user']; ?>">

                <thead>
                    <tr class="text-center" style="background-color: #900008; color: white; vertical-align: middle;">
                        <th>Part Number</th>
                        <th>Part Description</th>
                        <th>Minimum Inventory Requirement</th>
                        <th>Earliest Expiration Date</th>
                        <th>Existing Inventory</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody id="data-table-inventory">
                </tbody>

            </table>


        </div>

    </section>

    <!-- Edit Part Modal -->
    <div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Part</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" action="../../controller/inventory.php">
                        <input type="hidden" id="part_id" name="id">
                        <div class="form-group my-1">
                            <label for="part_name">Part Name</label>
                            <input type="text" class="form-control" id="part_name" name="part_name" required
                                placeholder="Enter Part Number">
                        </div>
                        <div class="form-group my-1">
                            <label for="part_desc">Item Description</label>
                            <textarea class="form-control" id="part_desc" name="part_desc" rows="3" required
                                placeholder="Enter Part Description"></textarea>
                        </div>
                        <div class="mb-1">
                            <label for="part_option" class="form-label">Option</label>
                            <select class="form-select" id="part_option" name="part_option" required>
                                <option selected value="">Select Option</option>
                                <option value="Direct">Direct</option>
                                <option value="Indirect">Indirect</option>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="part_cost_center" class="form-label">Cost Center</label>
                            <select class="form-select" id="part_cost_center" name="cost_center" required>
                                <option selected value="">Select Cost Center</option>
                                <?php
                                $select_ccid = "SELECT * FROM tbl_ccs";
                                $select_ccid_query = mysqli_query($con, $select_ccid);

                                if (mysqli_num_rows($select_ccid_query) > 0) {
                                    while ($ccid_row = mysqli_fetch_assoc($select_ccid_query)) {
                                        ?>
                                        <option value="<?php echo $ccid_row['ccid'] ?>" data-id="<?php echo $ccid_row['id'] ?>">
                                            <?php echo $ccid_row['ccid'] ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label for="part_location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="part_location" name="location"
                                placeholder="Enter Location">
                        </div>
                        <div class="mb-1">
                            <label for="part_min_invent_req" class="form-label">Minimum Inventory
                                Requirement</label>
                            <input type="number" class="form-control" id="part_min_invent_req" name="min_invent_req"
                                placeholder="Enter Minimum Inventory Requirement">
                        </div>
                        <div class="mb-1">
                            <label for="part_unit" class="form-label">Unit of Measure</label>
                            <select class="form-select" id="part_unit" name="unit" required>
                                <option selected value="">Select Unit</option>
                                <?php
                                $select_unit = "SELECT * FROM tbl_unit";
                                $select_unit_query = mysqli_query($con, $select_unit);

                                if (mysqli_num_rows($select_unit_query) > 0) {
                                    while ($unit_row = mysqli_fetch_assoc($select_unit_query)) {
                                        ?>
                                        <option value="<?php echo $unit_row['unit']; ?>"
                                            data-id="<?php echo $unit_row['id'] ?>">
                                            <?php echo strtoupper($unit_row['unit']); ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="update_namedesc" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add to Stock Modal -->
    <div class="modal fade" id="addToStockModal" tabindex="-1" aria-labelledby="addToStockModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " style="max-width: 1500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addToStockModalLabel">Add to Stock</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2 d-flex flex-wrap gap-3 align-items-stretch justify-content-start">
                        <button class="btn btn-success" id="btnAddStockRow">Add Row</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm text-center" id="itemStockTable">
                            <thead>
                                <tr class="text-center"
                                    style="background-color: #900008; color: white; vertical-align: middle;">
                                    <th>Part Number</th>
                                    <th>Part Description</th>
                                    <th>Quantity</th>
                                    <th>Batch Number</th>
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
        <div class="modal-dialog modal-dialog-centered" style="max-width: 1500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="materialRegistrationModalLabel">Material Registration</h5>
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

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm text-center" id="itemTable">
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

</body>

<script>

    $(document).ready(function () {



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

        // EDIT BUTTON FOR PART NUMBER
        $('.edit-btn').on('click', function () {
            const partId = $(this).data('id');
            const partName = $(this).data('name');
            const partDesc = $(this).data('desc');
            const partcost_center = $(this).data('cost_center');
            const partlocation = $(this).data('location');
            const partmin_invent_req = $(this).data('min_invent_req');
            const partunit = $(this).data('unit');
            const partOption = $(this).data('part_option');

            $('#part_id').val(partId);
            $('#part_name').val(partName);
            $('#part_desc').val(partDesc);
            $('#part_cost_center').val(partcost_center);
            $('#part_location').val(partlocation);
            $('#part_min_invent_req').val(partmin_invent_req);
            $('#part_unit').val(partunit);
            $('#part_option').val(partOption);

            $('#editModal').modal('show');
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
            ths.last().remove();
            table.append(headerRow);

            $(filteredRows).each(function () {
                var newRow = $(this).clone(true);
                var tds = newRow.find('td');
                tds.last().remove();
                table.append(newRow);
            });

            var wb = XLSX.utils.table_to_book(table[0], { sheet: "Filtered Data" });
            XLSX.writeFile(wb, "Inventory.xlsx");
        });

        // Edit Material Button
        $('#data-table-inventory').on('click', '.edit-btn', function () {
            const partId = $(this).data('id');
            const partName = $(this).data('name');
            const partDesc = $(this).data('desc');
            const partcost_center = $(this).data('cost_center');
            const partlocation = $(this).data('location');
            const partmin_invent_req = $(this).data('min_invent_req');
            const partunit = $(this).data('unit');
            const partOption = $(this).data('part_option');

            $('#part_id').val(partId);
            $('#part_name').val(partName);
            $('#part_desc').val(partDesc);
            $('#part_cost_center').val(partcost_center);
            $('#part_location').val(partlocation);
            $('#part_min_invent_req').val(partmin_invent_req);
            $('#part_unit').val(partunit);
            $('#part_option').val(partOption);
            $('#editModal').modal('show');
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

        // Table Body for Material Table
        function updateTable(data) {
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

                    var row = `
                <tr class="table-row text-center" style="vertical-align: middle;" data-part-qty="${item.part_qty}" data-min-invent-req="${item.min_invent_req}">
                    <td data-label="Part Name" class="${rowClass}">${item.part_name}</td>
                    <td data-label="Part Desc" class="${rowClass}">${item.part_desc}</td>
                    <td data-label="Min Invent Req" class="${rowClass}">${item.min_invent_req} ${item.unit}(s)</td>
                    <td data-label="Exp Date" class="${rowClass}">${item.least_exp_date}</td>
                    <td data-label="Part Qty" class="${rowClass}">${item.total_part_qty}  ${item.unit}(s)</td>
                    <td data-label="Action">
                        <div class="d-flex justify-content-end gap-2">
                            <a class="btn btn-primary edit-btn" 
                            data-id="${item.id}" 
                            data-name="${item.part_name}"
                            data-desc="${item.part_desc}" 
                            data-cost_center="${item.cost_center}"
                            data-part_option="${item.part_option}" 
                            data-location="${item.location}"
                            data-min_invent_req="${item.min_invent_req}" 
                            data-unit="${item.unit}">Edit</a>
                            <?php if ($_SESSION['user'] !== 'Kitting'): ?>
                                <a class="btn btn-danger delete-btn" 
                                data-id="${item.id}" 
                                data-name="${item.part_name}">Delete</a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            `;

                    $('#data-table-inventory').append(row);
                });
            }
        }

        // AJAX Live Table
        function fetchInventoryData() {
            $.ajax({
                url: '../../controller/check_inventory.php',
                method: 'GET',
                dataType: 'json',
                success: function (response) {

                    if (response && Array.isArray(response)) {
                        updateTable(response);
                    } else {
                        console.error('Invalid response format:', response);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', error);
                    console.log('Response:', xhr.responseText);
                }
            });
        }

        fetchInventoryData();
        setInterval(fetchInventoryData, 5000);

        $(document).on('click', '.delete-btn', function () {
            var partId = $(this).data('id');
            var partName = $(this).data('name');

            Swal.fire({
                title: `Are you sure you want to delete "${partName}"?`,
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '../../controller/inventory.php',
                        method: 'POST',
                        data: { id: partId },
                        success: function (response) {

                            try {
                                response = JSON.parse(response);
                            } catch (e) {
                                console.error('Error parsing response:', e);
                            }

                            if (response.success) {

                                Swal.fire(
                                    'Deleted!',
                                    `${partName} has been deleted.`,
                                    'success'
                                ).then(() => {
                                    $(`[data-id="${partId}"]`).closest('tr').remove();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    response.message || 'There was an issue deleting the part. Please try again.',
                                    'error'
                                );
                            }
                        },
                        error: function () {
                            Swal.fire(
                                'Error!',
                                'An error occurred while processing your request.',
                                'error'
                            );
                        }
                    });
                }
            });
        });

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

        $("#btnSubmit").on("click", function (e) {
            e.preventDefault();
            let data = [];
            let valid = true;
            $("#itemTable tbody tr").each(function () {
                let item = {};
                $(this).find("input, select").each(function () {
                    item[$(this).attr("name")] = $(this).val();
                    if (!$(this).val()) {
                        valid = false;
                        $(this).addClass("is-invalid");
                    } else {
                        $(this).removeClass("is-invalid");
                    }
                });
                data.push(item);
            });

            if (!valid) return;

            if (data.length === 0) return Swal.fire(
                'Error!',
                'No data to submit.',
                'error'


            );

            $.ajax({
                url: "../submit.php",
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify({ items: data }),
                success: res => {
                    if (res.duplicates) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Duplicate Part Number(s)',
                            text: `The following already exist: ${res.duplicates.join(", ")}`
                        });
                    } else if (res.message === "Data inserted successfully") {
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
                        <option value="" ${!data.new_option ? 'selected' : ''}>Material Type</option>
                        <option value="Direct" ${data.new_option === 'Direct' ? 'selected' : ''}>Direct</option>
                        <option value="Indirect" ${data.new_option === 'Indirect' ? 'selected' : ''}>Indirect</option>
                    </select>
                </td>
                <td>
                    <select name="new_category" class="form-select" required>                                            
                        <option value="" ${!data.new_category ? 'selected' : ''}>Material Category</option>
                        <option value="Critical" ${data.new_category === 'Critical' ? 'selected' : ''}>Critical</option>
                        <option value="Non-critical" ${data.new_category === 'Non-critical' ? 'selected' : ''}>Non-critical</option>
                        <option value="General Supply Material" ${data.new_category === 'General Supply Material' ? 'selected' : ''}>General Supply Material</option>
                    </select>
                </td>
                <td>
                    <select name="new_cost_center" class="form-select" required>  
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
                                <option value="<?php echo $ccid_row['part_name'] ?>"
                                data-id="<?php echo $ccid_row['id'] ?>">
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
                    <input type="number" class="form-control" name="addPartQty" placeholder="Part Quantity" min="0" step="1">
                </td>
                <td>
                    <input type="text" class="form-control" name="addBatchNumber" placeholder="Batch Number">
                </td>
                <td>
                    <input type="date" class="form-control" name="addExpDate">
                </td>
                <td>
                    <input type="text" class="form-control" name="addKittingID" placeholder="Kitting ID" >
                </td>
                <td>
                    <input type="text" class="form-control" name="addLotID" placeholder="Lot ID">
                </td>
                <td>
                    <button class="btn btn-danger" onclick="this.closest('tr').remove()">Delete</button>
                </td>
            `);
            $("#itemStockTable tbody").append(row);
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

        $('#addtoStockButton').click(function () {
            let data = [];
            $("#itemStockTable tbody tr").each(function () {
                let row = $(this);
                let partName = row.find('select[name="addPartNumber"]').val();
                let partDesc = row.find('input[name="addPartDesc"]').val();
                let partQty = row.find('input[name="addPartQty"]').val();
                let batchNumber = row.find('input[name="addBatchNumber"]').val();
                let partDate = row.find('input[name="addExpDate"]').val();
                let kittingId = row.find('input[name="addKittingID"]').val();
                let lotId = row.find('input[name="addLotID"]').val();

                data.push({
                    part_name: partName,
                    part_desc: partDesc,
                    part_qty: partQty,
                    batch_number: batchNumber,
                    part_date: partDate,
                    kitting_id: kittingId,
                    lot_id: lotId
                });
            });

            if (data.length > 0) {
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
                                    text: jsonResponse.message || 'Data submitted successfully!',
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
                    },

                });
            } else {
                Swal.fire({
                    title: 'Warning!',
                    text: 'No rows to submit.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
            }
        });


    });

</script>