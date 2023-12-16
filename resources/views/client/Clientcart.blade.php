@include('layout.header')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js" integrity="sha512-eSeh0V+8U3qoxFnK3KgBsM69hrMOGMBy3CNxq/T4BArsSQJfKVsKb5joMqIPrNMjRQSTl4xG8oJRpgU2o9I7HQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" integrity="sha512-yVvxUQV0QESBt1SyZbNJMAwyKvFTLMyXSyBHDO4BG5t7k/Lw34tyqlSDlKIrIENIzCl+RVUNjmCPG+V/GMesRw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap-grid.min.css" integrity="sha512-JQksK36WdRekVrvdxNyV3B0Q1huqbTkIQNbz1dlcFVgNynEMRl0F8OSqOGdVppLUDIvsOejhr/W5L3G/b3J+8w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap-grid.rtl.min.css" integrity="sha512-TVEh7Wv2VL7denA2jjLclu/YHda8TiwmLZBhUqmJa+PVhIgbOs4mkx4nGQw+ok1f+3tf/NpbVDIuPKIHcSyEhw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap-reboot.min.css" integrity="sha512-IS8Z2ZgFvTz/yLxE6H07ip/Ad+yAGswoD1VliOeC2T4WaPFNPC1TwmQ5zomGS+syaR2oO3aXJGKaHv21Dspx0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap-reboot.rtl.min.css" integrity="sha512-MWXegIfPaJ2ht1ccssKjDqUk4DDiTyoKQqb4zGNEAXqUfP8ukuEtxraKdo7nko3m+4mY+ZXlPOUX6y4SV0VXPA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap-utilities.min.css" integrity="sha512-DEGBrwaCF4lkKzMKNwt8Qe/V54bmJctk7I1HyfINGAIugDvsdBeuWzAWZmXAmm49P6EBfl/OeUM01U3r7cW4jg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap-utilities.rtl.min.css" integrity="sha512-1W/oJs3Mky37ftCexP/qGfEA5rEjkxtZb6dbxfqr2lGUSJzbrqYkIPZPrQdrsnZbH0Rj9Y6nsxyp4mgmvGbZew==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap.rtl.min.css" integrity="sha512-tC3gnye8BsHmrW3eRP3Nrj/bs+CSVUfzkjOlfLNrfvcbKXFxk5+b8dQCZi9rgVFjDudwipXfqEhsKMMgRZGCDw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.bundle.min.js" integrity="sha512-i9cEfJwUwViEPFKdC1enz4ZRGBj8YQo6QByFTF92YXHi7waCqyexvRD75S5NVTsSiTv7rKWqG9Y5eFxmRsOn0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.bundle.min.js" integrity="sha512-i9cEfJwUwViEPFKdC1enz4ZRGBj8YQo6QByFTF92YXHi7waCqyexvRD75S5NVTsSiTv7rKWqG9Y5eFxmRsOn0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}


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
<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<script>
     function openForm() {
        document.getElementById("popupForm").style.display = "block";
      }
      function closeForm() {
        document.getElementById("popupForm").style.display = "none";
      }
</script>
<style>
#footer {
   position: fixed !important;
   bottom: 0 !important;
   width: 100% !important;
   height: 4rem !important;   /* Height of the footer */
}
</style>
<style>
      * {
        box-sizing: border-box;
      }
      .openBtn {
        display: flex;
        justify-content: left;
      }
      .openButton {
        border: none;
        border-radius: 5px;
        background-color: #1c87c9;
        color: white;
        padding: 14px 20px;
        cursor: pointer;
        position: fixed;
      }
      .loginPopup {
        position: relative;
        text-align: center;
        width: 100%;
      }
      .formPopup {
        display: none;
        position: fixed;
        left: 45%;
        top: 5%;
        transform: translate(-50%, 5%);
        border: 3px solid #999999;
        z-index: 9;
      }
      .formContainer {
        max-width: 300px;
        padding: 20px;
        background-color: #fff;
      }
      .formContainer input[type=text],
      .formContainer input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 20px 0;
        border: none;
        background: #eee;
      }
      .formContainer input[type=text]:focus,
      .formContainer input[type=password]:focus {
        background-color: #ddd;
        outline: none;
      }
      .formContainer .btn {
        padding: 12px 20px;
        border: none;
        background-color: #8ebf42;
        color: #fff;
        cursor: pointer;
        width: 100%;
        margin-bottom: 15px;
        opacity: 0.8;
      }
      .formContainer .cancel {
        background-color: #cc0000;
      }
      .formContainer .btn:hover,
      .openButton:hover {
        opacity: 1;
      }
      .wrapper{
          width:200px;
          padding:20px;
          height: 150px;
        }
    </style>
<body class="sb-nav-fixed">
    @include('nav.client_navbar')
    <div id="layoutSidenav">
            @include('Sidenavbar.clientSidebar')
        <div id="layoutSidenav_content">
            <main>
                @extends('layout.clientcartHeader')
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
                                          <a href="#" class="d-block text-dark">{{$item->id}}</a>

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
              <form action="/client/order/post/create" method="POST">
                 @csrf
                <input type="hidden" value="{{ Cart::getTotal() }}" name="total">
                    {{-- <label>Who are you ordering for:</label> <br> --}}
                     <div class="container">
<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
          <form action="/client/order/post/create "  method="POST">
            <div class="form-group row">
              <div class="col-sm-12">
                <div class="form-check text-align-left">
                  <label class="form-check-label" for="flexRadioDefault1">
                    I do not accept less quantity
                  </label>
                  <input class="form-check-input" type="radio" name="consent" value="0" id="flexRadioDefault1">
                </div>
                <div class="form-check text-align-left">
                  <label class="form-check-label" for="flexRadioDefault2">
                    I do accept any quantity
                  </label>
                  <input class="form-check-input" type="radio" name="consent" value="1" id="flexRadioDefault2">
                </div>
                <button type="submit" class="btn btn-success mt-2">Checkout</button>
          </form>
              @endif
              <form action="{{'/orderClear'}}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger mt-2">Clear Cart</button>
              </form>
            </div>
          </div>
      </div>
   </main>
   @include('layout.footer')
</div>
</div>
@endsection
<div class="loginPopup">
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
</html>
