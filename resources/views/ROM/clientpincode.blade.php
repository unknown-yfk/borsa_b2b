
@extends('layouts.mainlayout')
@section('content')

  <div class="main-panel">
        <div class="content-wrapper">




 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Delivery List History</h4>

                  <p class="card-description">
                  <code>Delivery List</code>
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
                                    <th class="text-center py-3 px-4" style="width: 120px;">Recieved Quantity</th>
                                    <th class="text-right py-3 px-4" style="width: 100px;"> Delivery Quantity</th>
                                    <th class="text-right py-3 px-4" style="width: 100px;"> Delivered sub-total</th>
                                    <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#" class="shop-tooltip float-none text-light" title="" data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach ($cartItems as $item)
                                  <tr>
                                    <td class="p-4">
                                      <div class="media align-items-center">
                                        <img src="" class="d-block ui-w-40 ui-bordered mr-4" alt="">
                                        <div class="media-body">
                                          <a href="#" class="d-block text-dark">{{$item->name}}</a>
                                          <small>
                                            <span class="text-muted"><strong> Description:</strong> </span> {{$item->attributes->description}}
                                          </small>
                                        </div>
                                      </div>
                                    </td>
                                    @if ($item->quantity > $item->attributes->recieved_quantity)
                                        <span class="text-danger"> Delivery Quantity is greater than Recived Quantity</span>
                                    @endif
                                    <td class="text-right font-weight-semibold align-middle p-4">{{$item->price}} br</td>
                                    <td class="text-right font-weight-semibold align-middle p-4">{{$item->attributes->recieved_quantity}} </td>
                                    <td class="align-middle p-4"><input type="number" class="form-control text-center" value="{{$item->quantity}}" readonly></td>
                                    <td class="text-right font-weight-semibold align-middle p-4">{{$item->attributes->subtotal}} birr</td>
                                    <td class="hidden text-right md:table-cell">
                                <form action="{{ route('delivery2Cart.remove') }}" method="POST">
                                  @csrf
                                  <input type="hidden" value="{{ $item->id }}" name="id">
                                  <button class="btn btn-outline-warning"><i class="mdi mdi-delete"></i></button>
                                </form>
                            </td>
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
                  <div class="text-large"><strong>Total Price: {{ Cart::getTotal() }} br</strong></div>
                </div>
              </div>
            </div>
            <div class="float-right">
            <br>
            {{-- <form action="{{ ('/handover1/post/create') }}" method="POST"> --}}
            <form action="{{ ('/rom/client_pincode_verification/post') }}" method="POST">

             @csrf



             {{-- <input type="hidden" value="{{$orderedBy[0]->orderedBy}}" name="orderedBy"> --}}



                 <input type="hidden" value="{{ Cart::getTotal() }}" name="total">
                @foreach ($cartItems as $item)
             <input type="hidden" value="{{ $item->attributes->order_id}}" name="order_id">
             @endforeach






            <label><strong>Please enter your Pin Code here</strong></label>
                <input class= "form form-control" type="password" min="4" max="4"  name = "pinCode" id ="pinCode" placeholder="Client PIN" style ="background-color: rgba(7, 252, 7, 0.874)" autocomplete="off" required>
                <br>


                 {{-- @if(!isset($item))

                @endif --}}
                {{-- <label>{{ $item }}</label> --}}
                 @if(isset($item))
                   <button <?php if ($item->quantity > $item->attributes->recieved_quantity){?> disabled <?php  }?> type="submit" class="btn btn-outline-success mt-2">Handover</button>
                @endif
                 </form>

                   {{-- <a href="/key_distroProfile/show" class="btn btn-outline-success mt-2">Proceed</a> --}}



            </div>
          </div>
      </div>
  </div>
</main>
</div>
  </div>

</div>
    @endsection

