@include('layout.header')
<body class="sb-nav-fixed">
    @include('nav.admin_navbar')
        <div id="layoutSidenav">
            @include('Sidenavbar.adminSidebar')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                            <h1 class="mt-4">Order Conformation Report</h1>
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
                                            <th>Order ID</th>
                                            <th>Client</th>
                                            <th>Conformation Status</th>
                                            <th>Order Date</th>
                                            <th>Key Distrbutor</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($orderConformation as $order)
                                      <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{Helper::get_client_name($order->client_id)}}</td>
                                            <td>{{$order->confirmStatus}}</td>
                                            <td>{{$order->created_at}}</td>
                                            <td>{{$order->firstName . ' ' . $order->middleName . ' ' . $order->lastName}}</td>

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

