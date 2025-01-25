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
            <table class="table table-striped w-100">
                <thead>
                    <tr style="background-color: #900008; color: white;">
                        <th scope="col">#</th>
                        <th scope="col">Part Name</th>
                        <th scope="col">Item Description</th>
                        <th scope="col">Qty.</th>
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
                                <td><input type="checkbox"></td>
                                <td data-label="Part Name"><?php echo $sql_row['part_name'] ?></td>
                                <td data-label="Part Desc"><?php echo $sql_row['part_desc'] ?></td>
                                <td data-label="Part Qty"><?php echo $sql_row['part_qty'] ?></td>
                            </tr>
                            <?php
                        }
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

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