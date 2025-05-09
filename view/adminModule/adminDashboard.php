<?php

include "../../model/dbconnection.php";
include "navBar.php";

?>

<head>

    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../public/css/sweetalert.min.css">
    <link rel="stylesheet" href="../../public/css/graph.css">
    <script src="../../public/js/sweetalert2@11.js"></script>
    <script src="../../public/js/jquery.js"></script>
    <script src="../../public/js/chart.js"></script>

</head>

<section class="w-100 d-flex flex-column" style="max-height: 90%;">

    <div class="welcomeDiv my-2">
        <h2 class="text-center" style="color: #900008; font-weight: bold;">Welcome,
            <?php echo $_SESSION['username']; ?>!
        </h2>
    </div>

    <!-- Top Material Consumption / Withdrawal -->
    <div class="px-5 py-2">
        <h2 class="text-center">Top Material Consumption / Withdrawal</h2>
    </div>

    <!-- Top Material Consumption / Withdrawal Container -->
    <div class="container combineContainer my-4 w-50">

        <div class="d-flex flex-wrap justify-content-evenly align-center w-100">

            <div class="text-center">
                <label for="start_date">Start Date</label>
                <input type="date" id="start_date" class="form-control"
                    value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>">
            </div>

            <div class="text-center">
                <label for="end_date">End Date</label>
                <input type="date" id="end_date" class="form-control"
                    value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>">
            </div>

            <div class="text-center">
                <label for="cost_center">Cost Center</label>
                <select class="form-select" id="cost_center">
                    <option selected value="">Select Cost Center</option>
                    <?php
                    $select_ccid = "SELECT * FROM tbl_ccs";
                    $select_ccid_query = mysqli_query($con, $select_ccid);

                    if (mysqli_num_rows($select_ccid_query) > 0) {
                        while ($ccid_row = mysqli_fetch_assoc($select_ccid_query)) {
                            ?>
                            <option value="<?php echo $ccid_row['ccid'] ?>" data-id="<?php echo $ccid_row['id'] ?>">
                                <?php echo $ccid_row['ccid'] ?>
                            </option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="text-center">
                <label for="station_code">Station Code</label>
                <select class="form-select" id="station_code" name="station_code">
                    <option selected value="">Select Station Code</option>
                    <?php
                    $sql_station = "SELECT station_code FROM tbl_station_code";
                    $sql_station_query = mysqli_query($con, $sql_station);
                    if ($sql_station_query) {
                        while ($statiobRow = mysqli_fetch_assoc($sql_station_query)) {
                            ?>

                            <option value="<?php echo $statiobRow['station_code'] ?>">
                                <?php echo $statiobRow['station_code'] ?>
                            </option>

                            <?php
                        }
                    }
                    ?>
                </select>
            </div>

        </div>

        <div class="d-flex justify-content-center">
            <button id="with_export_btn" class="btn btn-success mt-2">Export to Excel</button>
        </div>

        <div id="chart-container" class="my-4">
            <canvas id="combinedChart"></canvas>
        </div>

    </div>

    <!-- Cost Center With Highest Withdrawal -->
    <div class="px-5 py-2">
        <h2 class="text-center">Cost Center With Highest Withdrawal</h2>
    </div>

    <!-- Cost Center With Highest Withdrawal Selections -->
    <div class="d-flex flex-wrap justify-content-evenly align-center w-100 ">

        <div class="text-center">
            <label for="startDate" class="m-0">Start Date:</label>
            <input type="date" id="startDate" class="form-control">
        </div>

        <div class="text-center">
            <label for="endDate" class="m-0">End Date:</label>
            <input type="date" id="endDate" class="form-control">
        </div>

        <div class="text-center">
            <label for="endDate" class="m-0">Part Number:</label>
            <?php
            $query = "SELECT id, part_name 
                    FROM tbl_inventory 
                    ORDER BY REGEXP_REPLACE(part_name, '[0-9]+$', ''), CAST(REGEXP_SUBSTR(part_name, '[0-9]+$') AS UNSIGNED)";
            $result = mysqli_query($con, $query);
            ?>
            <select class="form-select" id="mat_partSelect">
                <option value="">Select a Part</option>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['part_name'] . '">' . htmlspecialchars($row['part_name']) . '</option>';
                    }
                } else {
                    echo '<option value="">No parts available</option>';
                }
                ?>
            </select>
        </div>

        <div class="text-center">
            <button id="export-btn" class="btn btn-success mt-2">Export to Excel</button>
        </div>

    </div>

    <!-- Cost Center With Highest Withdrawal Graph Container -->
    <div class="container full-container my-4">

        <div class="row d-flex flex-wrap justify-content-between">

            <div class="col-lg-8 col-md-12 barContainer mb-4">
                <canvas id="barChart" style="min-height: 400px;"></canvas>
            </div>

            <div class="col-lg-4 col-md-12 tableContainer mb-4">
                <div class="table-responsive" style="max-height: 550px; overflow-y: auto;">
                    <table id="rankingTable" class="table table-bordered">
                        <thead>
                            <tr class="text-center"
                                style="background-color: #900008; color: white; vertical-align: middle;">
                                <th>Rank</th>
                                <th>Cost Center ID (ccid)</th>
                                <th>Requested Count</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row justify-content-center" style="display:none;">
            <div class="col-lg-8 col-md-12 tableContainer">
                <div class="table-responsive">
                    <table id="dateSpecificTable" class="table table-bordered">
                        <thead>
                            <tr class="text-center"
                                style="background-color: #900008; color: white; vertical-align: middle;">
                                <th>Date</th>
                                <th>Cost Center</th>
                                <th>Requested Count</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


