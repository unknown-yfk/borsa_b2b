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
                        <h4 class="card-title">Product Report Per Location</h4>
                        <p class="card-description">
                            <code>Report</code>
                        </p>
                        <input type="hidden" {{$no=0}} />
                        <div class="table-responsive pt-3">
                            <form action="{{ '/ho/product/filterlocation' }}" method="GET" class="filter-form">
                                <!-- <form action="" method="GET" class="filter-form"> -->
                                <div>
                                    <span>From:</span>
                                    <input type="date" name="from" id="from" style="width: 160px;"
                                        class="form-control">
                                </div>
                                <div class="">
                                    <label for="to">To:</label>
                                    <input type="date" name="to" id="to" style="width: 160px;"
                                        class="form-control">
                                </div>
                                <div>
                                    <span>Region:</span>
                                    <input type="text" name="Region" id="Region" style="width: 160px;"
                                        class="form-control">
                                </div>
                                <div class="">
                                    <label for="productname">Product Name:</label>
                                    <input type="text" name="productname" id="productname" style="width: 160px;"
                                        class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </form>
                            <table id="table" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Order Date</th>
                                        <th>Region</th>
                                        <th>Product Name</th>
                                        <th>Total Ordered Per Piece</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($total) && $total->count())
                                        @foreach ($total as $order)
                                            <tr>
                                                <td>{{ $no=$no+1 }}</td>
                                                <td>{{ $order->max }} - {{$order->min }}</td>
                                                <td>{{ $order->Region }}</td>
                                                <td>{{ $order->name }}</td>
                                                <td>{{ $order->total_ordered }}</td>

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
