@extends('layouts.mainlayout')
@extends('layouts.app')
@section('content')
    <style>
        .charts {
            display: flex;
            height: 300px;

            /* padding-top:20px; */
            justify-items: center;
        }

        .top-cards {
            display: flex;
            gap: 80px;
            justify-content: start;


        }

        .firstLine-charts {
            display: flex;
        }

        .barChart {
            padding: 10px;
            width: 65%;
            /* margin-top: 10px; */
            margin-bottom: 40px;
            background-color: rgba(193, 232, 225, 0.2);



        }

        .chart-container {
            padding: 10px;
            height: 300px;
            width: 50%;

        }

        .line-chart {
            width: 50%;

            background-color: rgba(191, 227, 188, 0.2);
        }

        .number-card {
            display: inline-block;
            width: 230px;
            height: 120px;
            background-color: #183f7d;
            color: white;
            border-radius: 8px;
            margin: 10px;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .number-card__title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .number-card__value {
            font-size: 24px;

            font-weight: bold;

        }

        .grouped-chart {
            width: 50%;
            height: 50%;
            background-color: rgba(75, 192, 192, 0.2);
        }
    </style>
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="d-flex justify-content-between flex-wrap">
                        <div class="d-flex align-items-end flex-wrap">
                            <div class="me-md-3 me-xl-5">
                                <h2>{{ Auth::user()->firstName }} {{ Auth::user()->middleName }} </h2>

                                <p class="mb-md-0">Head Office dashboard .</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body dashboard-tabs p-0">
                            <ul class="nav nav-tabs px-4" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" id="users-tab" data-bs-toggle="tab" href="#users" role="tab"
                                        aria-controls="users" aria-selected="false">Users</a>
                                </li>

                            </ul>
                            <div class="tab-content py-0 px-0">

                                <div class="tab-pane fade show active" id="users" role="tabpanel"
                                    aria-labelledby="users-tab">
                                    <div class="d-flex flex-wrap justify-content-xl-between">
                                        <div
                                            class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">

                                            <div
                                                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-account-outline me-3 icon-lg text-danger"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Total Clients/Agents</small>
                                                    <h5 class="me-2 mb-0">{{ $client }}</h5>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-account-outline me-3 icon-lg text-primary"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Total ROMS</small>
                                                    <h5 class="me-2 mb-0">{{ $roms }}</h5>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-account-outline me-3 icon-lg text-secondary"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Total CICO</small>
                                                    <h5 class="me-2 mb-0">{{ $agents }}</h5>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                                <i class="mdi mdi-account-outline me-3 icon-lg text-success"></i>
                                                <div class="d-flex flex-column justify-content-around">
                                                    <small class="mb-1 text-muted">Total Key distributors</small>
                                                    <h5 class="me-2 mb-0">{{ $kds }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>


                </div>


            </div>
            <h3>Order Details </h3>

            <div class='top-cards'>
                <div class="number-card">
                    <div class="number-card__title">Total Ordered Products</div>
                    <div class="number-card__value">{{ $totalConfirmedProducts }}</div>
                </div>
                <div class="number-card">
                    <div class="number-card__title">Active Pending Orders </div>
                    <div class="number-card__value">{{ $pendingOrders }}</div>
                </div>
            </div>
             <div class='top-cards'>
                <div class="number-card">
                    <div class="number-card__title">Total Orders Amount</div>
                    <div class="number-card__value">{{ $totalConfirmedAmount }} Birr</div>
                </div>
                <div class="number-card">
                    <div class="number-card__title">Total Delivered Amount</div>
                    <div class="number-card__value">{{ $totalDeliveredAmount }} Birr</div>
                </div>
            </div>

            <hr style="margin-top: 20px; margin-bottom:20px; height:2px;" />

            <div class='firstLine-charts'>


                <div class="chart-container">
                    <canvas id="pieChart"></canvas>
                </div>
                <div class="chart-container">
                    <canvas id="doughnutChart"></canvas>
                </div>
            </div>

            <div class='charts'>

                <div class="barChart">
                    <h5>Top Ordered Products </h5>
                    <canvas id="myChart"></canvas>
                </div>


               {{-- mostDeliveredProducts --}}


            </div>
            <br><br>
            <div class="charts">
                <div class="barChart">
                    <h5>Top Delivered Products </h5>
                    <canvas id="myChart1"></canvas>
                </div>
            </div>

            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer" style="margin-top: 60px;">
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright � Elebat
                            solution<a href="https://Elebatsolution.com/" target="_blank">Elebatsolution.com
                            </a>2023</span>

                    </div>
                </footer>
                <!-- partial -->
        </div>
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1"></script>

    <script>
        var mostOrderedProducts = {!! $mostOrderedProducts !!};
        var mostDeliveredProducts = {!! $mostDeliveredProducts !!};
        var labels = mostOrderedProducts.map(function(item) {
            return item.name;
        });
        var data = mostOrderedProducts.map(function(item) {
            return item.total_ordered;
        });
         var data1 = mostDeliveredProducts.map(function(item) {
            return item.total_ordered;
        });
         var labels1 = mostDeliveredProducts.map(function(item) {
            return item.name;
        });


        document.addEventListener('DOMContentLoaded', function() {
            //barchart


            var ctxPie = document.getElementById('pieChart').getContext('2d');
            var pieChart = new Chart(ctxPie, {
                type: 'pie',
                data: {
                    labels: ['Rejected Orders', 'Accepter Orders', 'Adjusted Orders', ],
                    datasets: [{
                        label: 'Data',
                        data: [
                            {{ $rejectedOrder }},
                            {{ $acceptedOrder }},
                            {{ $adjustedORder }},

                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(75, 192, 192, 0.8)',

                            'rgba(54, 162, 235, 0.8)',

                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',

                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            labels: {
                                position: 'bottom' // Set the position to 'bottom' to display the labels below the chart
                            }

                        }
                    }
                }
            });

            // Doughnut chart
            var ctxDoughnut = document.getElementById('doughnutChart').getContext('2d');
            var doughnutChart = new Chart(ctxDoughnut, {
                type: 'doughnut',
                data: {
                    labels: ['Approved by ROM', 'Approved by TL', 'delivered'],
                    datasets: [{
                        label: 'Data',
                        data: [
                            {{ $RomApproved }},
                            {{ $TMApproved }},
                            {{ $delivered }},

                        ],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',

                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',

                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            //horizontal chart

            var theChart = document.getElementById('myChart').getContext('2d');

            var myChart = new Chart(theChart, {
                type: 'horizontalBar', // Change the chart type to horizontal bar
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Top Ordered Products',
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)', // Bar color
                        borderColor: 'rgba(54, 162, 235, 1)', // Bar border color
                        borderWidth: 1,
                    }, ],
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Total Ordered',
                            },
                        },
                    },
                },
            });
            var theChart1 = document.getElementById('myChart1').getContext('2d');

            var myChart1 = new Chart(theChart1, {
                type: 'horizontalBar', // Change the chart type to horizontal bar
                data: {
                    labels: labels1,
                    datasets: [{
                        label: 'Top Delivered Products',
                        data: data1,
                        backgroundColor: 'rgba(16, 25, 160, 1)', // Bar color
                        borderColor: 'rgba(16, 25, 160, 1)', // Bar border color
                        borderWidth: 1,
                    }, ],
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Total Delivered',
                            },
                        },
                    },
                },
            });


            // guage charts
            var progressBar = document.getElementById('guageChart').getContext('2d');

            var progressChart = new Chart(progressBar, {
                type: 'bar',
                data: {
                    labels: ['Pending Orders'],
                    datasets: [{
                            data: [{{ $pendingOrders }}],
                            backgroundColor: ['rgba(54, 162, 235, 1)'],
                            borderWidth: 0,
                            barPercentage: 0.6, // Adjust the width of the progress bar
                        },
                        {
                            data: [100 - {{ $pendingOrders }}],
                            backgroundColor: ['rgba(200, 200, 200, 1)'],
                            borderWidth: 0,
                            barPercentage: 0.6, // Adjust the width of the progress bar
                        },
                    ],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false, // Hide the legend
                        },
                    },
                    scales: {
                        x: {
                            display: false, // Hide the x-axis labels
                        },
                        y: {
                            display: false, // Hide the y-axis labels
                            beginAtZero: true,
                            max: 100,
                            min: 0,
                        },
                    },
                },
            });






        });
    </script>
