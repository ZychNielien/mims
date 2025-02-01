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
    header("Location: ../userModule/userDashboard.php");
    exit();
}


if (!isset($_SESSION['username'])) {
    $_SESSION['status'] = "Access Denied. Please log in as an admin.";
    $_SESSION['status_code'] = "error";
    header("Location: ../index.php");
    exit();
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

        .amessage {
            text-decoration: none;
            list-style: none;
            color: #000;
        }

        .nav-item a {
            text-align: center;
        }

        .notification-bell {
            position: relative;
            z-index: 9999;
            display: inline-block;
            cursor: pointer;
        }

        .notification-bell .badge {
            position: absolute;
            top: -10px;
            right: -15px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 5px 10px;
        }

        #notification-menu {
            width: 300px;
            max-height: 400px;
            overflow-y: scroll;
        }

        #notification-menu {
            width: 300px;
            max-height: 400px;
            overflow-y: scroll;
            padding: 10px;
        }

        #notification-menu::-webkit-scrollbar {
            width: 8px;
        }

        #notification-menu::-webkit-scrollbar-track {
            background: #f1f1f1;

        }

        #notification-menu::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        #notification-menu::-webkit-scrollbar-thumb:hover {
            background: #555;
        }


        #notification-menu::-webkit-scrollbar-corner {
            background: #ccc;
        }


        .notification-separator {
            border: 0;
            height: 2px;
            background-color: #000;
            margin: 10px 0;
        }

        .notification-message {
            max-width: 300px;
            margin: 0;
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }

        #notification-menu .dropdown-item.no-notifications {
            color: #888;
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
                        <a href="adminScrap.php" class=" <?php
                        if ($page == "adminScrap.php") {
                            echo "nav-link active";
                        } else {
                            echo "nav-link text-white";
                        }
                        ?>
                    " href="#">Scrap Material</a>
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
                <div class="btn-group float-end mx-3">
                    <div class="notification-bell" id="notification-bell" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-bell-fill" style="font-size: 20px; color: #fff;"></i>
                        <span class="badge" id="notification-count" style="display: none;">0</span>
                    </div>

                    <ul class="dropdown-menu dropdown-menu-end" id="notification-menu">
                    </ul>
                </div>

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


    <script>
        $(document).ready(function () {
            fetchNotifications();

            setInterval(fetchNotifications, 2000);

            $('#notification-bell').on('click', function () {
                console.log('Marking all unread notifications as read');
                markAllAsRead();
            });
        });

        function timeAgo(timestamp) {
            const now = new Date();
            const past = new Date(timestamp);
            const diffInSeconds = Math.floor((now - past) / 1000);

            const seconds = diffInSeconds;
            const minutes = Math.floor(diffInSeconds / 60);
            const hours = Math.floor(diffInSeconds / 3600);
            const days = Math.floor(diffInSeconds / 86400);
            const months = Math.floor(diffInSeconds / 2592000);
            const years = Math.floor(diffInSeconds / 31536000);

            if (years > 0) {
                return years === 1 ? "1 year ago" : years + " years ago";
            } else if (months > 0) {
                return months === 1 ? "1 month ago" : months + " months ago";
            } else if (days > 0) {
                return days === 1 ? "1 day ago" : days + " days ago";
            } else if (hours > 0) {
                return hours === 1 ? "1 hour ago" : hours + " hours ago";
            } else if (minutes > 0) {
                return minutes === 1 ? "1 minute ago" : minutes + " minutes ago";
            } else {
                return seconds === 1 ? "1 second ago" : seconds + " seconds ago";
            }
        }

        function fetchNotifications() {
            $.ajax({
                url: '../../controller/get_notif.php',
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    const notificationMenu = $('#notification-menu');
                    const notificationCount = $('#notification-count');

                    notificationMenu.empty();

                    if (response.message && response.message === 'No notifications') {
                        notificationMenu.append('<li class="dropdown-item">No notifications</li>');
                        notificationCount.hide();
                        return;
                    }

                    let unreadCount = 0;

                    response.forEach(function (notification) {
                        const notificationElement = $('<li class="dropdown-item" data-id="' + notification.id + '">');

                        const formattedTimeAgo = timeAgo(notification.created_at);

                        notificationElement.append(`
                    <div><a class="amessage" href="adminApproval.php">
                        <div class="d-flex justify-content-between">
                            <strong>${notification.username}</strong>  
                            <small>${formattedTimeAgo}</small>
                        </div>
                        <p class="notification-message">${notification.message}</p>
                        </a>
                    </div>
                `);

                        if (notification.is_read === 0) {
                            notificationElement.addClass('unread');
                        }

                        notificationMenu.append(notificationElement);

                        notificationMenu.append('<hr class="notification-separator">');

                        if (notification.is_read == 0) {
                            unreadCount++;
                        }
                    });

                    if (unreadCount > 0) {
                        notificationCount.text(unreadCount).show();
                    } else {
                        notificationCount.hide();
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching notifications:', xhr, status, error);
                }
            });
        }

        function markAllAsRead() {
            $.ajax({
                url: '../../controller/mark_read.php',
                method: 'POST',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        console.log('All notifications marked as read successfully');
                        fetchNotifications();
                    } else {
                        console.error('Error marking all notifications as read:', response.error);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX request failed:', status, error);
                }
            });
        }

    </script>
</body>

</html>