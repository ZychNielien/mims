<?php

ob_clean();
flush();


header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="exported_data.csv"');


ob_start();


$output = fopen('php://output', 'w');


if (isset($_POST['data'])) {

    $data = json_decode($_POST['data'], true);

    $headers = ["Date / Time / Shift", "Lot ID", "Part Name", "Item Description", "Qty.", "Machine No.", "Withdrawal Reason", "Requested By", "Status"];
    fputcsv($output, $headers);


    foreach ($data as $rowData) {
        fputcsv($output, $rowData);
    }

    fclose($output);
} else {
    echo "No data received";
}

ob_end_flush();

exit();
?>