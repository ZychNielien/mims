<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/style.css">
    <link rel="stylesheet" href="../../public/css/sweetalert.min.css">



</head>

<body>

    <div class="bg-primary-color d-flex flex-column justify-between w-100 h-100 contentContainer">
        <div class="logoContainer">
            <img class="logo" src="../public/img/logo.png" alt="MIMS Logo">
        </div>

        <div class="flex-grow-1">
            <div class="loginCard">
                <h2 class="mb-3">Login</h2>
                <form method="POST" action="../controller/login.php">
                    <div class="mb-3">

                        <input type="text" class="form-control" name="username" id="exampleInputEmail1"
                            aria-describedby="emailHelp">

                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" id="passInput">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="showPassword">
                        <label class="form-check-label" for="showPassword">Show password</label>
                    </div>
                    <button type="submit" class="loginButton" name="loginUser">Login</button>
                </form>
            </div>
        </div>

        <div class="bottomLogo flex-grow-1">
            <img src="../public/img/mLogo.png" class alt="MIMS Bottom Logo">
        </div>
    </div>

    <script src="../public/js/jquery.js"></script>
    <script src="../public/js/script.js"></script>

    <script src="../../public/js/sweetalert2@11.js"></script>

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