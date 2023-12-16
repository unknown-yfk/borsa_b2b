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
                        <h4 class="card-title">Onboarding Report</h4>
                        <p class="card-description">
                            <code>Report</code>
                        </p>
                        <input type="hidden" {{ $no = 0 }} />
                        <div class="table-responsive pt-3">

                            <table id="table" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Reg. Date & Time</th>
                                        <th>Client ID</th>
                                        <th>Clinet Name</th>
                                        <th>Training taken</th>
                                        <th>Age</th>
                                        <th>Nationality</th>
                                        <th>Region</th>
                                        <th>City</th>
                                        <th>Camp</th>
                                        <th>Action</th>


                                    </tr>
                                </thead>
                                <tbody>

                                    @if (!empty($users) && $users->count())
                                        @foreach ($users as $order)
                                            <tr>
                                                <td>{{ $no = $no + 1 }}</td>
                                                <td>{{ $order->created_at }}</td>
                                                <td>{{ $order->client_unique_id }}</td>
                                                <td>{{ $order->full_name }}</td>
                                                <td>{{ $order->Training_module1 }} {{ $order->Training_module2 }}
                                                    {{ $order->Training_module3 }}</td>
                                                <td>{{ $order->age }}</td>
                                                <td>{{ $order->Nationality }}</td>
                                                <td>{{ $order->Region }}</td>
                                                <td>{{ $order->City }}</td>
                                                <td>{{ $order->camp }}</td>
                                                <td>
                                                    <form action="{{ '/ho/user/details' }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" value="{{ $order->id }}" name="user_id">
                                                        <button type="submit" class="btn btn-outline-success">View
                                                            Details</button>
                                                    </form>
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
