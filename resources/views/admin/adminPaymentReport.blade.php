@extends('layouts.mainlayout')
@section('content')

  <div class="main-panel">
        <div class="content-wrapper">




 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Payment Report</h4>

                  <p class="card-description">
                  <code>Payment Report</code>
                  </p>
                  <div class="table-responsive pt-3">
                                       <table id="recent-purchases-listing" class="table">

                             <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Payment Status</th>
                                            <th>Order Date</th>
                                            <th>Client</th>
                                            <th>Key Distrbutor</th>
                                            <th>Bank Name</th>
                                            <th>Debited Account Number</th>
                                            <th>Credited Account Number</th>
                                            <th>Total Amount</th>
                                            <th>Transaction Date</th>

                                        </tr>
                                    </thead>
                      <tbody>
                                         @if(!empty($paymentReport) && $paymentReport->count())




                                      @foreach($paymentReport as $order)
                                   <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->paymentStatus}}</td>
                                            <td>{{$order->created_at}}</td>
                                            <td>{{$order->firstName . ' ' . $order->middleName . ' ' . $order->lastName}}
                                            <td>{{Helper::get_kd_name($order->KD_id)}}</td>
                                            <td>{{$order->bank_name}}</td>
                                            <td>{{$order->to_kd}}</td>
                                            <td>{{$order->from_client}}</td>
                                            <td>{{$order->total_price}}</td>
                                            <td>{{$order->date}}</td>
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
