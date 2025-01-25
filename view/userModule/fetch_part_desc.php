<?php
include "../../model/dbconnection.php";
header('Content-Type: application/json');

if (isset($_GET['part_id']) && !empty($_GET['part_id'])) {
    $part_id = $_GET['part_id'];

    $query = "SELECT part_desc FROM tbl_inventory WHERE id = '$part_id'";
    $result = mysqli_query($con, $query);

    $response = array();

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $response['part_desc'] = $row['part_desc'];
    } else {
        $response['part_desc'] = null;
    }

    echo json_encode($response);
}
?>