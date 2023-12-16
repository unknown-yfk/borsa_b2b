
@extends('layouts.mainlayout')
@section('content')

  <div class="main-panel">
        <div class="content-wrapper">




 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Undelivered Orders</h4>

                  <p class="card-description">
                  <code>Undelivered Orders</code>
                  </p>
                  <input id="myInput" type="text" placeholder="Search orders here..">
                  <div class="table-responsive pt-3">
                                {{-- <table id="datatable" class="table"> --}}
                                       <table id="recent-purchases-listing" class="table">

                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Order ID</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($undelivered as $undelivered)

                                      <tr>
                                            <td>{{$undelivered->id}}</td>
                                            <td>{{$undelivered->order_id}}</td>
                                            <td>{{$undelivered->created_at->format('d/m/y')}}</td>
                                            <td>
                                            <form action="{{ ('/romUndeliveredDetails') }}" method="POST">
                                               @csrf
                                               <input type="hidden" value="{{$undelivered->id}}" name="delivery1_id" >
                                             <button type="submit" class="btn btn-outline-success">View Details</button>
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
        </div>
  </div>

        </div>
    </div>
@endsection
