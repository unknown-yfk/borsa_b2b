@extends('layouts.mainlayout')
@section('content')

  <div class="main-panel">
        <div class="content-wrapper">




 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Order History</h4>

                  <p class="card-description">
                  <code>List of orders</code>
                  </p>
                  <div class="table-responsive pt-3">
                                {{-- <table id="datatable" class="table"> --}}
                                       <table id="recent-purchases-listing" class="table">

                                    <thead>
                                        <tr>
                                            <th>{{__('OrderId')}}</th>
                                            <th>{{__('Client')}}</th>
                                            <th>{{__('KeyDistributor')}}</th>
                                            <th>{{__('OrderDate')}}</th>
                                            <th>{{__('DeliveryStatus')}}</th>
                                            <th>{{__('Action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($client as $order)
                                      <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->firstName}} {{$order->middleName}} {{$order->lastName}}</td>
                                            <td>{{Helper::get_kd_name($order->KD_id)}}</td>
                                            <td>{{$order->createdDate}}</td>
                                            <td>{{$order->deliveryStatus}}</td>
                                            <td><form action="/order/details" method="POST">
                                               @csrf
                                               <input type="hidden" value="{{$order->id}}" name="order_id" >
                                             <button type="submit" class="btn btn-outline-success" >{{__('View Details')}}</button>
                                              </form></td>
                                        </tr>
                               @endforeach
                   </table>
                                 {{-- {!! $userList->links() !!} --}}

                  </div>
                </div>
              </div>
            </div>
        </div>
  </div>
@endsection
