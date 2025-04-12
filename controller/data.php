<?php

// Database Connection
include "../model/dbconnection.php";

// Session Start
session_start();
header('Content-Type: application/json');

$account_username = $_SESSION['username'];
$dts = date('Y-m-d H:i:s');

$input = json_decode(file_get_contents('php://input'), true);


// INSERT MACHINE NUMBER
if (isset($input['machineSubmit']) && is_array($input['items'])) {
    $duplicates = [];

    foreach ($input['items'] as $item) {
        $machineNumber = strtoupper(mysqli_real_escape_string($con, $item['machineNumber'] ?? ''));

        if (!$machineNumber) continue;

        $check_sql = "SELECT 1 FROM tbl_machine WHERE machine_number = '$machineNumber' LIMIT 1";
        $check_result = mysqli_query($con, $check_sql);

        if ($check_result && mysqli_num_rows($check_result) > 0) {
            $duplicates[] = $machineNumber;
        }
    }

    if (!empty($duplicates)) {
        echo json_encode([
            "message" => "Duplicate machine(s) found",
            "duplicates" => $duplicates
        ]);
        exit;
    }

    $values = [];
    $valuesLog = [];

    foreach ($input['items'] as $item) {
        $machineNumber = strtoupper(mysqli_real_escape_string($con, $item['machineNumber'] ?? ''));
        $values[] = "('$machineNumber')";
        $description = "$account_username has successfully registered a new $machineNumber in the system.";
        $valuesLog[] = "('$account_username', 'Machine Number Registration', '$description', '$dts')";
    }

    if (empty($values)) {
        echo json_encode(["message" => "No valid data to insert."]);
        exit;
    }

    $sql = "INSERT INTO tbl_machine (machine_number) VALUES " . implode(", ", $values);
    $result1 = mysqli_query($con, $sql);

    $sql_log = "INSERT INTO tbl_log (username, action, description, dts) VALUES " . implode(", ", $valuesLog);
    $result2 = mysqli_query($con, $sql_log);

    if ($result1 && $result2) {
        echo json_encode(["message" => "Machine(s) added successfully"]);
    } else {
        echo json_encode([
            "message" => "Insert failed",
            "error" => mysqli_error($con)
        ]);
    }
}

// UPDATE MACHINE NUMBER
if (isset($_POST['updatemachine_submit'])) {
    if (isset($_POST['ids']) && isset($_POST['machineNumbers'])) {
        $ids = $_POST['ids'];
        $machineNumbers = $_POST['machineNumbers'];
        $success = true;
        $errors = [];

        for ($i = 0; $i < count($ids); $i++) {
            $id = intval($ids[$i]);
            $machineNumber = strtoupper(mysqli_real_escape_string($con, $machineNumbers[$i]));

            $check_sql = "SELECT id FROM tbl_machine WHERE machine_number = '$machineNumber'";
            $check_result = mysqli_query($con, $check_sql);

            if (mysqli_num_rows($check_result) > 0) {
                $success = false;
                $errors[] = "Machine number '$machineNumber' already exists.";
                break;
            }else{
                $sql = "UPDATE `tbl_machine` SET machine_number = '$machineNumber' WHERE id = '$id'";
                if (mysqli_query($con, $sql)) {
                    $action = "Machine Number Modification";
                    $description = $account_username . " has successfully updated the details of the " . $machineNumber . " in the system.";
                    $sql_log = "INSERT INTO `tbl_log` (username, action, description, dts) VALUES ('$account_username', '$action','$description' , '$dts')";
    
                    if (!mysqli_query($con, $sql_log)) {
                        $success = false;
                        $errors[] = "Failed to log update for machine number '$machineNumber'.";
                        break;
                    }
                } else {
                    $success = false;
                    $errors[] = "Failed to update machine number '$machineNumber'.";
                    break;
                }
            }

        }

        if ($success) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => $errors]);
        }

    } else {
        echo json_encode(["success" => false, "error" => "Missing data"]);
    }
}


