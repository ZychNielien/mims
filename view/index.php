<?php

// Session Start
session_start();

// Database Connection
include "../model/dbconnection.php";

?>


<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="icon" href="../public/img/favicon.ico" type="image/x-icon">

    <!-- Title -->
    <title>AIMS</title>

    <!-- Bootstrap Style -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

    <!-- Fontawesome Style -->
    <link rel="stylesheet" href="../fontawesome/css/all.min.css">

    <!-- Login Style -->
    <link rel="stylesheet" href="../public/css/index.css">

    <!-- Sweetalert Style -->
    <link rel="stylesheet" href="../public/css/sweetalert.min.css">

    <!-- Sweetalert Script -->
    <script src="../public/js/sweetalert2@11.js"></script>

    <!-- Jquery Script -->
    <script src="../public/js/jquery.js"></script>

</head>

<body>

    <!-- Main Container -->
    <div class="d-flex flex-column justify-content-center align-items-center vh-100 px-5">

        <!-- Logo Div -->
        <div class="d-flex justify-content-center mb-5">
            <img src="../public/img/mLogo.png" style="width: 150px;" alt="">
        </div>

        <!-- Content Container -->
        <div class="container box-shadow-container" style="max-width: 600px">

            <!-- Navigation Tab -->
            <ul class="nav nav-pills mb-3 w-100 border" id="ex1" role="tablist">
                <li class="nav-item w-50 text-center" role="presentation">
                    <a class="nav-link active" id="tab-login" data-bs-toggle="pill" href="#pills-login" role="tab"
                        aria-controls="pills-login" aria-selected="true">Login</a>
                </li>
                <li class="nav-item w-50 text-center" role="presentation">
                    <a class="nav-link" id="tab-register" data-bs-toggle="pill" href="#pills-register" role="tab"
                        aria-controls="pills-register" aria-selected="false">Register</a>
                </li>
            </ul>

            <!-- Navigation Tab Content -->
            <div class="tab-content form-container">

                <!-- Login Tab -->
                <div class="tab-pane fade show active form-content" id="pills-login" role="tabpanel"
                    aria-labelledby="tab-login">

                    <!-- Login Title -->
                    <h4 class="text-center mb-4">Welcome back! Please log in to continue.</h4>

                    <!-- Login Form -->
                    <form method="POST" action="../controller/login.php">

                        <!-- Username -->
                        <div class="mb-4">
                            <label for="loginName" class="form-label">Username</label>
                            <input type="text" id="loginName" class="form-control" placeholder="Enter your username"
                                name="username" autocomplete="off" required />
                        </div>

                        <!-- Password -->
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

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-color btn-block mb-4 w-100" name="loginUser">Sign
                            in</button>

                    </form>

                    <div class="text-center">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPassword">Forgot password?</a>
                    </div>

                </div>

                <!-- Registration Tab -->
                <div class="tab-pane fade form-content" id="pills-register" role="tabpanel"
                    aria-labelledby="tab-register">

                    <!-- Registration Title -->
                    <h4 class="text-center mb-4">Create an account to get started</h4>

                    <!-- Registration Form -->
                    <form method="POST" action="../controller/user.php"
                        style="max-height: 470px; overflow-y: auto; overflow-x: hidden;">

                        <!-- Employee Name -->
                        <div class="mb-2">
                            <label for="employee_name" class="form-label">Employee Name</label>
                            <input type="text" id="employee_name" class="form-control" autocomplete="off"
                                name="employee_name" placeholder="Enter your name" required />
                        </div>


                        <div class="mb-2 row">

                            <!-- Username -->
                            <div class="col-12 col-sm-6">
                                <label for="employee_username" class="form-label">Username</label>
                                <input type="text" id="employee_username" class="form-control" name="employee_username"
                                    placeholder="Enter your username" autocomplete="off" required />
                            </div>

                            <!-- Password -->
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

                            <!-- Badge Number -->
                            <div class="col-12 col-sm-6">
                                <label for="badge_number" class="form-label">Badge Number</label>
                                <input type="text" id="badge_number" class="form-control" name="badge_number"
                                    placeholder="Enter your badge number" autocomplete="off" required />
                            </div>

                            <!-- Designation -->
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

                            <!-- Account Type -->
                            <div class="col-12 col-sm-6">
                                <label for="account_type" class="form-label">Account Type</label>
                                <select class="form-select" id="account_type" name="account_type" required>
                                    <option selected value>Select Account Type</option>
                                    <option value="User">User</option>
                                    <option value="Kitting">Kitting</option>
                                    <option value="Supervisor">Supervisor</option>
                                </select>
                            </div>

                            <!-- Cost Center -->
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

                            <!-- Supervisor -->
                            <div class="col-12 col-sm-6">
                                <label for="create_supervisor_one" class="form-label">Supervisor</label>
                                <input type="text" class="form-control" id="create_supervisor_one"
                                    placeholder="Enter Supervisor" name="supervisor_one" required readonly>
                            </div>

                            <!-- Supervisor 2 -->
                            <div class="col-12 col-sm-6">
                                <label for="create_supervisor_two" class="form-label">Supervisor</label>
                                <input type="text" class="form-control" id="create_supervisor_two"
                                    placeholder="Enter Supervisor" name="supervisor_two" readonly>
                            </div>

                        </div>

                        <!-- Registration Submit -->
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

    <script>

        <?php if (isset($_SESSION['status'])): ?>


            if ('<?php echo $_SESSION["status"]; ?>' === "Unfortunately, your account has been rejected.") {
                Swal.fire({
                    text: "<?php echo $_SESSION['status']; ?>",
                    icon: "error",
                    showCancelButton: true,
                    confirmButtonText: 'Create a new account',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../controller/forgot_pass.php';
                    } else {
                        Swal.close();
                    }
                });
            } else {

                Swal.fire({
                    text: "<?php echo $_SESSION['status']; ?>",
                    icon: "<?php echo $_SESSION['status_code']; ?>",
                    showConfirmButton: true
                });
            }
        <?php endif; ?>

        $(document).ready(function () {

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