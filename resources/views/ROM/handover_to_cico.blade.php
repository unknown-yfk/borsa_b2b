@extends('layouts.mainlayout')
@section('content')
    <style>
        .filter-form {
            display: flex;
            justify-content: end;
            gap: 20px;
            margin: 10px;
        }

        /* Custom CSS for handling long text in columns */
        .dataTables_scrollHeadInner th {
            white-space: normal;
            word-wrap: break-word;
        }

        .amount_input {
            width: 75px;
            border-radius: 3px;


        }

        .price {
            display: hidden;
        }

        .no_data {
            display: flex;
            justify-self: center;
            justify-content: center;
            margin-left: 400px;
        }

        .checkboxLabel {
            background-color: Red;
            color: white;
            margin-left: 10px;
            font-weight: bold;

            /* Set the text size to 30px */
            border-radius: 5px;

            /* Add padding to all sides */
            padding: 5px;
        }

        .checkbox {
            padding: 3px;
            margin-top: 5px;
        }


        .reject_button {
            background-color: red;

            width: 100px;
            border: none;
            border-radius: 4px;
            margin-left: 7px;
            padding-top: 2px;

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
    <script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.3.0/css/fixedColumns.dataTables.min.css">

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">New Delivery</h4>

                        <input type="hidden" {{ $no = 0 }} />
                        <input type="hidden" {{ $total = 0 }} />
                        <input type="hidden" {{ $k = 4 }} />
                        <input type="hidden" {{ $f = 4 }} />

                        <input type="hidden" {{ $size = sizeof($product) }} />

                        <div class="table-responsive pt-3">
                            <form action="{{ route('romShow') }}" method="GET" class="filter-form" id="filterForm">
                                <div class="region-select">

                                    <button type="button" id="showDropdownBtn" class="bg-white drop-button ">Select by
                                        Regions</button>
                                    <select name="region_filter[]" id="region_filter" class="form-control" multiple
                                        style="display: none;">


                                         @foreach ($uniqueRegions as $region)
                                            @if (!empty($region))
                                                <option class="select-option" value="{{ $region }}">
                                                    {{ $region }}</option>

                                            @endif
                                        @endforeach

                                    </select>
                                </div>

                                <div class="region-select">
                                    <button type="button" id="showCityDropdownBtn" class="bg-white drop-button">Select by
                                        Cities</button>
                                    <select name="city_filter[]" id="city_filter" class="form-control" multiple
                                        style="display: none;">
                                        @foreach ($uniqueCities as $city)
                                            @if (!empty($city))
                                                <option class="select-option" value="{{ $city }}">
                                                    {{ $city }}</option>
                                            @endif
                                        @endforeach
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


                            <form method="post" action="{{ route('rom_handover_cico') }}">
                                @csrf
                            <table id="table" class="display nowrap" style="width:100%">
                                <thead>

                                    <tr>
                                        <th style="width: 35px; white-space: normal; word-wrap: break-word;">Order Id
                                        </th>
                                        <th style="width: 35px; white-space: normal; word-wrap: break-word;">Order Date
                                        </th>
                                        <th style="width: 35px; white-space: normal; word-wrap: break-word; ">Agent Name
                                        </th>
                                        <th style="width: 35px; white-space: normal; word-wrap: break-word;">Region</th>
                                        <th style="width: 35px; white-space: normal; word-wrap: break-word;">City</th>

                                        @if (!empty($product) && $product->count())
                                            @foreach ($product as $order)
                                                <th style="width: 45px; white-space: normal; word-wrap: break-word;">
                                                    {{ $order->name }}</th>
                                            @endforeach
                                            <th style="width: 45px; white-space: normal; word-wrap: break-word;">
                                                Subtotal</th>
                                        @else
                                            <th colspan="10" style="width: 55px;">There are no data.</th>
                                        @endif

                                    </tr>

                                </thead>
                                <tbody>

                                    @if (!empty($client) && $client->count())

                                        @for ($i = 0; $i < sizeof($client); $i++)
                                            <tr>
                                                <td style="width: 35px; white-space: normal; word-wrap: break-word;"><input type="hidden"
                                                            name="orders[{{ $i }}][orderId]"
                                                            value="{{ $client[$i]->id }}" />
                                                    {{ $client[$i]->id }}</td>
                                                <td style="width: 35px; white-space: normal; word-wrap: break-word; ">
                                                    {{ $client[$i]->created_at }}</td>
                                                <td style="width: 35px;  white-space: normal; word-wrap: break-word;">
                                                    {{ $client[$i]->firstName }} {{ $client[$i]->middleName }}
                                                    {{ $client[$i]->lastName }}</td>
                                                <td style="width: 35px; white-space: normal; word-wrap: break-word;">
                                                    {{ $client[$i]->Region }}</td>
                                                <td style="width: 35px; white-space: normal; word-wrap: break-word;">
                                                    {{ $client[$i]->City }}</td>
                                                @php
                                                    $amount = 0;
                                                    $price = 0;

                                                @endphp

                                                @for ($j = 0; $j < sizeof($product); $j++)
                                                    @php
                                                        $products_id = explode(',', $client[$i]->product_ids);
                                                        $product_id = explode(',', $client[$i]->productt_ids);

                                                        $products_pr = explode(',', $client[$i]->product_price);
                                                    @endphp

                                                    @for ($r = 0; $r < sizeof($products_id); $r++)
                                                        @if ($product[$j]->id == $products_id[$r])
                                                            @php

                                                                    $subPrice = explode(',', $client[$i]->price);
                                                                    $quantities = explode(',', $client[$i]->ordered_quantities);
                                                                    $amount = $quantities[$r];
                                                                    $price = $subPrice[$r];

                                                            @endphp

                                                        @break

                                                    @else
                                                        @php
                                                            $amount = 0;
                                                        @endphp
                                                    @endif
                                                @endfor
                                                <td style="width: 55px;">
                                                    @if ($amount > 0)
                                                        @php
                                                            echo $amount;
                                                        @endphp
                                                        <input name="price" type="hidden" class="priceInput"
                                                            value="{{ $price }}" />
                                                        <input type="hidden"
                                                            name="products[{{ $i }}][{{ $j }}][productId]"
                                                            value="{{ $product_id[$r] }}" />

                                                        <input type="hidden"
                                                            name="products[{{ $i }}][{{ $j }}][productAmount]"
                                                            value="{{ $amount }}" />

                                                        <input type="hidden"
                                                            name="products[{{ $i }}][{{ $j }}][orderId]"
                                                            value="{{ $client[$i]->id }}" />

                                                        <!-- Checkbox for true/false -->
                                                        <div class="checkbox-container">
                                                            <input type="hidden"
                                                                name="products[{{ $i }}][{{ $j }}][isSelected]"
                                                                value="false" />
                                                            <input type="hidden"
                                                                name="products[{{ $i }}][{{ $j }}][quantity]"
                                                                value="null" />
                                                        </div>
                                                    @else
                                                        0
                                                    @endif

                                                </td>

                                            @endfor
                                            <td style="width: 55px;">{{ $client[$i]->deliveryTotalPrice }}</td>
                                        </tr>
                                        <input type="hidden" {{ $total = $total + $client[$i]->deliveryTotalPrice }} />
                                    @endfor
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
                                        <td id="{{ $k }}"></td>
                                    @endfor
                                    <input type="hidden" {{ $k = $k + 1 }} />
                                    <td><strong>Subtotal: <span id="{{ $k }}">0</span></strong></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total Price:</td>
                                    @for ($j = 0; $j < sizeof($product); $j++)
                                        <input type="hidden" {{ $f = $f + 1 }} />
                                        <td id="price_{{ $f }}"></td>
                                    @endfor
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                        <input type="hidden" value="{{$cico_id}}" id="cico_id" name="cico_id" />
                            <button type="submit" class="savebutton btn-primary">Handover</button>
                        </form>

                        <div class="text-large"><strong>Grand Total Price:total {{ $total }}</strong></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.querySelectorAll('.checkbox').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            // Get the corresponding quantity input field
            var quantityInput = this.parentNode.parentNode.querySelector('.quantityInput');

            // Enable or disable the input based on the checkbox state
            quantityInput.disabled = this.checked;

            // Reset the value to 0 when disabling the input
            if (this.checked) {
                quantityInput.value = 0;
            }
        });
    });
