@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">




            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
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
                {{-- <form action="/kd/handover" method="POST">
                  @csrf
                    <input type="hidden" value="{{$item->order_id}}" name="order_id">
                    <input type="hidden" value="confirmed" name="confirm">
                    <button type="submit" class="btn btn-outline-primary mt-2">Handover</button>
                </form> --}}
            </div>
          </div>
      </div>
  </div>
        </div>
    </div>
</div>
@endsection

