@extends('layouts.mainlayout')
@section('content')

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">




    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script type='text/javascript' src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Client List</h4>
                        <p class="card-description">
                            <code>Report</code>
                        </p>
                        <input type="hidden" {{ $no = 0 }} />
                        <div class="table-responsive pt-3">

                            <table id="table" class="display nowrap" style="width:100%">

                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Full Name</th>
                                            <th>User Name</th>
                                            <th>Account Status</th>
                                            {{-- <th>Qr Generator</th> --}}
                                            <th>Distributor</th>
                                            <th>Region</th>
                                            <th>City</th>
                                            <th>Action</th>
                                        </tr>
                                    <tbody id = "result">
                                        @if (!empty($client) && $client->count())
                                            @foreach ($client as $clients)
                                                <tr>
                                                    <td>{{ $clients->id }}</td>
                                                    <td>{{ $clients->firstName }} {{ $clients->middleName }}
                                                        {{ $clients->lastName }}</td>
                                                    <td>{{ $clients->userName }}</td>

                                                    <td>
                                                        <input data-id="{{ $clients->user_id }}" class="toggle-class"
                                                            type="checkbox" data-onstyle="success"
                                                            data-offstyle="danger" data-toggle="toggle" data-on="active"
                                                            data-off="inactive" {{ $clients->status ? 'checked' : '' }}>
                                                    </td>
                                                    {{-- <td><a href="{{ url('/admin/view/clients/' . $clients->id) }}"><button
                                                                class="btn btn-primary">
                                                                <i class="fa fa-qrcode"></i></button></a></td> --}}
                                                    <td>{{ $clients->distro_id }}</td>
                                                     <td>{{ $clients->Region }}</td>
                                                      <td>{{ $clients->City }}</td>
                                                    <td>
                                                        <a href="{{ url('/analyist/edit/client', $clients->user_id) }}">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

    </script>

@endsection

