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
        <div class="d-flex justify-content-end">
            <button class="btn btn-success my-2" data-bs-toggle="modal" data-bs-target="#accCreation">Register
                Account</button>
        </div>

        <table class="table table-striped w-100">
            <thead>
                <tr class="text-center" style="background-color: #900008; color: white;">
                    <th scope="col">User Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="data-table">
                <?php
                $userName = $_SESSION['username'];
                $sql = "SELECT * FROM tbl_users WHERE usertype = 2";
                $sql_query = mysqli_query($con, $sql);

                if ($sql_query) {
                    while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                        ?>
                        <tr class="table-row text-center">
                            <td data-label="User Name"><?php echo $sqlRow['username']; ?></td>
                            <td data-label="Action">
                                <button class="btn btn-primary btn-edit" data-bs-toggle="modal" data-bs-target="#editUserModal"
                                    data-id="<?php echo $sqlRow['id']; ?>"
                                    data-username="<?php echo $sqlRow['username']; ?>">Edit</button>
                                <button class="btn btn-danger btn-delete" data-id="<?php echo $sqlRow['id']; ?>">Delete</button>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="accCreation" tabindex="-1" aria-labelledby="accCreationLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="accCreationLabel">Create New Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../../controller/user.php">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>

                        <div class="mb-3 position-relative">
                            <label for="passwordred" class="form-label">Password</label>
                            <input type="password" class="form-control" id="passwordred" name="password" required>
                            <i class="bi bi-eye-slash" id="toggle-password"
                                style="position: absolute; right: 10px; top: 40px; cursor: pointer;"></i>
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="confirm_passwordred" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_passwordred" name="confirm_password"
                                required>
                            <i class="bi bi-eye-slash" id="toggle-confirm-password"
                                style="position: absolute; right: 10px; top: 40px; cursor: pointer;"></i>
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
                        <div class="mb-3">
                            <label for="edit-username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="edit-username" name="username" required>
                            <input type="hidden" id="edit-user-id" name="user_id">
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
        $('.btn-edit').on('click', function () {
            var userId = $(this).data('id');
            var username = $(this).data('username');

            $('#edit-user-id').val(userId);
            $('#edit-username').val(username);
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