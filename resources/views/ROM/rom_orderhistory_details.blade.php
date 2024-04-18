@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">




            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Order History</h4>

                        <p class="card-description">
                            <code>List of orders</code>
                        </p>
                        <input type="hidden" {{ $total = 0 }} />
                        <div class="table-responsive pt-3">
                            {{-- <table id="datatable" class="table"> --}}
                            <form method="POST" action="{{ route('ordered-products.confirm') }}">
                                @csrf

                                <table id="recent-purchases-listing" class="table">

                                    <thead>
                                        <tr>
                                            <!-- Set columns width -->
                                            <th class="text-center py-3 px-4">Product Name &amp; Details</th>
                                            <th class="text-right py-3 px-4">Unit Price</th>
                                            <th class="text-center py-3 px-4">Ordered Quantity</th>
                                            <th class="text-center py-3 px-4">Adjusted Quantity</th>
                                            <th class="text-right py-3 px-4">Sub-Total </th>
                                            <th class="text-right py-3 px-4">Status </th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($orderedProducts as $item)

                                            <tr>
                                                <td class="p-4">
                                                    <div class="media align-items-center">
                                                        <img src="{{ asset('/assets/product_img/' . $item->image) }}"
                                                            class="d-block ui-w-40 ui-bordered mr-4" alt="">
                                                        <div class="media-body uppercase">
                                                            {{ $item->name }}<br>
                                                            <span class="text-muted"><strong> Description:</strong> </span>
                                                            {{ $item->description }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-right font-weight-semibold align-middle p-4">
                                                    {{ $item->price }}
                                                    br</td>
                                                <td class="align-middle p-4"><input type="number"
                                                        class="form-control text-center"
                                                        value="{{ $item->ordered_quantity }}" readonly></td>

                                                <td class="align-middle p-4"><input type="number"
                                                        class="form-control text-center"
                                                        value="{{ $item->kd_adjusted_quantity }}" readonly></td>

                                                @if ($item->price_update == '1')

                                                @if ($item->status == 'quantity_adjustment')
                                                    <input type="hidden"
                                                        {{ $total = $total + $item->kd_adjusted_quantity * $item->price  }} />
                                                    <td class="text-right font-weight-semibold align-middle p-4">
                                                        {{ $item->kd_adjusted_quantity * $item->price }}
                                                        br</td>
                                                @elseif($item->status == 'refusal')
                                                    <td class="text-right font-weight-semibold align-middle p-4">0
                                                        br</td>
                                                        <input type="hidden" {{ $total = $total+0 }} />

                                                @else
                                                    <td class="text-right font-weight-semibold align-middle p-4">
                                                        {{ $item->subTotal }} br</td>
                                                        <input type="hidden" {{ $total = $total+$item->subTotal  }} />

                                                @endif
                                                @else
                                                 @if ($item->status == 'quantity_adjustment')
                                                    <input type="hidden"
                                                        {{ $total = $total + $item->kd_adjusted_quantity * ($item->subTotal / $item->ordered_quantity) }} />
                                                    <td class="text-right font-weight-semibold align-middle p-4">
                                                        {{ $item->kd_adjusted_quantity * ($item->subTotal / $item->ordered_quantity) }}
                                                        br</td>
                                                @elseif($item->status == 'refusal')
                                                    <td class="text-right font-weight-semibold align-middle p-4">0
                                                        br</td>
                                                        <input type="hidden" {{ $total = $total+0 }} />

                                                @else
                                                    <td class="text-right font-weight-semibold align-middle p-4">
                                                        {{ $item->subTotal }} br</td>
                                                        <input type="hidden" {{ $total = $total+$item->subTotal  }} />

                                                @endif
                                                @endif

                                                <td class="text-right font-weight-semibold align-middle p-4">
                                                    {{ $item->status }}</td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{-- </div> --}}
                                <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
                                    <div class="mt-4"> </div>
                                    <div class="d-flex">
                                        <div class="text-right mt-4">


                                            <div class="text-large"><strong>Total Price: {{ $total }}
                                                    br</strong></div>

                                        </div>
                                    </div>
                                </div>


                                {{-- <div class="float-right"> --}}
                                {{-- @if ($item->confirmStatus == 'unconfirmed' && Auth::user()->userType == 'key distributor') --}}
                                {{-- <form action="/confirmOrder/update/edit" method="POST" id="confirmOrder">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{ $item->order_id }}" name="order_id">
                                <input type="hidden" value="confirmed" name="confirm">
                            </form> --}}



                                {{-- </div> --}}

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script>
            $(document).ready(function() {
                $('input[type=radio]').change(function() {
                    var statusValue = $(this).val();


                    var orderedProductId = $(this).attr('name').split('_')[1];

                    $.ajax({
                        url: '/ordered-products/' + orderedProductId + '/update-status',
                        type: 'POST',
                        data: {
                            status: statusValue,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            console.log(response);
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                });
            });





            // function text(x) {
            //     if (x == 2) document.getElementById($item - > id).style.display = "block";

            //     else document.getElementById($item - > id).style.display = "none";
            //     return;

            // }
            function yesnoCheck(q, y) {
                if (document.getElementById(q).checked) {
                    document.getElementById(y).style.visibility = 'visible';
                } else document.getElementById(y).style.visibility = 'hidden';

            }
        </script>
    @endsection
