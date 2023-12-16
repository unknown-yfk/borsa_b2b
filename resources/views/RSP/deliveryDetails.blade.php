
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Order Tracking System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	{{-- <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script> --}}


<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap-grid.min.css" integrity="sha512-JQksK36WdRekVrvdxNyV3B0Q1huqbTkIQNbz1dlcFVgNynEMRl0F8OSqOGdVppLUDIvsOejhr/W5L3G/b3J+8w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap-grid.rtl.min.css" integrity="sha512-TVEh7Wv2VL7denA2jjLclu/YHda8TiwmLZBhUqmJa+PVhIgbOs4mkx4nGQw+ok1f+3tf/NpbVDIuPKIHcSyEhw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap-reboot.min.css" integrity="sha512-IS8Z2ZgFvTz/yLxE6H07ip/Ad+yAGswoD1VliOeC2T4WaPFNPC1TwmQ5zomGS+syaR2oO3aXJGKaHv21Dspx0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap-reboot.rtl.min.css" integrity="sha512-MWXegIfPaJ2ht1ccssKjDqUk4DDiTyoKQqb4zGNEAXqUfP8ukuEtxraKdo7nko3m+4mY+ZXlPOUX6y4SV0VXPA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap-utilities.min.css" integrity="sha512-DEGBrwaCF4lkKzMKNwt8Qe/V54bmJctk7I1HyfINGAIugDvsdBeuWzAWZmXAmm49P6EBfl/OeUM01U3r7cW4jg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap-utilities.rtl.min.css" integrity="sha512-1W/oJs3Mky37ftCexP/qGfEA5rEjkxtZb6dbxfqr2lGUSJzbrqYkIPZPrQdrsnZbH0Rj9Y6nsxyp4mgmvGbZew==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap.rtl.min.css" integrity="sha512-tC3gnye8BsHmrW3eRP3Nrj/bs+CSVUfzkjOlfLNrfvcbKXFxk5+b8dQCZi9rgVFjDudwipXfqEhsKMMgRZGCDw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.bundle.min.js" integrity="sha512-i9cEfJwUwViEPFKdC1enz4ZRGBj8YQo6QByFTF92YXHi7waCqyexvRD75S5NVTsSiTv7rKWqG9Y5eFxmRsOn0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.bundle.min.js" integrity="sha512-i9cEfJwUwViEPFKdC1enz4ZRGBj8YQo6QByFTF92YXHi7waCqyexvRD75S5NVTsSiTv7rKWqG9Y5eFxmRsOn0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</head>
<body>

@include('sweetalert::alert')

<div class="container px-3 my-5 clearfix">
    <!-- Shopping cart table -->
    <div class="card">
        <div class="card-header">
            <h1>Delivery Details </h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered m-0">
                <thead>
                  <tr>
                    <!-- Set columns width -->
                    <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp; Details</th>
                    <th class="text-right py-3 px-4" style="width: 100px;">Unit Price</th>
                    <th class="text-center py-3 px-4" style="width: 120px;">Delivered Quantity</th>
                    <th class="text-right py-3 px-4" style="width: 100px;">sub-Total </th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($deliveredProducts as $item)
                  <tr>
                    <td class="p-4">
                      <div class="media align-items-center">
                        <img src="" class="d-block ui-w-40 ui-bordered mr-4" alt="">
                        <div class="media-body">
                          <a href="#" class="d-block text-dark">{{$item->name}}</a>
                          <small>


                            <span class="text-muted">description: </span> {{$item->description}}
                          </small>
                        </div>
                      </div>
                    </td>
                    <td class="text-right font-weight-semibold align-middle p-4">{{$item->price}} br</td>
                    <td class="align-middle p-4"><input type="number" class="form-control text-center" value="{{$item->delivered_quantity}}" readonly></td>
                    <td class="text-right font-weight-semibold align-middle p-4">{{$item->subTotal}} br</td>

                </tr>

                 @endforeach
                </tbody>
              </table>
            </div>
            <!-- / Shopping cart table -->

            <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
              <div class="mt-4">
                             </div>
              <div class="d-flex">
                <div class="text-right mt-4">

                  <div class="text-large"><strong>Total Price: {{$item->deliveryTotalPrice}} br</strong></div>
                </div>
              </div>
            </div>

            <div class="float-right">

            @if($item->confirmationStatus=='unconfirmed')
              <form action="/confirmDelivery2/update/edit" method="POST">
              @csrf
                    @method('PUT')
                    <input type="hidden" value="{{$item->delivery2_id}}" name="delivery2s_id">
                            <input type="hidden" value="confirmed" name="confirm">
              <button type="submit" class="btn btn-lg btn-primary mt-2">confirm delivery</button>
                </form>
                @elseif($item->confirmationStatus=='confirmed'&&Auth::user()->userType=='RSP')

                <form action="/delivery3" method="GET">
              @csrf
                    <input type="hidden" value="{{$item->delivery2_id}}" name="delivery2_id">
              <button type="submit" class="btn btn-lg btn-primary mt-2">Deliver to client</button>
                </form>
               @else
               @endif
            </div>

          </div>
      </div>
  </div>

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
