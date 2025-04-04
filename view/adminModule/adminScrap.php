<?php

// Database Connection
include "../../model/dbconnection.php";

// Navigation Bar
include "navBar.php";

?>

<head>

    <!-- Title -->
    <title>Scrap Material</title>

    <!-- Table Style -->
    <link rel="stylesheet" href="../../public/css/table.css">

    <!-- Sweetalert Style -->
    <link rel="stylesheet" href="../../public/css/sweetalert.min.css">

    <!-- Sweetalert Script -->
    <script src="../../public/js/sweetalert2@11.js"></script>

    <!-- Jquery Script -->
    <script src="../../public/js/jquery.js"></script>

</head>

<section>

    <!-- Title Div -->
    <div class="welcomeDiv my-4">
        <h2 class="text-center" style="color: #900008; font-weight: bold;">Scrap Materials
        </h2>
    </div>

    <!-- Main Container -->
    <div class="mx-5">

        <!-- Navigation Tab -->
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">Items Awaiting
                    Receipt</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Processed Returned
                    Items</button>
            </div>
        </nav>

        <!-- Navigation Tab Content -->
        <div class="tab-content" id="nav-tabContent">

            <!-- Items Awaiting Receipt Tab -->
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                <div class="mx-3 my-4">

                    <!-- Items Awaiting Receipt Table -->
                    <table class="table table-striped w-100">

                        <thead>
                            <tr class="text-center"
                                style="background-color: #900008; color: white; vertical-align: middle;">
                                <th scope="col">Date/Time of Return</th>
                                <th scope="col">Lot ID</th>
                                <th scope="col">Part Number</th>
                                <th scope="col">Qty.</th>
                                <th scope="col">Machine No.</th>
                                <th scope="col">Withdrawal Reason</th>
                                <th scope="col">Returned By</th>
                                <th scope="col">Status</th>
                                <th scope="col">Return Qty</th>
                                <th scope="col">Return Reason</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody id="data-table">
                            <?php

                            $userName = $_SESSION['username'];
                            $sql = "SELECT * FROM tbl_requested WHERE status = 'returning' ORDER BY dts_return DESC";


                            $sql_query = mysqli_query($con, $sql);

                            if (mysqli_num_rows($sql_query)) {
                                while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                                    ?>
                                    <tr class="table-row text-center" style="vertical-align: middle;">
                                        <td data-label="Date / Time / Shift"><?php echo $sqlRow['dts_return']; ?></td>
                                        <td data-label="Lot Id"><?php echo $sqlRow['lot_id']; ?></td>
                                        <td data-label="Part Name"><?php echo $sqlRow['part_name']; ?></td>
                                        <td data-label="Quantity"><?php echo $sqlRow['part_qty']; ?></td>
                                        <td data-label="Machine No"><?php echo $sqlRow['machine_no']; ?></td>
                                        <td data-label="Reason"><?php echo $sqlRow['with_reason']; ?></td>
                                        <td data-label="Return By"><?php echo $sqlRow['req_by']; ?></td>
                                        <td data-label="Status"><?php echo $sqlRow['status']; ?></td>
                                        <td data-label="Return Qty"><?php echo $sqlRow['return_qty']; ?></td>
                                        <td data-label="Return Reason"><?php echo $sqlRow['return_reason']; ?></td>
                                        <td data-label="Receive">
                                            <button class="btn btn-success receive-btn" data-id="<?php echo $sqlRow['id']; ?>"
                                                data-part_name="<?php echo $sqlRow['part_name']; ?>"
                                                data-part_qty="<?php echo $sqlRow['return_qty']; ?>"
                                                data-req_by="<?php echo $sqlRow['req_by']; ?>">Receive</button>

                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="11" class="text-center">No items found</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>

                    </table>

                </div>

            </div>

            <!-- Processed Returned Items -->
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                <div class="mx-3 my-4">

                    <!-- Processed Returned Items Table -->
                    <table class="table table-striped w-100">

                        <thead>
                            <tr class="text-center"
                                style="background-color: #900008; color: white; vertical-align: middle;">
                                <th scope="col">Date/Time of Received</th>
                                <th scope="col">Lot ID</th>
                                <th scope="col">Part Number</th>
                                <th scope="col">Qty.</th>
                                <th scope="col">Machine No.</th>
                                <th scope="col">Withdrawal Reason</th>
                                <th scope="col">Returned By</th>
                                <th scope="col">Status</th>
                                <th scope="col">Return Qty</th>
                                <th scope="col">Return Reason</th>
                                <th scope="col">Received By</th>
                            </tr>
                        </thead>

                        <tbody id="data-table">
                            <?php

                            $userName = $_SESSION['username'];
                            $sql = "SELECT * FROM tbl_requested WHERE status = 'returned' ORDER BY dts_receive DESC";


                            $sql_query = mysqli_query($con, $sql);

                            if (mysqli_num_rows($sql_query)) {
                                while ($sqlRow = mysqli_fetch_assoc($sql_query)) {
                                    ?>
                                    <tr class="table-row text-center" style="vertical-align: middle;">
                                        <td data-label="Date / Time / Shift"><?php echo $sqlRow['dts_receive']; ?></td>
                                        <td data-label="Lot Id"><?php echo $sqlRow['lot_id']; ?></td>
                                        <td data-label="Part Name"><?php echo $sqlRow['part_name']; ?></td>
                                        <td data-label="Quantity"><?php echo $sqlRow['part_qty']; ?></td>
                                        <td data-label="Machine No"><?php echo $sqlRow['machine_no']; ?></td>
                                        <td data-label="Reason"><?php echo $sqlRow['with_reason']; ?></td>
                                        <td data-label="Return By"><?php echo $sqlRow['req_by']; ?></td>
                                        <td data-label="Status"><?php echo $sqlRow['status']; ?></td>
                                        <td data-label="Return Qty"><?php echo $sqlRow['return_qty']; ?></td>
                                        <td data-label="Return Reason"><?php echo $sqlRow['return_reason']; ?></td>
                                        <td data-label="Received By"><?php echo $sqlRow['received_by']; ?></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="11" class="text-center">No items found</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</section>

<script>

    // Received Items Button
    $(document).on('click', '.receive-btn', function () {
        var itemId = $(this).data('id');
        var item_part_name = $(this).data('part_name');
        var item_part_qty = $(this).data('part_qty');
        var item_req_by = $(this).data('req_by');

        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to mark this item as received.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, mark as received',
            cancelButtonText: 'No, cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../../controller/return.php',
                    method: 'POST',
                    data: {
                        id: itemId,
                        part_name: item_part_name,
                        part_qty: item_part_qty,
                        req_by: item_req_by
                    },
                    success: function (response) {
                        Swal.fire(
                            'Received!',
                            'The item status has been updated.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    },
                    error: function () {
                        Swal.fire(
                            'Error!',
                            'There was an issue updating the status.',
                            'error'
                        );
                    }
                });
            }
        });
    });

</script>