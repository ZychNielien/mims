<?php

// Database Connection
include "../../model/dbconnection.php";

// Navigation Bar
include "navBar.php";

?>

<head>

    <!-- Title -->
    <title>Material Inventory</title>

    <!-- Table Style -->
    <link rel="stylesheet" href="../../public/css/table.css">

    <!-- Sweetalert Style -->
    <link rel="stylesheet" href="../../public/css/sweetalert.min.css">

    <!-- Sweetalert Script -->
    <script src="../../public/js/sweetalert2@11.js"></script>

    <!-- Jquery Script -->
    <script src="../../public/js/jquery.js"></script>

    <!-- Excel Script -->
    <script src="../../public/js/excel.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

</head>

<body data-user="<?php echo $_SESSION['user']; ?>">

    <section class="w-100" style="max-height: 90%;">

        <!-- Main Container -->
        <div class="mx-5 hatian d-flex flex-column justify-content-center align-center ">

            <!-- Title Div -->
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


            <!-- Inventory Table -->
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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addToStockModalLabel">Add to Stock</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../../controller/inventory.php">
                        <?php
                        $query = "SELECT id, part_name FROM tbl_inventory ORDER BY part_name ASC";
                        $result = mysqli_query($con, $query);
                        ?>

                        <div class="mb-3">
                            <label for="add_partSelect" class="form-label">Part Number</label>
                            <select class="form-select" id="add_partSelect" name="part_name">
                                <option value="">Select a Part</option>
                                <?php
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $row['part_name'] . '"  data-id="' . $row['id'] . '">' . htmlspecialchars($row['part_name']) . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No parts available</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div id="itemDetails" style="display: none;">
                            <div class="mb-1">
                                <label for="exampleTextarea" class="form-label">Item Description</label>
                                <textarea class="form-control" id="exampleTextarea" rows="2" name="part_desc"
                                    readonly></textarea>
                            </div>
                            <div class="mb-1">
                                <label for="part_qty" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="part_qty" name="part_qty" min="0"
                                    placeholder="Enter Quantity" required>
                            </div>
                            <div class="mb-1">
                                <label for="exp_date" class="form-label">Expiration Date</label>
                                <input type="date" class="form-control" id="exp_date" name="exp_date" required>
                            </div>
                            <div class="mb-1">
                                <label for="kitting_id" class="form-label">Kitting ID</label>
                                <input type="text" class="form-control" id="kitting_id" name="kitting_id"
                                    placeholder="Enter Kitting ID" autocomplete="off" required>
                            </div>
                            <div class="mb-1">
                                <label for="lot_id" class="form-label">Lot ID</label>
                                <input type="text" class="form-control" id="lot_id" name="lot_id"
                                    placeholder="Enter Lot ID" autocomplete="off" required>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary" name="update_part_qty">Submit</button>

                    </form>
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
                </div>
                <div class="modal-body">

                    <!-- Excel File Upload Input -->
                    <div class="mb-4 d-flex flex-wrap gap-3 align-items-stretch justify-content-evenly">

                        <!-- Excel File Upload Input -->
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

                        <!-- Upload Button -->
                        <div class="d-flex flex-column justify-content-end" style="min-width: 200px;">
                            <button class="btn btn-primary" id="btnUpload">Upload File</button>
                        </div>

                        <!-- Add Row Button -->
                        <div class="d-flex flex-column justify-content-end" style="min-width: 200px;">
                            <button class="btn btn-success" id="btnAddRow">Add Row</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm text-center" id="itemTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Part Number</th>
                                    <th>Part Description</th>
                                    <th>Option</th>
                                    <th>Cost Center</th>
                                    <th>Location</th>
                                    <th>Min Inventory</th>
                                    <th>Unit of Measure</th>
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

        // SHOW HIDDEN INPUTS IN ADD TO STOCK MODAL
        $(document).on('change', '#add_partSelect', function () {
            var partId = $(this).find('option:selected').data('id');

            if (partId) {
                $.ajax({
                    url: '../../controller/fetch_part_desc.php',
                    type: 'GET',
                    data: { part_id: partId },
                    success: function (response) {

                        if (response.error) {
                            $('#exampleTextarea').val(response.error);
                            $('#itemDetails').hide();
                        } else {
                            if (response.part_desc) {
                                $('#itemDetails').show();
                                $('#exampleTextarea').val(response.part_desc);
                            } else {
                                $('#exampleTextarea').val('No description available');
                            }
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX Error: ' + status + ', ' + error);
                        $('#exampleTextarea').val('Error fetching data');
                    }
                });
            } else {
                $('#itemDetails').hide();
                $('#exampleTextarea').val('');
            }
        });

        // EXPORT BUTTON
        $('#export-btn').click(function () {
            var visibleRows = $('#data-table .table-row');
            var filteredRows = [];

            visibleRows.each(function () {
                if ($(this).css('display') !== 'none') {
                    filteredRows.push(this);
                }
            });

            var table = $('<table></table>');
            var headerRow = $('table thead').clone(true);
            var ths = headerRow.find('th');
            ths.first().remove();
            ths.last().remove();
            table.append(headerRow);

            $(filteredRows).each(function () {
                var newRow = $(this).clone(true);
                var tds = newRow.find('td');
                tds.first().remove();
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
        setInterval(fetchInventoryData, 10000);

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


        // Trigger file input on box click
        $('#uploadBox').on('click', function () {
            $('#excelFile').click();
        });

        // Handle drag over
        $('#uploadBox').on('dragover', function (e) {
            e.preventDefault();
            $(this).addClass('border-primary');
        });

        // Handle drag leave
        $('#uploadBox').on('dragleave', function (e) {
            $(this).removeClass('border-primary');
        });

        // Handle file drop
        $('#uploadBox').on('drop', function (e) {
            e.preventDefault();
            $(this).removeClass('border-primary');

            const files = e.originalEvent.dataTransfer.files;
            if (files.length > 0) {
                // Manually handle file display, can't assign .files directly
                $('#fileNameText').text(files[0].name);
                $('#uploadText').text('✅ File Ready');

                // To process it, you may store the file in a variable
                // Or trigger a custom event with the dropped file
                // OR if you need to *upload* it directly:
                $('#excelFile').prop('files', files); // Only works in some browsers
            }
        });

        // Handle file input change
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


        // Upload Excel File
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

        // Submit Button
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

            if (data.length === 0) return Swal.fire('No data to submit.');

            $.ajax({
                url: "../submit.php",
                method: "POST",
                contentType: "application/json",
                data: JSON.stringify({ items: data }),
                success: res => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: res.message || "Submitted successfully."
                    });
                    location.reload();
                },
                error: err => Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred.'
                })
            });
        });

        function addRow(data = {}) {
            const row = $("<tr></tr>");
            row.append(`
                <td><input type="text" name="new_part_number" class="form-control form-control-sm" value="${data.new_part_number || ''}" placeholder="Part Number" autocomplete="off" required></td>
                <td><input type="text" name="new_part_desc" class="form-control form-control-sm" value="${data.new_part_desc || ''}" placeholder="Part Description" autocomplete="off" required></td>
                <td><select name="new_option" class="form-select form-select-sm" required><option>Option 1</option><option>Option 2</option><option>Option 3</option></select></td>
                <td><select name="new_cost_center" class="form-select form-select-sm" required><option>Cost Center 1</option><option>Cost Center 2</option><option>Cost Center 3</option></select></td>
                <td><input type="text" name="new_location" class="form-control form-control-sm" value="${data.new_location || ''}" placeholder="Location" autocomplete="off" required></td>
                <td><input type="number" name="new_min_invent_req" class="form-control form-control-sm" value="${data.new_min_invent_req || ''}" placeholder="Min. Inventory Requirement" autocomplete="off" required></td>
                <td><input type="text" name="new_unit" class="form-control form-control-sm" value="${data.new_unit || ''}" required></td>
                <td><button class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">Delete</button></td>
            `);
            $("#itemTable tbody").append(row);
        }

    });

</script>