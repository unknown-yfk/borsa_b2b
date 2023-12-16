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
                        @if(Auth::user()->userType == 'key distributor')
                            <a class="mt-3 hover:underline sm:mx-3 sm:mt-0" style="color: white" href="/key_distroDashboard">Home</a>
                        @elseif(Auth::user()->userType == 'ROM')
                            <a class="mt-3 hover:underline sm:mx-3 sm:mt-0" style="color: white" href="/romDashboard">Home</a>
                        @endif
                        <a class="mt-3 mr-3" href="javascript:javascript:history.go(-1)"  style="color: white">Delivery</a>
                        @if(Auth::user()->userType == 'key distributor')

                        <a href="{{ route('deliveryCart.list') }}" class="flex items-center" style="color: white" >
                            <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            {{ Cart::getTotalQuantity()}}
                        </a>
                         @elseif(Auth::user()->userType == 'ROM')
                          <a href="{{ route('delivery2Cart.list') }}" class="flex items-center" style="color: white" >
                            <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            {{ Cart::getTotalQuantity()}}
                        </a>
                        @endif


                    </div>
                </nav>
            </div>
        <div class="content-wrapper">




            {{-- <div class="container-fluid d-flex justify-content-center"> --}}


  <div class="row mt-5">
     <h4 class="card-title">Delivery List</h4>
                                        {{-- @foreach ($orderedProducts as $product)
                                            <div class="w-full max-w-sm mx-auto overflow-hidden rounded-md shadow-md">
                                             <img src="{{url('/assets/borsa.png')}}" alt="Product Image" class="w-full max-h-60">
                                             <div class="flex items-end justify-end w-full bg-cover">
                                             </div>
                                             <div class="px-5 py-3">
                                                 <h3 class="uppercase">Name : {{ $product->name }}</h3>
                                                 <span class="mt-2 text-gray-500"> Price : {{ $product->price }} birr</span><br>
                                                 <span class="mt-2 text-gray-500"> Description : {{ $product->description }} </span>
                                                 <br>
                                                 <span class="mt-2 text-gray-500"> Ordered Quantity : {{ $product->ordered_quantity }} </span>

                                                <form action="{{ ('/deliveryCartCreate') }}" method="POST" enctype="multipart/form-data">
                                                     @csrf
                                                     <input type="hidden" value="{{ $product->id }}" name="id">
                                                     <input type="hidden" value="{{ $product->name }}" name="name">
                                                     <input type="hidden" value="{{ $product->price }}" name="price">
                                                     <input type="hidden" value="{{ $product->description }}" name="description">
                                                     <input type="hidden" value="{{ $product->image }}"  name="image">
                                                     <input type="hidden" value="{{ $product->ordered_quantity }}"  name="ordered_quantity">
                                                     <input type="hidden" value="{{ $product->order_id }}"  name="order_id"><br>
                                                     <label class="mt-2">Quantity : </label>
                                                     <input  type="number" min="0" max="{{ $product->ordered_quantity }}"value="" class="form form-control" name="quantity" placeholder="Qty" required>
                                                     <br>
                                                     <br>
                                                     <button class="px-4 py-2 btn btn-outline-primary rounded">Add to Delivery Cart</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach --}}
@foreach ($orderedProducts as $product)

    <div class="col-sm-4 mb-3">
    <div class="card">
    <img src="{{ asset('/assets/product_img/'.$product->image) }}" class="card-img-top" width="100%">
    <div class="card-body pt-0 px-0">
      <div class="d-flex flex-row justify-content-between mb-0 px-3">
        <small class="text-muted mt-1">{{ $product->packsize}}</small>
        <h6>{{ $product->price }} Birr</h6>
      </div>
      <hr class="mt-2 mx-3">
      <div class="d-flex flex-column px-2"><span class="text-muted"><strong>{{ $product->name }}</strong></span></div><br>

      <div class="d-flex flex-row justify-content-between px-3 pb-4">

        <div class="d-flex flex-column"><span class="text-muted">{{ $product->description }}</span></div><br>

      </div>
      <div class="d-flex flex-row justify-content-between p-3 pb-1 mid">
        {{-- <div class="d-flex flex-column"><small class="text-muted mb-1">Quantity</small><div class="d-flex flex-row"><small class="ghj">1.4L MultiAir</small><small class="ghj">16V I-4 Turbo</small></div></div></div> --}}
        <div class="d-flex flex-column"><small class="text-muted mb-2">Ordered quantity :  {{ $product->ordered_quantity }} </small></div>
      </div>
      {{-- <small class="text-muted key pl-3">Standard key Features</small> --}}
            <form action="{{ ('/deliveryCartCreate') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                                     <input type="hidden" value="{{ $product->id }}" name="id">
                                                     <input type="hidden" value="{{ $product->name }}" name="name">
                                                     <input type="hidden" value="{{ $product->price }}" name="price">
                                                     <input type="hidden" value="{{ $product->description }}" name="description">
                                                     <input type="hidden" value="{{ $product->image }}"  name="image">
                                                     <input type="hidden" value="{{ $product->ordered_quantity }}"  name="ordered_quantity">
                                                     <input type="hidden" value="{{ $product->order_id }}"  name="order_id"><br>
                                   <label class="mt-2 ml-4 text-gray-500"><strong>Quantity:</strong></label>
                                   {{-- <input  type="number" name="quantity" id ="quantity" min="1" max="{{ $product->Qty}}" class="form form-control @error('quantity') is-invalid @enderror" placeholder="Qty" required> --}}
                                       <div class="def-number-input number-input safari_only ml-4">
                        <button type="button" data-type="minus"
                          class="minus"></button>
                        <input class="quantity fw-bold text-black" id="quantity" min="0" max="{{ $product->ordered_quantity }}" name="quantity" value="1"
                          type="number">
                        <button type="button" data-type="plus"
                          class="plus"></button>
                      </div>
                                    @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                   <br><br>
                                    <button class="px-4 py-2 ml-6 text-white bg-blue-800 rounded">Add To Delivery Cart</button>
                                </form>



    </div>
  </div>

    </div>
  @endforeach

                                 </div>
</div>







        </div>
    </div>



@endsection




