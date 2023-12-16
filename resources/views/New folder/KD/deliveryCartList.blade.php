<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>e-pace</title>
    <link href="{{ url('css/styles.css') }}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<link href="css/styles.css" rel="stylesheet" />
<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
<style>
body {
    background: rgb(99, 39, 120)
}
.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels {
    font-size: 11px
}

.add-experience:hover {
    background: #BA68C8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #BA68C8
}
#footer {
  position: absolute;
  bottom: 0;
  width: 90%;
  height: 2.5rem;            /* Footer height */
}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6FjTNtaiuf3PGaAVvVFHYgc6M_tdM24k&callback=initMap&libraries=places&v=weekly"
      async></script>
</head>
<body class="sb-nav-fixed">
        @include('nav.kd_navbar')
    <div id="layoutSidenav">
            @include('Sidenavbar.kdSidebar')
            <div id="layoutSidenav_content">
            <main>
                @extends('layout.deliverHeader')
                @section('content')
                @include('sweetalert::alert')
                    <div class="container px-3 my-5 clearfix">
                        <!-- Shopping cart table -->
                        <div class="card">
                            <div class="card-header">
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
                                <th class="text-center py-3 px-4" style="width: 120px;">Ordered Quantity</th>
                                <th class="text-right py-3 px-4" style="width: 100px;"> Delivery Quantity</th>
                                <th class="text-right py-3 px-4" style="width: 100px;"> Delivered Sub-total</th>
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
                                    <td class="align-middle p-4"><input type="number" class="form-control text-center" value="{{$item->attributes->ordered_quantity}}" readonly></td>
                                    <td class="align-middle p-4"><input type="number" class="form-control text-center" value="{{$item->quantity}}" readonly></td>
                                    <td class="text-right font-weight-semibold align-middle p-4">{{$item->attributes->subtotal}} br</td>
                                    <td class="hidden text-right md:table-cell">
                                        <form action="/delivery1Remove" method="POST">
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
            <form action="{{ ('/handover1/post/create') }}" method="POST">
             @csrf
                 <input type="hidden" value="{{ Cart::getTotal() }}" name="total">
                @foreach ($cartItems as $item)
             <input type="hidden" value="{{ $item->attributes->order_id}}" name="order_id">
                @endforeach
             <label>Select ROM:</label>
             <select id="rom" name="rom"  class="form-control">
             @foreach ( $rom as $rom)
             <option value="{{ $rom->user_id }}" > {{ $rom->firstName }} {{ $rom->middleName }} {{ $rom->lastName }}
             </option>
             @endforeach
                </select>
                   <button type="submit" class="btn btn-outline-success mt-2">Confirm Handover</button>
                 </form>
            </div>
          </div>
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
</body>
</html>
