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

// UPDATE COST CENTERS
if (isset($_POST['updatecost_submit'])) {
    if (isset($_POST['ids']) && isset($_POST['ccids']) && isset($_POST['ccidNames']) && isset($_POST['projectCodes']) && isset($_POST['projectNames']) && isset($_POST['supervisorOnes']) && isset($_POST['badgeOnes']) && isset($_POST['supervisorTwos']) && isset($_POST['badgeTwos'])) {
        $ids = $_POST['ids'];
        $ccids = $_POST['ccids'];
        $ccidNames = $_POST['ccidNames'];
        $projectCodes = $_POST['projectCodes'];
        $projectNames = $_POST['projectNames'];
        $supervisorOnes = $_POST['supervisorOnes'];
        $badgeOnes = $_POST['badgeOnes'];
        $supervisorTwos = $_POST['supervisorTwos'];
        $badgeTwos = $_POST['badgeTwos'];
        $success = true;


        for ($i = 0; $i < count($ids); $i++) {
            $id = intval($ids[$i]);
            $ccid = mysqli_real_escape_string($con, $ccids[$i]);
            $ccidName = mysqli_real_escape_string($con, $ccidNames[$i]);
            $projectCode = mysqli_real_escape_string($con, $projectCodes[$i]);
            $projectName = mysqli_real_escape_string($con, $projectNames[$i]);
            $supervisorOne = mysqli_real_escape_string($con, $supervisorOnes[$i]);
            $badgeOne = mysqli_real_escape_string($con, $badgeOnes[$i]);
            $supervisorTwo = mysqli_real_escape_string($con, $supervisorTwos[$i]);
            $badgeTwo = mysqli_real_escape_string($con, $badgeTwos[$i]);

            $account_username = $_SESSION['username'];
            $action = "Cost Center Modification";
            $description = $account_username . " has successfully updated the details of the " . $ccid . " in the system.";
            $dts = date('Y-m-d H:i:s');

            $sql = "UPDATE `tbl_ccs` SET ccid = '$ccid' , ccid_name = '$ccidName' , project_code = '$projectCode' , project_name = '$projectName' , badge_one = '$badgeOne' , badge_two = '$badgeTwo' , supervisor_one = '$supervisorOne' , supervisor_two = '$supervisorTwo' WHERE id = '$id'";

            if (mysqli_query($con, $sql)) {

                $sql_log = "INSERT INTO `tbl_log` (username, action, description, dts) VALUES ('$account_username', '$action','$description' , '$dts')";
                if (!mysqli_query($con, $sql_log)) {
                    $success = false;
                    break;
                }

            }

        }

        if ($success) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "A database error occurred."]);
        }

    } else {
        echo json_encode(["success" => false, "error" => "Missing data"]);
    }
}

// DELETE COST CENTERS
if (isset($_POST['deletecost_submit'])) {
    if (isset($_POST['ids']) && isset($_POST['ccids']) && isset($_POST['reasons'])) {
        $ids = $_POST['ids'];
        $ccids = $_POST['ccids'];
        $reasons = $_POST['reasons'];
        $success = true;


        for ($i = 0; $i < count($ids); $i++) {
            $id = intval($ids[$i]);
            $ccid = mysqli_real_escape_string($con, $ccids[$i]);
            $reason = mysqli_real_escape_string($con, $reasons[$i]);
            $account_username = $_SESSION['username'];
            $action = "Cost Center Deletion";
            $description = $account_username . " has successfully deleted the " . $ccid . " from the system.";
            $dts = date('Y-m-d H:i:s');

            $sql = "DELETE FROM `tbl_ccs` WHERE id = '$id'";
            if (mysqli_query($con, $sql)) {

                $sql_log = "INSERT INTO `tbl_log` (username, action, description, dts, reasons) VALUES ('$account_username', '$action','$description' , '$dts', '$reason')";
                if (!mysqli_query($con, $sql_log)) {
                    $success = false;
                    break;
                }

            }

        }

        if ($success) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => "A database error occurred."]);
        }

    } else {
        echo json_encode(["success" => false, "error" => "Missing data"]);
    }
}

?>