// DELETE MACHINE NUMBER
if (isset($_POST['deletemachine_submit'])) {
    if (isset($_POST['ids']) && isset($_POST['machineNumbers']) && isset($_POST['reasons'])) {
        $ids = $_POST['ids'];
        $machineNumbers = $_POST['machineNumbers'];
        $reasons = $_POST['reasons'];
        $success = true;

        for ($i = 0; $i < count($ids); $i++) {
            $id = intval($ids[$i]);
            $machineNumber = strtoupper(mysqli_real_escape_string($con, $machineNumbers[$i]));
            $reason = mysqli_real_escape_string($con, $reasons[$i]);
            $action = "Machine Number Deletion";
            $description = $account_username . " has successfully deleted the " . $machineNumber . " from the system.";
   
            $sql = "DELETE FROM `tbl_machine` WHERE id = '$id'";

            if (mysqli_query($con, $sql)) {

                $sql_log = "INSERT INTO `tbl_log` (username, action, description, dts, reasons) VALUES ('$account_username', '$action','$description' , '$dts' , '$reason')";
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

// INSERT STATION CODE
if (isset($input['stationSubmit']) && is_array($input['items'])) {
    $duplicates = [];

    foreach ($input['items'] as $item) {
        $stationCode = strtoupper(mysqli_real_escape_string($con, $item['stationCode'] ?? ''));

        if (!$stationCode) continue;

        $check_sql = "SELECT 1 FROM tbl_station_code WHERE station_code = '$stationCode' LIMIT 1";
        $check_result = mysqli_query($con, $check_sql);

        if ($check_result && mysqli_num_rows($check_result) > 0) {
            $duplicates[] = $stationCode;
        }
    }

    if (!empty($duplicates)) {
        echo json_encode([
            "message" => "Duplicate station code(s) found",
            "duplicates" => $duplicates
        ]);
        exit;
    }

    $values = [];
    $valuesLog = [];

    foreach ($input['items'] as $item) {
        $stationCode = strtoupper(mysqli_real_escape_string($con, $item['stationCode'] ?? ''));
        $values[] = "('$stationCode')";
        $action = "Station Code Registration";
        $description = "$account_username has successfully registered a new $stationCode in the system.";
        $valuesLog[] = "('$account_username', '$action', '$description', '$dts')";
    }

    if (empty($values)) {
        echo json_encode(["message" => "No valid data to insert."]);
        exit;
    }

    $sql = "INSERT INTO tbl_station_code (station_code) VALUES " . implode(", ", $values);
    $result1 = mysqli_query($con, $sql);

    $sql_log = "INSERT INTO tbl_log (username, action, description, dts) VALUES " . implode(", ", $valuesLog);
    $result2 = mysqli_query($con, $sql_log);

    if ($result1 && $result2) {
        echo json_encode(["message" => "Station Code(s) added successfully"]);
    } else {
        echo json_encode([
            "message" => "Insert failed",
            "error" => mysqli_error($con)
        ]);
    }
}

// UPDATE STATION CODE
if (isset($_POST['updatestation_submit'])) {
    if (isset($_POST['ids']) && isset($_POST['stationCodes'])) {
        $ids = $_POST['ids'];
        $stationCodes = $_POST['stationCodes'];
        $success = true;

        for ($i = 0; $i < count($ids); $i++) {
            $id = intval($ids[$i]);
            $stationCode = strtoupper(mysqli_real_escape_string($con, $stationCodes[$i]));
            $action = "Station Code Modification";
            $description = $account_username . " has successfully updated the details of the " . $stationCode . " in the system.";
   
            $sql = "UPDATE `tbl_station_code` SET station_code = '$stationCode' WHERE id = '$id'";

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

// DELETE STATION CODE
if (isset($_POST['deletestation_submit'])) {
    if (isset($_POST['ids']) && isset($_POST['stationCodes']) && isset($_POST['reasons'])) {
        $ids = $_POST['ids'];
        $stationCodes = $_POST['stationCodes'];
        $reasons = $_POST['reasons'];
        $success = true;

        for ($i = 0; $i < count($ids); $i++) {
            $id = intval($ids[$i]);
            $stationCode = strtoupper(mysqli_real_escape_string($con, $stationCodes[$i]));
            $reason = mysqli_real_escape_string($con, $reasons[$i]);
            $action = "Station Code Deletion";
            $description = $account_username . " has successfully deleted the " . $stationCode . " from the system.";
   
            $sql = "DELETE FROM `tbl_station_code` WHERE id = '$id'";

            if (mysqli_query($con, $sql)) {

                $sql_log = "INSERT INTO `tbl_log` (username, action, description, dts, reasons) VALUES ('$account_username', '$action','$description' , '$dts' , '$reason')";
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

// INSERT WITHDRAWAL REASON
if (isset($input['withdrawSubmit']) && is_array($input['items'])) {
    $duplicates = [];

    foreach ($input['items'] as $item) {
        $withdrawReason = strtoupper(mysqli_real_escape_string($con, $item['withdrawReason'] ?? ''));

        if (!$withdrawReason) continue;

        $check_sql = "SELECT 1 FROM tbl_withdrawal_reason WHERE reason = '$withdrawReason' LIMIT 1";
        $check_result = mysqli_query($con, $check_sql);

        if ($check_result && mysqli_num_rows($check_result) > 0) {
            $duplicates[] = $withdrawReason;
        }
    }

    if (!empty($duplicates)) {
        echo json_encode([
            "message" => "Duplicate Withdrawal Reason(s) found",
            "duplicates" => $duplicates
        ]);
        exit;
    }

    $values = [];
    $valuesLog = [];

    foreach ($input['items'] as $item) {
        $withdrawReason = mysqli_real_escape_string($con, $item['withdrawReason'] ?? '');
        $values[] = "('$withdrawReason')";
        $action = "Withdrawal Reason Registration";
        $description = "$account_username has successfully registered a new $withdrawReason in the system.";
        $valuesLog[] = "('$account_username', '$action', '$description', '$dts')";
    }

    if (empty($values)) {
        echo json_encode(["message" => "No valid data to insert."]);
        exit;
    }

    $sql = "INSERT INTO tbl_withdrawal_reason (reason) VALUES " . implode(", ", $values);
    $result1 = mysqli_query($con, $sql);

    $sql_log = "INSERT INTO tbl_log (username, action, description, dts) VALUES " . implode(", ", $valuesLog);
    $result2 = mysqli_query($con, $sql_log);

    if ($result1 && $result2) {
        echo json_encode(["message" => "Withdrawal Reason(s) added successfully"]);
    } else {
        echo json_encode([
            "message" => "Insert failed",
            "error" => mysqli_error($con)
        ]);
    }
}

// UPDATE WITHDRAWAL REASON
if (isset($_POST['updatewithdraw_submit'])) {
    if (isset($_POST['ids']) && isset($_POST['withdrawReasons'])) {
        $ids = $_POST['ids'];
        $withdrawReasons = $_POST['withdrawReasons'];
        $success = true;

        for ($i = 0; $i < count($ids); $i++) {
            $id = intval($ids[$i]);
            $withdrawReason = strtoupper(mysqli_real_escape_string($con, $withdrawReasons[$i]));
            $action = "Withdrawal Reason Modification";
            $description = $account_username . " has successfully updated the details of the " . $withdrawReason . " in the system.";
   
            $sql = "UPDATE `tbl_withdrawal_reason` SET reason = '$withdrawReason' WHERE id = '$id'";

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

// DELETE WITHDRAWAL REASON
if (isset($_POST['deletewithdraw_submit'])) {
    if (isset($_POST['ids']) && isset($_POST['withdrawReasons']) && isset($_POST['reasons'])) {
        $ids = $_POST['ids'];
        $withdrawReasons = $_POST['withdrawReasons'];
        $reasons = $_POST['reasons'];
        $success = true;

        for ($i = 0; $i < count($ids); $i++) {
            $id = intval($ids[$i]);
            $withdrawReason = strtoupper(mysqli_real_escape_string($con, $withdrawReasons[$i]));
            $reason = mysqli_real_escape_string($con, $reasons[$i]);
            $action = "Withdrawal Reason Deletion";
            $description = $account_username . " has successfully deleted the " . $withdrawReason . " from the system.";
   
            $sql = "DELETE FROM `tbl_withdrawal_reason` WHERE id = '$id'";

            if (mysqli_query($con, $sql)) {

                $sql_log = "INSERT INTO `tbl_log` (username, action, description, dts, reasons) VALUES ('$account_username', '$action','$description' , '$dts' , '$reason')";
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

// INSERT UNIT OF MEASURE
if (isset($input['unitSubmit']) && is_array($input['items'])) {
    $duplicates = [];

    foreach ($input['items'] as $item) {
        $unit = strtoupper(mysqli_real_escape_string($con, $item['unit'] ?? ''));

        if (!$unit) continue;

        $check_sql = "SELECT 1 FROM tbl_unit WHERE unit = '$unit' LIMIT 1";
        $check_result = mysqli_query($con, $check_sql);

        if ($check_result && mysqli_num_rows($check_result) > 0) {
            $duplicates[] = $unit;
        }
    }

    if (!empty($duplicates)) {
        echo json_encode([
            "message" => "Duplicate Unit(s) found",
            "duplicates" => $duplicates
        ]);
        exit;
    }

    $values = [];
    $valuesLog = [];

    foreach ($input['items'] as $item) {
        $unit = mysqli_real_escape_string($con, $item['unit'] ?? '');
        $values[] = "('$unit')";
        $action = "Unit of Measure Registration";
        $description = "$account_username has successfully registered a new $unit in the system.";
        $valuesLog[] = "('$account_username', '$action', '$description', '$dts')";
    }

    if (empty($values)) {
        echo json_encode(["message" => "No valid data to insert."]);
        exit;
    }

    $sql = "INSERT INTO tbl_unit (unit) VALUES " . implode(", ", $values);
    $result1 = mysqli_query($con, $sql);

    $sql_log = "INSERT INTO tbl_log (username, action, description, dts) VALUES " . implode(", ", $valuesLog);
    $result2 = mysqli_query($con, $sql_log);

    if ($result1 && $result2) {
        echo json_encode(["message" => "Unit(s) added successfully"]);
    } else {
        echo json_encode([
            "message" => "Insert failed",
            "error" => mysqli_error($con)
        ]);
    }
}

// UPDATE UNIT OF MEASURE
if (isset($_POST['updateunit_submit'])) {
    if (isset($_POST['ids']) && isset($_POST['unitMeasures'])) {
        $ids = $_POST['ids'];
        $unitMeasures = $_POST['unitMeasures'];
        $success = true;

        for ($i = 0; $i < count($ids); $i++) {
            $id = intval($ids[$i]);
            $unitMeasure = mysqli_real_escape_string($con, $unitMeasures[$i]);
            $action = "Unit of Measure Modification";
            $description = $account_username . " has successfully updated the details of the " . $unitMeasure . " in the system.";
   
            $sql = "UPDATE `tbl_unit` SET unit = '$unitMeasure' WHERE id = '$id'";

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

// DELETE UNIT OF MEASURE
if (isset($_POST['deleteunit_submit'])) {
    if (isset($_POST['ids']) && isset($_POST['unitMeasures']) && isset($_POST['reasons'])) {
        $ids = $_POST['ids'];
        $unitMeasures = $_POST['unitMeasures'];
        $reasons = $_POST['reasons'];
        $success = true;

        for ($i = 0; $i < count($ids); $i++) {
            $id = intval($ids[$i]);
            $unitMeasure = strtoupper(mysqli_real_escape_string($con, $unitMeasures[$i]));
            $reason = mysqli_real_escape_string($con, $reasons[$i]);
            $action = "Unit of Measure Deletion";
            $description = $account_username . " has successfully deleted the " . $unitMeasure . " from the system.";
   
            $unit_sql = "DELETE FROM `tbl_unit` WHERE id = '$id'";

            if (mysqli_query($con, $unit_sql)) {

                $sql_log = "INSERT INTO `tbl_log` (username, action, description, dts, reasons) VALUES ('$account_username', '$action','$description' , '$dts' , '$reason')";
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