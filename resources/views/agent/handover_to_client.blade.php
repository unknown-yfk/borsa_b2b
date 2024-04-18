
@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">



           <input type="hidden" {{$subtotal=0;}}/>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Delivery Handing Over Client</h4>

                        <p class="card-description">
                            <code>Delivery Cart</code>
                        </p>
                        {{-- <input id="myInput" type="text" placeholder="Search orders here.."> --}}
                        <div class="table-responsive pt-3">
                            {{-- <table id="datatable" class="table"> --}}
                            <table id="recent-purchases-listing" class="table">
                                <thead>
                                    <tr>
                                        <!-- Set columns width -->
                                        <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp;
                                            Details</th>
                                        <th class="text-right py-3 px-4" style="width: 100px;">Unit Price</th>
                                        <th class="text-center py-3 px-4" style="width: 120px;">Recieved Quantity</th>
                                        <th class="text-right py-3 px-4" style="width: 100px;"> Delivery Quantity</th>
                                        <th class="text-right py-3 px-4" style="width: 100px;"> Delivered sub-total</th>
                                        {{-- <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a
                                                href="#" class="shop-tooltip float-none text-light" title=""
                                                data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                      @php
                                        $totalSum = 0;
                                    @endphp
                                    @foreach ($deliveredProducts as $item)
                                        <tr>
                                            <td class="p-4">
                                                <div class="media align-items-center">
                                                    <img src="{{ asset('/assets/product_img/'.$item->image) }}" class="d-block ui-w-40 ui-bordered mr-4"
                                                        alt="">
                                                    <div class="media-body">
                                                        <a href="#" class="d-block text-dark">{{ $item->name }}</a>
                                                        <small>
                                                            <span class="text-muted"><strong> Description:</strong> </span>
                                                            {{ $item->description }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                            @if ($item->quantity > $item->recieved_quantity)
                                                <span class="text-danger"> Delivery Quantity is greater than Recived
                                                    Quantity</span>
                                            @endif
                                            <td class="text-right font-weight-semibold align-middle p-4">{{ $item->subTotal/$item->delivered_quantity }}
                                                br</td>
                                            <td class="text-right font-weight-semibold align-middle p-4">
                                                {{ $item->delivered_quantity }} </td>


{{-- <td class="align-middle p-4"><input type="number"

Yabkal Elebat, [7/5/2023 9:45 AM]
class="form-control text-center" value="{{ $item->partial_quantity }}"
                                                    readonly></td> --}}



                                            @if ($item->partial_quantity == 0)
                                          <td class="align-middle p-4"><input type="number"
                                                    class="form-control text-center" value="{{ $item->delivered_quantity }}"
                                                    readonly></td>
                                            @elseif ($item->partial_quantity !== 0)
                                                <td class="align-middle p-4"><input type="number"
                                                    class="form-control text-center" value="{{ $item->partial_quantity }}"
                                                    readonly></td>
                                            @endif



                                            @if ($item->partial_quantity == 0)
                                                <td class="text-right font-weight-semibold align-middle p-4">
                                                    {{ $item->delivered_quantity * $item->subTotal/$item->delivered_quantity}} br</td>
                                                     @php
                                                $totalSum += $item->delivered_quantity * $item->subTotal/$item->delivered_quantity;
                                            @endphp
                                                    {{-- <input type="hidden" {{$subtotal=$item->delivered_quantity * $item->price + $subtotal}} /> --}}
                                            @elseif ($item->partial_quantity !== 0)
                                                <td class="text-right font-weight-semibold align-middle p-4">
                                                    {{ $item->partial_quantity * $item->subTotal/$item->delivered_quantity }} br</td>
                                                      @php
                                                $totalSum += $item->partial_quantity * $item->subTotal/$item->delivered_quantity;
                                            @endphp
                                                    {{-- <input type="hidden" {{$subtotal=$item->partial_quantity * $item->price + $subtotal}} /> --}}
                                            @endif

                                            {{-- <td class="text-right font-weight-semibold align-middle p-4">{{ $item->price }}
                                                birr</td> --}}
                                            {{-- <td class="hidden text-right md:table-cell">
                                                <form action="{{ route('delivery2Cart.remove') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" value="{{ $item->id }}" name="id">
                                                    <button class="btn btn-outline-warning"><i
                                                            class="mdi mdi-delete"></i></button>
                                                </form>
                                            </td> --}}
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



                                           <div class="text-large"><strong>Total Price: {{ $totalSum }} birr </strong>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="float-right col-md-3">
                            <br>


                  <form action="{{ '/handover_to_clientagent/post/create' }}" method="POST">

                                @csrf



                                <input type="hidden" value="{{ $orderedBy[0]->orderedBy }}" name="orderedBy">



                                <input type="hidden" value="{{ Cart::getTotal() }}" name="total">
                                @foreach ($deliveredProducts as $item)
                                    <input type="hidden" value="{{ $item->order_id }}" name="order_id">
                                    <input type="hidden" value="{{ $item->delivery1_id }}" name="delivery1_id">


                                @endforeach


                             <label>Select Client </label><br>
                                <select id="client" name="client" class="form-control" required>
                                    <option value=""></option>
                                    @foreach ($client as $client)
                                        <option value="{{ $client->user_id }}"> {{ $client->firstName }}
                                            {{ $client->middleName }} {{ $client->lastName }}</option>
                                    @endforeach
                                </select>

                               <br> <div id="pincode-field" style="display:none;">
                                    <label for="pincode">Enter Pincode</label>

                                    <input class="form form-control" type="password" min="4" max="4"
                                        name="pinCode" id="pincode" placeholder="Client PIN"
                                        style="background-color: rgba(7, 252, 7, 0.874)" autocomplete="off" required>
                                </div>

                                <button type="submit" class="btn btn-outline-success mt-2">Handover</button>

                            </form>
                        </div>
               </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <script>
        document.getElementById('client').addEventListener('change', function() {
            document.getElementById('pincode-field').style.display = 'block';
        });
    </script>
@endsection
