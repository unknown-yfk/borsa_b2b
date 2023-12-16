
@extends('layouts.mainlayout')
@section('content')

  <div class="main-panel">
        <div class="content-wrapper">




 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Handover History</h4>

                  <p class="card-description">
                  <code>Handover History</code>
                  </p>
                  <input id="myInput" type="text" placeholder="Search orders here..">
                  <div class="table-responsive pt-3">
                                {{-- <table id="datatable" class="table"> --}}
                                       <table id="recent-purchases-listing" class="table">

                                    <thead>
                                        <tr>
                                            <th>Delivery ID</th>
                                            <th>Delivered To</th>
                                            <th>Order Id</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($delivery as $delivery)
                                      <tr>
                                            <td>{{$delivery->id}}</td>
                                            <td>{{$delivery->firstName}} {{$delivery->middleName}} {{$delivery->lastName}}</td>
                                            <td>{{$delivery->order_id}}</td>
                                            <td>
                                            <form action="{{ ('/handover2Details') }}" method="POST">
                                               @csrf
                                               <input type="hidden" value="{{$delivery->id}}" name="delivery2_id" >
                                             <button type="submit" class="btn btn-outline-success" >View Details</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div></div>
        </div>
    </div>
@endsection
