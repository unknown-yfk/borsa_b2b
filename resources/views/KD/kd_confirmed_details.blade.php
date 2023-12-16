@extends('layouts.mainlayout')
@section('content')

  <div class="main-panel">
        <div class="content-wrapper">




 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Order History</h4>

                  <p class="card-description">
                  <code>List of confirmed ordered products</code>
                  </p>
                  <div class="table-responsive pt-3">
                                {{-- <table id="datatable" class="table"> --}}
                                       <table id="recent-purchases-listing" class="table">

                                    <thead>
                                <tr>
                                    <!-- Set columns width -->
                                    <th class="text-center py-3 px-4">Product Name &amp; Details</th>
                                    <th class="text-right py-3 px-4">Unit Price</th>
                                    <th class="text-center py-3 px-4">Ordered Quantity</th>
                                    <th class="text-right py-3 px-4">Sub-Total </th>
                                </tr>
                            </thead>
                        <tbody>
                               @php
                                        $totalSum = 0;
                                    @endphp
                        @foreach ($orderedProducts as $item)
                            <tr>
                                <td class="p-4">
                                    <div class="media align-items-center">
                                        <img src="{{ asset('/assets/product_img/'.$item->image) }}" class="d-block ui-w-40 ui-bordered mr-4" alt="">
                                        <div class="media-body uppercase">
                                            {{$item->name}}<br>
                            <span class="text-muted"><strong> Description:</strong> </span> {{$item->description}}
                        </div>
                      </div>
                    </td>
                    <td class="text-right font-weight-semibold align-middle p-4">{{$item->price}} br</td>
                               @if ($item->kd_adjusted_quantity == 0)
                                            <td class="align-middle p-4"><input type="number"
                                                    class="form-control text-center" value="{{ $item->ordered_quantity }}"
                                                    readonly></td>
                                                       {{-- $totalSum += $p->ordered_quantity * $p->price; --}}
                                            @elseif ($item->kd_adjusted_quantity !== 0)
                                            <td class="align-middle p-4"><input type="number"
                                                    class="form-control text-center" value="{{ $item->kd_adjusted_quantity}}"
                                                    readonly></td>
                                                    @endif

                                            @if ($item->kd_adjusted_quantity == 0)
                                                <td class="text-right font-weight-semibold align-middle p-4">
                                                    {{ $item->subTotal }} br</td>
                                                             @php
                                                    // $totalSum += $p->ordered_quantity * $p->price;
                                                    $totalSum += $item->ordered_quantity * $item->price;

                                                @endphp
                                            @elseif ($item->kd_adjusted_quantity !== 0)
                                                <td class="text-right font-weight-semibold align-middle p-4">
                                                    {{  $item->kd_adjusted_quantity * $item->price }} br</td>
                                                       @php
                                                    // $totalSum += $p->delivered_quantity * $p->price;
                                                    $totalSum += $item->kd_adjusted_quantity * $item->price;

                                                    // $totalSum += $p->kd_adjusted_quantity * $p->price;
                                                @endphp
                                            @endif
                </tr>
                 @endforeach
                </tbody>
              </table>
            </div>
            <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
              <div class="mt-4"> </div>
              <div class="d-flex">
                <div class="text-right mt-4">
                  <div class="text-large"><strong>Total Price: {{$totalSum}} br</strong></div>
                </div>
              </div>
            </div>
            <div class="float-right">
@if($item->confirmStatus=='confirmed'&&Auth::user()->userType=='key distributor'&& $item->handoverStatus =='unconfirmed')
             <form action="/deliveryCartList" method="GET">
              @csrf
            <input type="hidden" value="{{$item->order_id}}" name="order_id">
            <input type="hidden" value="confirmed" name="confirm">
              <button type="submit" class="btn btn-outline-primary mt-4 mb-4">Handover</button>
                </form>
@endif

            </div>
        </div>
    </div>
</div>
         </div>
              </div>
            </div>
        </div>
  </div>
@endsection
