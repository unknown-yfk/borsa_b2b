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

    {{-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script> --}}





    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>




    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">





    <!-- Add this in the head section of your HTML -->







    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">BORSA Loan REPORT </h4>
                        <p class="card-description">
                            <code>Report</code>
                        </p>
                        <input type="hidden" {{ $no = 0 }} />
                        <input type="hidden" {{ $total = 0 }} />
                        <input type="hidden" {{ $k = 4 }} />



                        <input type="hidden" {{ $size = sizeof($loan) }} />

                        <div class="table-responsive pt-3">
                            <table id="table" class="display nowrap" style="width:100%">
                                <thead>

                                    <tr>
                                        <th>NO</th>
                                        <th>Disbursment Date</th>
                                        <th>Agent Name</th>
                                        <th>Region</th>
                                        <th>City</th>
                                        <th>Loan Amount</th>
                                        <th>Remaining Amount</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @if (!empty($loan) && $loan->count())
                                        @for ($i = 0; $i < sizeof($loan); $i++)
                                            <tr>
                                                <td>{{ $no = $no + 1 }}</td>
                                                <td>{{ $loan[$i]->disbursed_date }}</td>
                                                <td>{{ $loan[$i]->firstName }}
                                                    {{ $loan[$i]->middleName }}
                                                    {{ $loan[$i]->lastName }}
                                                </td>
                                                <td>{{ $loan[$i]->Region }}</td>
                                                <td>{{ $loan[$i]->City }}</td>
                                                <td>{{ $loan[$i]->amount }}</td>
                                                <td>{{ $loan[$i]->remaining_amount }}</td>


                                            </tr>
                                            @endfor
                                        @else
                                            <tr>
                                                <td colspan="10">There area no data.</td>
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
                                        @for ($j = 0; $j < 2; $j++)
                                            <input type="hidden" {{ $k = $k + 1 }} />
                                            <td id="{{ $k }}">0</td>
                                        @endfor

                                        <input type="hidden" {{ $k = $k + 1 }} />
                                        {{-- <td><strong>Subtotal: <span id="{{ $k }}">0</span></strong></td> --}}
                                    </tr>
                                </tfoot>
                            </table>
                            {{-- <div class="text-large"><strong>Grand Total Price: {{ $total }} </strong></div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            var isDropdownVisible = false;

            // Show/hide dropdown when the button is clicked
            $('#showCityDropdownBtn').on('click', function() {
                isDropdownVisible = !isDropdownVisible;
                $('#city_filter').toggle(isDropdownVisible);
            });

            // Apply Select2 to the region dropdown
            $('#city_filter').select2();

            // Close dropdown when an option is selected
            $('#city_filter').on('select2:select', function() {
                isDropdownVisible = false;
                $('#city_filter').hide();
            });
        });
    </script>
    <script>
        var table = $('#table').DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        });

        $(document).ready(function() {
            calculateAndUpdateTotals();
            table.on('draw.dt', function() {
                calculateAndUpdateTotals();
            });

            var isDropdownVisible = false;

            $('#showDropdownBtn').on('click', function() {
                isDropdownVisible = !isDropdownVisible;
                $('#region_filter').toggle(isDropdownVisible);
            });

            $('#region_filter').select2();

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
