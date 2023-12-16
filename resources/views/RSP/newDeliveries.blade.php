@include('RSP.header')
    <body class="sb-nav-fixed">
        @include('nav.rsp_navbar')
        <div id="layoutSidenav">
            @include('Sidenavbar.rspSidebar')

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">New Deliveries From ROM</h1>
                            <div class="row">
                            <div class="card-body">
                            <div class="card mb-4">
                            <div class="card-header">
                                <strong></strong>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Delivery ID</th>
                                            <th>Recieved from</th>
                                            <th>Order_id</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($rom as $roms)

                                      <tr>
                                            <td>{{$roms->id}}</td>
                                            <td>{{$roms->firstName}} {{$roms->middleName}} {{$roms->lastName}}</td>

                                            <td>{{$roms->order_id}}</td>

                                            <td>
                                            <form action="{{ ('/rspDeliveryDetails') }}" method="POST">
                                               @csrf
                                               <input type="hidden" value="{{$roms->id}}" name="delivery2_id" >
                                             <button type="submit" >view details</button>
                </form></td>          </tr>
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

                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('js/scripts.js') }}"></script>
        <script src=" https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{url ('assets/demo/chart-area-demo.js')}}"></script>
        <script src="{{url ('assets/demo/chart-bar-demo.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="{{url ('js/datatables-simple-demo.js') }}"></script>
   </body>
</html>
