<?php

// Database Connection
include "../../model/dbconnection.php";

// Navigation Bar
include "navBar.php";

?>

<head>

    <!-- Title -->
    <title>Material Withdrawal</title>

    <!-- Withdrawal Style -->
    <link rel="stylesheet" href="../../public/css/responsiveWithdrawal.css">

    <!-- Jquery -->
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

            <!-- Material Withdrawal Request Form -->
            <form action="../../controller/user_query.php" method="post" id="delete-form">

                <!-- Material Withdrawal Request Delete Button -->
                <div class="d-flex justify-content-start w-100 my-2">

                    <button type="button" id="delete-btn" class="btn btn-danger">
                        Delete Selected
                    </button>

                </div>

                <!-- Material Withdrawal Request Table -->
                <table class="table table-striped">

                    <thead>
                        <tr class="text-center"
                            style="background-color: #900008; color: white; vertical-align: middle;">
                            <th scope="col"><input type="checkbox" id="select-all"></th>
                            <th scope="col">Date / Time / Shift</th>
                            <th scope="col">Lot ID</th>
                            <th scope="col">Part Number</th>
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

                        if (mysqli_num_rows($sql_query) > 0) {
                            while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                                ?>
                                <tr class="text-center">
                                    <td>
                                        <input type="checkbox" class="select-row" data-id="<?php echo $sqlRow['id']; ?>"
                                            data-qty="<?php echo $sqlRow['part_qty']; ?>"
                                            data-part_name="<?php echo $sqlRow['part_name']; ?>"
                                            data-exp_date="<?php echo $sqlRow['exp_date']; ?>">
                                    </td>
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

            </form>

        </div>

    </div>

</section>

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

        // Material Request Deletion
        $('#delete-btn').on('click', function () {
            var selectedIds = [];
            var partQuantities = [];
            var partNames = [];
            var expDates = [];

            $('.select-row:checked').each(function () {
                selectedIds.push($(this).data('id'));
                partQuantities.push($(this).data('qty'));
                partNames.push($(this).data('part_name'));
                expDates.push($(this).data('exp_date'));
            });

            if (selectedIds.length === 0) {
                Swal.fire({
                    title: 'No Selection!',
                    text: 'Please select at least one record to delete.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this action!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.each(selectedIds, function (index, value) {
                        $('#delete-form').append('<input type="hidden" name="selected_ids[]" value="' + value + '">');
                    });

                    $.each(partQuantities, function (index, value) {
                        $('#delete-form').append('<input type="hidden" name="part_quantities[]" value="' + value + '">');
                    });

                    $.each(partNames, function (index, value) {
                        $('#delete-form').append('<input type="hidden" name="part_names[]" value="' + value + '">');
                    });

                    $.each(expDates, function (index, value) {
                        $('#delete-form').append('<input type="hidden" name="exp_dates[]" value="' + value + '">');
                    });

                    $('#delete-form').submit();
                }
            });
        });

    });

</script>