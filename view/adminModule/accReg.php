<?php
ob_start();

// Database Connection
include "../../model/dbconnection.php";

// Navigation Bar
include "navBar.php";

// Navigation Page Active
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode("/", $path);
$page = $components[4];

// Restrict access to the Kitting sections from the Supervisor Page.
if ($_SESSION['user'] == 'Kitting') {
    $_SESSION['status'] = "The link is for admin only.";
    $_SESSION['status_code'] = "error";
    header("Location: adminDashboard.php");
    exit();
}

ob_end_flush();
?>


<head>

    <!-- Title -->
    <title>Acoount Registration</title>

    <!-- Table Style -->
    <link rel="stylesheet" href="../../public/css/table.css">

    <!-- Sweetaler Style -->
    <link rel="stylesheet" href="../../public/css/sweetalert.min.css">

    <!-- Sweetalert Script -->
    <script src="../../public/js/sweetalert2@11.js"></script>

    <!-- Jquery Script -->
    <script src="../../public/js/jquery.js"></script>

</head>

<section>

    <!-- Main Container -->
    <div class="mx-5">

        <!-- Title Div -->
        <div class="welcomeDiv my-4">
            <h2 class="text-center" style="color: #900008; font-weight: bold;">Account Registration</h2>
        </div>

        <!-- Navitaion Tab -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="approval-tab" data-bs-toggle="tab" data-bs-target="#approval-tab-pane" type="button"
                    role="tab" aria-controls="approval-tab-pane" aria-selected="true">Account Approval</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link " id="password-tab" data-bs-toggle="tab" data-bs-target="#password-tab-pane"
                    type="button" role="tab" aria-controls="password-tab-pane" aria-selected="true">Update Account
                    Password</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link " id="account-tab" data-bs-toggle="tab" data-bs-target="#account-tab-pane"
                    type="button" role="tab" aria-controls="account-tab-pane" aria-selected="true">Account Records</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="costcenter-tab" data-bs-toggle="tab" data-bs-target="#costcenter-tab-pane" type="button"
                    role="tab" aria-controls="costcenter-tab-pane" aria-selected="false">Cost Center / Supervisor</button>
            </li>
        </ul>

        <!-- Tab Contents -->
        <div class="tab-content" id="myTabContent">

            <!-- ACCOUNT APPROVAL -->
            <div class="tab-pane fade" id="approval-tab-pane" role="tabpanel" aria-labelledby="approval-tab">

                    <div class="d-flex justify-between-evenly w-100">

                        <!-- Approval Button -->
                        <div class="text-center my-3 w-50">
                            <input type="text" id="search" class="form-control w-50 mx-auto" placeholder="Search here"
                                autocomplete="off" />
                        </div>
                        <div class="text-center my-3 w-50">
                     
                            <button class="btn btn-success" id="approve_acc-btn">Approve Accounts</button>
                
                            <button class="btn btn-danger" id="reject_acc-btn">Reject Accounts</button>
         
                        </div>

                    </div>

                    <!-- Approval Table -->
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
                                        <input type="checkbox" class="select-row" 
                                                data-id="<?php echo $sqlRow['id']; ?>"
                                                data-employee_name="<?php echo $sqlRow['employee_name']; ?>"
                                                data-badge_number="<?php echo $sqlRow['badge_number']; ?>"
                                                data-cost_center="<?php echo $sqlRow['cost_center']; ?>"
                                                data-designation="<?php echo $sqlRow['designation']; ?>"
                                                data-account_type="<?php echo $sqlRow['account_type']; ?>"
                                                >
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
                        </tbody>
                    </table>


            </div>

            <!-- ACCOUNT PASSWORD -->
            <div class="tab-pane fade" id="password-tab-pane" role="tabpanel" aria-labelledby="password-tab">

                <!-- Account Password Search Inout -->
                <div class="d-flex justify-between-center w-100 my-3">

                    <input type="text" id="search_pass" class="form-control w-50 mx-auto"
                        placeholder="Search username here" autocomplete="off" />

                </div>

                <!-- Accounts Password Table -->
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
                                <td colspan="8" class="text-center">No users found</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>

                </table>

            </div>

            <!-- ACCOUNT CREATION -->
            <div class="tab-pane fade" id="account-tab-pane" role="tabpanel" aria-labelledby="account-tab">

                <!-- Account Creation and Register Button -->
                <div class="d-flex justify-between-evenly w-100">
                    <div class="text-center my-3 w-50">
                        <input type="text" id="search_account" class="form-control w-50 mx-auto"
                            placeholder="Search here" autocomplete="off" />
                    </div>
                    <div class="text-center my-3 w-50">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#accCreation">Register
                            Account</button>

                        <button class="btn btn-primary" id="update_acc-btn">Update Accounts</button>
                
                        <button class="btn btn-danger" id="delete_acc-btn">Delete Accounts</button>
                    </div>
                </div>

                <!-- Accounts Table -->
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
                        $userName = $_SESSION['username'];
                        $sql = "SELECT *
                                FROM tbl_users WHERE usertype = '2'";
                        $sql_query = mysqli_query($con, $sql);

                        if (mysqli_num_rows($sql_query) > 0) {
                            while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                                ?>
                                <tr class="table-row text-center" style="vertical-align:middle;">
                                    <td data-label="Select">
                                        <input type="checkbox" class="select-acc" 
                                                data-id="<?php echo $sqlRow['id']; ?>"
                                                data-employee_name="<?php echo $sqlRow['employee_name']; ?>"
                                                data-username="<?php echo $sqlRow['username']; ?>"
                                                data-badge_number="<?php echo $sqlRow['badge_number']; ?>"
                                                data-cost_center="<?php echo $sqlRow['cost_center']; ?>"
                                                data-designation="<?php echo $sqlRow['designation']; ?>"
                                                data-account_type="<?php echo $sqlRow['account_type']; ?>"
                                                >
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
                                <td colspan="7" class="text-center">No users found</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>

                </table>

            </div>

            <!-- COST CENTER TAB -->
            <div class="tab-pane fade" id="costcenter-tab-pane" role="tabpanel" aria-labelledby="costcenter-tab">

                <!-- Search and Cost Center Button -->
                <div class="d-flex justify-between-evenly w-100">
                    <div class="text-center my-3 w-50">
                        <input type="text" id="search_cost" class="form-control w-50 mx-auto" placeholder="Search here"
                            autocomplete="off" />
                    </div>
                    <div class="text-center my-3 w-50">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#cost_center">Cost
                            Center /
                            Supervisor</button>
                    </div>
                </div>

                <!-- Cost Center Table -->
                <table class="table table-striped w-100">

                    <thead>
                        <tr class="text-center" style="background-color: #900008; color: white;">
                            <th scope="col">New CCID</th>
                            <th scope="col">New CCID Name</th>
                            <th scope="col">Project Code</th>
                            <th scope="col">Project</th>
                            <th scope="col">Badge No.</th>
                            <th scope="col">Supervisor</th>
                            <th scope="col">Action</th>
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
                                    <td data-label="New CCID"><?php echo $ccs_row['ccid'] ?></td>
                                    <td data-label="New CCID Name"><?php echo $ccs_row['ccid_name'] ?></td>
                                    <td data-label="Project Code"><?php echo $ccs_row['project_code'] ?></td>
                                    <td data-label="Project Name"><?php echo $ccs_row['project_name'] ?></td>
                                    <td data-label="Badge No.">
                                        <?php
                                        echo $ccs_row['badge_one'];
                                        if (!empty($ccs_row['badge_two'])) {
                                            echo ' / ' . $ccs_row['badge_two'];
                                        }
                                        ?>
                                    </td>
                                    <td data-label="Supervisor">
                                        <?php
                                        echo $ccs_row['supervisor_one'];
                                        if (!empty($ccs_row['supervisor_two'])) {
                                            echo ' / ' . $ccs_row['supervisor_two'];
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary edit_ccs" data-bs-toggle="modal"
                                            data-bs-target="#edit_ccs_modal" data-id="<?php echo $ccs_row['id'] ?>"
                                            data-ccid="<?php echo $ccs_row['ccid'] ?>"
                                            data-ccid_name="<?php echo $ccs_row['ccid_name'] ?>"
                                            data-project_code="<?php echo $ccs_row['project_code'] ?>"
                                            data-project_name="<?php echo $ccs_row['project_name'] ?>"
                                            data-badge_one="<?php echo $ccs_row['badge_one'] ?>"
                                            data-badge_two="<?php echo $ccs_row['badge_two'] ?>"
                                            data-supervisor_one="<?php echo $ccs_row['supervisor_one'] ?>"
                                            data-supervisor_two="<?php echo $ccs_row['supervisor_two'] ?>">Edit</button>

                                        <button class="btn btn-danger delete_css"
                                            data-id="<?php echo $ccs_row['id'] ?>" data-ccid_name="<?php echo $ccs_row['ccid_name'] ?>">Delete</button>
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

     <!-- Account Approval Modal -->
     <div class="modal fade" id="accountApprovalModal" tabindex="-1" aria-labelledby="accountApprovalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accountApprovalModalLabel">Approval of Selected Accounts</h5>
                </div>
                <div class="modal-body">
                    <form id="approveAccForm">
                        <div class="table-responsive">
                            <table class="table table-bordered">
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
                </div>
                <div class="modal-body">
                    <form id="rejectAccForm">
                        <div class="table-responsive">
                            <table class="table table-bordered">
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

    <!-- Account Deletion Modal -->
    <div class="modal fade" id="accDeletionModal" tabindex="-1" aria-labelledby="accDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accDeletionModalLabel">Deletion of Selected Accounts</h5>
                </div>
                <div class="modal-body">
                    <form id="deleteAccForm">
                        <div class="table-responsive">
                            <table class="table table-bordered">
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
                </div>
                <div class="modal-body">
                    <form id="updateAccForm">
                        <div class="table-responsive">
                            <table class="table table-bordered">
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
                            <i class="bi bi-eye-slash" id="toggle-new-password"
                                style="position: absolute; right: 30px; top: 55px; cursor: pointer; background-color: white;"></i>
                        </div>
                        <div class="mb-3">
                            <label for="forgot_pass_two" class="form-label">Re-enter Password</label>
                            <input type="password" class="form-control" id="forgot_pass_two" name="con_pass"
                                placeholder="Re-enter password" required>
                            <i class="bi bi-eye-slash" id="toggle-con-password"
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

    <!-- MODAL FOR COST CENTER CREATION -->
    <div class="modal fade" id="cost_center" tabindex="-1" aria-labelledby="cost_centerLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="cost_centerLabel">Cost Center / Supervisor Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../../controller/ccs.php">
                        <div class="mb-3">
                            <label for="new_ccid" class="form-label">New CCID</label>
                            <input type="text" class="form-control" id="new_ccid" name="new_ccid"
                                placeholder="Enter CCID" required autocomplete="off">
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="new_ccid_name" class="form-label">New CCID Name</label>
                            <input type="text" class="form-control" id="new_ccid_name" name="new_ccid_name"
                                placeholder="Enter CCID Name" required autocomplete="off">
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="project_code" class="form-label">Project Code</label>
                            <input type="text" class="form-control" id="project_code" name="project_code"
                                placeholder="Enter Project Code" required autocomplete="off">
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="project_name" class="form-label">Project Name</label>
                            <input type="text" class="form-control" id="project_name" name="project_name"
                                placeholder="Enter Project Name" required autocomplete="off">
                        </div>
                        <div class="mb-3 position-relative ">
                            <label for="badge_one" class="form-label">Badge No.</label>
                            <div class="d-flex justify-content-between">
                                <input type="text" class="form-control mx-1" id="badge_one" name="badge_one"
                                    placeholder="Enter Badge Number" required autocomplete="off">
                                <input type="text" class="form-control mx-1" id="badge_two" name="badge_two"
                                    placeholder="Enter Badge Number" autocomplete="off">
                            </div>
                        </div>
                        <div class="mb-3 position-relative ">
                            <label for="supervisor_one" class="form-label">Supervisor</label>
                            <div class="d-flex justify-content-between">
                                <input type="text" class="form-control mx-1" id="supervisor_one" name="supervisor_one"
                                    placeholder="Enter Supervisor" required autocomplete="off">
                                <input type="text" class="form-control mx-1" id="supervisor_two" name="supervisor_two"
                                    placeholder="Enter Supervisor" autocomplete="off">
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="submit_cc">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL FOR COST CENTER EDIT -->
    <div class="modal fade" id="edit_ccs_modal" tabindex="-1" aria-labelledby="edit_ccs_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="edit_ccs_modalLabel">Cost Center / Supervisor Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../../controller/ccs.php">
                        <div class="mb-3" style="display: none;">
                            <label for="edit_id" class="form-label">New CCID</label>
                            <input type="text" class="form-control" id="edit_id" name="id" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="edit_new_ccid" class="form-label">New CCID</label>
                            <input type="text" class="form-control" id="edit_new_ccid" name="new_ccid" required
                                placeholder="Enter CCID" autocomplete="off">
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="edit_new_ccid_name" class="form-label">New CCID Name</label>
                            <input type="text" class="form-control" id="edit_new_ccid_name" name="new_ccid_name"
                                placeholder="Enter CCID Name" required autocomplete="off">
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="edit_project_code" class="form-label">Project Code</label>
                            <input type="text" class="form-control" id="edit_project_code" name="project_code"
                                placeholder="Enter Project Code" required autocomplete="off">
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="edit_project_name" class="form-label">Project Name</label>
                            <input type="text" class="form-control" id="edit_project_name" name="project_name"
                                placeholder="Enter Project Name" required autocomplete="off">
                        </div>
                        <div class="mb-3 position-relative ">
                            <label for="edit_badge_one" class="form-label">Badge No.</label>
                            <div class="d-flex justify-content-between">
                                <input type="text" class="form-control mx-1" id="edit_badge_one" name="badge_one"
                                    placeholder="Enter Badge Number" required autocomplete="off">
                                <input type="text" class="form-control mx-1" id="edit_badge_two" name="badge_two"
                                    placeholder="Enter Badge Number" autocomplete="off">
                            </div>
                        </div>
                        <div class="mb-3 position-relative ">
                            <label for="edit_supervisor_one" class="form-label">Supervisor</label>
                            <div class="d-flex justify-content-between">
                                <input type="text" class="form-control mx-1" id="edit_supervisor_one"
                                    placeholder="Enter Supervisor" name="supervisor_one" required autocomplete="off">
                                <input type="text" class="form-control mx-1" id="edit_supervisor_two"
                                    placeholder="Enter Supervisor" name="supervisor_two" autocomplete="off">
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="submit_edit_cc">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL FOR ACCOUNT CREATION -->
    <div class="modal fade" id="accCreation" tabindex="-1" aria-labelledby="accCreationLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="accCreationLabel">Create New Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../../controller/user.php">

                        <div class="mb-3 mx-1">
                            <label for="employee_name" class="form-label">Employee Name</label>
                            <input type="text" class="form-control" id="employee_name" name="employee_name"
                                placeholder="Enter Employee Name" required autocomplete="off">
                        </div>
                        <div class="mb-3 position-relative d-flex justify-content-evenly">
                            <div class="w-50 mx-1">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control " id="username" name="username"
                                    placeholder="Enter username" required autocomplete="off">
                            </div>
                            <div class="w-50  mx-1">
                                <label for="passwordred" class="form-label">Password</label>
                                <input type="password" class="form-control" id="passwordred" name="password"
                                    placeholder="Enter password" required autocomplete="off">
                                <i class="bi bi-eye-slash" id="toggle-password"
                                    style="position: absolute; right: 10px; top: 40px; cursor: pointer;"></i>
                            </div>
                        </div>
                        <div class="mb-3 position-relative d-flex justify-content-evenly">
                            <div class="w-50 mx-1">
                                <label for="badge_number" class="form-label">Badge Number</label>
                                <input type="text" class="form-control " id="badge_number" name="badge_number"
                                    placeholder="Enter Badge Number" required autocomplete="off">
                            </div>
                            <div class="w-50  mx-1">
                                <label for="designation" class="form-label">Designation</label>
                                <select class="form-select" id="designation" name="designation" required>
                                    <option selected value="">Select Designation</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Kitting">Kitting</option>
                                    <option value="Inspector">Inspector</option>
                                    <option value="Operator">Operator</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 position-relative d-flex justify-content-evenly">
                            <div class="w-50 mx-1">
                                <label for="account_type" class="form-label">Account Type</label>
                                <select class="form-select" id="account_type" name="account_type" required>
                                    <option selected value="">Select Account Type</option>
                                    <option value="User">User</option>
                                    <option value="Kitting">Kitting</option>
                                    <option value="Supervisor">Supervisor</option>
                                </select>
                            </div>
                            <div class="w-50 mx-1">
                                <label for="create_cost_center" class="form-label">Cost Center</label>
                                <select class="form-select" id="create_cost_center" name="cost_center" required>
                                    <option selected value="">Select Cost Center</option>
                                    <?php
                                    $select_ccid = "SELECT * FROM tbl_ccs";
                                    $select_ccid_query = mysqli_query($con, $select_ccid);

                                    if (mysqli_num_rows($select_ccid_query) > 0) {
                                        while ($ccid_row = mysqli_fetch_assoc($select_ccid_query)) {
                                            ?>
                                            <option value="<?php echo $ccid_row['ccid'] ?>"
                                                data-id="<?php echo $ccid_row['id'] ?>"><?php echo $ccid_row['ccid'] ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                        </div>

                        <div class="mb-3 position-relative">
                            <label for="create_supervisor_one" class="form-label">Supervisor</label>
                            <div class="d-flex justify-content-between">
                                <input type="text" class="form-control mx-1" id="create_supervisor_one"
                                    placeholder="Enter Supervisor" name="supervisor_one" required readonly>
                                <input type="text" class="form-control mx-1" id="create_supervisor_two"
                                    placeholder="Enter Supervisor" name="supervisor_two" readonly>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="register">Register</button>
                    </form>
                </div>
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

        // Search Input for Approval Tab
        $('#search').on('input', function () {
            var searchTerm = $(this).val().toLowerCase();
            $('#data-table tr').each(function () {
                var rowText = $(this).text().toLowerCase();
                if (rowText.indexOf(searchTerm) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        });

        // Select all for Approval Tab
        $('#select-all').on('change', function () {
            $('.select-row').prop('checked', $(this).prop('checked'));
        });

        // Select all for Accounts Tab
        $('#select-all-account').on('change', function () {
            $('.select-acc').prop('checked', $(this).prop('checked'));
        });

        // Search Input for Change Pass Tab
        $('#search_pass').on('input', function () {
            var searchTerm = $(this).val().toLowerCase();
            $('#data-table-pass tr').each(function () {
                var rowText = $(this).text().toLowerCase();
                if (rowText.indexOf(searchTerm) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        });

        // Search Input for Accounts Tab
        // $('#search_account').on('input', function () {
        //     var searchTerm = $(this).val().toLowerCase();
        //     $('#data-table-account tr').each(function () {
        //         var rowText = $(this).text().toLowerCase();
        //         if (rowText.indexOf(searchTerm) === -1) {
        //             $(this).hide();
        //         } else {
        //             $(this).show();
        //         }
        //     });
        // });

        $('#search_account').on('input', function () {
            var searchTerm = $(this).val().toLowerCase();
            $('#data-table-account tr').each(function () {
                var firstTdText = $(this).find('td:first').text().toLowerCase();
                if (firstTdText.indexOf(searchTerm) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        });

        // Search Input for Cost Center Tab
        $('#search_cost').on('input', function () {
            var searchTerm = $(this).val().toLowerCase();
            $('#data-table-cost tr').each(function () {
                var rowText = $(this).text().toLowerCase();
                if (rowText.indexOf(searchTerm) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        });

        // Cost Center Automatic Supervisor Show
        $(document).on('change', '#create_cost_center', function () {

            var costCenterId = $('#create_cost_center option:selected').data('id');

            if (costCenterId) {
                $.ajax({
                    url: '../../controller/fetch_supervisors.php',
                    method: 'GET',
                    data: { cost_center_id: costCenterId },
                    dataType: 'json',
                    success: function (response) {
                        if (response.supervisor_one) {
                            $('#create_supervisor_one').val(response.supervisor_one);
                        } else {
                            $('#create_supervisor_one').val('');
                        }

                        if (response.supervisor_two) {
                            $('#create_supervisor_two').val(response.supervisor_two);
                        } else {
                            $('#create_supervisor_two').val('');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log('AJAX Error: ' + status + ' - ' + error);
                    }
                });
            } else {
                $('#create_supervisor_one').val('');
                $('#create_supervisor_two').val('');
            }
        });

        // Cost Center Edit Automatic Supervisors Show
        $(document).on('change', '#edit_cost_center', function () {
            var costCenterId = $('#edit_cost_center option:selected').data('id');

            if (costCenterId) {
                $.ajax({
                    url: '../../controller/fetch_supervisors.php',
                    method: 'GET',
                    data: { cost_center_id: costCenterId },
                    dataType: 'json',
                    success: function (response) {
                        if (response.supervisor_one) {
                            $('#create_edit_supervisor_one').val(response.supervisor_one);
                        } else {
                            $('#create_edit_supervisor_one').val('');
                        }

                        if (response.supervisor_two) {
                            $('#create_edit_supervisor_two').val(response.supervisor_two);
                        } else {
                            $('#create_edit_supervisor_two').val('');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log('AJAX Error: ' + status + ' - ' + error);
                    }
                });
            } else {
                $('#create_edit_supervisor_one').val('');
                $('#create_edit_supervisor_two').val('');
            }
        });

        // Prevent No Designation
        $('#designation').on('change', function () {
            if (this.value === '0') {
                alert("Please select a valid designation.");
                this.value = '';
            }
        });

        // Edit Cost Center Data
        $('.edit_ccs').on('click', function () {
            var edit_id = $(this).data('id');
            var edit_ccid = $(this).data('ccid');
            var edit_ccid_name = $(this).data('ccid_name');
            var edit_project_code = $(this).data('project_code');
            var edit_project_name = $(this).data('project_name');
            var edit_badge_one = $(this).data('badge_one');
            var edit_badge_two = $(this).data('badge_two');
            var edit_supervisor_one = $(this).data('supervisor_one');
            var edit_supervisor_two = $(this).data('supervisor_two');

            $('#edit_id').val(edit_id);
            $('#edit_new_ccid').val(edit_ccid);
            $('#edit_new_ccid_name').val(edit_ccid_name);
            $('#edit_project_code').val(edit_project_code);
            $('#edit_project_name').val(edit_project_name);
            $('#edit_badge_one').val(edit_badge_one);
            $('#edit_badge_two').val(edit_badge_two);
            $('#edit_supervisor_one').val(edit_supervisor_one);
            $('#edit_supervisor_two').val(edit_supervisor_two);
        });

        // Delete Cost Center Data
        $('.delete_css').on('click', function () {
            var itemId = $(this).data('id');
            var itemCcid_name = $(this).data('ccid_name');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this action for CCID: " + itemCcid_name + "!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../../controller/ccs.php?id=" + itemId;
                }
            });
        });

        // Update Account Password Data
        $('.edit-pass').on('click', function () {
            var forgot_pass_id = $(this).data('id');
            var forgot_pass_username = $(this).data('username');

            $('#forgot_pass_id').val(forgot_pass_id);
            $('#forgot_pass_username').val(forgot_pass_username);
        });

        // Show Password Script
        $('#toggle-password').on('click', function () {
            var passwordField = $('#passwordred');
            var icon = $(this);
            if (passwordField.attr('type') === "password") {
                passwordField.attr('type', 'text');
                icon.removeClass('bi-eye-slash').addClass('bi-eye');
            } else {
                passwordField.attr('type', 'password');
                icon.removeClass('bi-eye').addClass('bi-eye-slash');
            }
        });

        $('#toggle-new-password').on('click', function () {
            var new_password = $('#forgot_pass_one');
            var icon = $(this);
            if (new_password.attr('type') === "password") {
                new_password.attr('type', 'text');
                icon.removeClass('bi-eye-slash').addClass('bi-eye');
            } else {
                new_password.attr('type', 'password');
                icon.removeClass('bi-eye').addClass('bi-eye-slash');
            }
        });

        $('#toggle-con-password').on('click', function () {
            var con_password = $('#forgot_pass_two');
            var icon = $(this);
            if (con_password.attr('type') === "password") {
                con_password.attr('type', 'text');
                icon.removeClass('bi-eye-slash').addClass('bi-eye');
            } else {
                con_password.attr('type', 'password');
                icon.removeClass('bi-eye').addClass('bi-eye-slash');
            }
        });

        // Show Confirm Password Script
        $('#toggle-confirm-password').on('click', function () {
            var confirmPasswordField = $('#confirm_passwordred');
            var icon = $(this);
            if (confirmPasswordField.attr('type') === "password") {
                confirmPasswordField.attr('type', 'text');
                icon.removeClass('bi-eye-slash').addClass('bi-eye');
            } else {
                confirmPasswordField.attr('type', 'password');
                icon.removeClass('bi-eye').addClass('bi-eye-slash');
            }
        });
    
        // Account Approval Button
        $("#approve_acc-btn").click(function () {
            $("#modalAccountApprovalList").empty();

            let selectedItems = $(".select-row:checked");

            if (selectedItems.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No accounts selected',
                    text: 'Please select at least one account to approve.',
                    confirmButtonText: 'Ok'
                });
                return;
            }

            selectedItems.each(function () {
                let id = $(this).data("id");
                let employeeName = $(this).data("employee_name");
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
                            ${badgeNumber}
                        </td>
                        <td>
                            ${costCenter}
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
                        <td style="display:none;"> 
                            <input type="hidden" name="employeenames[]" value="${employeeName}">
                            <input type="hidden" name="ids[]" value="${id}">
                        </td>
                    </tr>
                    `;
                $("#modalAccountApprovalList").append(row);
            });

            $("#accountApprovalModal").modal("show");
        });

        // Account Approval Submit
        $("#approveAccForm").submit(function (e) {
            e.preventDefault();

            let formData = $(this).serialize();

            formData += "&approveacc_submit=1";

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
                            text: 'Accounts approved successfully!',
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
                }
            });
        });
    
        // Account Rejection Button
        $("#reject_acc-btn").click(function () {
            $("#modalAccountRejectionList").empty();

            let selectedItems = $(".select-row:checked");

            if (selectedItems.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No items selected',
                    text: 'Please select at least one account to reject.',
                    confirmButtonText: 'Ok'
                });
                return;
            }

            selectedItems.each(function () {
                let id = $(this).data("id");
                let employeeName = $(this).data("employee_name");
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
                            <input type="text" class="form-control" name="reasons[]" placeholder="Reason for Account Rejection" autocomplete="OFF">
                        </td>
                        <td style="display:none;"> 
                            <input type="hidden" name="employeenames[]" value="${employeeName}">
                            <input type="hidden" name="ids[]" value="${id}">
                        </td>
                    </tr>
                `;
                $("#modalAccountRejectionList").append(row);
            });

            $("#accRejectModal").modal("show");
        });

        // Account Rejection Submit
        $("#rejectAccForm").submit(function (e) {
            e.preventDefault();

            let formData = $(this).serialize();

            formData += "&rejectacc_submit=1";

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
                            text: 'Account rejected successfully!',
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
                }
            });
        });

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

        $("#deleteAccForm").submit(function (e) {
            e.preventDefault();

            let formData = $(this).serialize();

            formData += "&deleteacc_submit=1";

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
                            text: 'Accounts deleted successfully!',
                            confirmButtonText: 'Ok'
                        }).then(() => {
                            window.location.href = 'accReg.php?tab=account';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.error || 'An unexpected error occurred.',
                            confirmButtonText: 'Ok'
                        });
                    }
                }
            });
        });

        let rowCounter = 0;

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

        $("#updateAccForm").submit(function (e) {
            e.preventDefault();

            let formData = $(this).serialize();

            formData += "&updateacc_submit=1";

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
                            text: 'Account updated successfully!',
                            confirmButtonText: 'Ok'
                        }).then(() => {
                            window.location.href = 'accReg.php?tab=account';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.error || 'An unexpected error occurred.',
                            confirmButtonText: 'Ok'
                        });
                    }
                }
            });
        });


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
                        supervisorBoth.val(`${sup1} / ${sup2}`);

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