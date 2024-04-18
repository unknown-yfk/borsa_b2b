@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">




            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Delivery Details</h4>

                        <p class="card-description">
                            <code>Details of deliveries</code>
                        </p>
                        {{-- <input id="myInput" type="text" placeholder="Search orders here.."> --}}
                        <div class="table-responsive pt-3">
                            {{-- <table id="datatable" class="table"> --}}
                            <form method="POST" action="{{ route('delivery2Cart.list') }}">
                                @csrf

                                {{-- <form action="/delivery2CartList" method="GET">
              @csrf --}}
                                <table id="recent-purchases-listing" class="table">

                                    <thead>
                                        <tr>
                                            <!-- Set columns width -->
                                            <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp;
                                                Details</th>
                                            <th class="text-right py-3 px-4" style="width: 100px;">Unit Price</th>
                                            <th class="text-center py-3 px-4" style="width: 120px;">Delivered Quantity</th>
                                            <th class="text-right py-3 px-4" style="width: 100px;">Sub-Total </th>
                                            <th class="text-right py-3 px-4">Delivered </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                              @php
                                        $totalSum = 0;
                                    @endphp

                                        @foreach ($deliveredProducts as $item)
                                            <tr>
                                                <td class="p-4">
                                                    <div class="media align-items-center">
                                                        <img src="{{ asset('/assets/product_img/'.$item->image) }}" class="d-block ui-w-40 ui-bordered mr-4 "
                                                            alt="">
                                                        <div class="media-body">
                                                            <div class="d-block text-dark text-uppercase">
                                                                {{ $item->name }}</div>
                                                            <small>
                                                                <span><strong>Description:</strong> </span>
                                                                {{ $item->description }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-right font-weight-semibold align-middle p-4">
                                                    {{ $item->subTotal/$item->delivered_quantity}} br
                                                </td>


                                            <td class="align-middle p-4"><input type="number"
                                                    class="form-control text-center" value="{{ $item->delivered_quantity }}"
                                                    readonly>
                                            </td>

                                            <td class="text-right font-weight-semibold align-middle p-4">
                                                    {{ $item->subTotal }} br
                                                    @php

                                                   $totalSum += $item->subTotal ;


                                                @endphp
                                            </td>

                                                <td class="text-right font-weight-semibold align-middle p-4">

                                                    {{-- @method('PUT') --}}

                                                    <input type="hidden" value="{{ $item->order_id }}" name="order_id">
                                                    {{-- <input type="hidden" value="{{ $item->id }}"
                                                        name="ordered_product_id"> --}}


                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio"
                                                                            onclick="javascript:yesnoCheck('{{ $item->product_id }}pa','{{ $item->product_id }}ifYes');"
                                                                            class="form-check-input"
                                                                            name="status_{{ $item->product_id }}"
                                                                            id="{{ $item->product_id }}fu"
                                                                            value="Full"{{ $item->status == 'full' ? 'checked' : '' }}
                                                                            required>
                                                                        Full
                                                                    </label>
                                                                </div>
                                                                {{-- <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio"
                                                                            onclick="javascript:yesnoCheck('{{ $item->id }}qa','{{ $item->id }}ifYes');"
                                                                            class="form-check-input" name="status_{{ $item->id }}"
                                                                            id="{{ $item->id }}re"
                                                                            value="Refusal"{{ $item->status == 'refusal' ? 'checked' : '' }} >
                                                                        Refusal
                                                                    </label>
                                                                </div> --}}

                                                                <div class="form-check">
                                                                    <label class="form-check-label">
                                                                        <input type="radio"
                                                                            onclick="javascript:yesnoCheck('{{ $item->product_id }}pa','{{ $item->product_id }}ifYes');"
                                                                            class="form-check-input"
                                                                            name="status_{{ $item->product_id }}"
                                                                            id="{{ $item->product_id }}pa"
                                                                            value="partial"{{ $item->status == 'partial' ? 'checked' : '' }}>
                                                                        Partial

                                                                    </label>


                                                                    <div id="{{ $item->product_id }}ifYes"
                                                                        style="visibility:hidden">
                                                                        Enter the quantity you delivered: <br><br><input
                                                                            type='number' id='yes'
                                                                            name="quantity_{{ $item->product_id }}" min="0" max="{{$item->ordered_quantity}}"><br>
                                                                    </div>
                                                                    {{-- <input type="hidden"  name="unique_id_{{ $item->product_id }}"> --}}


                                                                </div>
                                                            </div>
                                                        </div>






                                                </td>







                                            </tr>

                            @endforeach


                                    </tbody>
                                </table>
                        </div>
                        <!------------------------------------ / Shopping cart table ------------------------------------------>
                        <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
                            <div class="mt-4"></div>
                            <div class="d-flex">
                                <div class="text-right mt-4">

                                    <div class="text-large"><strong>Total Price: {{ $totalSum }} birr</strong></div>
                                </div>
                            </div>
                        </div>

                        <div class="float-right">
                            {{-- @if ($item->confirmationStatus == 'unconfirmed')
              <form action="/confirmDelivery/update/edit" method="POST">
              @csrf
              @method('PUT')
                <input type="hidden" value="{{$item->delivery1_id}}" name="delivery1s_id">
                <input type="hidden" value="confirmed" name="confirm">
              <button type="submit" class="btn btn-outline-success mt-2">Confirm Order</button>
              </form>
                @elseif($item->confirmationStatus=='confirmed'&&Auth::user()->userType=='ROM' && $item->handoverStatus=='unconfirmed') --}}

                            {{-- <input type="hidden" value="{{ $deliveredProducts->delivery1_id }}" name="delivery1_id">
                            <input type="hidden" value="{{ $deliveredProducts->order_id }}" name="order_id"> --}}
 {{-- //@if($item->name =='unconfirmed') --}}

                            <button type="submit" class="btn btn-outline-primary mt-2">Handover</button>

                            </form>
                            {{-- @endif --}}
                        </div>

                    </div>
                    {{-- @endforeach --}}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('input[type=radio]').change(function() {
                var statusValue = $(this).val();


                var delivered = $(this).attr('name').split('_')[1];

                $.ajax({
                    url: '/delivered-products/' + deliveredProductId + '/update-status',
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





        function yesnoCheck(q, y) {
            if (document.getElementById(q).checked) {
                document.getElementById(y).style.visibility = 'visible';
            } else document.getElementById(y).style.visibility = 'hidden';

        }
    </script>
@endsection
