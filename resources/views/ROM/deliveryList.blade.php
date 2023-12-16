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

                        @foreach ($deliveredProducts as $product)
                         <div class="col-sm-4 mb-3">
    <div class="card">
    <img src="{{ asset('/assets/product_img/'.$product->image) }}" class="card-img-top" width="100%">
                            <div class="flex items-end justify-end w-full bg-cover">
                            </div>
                            <div class="px-5 py-3">
                                <h3 class="text-gray-700 uppercase">{{ $product->name }}</h3>
                                <span class="mt-2 text-gray-500"> Price : {{ $product->price }} birr</span><br>
                                <span class="mt-2 text-gray-500"> Description : {{ $product->description }} </span><br>
                                <span class="mt-2 text-gray-500"> Recieved Quantity : {{ $product->delivered_quantity }} </span>
                                <form action="{{ ('/delivery2CartCreate') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $product->id }}" name="id">
                                    <input type="hidden" value="{{ $product->name }}" name="name">
                                    <input type="hidden" value="{{ $product->price }}" name="price">
                                    <input type="hidden" value="{{ $product->description }}" name="description">
                                    <input type="hidden" value="{{ $product->image }}"  name="image">
                                    <input type="hidden" value="{{ $product->delivered_quantity }}"  name="delivered_quantity">
                                    <input type="hidden" value="{{ $product->order_id }}"  name="order_id">
                                    <input type="hidden" value="{{ $product->delivery1_id }}"  name="delivery1_id">
                                   <label class="mt-2 text-gray-500">Delivery Quantity : </label>
                                   <input  type="number" value=""min="0" max="{{ $product->delivered_quantity }}"class="form form-control" name="quantity" placeholder="Qty" required><br><br>
                                    <button class="px-4 py-2 text-white bg-blue-800 rounded">Add to Delivery Cart</button>
                                </form>

                            </div>
                        </div>
                        @endforeach

                                 </div>
                                </div>
                             </div>
                             </div>



@endsection




