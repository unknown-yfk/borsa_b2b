@extends('layouts.mainlayout')
@section('content')
    <script src="//code.jquery.com/jquery-1.12.3.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">List of Clients</h4>

                        <p class="card-description">
                            <code>CLients</code>
                        </p>
                        <div class="table-responsive pt-3">
                            <table id="table" class="table">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Full Name</th>
                                        <th>User Name</th>
                                        <th>Account Status</th>
                                        <th>Qr Generator</th>
                                        <th>Distributor</th>
                                        <th>Region</th>
                                        <th>City</th>
                                        <th>Action</th>
                                    </tr>
                                <tbody id="result">
                                    @if (!empty($client) && $client->count())
                                        @foreach ($client as $clients)
                                            <tr>
                                                <td>{{ $clients->id }}</td>
                                                <td>{{ $clients->firstName }} {{ $clients->middleName }}
                                                    {{ $clients->lastName }}</td>
                                                <td>{{ $clients->userName }}</td>

                                                <td>
                                                    <input data-id="{{ $clients->user_id }}" class="toggle-class"
                                                        type="checkbox" data-onstyle="success" data-offstyle="danger"
                                                        data-toggle="toggle" data-on="active" data-off="inactive"
                                                        {{ $clients->status ? 'checked' : '' }}>
                                                </td>
                                                <td><a href="{{ url('/admin/view/clients/' . $clients->id) }}"><button
                                                            class="btn btn-primary">
                                                            <i class="fa fa-qrcode"></i></button></a></td>
                                                <td>{{ $clients->distro_id }}</td>
                                                <td>{{ $clients->Region }}</td>
                                                <td>{{ $clients->City }}</td>
                                                <td>
                                                    <a href="{{ url('admin/edit/client', $clients->user_id) }}">
                                                        <button class="btn btn-outline-success">
                                                            {{ __('Edit') }}
                                                        </button>
                                                    </a>
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
                        {{ $client->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $('.toggle-class').change(function() {

                var status = $(this).prop('checked') == true ? 1 : 0;
                var user_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/client/changestatus',
                    data: {
                        'status': status,
                        'client_id': user_id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        });
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>
@endsection
