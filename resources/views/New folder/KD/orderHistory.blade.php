@include('layout.header')

<body class="sb-nav-fixed">
    @include('nav.kd_navbar')
        <div id="layoutSidenav">
            @include('Sidenavbar.kdSidebar')
            <div id="layoutSidenav_content">
                <main>
                   <div class="container-fluid px-4">
                        <h1 class="mt-4">Order History</h1>
                        <div class="row">
                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Client</th>
                                            <th>Order Date</th>
                                            <th>Payment Status</th>
                                            <th>Confirmation Status</th>
                                            <th>Delivery Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($client as $order)
                                      <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->firstName}} {{$order->middleName}} {{$order->lastName}}</td>
                                            <td>{{$order->createdDate}}</td>
                                            <td>{{$order->paymentStatus}}</td>
                                            <td>{{$order->confirmStatus}}</td>
                                            <td>{{$order->deliveryStatus}}</td>
                                            <td>
                                            <form action="{{ ('/order/details') }}" method="POST">
                                               @csrf
                                               <input type="hidden" value="{{$order->id}}" name="order_id" >
                                             <button type="submit" class="btn btn-outline-success" >View Details</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </table>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
        </main>
    </div>
</div>
</div>
</main>
@include('layout.footer')
            </div>
        </div>
   </body>
</html>
