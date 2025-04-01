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

</head>

<body data-user="<?php echo $_SESSION['user']; ?>">

    <section class="w-100" style="max-height: 90%;">

        <!-- Main Container -->
        <div class="container hatian d-flex flex-column justify-content-center align-center w-100">

            <!-- Title Div -->
            <h2 class="text-center" style="color: #900008; font-weight: bold;">Inventory of Parts
            </h2>

            <!-- Delete Material Dorm Form -->
            <form id="deleteAll">

                <div class="container px-3 my-3 d-flex flex-wrap justify-content-between align-items-center">
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
                        <tr class="text-center"
                            style="background-color: #900008; color: white; vertical-align: middle;">
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

            </form>

        </div>

        <!-- Edit Part Modal -->
        <div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
            aria-hidden="true">
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
                                            <option value="<?php echo $ccid_row['ccid'] ?>"
                                                data-id="<?php echo $ccid_row['id'] ?>">
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
                            $query = "SELECT id, part_name FROM tbl_inventory";
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
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="materialRegistrationModalLabel">Material Registration</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="../../controller/inventory.php">
                            <div class="mb-1">
                                <label for="new_part_number" class="form-label">Part Number</label>
                                <input type="text" class="form-control" id="new_part_number" name="new_part_number"
                                    placeholder="Enter Part Number" autocomplete="off" required>
                            </div>
                            <div class="mb-1">
                                <label for="new_part_desc" class="form-label">Item Description</label>
                                <textarea class="form-control" id="new_part_desc" name="new_part_desc" rows="2"
                                    placeholder="Enter Part Description" required></textarea>
                            </div>
                            <div class="mb-1">
                                <label for="new_option" class="form-label">Option</label>
                                <select class="form-select" id="new_option" name="new_option" required>
                                    <option selected value="">Select Option</option>
                                    <option value="Direct">Direct</option>
                                    <option value="Indirect">Indirect</option>
                                </select>
                            </div>
                            <div class="mb-1">
                                <label for="new_cost_center" class="form-label">Cost Center</label>
                                <select class="form-select" id="new_cost_center" name="new_cost_center" required>
                                    <option selected value="">Select Cost Center</option>
                                    <?php
                                    $select_ccid = "SELECT * FROM tbl_ccs";
                                    $select_ccid_query = mysqli_query($con, $select_ccid);

                                    if (mysqli_num_rows($select_ccid_query) > 0) {
                                        while ($ccid_row = mysqli_fetch_assoc($select_ccid_query)) {
                                            ?>
                                            <option value="<?php echo $ccid_row['ccid'] ?>"
                                                data-id="<?php echo $ccid_row['id'] ?>">
                                                <?php echo $ccid_row['ccid'] ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-1">
                                <label for="new_location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="new_location" name="new_location"
                                    placeholder="Enter Location" autocomplete="off" required>
                            </div>
                            <div class="mb-1">
                                <label for="new_min_invent_req" class="form-label">Minimum Inventory
                                    Requirement</label>
                                <input type="text" class="form-control" id="new_min_invent_req"
                                    name="new_min_invent_req" placeholder="Enter Minimum Inventory Requirement" min="1"
                                    autocomplete="off" step="1" required>
                            </div>
                            <div class="mb-1">
                                <label for="new_unit" class="form-label">Unit of Measure</label>
                                <select class="form-select" id="new_unit" name="new_unit" required>
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
                        <button type="submit" class="btn btn-primary" name="submit_new_part">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>

</body>

<script>

    $(document).ready(function () {

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
        $('tbody').on('click', '.edit-btn', function () {
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
            $('tbody').empty();

            if (data.length === 0) {
                var noDataRow = `
            <tr>
                <td colspan="7" class="text-center">No parts found</td>
            </tr>
        `;
                $('tbody').append(noDataRow);
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

                    $('tbody').append(row);
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

            // SweetAlert confirmation
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
                    // Make the AJAX request to delete the part
                    $.ajax({
                        url: '../../controller/inventory.php', // The server-side script that handles the deletion
                        method: 'POST',
                        data: { id: partId },
                        success: function (response) {
                            console.log(response); // Log the response for debugging

                            // Ensure response is parsed correctly (in case it is a string)
                            try {
                                response = JSON.parse(response);
                            } catch (e) {
                                console.error('Error parsing response:', e);
                            }

                            if (response.success) {
                                // Notify user and remove the row from the table
                                Swal.fire(
                                    'Deleted!',
                                    `${partName} has been deleted.`,
                                    'success'
                                ).then(() => {
                                    // Remove the row from the table
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


    })
</script>