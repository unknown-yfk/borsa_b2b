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
            <nav class="p-6 mt-4 text-white sm:flex sm:justify-center sm:items-center"
                style="background-color: #123C69; color:white">
                <div class="flex flex-col sm:flex-row">
                    @if (Auth::user()->userType == 'key distributor')
                        <a class="mt-3 hover:underline sm:mx-3 sm:mt-0" style="color: white"
                            href="/key_distroDashboard">Home</a>
                    @elseif(Auth::user()->userType == 'ROM')
                        <a class="mt-3 hover:underline sm:mx-3 sm:mt-0" style="color: white" href="/romDashboard">Home</a>
                    @endif
                    <a class="mt-3 mr-3" href="javascript:javascript:history.go(-1)" style="color: white">Delivery</a>
                    @if (Auth::user()->userType == 'key distributor')
                        <a href="{{ route('deliveryCart.list') }}" class="flex items-center" style="color: white">
                            <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            {{ Cart::getTotalQuantity() }}
                        </a>
                    @elseif(Auth::user()->userType == 'ROM')
                        <a href="{{ route('delivery2Cart.list') }}" class="flex items-center" style="color: white">
                            <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            {{ Cart::getTotalQuantity() }}
                        </a>
                    @endif


                </div>
            </nav>
        </div>
        <div class="content-wrapper">




            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Delivery list</h4>

                        <p class="card-description">
                            <code>Delivery handing over to client</code>
                        </p>
                        <div class="table-responsive pt-3">
                            {{-- <table id="datatable" class="table"> --}}
                            <table id="recent-purchases-listing" class="table">
                                <thead>
                                    <tr>
                                        <!-- Set columns width -->
                                        <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp;
                                            Details</th>
                                        <th class="text-right py-3 px-4" style="width: 100px;">Unit Price</th>
                                        <th class="text-center py-3 px-4" style="width: 120px;">Ordered Quantity</th>
                                        <th class="text-right py-3 px-4" style="width: 100px;"> Delivery Quantity</th>
                                        <th class="text-right py-3 px-4" style="width: 100px;"> Delivered Sub-total</th>
                                        <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a
                                                href="#" class="shop-tooltip float-none text-light" title=""
                                                data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                        <tr>
                                            <td class="p-4">
                                                <div class="media align-items-center">
                                                    <img src="" class="d-block ui-w-40 ui-bordered mr-4"
                                                        alt="">
                                                    <div class="media-body">
                                                        <div class="d-block text-dark">{{ $item->name }}</div>
                                                        <small>
                                                            <span class="text-muted">Description: </span>
                                                            {{ $item->attributes->description }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                            @if ($item->quantity > $item->attributes->ordered_quantity)
                                                <span class="text-danger"> Delivery Quantity is greater than Orderd
                                                    Quantity</span>
                                            @endif
                                            @if ($item->quantity < $item->attributes->ordered_quantity)
                                                {{ $quantity_left = $item->attributes->ordered_quantity - $item->quantity }}
                                            @endif
                                            <td class="text-right font-weight-semibold align-middle p-4">{{ $item->price }}
                                                br</td>
                                            <td class="align-middle p-4"><input type="number"
                                                    class="form-control text-center"
                                                    value="{{ $item->attributes->ordered_quantity }}" readonly></td>
                                            <td class="align-middle p-4"><input type="number"
                                                    class="form-control text-center" value="{{ $item->quantity }}" readonly>
                                            </td>
                                            <td class="text-right font-weight-semibold align-middle p-4">
                                                {{ $item->attributes->subtotal }} br</td>
                                            <td class="hidden text-right md:table-cell">
                                                <form action="/delivery1Remove" method="POST">
                                                    @csrf
                                                    <input type="hidden" value="{{ $item->id }}" name="id">
                                                    <button class="btn btn-outline-warning"><i
                                                            class="mdi mdi-delete"></i></button>
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
                            <form action="{{ '/key_distro/client_pincode_verification/post' }}" method="POST">

                                @csrf



                                <input type="hidden" value="{{ $orderedBy[0]->orderedBy }}" name="orderedBy">



                                <input type="hidden" value="{{ Cart::getTotal() }}" name="total">
                                @foreach ($cartItems as $item)
                                    <input type="hidden" value="{{ $item->attributes->order_id }}" name="order_id">
                                @endforeach






                                <label><strong>Please enter your Pin Code here</strong></label>
                                <input class="form form-control" type="password" min="4" max="4"
                                    name="pinCode" id="pinCode" placeholder="Client PIN"
                                    style="background-color: rgba(7, 252, 7, 0.874)" autocomplete="off" required>
                                <br>


                                @if (!isset($item))
                                    <?php header('location:javascript://history.go(-1)'); ?>
                                @endif
                                @if (isset($item))
                                    <button <?php if ($item->quantity > $item->attributes->ordered_quantity){?> disabled <?php  }?> type="submit"
                                        class="btn btn-outline-success mt-2">Handover</button>
                                @endif
                            </form>

                            {{-- <a href="/key_distroProfile/show" class="btn btn-outline-success mt-2">Proceed</a> --}}



                        </div>
                        {{-- </table> --}}
                        {{-- {!! $userList->links() !!} --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
