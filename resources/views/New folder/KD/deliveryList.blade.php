@include('layout.header')

<body class="sb-nav-fixed">
    @include('nav.kd_navbar')
    <div id="layoutSidenav">
        @include('Sidenavbar.kdSidebar')
            <div id="layoutSidenav_content">
                    <main>
                        @extends('layout.deliverHeader')
                        @section('content')
                        @include('sweetalert::alert')
                            <div class="container px-6 mx-auto">
                                <h3 class="text-2xl font-medium text-gray-700">Delivery List</h3>
                                    <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                                        @foreach ($orderedProducts as $product)
                                            <div class="w-full max-w-sm mx-auto overflow-hidden rounded-md shadow-md">
                                             <img src="../../assets/img/{{$product->image}}" alt="Product Image" class="w-full max-h-60">
                                             <div class="flex items-end justify-end w-full bg-cover">
                                             </div>
                                             <div class="px-5 py-3">
                                                 <h3 class="uppercase">Name: {{ $product->name }}</h3>
                                                 <span class="mt-2 text-gray-500"> Price: {{ $product->price }} birr</span><br>
                                                 <span class="mt-2 text-gray-500"> Description: {{ $product->description }} </span>
                                                 <br>
                                                 <span class="mt-2 text-gray-500"> Ordered Quantity: {{ $product->ordered_quantity }} </span>
                                                <form action="{{ ('/deliveryCartCreate') }}" method="POST" enctype="multipart/form-data">
                                                     @csrf
                                                     <input type="hidden" value="{{ $product->id }}" name="id">
                                                     <input type="hidden" value="{{ $product->name }}" name="name">
                                                     <input type="hidden" value="{{ $product->price }}" name="price">
                                                     <input type="hidden" value="{{ $product->description }}" name="description">
                                                     <input type="hidden" value="{{ $product->image }}"  name="image">
                                                     <input type="hidden" value="{{ $product->ordered_quantity }}"  name="ordered_quantity">
                                                     <input type="hidden" value="{{ $product->order_id }}"  name="order_id"><br>
                                                     <label class="mt-2">Quantity: </label>
                                                     <input  type="number" min="0" value="" class="form form-control" name="quantity" placeholder="Qty" required><br><br>
                                                     <button class="px-4 py-2 btn btn-outline-primary rounded">Add to Delivery Cart</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </main>
                    </div>
                    @include('layout.footer')
                </div>
            @endsection
<style type="text/css">
body{
    margin-top:20px;
    background:#eee;
}
.ui-w-40 {
    width: 40px !important;
    height: auto;
}

.card{
    box-shadow: 0 1px 15px 1px rgba(52,40,104,.08);
}

.ui-product-color {
    display: inline-block;
    overflow: hidden;
    margin: .144em;
    width: .875rem;
    height: .875rem;
    border-radius: 10rem;
    -webkit-box-shadow: 0 0 0 1px rgba(0,0,0,0.15) inset;
    box-shadow: 0 0 0 1px rgba(0,0,0,0.15) inset;
    vertical-align: middle;
}
</style>
<script type="text/javascript">
</script>
</body>
</html>



