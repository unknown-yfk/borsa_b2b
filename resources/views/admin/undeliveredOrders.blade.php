@extends('layouts.mainlayout')
@section('content')

  <div class="main-panel">
        <div class="content-wrapper">
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Undelivered Orders</h4>

                  <p class="card-description">
                  <code>List of Undelivered orders</code>
                  </p>
                  <div class="table-responsive pt-3">
                                {{-- <table id="datatable" class="table"> --}}
                                       <table id="recent-purchases-listing" class="table">

                                    <thead>
                                        <tr>
                                            <th>Undelivered By</th>
                                            <th>Order ID</th>
                                            <th>Missed Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($rom as $roms)
                                      <tr>
                                      <td>{{$roms->firstName}} {{$roms->middleName}} {{$roms->lastName}}</td>
                                      <td>{{$roms->order_id}}</td>
                                      <td>{{$roms->created_at->format('d/m/y')}}</td>
                                      <td>
                                        <form action="{{ ('/admin/undelivered/order/details') }}" method="POST">
                                           @csrf
                                           <input type="hidden" value="{{$roms->id}}" name="delivery1_id" >
                                         <button type="submit" class="btn btn-outline-success">View Details</button>
                                        </form>
                                    </td>
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
