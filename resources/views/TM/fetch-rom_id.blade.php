
@extends('layouts.mainlayout')
@section('content')

  <div class="main-panel">
        <div class="content-wrapper">




 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">RoM Delivery</h4>

                  <p class="card-description">
                  <code>Delivery Handing Over to ROM</code>
                  </p>
                  <input id="myInput" type="text" placeholder="Search users here..">
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
                  <div class="text-large"><strong>Total Price: {{ $totalSum }} br</strong></div>
                </div>
              </div>
            </div>
            <div class="float-right">
            <br>
            {{-- <form action="{{ ('/handover1/post/create') }}" method="POST"> --}}
            <form action="{{ ('/tm/Handover_to_rom/post') }}" method="POST">

             @csrf


                 <input type="hidden" value="{{ $totalSum }}" name="total">
                @foreach ($orderedProducts as $item)
             <input type="hidden" value="{{ $item->order_id}}" name="order_id">
                @endforeach


                 @foreach ($hierarchy as $hierarchy)
             <input type="hidden" value="{{ $hierarchy->id }}" name="hierarchy_id">
                @endforeach
            <input type="hidden" value="{{ $rom[0]->user_id }}" name="rom_user_id">


                    <label> You are handing over too : <strong> {{ $rom[0]->firstName }} {{ $rom[0]->middleName }} {{ $rom[0]->lastName }}</strong></label> <br>
                 {{-- @if(!isset($item))

                @endif
                 @if(isset($item)) --}}
                   <button type="submit" class="btn btn-outline-success mt-2">Proceed</button>
                {{-- @endif --}}
                 </form>

                   {{-- <a href="/key_distroProfile/show" class="btn btn-outline-success mt-2">Proceed</a> --}}



            </div>
          </div>
      </div>
  </div>
        </div></div>

    @endsection

