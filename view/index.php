<?php

session_start();
include "../model/dbconnection.php";

?>


<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../public/img/favicon.ico" type="image/x-icon">
    <title>AIMS</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../public/css/index.css">
    <link rel="stylesheet" href="../public/css/sweetalert.min.css">
    <script src="../public/js/sweetalert2@11.js"></script>
    <script src="../public/js/jquery.js"></script>

</head>

<body>

    <div class="d-flex flex-column justify-content-center align-items-center vh-100 px-5">

        <div class="d-flex justify-content-center mb-5">
            <img src="../public/img/mLogo.png" style="width: 150px;" alt="">
        </div>

        <div class="container box-shadow-container" style="max-width: 600px">

            <ul class="nav nav-pills mb-3 w-100 border" id="ex1" role="tablist">
                <li class="nav-item w-50 text-center" role="presentation">
                    <a class="nav-link active" id="login-tab" data-bs-toggle="pill" href="#login-tab-pane" role="tab"
                        aria-controls="login-tab-pane" aria-selected="true">Login</a>
                </li>
                <li class="nav-item w-50 text-center" role="presentation">
                    <a class="nav-link" id="register-tab" data-bs-toggle="pill" href="#register-tab-pane" role="tab"
                        aria-controls="register-tab-pane" aria-selected="false">Register</a>
                </li>
            </ul>

            <div class="tab-content form-container">

                <!-- Login Tab -->
                <div class="tab-pane fade form-content" id="login-tab-pane" role="tabpanel" aria-labelledby="login-tab">

                    <h4 class="text-center mb-4">Welcome back! Please log in to continue.</h4>

                    <form method="POST" action="../controller/login.php">

                        <div class="mb-4">
                            <label for="loginName" class="form-label">Username</label>
                            <input type="text" id="loginName" class="form-control" placeholder="Enter your username"
                                name="username" autocomplete="off" required />
                        </div>

                        <div class="mb-4">
                            <label for="loginPassword" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" id="loginPassword" class="form-control"
                                    placeholder="Enter your password" name="password" required />
                                <button type="button" class="btn btn-outline-secondary" id="toggleLoginPassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-color btn-block mb-4 w-100" name="loginUser">Sign
                            in</button>

                    </form>

                    <div class="text-center">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPassword">Forgot password?</a>
                    </div>

                </div>

                <!-- Registration Tab -->
                <div class="tab-pane fade form-content" id="register-tab-pane" role="tabpanel"
                    aria-labelledby="register-tab">

                    <h4 class="text-center mb-4">Create an account to get started.</h4>

                    <form method="POST" action="../controller/user.php"
                        style="max-height: 470px; overflow-y: auto; overflow-x: hidden;">

                        <div class="mb-2">
                            <label for="employee_name" class="form-label">Employee Name</label>
                            <input type="text" id="employee_name" class="form-control" autocomplete="off"
                                name="employee_name" placeholder="Enter your name" required />
                        </div>

                        <div class="mb-2 row">
                            <div class="col-12 col-sm-6">
                                <label for="employee_username" class="form-label">Username</label>
                                <input type="text" id="employee_username" pattern="^[a-zA-Z0-9]+$"
                                    title="Username must contain only letters and numbers. Spaces and special characters are not allowed."
                                    class="form-control" name="employee_username" placeholder="Enter your username"
                                    autocomplete="off" required />
                            </div>
                            <div class="col-12 col-sm-6">
                                <label for="employee_password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" id="employee_password" class="form-control"
                                        placeholder="Enter your password" name="employee_password" required />
                                    <button type="button" class="btn btn-outline-secondary" id="toggleRegisterPassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <div class="col-12 col-sm-6">
                                <label for="badge_number" class="form-label">Badge Number</label>
                                <input type="text" id="badge_number" class="form-control" name="badge_number"
                                    placeholder="Enter your badge number" autocomplete="off" required />
                            </div>
                            <div class="col-12 col-sm-6">
                                <label for="designation" class="form-label">Designation</label>
                                <select class="form-select" id="designation" name="designation" required>
                                    <option selected value>Select Designation</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Kitting">Kitting</option>
                                    <option value="Inspector">Inspector</option>
                                    <option value="Operator">Operator</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <div class="col-12 col-sm-6">
                                <label for="account_type" class="form-label">Account Type</label>
                                <select class="form-select" id="account_type" name="account_type" required>
                                    <option selected value>Select Account Type</option>
                                    <option value="User">User</option>
                                    <option value="Kitting">Kitting</option>
                                    <option value="Supervisor">Supervisor</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label for="create_cost_center" class="form-label">Cost Center</label>
                                <select class="form-select" id="create_cost_center" name="cost_center" required>
                                    <option selected value>Select Cost Center</option>
                                    <?php
                                    $select_ccid = "SELECT * FROM tbl_ccs";
                                    $select_ccid_query = mysqli_query($con, $select_ccid);
                                    if (mysqli_num_rows($select_ccid_query) > 0) {
                                        while ($ccid_row = mysqli_fetch_assoc($select_ccid_query)) {
                                            ?>
                                            <option value="<?php echo $ccid_row['ccid'] ?>"
                                                data-id="<?php echo $ccid_row['id'] ?>"><?php echo $ccid_row['ccid'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                        </div>
                        <div class="mb-4 row">
                            <div class="col-12 col-sm-6">
                                <label for="create_supervisor_one" class="form-label">Supervisor</label>
                                <input type="text" class="form-control" id="create_supervisor_one"
                                    placeholder="Enter Supervisor" name="supervisor_one" required readonly>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label for="create_supervisor_two" class="form-label">Supervisor</label>
                                <input type="text" class="form-control" id="create_supervisor_two"
                                    placeholder="Enter Supervisor" name="supervisor_two" readonly>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-color btn-block mb-4 w-100" name="account_submit">Sign
                            up</button>
                    </form>

                </div>

            </div>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="forgotPassword" tabindex="-1" aria-labelledby="forgotPasswordLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="forgotPasswordLabel">Forgot Password Modal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="../controller/login.php" method="POST">

                            <div class="mb-4">
                                <label for="forgot_username" class="form-label">Username</label>
                                <input type="text" id="forgot_username" class="form-control"
                                    placeholder="Enter your username" name="forgot_username" autocomplete="off"
                                    required />
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="forgot_pass">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap Script -->
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

    <?php if (isset($_SESSION['status'])): ?>
        <script>
            <?php
            $fullReason = "Unfortunately, your account application has been rejected due to the reason of " . ($_SESSION['reason'] ?? '');
            ?>
            let fullReason = <?php echo json_encode($fullReason); ?>;
            let status = <?php echo json_encode($_SESSION['status']); ?>;
            let statusCode = <?php echo json_encode($_SESSION['status_code']); ?>;

            if (status === fullReason) {
                Swal.fire({
                    text: status,
                    icon: "error",
                    showCancelButton: true,
                    confirmButtonText: 'Create a new account',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../controller/forgot_pass.php';
                    }
                });
            } else {
                Swal.fire({
                    text: status,
                    icon: statusCode,
                    showConfirmButton: true
                });
            }
        </script>
    <?php endif; ?>



    <script>

        $(document).ready(function () {

            const urlParams = new URLSearchParams(window.location.search);
            const activeTab = urlParams.get('tab') || 'login';
            $('.nav-link').removeClass('active');
            $('.tab-pane').removeClass('show active');
            $(`#${activeTab}-tab`).addClass('active');
            $(`#${activeTab}-tab-pane`).addClass('show active');

            // Show Password for Login Password
            $('#toggleLoginPassword').click(function () {
                let passwordField = $('#loginPassword');
                let type = passwordField.attr('type') === 'password' ? 'text' : 'password';
                passwordField.attr('type', type);
                $(this).find('i').toggleClass('fa-eye fa-eye-slash');
            });

            // Show Password for Registration Password
            $('#toggleRegisterPassword').click(function () {
                let passwordField = $('#employee_password');
                let type = passwordField.attr('type') === 'password' ? 'text' : 'password';
                passwordField.attr('type', type);
                $(this).find('i').toggleClass('fa-eye fa-eye-slash');
            });

            // Show Password for Registration Repeat Password
            $('#toggleRepeatPassword').click(function () {
                let passwordField = $('#registerRepeatPassword');
                let type = passwordField.attr('type') === 'password' ? 'text' : 'password';
                passwordField.attr('type', type);
                $(this).find('i').toggleClass('fa-eye fa-eye-slash');
            });

            // Cost Center Show Supervisors
            $(document).on('change', '#create_cost_center', function () {
                var costCenterId = $('#create_cost_center option:selected').data('id');

                if (costCenterId) {
                    $.ajax({
                        url: '../controller/fetch_supervisors.php',
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

        });

    </script>
</body>

</html>