
@extends('layouts.mainlayout')
@section('content')

  <div class="main-panel">
        <div class="content-wrapper">




 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Delivery list</h4>

                  <p class="card-description">
                  <code>Delivery list</code>
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
                                {{-- @foreach ($cartItems as $item) --}}
                                  <tr>
                                    <td class="p-4">
                                      <div class="media align-items-center">
                                        <img src="" class="d-block ui-w-40 ui-bordered mr-4" alt="">
                                        <div class="media-body">
                                          <a href="#" class="d-block text-dark"></a>
                                          <small>
                                            <span class="text-muted"><strong> Description:</strong> </span>
                                          </small>
                                        </div>
                                      </div>
                                    </td>
                                    {{-- @if ($item->quantity > $item->attributes->recieved_quantity)
                                        <span class="text-danger"> Delivery Quantity is greater than Recived Quantity</span>
                                    @endif --}}
                                    <td class="text-right font-weight-semibold align-middle p-4"></td>
                                    <td class="text-right font-weight-semibold align-middle p-4"></td>
                                    <td class="align-middle p-4"><input type="number" class="form-control text-center" value="{" readonly></td>
                                    <td class="text-right font-weight-semibold align-middle p-4"> </td>
                                    <td class="hidden text-right md:table-cell">
                                {{-- <form action="{{ route('delivery2Cart.remove') }}" method="POST">
                                  @csrf
                                  <input type="hidden" value="{{ $item->id }}" name="id">
                                  <button class="btn btn-outline-warning"><i class="mdi mdi-delete"></i></button>
                                </form> --}}
                            </td>
                        </tr>
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
            <!-- / Shopping cart table -->
            <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
              <div class="mt-4"></div>
              <div class="d-flex">
                <div class="text-right mt-4">
                  {{-- <div class="text-large"><strong>Total Price: {{ Cart::getTotal() }} br</strong></div> --}}
                </div>
              </div>
            </div>
            <div class="float-right">
            {{-- <br>
               <form action="{{ ('/handover2/post/create') }}" method="POST">
                @csrf
                <input type="hidden" value="{{ Cart::getTotal() }}" name="total">
                @foreach ($cartItems as $item)
                <input type="hidden" value="{{ $item->attributes->order_id}}" name="order_id">
                @endforeach
                <label>Select RSP:</label>
                <select id="rsp" name="rsp"  class="form-control">
                     <option value=""></option>
                @foreach ( $rsp as $rsp)
                <option value="{{ $rsp->user_id }}" > {{ $rsp->firstName }} {{ $rsp->middleName }} {{ $rsp->lastName }}
                </option>
                @endforeach
            </select>
             @if(isset($item))
                   <button <?php if ($item->quantity > $item->attributes->recieved_quantity){?> disabled <?php  }?> type="submit" class="btn btn-outline-success mt-2">Confirm Handover</button>
                @endif
            </form> --}}
        </div>
    </div>
</div>
</div>
  </main>
</div>
  </div>

</div>
@endsection

