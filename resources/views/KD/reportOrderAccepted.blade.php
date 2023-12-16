
@extends('layouts.mainlayout')
@section('content')

  <div class="main-panel">
        <div class="content-wrapper">




 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Order Report</h4>

                  <p class="card-description">
                  <code>Report</code>
                  </p>
                  <div class="table-responsive pt-3">
                                {{-- <table id="datatable" class="table"> --}}
                                       <table id="recent-purchases-listing" class="table">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Confirmation Status</th>
                                            <th>Handover Status</th>
                                            <th>Order Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($order as $order)
                                      <tr>
                                            <td>{{$order->order_id}}</td>
                                            <td>{{$order->confirmStatus}}</td>
                                            <td>{{$order->handoverStatus}}</td>
                                            <td>{{$order->createdDate}}</td>
                                        </tr>
                                @endforeach
                       </table>


                  </div>
                </div>
              </div>
            </div>
        </div>
  </div>
@endsection

