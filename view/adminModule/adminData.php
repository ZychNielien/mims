<?php

// Database Connection
include "../../model/dbconnection.php";

// Navigation Bar
include "navBar.php";

?>

<head>

    <!-- Title -->
    <title>Expired Part History</title>

    <!-- Table Style -->
    <link rel="stylesheet" href="../../public/css/table.css">

    <!-- Jquery Script -->
    <script src="../../public/js/jquery.js"></script>

    <!-- Excel Script -->
    <script src="../../public/js/excel.js"></script>

</head>

<section style="max-height: 90%;">

    <!-- Main Container -->
    <div class="container">

        <!-- Title Div -->
        <div class="welcomeDiv my-2">
            <h2 class="text-center" style="color: #900008; font-weight: bold;">AIMS Data Management
            </h2>
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="machine-tab" data-bs-toggle="tab" data-bs-target="#machine-tab-pane"
                    type="button" role="tab" aria-controls="machine-tab-pane" aria-selected="true">Machine
                    Number</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="station-tab" data-bs-toggle="tab" data-bs-target="#station-tab-pane"
                    type="button" role="tab" aria-controls="station-tab-pane" aria-selected="false">Station
                    Code</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="withdraw-tab" data-bs-toggle="tab" data-bs-target="#withdraw-tab-pane"
                    type="button" role="tab" aria-controls="withdraw-tab-pane" aria-selected="false">Withdrawal
                    Reason</button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">

            <!-- MACHINE NUMBER -->
            <div class="tab-pane fade" id="machine-tab-pane" role="tabpanel" aria-labelledby="machine-tab" tabindex="0">
                <div class="container">
                    <div class="d-flex justify-content-evenly flex-wrap flex-row w-100 gap-3 m-2">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <label for="search_machine" class="fw-bold">Search:</label>
                            <input type="text" class="form-control w-auto" id="search_machine" required
                                autocomplete="off" placeholder="Search Machine Number">
                        </div>

                        <form action="../../controller/data.php" method="POST" class="d-flex gap-2">
                            <input type="text" class="form-control w-auto" required autocomplete="off"
                                placeholder="Enter Machine Number" name="machine">
                            <button type="submit" class="btn btn-success" name="machine_submit">Register</button>
                        </form>
                    </div>
                    <table class="table table-striped w-100">
                        <thead>
                            <tr class="text-center"
                                style="background-color: #900008; color: white; vertical-align: middle;">
                                <th>Machine Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="data-table-machine">
                            <?php
                            $machine_sql = "SELECT * FROM `tbl_machine`";
                            $machine_query = mysqli_query($con, $machine_sql);
                            if (mysqli_num_rows($machine_query) > 0) {
                                while ($machineRow = mysqli_fetch_Assoc($machine_query)) {
                                    ?>
                                    <tr class="table-row text-center" style="vertical-align: middle;">
                                        <td data-label="Machine Number"><?php echo $machineRow['machine_number']; ?></td>
                                        <td data-label="Action">
                                            <button class="btn btn-primary btn-edit"
                                                data-machine="<?php echo $machineRow['machine_number']; ?>"
                                                data-id="<?php echo $machineRow['id']; ?>">Update</button>
                                            <button class="btn btn-danger btn-delete"
                                                data-machine="<?php echo $machineRow['machine_number']; ?>"
                                                data-id="<?php echo $machineRow['id']; ?>">Delete</button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="8" class="text-center">No machine number found</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- STATION CODE -->
            <div class="tab-pane fade" id="station-tab-pane" role="tabpanel" aria-labelledby="station-tab" tabindex="0">
                <div class="container">
                    <div class="d-flex justify-content-evenly flex-wrap flex-row w-100 gap-3 m-2">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <label for="search_station" class="fw-bold">Search:</label>
                            <input type="text" class="form-control w-auto" id="search_station" required
                                autocomplete="off" placeholder="Search Station Code">
                        </div>
                        <form action="../../controller/data.php" method="POST" class="d-flex gap-2">
                            <input type="text" class="form-control w-auto" required autocomplete="off"
                                placeholder="Enter Station Code" name="station_code">
                            <button type="submit" class="btn btn-success" name="station_submit">Register</button>
                        </form>
                    </div>
                    <table class="table table-striped w-100">
                        <thead>
                            <tr class="text-center"
                                style="background-color: #900008; color: white; vertical-align: middle;">
                                <th>Station Code</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="data-table-station">
                            <?php
                            $station_sql = "SELECT * FROM `tbl_station_code`";
                            $station_query = mysqli_query($con, $station_sql);
                            if (mysqli_num_rows($station_query) > 0) {
                                while ($stationRow = mysqli_fetch_Assoc($station_query)) {
                                    ?>
                                    <tr class="table-row  text-center">
                                        <td data-label="Station Code"><?php echo $stationRow['station_code']; ?></td>
                                        <td data-label="Action">
                                            <button class="btn btn-primary station-edit"
                                                data-station="<?php echo $stationRow['station_code']; ?>"
                                                data-id="<?php echo $stationRow['id']; ?>">Update</button>
                                            <button class="btn btn-danger station-delete"
                                                data-station="<?php echo $stationRow['station_code']; ?>"
                                                data-id="<?php echo $stationRow['id']; ?>">Delete</button>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="8" class="text-center">No station code found</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- WITHDRAWAL REASON -->
            <div class="tab-pane fade" id="withdraw-tab-pane" role="tabpanel" aria-labelledby="withdraw-tab"
                tabindex="0">
                <div class="container">

                    <div class="d-flex justify-content-evenly flex-wrap flex-row w-100 gap-3 m-2">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <label for="search_reason" class="fw-bold">Search:</label>
                            <input type="text" class="form-control w-auto" id="search_reason" required
                                autocomplete="off" placeholder="Search Withdrawal Reason">
                        </div>
                        <form action="../../controller/data.php" method="POST" class="d-flex gap-2">
                            <input type="text" class="form-control w-auto" required autocomplete="off"
                                placeholder="Enter Withdrawal Reason" name="withdrawal_reason">
                            <button type="submit" class="btn btn-success" name="reason_submit">Register</button>
                        </form>
                    </div>
                    <table class="table table-striped w-100">
                        <thead>
                            <tr class="text-center"
                                style="background-color: #900008; color: white; vertical-align: middle;">
                                <th>Withdrawal Reason</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="data-table-reason">
                            <?php
                            $reason_sql = "SELECT * FROM `tbl_withdrawal_reason`";
                            $reason_query = mysqli_query($con, $reason_sql);
                            if (mysqli_num_rows($reason_query) > 0) {
                                while ($reasonRow = mysqli_fetch_Assoc($reason_query)) {
                                    ?>
                                    <tr class="table-row  text-center">
                                        <td data-label="Withdrawal Reason"><?php echo $reasonRow['reason']; ?></td>
                                        <td data-label="Action">
                                            <button class="btn btn-primary reason-edit"
                                                data-reason="<?php echo $reasonRow['reason']; ?>"
                                                data-id="<?php echo $reasonRow['id']; ?>">Update</button>
                                            <button class="btn btn-danger reason-delete"
                                                data-reason="<?php echo $reasonRow['reason']; ?>"
                                                data-id="<?php echo $reasonRow['id']; ?>">Delete</button>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Machine Number Modification Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Machine Number</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="../../controller/data.php">
                            <div class="mb-3">
                                <label for="machineNumber" class="form-label">Machine Number</label>
                                <input type="text" class="form-control" id="machineNumber" name="machine_number"
                                    required autocomplete="OFF">
                            </div>
                            <input type="hidden" id="machine_id" name="machine_id">
                            <button type="submit" class="btn btn-primary" name="machine_update">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Station Code Modification Modal -->
        <div class="modal fade" id="editStationModal" tabindex="-1" aria-labelledby="editStationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editStationModalLabel">Edit Station Code</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="../../controller/data.php">
                            <div class="mb-3">
                                <label for="stationCode" class="form-label">Station Code</label>
                                <input type="text" class="form-control" id="stationCode" name="station_code" required
                                    autocomplete="OFF">
                            </div>
                            <input type="hidden" id="station_id" name="station_id">
                            <button type="submit" class="btn btn-primary" name="station_update">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Withdrawal Reason Modification Modal -->
        <div class="modal fade" id="editReasonModal" tabindex="-1" aria-labelledby="editReasonModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editReasonModalLabel">Edit Withdrawal Reason</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="../../controller/data.php">
                            <div class="mb-3">
                                <label for="withdrawalReason" class="form-label">Withdrawal Reason</label>
                                <input type="text" class="form-control" id="withdrawalReason" name="withdrawal_reason"
                                    required autocomplete="OFF">
                            </div>
                            <input type="hidden" id="reason_id" name="reason_id">
                            <button type="submit" class="btn btn-primary" name="reason_update">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>

<script>
    $(document).ready(function () {

        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = urlParams.get('tab') || 'machine';
        $('.nav-link').removeClass('active');
        $('.tab-pane').removeClass('show active');
        $(`#${activeTab}-tab`).addClass('active');
        $(`#${activeTab}-tab-pane`).addClass('show active');

        // SEARCH MACHINE NUMBER
        $('#search_machine').on('input', function () {
            var searchTerm = $(this).val().toLowerCase();
            $('#data-table-machine tr').each(function () {
                var rowText = $(this).text().toLowerCase();
                if (rowText.indexOf(searchTerm) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        });

        // MODIFICATION MACHINE NUMBER
        $(document).on('click', '.btn-edit', function () {
            const machineNumber = $(this).data('machine');
            const machineId = $(this).data('id');
            $('#machineNumber').val(machineNumber);
            $('#machine_id').val(machineId);
            $('#editModal').modal('show');
        });

        // DELETION MACHINE NUMBER
        $(document).on('click', '.btn-delete', function () {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../../controller/data.php?machine_id=' + encodeURIComponent(id);
                }
            });
        });

        // SEARCH STATION CODE
        $('#search_station').on('input', function () {
            var searchTerm = $(this).val().toLowerCase();
            $('#data-table-station tr').each(function () {
                var rowText = $(this).text().toLowerCase();
                if (rowText.indexOf(searchTerm) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        });

        // MODIFICATION STATION CODE
        $(document).on('click', '.station-edit', function () {
            const stationCode = $(this).data('station');
            const stationId = $(this).data('id');
            $('#stationCode').val(stationCode);
            $('#station_id').val(stationId);
            $('#editStationModal').modal('show');
        });

        // DELETION STATION CODE
        $(document).on('click', '.station-delete', function () {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../../controller/data.php?station_id=' + encodeURIComponent(id);
                }
            });
        });

        // SEARCH WITHDRAWAL REASON
        $('#search_reason').on('input', function () {
            var searchTerm = $(this).val().toLowerCase();
            $('#data-table-reason tr').each(function () {
                var rowText = $(this).text().toLowerCase();
                if (rowText.indexOf(searchTerm) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        });

        // MODIFICATION MACHINE NUMBER
        $(document).on('click', '.reason-edit', function () {
            const withdrawalReason = $(this).data('reason');
            const reasonId = $(this).data('id');
            $('#withdrawalReason').val(withdrawalReason);
            $('#reason_id').val(reasonId);
            $('#editReasonModal').modal('show');
        });

        // DELETION MACHINE NUMBER
        $(document).on('click', '.reason-delete', function () {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../../controller/data.php?reason_id=' + encodeURIComponent(id);
                }
            });
        });

    });
</script>