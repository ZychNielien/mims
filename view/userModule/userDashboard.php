<?php
include "navBar.php";
include "../../model/dbconnection.php";
?>

<head>
    <title>Material Withdrawal</title>
    <style>
        .form-label {
            color: #900008;
            font-weight: bold;
        }



        @media (max-width: 1100px) {
            .hatian {
                display: flex;
                flex-direction: column;
            }

            .divWithdrawal,
            .divReq {
                width: 100% !important;
            }

            .divReq {
                max-height: none !important;
                overflow: none !important;
            }

            table {
                border: 0;
            }

            table caption {
                font-size: 1.3em;
            }

            table thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }

            table tr {
                border-bottom: 3px solid #ddd;
                display: block;
                margin-bottom: .625em;
            }

            table td {
                border-bottom: 1px solid #ddd;
                display: block;
                font-size: .8em;
                text-align: right;
            }

            table td::before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }

            table td:last-child {
                border-bottom: 0;
            }


        }
    </style>
    <script src="../../public/js/jquery.js"></script>
</head>
<section>
    <div class="welcomeDiv my-2">
        <h2 class="text-center">Welcome, <?php echo $_SESSION['username'] ?>!</h2>
    </div>
    <div class="px-5 hatian d-flex justify-between align-center w-100">
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


                $query = "SELECT id, part_name FROM tbl_inventory";
                $result = mysqli_query($con, $query);
                ?>
                <input type="hidden" value="<?php echo $select_user_row['cost_center'] ?>" name="cost_center">

                <div class="mb-3">
                    <label for="partSelect" class="form-label">Part Name</label>
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
                        <textarea class="form-control" id="part_desc" rows="2" name="part_desc" readonly></textarea>
                    </div>
                    <div class="mb-1">
                        <label for="part_option" class="form-label">Option</label>
                        <input type="text" class="form-control" id="part_option" name="part_option" readonly>
                    </div>
                    <div class="mb-1">
                        <label for="part_qty" class="form-label">ITEM QUANTITY</label>
                        <input type="number" class="form-control" id="part_qty" name="part_qty" required>
                    </div>
                    <div class="mb-1">
                        <label for="station_code" class="form-label">STATION CODE</label>
                        <select class="form-select" id="station_code" name="station_code" required>
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
                        <label for="req_by" class="form-label">Req By</label>
                        <input type="text" class="form-control" id="req_by" value="<?php echo $_SESSION['username'] ?>"
                            name="req_by">
                    </div>

                    <div class="mb-1">
                        <label for="machine_no" class="form-label">MACHINE NUMBER</label>
                        <input type="text" class="form-control" id="machine_no" name="machine_no" required>
                    </div>
                    <div class="mb-1">
                        <label for="lot_id" class="form-label">LOT ID</label>
                        <input type="text" class="form-control" id="lot_id" name="lot_id" required>
                    </div>
                    <div class="mb-1">
                        <label for="with_reason" class="form-label">WITHDRAWAL REASON</label>
                        <select class="form-select" id="with_reason" name="with_reason" required>
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
                    <button type="submit" class="btn btn-primary" name="req_part">Submit</button>
                </div>


            </form>
        </div>
        <div class="divReq p-3 w-75" style="max-height: 750px; overflow: auto;">
            <div class="containerTitle">
                <h4 class="text-center">Requested Parts</h4>
            </div>
            <button id="delete-btn" class="btn btn-danger mb-3">Delete Selected</button>

            <table class="table table-striped">
                <thead>
                    <tr class="text-center" style="background-color: #900008; color: white; vertical-align: middle;">
                        <th scope="col"><input type="checkbox" id="select-all"></th>
                        <th scope="col">Date / Time / Shift</th>
                        <th scope="col">Lot ID</th>
                        <th scope="col">Part Name</th>
                        <th scope="col">Item Description</th>
                        <th scope="col">Qty.</th>
                        <th scope="col">Machine No.</th>
                        <th scope="col">Withdrawal Reason</th>
                        <th scope="col">Requested By</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $userName = $_SESSION['username'];
                    $sql = "SELECT * FROM tbl_requested WHERE req_by = '$userName' AND status = 'Pending'  ORDER BY dts DESC";
                    $sql_query = mysqli_query($con, $sql);

                    if ($sql_query) {
                        while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                            ?>
                            <tr>
                                <td><input type="checkbox" class="select-row" data-id="<?php echo $sqlRow['id']; ?>"
                                        data-qty="<?php echo $sqlRow['part_qty']; ?>"
                                        data-part_name="<?php echo $sqlRow['part_name']; ?>"></td>
                                <td data-label="Date / Time / Shift"><?php echo $sqlRow['dts'] ?></td>
                                <td data-label="Lot Id"><?php echo $sqlRow['lot_id'] ?></td>
                                <td data-label="Part Name"><?php echo $sqlRow['part_name'] ?></td>
                                <td data-label="Part Desc"><?php echo $sqlRow['part_desc'] ?></td>
                                <td data-label="Quantity"><?php echo $sqlRow['part_qty'] ?></td>
                                <td data-label="Machine No"><?php echo $sqlRow['machine_no'] ?></td>
                                <td data-label="Reason"><?php echo $sqlRow['with_reason'] ?></td>
                                <td data-label="Requested By"><?php echo $sqlRow['req_by'] ?></td>
                                <td data-label="Status"><?php echo $sqlRow['status'] ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</section>

<script>
    $(document).ready(function () {

        $('#partSelect').on('change', function () {
            var partId = $(this).val();

            if (partId) {
                var partName = $(this).find('option:selected').data('part_name');

                $('#part_name').val(partName);

                $.ajax({
                    url: 'fetch_part_desc.php',
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

        $('#select-all').on('change', function () {
            $('.select-row').prop('checked', $(this).prop('checked'));
        });

        $('#delete-btn').on('click', function () {
            var selectedIds = [];
            var selectedQty = [];
            var selectedPartNames = [];

            $('.select-row:checked').each(function () {
                selectedIds.push($(this).data('id'));
                selectedQty.push($(this).data('qty'));
                selectedPartNames.push($(this).data('part_name'));
            });

            if (selectedIds.length > 0) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you really want to delete the selected records?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '../../controller/inventory.php',
                            type: 'POST',
                            data: {
                                action: 'delete_selected',
                                ids: selectedIds,
                                qty: selectedQty,
                                part_name: selectedPartNames
                            },
                            success: function (response) {
                                if (response == 'Success') {
                                    Swal.fire(
                                        'Deleted!',
                                        'The selected records have been deleted.',
                                        'success'
                                    );
                                    location.reload();
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'There was an error deleting the selected items.',
                                        'error'
                                    );
                                }
                            },
                            error: function () {
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while deleting the selected items.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            } else {
                Swal.fire(
                    'No items selected',
                    'Please select at least one item to delete.',
                    'info'
                );
            }
        });
    });

</script>