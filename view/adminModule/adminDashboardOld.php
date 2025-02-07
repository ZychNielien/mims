<?php
include "navBar.php";
include "../../model/dbconnection.php";
?>

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../public/css/sweetalert.min.css">
    <script src="../../public/js/sweetalert2@11.js"></script>
    <script src="../../public/js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
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

<section class="w-100" style="max-height: 90%;">
    <div class="welcomeDiv my-2">
        <h2 class="text-center" style="color: #900008; font-weight: bold;">Welcome,
            <?php echo $_SESSION['username']; ?>!
        </h2>
    </div>

    <h2 class="text-center">COST CENTER WITH HIGHEST WITHDRAWAL</h2>

    <div class="text-center my-3">
        <label for="startDate">Start Date:</label>
        <input type="date" id="startDate" class="form-control d-inline" style="width: 200px;">

        <label for="endDate" style="margin-left: 20px;">End Date:</label>
        <input type="date" id="endDate" class="form-control d-inline" style="width: 200px;">
    </div>


    <div class="container full-container my-4 d-flex justify-content-between">
        <!-- Left Section (Graph) -->
        <div class="col-md-8 barContainer mx-2">
            <canvas id="barChart" style="min-height: 400px;"></canvas>
        </div>

        <!-- Right Section (Ranking Table) -->
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
                        <!-- Ranking data will be populated here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        var barChart; // Store the chart instance

        // Function to fetch data based on date range
        function fetchData(startDate = null, endDate = null) {
            $.ajax({
                url: '../../controller/fetch_graph_ccs.php', // Path to the PHP file
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

                    // Sort ranking data in descending order based on requested_count
                    rankingData.sort(function (a, b) {
                        return b.requested_count - a.requested_count;
                    });

                    // Populate the ranking table
                    var tableBody = $('#rankingTable tbody');
                    tableBody.empty(); // Clear previous table data
                    rankingData.forEach(function (item, index) {
                        var rank = index + 1;
                        var row = `<tr class="table-row text-center">
                            <td>${rank}</td>
                            <td>${item.ccid}</td>
                            <td>${item.requested_count}</td>
                        </tr>`;
                        tableBody.append(row);
                    });

                    // Destroy the old chart if it exists
                    if (barChart) {
                        barChart.destroy();
                    }

                    // Create a new bar chart with updated data
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

        // Initial data load when the page is ready (without any date range filter)
        fetchData();

        // Listen for changes in the start and end date inputs and fetch data accordingly
        $('#startDate, #endDate').on('change', function () {
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();

            // Fetch the data with the selected start and end date
            fetchData(startDate, endDate);
        });
    });
</script>