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

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<!-- Add this in the head section of your HTML -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">BORSA ORDER CAPTURE SUMMARY REPORT</h4>
                    <p class="card-description">
                        <code>Report</code>
                    </p>

                    <div class="table-responsive pt-3">
                        <form action="{{ route('hodeliveryReport') }}" method="GET" class="filter-form" id="filterForm">
                            <div class="region-select">

                                <button type="button" id="showDropdownBtn" class="bg-white drop-button ">Sellect by Regions</button>
                                <select name="region_filter[]" id="region_filter" class="form-control" multiple style="display: none;">
                                    @if (!empty($uniqueRegions))

                                    @foreach ($uniqueRegions as $region)
                                    @if (!empty($region))
                                    <option class="select-option" value="{{ $region }}">{{ $region }}</option>
                                    @endif
                                    @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="region-select">
                                <button type="button" id="showCityDropdownBtn" class="bg-white drop-button">Select by Cities</button>
                                <select name="city_filter[]" id="city_filter" class="form-control" multiple style="display: none;">
                                    @foreach ($uniqueCities as $city)
                                    @if (!empty($city))
                                    <option class="select-option" value="{{ $city }}">{{ $city }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>



                            <div>
                                <span>From:</span>
                                <input type="date" name="from_date" id="from_date" style="width: 160px;" class="form-control">
                            </div>
                            <div class="">
                                <label for="to_date">To:</label>
                                <input type="date" name="to_date" id="to_date" style="width: 160px;" class="form-control">
                            </div>


                            <button type="submit" class="btn btn-primary">Filter</button>
                        </form>
                        <table id="table" class="display nowrap" style="width:100%">
                            <thead>

                                <tr>
                                    <th>Order Date</th>
                                    <th>Agent Name</th>
                                    <th>Region</th>
                                    <th>City</th>
                                    @if (!empty($product) && $product->count())
                                    @foreach ($product as $order)
                                    <th>{{ $order->name }}</th>
                                    @endforeach
                                    @else
                                    <th colspan="10">There are no data.</th>
                                    @endif
                                </tr>

                            </thead>
                            <tbody>

                                @if (!empty($LastMileReport) && $LastMileReport->count())
                                @for ($i = 0; $i < sizeof($LastMileReport); $i++) <tr>
                                    <td>{{ $LastMileReport[$i]->created_at }}</td>
                                    <td>{{ $LastMileReport[$i]->firstName }}
                                        {{ $LastMileReport[$i]->middleName }}
                                        {{ $LastMileReport[$i]->lastName }}
                                    </td>
                                    <td>{{ $LastMileReport[$i]->Region }}</td>
                                    <td>{{ $LastMileReport[$i]->City }}</td>
                                    @for ($j = 0; $j < sizeof($product); $j++) {{-- @php
                   echo  sizeof($product);
                 @endphp --}} @if ($product[$j]->id == $LastMileReport[$i]->id)
                                        @if ($LastMileReport[$i]->amount_status == 'full')
                                        <td>{{ $LastMileReport[$i]->delivered_quantity }}</td>
                                        @else
                                        <td>{{ $LastMileReport[$i]->partial_quantity }}</td>
                                        @endif
                                        @else
                                        <td>0</td>
                                        @endif
                                        @endfor
                                        @endfor
                                        </tr>
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
    function submitFilterForm() {
        document.getElementById('filterForm').submit();
    }

    $(document).ready(function() {
        var table = $('#table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            scrollX: true,
            fixedColumns: true
        });
        $('#region_filter').select2();
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
    });
</script>
<script>
    $(document).ready(function() {
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
    });
</script>


@endsection