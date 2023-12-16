@include('layout.header')

<body class="sb-nav-fixed">
    @include('nav.kd_navbar')
        <div id="layoutSidenav">
            @include('Sidenavbar.kdSidebar')
            <div id="layoutSidenav_content">
                <main>
                   <div class="container-fluid px-4">
                        <h1 class="mt-4">Delivery History</h1>
                        <div class="row">
                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Delivery ID</th>
                                            <th>Delivered To</th>
                                            <th>Order_id</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                @foreach($rom as $roms)
                                      <tr>
                                        <td>{{$roms->id}}</td>
                                        <td>{{$roms->firstName}} {{$roms->middleName}} {{$roms->lastName}}</td>
                                        <td>{{$roms->order_id}}</td>
                                        <td>{{$roms->created_at->format('d/m/y')}}</td>
                                        <td>
                                            <form action="{{ ('/handover/detail') }}" method="POST">
                                               @csrf
                                               <input type="hidden" value="{{$roms->id}}" name="delivery1_id" >
                                             <button type="submit" class="btn btn-outline-success">View Details</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                @include('layout.footer')
            </div>
        </div>
</body>
</html>
