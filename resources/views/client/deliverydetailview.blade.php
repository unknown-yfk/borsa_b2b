@extends('layouts.mainlayout')
@section('content')

  <div class="main-panel">
        <div class="content-wrapper">




 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Delivery Details</h4>

                  <p class="card-description">
                  <code>Details of deliveries</code>
                  </p>
                  <input id="myInput" type="text" placeholder="Search orders here..">
                  <div class="table-responsive pt-3">
                                {{-- <table id="datatable" class="table"> --}}
                                       <table id="recent-purchases-listing" class="table">

                                <thead>
                                      <tr>
                                        <!-- Set columns width -->
                                        <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp; Details</th>
                                        <th class="text-right py-3 px-4" style="width: 100px;">Unit Price</th>
                                        <th class="text-center py-3 px-4" style="width: 120px;">Delivered Quantity</th>
                                        <th class="text-right py-3 px-4" style="width: 100px;">Sub-Total </th>
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
                                                <span><strong>Description:</strong> </span> {{$item->description}}
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
            <!------------------------------------ / Shopping cart table ------------------------------------------>
            <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
              <div class="mt-4"></div>
              <div class="d-flex">
                <div class="text-right mt-4">
                  <div class="text-large"><strong>Total Price: {{$item->deliveryTotalPrice}} br</strong></div>
                </div>
              </div>
            </div>
            </div>
          </div>

      </div>
  </div>

    </div>
  </div>
    </div>
  </div>

@endsection
