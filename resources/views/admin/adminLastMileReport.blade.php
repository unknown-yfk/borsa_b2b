

@extends('layouts.mainlayout')
@section('content')

  <div class="main-panel">
        <div class="content-wrapper">




 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Last mile Report</h4>

                  <p class="card-description">
                  <code>Report</code>
                  </p>
                  <div class="table-responsive pt-3">
                                       <table id="recent-purchases-listing" class="table">

                             <thead>
                                      <tr>
                                            <th>Order ID</th>
                                            <th>Last Mile Delivery Status</th>
                                            <th>Order Date</th>
                                            <th>Delivery Date</th>
                                            <th>Client</th>
                                            <th>RSP</th>

                                        </tr>
                                    </thead>
                      <tbody>
                                         @if(!empty($LastMileReport) && $LastMileReport->count())

                                        


                                      @foreach($LastMileReport as $order)
                                      <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->paymentStatus}}</td>
                                            <td>{{$order->created_at}}</td>
                                            <td>{{$order->createdAt}}</td>
                                            <td>{{$order->firstName . ' ' . $order->middleName . ' ' . $order->lastName}}
                                            <td>{{Helper::get_rsp_name($order->rsp_id)}}</td>
                                        </tr>
                                @endforeach
                                          @else
                                          <tr>
                    <td colspan="10">There are no data.</td>
                </tr>
            @endif
                                    </tbody>
                    </table>
                              

                  </div>
                </div>
              </div>
            </div>
        </div>
  </div>

@endsection
