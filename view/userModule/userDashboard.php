<?php

include "../../model/dbconnection.php";
include "navBar.php";

$sql_withreason = "SELECT reason FROM tbl_withdrawal_reason";
$sql_withreason_query = mysqli_query($con, $sql_withreason);
$withdraw_option = "";

if ($sql_withreason_query) {
    while ($withreasonRow = mysqli_fetch_assoc($sql_withreason_query)) {
        $withdraw_option .= '<option value="' . $withreasonRow['reason'] . '">' . $withreasonRow['reason'] . '</option>';
    }
}

$sql_machine = "SELECT machine_number FROM tbl_machine";
$sql_machine_query = mysqli_query($con, $sql_machine);
$machine_option = "";

if ($sql_machine_query) {
    while ($machineRow = mysqli_fetch_assoc($sql_machine_query)) {
        $machine_option .= '<option value="' . $machineRow['machine_number'] . '">' . $machineRow['machine_number'] . '</option>';
    }
}

?>

<head>

    <title>Material Withdrawal</title>
    <link rel="stylesheet" href="../../public/css/responsiveWithdrawal.css">
    <script src="../../public/js/jquery.js"></script>

</head>

<section>
    <!-- Welcome Div -->
    <div class="welcomeDiv my-2">
        <h2 class="text-center">Welcome, <?php echo $_SESSION['username'] ?>!</h2>
    </div>

    <!-- Main Container -->
    <div class="px-5 hatian d-flex justify-between align-center">

        <!-- Material Withdrawal Side -->
        <div class="divWithdrawal px-3 w-25">

            <!-- Material Withdrawal Title -->
            <div class="containerTitle">
                <h4>Material Withdrawal</h4>
            </div>

            <!-- Material Withdrawal Form -->
            <form method="POST" action="../../controller/user_query.php">

                <?php
                $selected_username = $_SESSION['username'];
                $select_user = "SELECT * FROM tbl_users WHERE username = '$selected_username'";
                $select_user_query = mysqli_query($con, $select_user);
                $select_user_row = mysqli_fetch_assoc($select_user_query);

                $query = "SELECT id, part_name FROM tbl_inventory ORDER BY part_name ASC";
                $result = mysqli_query($con, $query);

                ?>

                <!-- Selected User Cost Center Input -->
                <input type="hidden" value="<?php echo $select_user_row['cost_center'] ?>" name="cost_center">

                <!-- Part Number Selection -->
                <div class="mb-3">
                    <label for="partSelect" class="form-label">Part Number</label>
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

                <!-- Part Number Details -->
                <div id="itemDetails" style="display: none;">

                    <!-- Part Name Input Hidden -->
                    <input type="hidden" id="part_name" name="part_name" />

                    <!-- Part Description -->
                    <div class="mb-1">
                        <label for="part_desc" class="form-label">Item Description</label>
                        <textarea class="form-control" id="part_desc" rows="2" name="part_desc" readonly></textarea>
                    </div>

                    <!-- Part Option -->
                    <div class="mb-1">
                        <label for="part_option" class="form-label">Option</label>
                        <input type="text" class="form-control" id="part_option" name="part_option" readonly>
                    </div>

                    <!-- Part Quantity -->
                    <div class="mb-1">
                        <label for="part_qty" class="form-label">ITEM QUANTITY</label>
                        <input type="number" class="form-control" id="part_qty" name="part_qty" required
                            placeholder="Enter Item Quantity">
                    </div>

                    <!-- Part Station Code -->
                    <div class="mb-1">
                        <label for="station_code" class="form-label">STATION CODE</label>
                        <select class="form-select" id="station_code" name="station_code" required>
                            <option value="">Select Station Code</option>
                            <?php
                            $sql_station = "SELECT station_code FROM tbl_station_code";
                            $sql_station_query = mysqli_query($con, $sql_station);
                            if ($sql_station_query) {
                                while ($statiobRow = mysqli_fetch_assoc($sql_station_query)) {
                                    ?>

                                    <option value="<?php echo $statiobRow['station_code'] ?>">
                                        <?php echo $statiobRow['station_code'] ?>
                                    </option>

                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Requested By (USER) -->
                    <div class="mb-1" style="display: none;">
                        <label for="req_by" class="form-label">Req By</label>
                        <input type="text" class="form-control" id="req_by" value="<?php echo $_SESSION['username'] ?>"
                            name="req_by">
                    </div>

                    <!-- Machine Number -->
                    <div class="mb-1">
                        <label for="machine_no" class="form-label">MACHINE NUMBER</label>
                        <select class="form-select" id="machine_no" name="machine_no" required>
                            <option value="">Select Machine Number</option>

                            <?php

                            $sql_machine = "SELECT machine_number FROM tbl_machine";
                            $sql_machine_query = mysqli_query($con, $sql_machine);
                            if ($sql_machine_query) {
                                while ($machineRow = mysqli_fetch_assoc($sql_machine_query)) {
                                    ?>

                                    <option value="<?php echo $machineRow['machine_number'] ?>">
                                        <?php echo $machineRow['machine_number'] ?>
                                    </option>

                                    <?php
                                }
                            }

                            ?>
                        </select>
                    </div>

                    <!-- Lot ID -->
                    <div class="mb-1">
                        <label for="lot_id" class="form-label">LOT ID</label>
                        <input type="text" class="form-control" id="lot_id" name="lot_id" required
                            placeholder="Enter Lot ID" autocomplete="off">
                    </div>

                    <!-- Withdrawal Reason -->
                    <div class="mb-3">
                        <label for="with_reason" class="form-label">WITHDRAWAL REASON</label>
                        <select class="form-select" id="with_reason" name="with_reason" required>
                            <option value="">Select Withdrawal Reason</option>
                            <?php
                            $sql_withreason = "SELECT reason FROM tbl_withdrawal_reason";
                            $sql_withreason_query = mysqli_query($con, $sql_withreason);
                            if ($sql_withreason_query) {
                                while ($withreasonRow = mysqli_fetch_assoc($sql_withreason_query)) {
                                    ?>

                                    <option value="<?php echo $withreasonRow['reason'] ?>">
                                        <?php echo $withreasonRow['reason'] ?>
                                    </option>

                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Submit Material Request -->
                    <button type="submit" class="btn btn-primary" name="req_part">Submit</button>

                </div>

            </form>

        </div>

        <!-- Material Withdrawal Requests -->
        <div class="divReq p-3 w-75" style="max-height: 750px; overflow: auto;">

            <!-- Material Withdrawal Request Title -->
            <div class="containerTitle">
                <h4 class="text-center">Requested Parts</h4>
            </div>

            <!-- Material Withdrawal Request Delete Button -->
            <div class="d-flex justify-content-start gap-3 w-100 mb-3">
                <div>
                    <button class="btn btn-primary" id="update-btn">Edit Request</button>
                </div>
                <div>
                    <button class="btn btn-danger" id="delete-btn">Delete Request</button>
                </div>
            </div>

            <!-- Material Withdrawal Request Table -->
            <table class="table table-striped">

                <thead>
                    <tr class="text-center" style="background-color: #900008; color: white; vertical-align: middle;">
                        <th scope="col"><input type="checkbox" id="select-all"></th>
                        <th scope="col">Date / Time / Shift</th>
                        <th scope="col">Lot ID</th>
                        <th scope="col">Part Number</th>
                        <th scope="col">Item Description</th>
                        <th scope="col">Qty.</th>
                        <th scope="col">Machine No.</th>
                        <th scope="col">Withdrawal Reason</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    $userName = $_SESSION['username'];
                    $sql = "SELECT * FROM tbl_requested WHERE req_by = '$userName' AND status = 'Pending'  ORDER BY dts DESC";
                    $sql_query = mysqli_query($con, $sql);

                    if (mysqli_num_rows($sql_query) > 0) {
                        while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                            ?>
                            <tr class="text-center">
                                <td>
                                    <input type="checkbox" class="select-row" data-id="<?php echo $sqlRow['id']; ?>"
                                        data-qty="<?php echo $sqlRow['part_qty']; ?>" data-dts="<?php echo $sqlRow['dts']; ?>"
                                        data-part_name="<?php echo $sqlRow['part_name']; ?>"
                                        data-exp_date="<?php echo $sqlRow['exp_date']; ?>"
                                        data-lot_id="<?php echo $sqlRow['lot_id']; ?>"
                                        data-machine="<?php echo $sqlRow['machine_no']; ?>"
                                        data-withdrawal="<?php echo $sqlRow['with_reason']; ?>">
                                </td>
                                <td data-label="Date / Time / Shift"><?php echo $sqlRow['dts'] ?></td>
                                <td data-label="Lot Id"><?php echo $sqlRow['lot_id'] ?></td>
                                <td data-label="Part Name"><?php echo $sqlRow['part_name'] ?></td>
                                <td data-label="Part Desc"><?php echo $sqlRow['part_desc'] ?></td>
                                <td data-label="Quantity"><?php echo $sqlRow['part_qty'] ?></td>
                                <td data-label="Machine No"><?php echo $sqlRow['machine_no'] ?></td>
                                <td data-label="Reason"><?php echo $sqlRow['with_reason'] ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="11" class="text-center">No withdrawal request found</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>

            </table>

        </div>

    </div>

</section>

<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Selected Requests</h5>
            </div>
            <div class="modal-body">
                <form id="updateForm">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="text-center text-white" style="background-color: #900008;">
                                <tr>
                                    <th>Date / Time / Shift</th>
                                    <th>Lot ID</th>
                                    <th>Part Number</th>
                                    <th>Part Quantity</th>
                                    <th>Machine Number</th>
                                    <th>Withdrawal Reason</th>
                                </tr>
                            </thead>
                            <tbody id="modalItemList">
                                <!-- Selected items will be injected here -->
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


<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Deletion of Selected Requests</h5>
            </div>
            <div class="modal-body">
                <form id="deleteForm">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="text-center text-white" style="background-color: #900008;">
                                <tr>
                                    <th>Date / Time / Shift</th>
                                    <th>Lot ID</th>
                                    <th>Part Number</th>
                                    <th>Part Quantity</th>
                                    <th>Machine Number</th>
                                    <th>Withdrawal Reason</th>
                                </tr>
                            </thead>
                            <tbody id="modalDeleteItemList">
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger" name="delete_submit">Reject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {

        // Select Part Number shows Part Description
        $('#partSelect').on('change', function () {
            var partId = $(this).val();

            if (partId) {
                var partName = $(this).find('option:selected').data('part_name');

                $('#part_name').val(partName);

                $.ajax({
                    url: '../../controller/fetch_part_desc.php',
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

        // Select All for Request Deletion
        $('#select-all').on('change', function () {
            $('.select-row').prop('checked', $(this).prop('checked'));
        });

        $("#update-btn").click(function () {
            $("#modalItemList").empty();

            let selectedItems = $(".select-row:checked");

            if (selectedItems.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No items selected',
                    text: 'Please select at least one request to approve.',
                    confirmButtonText: 'Ok'
                });
                return;
            }

            selectedItems.each(function () {
                let id = $(this).data("id");
                let partName = $(this).data("part_name");
                let qty = $(this).data("qty");
                let exp_date = $(this).data("exp_date");
                let lot_id = $(this).data("lot_id");
                let machine = $(this).data("machine");
                let withdrawal = $(this).data("withdrawal");
                let dts = $(this).data("dts");
                let withdraw_options = '<?php echo $withdraw_option; ?>';
                let machine_options = '<?php echo $machine_option; ?>';

                let row = `
            <tr class="text-center" style="vertical-align: middle;">
                <td>${dts}</td>
                <td>${lot_id}</td>
                <td>${partName}</td>
                <td><input type="number" name="quantities[]" value="${qty}" class="form-control" min="1" required></td>
                <td>                    
                    <select class="form-select" name="machines[]" required>
                        <option value="">Select Machine</option>
                        <?php
                        $sql_machine = "SELECT machine_number FROM tbl_machine";
                        $sql_machine_query = mysqli_query($con, $sql_machine);
                        $machine_option = "";
                        if ($sql_machine_query) {
                            while ($machineRow = mysqli_fetch_assoc($sql_machine_query)) {
                                $machine_option .= '<option value="' . $machineRow['machine_number'] . '">' . $machineRow['machine_number'] . '</option>';
                            }
                        }
                        echo $machine_option;
                        ?>
                    </select>
                </td>
                <td> 
                    <select class="form-select" name="with_reasons[]" required>
                        <option value="">Select Withdrawal Reason</option>
                        <?php
                        $sql_withreason = "SELECT reason FROM tbl_withdrawal_reason";
                        $sql_withreason_query = mysqli_query($con, $sql_withreason);
                        $withdraw_option = "";

                        if ($sql_withreason_query) {
                            while ($withreasonRow = mysqli_fetch_assoc($sql_withreason_query)) {
                                $withdraw_option .= '<option value="' . $withreasonRow['reason'] . '">' . $withreasonRow['reason'] . '</option>';
                            }
                        }
                        echo $withdraw_option;
                        ?>
                    </select>
                </td>
                <td style="display:none;"> 
                    <input type="hidden" name="ids[]" value="${id}">
                    <input type="hidden" name="part_names[]" value="${partName}">
                    <input type="hidden" name="exp_dates[]" value="${exp_date}">
                </td>
            </tr>

            `;
                $("#modalItemList").append(row);
                let lastRow = $("#modalItemList tr:last-child");
                lastRow.find('select[name="machines[]"]').val(machine);
                lastRow.find('select[name="with_reasons[]"]').val(withdrawal);
            });
            $("#updateModal").modal("show");
        });

        $("#updateForm").submit(function (e) {
            e.preventDefault();

            let formData = $(this).serialize();
            formData += "&update_submit=1";

            $.ajax({
                url: '../../controller/user_query.php',
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Requests approved successfully!',
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


        $("#delete-btn").click(function () {
            $("#modalDeleteItemList").empty();

            let selectedItems = $(".select-row:checked");

            if (selectedItems.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No items selected',
                    text: 'Please select at least one request to reject.',
                    confirmButtonText: 'Ok'
                });
                return;
            }

            selectedItems.each(function () {
                let id = $(this).data("id");
                let partName = $(this).data("part_name");
                let qty = $(this).data("qty");
                let exp_date = $(this).data("exp_date");
                let lot_id = $(this).data("lot_id");
                let machine = $(this).data("machine");
                let withdrawal = $(this).data("withdrawal");
                let dts = $(this).data("dts");

                let row = `
                    <tr class=" text-center" style="vertical-align: middle;">
                        <td data-label="Date / Time / Shift">${dts}</td>
                        <td data-label="Lot ID">${lot_id}</td>
                        <td data-label="Part Number">${partName} <input type="hidden" name="ids[]" value="${id}"></td>
                        <td data-label="Part Quantity">${qty}</td>
                        <td data-label="Machine Number">${machine}</td>
                        <td data-label="Withdrawal Reason">${withdrawal}</td>
                    
                
                        <td style="display:none;"> 
                            <input type="hidden" name="part_names[]" value="${partName}">
                            <input type="hidden" name="quantities[]" value="${qty}">
                            <input type="hidden" name="exp_dates[]" value="${exp_date}">
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
                url: '../../controller/user_query.php',
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Rejected!',
                            text: 'Requests have been deleted successfully.',
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