<?php
ob_start();

include "../../model/dbconnection.php";
include "navBar.php";

$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode("/", $path);
$page = $components[4];

if ($_SESSION['user'] == 'Kitting') {
    $_SESSION['status'] = "The link is for admin only.";
    $_SESSION['status_code'] = "error";
    header("Location: adminDashboard.php");
    exit();
}

ob_end_flush();

?>


<head>

    <title>Acoount Registration</title>
    <link rel="stylesheet" href="../../public/css/table.css">
    <link rel="stylesheet" href="../../public/css/sweetalert.min.css">
    <script src="../../public/js/sweetalert2@11.js"></script>
    <script src="../../public/js/jquery.js"></script>

    <style>
        #accountTable tr td input,
        #accountTable tr td select,
        #accountTable tr td span {
            min-width: max-content;
        }
    </style>

</head>

<section>

    <div class="mx-5">

        <div class="welcomeDiv my-4">
            <h2 class="text-center" style="color: #900008; font-weight: bold;">Account Registration</h2>
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="approval-tab" data-bs-toggle="tab"
                    data-bs-target="#approval-tab-pane" type="button" role="tab" aria-controls="approval-tab-pane"
                    aria-selected="true">Account Approval</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link " id="password-tab" data-bs-toggle="tab" data-bs-target="#password-tab-pane"
                    type="button" role="tab" aria-controls="password-tab-pane" aria-selected="true">Update Account
                    Password</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link " id="account-tab" data-bs-toggle="tab" data-bs-target="#account-tab-pane"
                    type="button" role="tab" aria-controls="account-tab-pane" aria-selected="true">Account
                    Records</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="costcenter-tab" data-bs-toggle="tab" data-bs-target="#costcenter-tab-pane"
                    type="button" role="tab" aria-controls="costcenter-tab-pane" aria-selected="false">Cost Center /
                    Supervisor</button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">

            <!-- ACCOUNT APPROVAL -->
            <div class="tab-pane fade" id="approval-tab-pane" role="tabpanel" aria-labelledby="approval-tab">

                <div class="d-flex justify-content-evenly  align-items-center w-100 p-3">
                    <input type="text" id="search" class="form-control w-25 me-2" placeholder="Search here"
                        autocomplete="off" />
                    <button class="btn btn-success w-auto " id="approve_acc-btn">Approve Accounts</button>
                    <button class="btn btn-danger w-auto" id="reject_acc-btn">Reject Accounts</button>
                </div>

                <table class="table table-striped w-100">

                    <thead>
                        <tr class="text-center" style="background-color: #900008; color: white;">
                            <th scope="col"><input type="checkbox" id="select-all"></th>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Badge No.</th>
                            <th scope="col">Cost Center</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Supervisor</th>
                            <th scope="col">Account Type</th>

                        </tr>
                    </thead>

                    <tbody id="data-table">
                        <?php
                        $userName = $_SESSION['username'];
                        $sql = "SELECT * FROM tbl_users WHERE usertype = '1'";
                        $sql_query = mysqli_query($con, $sql);

                        if (mysqli_num_rows($sql_query) > 0) {
                            while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                                ?>
                                <tr class="table-row text-center" style="vertical-align:middle;">
                                    <td data-label="Select">
                                        <input type="checkbox" class="select-row" data-id="<?php echo $sqlRow['id']; ?>"
                                            data-employee_name="<?php echo $sqlRow['employee_name']; ?>"
                                            data-badge_number="<?php echo $sqlRow['badge_number']; ?>"
                                            data-cost_center="<?php echo $sqlRow['cost_center']; ?>"
                                            data-designation="<?php echo $sqlRow['designation']; ?>"
                                            data-account_type="<?php echo $sqlRow['account_type']; ?>">
                                    </td>
                                    <td data-label="Employee Name"><?php echo $sqlRow['employee_name']; ?></td>
                                    <td data-label="Username"><?php echo $sqlRow['username']; ?></td>
                                    <td data-label="Badge No."><?php echo $sqlRow['badge_number']; ?></td>
                                    <td data-label="Cost Center"><?php echo $sqlRow['cost_center']; ?></td>
                                    <td data-label="Designation"><?php echo $sqlRow['designation']; ?></td>
                                    <td data-label="Supervisor">
                                        <?php
                                        echo $sqlRow['supervisor_one'];
                                        if (!empty($sqlRow['supervisor_two'])) {
                                            echo ' / ' . $sqlRow['supervisor_two'];
                                        }
                                        ?>
                                    </td>
                                    <td data-label="Account Type"><?php echo $sqlRow['account_type']; ?></td>

                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="8" class="text-center">No users found</td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr class="no-results text-center" style="display: none;">
                            <td colspan="8">No results found.</td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <!-- ACCOUNT PASSWORD -->
            <div class="tab-pane fade" id="password-tab-pane" role="tabpanel" aria-labelledby="password-tab">

                <div class="d-flex justify-between-center w-100 my-3">
                    <input type="text" id="search_pass" class="form-control w-50 mx-auto"
                        placeholder="Search username here" autocomplete="off" />
                </div>

                <table class="table table-striped w-100">

                    <thead>
                        <tr class="text-center" style="background-color: #900008; color: white;">
                            <th scope="col">Employee Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Badge No.</th>
                            <th scope="col">Cost Center</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Supervisor</th>
                            <th scope="col">Account Type</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody id="data-table-pass">
                        <?php
                        $userName = $_SESSION['username'];
                        $sql = "SELECT * FROM tbl_users WHERE forgot_pass = '1'";
                        $sql_query = mysqli_query($con, $sql);

                        if (mysqli_num_rows($sql_query) > 0) {
                            while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                                ?>
                                <tr class="table-row text-center" style="vertical-align:middle;">
                                    <td data-label="Employee Name"><?php echo $sqlRow['employee_name']; ?></td>
                                    <td data-label="Username"><?php echo $sqlRow['username']; ?></td>
                                    <td data-label="Badge No."><?php echo $sqlRow['badge_number']; ?></td>
                                    <td data-label="Cost Center"><?php echo $sqlRow['cost_center']; ?></td>
                                    <td data-label="Designation"><?php echo $sqlRow['designation']; ?></td>
                                    <td data-label="Supervisor">
                                        <?php
                                        echo $sqlRow['supervisor_one'];
                                        if (!empty($sqlRow['supervisor_two'])) {
                                            echo ' / ' . $sqlRow['supervisor_two'];
                                        }
                                        ?>
                                    </td>
                                    <td data-label="Account Type"><?php echo $sqlRow['account_type']; ?></td>
                                    <td data-label="Action">

                                        <button class="btn btn-success edit-pass" data-bs-toggle="modal"
                                            data-bs-target="#change_pass_modal" data-id="<?php echo $sqlRow['id']; ?>"
                                            data-username="<?php echo $sqlRow['username']; ?>">Change
                                            Password</button>

                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="8" class="text-center">No users found.</td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr class="no-results text-center" style="display: none;">
                            <td colspan="8">No results found.</td>
                        </tr>
                    </tbody>

                </table>

            </div>

            <!-- ACCOUNT CREATION -->
            <div class="tab-pane fade" id="account-tab-pane" role="tabpanel" aria-labelledby="account-tab">

                <div class="d-flex justify-content-evenly  align-items-center w-100 p-3">
                    <input type="text" id="search_account" class="form-control w-25 me-2" placeholder="Search here"
                        autocomplete="off" />
                    <button type="button" class="btn btn-success w-auto" data-bs-toggle="modal"
                        data-bs-target="#accountModal">
                        Account Registration
                    </button>
                    <button class="btn btn-primary w-auto" id="update_acc-btn">Update Accounts</button>
                    <button class="btn btn-danger w-auto" id="delete_acc-btn">Delete Accounts</button>
                </div>
                <?php
                $userName = $_SESSION['username'];
                $limit = 50;
                $offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
                $sql = "SELECT *
                               FROM tbl_users WHERE usertype = '2' LIMIT $limit OFFSET $offset";
                $sql_query = mysqli_query($con, $sql);

                $total_query = mysqli_query($con, "SELECT COUNT(*) AS total FROM tbl_users WHERE usertype = '2'");
                $total_row = mysqli_fetch_assoc($total_query);
                $total_records = $total_row['total'];
                ?>

                <table class="table table-striped w-100">
                    <thead>
                        <tr class="text-center" style="background-color: #900008; color: white;">
                            <th scope="col"><input type="checkbox" id="select-all-account"></th>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Badge No.</th>
                            <th scope="col">Cost Center</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Supervisor</th>
                            <th scope="col">Account Type</th>
                        </tr>
                    </thead>
                    <tbody id="data-table-account">
                        <?php


                        if (mysqli_num_rows($sql_query) > 0) {
                            while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                                ?>
                                <tr class="table-row text-center" style="vertical-align:middle;">
                                    <td data-label="Select">
                                        <input type="checkbox" class="select-acc" data-id="<?php echo $sqlRow['id']; ?>"
                                            data-employee_name="<?php echo $sqlRow['employee_name']; ?>"
                                            data-username="<?php echo $sqlRow['username']; ?>"
                                            data-badge_number="<?php echo $sqlRow['badge_number']; ?>"
                                            data-cost_center="<?php echo $sqlRow['cost_center']; ?>"
                                            data-designation="<?php echo $sqlRow['designation']; ?>"
                                            data-account_type="<?php echo $sqlRow['account_type']; ?>">
                                    </td>
                                    <td data-label="Employee Name"><?php echo $sqlRow['employee_name']; ?></td>
                                    <td data-label="Username"><?php echo $sqlRow['username']; ?></td>
                                    <td data-label="Badge No."><?php echo $sqlRow['badge_number']; ?></td>
                                    <td data-label="Cost Center"><?php echo $sqlRow['cost_center']; ?></td>
                                    <td data-label="Designation"><?php echo $sqlRow['designation']; ?></td>
                                    <td data-label="Supervisor">
                                        <?php
                                        echo $sqlRow['supervisor_one'];
                                        if (!empty($sqlRow['supervisor_two'])) {
                                            echo ' / ' . $sqlRow['supervisor_two'];
                                        }
                                        ?>
                                    </td>
                                    <td data-label="Account Type"><?php echo $sqlRow['account_type']; ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="8" class="text-center">No users found</td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr class="no-results text-center" style="display: none;">
                            <td colspan="8">No results found.</td>
                        </tr>
                    </tbody>
                </table>

                <div id="loading-msg" class="text-center text-muted mt-3" style="display: none;">
                    Loading more records...
                </div>

            </div>

            <!-- COST CENTER TAB -->
            <div class="tab-pane fade" id="costcenter-tab-pane" role="tabpanel" aria-labelledby="costcenter-tab">
                <div class="d-flex justify-content-between align-items-center w-100 p-3">
                    <input type="text" id="search_cost" class="form-control w-25 me-2" placeholder="Search here"
                        autocomplete="off" />
                    <button type="button" class="btn btn-success w-auto" data-bs-toggle="modal"
                        data-bs-target="#costCenterModal">
                        Cost Center / Supervisor
                    </button>
                    <button class="btn btn-primary w-auto" id="update_cost-btn">
                        Update Cost Center / Supervisor
                    </button>
                    <button class="btn btn-danger w-auto" id="delete_cost-btn">
                        Delete Cost Center / Supervisor
                    </button>
                </div>

                <table class="table table-striped w-100">
                    <thead>
                        <tr class="text-center"
                            style="background-color: #900008; color: white; vertical-align: middle;">
                            <th scope="col"><input type="checkbox" id="select-all-cost"></th>
                            <th scope="col">New CCID</th>
                            <th scope="col">New CCID Name</th>
                            <th scope="col">Project Code</th>
                            <th scope="col">Project</th>
                            <th scope="col">Supervisor</th>
                            <th scope="col">Badge No.</th>
                            <th scope="col">Supervisor</th>
                            <th scope="col">Badge No.</th>
                        </tr>
                    </thead>
                    <tbody id="data-table-cost">
                        <?php
                        $sql_ccs = "SELECT * FROM `tbl_ccs`";
                        $sql_ccs_query = mysqli_query($con, $sql_ccs);
                        if (mysqli_num_rows($sql_ccs_query) > 0) {
                            while ($ccs_row = mysqli_fetch_assoc($sql_ccs_query)) {
                                ?>
                                <tr class="text-center" style="vertical-align:middle;">
                                    <td data-label="Select">
                                        <input type="checkbox" class="select-cost" data-id="<?php echo $ccs_row['id']; ?>"
                                            data-ccid="<?php echo $ccs_row['ccid']; ?>"
                                            data-ccid_name="<?php echo $ccs_row['ccid_name']; ?>"
                                            data-project_code="<?php echo $ccs_row['project_code']; ?>"
                                            data-project_name="<?php echo $ccs_row['project_name']; ?>"
                                            data-badge_one="<?php echo $ccs_row['badge_one']; ?>"
                                            data-badge_two="<?php echo $ccs_row['badge_two']; ?>"
                                            data-supervisor_one="<?php echo $ccs_row['supervisor_one']; ?>"
                                            data-supervisor_two="<?php echo $ccs_row['supervisor_two']; ?>">
                                    </td>
                                    <td data-label="New CCID"><?php echo $ccs_row['ccid'] ?></td>
                                    <td data-label="New CCID Name"><?php echo $ccs_row['ccid_name'] ?></td>
                                    <td data-label="Project Code"><?php echo $ccs_row['project_code'] ?></td>
                                    <td data-label="Project Name"><?php echo $ccs_row['project_name'] ?></td>
                                    <td data-label="Supervisor">
                                        <?php echo $ccs_row['supervisor_one'] ?>
                                    </td>
                                    <td data-label="Badge No.">
                                        <?php echo $ccs_row['badge_one'] ?>
                                    </td>
                                    <td data-label="Supervisor">
                                        <?php echo $ccs_row['supervisor_two'] ?>
                                    </td>
                                    <td data-label="Badge No.">
                                        <?php echo $ccs_row['badge_two'] ?>
                                    </td>

                                </tr>
                                <?php
                            }
                        }
                        ?>
                        <tr class="no-results text-center" style="display: none;">
                            <td colspan="9">No results found.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

    </div>

    <!-- Account Approval Modal -->
    <div class="modal fade" id="accountApprovalModal" tabindex="-1" aria-labelledby="accountApprovalModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accountApprovalModalLabel">Approval of Selected Accounts</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="approveAccForm">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="text-center text-white" style="background-color: #900008;">
                                    <tr style="vertical-align: middle;">
                                        <th>Employee Name</th>
                                        <th>Badge Number</th>
                                        <th>Cost Center</th>
                                        <th>Designation</th>
                                        <th>Account Type</th>
                                    </tr>
                                </thead>
                                <tbody id="modalAccountApprovalList">
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success" name="approveacc_submit">Approve</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Rejection Modal -->
    <div class="modal fade" id="accRejectModal" tabindex="-1" aria-labelledby="accRejectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accRejectModalLabel">Rejection of Selected Accounts</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="rejectAccForm">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="text-center text-white" style="background-color: #900008;">
                                    <tr style="vertical-align: middle;">
                                        <th>Employee Name</th>
                                        <th>Badge Number</th>
                                        <th>Cost Center</th>
                                        <th>Designation</th>
                                        <th>Account Type</th>
                                        <th>Reasons</th>
                                    </tr>
                                </thead>
                                <tbody id="modalAccountRejectionList">
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger" name="rejectacc_submit">Reject</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Creation Modal -->
    <div class="modal fade" id="accountModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 1400px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accountModalLabel">Account Registration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-4 d-flex flex-wrap gap-3 align-items-stretch justify-content-evenly">
                        <div class="d-flex flex-column justify-content-end" style="min-width: 200px;">
                            <button class="btn btn-success" id="btnAddAccountRow">Add Row</button>
                        </div>
                    </div>

                    <div class="table-responsive overflow-x-auto">
                        <table class="table table-striped table-bordered text-center w-100" id="accountTable">
                            <thead>
                                <tr class="text-center"
                                    style="background-color: #900008; color: white; vertical-align: middle;">
                                    <th>Employee Name</th>
                                    <th>Username</th>
                                    <th>Badge Number</th>
                                    <th>Designation</th>
                                    <th>Account Type</th>
                                    <th>Cost Center</th>
                                    <th>Supervisors</th>
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
                    <button type="submit" class="btn btn-primary" id="accountSubmit"
                        name="submit_account">Submit</button>

                </div>
            </div>
        </div>
    </div>

    <!-- Account Deletion Modal -->
    <div class="modal fade" id="accDeletionModal" tabindex="-1" aria-labelledby="accDeletionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accDeletionModalLabel">Deletion of Selected Accounts</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="deleteAccForm">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="text-center text-white" style="background-color: #900008;">
                                    <tr style="vertical-align: middle;">
                                        <th>Employee Name</th>
                                        <th>Username</th>
                                        <th>Badge Number</th>
                                        <th>Cost Center</th>
                                        <th>Designation</th>
                                        <th>Account Type</th>
                                        <th>Reasons</th>
                                    </tr>
                                </thead>
                                <tbody id="modalAccountDeletionList">
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger" name="deleteacc_submit">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Modification Modal -->
    <div class="modal fade" id="accUpdateModal" tabindex="-1" aria-labelledby="accUpdateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 1400px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accUpdateModalLabel">Modification of Selected Accounts</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateAccForm">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="text-center text-white" style="background-color: #900008;">
                                    <tr style="vertical-align: middle;">
                                        <th>Employee Name</th>
                                        <th>Badge Number</th>
                                        <th>Designation</th>
                                        <th>Account Type</th>
                                        <th>Cost Center</th>
                                        <th>Supervisors</th>
                                    </tr>
                                </thead>
                                <tbody id="modalAccountUpdateList">
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" name="updateacc_submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Cost Center Deletion Modal -->
    <div class="modal fade" id="costDeletionModal" tabindex="-1" aria-labelledby="costDeletionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="min-width: 1500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="costDeletionModalLabel">Deletion of Selected Cost Centers</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="deleteCostForm">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="text-center text-white" style="background-color: #900008;">
                                    <tr style="vertical-align: middle;">
                                        <th>CCID</th>
                                        <th>CCID Name</th>
                                        <th>Project Code</th>
                                        <th>Project</th>
                                        <th>Supervisor One</th>
                                        <th>Badge Number</th>
                                        <th>Supervisor Two</th>
                                        <th>Badge Number</th>
                                        <th>Reasons</th>
                                    </tr>
                                </thead>
                                <tbody id="modalCostDeletionList">
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger" name="deletecost_submit">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Cost Center Modification Modal -->
    <div class="modal fade" id="costUpdateModal" tabindex="-1" aria-labelledby="costUpdateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 1400px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="costUpdateModalLabel">Modification of Selected Cost Centers</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateCostForm">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="text-center text-white" style="background-color: #900008;">
                                    <tr style="vertical-align: middle;">
                                        <th>CCID</th>
                                        <th>CCID Name</th>
                                        <th>Project Code</th>
                                        <th>Project</th>
                                        <th>Supervisor One</th>
                                        <th>Badge Number</th>
                                        <th>Supervisor Two</th>
                                        <th>Badge Number</th>
                                    </tr>
                                </thead>
                                <tbody id="modalCostUpdateList">
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" name="updatecost_submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Cost Center Creation Modal -->
    <div class="modal fade" id="costCenterModal" tabindex="-1" aria-labelledby="costCenterModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 1400px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="costCenterModalLabel">Cost Center Registration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-4 d-flex flex-wrap gap-3 align-items-stretch justify-content-evenly">
                        <div class="d-flex flex-column justify-content-end" style="min-width: 200px;">
                            <button class="btn btn-success" id="btnAddCostCenterRow">Add Row</button>
                        </div>
                    </div>

                    <div class="table-responsive overflow-x-auto">
                        <table class="table table-striped table-bordered text-center w-100" id="costCenterTable">
                            <thead>
                                <tr class="text-center"
                                    style="background-color: #900008; color: white; vertical-align: middle;">
                                    <th>CCID</th>
                                    <th>CCID Name</th>
                                    <th>Project Code</th>
                                    <th>Project Name</th>
                                    <th>Supervisor</th>
                                    <th>Badge Number</th>
                                    <th>Supervisor</th>
                                    <th>Badge Number</th>
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
                    <button type="submit" class="btn btn-primary" id="costCenterSubmit"
                        name="submit_costCenter">Submit</button>

                </div>
            </div>
        </div>
    </div>

    <!-- MODAL FOR CHANGE PASSWORD -->
    <div class="modal fade" id="change_pass_modal" tabindex="-1" aria-labelledby="change_pass_modalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="change_pass_modalLabel">Update Account Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../../controller/login.php" method="POST">
                        <input type="hidden" id="forgot_pass_id" name="user_id">
                        <input type="hidden" id="forgot_pass_username" name="user_username">
                        <div class="mb-3">
                            <label for="forgot_pass_one" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="forgot_pass_one" name="new_pass"
                                placeholder="Enter new password" required>
                            <i class="bi bi-eye-slash" id="toggle-new-password" data-toggle="password"
                                data-target="#forgot_pass_one"
                                style="position: absolute; right: 30px; top: 55px; cursor: pointer; background-color: white;"></i>
                        </div>
                        <div class="mb-3">
                            <label for="forgot_pass_two" class="form-label">Re-enter Password</label>
                            <input type="password" class="form-control" id="forgot_pass_two" name="con_pass"
                                placeholder="Re-enter password" required>
                            <i class="bi bi-eye-slash" id="toggle-con-password" data-toggle="password"
                                data-target="#forgot_pass_two"
                                style="position: absolute; right: 30px; top: 140px; cursor: pointer;  background-color: white;"></i>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="type" class="btn btn-primary" name="change_pass">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

</section>


<script>
    $(document).ready(function () {

        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = urlParams.get('tab') || 'approval';
        $('.nav-link').removeClass('active');
        $('.tab-pane').removeClass('show active');
        $(`#${activeTab}-tab`).addClass('active');
        $(`#${activeTab}-tab-pane`).addClass('show active');

        let offset = <?php echo $offset; ?>;
        let limit = <?php echo $limit; ?>;
        let totalRecords = <?php echo $total_records; ?>;
        let isLoading = false;
        let noMoreData = false;

        $(window).scroll(function () {
            if (noMoreData || isLoading) return;

            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                if (offset + limit < totalRecords) {
                    isLoading = true;
                    $('#loading-msg').show();
                    offset += limit;

                    $.ajax({
                        url: '<?php echo $_SERVER['PHP_SELF']; ?>',
                        type: 'GET',
                        data: { offset: offset },
                        success: function (response) {
                            let newRows = $(response).find('#data-table-account').children();

                            if (newRows.length === 0 || newRows.text().includes('No items found')) {
                                noMoreData = true;
                            } else {
                                $('#data-table-account').append(newRows);
                            }

                            $('#loading-msg').hide();
                            isLoading = false;
                        }
                    });
                } else {
                    noMoreData = true;
                }
            }
        });

        // Checkbox Input Function
        function bindSelectAll(masterSelector, targetClass) {
            $(masterSelector).on('change', function () {
                const isChecked = $(this).prop('checked');
                $(targetClass + ':visible').prop('checked', isChecked);
            });
        }

        // Checkbox Input Function for Account Approval
        bindSelectAll('#select-all', '.select-row');

        // Checkbox Input Function for Accounts
        bindSelectAll('#select-all-account', '.select-acc');

        // Checkbox Input Function for Cost Center
        bindSelectAll('#select-all-cost', '.select-cost');

        // Search Input Function
        function bindSearch(inputSelector, tableSelector, columnIndex = null) {
            $(inputSelector).on('input', function () {
                var searchTerm = $(this).val().toLowerCase();
                var foundAny = false;

                $(tableSelector + ' tr').each(function () {
                    var textToSearch;
                    if (columnIndex !== null) {
                        textToSearch = $(this).find('td').eq(columnIndex).text().toLowerCase();
                    } else {
                        textToSearch = $(this).text().toLowerCase();
                    }

                    if (textToSearch.indexOf(searchTerm) !== -1) {
                        $(this).show();
                        foundAny = true;
                    } else {
                        $(this).hide();
                    }
                });

                if (!foundAny) {
                    $(tableSelector + ' tr.no-results').show();
                } else {
                    $(tableSelector + ' tr.no-results').hide();
                }
            });
        }

        // Search Input Function for Account Approval
        bindSearch('#search', '#data-table', 1);

        // Search Input Function for Change Password
        bindSearch('#search_pass', '#data-table-pass');

        // Search Input Function for Accounts
        bindSearch('#search_account', '#data-table-account', 1);

        // Search Input Function for Cost Center
        bindSearch('#search_cost', '#data-table-cost', 1);


        // Show Password
        $('[data-toggle="password"]').on('click', function () {
            var inputSelector = $(this).data('target');
            var input = $(inputSelector);
            var isPassword = input.attr('type') === 'password';

            input.attr('type', isPassword ? 'text' : 'password');
            $(this).toggleClass('bi-eye bi-eye-slash');
        });

        // Fetch Supervisor Function
        function fetchSupervisors(costCenterSelector, supervisorOneSelector, supervisorTwoSelector) {
            $(document).on('change', costCenterSelector, function () {
                var costCenterId = $(this).find('option:selected').data('id');

                if (costCenterId) {
                    $.ajax({
                        url: '../../controller/fetch_supervisors.php',
                        method: 'GET',
                        data: { cost_center_id: costCenterId },
                        dataType: 'json',
                        success: function (response) {
                            $(supervisorOneSelector).val(response.supervisor_one || '');
                            $(supervisorTwoSelector).val(response.supervisor_two || '');
                        },
                        error: function (xhr, status, error) {
                            console.log('AJAX Error:', status, error);
                        }
                    });
                } else {
                    $(supervisorOneSelector).val('');
                    $(supervisorTwoSelector).val('');
                }
            });
        }

        // Fetch Supervisor Function for Create Account
        fetchSupervisors('#create_cost_center', '#create_supervisor_one', '#create_supervisor_two');

        // Fetch Supervisor Function for Update Account
        fetchSupervisors('#edit_cost_center', '#create_edit_supervisor_one', '#create_edit_supervisor_two');

        // Update Account Password Data
        $('.edit-pass').on('click', function () {
            var forgot_pass_id = $(this).data('id');
            var forgot_pass_username = $(this).data('username');

            $('#forgot_pass_id').val(forgot_pass_id);
            $('#forgot_pass_username').val(forgot_pass_username);
        });

        // Account Approval Function
        function handleAccountAction({
            buttonSelector,
            modalSelector,
            listContainerSelector,
            isApproval = false
        }) {
            $(buttonSelector).click(function () {
                const $listContainer = $(listContainerSelector);
                $listContainer.empty();

                const selectedItems = $(".select-row:checked");

                if (selectedItems.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: `No items selected`,
                        text: `Please select at least one account to ${isApproval ? 'approve' : 'reject'}.`,
                        confirmButtonText: 'Ok'
                    });
                    return;
                }

                selectedItems.each(function () {
                    const id = $(this).data("id");
                    const employeeName = $(this).data("employee_name");
                    const badgeNumber = $(this).data("badge_number");
                    const costCenter = $(this).data("cost_center");
                    const designation = $(this).data("designation") || '';
                    const accType = $(this).data("account_type") || '';

                    let row = '';

                    if (isApproval) {
                        row = `
                    <tr class="text-center" style="vertical-align: middle;">
                        <td>${employeeName}</td>
                        <td>${badgeNumber}</td>
                        <td>${costCenter}</td>
                        <td>
                            <select class="form-select" name="designations[]" required>
                                <option value="" ${!designation ? 'selected' : ''}>Select Designation</option>
                                <option value="Supervisor" ${designation === 'Supervisor' ? 'selected' : ''}>Supervisor</option>
                                <option value="Kitting" ${designation === 'Kitting' ? 'selected' : ''}>Kitting</option>
                                <option value="Inspector" ${designation === 'Inspector' ? 'selected' : ''}>Inspector</option>
                                <option value="Operator" ${designation === 'Operator' ? 'selected' : ''}>Operator</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select" name="accounttypes[]" required>
                                <option value="" ${!accType ? 'selected' : ''}>Select Account Type</option>
                                <option value="User" ${accType === 'User' ? 'selected' : ''}>User</option>
                                <option value="Kitting" ${accType === 'Kitting' ? 'selected' : ''}>Kitting</option>
                                <option value="Supervisor" ${accType === 'Supervisor' ? 'selected' : ''}>Supervisor</option>
                            </select>
                        </td>
                        <td style="display:none;">
                            <input type="hidden" name="employeenames[]" value="${employeeName}">
                            <input type="hidden" name="ids[]" value="${id}">
                        </td>
                    </tr>`;
                    } else {
                        row = `
                    <tr class="text-center" style="vertical-align: middle;">
                        <td>${employeeName}</td>
                        <td>${badgeNumber}</td>
                        <td>${costCenter}</td>
                        <td>${designation}</td>
                        <td>${accType}</td>
                        <td>
                            <input type="text" class="form-control" name="reasons[]" placeholder="Reason for Account Rejection" autocomplete="OFF">
                        </td>
                        <td style="display:none;">
                            <input type="hidden" name="employeenames[]" value="${employeeName}">
                            <input type="hidden" name="ids[]" value="${id}">
                        </td>
                    </tr>`;
                    }

                    $listContainer.append(row);
                });

                $(modalSelector).modal("show");
            });
        }

        // Account Approval Function for Account Approval
        handleAccountAction({
            buttonSelector: "#approve_acc-btn",
            modalSelector: "#accountApprovalModal",
            listContainerSelector: "#modalAccountApprovalList",
            isApproval: true
        });

        // Account Approval Function for Account Rejection
        handleAccountAction({
            buttonSelector: "#reject_acc-btn",
            modalSelector: "#accRejectModal",
            listContainerSelector: "#modalAccountRejectionList",
            isApproval: false
        });

        // Form Submission Function
        function handleFormSubmission(formSelector, actionType, successMessage, redirectUrl, errorMessage) {
            $(formSelector).submit(function (e) {
                e.preventDefault();

                let formData = $(this).serialize();
                formData += `&${actionType}=1`;

                $.ajax({
                    url: '../../controller/accounts.php',
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

        // Form Submission Function for Account Approval
        handleFormSubmission("#approveAccForm", "approveacc_submit", "Accounts approved successfully!", "accReg.php?tab=approval", "An unexpected error occurred while approving.");

        // Form Submission Function for Account Rejection
        handleFormSubmission("#rejectAccForm", "rejectacc_submit", "Account rejected successfully!", "accReg.php?tab=approval", "An unexpected error occurred while rejecting.");

        // Form Submission Function for Account Deletion
        handleFormSubmission("#deleteAccForm", "deleteacc_submit", "Accounts deleted successfully!", "accReg.php?tab=account", "An unexpected error occurred while deleting.");

        // Form Submission Function for Account Update
        handleFormSubmission("#updateAccForm", "updateacc_submit", "Account updated successfully!", "accReg.php?tab=account", "An unexpected error occurred while updating.");

        // Form Submission Function for Cost Center Deletion
        handleFormSubmission("#deleteCostForm", "deletecost_submit", "Cost Center deleted successfully!", "accReg.php?tab=costcenter", "An unexpected error occurred while deleting.");

        // Form Submission Function for Cost Center Update
        handleFormSubmission("#updateCostForm", "updatecost_submit", "Cost Center updated successfully!", "accReg.php?tab=costcenter", "An unexpected error occurred while updating.");

        // Account Deletion Button
        $("#delete_acc-btn").click(function () {
            $("#modalAccountDeletionList").empty();

            let selectedItems = $(".select-acc:checked");

            if (selectedItems.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No items selected',
                    text: 'Please select at least one account to delete.',
                    confirmButtonText: 'Ok'
                });
                return;
            }

            selectedItems.each(function () {
                let id = $(this).data("id");
                let employeeName = $(this).data("employee_name");
                let username = $(this).data("username");
                let badgeNumber = $(this).data("badge_number");
                let costCenter = $(this).data("cost_center");
                let designation = $(this).data("designation");
                let accType = $(this).data("account_type");

                let row = `
                    <tr class=" text-center" style="vertical-align: middle;">
                        <td>
                            ${employeeName}
                        </td>
                        <td>
                            ${username}
                        </td>
                        <td>
                            ${badgeNumber}
                        </td>
                        <td>
                            ${costCenter}
                        </td>
                        <td>
                            ${designation}
                        </td>
                        <td>
                            ${accType}
                        </td>
                        <td>
                            <input type="text" class="form-control" name="reasons[]" placeholder="Reason for Account Deletion" autocomplete="OFF">
                        </td>
                        <td style="display:none;"> 
                            <input type="hidden" name="employeenames[]" value="${employeeName}">
                            <input type="hidden" name="ids[]" value="${id}">
                        </td>
                    </tr>
                `;
                $("#modalAccountDeletionList").append(row);
            });

            $("#accDeletionModal").modal("show");
        });

        let rowCounter = 0;

        // Update Account Button
        $("#update_acc-btn").click(function () {
            $("#modalAccountUpdateList").empty();

            let selectedItems = $(".select-acc:checked");

            if (selectedItems.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No items selected',
                    text: 'Please select at least one account to update.',
                    confirmButtonText: 'Ok'
                });
                return;
            }

            selectedItems.each(function () {
                let id = $(this).data("id");
                let employeeName = $(this).data("employee_name");
                let username = $(this).data("username");
                let badgeNumber = $(this).data("badge_number");
                let costCenter = $(this).data("cost_center");
                let designation = $(this).data("designation");
                let accType = $(this).data("account_type");

                rowCounter++;
                const rowId = 'row_' + rowCounter;

                let row = `
                    <tr class=" text-center" style="vertical-align: middle;" id="${rowId}">
                        <td>
                            <input type="text" name="employeenames[]" value="${employeeName}" class="form-control" autocomplete="OFF">
                        </td>
                        <td>
                            ${badgeNumber}
                        </td>
                        <td>
                            <select class="form-select" name="designations[]" required>
                                <option value="${!designation ? 'selected' : ''}">Select Designation</option>
                                <option value="Supervisor" ${designation === 'Supervisor' ? 'selected' : ''}>Supervisor</option>
                                <option value="Kitting" ${designation === 'Kitting' ? 'selected' : ''}>Kitting</option>
                                <option value="Inspector" ${designation === 'Inspector' ? 'selected' : ''}>Inspector</option>
                                <option value="Operator" ${designation === 'Operator' ? 'selected' : ''}>Operator</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-select" name="accounttypes[]" required>
                                <option value="${!accType ? 'selected' : ''}">Select Account Type</option>
                                <option value="User" ${accType === 'User' ? 'selected' : ''}>User</option>
                                <option value="Kitting" ${accType === 'Kitting' ? 'selected' : ''}>Kitting</option>
                                <option value="Supervisor" ${accType === 'Supervisor' ? 'selected' : ''}>Supervisor</option>
                            </select>
                        </td>
                        <td>
                            <select name="costcenters[]" class="form-select costSelect w-100" required data-row-id="${rowId}">  
                                <option value="${!costCenter ? 'selected' : ''}">Cost Center</option>
                                <?php
                                $select_ccid = "SELECT * FROM tbl_ccs";
                                $select_ccid_query = mysqli_query($con, $select_ccid);
                                if (mysqli_num_rows($select_ccid_query) > 0) {
                                    while ($ccid_row = mysqli_fetch_assoc($select_ccid_query)) {
                                        ?>
                                        <option value="<?php echo $ccid_row['ccid'] ?>"
                                            data-id="<?php echo $ccid_row['id'] ?>"
                                            ${costCenter === '<?php echo $ccid_row['ccid'] ?>' ? 'selected' : ''}>
                                            <?php echo $ccid_row['ccid'] ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control supervisorBoth" readonly autocomplete="OFF" style="min-width: max-content;">
                        </td>
                        <td style="display:none;"> 
                            <input type="hidden" class="form-control supervisorOne" name="supervisorOnes[]" readonly autocomplete="OFF">
                            <input type="hidden" class="form-control supervisorTwo" name="supervisorTwos[]" readonly autocomplete="OFF">
                            
                            <input type="hidden" name="ids[]" value="${id}">
                        </td>
                    </tr>
                `;
                $("#modalAccountUpdateList").append(row);
                $(`select.costSelect[data-row-id="${rowId}"]`).trigger('change');
            });

            $("#accUpdateModal").modal("show");
        });

        // Cost Center Selection in Account Modification
        $(document).on('change', '.costSelect', function () {
            var costCenterId = $(this).find('option:selected').data('id');
            var rowId = $(this).data('row-id');
            var supervisorOne = $('#' + rowId).find('.supervisorOne');
            var supervisorTwo = $('#' + rowId).find('.supervisorTwo');
            var supervisorBoth = $('#' + rowId).find('.supervisorBoth');

            if (costCenterId) {
                $.ajax({
                    url: '../../controller/fetch_supervisors.php',
                    method: 'GET',
                    data: { cost_center_id: costCenterId },
                    dataType: 'json',
                    success: function (response) {
                        if (response.supervisor_one) {
                            supervisorOne.val(response.supervisor_one);
                        } else {
                            supervisorOne.val('');
                        }

                        if (response.supervisor_two) {
                            supervisorTwo.val(response.supervisor_two);
                        } else {
                            supervisorTwo.val('');
                        }

                        var sup1 = response.supervisor_one || '';
                        var sup2 = response.supervisor_two || '';

                        if (sup2 === "") {
                            supervisorBoth.val(`${sup1}`);
                        } else {
                            supervisorBoth.val(`${sup1} / ${sup2}`);
                        }


                    },
                    error: function (xhr, status, error) {
                        console.log('AJAX Error: ' + status + ' - ' + error);
                    }
                });
            } else {
                supervisorOne.val('');
                supervisorTwo.val('');
                supervisorBoth.val('');
            }
        });

        // Cost Center Deletion Button
        $("#delete_cost-btn").click(function () {
            $("#modalCostDeletionList").empty();

            let selectedItems = $(".select-cost:checked");

            if (selectedItems.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No items selected',
                    text: 'Please select at least one cost center to delete.',
                    confirmButtonText: 'Ok'
                });
                return;
            }

            selectedItems.each(function () {
                let id = $(this).data("id");
                let ccid = $(this).data("ccid");
                let ccidName = $(this).data("ccid_name");
                let projectCode = $(this).data("project_code");
                let projectName = $(this).data("project_name");
                let badgeOne = $(this).data("badge_one");
                let badgeTwo = $(this).data("badge_two");
                let supervisorOne = $(this).data("supervisor_one");
                let supervisorTwo = $(this).data("supervisor_two");

                let row = `
                    <tr class=" text-center" style="vertical-align: middle;">
                        <td>
                            ${ccid}
                        </td>
                        <td>
                            ${ccidName}
                        </td>
                        <td>
                            ${projectCode}
                        </td>
                        <td>
                            ${projectName}
                        </td>
                        <td>
                            ${supervisorOne}
                        </td>
                        <td>
                            ${badgeOne}
                        </td>
                        <td>
                            ${supervisorTwo}
                        </td>
                        <td>
                            ${badgeTwo}
                        </td>
                        <td>
                            <input type="text" class="form-control" name="reasons[]" placeholder="Reason for Deletion" autocomplete="OFF">
                        </td>
                        <td style="display:none;"> 
                            <input type="hidden" name="ids[]" value="${id}">
                            <input type="hidden" name="ccids[]" value="${ccid}">
                        </td>
                    </tr>
                `;
                $("#modalCostDeletionList").append(row);
            });

            $("#costDeletionModal").modal("show");
        });

        // Cost Center Modification Button
        $("#update_cost-btn").click(function () {
            $("#modalCostUpdateList").empty();

            let selectedItems = $(".select-cost:checked");

            if (selectedItems.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No items selected',
                    text: 'Please select at least one cost center to update.',
                    confirmButtonText: 'Ok'
                });
                return;
            }

            selectedItems.each(function () {
                let id = $(this).data("id");
                let ccid = $(this).data("ccid");
                let ccidName = $(this).data("ccid_name");
                let projectCode = $(this).data("project_code");
                let projectName = $(this).data("project_name");
                let badgeOne = $(this).data("badge_one");
                let badgeTwo = $(this).data("badge_two");
                let supervisorOne = $(this).data("supervisor_one");
                let supervisorTwo = $(this).data("supervisor_two");

                let row = `
                    <tr class=" text-center" style="vertical-align: middle;">
                        <td>
                            <input type="text" name="ccids[]" value="${ccid}" class="form-control" autocomplete="OFF">
                        </td>
                        <td>
                            <input type="text" name="ccidNames[]" value="${ccidName}" class="form-control" autocomplete="OFF">
                        </td>
                        <td>
                            <input type="text" name="projectCodes[]" value="${projectCode}" class="form-control" autocomplete="OFF">
                        </td>
                        <td>
                            <input type="text" name="projectNames[]" value="${projectName}" class="form-control" autocomplete="OFF">
                        </td>
                        <td>
                            <input type="text" name="supervisorOnes[]" value="${supervisorOne}" class="form-control" autocomplete="OFF">
                        </td>
                        <td>
                            <input type="text" name="badgeOnes[]" value="${badgeOne}" class="form-control" autocomplete="OFF">
                        </td>
                        <td>
                            <input type="text" name="supervisorTwos[]" value="${supervisorTwo}" class="form-control" autocomplete="OFF">
                        </td>
                        <td>
                            <input type="text" name="badgeTwos[]" value="${badgeTwo}" class="form-control" autocomplete="OFF">
                        </td>
                        <td style="display:none;">                    
                            <input type="hidden" name="ids[]" value="${id}">
                        </td>
                    </tr>
                `;
                $("#modalCostUpdateList").append(row);
            });

            $("#costUpdateModal").modal("show");
        });

        // Cost Center Creation Submit
        $("#costCenterSubmit").on("click", function (e) {
            e.preventDefault();

            let data = [];
            let valid = true;

            $("#costCenterTable tbody tr").each(function () {
                let item = {};

                $(this).find("input").each(function () {
                    const input = $(this);
                    const name = input.attr("name");
                    const value = input.val().trim();

                    item[name] = value;

                    const isOptional = (name === 'supervisorTwo' || name === 'badgeTwo');
                    if (!value && !isOptional) {
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
                url: "../../controller/ccs.php",
                method: "POST",
                contentType: "application/json",
                dataType: "json",
                data: JSON.stringify({
                    costCenterSubmit: true,
                    items: data
                }),
                success: function (res) {
                    if (res.message === "Cost Center(s) added successfully") {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: res.message
                        }).then(() => {
                            window.location.href = 'accReg.php?tab=costcenter';
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: res.message || "Something went wrong."
                        });
                    }
                },
            });
        });

        // Cost Center Add Row
        $("#btnAddCostCenterRow").on("click", function () {
            addCostCenterRow();
        });

        // Cost Center Row
        function addCostCenterRow(data = {}) {
            const row = $("<tr></tr>");
            row.append(`
                <td>
                    <input type="text" name="ccid" class="form-control" placeholder="CCID" autocomplete="off" required>
                </td>
                <td>
                    <input type="text" name="ccidName" class="form-control" placeholder="CCID Name" autocomplete="off" required>
                </td>
                <td>
                    <input type="text" name="projectCode" class="form-control" placeholder="Project Code" autocomplete="off" required>
                </td>
                <td>
                    <input type="text" name="projectName" class="form-control" placeholder="Project Name" autocomplete="off" required>
                </td>
                <td>
                    <input type="text" name="supervisorOne" class="form-control" placeholder="Supervisor" autocomplete="off" required>
                </td>
                <td>
                    <input type="text" name="badgeOne" class="form-control" placeholder="Badge Number" autocomplete="off" required>
                </td>
                <td>
                    <input type="text" name="supervisorTwo" class="form-control" placeholder="Supervisor" autocomplete="off" >
                </td>
                <td>
                    <input type="text" name="badgeTwo" class="form-control" placeholder="Badge Number" autocomplete="off" >
                </td>
                <td>
                    <button class="btn btn-danger" onclick="this.closest('tr').remove()">Delete</button>
                </td>
            `);
            $("#costCenterTable tbody").append(row);
        }

        // Account Registration Add Row
        $("#btnAddAccountRow").on("click", function () {
            addAccountRow();
        });

        // Account Registration Submit
        $("#accountSubmit").on("click", function (e) {
            e.preventDefault();

            let data = [];
            let valid = true;
            let usernameInvalid = false;

            $("#accountTable tbody tr").each(function () {
                let item = {};

                $(this).find("input, select").each(function () {
                    const input = $(this);
                    const name = input.attr("name");
                    const value = input.val().trim();

                    item[name] = value;

                    const isOptional = (name === 'supervisorTwo');

                    if (!input[0].checkValidity() && !isOptional) {
                        valid = false;
                        input.addClass("is-invalid");

                        if (name === 'username' && value && !/^[a-zA-Z0-9]+$/.test(value)) {
                            usernameInvalid = true;
                            input.addClass("is-invalid");
                        }

                    } else {
                        input.removeClass("is-invalid");
                    }
                });

                data.push(item);
            });

            if (usernameInvalid) {
                return Swal.fire({
                    icon: 'error',
                    title: 'Invalid Username',
                    text: 'Username must contain only letters and numbers. Spaces and special characters are not allowed.'
                });
            }

            if (!valid) {
                return Swal.fire("Error!", "Missing Inputs", "error");
            }

            if (data.length === 0) {
                return Swal.fire("Error!", "No data to submit.", "error");
            }

            $.ajax({
                url: "../../controller/accounts.php",
                method: "POST",
                contentType: "application/json",
                dataType: "json",
                data: JSON.stringify({
                    accountSubmit: true,
                    items: data
                }),

                success: res => {
                    if (res.duplicates) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Duplicate Username(s)',
                            text: `The following already exist: ${res.duplicates.join(", ")}`
                        });
                    } else if (res.message === "Account registrations completed successfully.") {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: res.message
                        }).then(() => {
                            window.location.href = 'accReg.php?tab=account';
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: res.message || "Something went wrong."
                        });
                    }
                },
            });
        });

        let costCounter = 0;

        // Account Registration Button
        function addAccountRow(data = {}) {
            costCounter++;
            const costID = 'row_' + costCounter;
            const row = $("<tr></tr>").attr("id", costID);
            row.append(`
                <td>
                    <input type="text" name="employeeName" class="form-control" placeholder="Employee Name" autocomplete="off" required>
                </td>
                <td>
                    <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="off" pattern="^[a-zA-Z0-9]+$"
                                    title="Username must contain only letters and numbers. Spaces and special characters are not allowed." required>
                </td>
                <td>
                    <input type="text" name="badgeNumber" class="form-control" placeholder="Badge Number" autocomplete="off" required>
                </td>
                <td>
                    <select class="form-select" name="designation" required>
                        <option value="">Select Designation</option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="Kitting" >Kitting</option>
                        <option value="Inspector">Inspector</option>
                        <option value="Operator" >Operator</option>
                    </select>
                </td>
                <td>
                    <select class="form-select" name="accountType" required>
                        <option value="">Select Account Type</option>
                        <option value="User">User</option>
                        <option value="Kitting">Kitting</option>
                        <option value="Supervisor">Supervisor</option>
                    </select>
                </td>
                <td>
                    <select name="costCenter" class="form-select costAccountSelect w-100" required data-row-id="${costID}">  
                        <option value="">Cost Center</option>
                        <?php
                        $select_ccid = "SELECT * FROM tbl_ccs";
                        $select_ccid_query = mysqli_query($con, $select_ccid);
                        if (mysqli_num_rows($select_ccid_query) > 0) {
                            while ($ccid_row = mysqli_fetch_assoc($select_ccid_query)) {
                                ?>
                                <option value="<?php echo $ccid_row['ccid'] ?>"
                                    data-id="<?php echo $ccid_row['id'] ?>"
                                   >
                                    <?php echo $ccid_row['ccid'] ?>
                                </option>
                            <?php
                            }
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control supervisorBothAccount" readonly style="min-width: 300px;">
                </td>
                <td style="display: none;">
                    <input type="text" name="supervisorOne" class="form-control supervisorOneAccount" placeholder="supervisorOneAccount" autocomplete="off" >
                    <input type="text" name="supervisorTwo" class="form-control supervisorTwoAccount" placeholder="supervisorTwoAccount" autocomplete="off" >
                </td>
                <td>
                    <button class="btn btn-danger" onclick="this.closest('tr').remove()">Delete</button>
                </td>
            `);
            $("#accountTable tbody").append(row);
            $(`select.costAccountSelect[data-row-id="${costID}"]`).trigger('change');
        }

        // Change Accounts Supervisor
        $(document).on('change', '.costAccountSelect', function () {
            var costCenterId = $(this).find('option:selected').data('id');
            var costID = $(this).data('row-id');
            var supervisorOne = $('#' + costID).find('.supervisorOneAccount');
            var supervisorTwo = $('#' + costID).find('.supervisorTwoAccount');
            var supervisorBoth = $('#' + costID).find('.supervisorBothAccount');

            if (costCenterId) {
                $.ajax({
                    url: '../../controller/fetch_supervisors.php',
                    method: 'GET',
                    data: { cost_center_id: costCenterId },
                    dataType: 'json',
                    success: function (response) {
                        if (response.supervisor_one) {
                            supervisorOne.val(response.supervisor_one);
                        } else {
                            supervisorOne.val('');
                        }

                        if (response.supervisor_two) {
                            supervisorTwo.val(response.supervisor_two);
                        } else {
                            supervisorTwo.val('');
                        }

                        var sup1 = response.supervisor_one || '';
                        var sup2 = response.supervisor_two || '';

                        if (sup2 === "") {
                            supervisorBoth.val(`${sup1}`);
                        } else {
                            supervisorBoth.val(`${sup1} / ${sup2}`);
                        }


                    },
                    error: function (xhr, status, error) {
                        console.log('AJAX Error: ' + status + ' - ' + error);
                    }
                });
            } else {
                supervisorOne.val('');
                supervisorTwo.val('');
                supervisorBoth.val('');
            }
        });

    });
</script>