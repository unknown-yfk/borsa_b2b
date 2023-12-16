
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>e-pace</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

@include('sweetalert::alert')

<div class="container px-3 my-5 clearfix">
    <!-- Shopping cart table -->
    <div class="card">
        <div class="card-header">
            <h1>Order Details </h1>
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
                    <th class="text-right py-3 px-4" style="width: 100px;">delivery Quantity </th>
                    </tr>
                  </thead>
                <tbody>

                <form action="/handover1/post/create" method="POST">
                  @csrf
                 @foreach ($orderedProducts as $item)
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
                    <td class="align-middle p-4"><input type="number" class="form-control text-center" value="{{$item->ordered_quantity}}" readonly></td>
                    <form action="/handover1/post/create" method="POST">
                    <td class="align-middle p-4"><input type="number" class="form-control text-center" value="" name="delivery_quantity"></td>

                </tr>

                 @endforeach
                </tbody>
              </table>
              <div class="float-right">





          <input type="hidden" value="{{$item->order_id}}" name="order_id">
          <label>Select ROM:</label>
                  <select id="rom" name="rom"  class="form-control">

                  @foreach ( $rom as $roms)
                  <option value="{{ $roms->user_id }}" > {{ $roms->firstName }} {{ $roms->middleName }} {{ $roms->lastName }}
                  </option>      @endforeach




                     </select>
             <button type="submit" class="btn btn-lg btn-primary mt-2">confirm handover</button>
         </form>

  </div>

            </div>
            <!-- / Shopping cart table -->

            <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
              <div class="mt-4">
                             </div>
              <div class="d-flex">






              </div>
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
