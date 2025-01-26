<?php
include "navBar.php";
include "../../model/dbconnection.php";

?>

<head>
    <title>Material Inventory</title>
    <link rel="stylesheet" href="../../public/css/table.css">
    <link rel="stylesheet" href="../../public/css/sweetalert.min.css">
    <script src="../../public/js/sweetalert2@11.js"></script>
    <script src="../../public/js/jquery.js"></script>
</head>
<section style="max-height: 90%;">
    <div class="welcomeDiv my-2">
        <h2 class="text-center" style="color: #900008; font-weight: bold;">Welcome, <?php echo $_SESSION['username'] ?>!
        </h2>
    </div>
    <div class="container hatian d-flex justify-between align-center w-100">
        <div class="divWithdrawal p-2 w-25">

            <fieldset class="px-1 py-3">
                <div class="d-flex justify-content-center">
                    <h4 class="fw-bold" style="color: #900008;">
                        Add New Part
                    </h4>
                </div>
                <form method="POST" action="../../controller/inventory.php">
                    <div class="mb-1">
                        <label for="new_part_name" class="form-label">Part Name</label>
                        <input type="text" class="form-control" id="new_part_name" name="new_part_name"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-1">
                        <label for="exampleInputPassword1" class="form-label">Item Description</label>
                        <textarea class="form-control" id="new_part_desc" name="new_part_desc" rows="2"></textarea>
                    </div>
                    <div class="mb-1">
                        <label for="exampleInputEmail1" class="form-label">Item Quantity</label>
                        <input type="number" class="form-control" id="new_part_qty" name="new_part_qty"
                            aria-describedby="emailHelp">
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit_new_part">Submit</button>
                </form>
            </fieldset>

            <fieldset class="px-1 py-3">
                <div class="d-flex justify-content-center">
                    <h4 class="fw-bold" style="color: #900008;">
                        Update Inventory
                    </h4>
                </div>
                <form method="POST" action="../../controller/inventory.php">
                    <?php
                    $query = "SELECT id, part_name FROM tbl_inventory";
                    $result = mysqli_query($con, $query);
                    ?>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Part Name</label>
                        <select class="form-select" id="partSelect" name="part_name">
                            <option value="">Select a Part</option>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['part_name']) . '</option>';
                                }
                            } else {
                                echo '<option value="">No parts available</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div id="itemDetails" style="display: none;">
                        <div class="mb-1">
                            <label for="exampleInputPassword1" class="form-label">Item Description</label>
                            <textarea class="form-control" id="exampleTextarea" rows="2" name="new_part_desc"
                                readonly></textarea>
                        </div>
                        <div class="mb-1">
                            <label for="exampleInputEmail1" class="form-label">Item Quantity</label>
                            <input type="number" class="form-control" id="part_qty" name="part_qty" min="0" required>
                        </div>

                        <button type="submit" class="btn btn-primary" name="update_part_qty">Submit</button>
                    </div>
                </form>
            </fieldset>

        </div>
        <div class="divReq p-3 w-75">
            <div class="containerTitle">
                <h4 class="text-center" style="color: #900008;">Available Parts</h4>
            </div>
            <form id="deleteAll" method="POST" action="../../controller/inventory.php">
                <button type="button" class="btn btn-danger my-2" id="delete-selected-btn">Delete Selected</button>
                <table class="table table-striped w-100">
                    <thead>
                        <tr class="text-center"
                            style="background-color: #900008; color: white; vertical-align: middle;">
                            <th scope="col">
                                <input type="checkbox" id="select-all"> Select All
                            </th>
                            <th scope="col">Part Name</th>
                            <th scope="col">Item Description</th>
                            <th scope="col">Qty.</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `tbl_inventory`";
                        $sql_query = mysqli_query($con, $sql);
                        if ($sql_query) {
                            while ($sql_row = mysqli_fetch_assoc($sql_query)) {
                                ?>
                                <tr>
                                    <td><input type="checkbox" name="selected_items[]" value="<?php echo $sql_row['id']; ?>">
                                    </td>
                                    <td data-label="Part Name"><?php echo $sql_row['part_name']; ?></td>
                                    <td data-label="Part Desc"><?php echo $sql_row['part_desc']; ?></td>
                                    <td data-label="Part Qty"><?php echo $sql_row['part_qty']; ?></td>
                                    <td data-label="Action"> <a class="btn btn-primary edit-btn"
                                            data-id="<?php echo $sql_row['id']; ?>"
                                            data-name="<?php echo $sql_row['part_name']; ?>"
                                            data-desc="<?php echo $sql_row['part_desc']; ?>">Edit</a></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>

            </form>

        </div>

        <div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Part</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" method="POST" action="../../controller/inventory.php">
                            <input type="hidden" id="part_id" name="id">
                            <div class="form-group my-1">
                                <label for="part_name">Part Name</label>
                                <input type="text" class="form-control" id="part_name" name="part_name" required>
                            </div>
                            <div class="form-group my-1">
                                <label for="part_desc">Item Description</label>
                                <textarea class="form-control" id="part_desc" name="part_desc" rows="3"
                                    required></textarea>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="update_namedesc" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <script>
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const partId = this.getAttribute('data-id');
                    const partName = this.getAttribute('data-name');
                    const partDesc = this.getAttribute('data-desc');

                    document.getElementById('part_id').value = partId;
                    document.getElementById('part_name').value = partName;
                    document.getElementById('part_desc').value = partDesc;

                    $('#editModal').modal('show');
                });
            });

        </script>


        <script>
            document.getElementById('select-all').addEventListener('change', function () {
                var checkboxes = document.querySelectorAll('input[name="selected_items[]"]');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
            });

            document.getElementById('delete-selected-btn').addEventListener('click', function () {
                var selectedItems = document.querySelectorAll('input[name="selected_items[]"]:checked');

                if (selectedItems.length > 0) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete them!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var selectedIds = [];
                            selectedItems.forEach(item => {
                                selectedIds.push(item.value);
                            });

                            var formData = new FormData(document.getElementById('deleteAll'));
                            formData.append('delete_multiple', true);
                            formData.append('selected_items', JSON.stringify(selectedIds));

                            $.ajax({
                                url: '../../controller/inventory.php',
                                method: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function (response) {
                                    var data = JSON.parse(response);
                                    if (data.success) {
                                        Swal.fire({
                                            title: 'Deleted!',
                                            text: data.message,
                                            icon: 'success'
                                        }).then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: data.message,
                                            icon: 'error'
                                        });
                                    }
                                },
                                error: function (xhr, status, error) {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: "There was an issue with the request. Please try again.",
                                        icon: 'error'
                                    });
                                }
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'No items selected!',
                        text: "Please select at least one item to delete.",
                        icon: 'error'
                    });
                }
            });
        </script>


        <script>
            document.getElementById('partSelect').addEventListener('change', function () {
                var partId = this.value;

                if (partId) {
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', 'fetch_part_desc.php?part_id=' + partId, true);

                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            try {
                                var data = JSON.parse(xhr.responseText);

                                if (data.part_desc) {
                                    document.getElementById('itemDetails').style.display = 'block';

                                    document.getElementById('exampleTextarea').value = data.part_desc;
                                } else {
                                    document.getElementById('exampleTextarea').value = 'No description available';
                                }
                            } catch (e) {
                                console.error('Error parsing JSON:', e);
                            }
                        }
                    };

                    xhr.send();
                } else {
                    document.getElementById('itemDetails').style.display = 'none';
                    document.getElementById('exampleTextarea').value = '';
                }
            });
        </script>