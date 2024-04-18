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
                        <h4 class="card-title">Order Fulfilment report</h4>

                        <p class="card-description">
                            <code>Report</code>
                        </p>
                        <div class="table-responsive pt-3">
                            {{-- <a class="btn btn-success" href="{{ '/ho/export_order' }}">Export Orders</a> --}}
                            <form action="{{ '/accion/fulfilment/filterOrders' }}" method="GET" class="filter-form">
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

                            <table id="table" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>

                                        <th>NO</th>
                                        <th>Reg. Date & Time</th>
                                        <th>Client Id</th>
                                        <th>Client Name</th>
                                        <th>Location</th>
                                        <th>Sub-Location</th>
                                        <th>Order Placed Date</th>
                                        <th>Order Amount</th>
                                        <th>Status</th>
                                        <th>Delivery Date</th>
                                        <th>Delivery Status</th>
                                        <th>Delivery Amount</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($results as $result)
                                        <tr>
                                            <td>{{ $result->id }}</td>
                                            <td>{{ $result->user_reg }}</td>
                                            <td>{{ $result->client_unique_id }}</td>
                                            <td>{{ $result->firstname }} {{ $result->lastname }}</td>
                                            <td>{{ $result->Location }}</td>
                                            <td>{{ $result->sub_location }}</td>
                                            <td>{{ $result->order_placed_Date }}</td>
                                            <td>{{ $result->orderAmount }}ETB</td>
                                            <td>{{ $result->status }}</td>
                                            <td>{{ $result->deliveryDate }}</td>
                                            <td>{{ $result->DeliveryStatus }}</td>
                                            <td>{{ $result->deliveryTotal }}</td>




                                        </tr>
                                    @endforeach

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
