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

        .drop-button {
            background: none;
            border: 1px solid black;
            border-radius: 2px;
            padding: 5px;

        }

        .region-select {
            display: flex;
            flex-direction: column;

            gap: 0;
        }

        .region-select>label {
            height: 2px;
        }

        .select-option {
            padding: 10px;
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




    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> ORDER CAPTURE SUMMARY REPORT </h4>
                        <p class="card-description">
                            <code>Report</code>
                        </p>
                        {{-- initallizing 4 varables
                             --}}
                        <input type="hidden" {{ $no = 0 }} />
                        <input type="hidden" {{ $total = 0 }} />
                        <input type="hidden" {{ $k = 4 }} />
                        <input type="hidden" {{ $size = sizeof($product) }} />

                        <div class="table-responsive pt-3">
                            <form action="{{ route('hodeliveryReport') }}" method="GET" class="filter-form"
                                id="filterForm">
                                <div class="region-select">
                                    <label for="region_filter">Region:</label>
                                    <button type="button" id="showDropdownBtn" class="bg-white drop-button ">Select by
                                        Regions</button>
                                    <select name="region_filter[]" id="region_filter" class="form-control" multiple
                                        style="display: none;">
                                        @if (!empty($uniqueRegions))
                                            @foreach ($uniqueRegions as $region)
                                                @if (!empty($region))
                                                    <option class="select-option" value="{{ $region }}">
                                                        {{ $region }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>



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
                                        <th>Order Date</th>
                                        <th>Agent Name</th>
                                        <th>Region</th>
                                        <th>City</th>
                                        @if (!empty($product) && $product->count())
                                            @foreach ($product as $order)
                                                <th>{{ $order->name }}</th>
                                            @endforeach
                                            <th>Subtotal</th>
                                        @else
                                            <th colspan="10">There are no data.</th>
                                        @endif

                                    </tr>

                                </thead>
                                <tbody>

                                    @if (!empty($LastMileReport) && $LastMileReport->count())
                                        @for ($i = 0; $i < sizeof($LastMileReport); $i++)
                                            <tr>
                                                <td>{{ $no = $no + 1 }}</td>
                                                <td>{{ $LastMileReport[$i]->createdDate }}</td>
                                                <td>{{ $LastMileReport[$i]->firstName }}
                                                    {{ $LastMileReport[$i]->middleName }}
                                                    {{ $LastMileReport[$i]->lastName }}</td>
                                                <td>{{ $LastMileReport[$i]->City }}</td>
                                                <td>{{ $LastMileReport[$i]->Region }}</td>

                                                @for ($j = 0; $j < sizeof($product); $j++)
                                                    @if ($product[$j]->id == $LastMileReport[$i]->id)
                                                        <td>{{ $LastMileReport[$i]->ordered_quantity }}</td>
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
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Total for this page:</td>
                                        @for ($j = 0; $j < sizeof($product); $j++)
                                            <input type="hidden" {{ $k = $k + 1 }} />
                                            <td id="{{ $k }}">0</td>
                                        @endfor

                                        <input type="hidden" {{ $k = $k + 1 }} />
                                        <td><strong>Subtotal: <span id="{{ $k }}">0</span></strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="text-large"><strong>Grand Total Price: {{ $total }} </strong></div>




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            var table = $('#table').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            });

            // Call the function when the page loads
            calculateAndUpdateTotals();

            // Update totals when the table is redrawn (e.g., after filtering or paging)
            table.on('draw.dt', function() {
                calculateAndUpdateTotals();
            });

            // Your existing code for dropdown and other functionalities
            var isDropdownVisible = false;

            // Show/hide dropdown when the button is clicked
            $('#showDropdownBtn').on('click', function() {
                isDropdownVisible = !isDropdownVisible;
                $('#region_filter').toggle(isDropdownVisible);
            });

            // Apply Select2 to the region dropdown
            $('#region_filter').select2();

            // Close dropdown when an option is selected
            $('#region_filter').on('select2:select', function() {
                isDropdownVisible = false;
                $('#region_filter').hide();
            });

            function calculateAndUpdateTotals() {
                var sum = 0;

                var a = {{ $size }} + 6;

                for (var i = 5; i < a; i++) {
                    table.rows({
                        page: 'current',
                        search: 'applied'
                    }).every(function() {
                        var rowData = this.data();

                        var size = {{ $size }} + 5;
                        var columnValue = parseFloat(rowData[i]);

                        if (!isNaN(columnValue)) {
                            sum += columnValue;
                        }
                    });

                    var subtotalElement = document.getElementById(i);
                    subtotalElement.textContent = sum;
                    sum = 0;
                }
            }
        });
    </script>


@endsection
