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
                                            <th>Key Distributor</th>
                                            <th>Client</th>
                                            <th>ROM</th>
                                            <th>ROM Confirmation</th>
                                            <th>ROM Adjusted Confirmation</th>
                                            <th>TM Confirmation</th>
                                            <th>Cico Agent</th>
                                            <th>Action</th>


                                        </tr>
                                    </thead>
                      <tbody>
                                         @if(!empty($LastMileReport) && $LastMileReport->count())
                                      @foreach($LastMileReport as $order)

                                      <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->deliveryStatus}}</td>
                                            <td>{{$order->created_at}}</td>
                                            <td>{{Helper::get_kd_name($order->KD_id)}}</td>
                                            <td>{{Helper::get_client_name($order->client_id)}}</td>
                                            <td>{{Helper::get_rom_name($order->rom_id)}}</td>
                                            <td>{{$order->rom_order_confirmation}}</td>
                                            <td>{{$order->rom_adjusted_confirmation}}</td>
                                            <td>{{$order->tm_confirmation}}</td>

                                            <td>{{Helper::get_agent_name($order->agent_id)}}</td>
                                            <td><form action="{{ ('/officer/order/details') }}" method="POST">
                                               @csrf
                                               <input type="hidden" value="{{$order->id}}" name="order_id" >
                                             <button type="submit" class="btn btn-outline-success">View Details</button>
                                              </form></td>
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
