<?php
session_start();
include "../../model/dbconnection.php";
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode("/", $path);
$page = $components[4];


if ($_SESSION['user'] == 2) {
    $_SESSION['status'] = "The link is for admin only.";
    $_SESSION['status_code'] = "error";
    header("Location: ../userModule/userDashboard.php");  // Modify path as needed
    exit();  // Stop further script execution
}


if (!isset($_SESSION['username'])) {
    // If not logged in or not an admin, redirect to login page
    $_SESSION['status'] = "Access Denied. Please log in as an admin.";
    $_SESSION['status_code'] = "error";
    header("Location: ../index.php");  // Modify the path to your login page
    exit();  // Stop further script execution
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="icon" href="../../public/img/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../bootstrap/js/bootstrap.min.js">
    <link rel="stylesheet" href="../../public/css/sweetalert.min.css">

    <script src="../../public/js/sweetalert2@11.js"></script>
    <script src="../../public/js/jquery.js"></script>

    <style>
        a.active {
            background-color: white;
            color: #900008;
            border-radius: 5px;
            text-align: center;
        }

        .nav-item a {
            text-align: center;
        }
    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg" style="background-color: #900008;">
        <div class="container d-flex justify-evenly  w-100">
            <div class="w-50">
                <img src="../../public/img/logo.png" class="w-75" alt="">
            </div>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarMobileToggle" aria-controls="navbarMobileToggle" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="bi bi-list font-bold"></i>
            </button>


            <div class="collapse navbar-collapse" id="navbarMobileToggle">
                <ul class="navbar-nav me-auto mt-2 mb-2 mb-lg-0 text-white d-flex justify-content-between">
                    <li class="nav-item">
                        <a href="adminDashboard.php" class=" <?php
                        if ($page == "adminDashboard.php") {
                            echo "nav-link active";
                        } else {
                            echo "nav-link text-white";
                        }
                        ?>
                    " aria-current="page" href="#">Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a href="adminApproval.php" class=" <?php
                        if ($page == "adminApproval.php") {
                            echo "nav-link active";
                        } else {
                            echo "nav-link text-white";
                        }
                        ?>
                    " aria-current="page" href="#">Approval</a>
                    </li>
                    <li class="nav-item">
                        <a href="adminHistory.php" class=" <?php
                        if ($page == "adminHistory.php") {
                            echo "nav-link active";
                        } else {
                            echo "nav-link text-white";
                        }
                        ?>
                    " href="#">History</a>
                    </li>
                    <li class="nav-item">
                        <a href="accReg.php" class=" <?php
                        if ($page == "accReg.php") {
                            echo "nav-link active";
                        } else {
                            echo "nav-link text-white";
                        }
                        ?>
                    " href="#">Registration</a>
                    </li>
                </ul>
                <div class="btn-group float-end">
                    <a href="#" class="dropdown-toggle text-decoration-none text-light" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i>
                        <span><?php echo $_SESSION['username'] ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#changePassword"><i
                                    class="bi bi-lock-fill"></i> Change Password</a></li>
                        <hr class="dropdown-divider">
                        </li>
                        <li><a href="../../controller/logout.php" class="dropdown-item"><i
                                    class="bi bi-box-arrow-right"></i> Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="changePasswordLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../../controller/user.php">
                        <div class="mb-3" style="display:none;">
                            <label for="userID" class="form-label">Username</label>
                            <input type="text" class="form-control" id="userID" name="userID"
                                value="<?php echo $_SESSION['username'] ?>" required>
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="old_password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="old_password" name="old_password" required>
                            <i class="bi bi-eye-slash" id="toggle_old_password"
                                style="position: absolute; right: 10px; top: 40px; cursor: pointer;"></i>
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <i class="bi bi-eye-slash" id="toggle_password"
                                style="position: absolute; right: 10px; top: 40px; cursor: pointer;"></i>
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                required>
                            <i class="bi bi-eye-slash" id="toggle_confirm_password"
                                style="position: absolute; right: 10px; top: 40px; cursor: pointer;"></i>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="changePass">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        <?php if (isset($_SESSION['status'])): ?>
            Swal.fire({
                text: "<?php echo $_SESSION['status']; ?>",
                icon: "<?php echo $_SESSION['status_code']; ?>",
                showConfirmButton: true
            });
            <?php
            unset($_SESSION['status']);
            unset($_SESSION['status_code']);
            ?>
        <?php endif; ?>
    </script>

    <script>
        $(document).ready(function () {
            // Toggle password visibility for old_password
            $('#toggle_old_password').click(function () {
                var passwordField = $('#old_password');
                var icon = $(this);

                if (passwordField.attr('type') === 'password') {
                    passwordField.attr('type', 'text');
                    icon.removeClass('bi-eye-slash').addClass('bi-eye');
                } else {
                    passwordField.attr('type', 'password');
                    icon.removeClass('bi-eye').addClass('bi-eye-slash');
                }
            });

            // Toggle password visibility for password
            $('#toggle_password').click(function () {
                var passwordField = $('#password');
                var icon = $(this);

                if (passwordField.attr('type') === 'password') {
                    passwordField.attr('type', 'text');
                    icon.removeClass('bi-eye-slash').addClass('bi-eye');
                } else {
                    passwordField.attr('type', 'password');
                    icon.removeClass('bi-eye').addClass('bi-eye-slash');
                }
            });

            // Toggle password visibility for confirm_password
            $('#toggle_confirm_password').click(function () {
                var passwordField = $('#confirm_password');
                var icon = $(this);

                if (passwordField.attr('type') === 'password') {
                    passwordField.attr('type', 'text');
                    icon.removeClass('bi-eye-slash').addClass('bi-eye');
                } else {
                    passwordField.attr('type', 'password');
                    icon.removeClass('bi-eye').addClass('bi-eye-slash');
                }
            });
        });

    </script>
</body>

</html>