
@extends('layouts.mainlayout')
@section('content')

  <div class="main-panel">
        <div class="content-wrapper">




 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Undelivered Orders</h4>

                  <p class="card-description">
                  <code>List of undelivered orders</code>
                  </p>
                  <div class="table-responsive pt-3">
                                {{-- <table id="datatable" class="table"> --}}
                                       <table id="recent-purchases-listing" class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Order_id</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($UndeliverdOrders as $UndeliverdOrders)
                                      <tr>
                                            <td>{{$UndeliverdOrders->id}}</td>
                                            <td>{{$UndeliverdOrders->order_id}}</td>
                                            <td>{{$UndeliverdOrders->created_at->format('d/m/y')}}</td>
                                            <td>
                                            <form action="{{ ('/undeliveredDetails') }}" method="POST">
                                               @csrf
                                               <input type="hidden" value="{{$UndeliverdOrders->id}}" name="delivery1_id" >
                                             <button type="submit"  class="btn btn-outline-success">View Detail</button>
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
