  @extends('layouts.mainlayout')
@section('content')
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">


<div class="main-panel">
        <div class="container px-6 py-3 mx-auto">
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-end w-full">
                        <button class="mx-4 text-gray-600 focus:outline-none sm:mx-0">
                        </button>
                    </div>
                </div>
                <nav class="p-6 mt-4 text-white sm:flex sm:justify-center sm:items-center" style="background-color: #123C69; color:white">
                    <div class="flex flex-col sm:flex-row">
                         <a class="mt-3 mr-3" href="javascript:javascript:history.go(-1)"  style="color: white"><strong>Shop</strong></a>
                          <a class="mt-3 mr-3" href="javascript:javascript:history.go(-1)"  style="color: white"><strong>Catagories</strong></a>
                        <a href="{{ route('cart.list') }}" class="flex items-center mt-3 mr-3" style="color: white" >
                            <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            {{ Cart::getTotalQuantity()}}
                        </a>

                    </div>
                </nav>
            </div>

   <div class="content-wrapper">




  <div class="row mt-5">
                            <h1>Cart List </h1>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-bordered m-0">
                                <thead>
                                  <tr>
                                    <!-- Set columns width -->
                                    <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp; Details</th>
                                    <th class="text-right py-3 px-4" style="width: 100px;">Unit Price</th>
                                    <th class="text-center py-3 px-4" style="width: 120px;">Quantity</th>
                                    <th class="text-right py-3 px-4" style="width: 100px;">Sub-Total </th>
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
                                            <span class="text-muted">Description: </span> {{$item->attributes->description}}
                                          </small>
                                        </div>
                                      </div>
                                    </td>
                                    <td class="text-right font-weight-semibold align-middle p-4">{{$item->price}} br</td>
                                    <td class="align-middle p-4"><input type="number" class="form-control text-center" value="{{$item->quantity}}" disabled></td>
                                    <td class="text-right font-weight-semibold align-middle p-4">{{$item->attributes->subtotal}} birr</td>
                                    <td class="hidden text-right md:table-cell">
                                        <form action="{{ '/orderRemove'}}" method="POST">
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
            <!-- / Shopping cart table -->
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
            @if(!sizeof($cartItems) == 0)
              <form action="/agent/fetch_client/post" method="GET">
                 {{-- @csrf --}}
                <input type="hidden" value="{{ Cart::getTotal() }}" name="total">
                    <label>Enter the client id that you are you ordering for</label> <br>
                     <div class="container">
<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
          {{-- <form action="/agent/fetch_client/post" method="POST">
            @csrf --}}
            <div class="form-group row">

              <div class="col-sm-10">
            {{-- <select class="form-control selectpicker" id="client" name="client" data-live-search="true" required>
                <option data-tokens="" value=""></option>
                @foreach ( $clients as $client)
                    <option data-tokens="{{ $client->firstName }} {{ $client->middleName }} {{ $client->lastName }}" value="{{ $client->user_id}}|{{$client->distro_id}}" > {{ $client->firstName }} {{ $client->middleName }} {{ $client->lastName }}</option>
                @endforeach
                </select> --}}

                <input type="text" name="client_unique_id" id="client_unique_id" class="form-control">
                <br>


                @foreach ($hierarchy as $hierarchy)
             <input type="hidden" value="{{ $hierarchy->id }}" name="hierarchy_id">
                @endforeach

                  <div class="form-group row">
              <div class="col-sm-12">
                {{-- <div class="form-check text-align-left">
                  <label class="form-check-label" for="flexRadioDefault1"> <strong>
                    ~ The client do not accept less quantity</strong>
                  </label>
                  <input class="form-check-input" type="radio" name="consent" value="0" id="flexRadioDefault1">
                </div>

                <div class="form-check text-align-left">
                  <label class="form-check-label" for="flexRadioDefault2"><strong>
                  ~ The Client accepts any quantity</strong>
                  </label>
                  <input class="form-check-input" type="radio" name="consent" value="1" id="flexRadioDefault2">
                </div><br> --}}




                {{-- <label>PIN CODE:</label> --}}
                {{-- <input class= "form form-control" type="password" min="4" max="4"  name = "pinCode" id ="pinCode" placeholder="Client PIN" style ="background-color: rgba(7, 252, 7, 0.874)" autocomplete="off" required> --}}
                <br>
                <button type="submit" class="btn btn-success mt-2">Checkout</button>
                </form>
                @endif
                <form action="{{'/orderClear'}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger mt-2">Clear Cart </button>
              </form>
            </div>
          </div>
      </div>
   </main>

</div>
                     </div>

</div>
@endsection
{{-- <div class="loginPopup">
      <div class="formPopup" id="popupForm">
        <form action="/order/check/client" class="formContainer">
          <h2>Enter PIN CODE</h2>
          <label for="pinCode">
            <strong>Pin Code</strong>
          </label>
          <input type="text" id="email" placeholder="Client PIN-CODE" name="email" required>
          <button type="submit" class="btn">Insert</button>
          <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
      </div>
    </div>
</body>
</html> --}}
