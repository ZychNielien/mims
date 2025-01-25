<?php
session_start();
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode("/", $path);
$page = $components[4];

if ($_SESSION['user'] == 1) {
    $_SESSION['status'] = "The link is for user only.";
    $_SESSION['status_code'] = "error";
    header("Location: ../adminModule/adminDashboard.php");
    exit();
}


if (!isset($_SESSION['username'])) {

    $_SESSION['status'] = "Access Denied. Please log in as an user.";
    $_SESSION['status_code'] = "error";
    header("Location: ../index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>How To Create</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/sweetalert.min.css">
    <script src="../../public/js/sweetalert2@11.js"></script>
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
                <ul class="navbar-nav me-auto mt-2 mb-2 mb-lg-0 text-white">
                    <li class="nav-item">
                        <a href="userDashboard.php" class=" <?php
                        if ($page == "userDashboard.php") {
                            echo "nav-link active";
                        } else {
                            echo "nav-link text-white";
                        }
                        ?>
                    " aria-current="page" href="#">Material Withdrawal</a>
                    </li>
                    <li class="nav-item">
                        <a href="userHistory.php" class=" <?php
                        if ($page == "userHistory.php") {
                            echo "nav-link active";
                        } else {
                            echo "nav-link text-white";
                        }
                        ?>
                    " href="#">Withdrawal History</a>
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
                            <i class="bi bi-eye-slash" id="toggle-password"
                                style="position: absolute; right: 10px; top: 35px; cursor: pointer;"></i>
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <i class="bi bi-eye-slash" id="toggle-password"
                                style="position: absolute; right: 10px; top: 35px; cursor: pointer;"></i>
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                required>
                            <i class="bi bi-eye-slash" id="toggle-confirm-password"
                                style="position: absolute; right: 10px; top: 35px; cursor: pointer;"></i>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="changePassUser">Change Password</button>
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

</body>

</html>