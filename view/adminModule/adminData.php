<?php

include "../../model/dbconnection.php";
include "navBar.php";

?>

<head>

    <title>Expired Part History</title>
    <link rel="stylesheet" href="../../public/css/table.css">
    <script src="../../public/js/jquery.js"></script>
    <script src="../../public/js/excel.js"></script>

</head>

<section style="max-height: 90%;">

    <div class="container">

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
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="unit-tab" data-bs-toggle="tab" data-bs-target="#unit-tab-pane"
                    type="button" role="tab" aria-controls="unit-tab-pane" aria-selected="false">Unit of
                    Measure</button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">

            <!-- MACHINE NUMBER -->
            <div class="tab-pane fade" id="machine-tab-pane" role="tabpanel" aria-labelledby="machine-tab" tabindex="0">
                <div class="container">

                    <div class="d-flex justify-content-evenly  align-items-center w-100 p-3">

                        <input type="text" class="form-control w-25 me-2 table-search"
                            data-target-table="#data-table-machine" placeholder="Search here" autocomplete="off"
                            id="search_machine" placeholder="Machine Number" />
                        <button type="button" class="btn btn-success w-auto" data-bs-toggle="modal"
                            data-bs-target="#addMachineModal">Register Machine</button>
                        <button class="btn btn-primary w-auto " id="update_machine-btn">Update Machine</button>
                        <button class="btn btn-danger w-auto " id="delete_machine-btn">Delete Machine</button>

                    </div>

                    <table class="table table-striped w-100">
                        <thead>
                            <tr class="text-center"
                                style="background-color: #900008; color: white; vertical-align: middle;">
                                <th scope="col"><input type="checkbox" id="select-all-machine" class="select-all"
                                        data-target-table="#data-table-machine" data-target-class=".select-machine">
                                </th>
                                <th>Machine Number</th>
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
                                        <td data-label="Select">
                                            <input type="checkbox" class="select-machine"
                                                data-id="<?php echo $machineRow['id']; ?>"
                                                data-machine_number="<?php echo $machineRow['machine_number']; ?>">
                                        </td>
                                        <td data-label="Machine Number"><?php echo $machineRow['machine_number']; ?></td>
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
                    <div class="d-flex justify-content-evenly  align-items-center w-100 p-3">

                        <input type="text" class="form-control w-25 me-2 table-search"
                            data-target-table="#data-table-station" placeholder="Search here" autocomplete="off"
                            id="search_station" placeholder="Station Code" />
                        <button type="button" class="btn btn-success w-auto" data-bs-toggle="modal"
                            data-bs-target="#addStationModal">Register Station Code</button>
                        <button class="btn btn-primary w-auto " id="update_station-btn">Update Station Code</button>
                        <button class="btn btn-danger w-auto " id="delete_station-btn">Delete Station Code</button>

                    </div>
                    <table class="table table-striped w-100">
                        <thead>
                            <tr class="text-center"
                                style="background-color: #900008; color: white; vertical-align: middle;">
                                <th scope="col"><input type="checkbox" id="select-all-station" class="select-all"
                                        data-target-table="#data-table-station" data-target-class=".select-station">
                                </th>
                                <th>Station Code</th>
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
                                        <td data-label="Select">
                                            <input type="checkbox" class="select-station"
                                                data-id="<?php echo $stationRow['id']; ?>"
                                                data-station_code="<?php echo $stationRow['station_code']; ?>">
                                        </td>
                                        <td data-label="Station Code"><?php echo $stationRow['station_code']; ?></td>
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

                    <div class="d-flex justify-content-evenly  align-items-center w-100 p-3">

                        <input type="text" class="form-control w-25 me-2 table-search"
                            data-target-table="#data-table-reason" placeholder="Search here" autocomplete="off"
                            id="search_withdraw" />
                        <button type="button" class="btn btn-success w-auto" data-bs-toggle="modal"
                            data-bs-target="#addWithdrawModal">Register Withdrawal Reason</button>
                        <button class="btn btn-primary w-auto " id="update_withdraw-btn">Update Withdrawal
                            Reason</button>
                        <button class="btn btn-danger w-auto " id="delete_withdraw-btn">Delete Withdrawal
                            Reason</button>

                    </div>
                    <table class="table table-striped w-100">
                        <thead>
                            <tr class="text-center"
                                style="background-color: #900008; color: white; vertical-align: middle;">
                                <th scope="col"><input type="checkbox" id="select-all-withdraw" class="select-all"
                                        data-target-table="#data-table-reason" data-target-class=".select-withdraw">
                                </th>
                                <th>Withdrawal Reason</th>
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
                                        <td data-label="Select">
                                            <input type="checkbox" class="select-withdraw"
                                                data-id="<?php echo $reasonRow['id']; ?>"
                                                data-withdrawal_reason="<?php echo $reasonRow['reason']; ?>">
                                        </td>
                                        <td data-label="Withdrawal Reason"><?php echo $reasonRow['reason']; ?></td>
                                    </tr>

                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- UNIT -->
            <div class="tab-pane fade" id="unit-tab-pane" role="tabpanel" aria-labelledby="unit-tab" tabindex="0">
                <div class="container">
                    <div class="d-flex justify-content-evenly  align-items-center w-100 p-3">

                        <input type="text" class="form-control w-25 me-2 table-search"
                            data-target-table="#data-table-unit" placeholder="Search here" autocomplete="off"
                            id="search_unit" />
                        <button type="button" class="btn btn-success w-auto" data-bs-toggle="modal"
                            data-bs-target="#addUnitModal">Register Unit of Measure</button>
                        <button class="btn btn-primary w-auto " id="update_unit-btn">Update Unit of Measure</button>
                        <button class="btn btn-danger w-auto " id="delete_unit-btn">Delete Unit of Measure</button>

                    </div>
                    <table class="table table-striped w-100">
                        <thead>
                            <tr class="text-center"
                                style="background-color: #900008; color: white; vertical-align: middle;">
                                <th scope="col"><input type="checkbox" id="select-all-unit" class="select-all"
                                        data-target-table="#data-table-unit" data-target-class=".select-unit"></th>
                                <th>Unit of Measure</th>
                            </tr>
                        </thead>
                        <tbody id="data-table-unit">
                            <?php
                            $unit_sql = "SELECT * FROM `tbl_unit`";
                            $unit_query = mysqli_query($con, $unit_sql);
                            if (mysqli_num_rows($unit_query) > 0) {
                                while ($unitRow = mysqli_fetch_Assoc($unit_query)) {
                                    ?>
                                    <tr class="table-row text-center" style="vertical-align: middle;">
                                        <td data-label="Select">
                                            <input type="checkbox" class="select-unit" data-id="<?php echo $unitRow['id']; ?>"
                                                data-unit="<?php echo $unitRow['unit']; ?>">
                                        </td>
                                        <td data-label="Unit"><?php echo strtoupper($unitRow['unit']); ?></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="8" class="text-center">No Unit of Measure found</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Register Machine Modal -->
        <div class="modal fade" id="addMachineModal" tabindex="-1" aria-labelledby="addMachineModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addMachineModalLabel">Machine Number Registration</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-4 d-flex flex-wrap gap-3 align-items-stretch justify-content-evenly">
                            <div class="d-flex flex-column justify-content-end" style="min-width: 200px;">
                                <button class="btn btn-success" id="btnAddMachineRow">Add Row</button>
                            </div>
                        </div>

                        <div class="table-responsive overflow-x-auto">
                            <table class="table table-striped table-bordered text-center w-100" id="machineTable">
                                <thead>
                                    <tr class="text-center"
                                        style="background-color: #900008; color: white; vertical-align: middle;">
                                        <th>Machine Number</th>
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
                        <button type="submit" class="btn btn-primary" id="machineSubmit"
                            name="submit_machine">Submit</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- Update Machine Modal -->
        <div class="modal fade" id="updateMachineModal" tabindex="-1" aria-labelledby="updateMachineModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateMachineModalLabel">Modification of Selected Machines</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateMachineForm">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="text-center text-white" style="background-color: #900008;">
                                        <tr style="vertical-align: middle;">
                                            <th>Machine Number</th>
                                        </tr>
                                    </thead>
                                    <tbody id="modalUpdateMachineList">
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="button" class="btn btn-secondary me-2"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary"
                                    name="updatemachine_submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Machine Modal -->
        <div class="modal fade" id="deleteMachineModal" tabindex="-1" aria-labelledby="deleteMachineModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteMachineModalLabel">Deletion of Selected Machines</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="deleteMachineForm">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="text-center text-white" style="background-color: #900008;">
                                        <tr style="vertical-align: middle;">
                                            <th>Machine Number</th>
                                            <th>Reasons</th>
                                        </tr>
                                    </thead>
                                    <tbody id="modalDeleteMachineList">
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="button" class="btn btn-secondary me-2"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger" name="deletemachine_submit">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Register Station Code Modal -->
        <div class="modal fade" id="addStationModal" tabindex="-1" aria-labelledby="addStationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStationModalLabel">Station Code Registration</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-4 d-flex flex-wrap gap-3 align-items-stretch justify-content-evenly">
                            <div class="d-flex flex-column justify-content-end" style="min-width: 200px;">
                                <button class="btn btn-success" id="btnAddStationRow">Add Row</button>
                            </div>
                        </div>

                        <div class="table-responsive overflow-x-auto">
                            <table class="table table-striped table-bordered text-center w-100" id="stationTable">
                                <thead>
                                    <tr class="text-center"
                                        style="background-color: #900008; color: white; vertical-align: middle;">
                                        <th>Station Code</th>
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
                        <button type="submit" class="btn btn-success" id="stationSubmit"
                            name="submit_station">Register</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- Update Station Code Modal -->
        <div class="modal fade" id="updateStationModal" tabindex="-1" aria-labelledby="updateStationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateStationModalLabel">Modification of Selected Station Codes</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateStationForm">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="text-center text-white" style="background-color: #900008;">
                                        <tr style="vertical-align: middle;">
                                            <th>Station Code</th>
                                        </tr>
                                    </thead>
                                    <tbody id="modalUpdateStationList">
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="button" class="btn btn-secondary me-2"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary"
                                    name="updatestation_submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Machine Modal -->
        <div class="modal fade" id="deleteStationModal" tabindex="-1" aria-labelledby="deleteStationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteStationModalLabel">Deletion of Selected Station Codes</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="deleteStationForm">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="text-center text-white" style="background-color: #900008;">
                                        <tr style="vertical-align: middle;">
                                            <th>Station Code</th>
                                            <th>Reasons</th>
                                        </tr>
                                    </thead>
                                    <tbody id="modalDeleteStationList">
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="button" class="btn btn-secondary me-2"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger" name="deletestation_submit">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Register Withdrawal Reason Modal -->
        <div class="modal fade" id="addWithdrawModal" tabindex="-1" aria-labelledby="addWithdrawModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addWithdrawModalLabel">Withdrawal Reason Registration</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-4 d-flex flex-wrap gap-3 align-items-stretch justify-content-evenly">
                            <div class="d-flex flex-column justify-content-end" style="min-width: 200px;">
                                <button class="btn btn-success" id="btnAddWithdrawRow">Add Row</button>
                            </div>
                        </div>

                        <div class="table-responsive overflow-x-auto">
                            <table class="table table-striped table-bordered text-center w-100" id="withdrawTable">
                                <thead>
                                    <tr class="text-center"
                                        style="background-color: #900008; color: white; vertical-align: middle;">
                                        <th>Withdrawal Reason</th>
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
                        <button type="submit" class="btn btn-success" id="withdrawSubmit"
                            name="submit_withdraw">Register</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- Update Station Code Modal -->
        <div class="modal fade" id="updateWithdrawModal" tabindex="-1" aria-labelledby="updateWithdrawModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateWithdrawModalLabel">Modification of Selected Withdrawal
                            Reasons</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateWithdrawForm">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="text-center text-white" style="background-color: #900008;">
                                        <tr style="vertical-align: middle;">
                                            <th>Withdrawal Reasons</th>
                                        </tr>
                                    </thead>
                                    <tbody id="modalUpdateWithdrawList">
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="button" class="btn btn-secondary me-2"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary"
                                    name="updatewithdraw_submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Machine Modal -->
        <div class="modal fade" id="deleteWithdrawModal" tabindex="-1" aria-labelledby="deleteWithdrawModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteWithdrawModalLabel">Deletion of Selected Withdrawal Reasons
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="deleteWithdrawForm">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="text-center text-white" style="background-color: #900008;">
                                        <tr style="vertical-align: middle;">
                                            <th>Withdrawal Reasons</th>
                                            <th>Reasons</th>
                                        </tr>
                                    </thead>
                                    <tbody id="modalDeleteWithdrawList">
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="button" class="btn btn-secondary me-2"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger"
                                    name="deletewithdraw_submit">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Register Unit of Measure Modal -->
        <div class="modal fade" id="addUnitModal" tabindex="-1" aria-labelledby="addUnitModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUnitModalLabel">Unit Registration</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-4 d-flex flex-wrap gap-3 align-items-stretch justify-content-evenly">
                            <div class="d-flex flex-column justify-content-end" style="min-width: 200px;">
                                <button class="btn btn-success" id="btnAddUnitRow">Add Row</button>
                            </div>
                        </div>

                        <div class="table-responsive overflow-x-auto">
                            <table class="table table-striped table-bordered text-center w-100" id="unitTable">
                                <thead>
                                    <tr class="text-center"
                                        style="background-color: #900008; color: white; vertical-align: middle;">
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
                        <button type="submit" class="btn btn-success" id="unitSubmit"
                            name="submit_unit">Register</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- Update Unit of Measure Modal -->
        <div class="modal fade" id="updateUnitModal" tabindex="-1" aria-labelledby="updateUnitModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateUnitModalLabel">Modification of Selected Unit of Measure</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateUnitForm">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="text-center text-white" style="background-color: #900008;">
                                        <tr style="vertical-align: middle;">
                                            <th>Unit of Measures</th>
                                        </tr>
                                    </thead>
                                    <tbody id="modalUpdateUnitList">
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="button" class="btn btn-secondary me-2"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary" name="updateunit_submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Unit of Measures Modal -->
        <div class="modal fade" id="deleteUnitModal" tabindex="-1" aria-labelledby="deleteUnitModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteUnitModalLabel">Deletion of Selected Unit of Measures</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="deleteUnitForm">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="text-center text-white" style="background-color: #900008;">
                                        <tr style="vertical-align: middle;">
                                            <th>Unit of Measures</th>
                                            <th>Reasons</th>
                                        </tr>
                                    </thead>
                                    <tbody id="modalDeleteUnitList">
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="button" class="btn btn-secondary me-2"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger" name="deleteunit_submit">Delete</button>
                            </div>
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

        // Search Input for Data Management
        $('.table-search').on('input', function () {
            var searchTerm = $(this).val().toLowerCase();
            var tableSelector = $(this).data('target-table');

            $(tableSelector + ' tr').each(function () {
                var rowText = $(this).text().toLowerCase();
                $(this).toggle(rowText.indexOf(searchTerm) !== -1);
            });
        });

        // Select All for Data Management
        $('.select-all').on('change', function () {
            var isChecked = $(this).prop('checked');
            var targetTable = $(this).data('target-table');
            var targetClass = $(this).data('target-class');

            $(targetTable + ' tr:visible').each(function () {
                $(this).find(targetClass).prop('checked', isChecked);
            });
        });

        // Form Submission for Data Management
        function handleFormSubmission(formSelector, actionType, successMessage, redirectUrl, errorMessage) {
            $(formSelector).submit(function (e) {
                e.preventDefault();

                let formData = $(this).serialize();
                formData += `&${actionType}=1`;

                $.ajax({
                    url: '../../controller/data.php',
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: successMessage,
                                confirmButtonText: 'Ok'
                            }).then(() => {
                                window.location.href = redirectUrl;
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.error || errorMessage,
                                confirmButtonText: 'Ok'
                            });
                        }
                    }
                });
            });
        }

        // Machine Number for Update
        handleFormSubmission("#updateMachineForm", "updatemachine_submit", "Machines updated successfully!", "adminData.php?tab=machine", "An unexpected error occurred while updating.");

        // Machine Number for Deletion
        handleFormSubmission("#deleteMachineForm", "deletemachine_submit", "Machines deleted successfully!", "adminData.php?tab=machine", "An unexpected error occurred while deleting.");

        // Station Code for Update
        handleFormSubmission("#updateStationForm", "updatestation_submit", "Station Codes updated successfully!", "adminData.php?tab=station", "An unexpected error occurred while updating.");

        // Station Code for Deletion
        handleFormSubmission("#deleteStationForm", "deletestation_submit", "Station Codes deleted successfully!", "adminData.php?tab=station", "An unexpected error occurred while deleting.");

        // Withdrawal Reasons for Update
        handleFormSubmission("#updateWithdrawForm", "updatewithdraw_submit", "Withdrawal Reasons updated successfully!", "adminData.php?tab=withdraw", "An unexpected error occurred while updating.");

        // Withdrawal Reasons for Deletion
        handleFormSubmission("#deleteWithdrawForm", "deletewithdraw_submit", "Withdrawal Reasons deleted successfully!", "adminData.php?tab=withdraw", "An unexpected error occurred while deleting.");

        // Measure of Units for Update
        handleFormSubmission("#updateUnitForm", "updateunit_submit", "Unit of Measures updated successfully!", "adminData.php?tab=unit", "An unexpected error occurred while updating.");

        // Measure of Units for Deletion
        handleFormSubmission("#deleteUnitForm", "deleteunit_submit", "Unit of Measures deleted successfully!", "adminData.php?tab=unit", "An unexpected error occurred while deleting.");

        // Open Modals for Data Management
        function openModalForItems(config) {
            const {
                triggerBtn,
                modalId,
                tableBodyId,
                checkboxClass,
                dataKey,
                inputName,
                placeholderText,
                isUpdate = true
            } = config;

            $(triggerBtn).click(function () {
                const $tableBody = $(tableBodyId).empty();
                const selectedItems = $(`.${checkboxClass}:checked`);

                if (selectedItems.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: `No ${dataKey.replace('_', ' ')}s selected`,
                        text: `Please select at least one ${dataKey.replace('_', ' ')} to ${isUpdate ? "update" : "delete"}.`,
                        confirmButtonText: 'Ok'
                    });
                    return;
                }

                selectedItems.each(function () {
                    const id = $(this).data("id");
                    const value = $(this).data(dataKey);

                    const row = isUpdate ? `
                        <tr class="text-center" style="vertical-align: middle;">
                            <td>
                                <input type="text" class="form-control" name="${inputName}" autocomplete="off" value="${value}" required placeholder="${placeholderText}">
                            </td>
                            <td style="display:none;">
                                <input type="hidden" name="ids[]" value="${id}">
                            </td>
                        </tr>` : `
                        <tr class="text-center" style="vertical-align: middle;">
                            <td>${value}</td>
                            <td>
                                <input type="text" class="form-control" name="reasons[]" autocomplete="off" placeholder="Reason for deletion">
                            </td>
                            <td style="display:none;">
                                <input type="hidden" name="ids[]" value="${id}">
                                <input type="hidden" name="${inputName}" value="${value}">
                            </td>
                        </tr>`;

                    $tableBody.append(row);
                });

                $(modalId).modal("show");
            });
        }

        // Machine Numbers for Update
        openModalForItems({
            triggerBtn: "#update_machine-btn",
            modalId: "#updateMachineModal",
            tableBodyId: "#modalUpdateMachineList",
            checkboxClass: "select-machine",
            dataKey: "machine_number",
            inputName: "machineNumbers[]",
            placeholderText: "Enter Machine Number",
            isUpdate: true
        });

        // Machine Numbers for Deletion
        openModalForItems({
            triggerBtn: "#delete_machine-btn",
            modalId: "#deleteMachineModal",
            tableBodyId: "#modalDeleteMachineList",
            checkboxClass: "select-machine",
            dataKey: "machine_number",
            inputName: "machineNumbers[]",
            placeholderText: "Enter Machine Number",
            isUpdate: false
        });

        // Station Codes for Update
        openModalForItems({
            triggerBtn: "#update_station-btn",
            modalId: "#updateStationModal",
            tableBodyId: "#modalUpdateStationList",
            checkboxClass: "select-station",
            dataKey: "station_code",
            inputName: "stationCodes[]",
            placeholderText: "Enter Station Code",
            isUpdate: true
        });

        // Station Codes for Deletion
        openModalForItems({
            triggerBtn: "#delete_station-btn",
            modalId: "#deleteStationModal",
            tableBodyId: "#modalDeleteStationList",
            checkboxClass: "select-station",
            dataKey: "station_code",
            inputName: "stationCodes[]",
            placeholderText: "Enter Station Code",
            isUpdate: false
        });

        // Withdrawal Reasons for Update
        openModalForItems({
            triggerBtn: "#update_withdraw-btn",
            modalId: "#updateWithdrawModal",
            tableBodyId: "#modalUpdateWithdrawList",
            checkboxClass: "select-withdraw",
            dataKey: "withdrawal_reason",
            inputName: "withdrawReasons[]",
            placeholderText: "Enter Withdrawal Reason",
            isUpdate: true
        });

        // Withdrawal Reasons for Deletion
        openModalForItems({
            triggerBtn: "#delete_withdraw-btn",
            modalId: "#deleteWithdrawModal",
            tableBodyId: "#modalDeleteWithdrawList",
            checkboxClass: "select-withdraw",
            dataKey: "withdrawal_reason",
            inputName: "withdrawReasons[]",
            placeholderText: "Enter Withdrawal Reason",
            isUpdate: false
        });

        // Unit of Measures for Update
        openModalForItems({
            triggerBtn: "#update_unit-btn",
            modalId: "#updateUnitModal",
            tableBodyId: "#modalUpdateUnitList",
            checkboxClass: "select-unit",
            dataKey: "unit",
            inputName: "unitMeasures[]",
            placeholderText: "Enter Unit of Measures",
            isUpdate: true
        });

        // Unit of Measures for Deletion
        openModalForItems({
            triggerBtn: "#delete_unit-btn",
            modalId: "#deleteUnitModal",
            tableBodyId: "#modalDeleteUnitList",
            checkboxClass: "select-unit",
            dataKey: "unit",
            inputName: "unitMeasures[]",
            placeholderText: "Enter Unit of Measures",
            isUpdate: false
        });


        // Add Row Function for Data Management
        function addRow(tableId, inputName, placeholder) {
            const row = $("<tr></tr>");
            row.append(`
                <td>
                    <input type="text" name="${inputName}" class="form-control text-uppercase" placeholder="${placeholder}" autocomplete="off" required>
                </td>
                <td>
                    <button class="btn btn-danger" onclick="this.closest('tr').remove()">Delete</button>
                </td>
            `);
            $(tableId).find("tbody").append(row);
        }

        // Submit Function for Data Management
        function submitData(submitBtnId, tableId, submitParam, successCallback) {
            $(submitBtnId).on("click", function (e) {
                e.preventDefault();

                let data = [];
                let valid = true;

                $(tableId).find("tbody tr").each(function () {
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
                    url: "../../controller/data.php",
                    method: "POST",
                    contentType: "application/json",
                    dataType: "json",
                    data: JSON.stringify({
                        [submitParam]: true,
                        items: data
                    }),

                    success: res => {
                        if (res.duplicates) {
                            Swal.fire({
                                icon: 'error',
                                title: `${submitParam} Duplicate(s)`,
                                text: `The following already exist: ${res.duplicates.join(", ")}`
                            });
                        } else if (res.message) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: res.message
                            }).then(() => {
                                successCallback(res);
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message || 'Something went wrong.'
                            });
                        }
                    },

                    error: (xhr, status, error) => {
                        Swal.fire("Error!", "There was an issue with the server request. Please try again.", "error");
                        console.error(error);
                    }
                });
            });
        }

        // Add Row for Machine Numbers Tab
        $("#btnAddMachineRow").on("click", function () {
            addRow("#machineTable", "machineNumber", "Machine Number");
        });

        // Add Row for Station Codes Tab
        $("#btnAddStationRow").on("click", function () {
            addRow("#stationTable", "stationCode", "Station Code");
        });

        // Add Row for Withdrawal Reasons Tab
        $("#btnAddWithdrawRow").on("click", function () {
            addRow("#withdrawTable", "withdrawReason", "Withdrawal Reason");
        });

        // Add Row for Unit of Measure Tab
        $("#btnAddUnitRow").on("click", function () {
            addRow("#unitTable", "unit", "Unit of Measure");
        });

        // Submit Machine Numbers Data
        submitData("#machineSubmit", "#machineTable", "machineSubmit", function (res) {
            location.reload();
        });

        // Submit Station Codes Data
        submitData("#stationSubmit", "#stationTable", "stationSubmit", function (res) {
            window.location.href = 'adminData.php?tab=station';
        });

        // Submit Withdrawal Reasons Data
        submitData("#withdrawSubmit", "#withdrawTable", "withdrawSubmit", function (res) {
            window.location.href = 'adminData.php?tab=withdraw';
        });

        // Submit Unit of Measures Data
        submitData("#unitSubmit", "#unitTable", "unitSubmit", function (res) {
            window.location.href = 'adminData.php?tab=unit';
        });

    });
</script>