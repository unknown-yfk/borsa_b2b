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
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('js/scripts.js') }}"></script>
        <script src=" https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{url ('assets/demo/chart-area-demo.js')}}"></script>
        <script src="{{url ('assets/demo/chart-bar-demo.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="{{url ('js/datatables-simple-demo.js') }}"></script>
    </head>
<body class="sb-nav-fixed">
      @include('sweetalert::alert')
    @if(Auth::user()->userType=='key distributor')
        @include('nav.kd_navbar')
    @elseif(Auth::user()->userType=='ROM')
        @include('nav.rom_navbar')
    @endif
    <div id="layoutSidenav">
        @if(Auth::user()->userType=='key distributor')
            @include('Sidenavbar.kdSidebar')
        @elseif(Auth::user()->userType=='ROM')
            @include('Sidenavbar.romSidebar')
        @endif
        <div id="layoutSidenav_content">
            <main>
            <div class="container px-3 my-5 clearfix">
            <!----------------------------------- Shopping cart table -------------------------------------->
            <div class="card">
                <div class="card-header">
                    <h1>Remaining Products Details </h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered m-0">
                        <thead>
                          <tr>
                            <!-- Set columns width -->
                            <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp; Details</th>
                            <th class="text-center py-3 px-4" style="width: 120px;">Undelivered Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($deliveredProducts as $item)
                          <tr>
                            <td class="p-4">
                              <div class="media align-items-center">
                                <img src="" class="d-block ui-w-40 ui-bordered mr-4" alt="">
                                <div class="media-body">
                                  <div class="d-block text-dark text-uppercase">{{$item->name}}</div>
                                  <small>
                                    <span class="text-bold">Description: </span> {{$item->description}}
                                  </small>
                                </div>
                              </div>
                            </td>
                    <td class="align-middle p-4"><input type="number" class="form-control text-center" value="{{$item->undelivered_quantity}}" readonly></td>
                </tr>
                 @endforeach
                </tbody>
              </table>
            </div>
            <!-- / Shopping cart table -->
                <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
                  <div class="mt-4"></div>
                  <div class="d-flex">
                    <div class="text-right mt-4"></div>
                  </div>
                </div>
                <div class="float-right">
                <form action="/kd/handover" method="POST">
                  @csrf
                    <input type="hidden" value="{{$item->order_id}}" name="order_id">
                    <input type="hidden" value="confirmed" name="confirm">
                    <button type="submit" class="btn btn-outline-primary mt-2">Handover</button>
                </form>
            </div>
          </div>
      </div>
  </div>
</main>
@include('layout.footer')
</div>

<style type="text/css">
body{
    margin-top:20px;
    background:#eee;
}
#footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  height: 2.5rem;
  margin-right: 1rem;            /* Footer height */
  margin-left: 1rem;
  padding-left: 15rem            /* Footer height */
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
