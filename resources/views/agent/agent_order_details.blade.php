@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">




            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Order Details</h4>

                        <p class="card-description">
                            <code>List of ordered Products</code>
                        </p>
                               @foreach ($orderedProducts as $item)

                     <div id="myDiv " class="bg-danger text-bg text-light px-2" style="<?php echo $item->price_update == 1 ? 'display: block;' : 'display: none;'; ?>">
  There is price update
</div>
@endforeach
                        <div class="table-responsive pt-3">
                            {{-- <table id="datatable" class="table"> --}}
                            <table id="recent-purchases-listing" class="table">

                                <thead>
                                    <tr>
                                        <!-- Set columns width -->
                                        <th class="text-center py-3 px-4">Product Name &amp; Details</th>
                                        <th class="text-right py-3 px-4">Unit Price</th>
                                        <th class="text-center py-3 px-4">Ordered Quantity</th>
                                        <th class="text-center py-3 px-4">Status</th>

                                        <th class="text-center py-3 px-4">Deviation</th>

                                        <th class="text-right py-3 px-4">Sub-Total </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderedProducts as $item)
                                        <tr>
                                            <td class="p-4">
                                                {{-- {{$item}} --}}
                                                <div class="media align-items-center">
                                                    <img src="{{ asset('/assets/product_img/'.$item->image) }}" class="d-block ui-w-40 ui-bordered mr-4"
                                                        alt="">
                                                    <div class="media-body uppercase">
                                                        {{ $item->name }}<br>


                                                        <span class="text-muted"><strong> Description:</strong> </span>
                                                        {{ $item->description }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-right font-weight-semibold align-middle p-4">{{ $item->price }}
                                                br</td>
                                            <td class="align-middle p-4"><input type="number"
                                                    class="form-control text-center" value="{{ $item->ordered_quantity }}"
                                                    readonly></td>

                                            <td class="text-right font-weight-semibold align-middle p-4">
                                                {{ $item->status }} </td>

                                            @if ($item->kd_adjusted_quantity == 0)
                                                <td class="text-right font-weight-semibold align-middle p-4">0</td>
                                            @elseif ($item->kd_adjusted_quantity !== 0)
                                                <td class="text-right font-weight-semibold align-middle p-4">
                                                    {{ $item->ordered_quantity - $item->kd_adjusted_quantity }} Piece</td>
                                            @endif

                                            @if ($item->kd_adjusted_quantity == 0)
                                            <td class="text-right font-weight-semibold align-middle p-4">
                                                {{ $item->subTotal }} br</td>
                                             @elseif ($item->kd_adjusted_quantity !== 0)
                                                <td class="text-right font-weight-semibold align-middle p-4">
                                                {{ $item->kd_adjusted_quantity*$item->price}} br</td>
                                            @endif

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
                            <div class="mt-4 btn-group">
                                  @if ($item->confirmStatus == "confirmed_with_deviation" )
                                  {{-- {{$item}} --}}

                                <form action="/agent/confirmOrder/accept" method="POST" >
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" value="{{ $item->subTotal - $item->kd_adjusted_quantity*$item->price}}" name="new_sub_total">

                                    <input type="hidden" value="{{ $item->price }}" name="price">
                                    <input type="hidden" value="{{ $item->id }}" name="id">

                                    <input type="hidden" value="{{ $item->subTotal }}" name="subTotal">

                                    <input type="hidden" value="{{ $item->kd_adjusted_quantity }}" name="kd_adjusted_quantity">


                                    <input type="hidden" value="{{ $item->order_id }}" name="order_id">
                                    {{-- <input type="hidden" value="confirmed" name="confirm"> --}}
                                    <button type="submit" class="btn btn-outline-success mx-2"
                                        id="">Accept</button>

                                </form>
                                <form action="/agent/confirmOrder/decline" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" value="{{ $item->order_id }}" name="order_id">
                                    {{-- <input type="hidden" value="confirmed" name="confirm"> --}}
                                    <button type="submit" class="btn btn-outline-success mx-2"
                                        id="">Decline</button>

                                </form>
                                @endif
                                {{-- <button type="submit" class="btn btn-outline-danger mx-2" id="">Decline</button> --}}
                            </div>
                            <div class="d-flex">
                                <div class="text-right mt-4">
                                    {{-- <div class="text-large"><strong>Total Price: {{ $item->totalPrice }} br</strong></div> --}}
                                </div>
                            </div>
                        </div>


                        {{-- @endforeach --}}

                        {{-- <div class="float-right">
                            @if ($item->confirmStatus == 'unconfirmed' && Auth::user()->userType == 'key distributor')
                                <form action="/confirmOrder/update/edit" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" value="{{ $item->order_id }}" name="order_id">
                                    <input type="hidden" value="confirmed" name="confirm">
                                    <button type="submit" class="btn btn-outline-primary mt-4 ">Confirm Order</button>
                                </form>
                            @elseif(
                                $item->confirmStatus == 'confirmed' &&
                                    Auth::user()->userType == 'key distributor' &&
                                    $item->handoverStatus == 'unconfirmed')
                                <form action="/kd/handover" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $item->order_id }}" name="order_id">
                                    <input type="hidden" value="confirmed" name="confirm">
                                    <button type="submit" class="btn btn-outline-primary mt-4 mb-4">Handover</button>
                                </form>
                            @else
                            @endif
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
@endsection


