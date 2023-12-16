
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




 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> Cart List</h4>

                  <p class="card-description">
                  <code>Cart</code>
                  </p>
                  <input id="myInput" type="text" placeholder="Search orders here..">
                  <div class="table-responsive pt-3">
                                {{-- <table id="datatable" class="table"> --}}
                                       <table id="recent-purchases-listing" class="table">
                                    <thead>
                                  <tr>
                                    <!-- Set columns width -->
                                    <th class="text-center py-3 px-4" style="min-width: 400px;"> {{__('messages.ProductName')}} &amp; {{__('messages.Details')}}</th>
                                    <th class="text-right py-3 px-4" style="width: 100px;"> {{__('messages.UnitPrice')}}</th>
                                    <th class="text-center py-3 px-4" style="width: 120px;"> {{__('messages.Quantity')}}</th>
                                    <th class="text-right py-3 px-4" style="width: 100px;"> {{__('messages.SubTotal')}} </th>
                                    <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#" class="shop-tooltip float-none text-light" title="" data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach ($cartItems as $item)
                                  <tr>
                                    <td class="p-4">
                                      <div class="media align-items-center">
                                       <img src="{{ asset('/assets/product_img/'.$item->attributes->image) }}" class="d-block ui-w-40 ui-bordered mr-4"
                                        alt="">
                                        <div class="media-body">
                                          <a href="#" class="d-block text-dark">{{$item->name}}</a>
                                          <small>
                                            <span class="text-muted"> {{__('messages.Description')}}: </span> {{$item->attributes->description}}
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
                  <div class="text-large"><strong> {{__('messages.TotalPrice')}}: {{ Cart::getTotal() }} br</strong></div>
                </div>
              </div>
            </div>
            <div class="float-right">
            <br>
            @if(!sizeof($cartItems) == 0)
              <form action="/order/post/create" method="POST">
                 @csrf
                <input type="hidden" value="{{ Cart::getTotal() }}" name="total">
                <input type="hidden" value="{{ $clients[0]->user_id }}" name="clients_user_id">


                    <label>  {{__('messages.You_are_ordering_for')}} : <strong> {{ $clients[0]->firstName }} {{ $clients[0]->middleName }} {{ $clients[0]->lastName }}</strong></label> <br>
                     <div class="container">
<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
          <form action="/order/post/create" method="POST">
             @csrf
            <div class="form-group row">

              <div class="col-sm-10">
            {{-- <select class="form-control selectpicker" id="client" name="client" data-live-search="true" required>
                <option data-tokens="" value=""></option>
                @foreach ( $clients as $client)
                    <option data-tokens="{{ $client->firstName }} {{ $client->middleName }} {{ $client->lastName }}" value="{{ $client->user_id}}|{{$client->distro_id}}" > {{ $client->firstName }} {{ $client->middleName }} {{ $client->lastName }}</option>
                @endforeach
                </select> --}}

                {{-- <input type="text" name="client_unique_id" id="client_unique_id" class="form-control"> --}}
                <br>


                @foreach ($hierarchy as $hierarchy)
             <input type="hidden" value="{{ $hierarchy->id }}" name="hierarchy_id">
                @endforeach

                  <div class="form-group row">
              <div class="col-sm-12">
                <div class="form-check text-align-left">

                      <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="consent" id="optionsRadios1" value="1">
                              {{__('messages.client_will_accept_less_quantity')}}
                            </label>
                          </div>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="consent" id="optionsRadios2" value="0" checked>
                              {{__('messages.client_will_not_accept_less_quantity')}}
                            </label>
                          </div>



                </div><br>




                <label> {{__('messages.PinCode')}}:</label>
                <input class= "form form-control" type="password" min="4" max="4"  name = "pinCode" id ="pinCode" placeholder="Client PIN" style ="background-color: rgba(7, 252, 7, 0.874)" autocomplete="off" required>
                <br>
                <button type="submit" class="btn btn-success mt-2"> {{__('messages.CheckOut')}}</button>
                </form>
                @endif
                <form action="{{'/orderClear'}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger mt-2"> {{__('messages.Clear')}}</button>
              </form>


                   {{-- <a href="/key_distroProfile/show" class="btn btn-outline-success mt-2">Proceed</a> --}}



            </div>
          </div>
      </div>
  </div>
        </div></div>
        @endsection
