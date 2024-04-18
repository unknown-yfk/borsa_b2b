@extends('layouts.mainlayout')
@section('content')
  <style>
        .filter-form {
            display: flex;
            justify-content: end;
            gap: 20px;
            margin: 10px;

        }
        .filter-form button {
            height: 35px;
            margin-top: 25px;
        }
    </style>
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
                        <form action="{{ '/ho/onboarding/filteronboarding' }}" method="GET" class="filter-form">
                                <!-- <form action="" method="GET" class="filter-form"> -->

                                <div>
                                    <span>From:</span>
                                    <input type="date" name="from_date" id="from_date" style="width: 160px;"
                                        class="form-control">
                                </div>
                                <div class="">
                                    <label for="to_date">To:</label>
                                    <input type="date" name="to_date" id="to_date" style="width: 160px;"
                                        class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Filter</button>

                        </form>
                         <form action="{{ '/ho/user/details/export' }}" method="GET" class="filter-form">
                        <button type="submit" class="btn btn-primary">Export All</button>
                         </form>

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
                            {{-- {{ $users->links() }} --}}


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

            ],
            paging: true,
        pageLength: 10,

        });
         function exportDetailsData() {

            var selectedRow = table.rows({ selected: true }).data()[0];


            if (selectedRow) {
                // Extract the user ID from the selected row
                var userId = selectedRow[0]; // Adjust the index as needed

                // Make an AJAX request to the server to handle the export
                $.ajax({
                    url: '{{ url("/ho/user/details/export") }}', // Replace with your export route
                    method: 'POST',
                    data: { user_id: userId },
                    success: function (response) {
                        // Handle the success response (e.g., open the exported file)
                        console.log('Export successful:', response);
                    },
                    error: function (error) {
                        // Handle the error response
                        console.error('Export error:', error);
                    }
                });
            } else {
                // Inform the user to select a row
                alert('Please select a row to export details.');
            }
        }

    </script>

@endsection
