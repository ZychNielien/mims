<?php
include "navBar.php";
include "../../model/dbconnection.php";


?>

<head>
    <title>Material Inventory</title>
    <link rel="stylesheet" href="../../public/css/table.css">
    <link rel="stylesheet" href="../../public/css/sweetalert.min.css">
    <script src="../../public/js/sweetalert2@11.js"></script>
    <script src="../../public/js/jquery.js"></script>
    <script src="../../public/js/excel.js"></script>
</head>

<body data-user="<?php echo $_SESSION['user']; ?>">

    <section class="w-100" style="max-height: 90%;">

        <div class="px-5 hatian d-flex justify-between align-center w-100 my-3">
            <div class="divWithdrawal px-3 w-25">
                <div class="containerTitle">
                    <h2 class="text-center" style="color: #900008; font-weight: bold;">Material Withdrawal
                    </h2>
                </div>
                <form method="POST" action="../../controller/inventory.php">
                    <?php
                    $selected_username = $_SESSION['username'];
                    $select_user = "SELECT * FROM tbl_users WHERE username = '$selected_username'";
                    $select_user_query = mysqli_query($con, $select_user);
                    $select_user_row = mysqli_fetch_assoc($select_user_query);


                    $query = "SELECT id, part_name FROM tbl_inventory";
                    $result = mysqli_query($con, $query);
                    ?>
                    <input type="hidden" value="<?php echo $select_user_row['cost_center'] ?>" name="cost_center">

                    <div class="mb-3">
                        <label for="mat_partSelect" class="form-label">Part Name</label>
                        <select class="form-select" id="mat_partSelect">
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

                    <div id="mat_itemDetails" style="display: none;">
                        <input type="hidden" id="mat_part_name" name="part_name" />
                        <div class="mb-1">
                            <label for="mat_part_desc" class="form-label">Item Description</label>
                            <textarea class="form-control" id="mat_part_desc" rows="2" name="part_desc"
                                readonly></textarea>
                        </div>
                        <div class="mb-1">
                            <label for="mat_part_option" class="form-label">Option</label>
                            <input type="text" class="form-control" id="mat_part_option" name="part_option" readonly>
                        </div>
                        <div class="mb-1">
                            <label for="mat_part_qty" class="form-label">ITEM QUANTITY</label>
                            <input type="number" class="form-control" id="mat_part_qty" name="part_qty" required>
                        </div>
                        <div class="mb-1">
                            <label for="mat_station_code" class="form-label">STATION CODE</label>
                            <select class="form-select" id="mat_station_code" name="station_code" required>
                                <option value="CDP 1">CDP 1</option>
                                <option value="CDP 2">CDP 2</option>
                                <option value="CDP 3">CDP 3</option>
                                <option value="DA">DA</option>
                                <option value="WB">WB</option>
                                <option value="Mold">Mold</option>
                                <option value="EOL">EOL</option>
                                <option value="Engg">Engg</option>
                                <option value="MEE">MEE</option>
                                <option value="MFG">MFG</option>
                            </select>

                        </div>
                        <div class="mb-1" style="display: none;">
                            <label for="mat_req_by" class="form-label">Req By</label>
                            <input type="text" class="form-control" id="mat_req_by"
                                value="<?php echo $_SESSION['username'] ?>" name="req_by">
                        </div>

                        <div class="mb-1">
                            <label for="mat_machine_no" class="form-label">MACHINE NUMBER</label>
                            <input type="text" class="form-control" id="mat_machine_no" name="machine_no" required>
                        </div>
                        <div class="mb-1">
                            <label for="mat_lot_id" class="form-label">LOT ID</label>
                            <input type="text" class="form-control" id="mat_lot_id" name="lot_id" required>
                        </div>
                        <div class="mb-1">
                            <label for="mat_with_reason" class="form-label">WITHDRAWAL REASON</label>
                            <select class="form-select" id="mat_with_reason" name="with_reason" required>
                                <option value="MC Setup">MC Setup</option>
                                <option value="Replacement">Replacement</option>
                                <option value="General Use">General Use</option>
                                <option value="Change Cap">Change Cap</option>
                                <option value="Dummy Use">Dummy Use</option>
                                <option value="Engineering Eval">Engineering Eval</option>
                                <option value="Use for Packaging">Use for Packaging</option>
                                <option value="Use for Cleaning">Use for Cleaning</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" name="mat_req_part">Submit</button>
                    </div>


                </form>
            </div>

            <div class="container hatian d-flex flex-column justify-content-center align-center w-100">

                <h2 class="text-center" style="color: #900008; font-weight: bold;">Inventory of Parts
                </h2>

                <form id="deleteAll">
                    <div class="container px-3 my-3 d-flex flex-wrap justify-content-evenly">
                        <?php if ($_SESSION['user'] !== 'Kitting'): ?>
                            <button type="button" class="btn btn-danger my-1" id="delete-selected-btn">Delete
                                Selected</button>
                        <?php endif; ?>

                        <button type="button" class="btn btn-success m-1" data-bs-toggle="modal"
                            data-bs-target="#materialRegistrationModal">Material Registration</button>
                        <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal"
                            data-bs-target="#addToStockModal">Add to Stock</button>
                        <button id="export-btn" class="btn btn-success my-1">Export to Excel</button>
                    </div>

                    <table class="table table-striped" id="data-table" data-username="<?php echo $_SESSION['user']; ?>">

                        <thead>
                            <tr class="text-center"
                                style="background-color: #900008; color: white; vertical-align: middle;">
                                <?php if ($_SESSION['user'] !== 'Kitting'): ?>
                                    <th><input type="checkbox" id="select-all"></th>
                                <?php endif; ?>

                                <th>Part Number</th>
                                <th>Part Description</th>
                                <th>Minimum Inventory Requirement</th>
                                <th>Earliest Expiration Date</th>
                                <th>Existing Inventory</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
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
                                    <input type="number" class="form-control" id="part_min_invent_req"
                                        name="min_invent_req" placeholder="Enter Minimum Inventory Requirement">
                                </div>
                                <div class="mb-1">
                                    <label for="part_unit" class="form-label">Unit of Measure</label>
                                    <select class="form-select" id="part_unit" name="unit" required>
                                        <option selected value="">Select Unit</option>
                                        <option value="kea">KEA</option>
                                        <option value="srn">SRN</option>
                                        <option value="spl">SPL</option>
                                        <option value="kg">KG</option>
                                        <option value="ea">EA</option>
                                        <option value="rol">ROL</option>
                                        <option value="pc">PC</option>
                                        <option value="m">M</option>
                                        <option value="pkg">PKG</option>
                                        <option value="bx">BX</option>
                                        <option value="rm">RM</option>
                                        <option value="bag">BAG</option>
                                        <option value="pr">PR</option>
                                        <option value="set">SET</option>
                                        <option value="gal">GAL</option>
                                        <option value="bt">BT</option>
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
                                            placeholder="Enter Kitting ID" required>
                                    </div>
                                    <div class="mb-1">
                                        <label for="lot_id" class="form-label">Lot ID</label>
                                        <input type="text" class="form-control" id="lot_id" name="lot_id"
                                            placeholder="Enter Lot ID" required>
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
                                        placeholder="Enter Part Number">
                                </div>
                                <div class="mb-1">
                                    <label for="new_part_desc" class="form-label">Item Description</label>
                                    <textarea class="form-control" id="new_part_desc" name="new_part_desc" rows="2"
                                        placeholder="Enter Part Description"></textarea>
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
                                        placeholder="Enter Location">
                                </div>
                                <div class="mb-1">
                                    <label for="new_min_invent_req" class="form-label">Minimum Inventory
                                        Requirement</label>
                                    <input type="text" class="form-control" id="new_min_invent_req"
                                        name="new_min_invent_req" placeholder="Enter Minimum Inventory Requirement"
                                        min="1" step="1" required>
                                </div>
                                <div class="mb-1">
                                    <label for="new_unit" class="form-label">Unit of Measure</label>
                                    <select class="form-select" id="new_unit" name="new_unit" required>
                                        <option selected value="">Select Unit</option>
                                        <option value="kea">KEA</option>
                                        <option value="srn">SRN</option>
                                        <option value="spl">SPL</option>
                                        <option value="kg">KG</option>
                                        <option value="ea">EA</option>
                                        <option value="rol">ROL</option>
                                        <option value="pc">PC</option>
                                        <option value="m">M</option>
                                        <option value="pkg">PKG</option>
                                        <option value="bx">BX</option>
                                        <option value="rm">RM</option>
                                        <option value="bag">BAG</option>
                                        <option value="pr">PR</option>
                                        <option value="set">SET</option>
                                        <option value="gal">GAL</option>
                                        <option value="bt">BT</option>
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
        $('#new_min_invent_req').on('input', function () {
            // Remove any non-numeric characters
            this.value = this.value.replace(/[^0-9]/g, '');
        }).on('blur', function () {
            // Ensure the input value is at least 1 when losing focus
            if (this.value === '' || parseInt(this.value, 10) < 1) {
                this.value = 1;
            }
        });

        var user = $('body').data('user');

        if (user == 'admin') {
            $('input[name="selected_items[]"]').hide();
        }

        $('#mat_partSelect').on('change', function () {
            var partId = $(this).val();

            if (partId) {
                var partName = $(this).find('option:selected').data('part_name');

                $('#mat_part_name').val(partName);

                $.ajax({
                    url: 'mat_fetch_part_desc.php',
                    type: 'GET',
                    data: { part_id: partId },
                    dataType: 'json',
                    success: function (data) {
                        if (data.part_desc) {
                            $('#mat_itemDetails').show();
                            $('#mat_part_desc').val(data.part_desc);
                        } else {
                            $('#mat_part_desc').val('No description available');
                        }

                        if (data.part_option) {
                            $('#mat_part_option').val(data.part_option);
                        } else {
                            $('#mat_part_option').val('No option available');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX error: ' + error);
                    }
                });
            } else {
                $('#mat_itemDetails').hide();
                $('#mat_part_desc').val('');
                $('#mat_part_option').val('');
                $('#mat_part_name').val('');
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
                    url: 'fetch_part_desc.php',
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

        // SELECT ALL CHECKBOX FUNCTION
        $('#select-all').change(function () {
            var checkboxes = $('input[name="selected_items[]"]');
            checkboxes.prop('checked', this.checked);
        });

        // DELETE ALL SELECTED CHECKBOX FUNCTION
        $('#delete-selected-btn').click(function () {
            var selectedItems = $('input[name="selected_items[]"]:checked');

            if (selectedItems.length > 0) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete them!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var selectedIds = [];
                        selectedItems.each(function () {
                            selectedIds.push($(this).val());
                        });

                        var formData = new FormData($('#deleteAll')[0]);
                        formData.append('delete_multiple', true);
                        formData.append('selected_items', JSON.stringify(selectedIds));

                        $.ajax({
                            url: '../../controller/inventory.php',
                            method: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                var data = JSON.parse(response);
                                if (data.success) {
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: data.message,
                                        icon: 'success'
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: data.message,
                                        icon: 'error'
                                    });
                                }
                            },
                            error: function () {
                                Swal.fire({
                                    title: 'Error!',
                                    text: "There was an issue with the request. Please try again.",
                                    icon: 'error'
                                });
                            }
                        });
                    }
                });
            } else {
                Swal.fire({
                    title: 'No items selected!',
                    text: "Please select at least one item to delete.",
                    icon: 'error'
                });
            }
        });

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
                        rowClass = 'text-danger fw-bold'; // Red for zero quantity
                    } else if (minInventReq > 0 && totalPartQty < minInventReq) {
                        rowClass = 'text-warning'; // Orange for below minimum requirement
                    }

                    var row = `
                <tr class="table-row text-center" style="vertical-align: middle;" data-part-qty="${item.part_qty}" data-min-invent-req="${item.min_invent_req}">
                <?php if ($_SESSION['user'] !== 'Kitting'): ?>
    <td><input type="checkbox" name="selected_items[]" value="${item.id}"></td>
<?php endif; ?>

                    <td data-label="Part Name" class="${rowClass}">${item.part_name}</td>
                    <td data-label="Part Desc" class="${rowClass}">${item.part_desc}</td>
                    <td data-label="Min Invent Req" class="${rowClass}">${item.min_invent_req}</td>
                    <td data-label="Exp Date" class="${rowClass}">${item.least_exp_date}</td>
                    <td data-label="Part Qty" class="${rowClass}">${item.total_part_qty}</td>
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
                    </td>
                </tr>
            `;

                    $('tbody').append(row);
                });
            }
        }




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


    })
</script>