<?php
include "../model/dbconnection.php";

if (isset($_GET['term'])) {
    $term = "%{$_GET['term']}%";

    $sql = "SELECT DISTINCT ti.id, ti.part_name, ti.part_desc, SUM(ts.part_qty) AS total_qty
        FROM tbl_inventory ti 
        LEFT JOIN tbl_stock ts ON ti.part_name = ts.part_name
        WHERE ti.part_desc LIKE ? AND ts.status = 'Active'
        GROUP BY ti.part_name
        HAVING total_qty > 0
        ORDER BY 
            REGEXP_REPLACE(ti.part_name, '[0-9]+$', ''), 
            CAST(REGEXP_SUBSTR(ti.part_name, '[0-9]+$') AS UNSIGNED)
        LIMIT 10";


    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $term);
    $stmt->execute();
    $result = $stmt->get_result();

    $suggestions = [];
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = [
            "label" => $row["part_desc"],
            "value" => $row["part_desc"],
            "id" => $row["id"],
            "part_name" => $row["part_name"]
        ];
    }

    echo json_encode($suggestions);
}
?>