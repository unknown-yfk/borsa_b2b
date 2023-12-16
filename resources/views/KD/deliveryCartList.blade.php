
@extends('layouts.mainlayout')
@section('content')

  <div class="main-panel">
        <div class="content-wrapper">




 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Delivery list</h4>

                  <p class="card-description">
                  <code>List of products to be delivered</code>
                  </p>
                  <input id="myInput" type="text" placeholder="Search orders here..">
                  <div class="table-responsive pt-3">
                                {{-- <table id="datatable" class="table"> --}}
                                       <table id="recent-purchases-listing" class="table">
                                    <thead>

                              <tr>
                                <!-- Set columns width -->
                                <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp; Details</th>
                                <th class="text-right py-3 px-4" style="width: 100px;">Unit Price</th>
                                <th class="text-center py-3 px-4" style="width: 120px;">Ordered Quantity</th>
                                {{-- <th class="text-right py-3 px-4" style="width: 100px;"> Delivery Quantity</th> --}}
                                <th class="text-right py-3 px-4" style="width: 100px;"> Delivered Sub-total</th>
                                <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#" class="shop-tooltip float-none text-light" title="" data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
                              </tr>
                            </thead>
                            <tbody>
                                 @php
                                        $totalSum = 0;
                                    @endphp
                                @foreach ($orderedProducts as $item)
                                  <tr>
                                    {{-- {{$item}} --}}
                                    <td class="p-4">
                                      <div class="media align-items-center">
                                        <img src="{{ asset('/assets/product_img/'.$item->image) }}" class="d-block ui-w-40 ui-bordered mr-4" alt="">
                                        <div class="media-body">
                                          <div class="d-block text-dark">{{$item->name}}</div>
                                          <small>
                                            <span class="text-muted">Description: </span> {{$item->description}}
                                          </small>
                                        </div>
                                      </div>
                                    </td>
                                    {{-- @if($item->quantity > $item->attributes->ordered_quantity)
                                        <span class="text-danger"> Delivery Quantity is greater than Orderd Quantity</span>
                                    @endif
                                     @if($item->quantity < $item->attributes->ordered_quantity)
                                        {{$quantity_left= $item->attributes->ordered_quantity-$item->quantity}}

                                    @endif --}}
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
                    <!------------ / Shopping cart table --------------------->
            <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
              <div class="mt-4"></div>
              <div class="d-flex">
                <div class="text-right mt-4">
                  <div class="text-large"><strong>Total Price: {{$totalSum}}</strong></div>
                </div>
              </div>
            </div>
            <div class="float-right ">
            <br>
            {{-- <form action="{{ ('/handover1/post/create') }}" method="POST"> --}}
            <form action="{{ ('/handover1/post/nextpage') }}" method="POST">

             @csrf
{{-- {{$item->order_id}} --}}
                  <label><strong>Select Handover Hierarchy :</strong></label><br/>
                    <input type="hidden" value="{{ $item->order_id}}" name="order_id">
             {{-- {{ $item->order_id}} --}}
             <select id="hierarchy" name="hierarchy" class="form-control " required>
                <option value=""></option>
                @foreach ( $hierarchy as $hierarchy)
                <option value="{{ $hierarchy->id }}" > <strong>{{ $hierarchy->name }} </strong></option>
                @endforeach


                </select><br/>
                 <input type="hidden" value="{{ Cart::getTotal() }}" name="total">
                @foreach ($orderedProducts as $item)

                @endforeach

                 @foreach ($orders as $order)
             <input type="hidden" value="{{ $order->OrderedBy}}" name="OrderedBy">
                @endforeach

             {{-- <label>Select ROM:</label>
             <select id="rom" name="rom" class="form-control" required>
                <option value=""></option>
                @foreach ( $rom as $rom)
                <option value="{{ $rom->user_id }}" > {{ $rom->firstName }} {{ $rom->middleName }} {{ $rom->lastName }}</option>
                @endforeach
                </select> --}}
                 @if(!isset($item))
                    <?php header("location:javascript://history.go(-1)"); ?>
                @endif
                 @if(isset($item))
                   <button type="submit" class="btn btn-outline-success mt-2">Proceed</button>
                @endif
                 </form>

                   {{-- <a href="/key_distroProfile/show" class="btn btn-outline-success mt-2">Proceed</a> --}}



            </div>
          </div>
      </div>
  </div>
        </div></div>
        @endsection
