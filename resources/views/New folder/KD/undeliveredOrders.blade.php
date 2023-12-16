@include('layout.header')

<body class="sb-nav-fixed">
    @include('nav.kd_navbar')
        <div id="layoutSidenav">
            @include('Sidenavbar.kdSidebar')
            <div id="layoutSidenav_content">
                <main>
                   <div class="container-fluid px-4">
                        <h1 class="mt-4">Rejected Orders</h1>
                        <div class="row">
                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Order_id</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($UndeliverdOrders as $UndeliverdOrders)
                                      <tr>
                                            <td>{{$UndeliverdOrders->id}}</td>
                                            <td>{{$UndeliverdOrders->order_id}}</td>
                                            <td>{{$UndeliverdOrders->created_at->format('d/m/y')}}</td>
                                            <td>
                                            <form action="{{ ('/undeliveredDetails') }}" method="POST">
                                               @csrf
                                               <input type="hidden" value="{{$UndeliverdOrders->id}}" name="delivery1_id" >
                                             <button type="submit"  class="btn btn-outline-success">View Detail</button>
                                            </form></td>
                                        </tr>
                                @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            @include('layout.footer')
        </div>
    </div>
<style type="text/css">
body{
    margin-top:20px;
    background:#eee;
}
.ui-w-40 {
    width: 40px !important;
    height: auto;
}

.card{
    box-shadow: 0 1px 15px 1px rgba(52,40,104,.08);
}

.ui-product-color {
    display: inline-block;
    overflow: hidden;
    margin: .144em;
    width: .875rem;
    height: .875rem;
    border-radius: 10rem;
    -webkit-box-shadow: 0 0 0 1px rgba(0,0,0,0.15) inset;
    box-shadow: 0 0 0 1px rgba(0,0,0,0.15) inset;
    vertical-align: middle;
}
</style>
</body>
</html>
