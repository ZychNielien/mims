<?php
include "../model/dbconnection.php";

if (isset($_GET['description'])) {
    $description = $_GET['description'];

    $sql = "SELECT id, part_name FROM tbl_inventory WHERE part_desc = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $description);
    $stmt->execute();
    $result = $stmt->get_result();

    $parts = [];
    while ($row = $result->fetch_assoc()) {
        $parts[] = [
            "id" => $row["id"],
            "part_name" => $row["part_name"]
        ];
    }

    echo json_encode($parts);
}
?>