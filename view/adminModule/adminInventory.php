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
</head>
<section class="w-100" style="max-height: 90%;">

    <div class="welcomeDiv my-4">
        <h2 class="text-center" style="color: #900008; font-weight: bold;">Inventory of Parts
        </h2>
    </div>
    <div class="container hatian d-flex justify-content-center align-center w-100">


        <form id="deleteAll">
            <div class="container px-3 my-3 d-flex justify-content-evenly">
                <button type="button" class="btn btn-danger my-1" id="delete-selected-btn">Delete Selected</button>
                <button type="button" class="btn btn-success m-1" data-bs-toggle="modal"
                    data-bs-target="#materialRegistrationModal">Material Registration</button>
                <button type="button" class="btn btn-primary m-1" data-bs-toggle="modal"
                    data-bs-target="#addToStockModal">Add to Stock</button>
                <button id="export-btn" class="btn btn-success my-1">Export to Excel</button>
            </div>

            <table class="table table-striped" id="data-table">
                <thead>
                    <tr class="text-center" style="background-color: #900008; color: white; vertical-align: middle;">

                        <th><input type="checkbox" id="select-all"></th>
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
                            <label for="part_min_invent_req" class="form-label">Minimum Inventory Requirement</label>
                            <input type="text" class="form-control" id="part_min_invent_req" name="min_invent_req"
                                placeholder="Enter Minimum Inventory Requirement">
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
                            <label for="partSelect" class="form-label">Part Number</label>
                            <select class="form-select" id="partSelect" name="part_name">
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
                            <label for="new_location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="new_location" name="new_location"
                                placeholder="Enter Location">
                        </div>
                        <div class="mb-1">
                            <label for="new_min_invent_req" class="form-label">Minimum Inventory Requirement</label>
                            <input type="text" class="form-control" id="new_min_invent_req" name="new_min_invent_req"
                                placeholder="Enter Minimum Inventory Requirement">
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
<script src="../../public/js/excel.js"></script>

<script>
    // Function to check account type from server and hide the button if needed
    function checkAccountTypeAndHideButton() {
        $.ajax({
            url: '../../controller/getAccountType.php', // PHP file location
            type: 'GET',
            success: function (response) {
                try {
                    var accountType = JSON.parse(response);
                    if (accountType === "Kitting") {
                        $('#delete-selected-btn').hide();
                    }
                } catch (error) {
                    console.error("Error parsing JSON:", error);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Error fetching notifications:", textStatus, errorThrown);
            }
        });
    }

    // Call the function on page load or whenever necessary
    $(document).ready(function () {
        checkAccountTypeAndHideButton();
    });
</script>


    <script>
        $(document).ready(function () {

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
        $(document).on('change', '#partSelect', function () {
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

        var wb = XLSX.utils.table_to_book(table[0], {sheet: "Filtered Data" });
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
                var rowClass = parseFloat(item.total_part_qty) < parseFloat(item.min_invent_req) ? 'text-danger fw-bold' : '';

                var row = `
                <tr class="table-row text-center" style="vertical-align: middle;" data-part-qty="${item.part_qty}" data-min-invent-req="${item.min_invent_req}">
                    <td><input type="checkbox" name="selected_items[]" value="${item.id}"></td>
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