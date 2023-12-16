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
                <nav class="p-6 mt-4 text-white sm:flex sm:justify-center sm:items-center" style="background-color: #00008B; color:white">
                    <div class="flex flex-col sm:flex-row">
                         <a class="mt-3 mr-3" href="javascript:javascript:history.go(-1)"  style="color: white"><strong>Shop</strong></a>
                          <a class="mt-3 mr-3" href="client/order/place"  style="color: white"><strong>Catagories</strong></a>
                        <a href="{{ route('clientcart.list') }}" class="flex items-center mt-3 mr-3" style="color: white" >
                            <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            {{ Cart::getTotalQuantity()}}
                        </a>

                    </div>
                </nav>
            </div>
        <div class="content-wrapper">




            <div class="container-fluid d-flex justify-content-center">


  <div class="row mt-5">
     <h4 class="card-title">Product List</h4>
                        @foreach ($products as $product)

                             <div class="w-full max-w-sm mx-auto overflow-hidden rounded-md shadow-md">
                                 <img src="../../assets/product_img/{{$product->image}}" alt="Product Image" class="w-full max-h-60">
                                <div class="flex items-end justify-end w-full bg-cover"></div>
                                <div class="px-5 py-3">
                                <h3 class="text-gray-700 capitalize"><strong>Name</strong> : {{ $product->name }}</h3>
                                <span class="mt-2 text-gray-500"><strong> Price</strong> : {{ $product->price }} birr</span><br>
                                <span class="mt-2 text-gray-500"><strong> Quantiy</strong> : {{ $product->Qty }} </span><br>
                                <span class="mt-2 text-gray-500"><strong> Description</strong> : {{ $product->description }} </span>
                                <form action="{{('/clientcart')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $product->id }}" name="id">
                                    <input type="hidden" value="{{ $product->name }}" name="name">
                                    <input type="hidden" value="{{ $product->price }}" name="price">
                                    <input type="hidden" value="{{ $product->description }}" name="description">
                                    <input type="hidden" value="{{ $product->image }}"  name="image">
                                   <label class="mt-2 text-gray-500"><strong>Quantity:</strong></label>
                                   <input  type="number" name="quantity" id ="quantity" min="1" max="{{ $product->Qty}}" class="form form-control @error('quantity') is-invalid @enderror" placeholder="Qty" required>
                                    @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                   <br><br>
                                    <button class="px-4 py-2 text-white bg-blue-800 rounded">Add To Cart</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <br>
                    <br>
                </div>
            <main>
            @include('layout.footer')
        </div>
    </div>
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ url('js/scripts.js') }}"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{url ('assets/demo/chart-area-demo.js')}}"></script>
    <script src="{{url ('assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="{{url ('js/datatables-simple-demo.js') }}"></script>
    <link href="{{ url('css/styles.css') }}" rel="stylesheet"/>
</body>
</html>
