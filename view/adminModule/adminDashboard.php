<?php
include "navBar.php";
include "../../model/dbconnection.php";
?>

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../public/css/sweetalert.min.css">
    <script src="../../public/js/sweetalert2@11.js"></script>
    <script src="../../public/js/jquery.js"></script>
    <script src="../../public/js/chart.js"></script>

    <style>
        @media (max-width: 1250px) {
            .combineContainer {
                width: 100% !important;
                margin-bottom: 100px
            }
        }

        @media (max-width: 800px) {
            .full-container {
                flex-direction: column !important;
            }

            .barContainer,
            .tableContainer {
                height: 300px;
                width: 100%;
            }

            .barContainer {
                margin-bottom: 100px;
            }

        }
    </style>
</head>
<section class="w-100 d-flex flex-column" style="max-height: 90%;">
    <div class="welcomeDiv my-2">
        <h2 class="text-center" style="color: #900008; font-weight: bold;">Welcome,
            <?php echo $_SESSION['username']; ?>!
        </h2>
    </div>
    <div class="px-5 py-2">
        <h2 class="text-center">Top Material Consumption / Withdrawal</h2>
    </div>
    <div class="container combineContainer my-4 w-50">

        <div class="d-flex justify-content-evenly align-center w-100 ">
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
        </div>

        <div id="chart-container" class="my-4">
            <canvas id="combinedChart"></canvas>
        </div>

    </div>

    <div class="px-5 py-2">
        <h2 class="text-center">Cost Center With Highest Withdrawal</h2>
    </div>

    <div class="d-flex justify-content-evenly align-center w-100 ">
        <div class="text-center">
            <label for="startDate" class="m-0">Start Date:</label>
            <input type="date" id="startDate" class="form-control">
        </div>
        <div class="text-center">
            <label for="endDate" class="m-0">End Date:</label>
            <input type="date" id="endDate" class="form-control">
        </div>
    </div>


    <div class="container full-container my-4 d-flex justify-content-between">
        <div class="col-md-8 barContainer mx-2">
            <canvas id="barChart" style="min-height: 400px;"></canvas>
        </div>

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

<script>
    $(document).ready(function () {
        var partNames = [];
        var partQtys = [];
        var returnQtys = [];
        var combinedChart = null;

        function updateChartData(start_date, end_date) {
            $.ajax({
                url: '../../controller/fetch_graph.php',
                type: 'GET',
                data: {
                    start_date: start_date,
                    end_date: end_date
                },
                success: function (response) {
                    var data = JSON.parse(response);
                    partNames = data.part_names;
                    partQtys = data.part_qtys;
                    returnQtys = data.return_qtys;

                    createChart(partNames, partQtys, returnQtys);
                }
            });
        }

        $('#start_date, #end_date').on('change', function () {
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();

            if (start_date && end_date) {
                updateChartData(start_date, end_date);
            } else {
                updateChartData('', '');
            }
        });

        updateChartData('', '');

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

        $(window).on('resize', function () {
            if (combinedChart) {
                combinedChart.resize();
            }
        });

        var barChart;

        function fetchData(startDate = null, endDate = null) {
            $.ajax({
                url: '../../controller/fetch_graph_ccs.php',
                method: 'GET',
                dataType: 'json',
                data: {
                    startDate: startDate,
                    endDate: endDate
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
                                label: 'Requested Count',
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
                                        text: 'Requested Count'
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

        fetchData();

        $('#startDate, #endDate').on('change', function () {
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();

            fetchData(startDate, endDate);
        });
    });

</script>