
@extends('layouts.mainlayout')
@section('content')

  <div class="main-panel">
        <div class="content-wrapper">




 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Remaining Products Details</h4>

                  <p class="card-description">
                  <code>Details</code>
                  </p>
                  {{-- <input id="myInput" type="text" placeholder="Search orders here.."> --}}
                  <div class="table-responsive pt-3">
                                {{-- <table id="datatable" class="table"> --}}
                                       <table id="recent-purchases-listing" class="table">

                                    <thead>
                  <tr>
                    <!------------------------------------- Set columns width ---------------------------------------->
                    <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp; Details</th>
                    <th class="text-center py-3 px-4" style="width: 120px;">Undelivered Quantity</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($undeliveredProducts as $item)
                  <tr>
                    <td class="p-4">
                      <div class="media align-items-center">
                        <img src="" class="d-block ui-w-40 ui-bordered mr-4" alt="">
                        <div class="media-body">
                          <a href="#" class="d-block text-dark text-uppercase">{{$item->name}}</a>
                          <small>
                            <span class="text-muted"><strong> Description:</strong></span> {{$item->description}}
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
            <!-------------------------------------- / Shopping cart table ------------------------------------------------------>
            <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
              <div class="mt-4"></div>
              <div class="d-flex">
                <div class="text-right mt-4">

                   </div>
              </div>
            </div>
            {{-- <div class="float-right">
                <form action="/rom/handover" method="POST">
              @csrf
              <input type="hidden" value="{{$item->order_id}}" name="order_id">
                <input type="hidden" value="confirmed" name="confirm">
              <button type="submit" class="btn btn-outline-success mt-2">Handover</button>
            </form>
        </div> --}}
          </div>
      </div>
  </div>
</main>
        </div>
  </div>

</div>
@endsection

