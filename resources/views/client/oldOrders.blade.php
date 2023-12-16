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
                                            <th>Delivery ID</th>
                                            <th>Delivered from</th>
                                            <th>Delivered By</th>
                                            <th>Order ID</th>
                                            <th>Confirmation Status</th>
                                            <th>Delivered Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($delivery as $delivery)
                                      <tr>
                                            <td>{{$delivery->id}}</td>
                                            <td>{{$delivery->firstName}} {{$delivery->middleName}} {{$delivery->lastName}}</td>
                                            <td>{{$delivery->userType}} </td>
                                            <td>{{$delivery->order_id}}</td>
                                            <td>{{$delivery->confirmation_status}}</td>
                                            <td>{{$delivery->updated_at}}</td>
                                            <td>
                                            <form action="{{ ('/client/delivery/details/index') }}" method="POST">
                                               @csrf
                                               <input type="hidden" value="{{$delivery->id}}" name="delivery_4s_id" >
                                             <button type="submit" class="btn btn-outline-success">View Details</button>
                                            </form>
                                        </td>
                                        </tr>
                                @endforeach
                                </table>
                            </table>
                                 {{-- {!! $userList->links() !!} --}}

                  </div>
                </div>
              </div>
            </div>
        </div>
  </div>
@endsection
