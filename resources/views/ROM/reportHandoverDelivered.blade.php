
@extends('layouts.mainlayout')
@section('content')

  <div class="main-panel">
        <div class="content-wrapper">




 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Handover Report</h4>

                  <p class="card-description">
                  <code>Report</code>
                  </p>
                  <input id="myInput" type="text" placeholder="Search orders here..">
                  <div class="table-responsive pt-3">
                                {{-- <table id="datatable" class="table"> --}}
                                       <table id="recent-purchases-listing" class="table">

                                    <thead>
                                        <tr>
                                            <th>Delivery ID</th>
                                            <th>Delivery Status</th>
                                            <th>Delivery  Date</th>
                                            <th>Order ID</th>
                                            <th>Handoverd To</th>
                                            <th>Handover Status</th>
                                            <th>Handover Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($handover as $handover)
                                      <tr>
                                            <td>{{$handover->id}}</td>
                                            <td>{{$handover->confirmationStatus}}</td>
                                            <td>{{$handover->created_at}}</td>
                                            <td>{{$handover->order_id}}</td>
                                            <td>{{$handover->firstName}} {{$handover->middleName}} {{$handover->lastName}}</td>
                                            <td>{{$handover->handoverStatus}}</td>
                                            <td>{{$handover->createdDate}}</td>
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
        </div>
 @endsection
