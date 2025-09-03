<?php

session_start();

include "../../model/dbconnection.php";

$page = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$tab = isset($_GET['tab']) ? $_GET['tab'] : 'default';

if ($_SESSION['user'] == 'User') {
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../../public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../bootstrap/js/bootstrap.min.js">
    <link rel="stylesheet" href="../../public/css/sweetalert.min.css">
    <link rel="stylesheet" href="../../public/css/navigation.css">
    <script src="../../public/js/bootstrap.bundle.js"></script>
    <script src="../../public/js/sweetalert2@11.js"></script>
    <script src="../../public/js/jquery.js"></script>

</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg" style="background-color: #900008;">

        <div class="container d-flex justify-evenly  w-100">

            <div class="w-50">
                <img src="../../public/img/AIMSLogo.png" class="w-75" alt="">
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
                    " aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="adminInventory.php" class=" <?php
                        if ($page == "adminInventory.php") {
                            echo "nav-link active";
                        } else {
                            echo "nav-link text-white";
                        }
                        ?>
                    " aria-current="page" href="#">Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a href="adminWithdrawal.php" style="<?php
                        if ($page == "adminWithdrawal.php") {
                            echo "  background-color: white;
                                    color: #900008;
                                    border-radius: 5px;
                                    text-align: center;";
                        } else {
                            echo "color: white;";
                        }
                        ?>" class=" nav-link" aria-current="page" href="#">Withdrawal </a>
                    </li>
                    <?php if ($_SESSION['designation'] !== 'Manager' && $_SESSION['designation'] !== 'IE'): ?>
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
                    <?php endif; ?>
                    <li class="nav-item dropdown">
                        <a class=" <?php
                        if ($page == "adminIssuance.php" || $page == "adminRejection.php" || $page == "adminReceiving.php" || $page == "adminExpired.php" || $page == "adminLog.php") {
                            echo "nav-link dropdown-toggle active";
                        } else {
                            echo "nav-link dropdown-toggle text-white";
                        }
                        ?>
                    " href="#" id="Submenu-Dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            History
                        </a>
                        <ul class="dropdown-menu rounded-3" aria-labelledby="Submenu-Dropdown">
                            <li><a class="dropdown-item" href="adminIssuance.php">Issuance History</a></li>
                            <li><a class="dropdown-item" href="adminReceiving.php">Receiving History</a></li>
                            <li><a class="dropdown-item" href="adminRejection.php">Rejection History</a></li>
                            <li><a class="dropdown-item" href="adminExpired.php">Expired Part History</a></li>
                            <li><a class="dropdown-item" href="adminLog.php">Log History</a></li>
                        </ul>
                    </li>
                    <?php if ($_SESSION['designation'] !== 'Manager' && $_SESSION['designation'] !== 'IE'): ?>
                        <li class="nav-item">
                            <a href="adminScrap.php" class=" <?php
                            if ($page == "adminScrap.php") {
                                echo "nav-link active";
                            } else {
                                echo "nav-link text-white";
                            }
                            ?>
                    " href="#">Return</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($_SESSION['user'] !== 'Kitting'): ?>
                        <li class="nav-item" id="accountRegistrationKitting">
                            <a href="accReg.php" style="<?php
                            if ($page == "accReg.php") {
                                echo "  background-color: white;
                                    color: #900008;
                                    border-radius: 5px;
                                    text-align: center;";
                            } else {
                                echo "color: white;";
                            }
                            ?>" class=" nav-link">Registration</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <div class="btn-group float-end mx-3">
                    <div class="notification-bell" id="notification-bell" data-bs-toggle="dropdown"
                        aria-expanded="false" style="z-index: 1000;">
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
                        <?php if ($_SESSION['user'] !== 'Kitting'): ?>
                            <li><a href="adminData.php" class="dropdown-item"><i class="bi bi-gear-fill"></i> Data
                                    Management</a></li>
                        <?php endif; ?>
                        <li><a href="adminManual.php" class="dropdown-item"><i class="bi bi-journal-bookmark-fill"></i>
                                System User
                                Guide </a></li>
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

    <!-- Change Password Modal -->
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
                            <label for="old_password" class="form-label">Old Password</label>
                            <input type="password" class="form-control" id="old_password" name="old_password" required>
                            <i class="bi bi-eye-slash" id="toggle_old_password" data-toggle="password"
                                data-target="#old_password"
                                style="position: absolute; right: 10px; top: 40px; cursor: pointer;"></i>
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <i class="bi bi-eye-slash" id="toggle_password" data-toggle="password"
                                data-target="#password"
                                style="position: absolute; right: 10px; top: 40px; cursor: pointer;"></i>
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                required>
                            <i class="bi bi-eye-slash" id="toggle_confirm_password" data-toggle="password"
                                data-target="#confirm_password"
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

    <script>

        $(document).ready(function () {

            fetchNotifications();
            setInterval(fetchNotifications, 2000);

            $('#notification-bell').on('click', function () {
                markAllAsRead();
            });

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

            // Reusable Password Toggle Script
            $('[data-toggle="password"]').click(function () {
                const targetInput = $($(this).data('target'));
                const icon = $(this);

                const isPassword = targetInput.attr('type') === 'password';
                targetInput.attr('type', isPassword ? 'text' : 'password');

                icon.toggleClass('bi-eye-slash', !isPassword);
                icon.toggleClass('bi-eye', isPassword);
            });
        });

        // Notification Time Ago
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

        // Fetch Notification Function
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

                        let notificationLink = "adminApproval.php";
                        if (notification.destination === "Scrap") {
                            notificationLink = "adminScrap.php";
                        } else if (notification.destination === "Inventory") {
                            notificationLink = "adminInventory.php";
                        } else if (notification.destination === "Expired") {
                            notificationLink = "adminExpired.php";
                        } else if (notification.destination === "Approved") {
                            notificationLink = "adminWithdrawal.php?tab=approved";
                        } else if (notification.destination === "Rejected") {
                            notificationLink = "adminWithdrawal.php?tab=rejected";
                        } else if (notification.destination === "Returned") {
                            notificationLink = "adminWithdrawal.php?tab=returned";
                        } else if (notification.destination === "Request password change") {
                            notificationLink = "accReg.php?tab=password";
                        } else if (notification.destination === "Account Registration Pending Approval") {
                            notificationLink = "accReg.php";
                        }

                        notificationElement.append(`
                            <div>
                                <a class="amessage" href="${notificationLink}">
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

        // Notification Mark as Read Function
        function markAllAsRead() {
            $.ajax({
                url: '../../controller/mark_read.php',
                method: 'POST',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
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