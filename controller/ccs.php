<?php

include "../model/dbconnection.php";
session_start();
date_default_timezone_set('Asia/Manila');
header('Content-Type: application/json');

$input = json_decode(file_get_contents("php://input"), true);

// SUBMIT COST CENTER
if (isset($input['costCenterSubmit']) && is_array($input['items'])) {
    $items = $input['items'];
    $values = [];
    $valuesLog = [];

    $account_username = $_SESSION['username'] ?? 'unknown';
    $action = "Cost Center Registration";
    $dts = date('Y-m-d H:i:s');

    foreach ($items as $item) {
        $ccid = mysqli_real_escape_string($con, $item['ccid'] ?? '');
        $ccidName = mysqli_real_escape_string($con, $item['ccidName'] ?? '');
        $projectCode = mysqli_real_escape_string($con, $item['projectCode'] ?? '');
        $projectName = mysqli_real_escape_string($con, $item['projectName'] ?? '');
        $supervisorOne = mysqli_real_escape_string($con, $item['supervisorOne'] ?? '');
        $badgeOne = mysqli_real_escape_string($con, $item['badgeOne'] ?? '');
        $supervisorTwo = mysqli_real_escape_string($con, $item['supervisorTwo'] ?? '');
        $badgeTwo = mysqli_real_escape_string($con, $item['badgeTwo'] ?? '');

        $values[] = "('$ccid', '$ccidName', '$projectCode', '$projectName', '$badgeOne', '$badgeTwo', '$supervisorOne', '$supervisorTwo')";
        $description = mysqli_real_escape_string($con, "$account_username has successfully registered a new $ccid in the system.");
        $valuesLog[] = "('$account_username', '$action', '$description', '$dts')";
    }

    if (empty($values)) {
        echo json_encode(["message" => "No valid data to insert."]);
        exit;
    }

    $sql = "INSERT INTO tbl_ccs (ccid, ccid_name, project_code, project_name, badge_one, badge_two, supervisor_one, supervisor_two) VALUES " . implode(", ", $values);
    $sql_log = "INSERT INTO tbl_log (username, action, description, dts) VALUES " . implode(", ", $valuesLog);

    $result1 = mysqli_query($con, $sql);
    $result2 = mysqli_query($con, $sql_log);

    if ($result1 && $result2) {
        echo json_encode(["message" => "Cost Center(s) added successfully"]);
    } else {
        echo json_encode([
            "message" => "Insert failed",
            "error" => mysqli_error($con)
        ]);
    }
}



?>