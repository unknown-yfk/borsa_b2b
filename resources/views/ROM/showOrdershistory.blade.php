
@extends('layouts.mainlayout')
@section('content')

  <div class="main-panel">
        <div class="content-wrapper">




 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> Orders history</h4>

                  <p class="card-description">
                  <code>List of recently added orders</code>
                  </p>
                  <div class="table-responsive pt-3">
                                {{-- <table id="datatable" class="table"> --}}
                                       <table id="recent-purchases-listing" class="table">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Client</th>
                                            <th>Region</th>
                                            <th>City</th>
                                            <th>Order Date</th>
                                            <th>Confirmation Status</th>
                                            <th>TM Confirmation Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($client as $order)
                                      <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->firstName}} {{$order->middleName}} {{$order->lastName}}</td>
                                            <td>{{$order->Region}}</td>
                                            <td>{{$order->City}}</td>
                                            <td>{{$order->createdDate}}</td>
                                            <td>{{$order->confirmStatus}}</td>
                                            <td>{{$order->tm_confirmation}}</td>
                                            <td>
                                            <form action="{{ ('/rom_orderhistory_details') }}" method="POST">
                                               @csrf
                                               <input type="hidden" value="{{$order->id}}" name="order_id" >
                                             <button type="submit" class="btn btn-outline-success">View details</button>
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
