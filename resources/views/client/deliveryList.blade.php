@include('ROM.header')
<body class="sb-nav-fixed">
    @include('nav.client_navbar')
    <div id="layoutSidenav">
        @include('Sidenavbar.clientSidebar')
            <div id="layoutSidenav_content">
            <main>
                @extends('layout.deliverHeader')
                @section('content')
                @include('sweetalert::alert')
                <div class="container px-6 mx-auto">
                    <h3 class="text-2xl font-medium text-gray-700">Delivery List</h3>
                    <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                        @foreach ($deliveredProducts as $product)
                        <div class="w-full max-w-sm mx-auto overflow-hidden rounded-md shadow-md">
                             <img src="../../assets/img/{{$product->image}}" alt="Product Image" class="w-full max-h-60">
                            <div class="flex items-end justify-end w-full bg-cover">
                            </div>
                            <div class="px-5 py-3">
                                <h3 class="text-gray-700 uppercase">Name : {{ $product->name }}</h3>
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
                                    <input type="hidden" value="{{ $product->delivery4_id }}"  name="delivery4_id">
                                   <label class="mt-2 text-gray-500">Delivery Quantity : </label>
                                   <input  type="number" value=""min="0" max="{{ $product->delivered_quantity }}"class="form form-control" name="quantity" placeholder="Qty" required><br><br>
                                    <button class="px-4 py-2 text-white bg-blue-800 rounded">Add to Delivery Cart</button>
                                </form>

                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            <main>
        </div>
        @include('layout.footer')
    </div>
    @endsection
</body>
</html>
