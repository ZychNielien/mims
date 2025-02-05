<?php
include "../../model/dbconnection.php";
include "navBar.php";

$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode("/", $path);
$page = $components[4];
?>

<head>
    <title>Acoount Registration</title>
    <link rel="stylesheet" href="../../public/css/table.css">
    <link rel="stylesheet" href="../../public/css/sweetalert.min.css">
    <script src="../../public/js/sweetalert2@11.js"></script>
    <script src="../../public/js/jquery.js"></script>
</head>

<section>
    <div class="container">
        <div class="welcomeDiv my-3">
            <h2 class="text-center" style="color: #900008; font-weight: bold;">List of Registered Users</h2>
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true">Account Creation</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                    role="tab" aria-controls="profile" aria-selected="false">Cost Center / Supervisor</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success my-2" data-bs-toggle="modal" data-bs-target="#accCreation">Register
                        Account</button>

                </div>

                <table class="table table-striped w-100">
                    <thead>
                        <tr class="text-center" style="background-color: #900008; color: white;">
                            <th scope="col">Employee Name</th>
                            <th scope="col">Badge No.</th>
                            <th scope="col">Cost Center</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Supervisor</th>
                            <th scope="col">Account Type</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="data-table">
                        <?php
                        $userName = $_SESSION['username'];
                        $sql = "SELECT *
                                FROM tbl_users u
                                WHERE u.usertype = 2";
                        $sql_query = mysqli_query($con, $sql);

                        if (mysqli_num_rows($sql_query) > 0) {
                            while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                                ?>
                                <tr class="table-row text-center">
                                    <td data-label="Employee Name"><?php echo $sqlRow['employee_name']; ?></td>
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
                                        <button class="btn btn-primary btn-edit" data-bs-toggle="modal"
                                            data-bs-target="#editUserModal" data-id="<?php echo $sqlRow['id']; ?>"
                                            data-employee_name="<?php echo $sqlRow['employee_name']; ?>"
                                            data-badge_number="<?php echo $sqlRow['badge_number']; ?>"
                                            data-ccid="<?php echo $sqlRow['cost_center']; ?>"
                                            data-designation="<?php echo $sqlRow['designation']; ?>"
                                            data-supervisor_one="<?php echo $sqlRow['supervisor_one']; ?>"
                                            data-supervisor_two="<?php echo $sqlRow['supervisor_two']; ?>"
                                            data-account_type="<?php echo $sqlRow['account_type']; ?>"
                                            data-username="<?php echo $sqlRow['username']; ?>">Edit</button>
                                        <button class="btn btn-danger btn-delete"
                                            data-id="<?php echo $sqlRow['id']; ?>">Delete</button>
                                    </td>
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
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="d-flex justify-content-end">

                    <button class="btn btn-success my-2" data-bs-toggle="modal" data-bs-target="#cost_center">Cost
                        Center /
                        Supervisor</button>
                </div>

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
                    <tbody id="data-table">
                        <?php

                        $sql_ccs = "SELECT * FROM `tbl_ccs`";
                        $sql_ccs_query = mysqli_query($con, $sql_ccs);

                        if (mysqli_num_rows($sql_ccs_query) > 0) {
                            while ($ccs_row = mysqli_fetch_assoc($sql_ccs_query)) {
                                ?>
                                <tr class="text-center">
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
                                            data-id="<?php echo $ccs_row['id'] ?>">Delete</button>
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
                            <input type="text" class="form-control" id="new_ccid" name="new_ccid" required>
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="new_ccid_name" class="form-label">New CCID Name</label>
                            <input type="text" class="form-control" id="new_ccid_name" name="new_ccid_name" required>
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="project_code" class="form-label">Project Code</label>
                            <input type="text" class="form-control" id="project_code" name="project_code" required>
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="project_name" class="form-label">Project Name</label>
                            <input type="text" class="form-control" id="project_name" name="project_name" required>
                        </div>
                        <div class="mb-3 position-relative ">
                            <label for="badge_one" class="form-label">Badge No.</label>
                            <div class="d-flex justify-content-between">
                                <input type="text" class="form-control mx-1" id="badge_one" name="badge_one" required>
                                <input type="text" class="form-control mx-1" id="badge_two" name="badge_two">
                            </div>
                        </div>
                        <div class="mb-3 position-relative ">
                            <label for="supervisor_one" class="form-label">Supervisor</label>
                            <div class="d-flex justify-content-between">
                                <input type="text" class="form-control mx-1" id="supervisor_one" name="supervisor_one"
                                    required>
                                <input type="text" class="form-control mx-1" id="supervisor_two" name="supervisor_two">
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
                            <input type="text" class="form-control" id="edit_id" name="id" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_new_ccid" class="form-label">New CCID</label>
                            <input type="text" class="form-control" id="edit_new_ccid" name="new_ccid" required>
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="edit_new_ccid_name" class="form-label">New CCID Name</label>
                            <input type="text" class="form-control" id="edit_new_ccid_name" name="new_ccid_name"
                                required>
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="edit_project_code" class="form-label">Project Code</label>
                            <input type="text" class="form-control" id="edit_project_code" name="project_code" required>
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="edit_project_name" class="form-label">Project Name</label>
                            <input type="text" class="form-control" id="edit_project_name" name="project_name" required>
                        </div>
                        <div class="mb-3 position-relative ">
                            <label for="edit_badge_one" class="form-label">Badge No.</label>
                            <div class="d-flex justify-content-between">
                                <input type="text" class="form-control mx-1" id="edit_badge_one" name="badge_one"
                                    required>
                                <input type="text" class="form-control mx-1" id="edit_badge_two" name="badge_two">
                            </div>
                        </div>
                        <div class="mb-3 position-relative ">
                            <label for="edit_supervisor_one" class="form-label">Supervisor</label>
                            <div class="d-flex justify-content-between">
                                <input type="text" class="form-control mx-1" id="edit_supervisor_one"
                                    name="supervisor_one" required>
                                <input type="text" class="form-control mx-1" id="edit_supervisor_two"
                                    name="supervisor_two">
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
                            <input type="text" class="form-control" id="employee_name" name="employee_name" required>
                        </div>
                        <div class="mb-3 position-relative d-flex justify-content-evenly">
                            <div class="w-50 mx-1">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control " id="username" name="username" required>
                            </div>
                            <div class="w-50  mx-1">
                                <label for="passwordred" class="form-label">Password</label>
                                <input type="password" class="form-control" id="passwordred" name="password" required>
                                <i class="bi bi-eye-slash" id="toggle-password"
                                    style="position: absolute; right: 10px; top: 40px; cursor: pointer;"></i>
                            </div>
                        </div>
                        <div class="mb-3 position-relative d-flex justify-content-evenly">
                            <div class="w-50 mx-1">
                                <label for="badge_number" class="form-label">Badge Number</label>
                                <input type="text" class="form-control " id="badge_number" name="badge_number" required>
                            </div>
                            <div class="w-50  mx-1">
                                <label for="designation" class="form-label">Designation</label>
                                <select class="form-select" id="designation" name="designation" required>
                                    <option selected value="">Select Designation</option>
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
                                    name="supervisor_one" required readonly>
                                <input type="text" class="form-control mx-1" id="create_supervisor_two"
                                    name="supervisor_two" readonly>
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

    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editUserModalLabel">Edit User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../../controller/user.php">
                        <input type="hidden" id="edit-user-id" name="user_id">
                        <div class="mb-3 mx-1">
                            <label for="edit_employee_name" class="form-label">Employee Name</label>
                            <input type="text" class="form-control" id="edit_employee_name" name="employee_name"
                                required>
                        </div>
                        <div class="mb-3 position-relative d-flex justify-content-evenly">
                            <div class="w-50 mx-1">
                                <label for="edit_badge_number" class="form-label">Badge Number</label>
                                <input type="text" class="form-control " id="edit_badge_number" name="badge_number"
                                    required>
                            </div>
                            <div class="w-50  mx-1">
                                <label for="edit_designation" class="form-label">Designation</label>
                                <select class="form-select" id="edit_designation" name="designation" required>
                                    <option selected value="">Select Designation</option>
                                    <option value="Kitting">Kitting</option>
                                    <option value="Inspector">Inspector</option>
                                    <option value="Operator">Operator</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 position-relative d-flex justify-content-evenly">
                            <div class="w-50 mx-1">
                                <label for="edit_account_type" class="form-label">Account Type</label>
                                <select class="form-select" id="edit_account_type" name="account_type" required>
                                    <option selected value="">Select Account Type</option>
                                    <option value="User">User</option>
                                    <option value="Supervisor">Supervisor</option>
                                </select>
                            </div>
                            <div class="w-50 mx-1">
                                <label for="edit_cost_center" class="form-label">Cost Center</label>
                                <select class="form-select" id="edit_cost_center" name="cost_center" required>
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
                            <label for="create_edit_supervisor_one" class="form-label">Supervisor</label>
                            <div class="d-flex justify-content-between">
                                <input type="text" class="form-control mx-1" id="create_edit_supervisor_one"
                                    name="supervisor_one" required readonly>
                                <input type="text" class="form-control mx-1" id="create_edit_supervisor_two"
                                    name="supervisor_two" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="editUser">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    $(document).ready(function () {

        $(document).on('change', '#create_cost_center', function () {
            var costCenterId = $('#create_cost_center option:selected').data('id');

            if (costCenterId) {
                $.ajax({
                    url: 'fetch_supervisors.php',
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

        $(document).on('change', '#edit_cost_center', function () {
            var costCenterId = $('#edit_cost_center option:selected').data('id');

            if (costCenterId) {
                $.ajax({
                    url: 'fetch_supervisors.php',
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


        $('#designation').on('change', function () {
            if (this.value === '0') {
                alert("Please select a valid designation.");
                this.value = '';
            }
        });


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


        $('.delete_css').on('click', function () {
            var itemId = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this action!",
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


        $('.btn-edit').on('click', function () {
            var userId = $(this).data('id');
            var user_employee_name = $(this).data('employee_name');
            var user_badge_number = $(this).data('badge_number');
            var user_cost_center = $(this).data('ccid');
            var user_designation = $(this).data('designation');
            var user_supervisor_one = $(this).data('supervisor_one');
            var user_supervisor_two = $(this).data('supervisor_two');
            var user_account_type = $(this).data('account_type');

            $('#edit-user-id').val(userId);
            $('#edit_employee_name').val(user_employee_name);
            $('#edit_badge_number').val(user_badge_number);
            $('#edit_cost_center').val(user_cost_center);
            $('#edit_designation').val(user_designation);
            $('#edit_account_type').val(user_account_type);
            $('#create_edit_supervisor_one').val(user_supervisor_one);
            $('#create_edit_supervisor_two').val(user_supervisor_two);
        });

        $('.btn-delete').on('click', function () {
            var userId = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this action!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../../controller/user.php?id=" + userId;
                }
            });
        });

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
    });
</script>