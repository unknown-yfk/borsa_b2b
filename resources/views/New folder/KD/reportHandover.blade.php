<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>e-pace</title>
    <link href="{{ url('css/styles.css') }}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ url('js/scripts.js') }}"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{url ('assets/demo/chart-area-demo.js')}}"></script>
    <script src="{{url ('assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="{{url ('js/datatables-simple-demo.js') }}"></script>
</head>
<body class="sb-nav-fixed">
    @include('nav.kd_navbar')
        <div id="layoutSidenav">
            @include('Sidenavbar.kdSidebar')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                            <h1 class="mt-4">Handover Report</h1>
                            <div class="row">
                            <div class="card-body">
                            <div class="card mb-4">
                            <div class="card-header">
                                <strong>Report</strong>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Delivery ID</th>
                                            <th>Delivery Status</th>
                                            <th>Delivery  Date</th>
                                            <th>Order ID</th>
                                            <th>Handoverd To</th>
                                            <th>Handover Status</th>
                                            <th>Handover Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($handover as $handover)
                                      <tr>
                                            <td>{{$handover->id}}</td>
                                            <td>{{$handover->confirmStatus}}</td>
                                            <td>{{$handover->created_at}}</td>
                                            <td>{{$handover->order_id}}</td>
                                            <td>{{$handover->firstName}} {{$handover->middleName}} {{$handover->lastName}}</td>
                                            <td>{{$handover->handoverStatus}}</td>
                                            <td>{{$handover->createdDate}}</td>
                                        </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
    @include('layout.footer')
            </div>
        </div>
   </body>
</html>