</section>

<script src="../../public/js/excel.js"></script>

<script>
    $(document).ready(function () {

        var partNames = [];
        var partQtys = [];
        var returnQtys = [];
        var rawData = [];
        var combinedChart = null;

        // Update Top Material Consumption / Withdrawal Function
        function updateChartData(start_date, end_date, cost_center, station_code) {
            var requestData = {
                start_date: start_date,
                end_date: end_date
            };

            if (cost_center !== '') {
                requestData.cost_center = cost_center;
            }

            if (station_code !== '') {
                requestData.station_code = station_code;
            }

            $.ajax({
                url: '../../controller/fetch_graph.php',
                type: 'GET',
                data: requestData,
                success: function (response) {
                    var data = $.parseJSON(response);
                    partNames = data.part_names;
                    partQtys = data.part_qtys;
                    returnQtys = data.return_qtys;
                    rawData = data.raw_data;

                    createChart(partNames, partQtys, returnQtys);
                }
            });
        }

        // Top Material Consumption / Withdrawal Selections Script
        $('#start_date, #end_date, #cost_center, #station_code').on('change', function () {
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            var cost_center = $('#cost_center').val();
            var station_code = $('#station_code').val();

            updateChartData(start_date, end_date, cost_center, station_code);
        });

        updateChartData('', '', '', '');

        // Top Material Consumption / Withdrawal Graph Creation
        function createChart(partNames, partQtys, returnQtys) {
            var ctx = $('#combinedChart')[0].getContext('2d');

            if (combinedChart != null) {
                combinedChart.destroy();
            }

            combinedChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: partNames,
                    datasets: [
                        {
                            label: 'Withdrawn Quantity',
                            data: partQtys,
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Return Quantity',
                            data: returnQtys,
                            backgroundColor: 'rgba(255, 99, 132, 0.6)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Part Number'
                            },
                            grid: {
                                offset: true
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Quantity'
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    }
                }
            });
        }

        // Graph Resize
        $(window).on('resize', function () {
            if (combinedChart) {
                combinedChart.resize();
            }
        });

        // Cost Center Graph Fetching
        function fetchData(startDate = null, endDate = null, partName = null, selectedDate = null) {
            $.ajax({
                url: '../../controller/fetch_graph_ccs.php',
                method: 'GET',
                dataType: 'json',
                data: {
                    startDate: startDate,
                    endDate: endDate,
                    partName: partName,
                    selectedDate: selectedDate
                },
                success: function (response) {
                    var rankingData = response.ranking;
                    var dailyData = response.dateSpecific;

                    var tableBody = $('#rankingTable tbody');
                    tableBody.empty();
                    $.each(rankingData, function (index, item) {
                        var rank = index + 1;
                        var row = `<tr class="table-row text-center">
                                        <td>${rank}</td>
                                        <td>${item.ccid}</td>
                                        <td>${item.requested_count}</td>
                                    </tr>`;
                        tableBody.append(row);
                    });

                    dailyData.sort(function (a, b) {
                        return new Date(a.date) - new Date(b.date);
                    });

                    var dateSpecificTableBody = $('#dateSpecificTable tbody');
                    dateSpecificTableBody.empty();
                    $.each(dailyData, function (index, item) {
                        if (item.date === null || item.date === '') {
                            return;
                        }
                        var row = `<tr class="table-row text-center">
                                        <td>${item.date}</td>
                                        <td>${item.ccid}</td>
                                        <td>${item.requested_count}</td>
                                    </tr>`;
                        dateSpecificTableBody.append(row);
                    });

                    if (barChart instanceof Chart) {
                        barChart.destroy();
                    }

                    var ctx = $('#barChart')[0].getContext('2d');
                    barChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: rankingData.map(item => item.ccid),
                            datasets: [{
                                label: 'Withdrawn Count',
                                data: rankingData.map(item => item.requested_count),
                                backgroundColor: '#900008',
                                borderColor: '#900008',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Cost Center ID (ccid)'
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Withdrawn Count'
                                    }
                                }
                            }
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.error("AJAX request failed: " + status + ", " + error);
                }
            });
        }

        $('#start_date, #end_date').on('change', function () {
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();
            var partName = $('#part_name').val();

            fetchData(startDate, endDate, partName);
        });

        fetchData();

        // Cost Center Selections
        $('#startDate, #endDate, #mat_partSelect').on('change', function () {
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();
            var partName = $('#mat_partSelect').val();
            var selectedDate = startDate;

            fetchData(startDate, endDate, partName);
        });

        // Top Material Consumption / Withdrawal Export to Excel
        $('#with_export_btn').click(function () {
            var wb = XLSX.utils.book_new();

            var chartData = [
                ["Part Number", "Withdrawn Quantity", "Return Quantity"]
            ];

            for (var i = 0; i < partNames.length; i++) {
                if (partQtys[i] !== 0 || returnQtys[i] !== 0) {
                    chartData.push([partNames[i], partQtys[i], returnQtys[i]]);
                }
            }

            var wsChartData = XLSX.utils.aoa_to_sheet(chartData);
            XLSX.utils.book_append_sheet(wb, wsChartData, "ChartData");

            var filteredData = [
                ["Date Approved", "Part Number", "Withdrawn Quantity", "Return Quantity", "Cost Center", "Station Code", "Batch Number"]
            ];

            for (var i = 0; i < rawData.length; i++) {
                if (rawData[i].part_qty !== 0 || rawData[i].return_qty !== 0) {
                    filteredData.push([
                        rawData[i].dts_approve,
                        rawData[i].part_name,
                        rawData[i].part_qty,
                        rawData[i].return_qty,
                        rawData[i].cost_center,
                        rawData[i].station_code,
                        rawData[i].batch_number

                    ]);
                }
            }

            var wsFilteredData = XLSX.utils.aoa_to_sheet(filteredData);
            XLSX.utils.book_append_sheet(wb, wsFilteredData, "FilteredData");

            XLSX.writeFile(wb, "Top_Material_Consumption.xlsx");
        });

        // Cost Center Export to Excel
        $('#export-btn').click(function () {
            var tables = [];

            function extractTableData(tableSelector) {
                var visibleRows = $(tableSelector + ' .table-row');
                var filteredRows = [];

                visibleRows.each(function () {
                    if ($(this).css('display') !== 'none') {
                        filteredRows.push(this);
                    }
                });

                var table = $('<table></table>');
                var headerRow = $(tableSelector + ' thead').clone(true);
                table.append(headerRow);

                $(filteredRows).each(function () {
                    var newRow = $(this).clone(true);
                    table.append(newRow);
                });

                return table[0];
            }

            var rankingTable = extractTableData('#rankingTable');
            tables.push({ table: rankingTable, sheetName: "Cost Center Ranking" });

            var dateSpecificTable = extractTableData('#dateSpecificTable');
            tables.push({ table: dateSpecificTable, sheetName: "Date-Specific Data" });

            var wb = XLSX.utils.book_new();

            tables.forEach(function (item) {
                var ws = XLSX.utils.table_to_sheet(item.table);
                XLSX.utils.book_append_sheet(wb, ws, item.sheetName);
            });

            XLSX.writeFile(wb, "Cost_Center_Data.xlsx");
        });

    });

</script>