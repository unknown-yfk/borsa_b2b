@include('layout.header')
{{-- @section('pagecss')
    <link href="{{ url('../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">client List</h4>
                    <div class="ms-auto text-end">

                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                {{-- <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Contact</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clients as $client)
                                            <tr>
                                                <td>{{ $loop->index + 1}}</td>
                                                <td>{{ $client->firstName }} {{ $client->lastName }}</td>
                                                <td><b>Phone Number: </b> {{ $staff->mobile }}

                                                </td>
                                                <td>{{ $staff->address }}</td>
                                                <td>
                                                    <!-- /btn-select-group -->
                                                    <div class="btn-group">
                                                        <button type="button"
                                                            class="btn btn-danger dropdown-toggle text-white"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            Select
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                                href="{{ route('staff.show', $staff->id) }}">View </a>

                                                        </div>
                                                    </div>
                                                    <!-- /btn-select-group -->
                                                </td>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Contact</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table> --}}
                            {{-- </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('pagejs')
        <script src="{{ url('../assets/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
        <script src="{{ url('../assets/extra-libs/multicheck/jquery.multicheck.js') }}"></script>
        <script src="{{ url('../assets/extra-libs/DataTables/datatables.min.js') }}"></script>
        <script>
            $("#zero_config").DataTable();
        </script>
    @endsection --}}
