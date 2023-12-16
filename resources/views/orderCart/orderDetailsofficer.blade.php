@extends('layouts.mainlayout')
@section('content')

  <div class="main-panel">
        <div class="content-wrapper">




 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <input type="hidden" {{$total=0}}/>
                <div class="card-body">
                  <h4 class="card-title">Order History</h4>

                  <p class="card-description">
                  <code>List of orders</code>
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
                                    <th class="text-center py-3 px-4">Status</th>
                                    <th class="text-center py-3 px-4">Rom Adjusted Quantity</th>
                                    <th class="text-center py-3 px-4">Rom Delivered Quantity After Deviation</th>
                                    <th class="text-center py-3 px-4">Reduced Quantity By Rom</th>
                                    <th class="text-right py-3 px-4">Sub-Total </th>
                                </tr>
                            </thead>
                        <tbody>
                        @foreach ($orderedProducts as $item)
                            <tr>
                                <td class="p-4">
                                    <div class="media align-items-center">
                                     <img src="{{ asset('/assets/product_img/'.$item->image) }}" class="d-block ui-w-40 ui-bordered mr-4"
                                      alt="">
                                        <div class="media-body uppercase">
                                            {{$item->name}}<br>
                            <span class="text-muted"><strong> Description:</strong> </span> {{$item->description}}
                        </div>
                      </div>
                    </td>
                    <input type="hidden" {{$price=$item->subTotal/$item->ordered_quantity}}/>
                    <td class="text-right font-weight-semibold align-middle p-4">{{$price}}</td>
                    <td class="align-middle p-4"><input type="number" class="form-control text-center" value="{{$item->ordered_quantity}}" readonly></td>
                    <td class="align-middle p-4"> {{$item->status}}</td>
                    <td class="text-right font-weight-semibold align-middle p-4">{{$item->kd_adjusted_quantity}} </td>
                    <td class="text-right font-weight-semibold align-middle p-4">{{$final_quantity=$item->delivered_quantity}}</td>
                    @if($item->amount_status=="full")
                    <td class="text-right font-weight-semibold align-middle p-4">{{$item->amount_status }}</td>
                    @elseif($item->amount_status=="partial")
                    <td class="text-right font-weight-semibold align-middle p-4">{{$final_quantity=$item->delivered_quantity - $item->partial_quantity }}</td>
                     @else
                    <td class="text-right font-weight-semibold align-middle p-4"></td>

                     @endif

                    <input type="hidden" {{$temp=$final_quantity*$price}}/>

                    <td class="text-right font-weight-semibold align-middle p-4">{{$temp}} </td>
                    @if($item->status=="acceptance")
                    <input type="hidden" {{$total=$total+$temp}}/>
                    @elseif($item->status=="quantity_adjustment")
                    <input type="hidden" {{$total=$total+$temp}}/>
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
                  <div class="text-large"><strong>Total Price: {{$total}} </strong></div>
                </div>
              </div>
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
