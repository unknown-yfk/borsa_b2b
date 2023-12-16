@extends('layouts.mainlayout')
@section('content')

  <div class="main-panel">
        <div class="content-wrapper">




 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Undelivered Ordered Products</h4>


                  <div class="table-responsive pt-3">
                                {{-- <table id="datatable" class="table"> --}}
                                       <table id="recent-purchases-listing" class="table">
                                    <thead>
                                        <tr>
                                        <!-- Set columns width -->
                                        <th class="text-center py-3 px-4" style="min-width: 400px;">Product Name &amp; Details</th>
                                        <th class="text-center py-3 px-4" style="width: 120px;">Undelivered Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($deliveredProducts as $item)
                                        @if($item->undelivered_quantity>0)
                                          <tr>
                                            <td class="p-4">
                                              <div class="media align-items-center">
                                                <img src="" class="d-block ui-w-40 ui-bordered mr-4" alt="">
                                                <div class="media-body">
                                                  <a href="#" class="d-block text-dark">{{$item->name}}</a>
                                                  <small>
                                                    <span class="text-muted"><strong> Description:</strong></span> {{$item->description}}
                                                  </small>
                                                </div>
                                              </div>
                                            </td>
                                            <td class="align-middle p-4"><input type="number" class="form-control text-center" value="{{$item->undelivered_quantity}}" readonly></td>
                                        </tr>
                                         @endif
                                         @endforeach
                                        </tbody>
                                        </table>

  </div>
                </div>
              </div>
            </div>
        </div>
  </div>
@endsection
