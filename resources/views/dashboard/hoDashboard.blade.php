@extends('layouts.mainlayout')
@extends('layouts.app')
@section('content')

<style>
  .charts{
    display:flex;
    height: 300px;

    /* padding-top:20px; */
    justify-items:center;
  }
  .top-cards{
    display: flex;
    gap: 30px;
    justify-content: center;
    
   
  }
  .firstLine-charts{
    display:flex;
  }
  .barChart{
    padding:10px;
    width: 65%;
    /* margin-top: 10px; */
    margin-bottom: 40px;
    background-color: rgba(193, 232, 225, 0.2);
    
    
    
  }
    .chart-container {
        padding:10px;
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
                  {{-- <div class="d-flex">
                    <i class="mdi mdi-home text-muted hover-cursor"></i>
                    <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                    <p class="text-primary mb-0 hover-cursor">Analytics</p>
                  </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                  <button type="button" class="btn btn-light bg-white btn-icon me-3 d-none d-md-block ">
                    <i class="mdi mdi-download text-muted"></i>
                  </button>
                  <button type="button" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
                    <i class="mdi mdi-clock-outline text-muted"></i>
                  </button>
                  <button type="button" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
                    <i class="mdi mdi-plus text-muted"></i>
                  </button>
                  <button class="btn btn-primary mt-2 mt-xl-0">Generate report</button> --}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body dashboard-tabs p-0">
                  <ul class="nav nav-tabs px-4" role="tablist">
                    {{-- <li class="nav-item">
                      <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="sales-tab" data-bs-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="false">Sales</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="purchases-tab" data-bs-toggle="tab" href="#purchases" role="tab" aria-controls="purchases" aria-selected="false">Purchases</a>
                    </li> --}}
                     <li class="nav-item">
                      <a class="nav-link" id="users-tab" data-bs-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="false">Users</a>
                    </li>

                  </ul>
                  <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade show " id="overview" role="tabpanel" aria-labelledby="overview-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Start date</small>
                            <div class="dropdown">
                              <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium" href="#" role="button" id="dropdownMenuLinkA" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h5 class="mb-0 d-inline-block">26 Jul 2018</h5>
                              </a>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                <a class="dropdown-item" href="#">12 Aug 2018</a>
                                <a class="dropdown-item" href="#">22 Sep 2018</a>
                                <a class="dropdown-item" href="#">21 Oct 2018</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-currency-usd me-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Revenue</small>
                            <h5 class="me-2 mb-0">577545</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-eye me-3 icon-lg text-success"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total views</small>
                            <h5 class="me-2 mb-0">9833550</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-download me-3 icon-lg text-warning"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Downloads</small>
                            <h5 class="me-2 mb-0">2233783</h5>
                          </div>
                        </div>
                        <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Flagged</small>
                            <h5 class="me-2 mb-0">3497843</h5>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Start date</small>
                            <div class="dropdown">
                              <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium" href="#" role="button" id="dropdownMenuLinkA" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h5 class="mb-0 d-inline-block">26 Jul 2018</h5>
                              </a>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                <a class="dropdown-item" href="#">12 Aug 2018</a>
                                <a class="dropdown-item" href="#">22 Sep 2018</a>
                                <a class="dropdown-item" href="#">21 Oct 2018</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-download me-3 icon-lg text-warning"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Downloads</small>
                            <h5 class="me-2 mb-0">2233783</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-eye me-3 icon-lg text-success"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total views</small>
                            <h5 class="me-2 mb-0">9833550</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-currency-usd me-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Revenue</small>
                            <h5 class="me-2 mb-0">$577545</h5>
                          </div>
                        </div>
                        <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Flagged</small>
                            <h5 class="me-2 mb-0">3497843</h5>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="purchases" role="tabpanel" aria-labelledby="purchases-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Start date</small>
                            <div class="dropdown">
                              <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium" href="#" role="button" id="dropdownMenuLinkA" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h5 class="mb-0 d-inline-block">26 Jul 2018</h5>
                              </a>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                <a class="dropdown-item" href="#">12 Aug 2018</a>
                                <a class="dropdown-item" href="#">22 Sep 2018</a>
                                <a class="dropdown-item" href="#">21 Oct 2018</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-currency-usd me-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Revenue</small>
                            <h5 class="me-2 mb-0">$577545</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-eye me-3 icon-lg text-success"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total views</small>
                            <h5 class="me-2 mb-0">9833550</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-download me-3 icon-lg text-warning"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Downloads</small>
                            <h5 class="me-2 mb-0">2233783</h5>
                          </div>
                        </div>
                        <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Flagged</small>
                            <h5 class="me-2 mb-0">3497843</h5>
                          </div>
                        </div>
                      </div>
                     </div>


                     <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          {{-- <i class="mdi mdi-calendar-heart icon-lg me-3 text-primary"></i> --}}
                          {{-- <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Start date</small>
                            <div class="dropdown">
                              <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium" href="#" role="button" id="dropdownMenuLinkA" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h5 class="mb-0 d-inline-block">26 Jul 2018</h5>
                              </a>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                <a class="dropdown-item" href="#">12 Aug 2018</a>
                                <a class="dropdown-item" href="#">22 Sep 2018</a>
                                <a class="dropdown-item" href="#">21 Oct 2018</a>
                              </div>
                            </div>
                          </div>
                        </div> --}}

                        
                          <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-account-outline me-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total Clients/Agents</small>
                            <h5 class="me-2 mb-0">{{$client}}</h5>
                          </div>
                        </div>
                          <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-account-outline me-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total ROMS</small>
                            <h5 class="me-2 mb-0">{{$roms}}</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-account-outline me-3 icon-lg text-warning"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total Borsa Point</small>
                            <h5 class="me-2 mb-0">{{$agents}}</h5>
                          </div>
                        </div>
                        <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-account-outline me-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total Key distributors</small>
                            <h5 class="me-2 mb-0">{{$kds}}</h5>
                          </div>
                        </div>
                      </div>
                    </div>
                    </div>



                </div>
              </div>
             </div>


          </div>
          <div class="row">
            {{-- <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Cash deposits</p>
                  <p class="mb-4">To start a blog, think of a topic about and first brainstorm party is ways to write details</p>
                  <div id="cash-deposits-chart-legend" class="d-flex justify-content-center pt-3"></div>
                  <script> window.count = ''; </script>
                  <canvas id="cash-deposits-chart"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Total sales</p>
                  <h1>{{$total_sales}} Birr</h1>
                  <h4>Gross sales over the years</h4>
                  <p class="text-muted">Today, many people rely on computers to do homework, work, and create or store useful information. Therefore, it is important </p>
                  <div id="total-sales-chart-legend"></div>
                </div>
                <canvas id="total-sales-chart"></canvas>
              </div>
            </div> --}}
          </div>
     
        </div><h3>Order Details </h3>

<div class='top-cards'>
<div class="number-card">
  <div class="number-card__title">Total  Ordered Products</div>
  <div class="number-card__value">{{$totalConfirmedProducts}}</div>
</div>
<div class="number-card">
  <div class="number-card__title">Total  Orders Amount</div>
  <div class="number-card__value">{{$totalConfirmedAmount}} ETB</div>
</div>

<div class="number-card">
  <div class="number-card__title">Active Pending Orders </div>
  <div class="number-card__value">{{$pendingOrders}}</div>
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
     <h5>Top Ordered Products</h5>
    <canvas id="myChart"></canvas>
</div>

   


     </div>
     
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer" style="margin-top: 60px;">
         <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © Elebat solution<a
                        href="https://Elebatsolution.com/" target="_blank">Elebatsolution.com </a>2023</span>

            </div>
        </footer>
        <!-- partial -->
      </div>







@endsection
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1"></script>

<script>
 
    var mostOrderedProducts = {!! $mostOrderedProducts !!};
    var labels = mostOrderedProducts.map(function (item) {
    return item.name;
  });
  var data = mostOrderedProducts.map(function (item) {
    return item.total_ordered;
  });

    document.addEventListener('DOMContentLoaded', function () {
    //barchart


        var ctxPie = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                      labels: ['Rejected Orders', 'Accepter Orders','Pending', 'Adjusted Orders', ],
                datasets: [{
                    label: 'Data',
                    data: [
                        {{ $rejectedOrder }},
                        {{ $acceptedOrder }},
                        {{ $pending }},
                        {{ $adjustedORder }},

                    ],
                    backgroundColor: [
                      'rgba(255, 99, 132, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                         'rgba(190, 168, 23, 0.8)',
                        'rgba(54, 162, 235, 0.8)',

                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(190, 168, 23, 1)',
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
                labels: ['Approved by ROM', 'Approved by TM', 'Delivered'],
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
    datasets: [
      {
        label: 'Top Ordered Products',
        data: data,
        backgroundColor: 'rgba(54, 162, 235, 0.5)', // Bar color
        borderColor: 'rgba(54, 162, 235, 1)', // Bar border color
        borderWidth: 1,
      },
    ],
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


// guage charts 
var progressBar = document.getElementById('guageChart').getContext('2d');

var progressChart = new Chart(progressBar, {
  type: 'bar',
  data: {
    labels: ['Pending Orders'],
    datasets: [
      {
        data: [{{$pendingOrders}}],
        backgroundColor: ['rgba(54, 162, 235, 1)'],
        borderWidth: 0,
        barPercentage: 0.6, // Adjust the width of the progress bar
      },
      {
        data: [100 - {{$pendingOrders}}],
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