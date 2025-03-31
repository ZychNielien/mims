<?php

// Database Connection
include "../../model/dbconnection.php";

// Navigation Bar
include "navBar.php";

?>

<head>

    <!-- Title -->
    <title>Admin Dashboard</title>

    <!-- Sweetalert Style -->
    <link rel="stylesheet" href="../../public/css/sweetalert.min.css">

    <!-- Graph Style -->
    <link rel="stylesheet" href="../../public/css/graph.css">

    <!-- Sweetalert Script -->
    <script src="../../public/js/sweetalert2@11.js"></script>

    <!-- Jquery Script -->
    <script src="../../public/js/jquery.js"></script>

    <!-- Chart Script -->
    <script src="../../public/js/chart.js"></script>

</head>

<section class="w-100 d-flex flex-column" style="max-height: 90%;">

    <!-- Title Div -->
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

        <!-- Top Material Consumption / Withdrawal Selections -->
        <div class="d-flex flex-wrap justify-content-evenly align-center w-100">

            <!-- Start Date -->
            <div class="text-center">
                <label for="start_date">Start Date</label>
                <input type="date" id="start_date" class="form-control"
                    value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>">
            </div>

            <!-- End Date -->
            <div class="text-center">
                <label for="end_date">End Date</label>
                <input type="date" id="end_date" class="form-control"
                    value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>">
            </div>

            <!-- Cost Center -->
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

            <!-- Station Code -->
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

        <!-- Excel Export -->
        <div class="d-flex justify-content-center">
            <button id="with_export_btn" class="btn btn-success mt-2">Export to Excel</button>
        </div>

        <!-- Top Material Consumption / Withdrawal Graph -->
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

        <!-- Start Date -->
        <div class="text-center">
            <label for="startDate" class="m-0">Start Date:</label>
            <input type="date" id="startDate" class="form-control">
        </div>

        <!-- End Date -->
        <div class="text-center">
            <label for="endDate" class="m-0">End Date:</label>
            <input type="date" id="endDate" class="form-control">
        </div>

        <!-- Part Number -->
        <div class="text-center">
            <label for="endDate" class="m-0">Part Number:</label>
            <?php
            $query = "SELECT id, part_name FROM tbl_inventory";
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

        <!-- Export Excel -->
        <div class="text-center">
            <button id="export-btn" class="btn btn-success mt-2">Export to Excel</button>
        </div>

    </div>

    <!-- Cost Center With Highest Withdrawal Graph Container -->
    <div class="container full-container my-4 d-flex justify-content-between">

        <!-- Cost Center With Highest Withdrawal Graph -->
        <div class="col-md-8 barContainer mx-2">
            <canvas id="barChart" style="min-height: 400px;"></canvas>
        </div>

        <!-- Cost Center With Highest Withdrawal Table -->
        <div class="col-md-4 mx-2 tableContainer">
            <div class="table-container">
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

</section>

<!-- Excel Script -->
<script src="../../public/js/excel.js"></script>

<script>
    $(document).ready(function () {

        var partNames = [];
        var partQtys = [];
        var returnQtys = [];
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
                    var data = JSON.parse(response);
                    partNames = data.part_names;
                    partQtys = data.part_qtys;
                    returnQtys = data.return_qtys;

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

        // Update Top Material Consumption / Withdrawal Function
        updateChartData('', '', '', '');

        // Top Material Consumption / Withdrawal Graph Creation
        function createChart(partNames, partQtys, returnQtys) {
            var ctx = document.getElementById('combinedChart').getContext('2d');

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
                                text: 'Part Name'
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

        // Bar Graph
        var barChart;

        // Cost Center Graph Fetching
        function fetchData(startDate = null, endDate = null, partName = null) {
            $.ajax({
                url: '../../controller/fetch_graph_ccs.php',
                method: 'GET',
                dataType: 'json',
                data: {
                    startDate: startDate,
                    endDate: endDate,
                    partName: partName
                },
                success: function (data) {
                    var ccidValues = [];
                    var requestCountValues = [];
                    var rankingData = [];

                    $.each(data, function (index, item) {
                        ccidValues.push(item.ccid);
                        requestCountValues.push(item.requested_count);
                        rankingData.push({
                            ccid: item.ccid,
                            requested_count: item.requested_count
                        });
                    });

                    rankingData.sort(function (a, b) {
                        return b.requested_count - a.requested_count;
                    });

                    var tableBody = $('#rankingTable tbody');
                    tableBody.empty();
                    rankingData.forEach(function (item, index) {
                        var rank = index + 1;
                        var row = `<tr class="table-row text-center">
                    <td>${rank}</td>
                    <td>${item.ccid}</td>
                    <td>${item.requested_count}</td>
                </tr>`;
                        tableBody.append(row);
                    });

                    if (barChart) {
                        barChart.destroy();
                    }

                    var ctx = document.getElementById('barChart').getContext('2d');
                    barChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ccidValues,
                            datasets: [{
                                label: 'Withdrawn Count',
                                data: requestCountValues,
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

        // Cost Center Graph Function
        fetchData();

        // Cost Center Selections
        $('#startDate, #endDate, #mat_partSelect').on('change', function () {
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();
            var partName = $('#mat_partSelect').val();

            fetchData(startDate, endDate, partName);
        });

        // Top Material Consumption / Withdrawal Export to Excel
        $('#with_export_btn').click(function () {
            var table = $('<table></table>');
            var headerRow = $('<tr></tr>');
            headerRow.append('<th>Part Name</th>');
            headerRow.append('<th>Withdrawn Quantity</th>');
            headerRow.append('<th>Return Quantity</th>');
            table.append(headerRow);

            for (var i = 0; i < partNames.length; i++) {
                var row = $('<tr></tr>');
                row.append('<td>' + partNames[i] + '</td>');
                row.append('<td>' + partQtys[i] + '</td>');
                row.append('<td>' + returnQtys[i] + '</td>');
                table.append(row);
            }

            var wb = XLSX.utils.table_to_book(table[0], { sheet: "ChartData" });
            XLSX.writeFile(wb, "ChartData.xlsx");
        });

        // Cost Center Export to Excel
        $('#export-btn').click(function () {
            var visibleRows = $('#rankingTable .table-row');
            var filteredRows = [];

            visibleRows.each(function () {
                if ($(this).css('display') !== 'none') {
                    filteredRows.push(this);
                }
            });

            var table = $('<table></table>');
            var headerRow = $('#rankingTable thead').clone(true);
            table.append(headerRow);

            $(filteredRows).each(function () {
                var newRow = $(this).clone(true);
                table.append(newRow);
            });

            var wb = XLSX.utils.table_to_book(table[0], { sheet: "Filtered Data" });
            XLSX.writeFile(wb, "Cost_Center_Ranking.xlsx");
        });

    });

</script>