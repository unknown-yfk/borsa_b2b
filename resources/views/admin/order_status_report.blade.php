<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Borsa</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{!! asset('that/vendors/mdi/css/materialdesignicons.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('that/vendors/base/vendor.bundle.base.css') !!}">


    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{!! asset('that/vendors/datatables.net-bs4/dataTables.bootstrap4.css') !!}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{!! asset('that/css/style.css') !!}">
    <!-- endinject -->
    {{-- <link rel="shortcut icon" href="{!! asset('that/images/favicon.png') !!}"> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.21.4/bootstrap-table.min.js"
        integrity="sha512-rZAhvMayqW5e/N+xdp011tYAIdxgMMJtKxUXx7scO4iBPSUXAKdkrKIPRu6tLr0O9V6Bs9QujJF3MqmgSNfYPA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script> --}}

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" > --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> --}}
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>





    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"> --}}

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">



    {{-- <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet"> --}}
</head>

<body>
    @include('sweetalert::alert')

    @include('layout.partials.nav')
    <div class="container-fluid page-body-wrapper">
        @include('layout.partials.sidebar')
        {{-- <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet"> --}}

        <div class="main-panel">
            <div class="content-wrapper">




                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Order Status List</h4>


                            <div class="table-responsive pt-3">
                                <table id="recent-purchases-listing" class="dataTable">

                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Region</th>
                                            <th>City</th>
                                            <th>Started Date</th>
                                            <th>End Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($order_status) && $order_status->count())
                                            @foreach ($order_status as $order)
                                                <tr>
                                                    <td>{{ $order->id }}</td>
                                                    <td>{{ $order->Region }} </td>
                                                    <td>{{ $order->City }}</td>
                                                    <td>{{ $order->startdate }}</td>
                                                    <td>{{ $order->enddate }}</td>
                                                    <td>
                                                        <input data-id="{{ $order->id }}" class="toggle-class"
                                                            type="checkbox" data-onstyle="success"
                                                            data-offstyle="danger" data-toggle="toggle" data-on="Start"
                                                            data-off="End" {{ $order->order_status ? 'checked' : '' }}>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="10">There are no data.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @endsection --}}





        <!-- End custom js for this page-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"
            integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
            integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script>

        {{-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> --}}
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.6.0/pagination.min.js"
            integrity="sha512-GzbaI5EsNzdEUq6/2XLYpr1y9CUZRIVsUeWTAFgULtQa5jZ3Nug8i0nZKM6jp9NffBCZhymPPQFcF0DK+JkRpw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>


        <script src="{!! asset('that/js/jquery.cookie.js" type="text/javascript') !!}"></script>

        {{-- <script src="{!! asset('that/vendors/base/vendor.bundle.base.js') !!}"></script> --}}
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <script src="{!! asset('that/vendors/chart.js/Chart.min.js') !!}"></script>
        <script src="{!! asset('that/vendors/datatables.net/jquery.dataTables.js') !!}"></script>
        <script src="{!! asset('that/vendors/datatables.net-bs4/dataTables.bootstrap4.js') !!}"></script>
        <script src="{!! asset('that/js/datatables-simple-demo.js') !!}"></script>

        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="{!! asset('that/js/off-canvas.js') !!}"></script>
        <script src="{!! asset('that/js/hoverable-collapse.js') !!}"></script>
        <script src="{!! asset('that/js/template.js') !!}"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="{!! asset('that/js/dashboard.js') !!}"></script>
        <script src="{!! asset('that/js/data-table.js') !!}"></script>
        <script src="{!! asset('that/js/jquery.dataTables.js') !!}"></script>
        <script src="{!! asset('that/js/dataTables.bootstrap4.js') !!}"></script>

        {{-- @if (Session::has('message'))

  <script>
    toastr.success("{{Session::get(message)}}");
    </script>
@endif --}}


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

        {{-- <script>
            $(function() {
                $('.toggle-class').change(function() {
                    var status = $(this).prop('checked') == true ? 1 : 0;
                    var user_id = $(this).data('id');

                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: '/admin/order/changeStatus',
                        data: {
                            'status': status,
                            'user_id': user_id
                        },
                        success: function(data) {
                            console.log(data.success)
                        }
                    });
                })
            });
        </script> --}}