</script>

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

        var isDropdownVisible1 = false;

        // Show/hide dropdown when the button is clicked
        $('#showDropdownBtn').on('click', function() {
            isDropdownVisible1 = !isDropdownVisible1;
            $('#region_filter').toggle(isDropdownVisible1);
        });

        // Apply Select2 to the region dropdown
        $('#region_filter').select2();

        // Close dropdown when an option is selected
        $('#region_filter').on('select2:select', function() {
            isDropdownVisible1 = false;
            $('#region_filter').hide();
        });


    });
</script>
<script>
    var table = $('#table').DataTable({
        dom: 'Blfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        lengthMenu: [
            [5, 10, 20, 30, 50, 100, -1],
            [5, 10, 20, 30, 50, 100, "All"]
        ],
        fixedColumns: true,
        fixedColumns: {
            leftColumns: 5
        }
    });

    $(document).ready(function() {

        // Call the function when the page loads
        calculateAndUpdateTotals();

        // Update totals when the table is redrawn (e.g., after filtering or paging)
        table.on('draw.dt', function() {
            calculateAndUpdateTotals();
        });

        // Your existing code for dropdown and other functionalities




        // Listen for page event (pagination change)
        table.on('page.dt', function() {
            calculateAndUpdateTotals();
        });

        // Listen for draw event (table updated)
        table.on('draw.dt', function() {
            calculateAndUpdateTotals();
        });


        function calculateAndUpdateTotals() {

            let columnTotals = {};
            let total = []
            var sums = [];
            var numColumns = {{ $size }} + 6;
            for (var i = 5; i < numColumns; i++) {
                var sum = 0;

                columnTotals[i] = 0;


                $('tr').each(function() {

                    let price = $(this).find('td').eq(i).find('.priceInput').val();

                    if (price) {
                        columnTotals[i] += parseFloat(price);
                    }
                });

                table.rows({
                    page: 'current',
                    search: 'applied'
                }).every(function() {
                    var data = this.data();
                    var value = parseFloat(data[i]) || 0;
                    sum += value;
                });
                // update sum
                total.push(columnTotals[i]);
                sums.push(sum);
                var subtotalElement = document.getElementById(i);
                subtotalElement.textContent = sum;
                var priceElement = document.getElementById("price_" + i);
                priceElement.textContent = columnTotals[i];

                sum = 0;
            }

            var grandTotalElement = document.getElementById("grandTotalPrice");
            grandTotalElement.textContent = grandTotalPrices.reduce((a, b) => a + b, 0);

        }




    });
</script>


@endsection
