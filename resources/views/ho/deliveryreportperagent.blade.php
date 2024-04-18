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






    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Product Report Per Agent</h4>
                        <p class="card-description">
                            <code>Report</code>
                        </p>
                        <input type="hidden" {{ $no = 0 }} />
                        <input type="hidden" {{ $total = 0 }} />

                        <div class="table-responsive pt-3">

                            <table id="table" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Agent Name</th>
                                        <th>City</th>
                                        <th>Region</th>
                                        @if (!empty($product) && $product->count())
                                            @foreach ($product as $order)
                                                <th>{{ $order->name }}</th>
                                            @endforeach
                                        @else
                                            <th colspan="10">There are no data.</th>
                                        @endif

                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($LastMileReport) && $LastMileReport->count())
                                        @for ($i = 0; $i < sizeof($LastMileReport); $i++)
                                            <tr>
                                                <td>{{ $no = $no + 1 }}</td>
                                                {{-- <td>{{ $LastMileReport[$i]->id }}</td> --}}
                                                <td>{{ $LastMileReport[$i]->firstName }}
                                                    {{ $LastMileReport[$i]->middleName }}
                                                    {{ $LastMileReport[$i]->lastName }}</td>
                                                <td>{{ $LastMileReport[$i]->City }}</td>
                                                <td>{{ $LastMileReport[$i]->Region }}</td>

                                                @for ($j = 0; $j < sizeof($product); $j++)
                                                    {{-- @php
                                                       echo  sizeof($product);
                                                     @endphp --}}

                                                    @if ($product[$j]->id == $LastMileReport[$i]->id)
                                                        @if ($LastMileReport[$i]->amount_status == 'full')
                                                            <td>{{ $LastMileReport[$i]->delivered_quantity }}</td>
                                                        @elseif($LastMileReport[$i]->amount_status == 'partial')
                                                            <td>{{ $LastMileReport[$i]->partial_quantity }}</td>
                                                        @else
                                                            <td>{{$LastMileReport[$i]->delivered_quantity}}</td>
                                                        @endif
                                                    @else
                                                        <td>0</td>
                                                    @endif
                                                @endfor
                                                <td>{{ $LastMileReport[$i]->subTotal }}</td>

                                                <input type="hidden"
                                                    {{ $total = $total + $LastMileReport[$i]->subTotal }} />
                                        @endfor
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="10">There are no data.</td>
                                        </tr>
                                    @endif

                                </tbody>

                            </table>
                            <div id="subtotal" class="text-large"><strong>Subtotal: <span
                                        id="subtotalAmount">0</span></strong></div>
                            <div class="text-large"><strong>Grand Total Price: {{ $total }} </strong></div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <script>
     var table=   $('#table').DataTable({
         dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]

        });
    </script> --}}
    <script>
        $(document).ready(function() {
            var table = $('#table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]

            });
            table.on('page.dt', function() {
                var sum = 0;

                table.rows({
                    page: 'current',
                    search: 'applied'
                }).every(function() {
                    var rowData = this.data();
                    var columnValue = parseFloat(rowData[35]);
                    if (!isNaN(columnValue)) {
                        sum += columnValue;
                    }
                });

                var subtotalElement = document.getElementById("subtotalAmount");
                subtotalElement.textContent = sum;


            });
        });
    </script>


@endsection
