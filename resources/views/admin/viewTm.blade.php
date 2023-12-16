

@extends('layouts.mainlayout')
@section('content')
   <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">


  <div class="main-panel">
        <div class="content-wrapper">




 <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Client List</h4>

                  <p class="card-description">
                  <code>List of Registered Clients</code>
                  </p>
                  <div class="table-responsive pt-3">
                                       <table id="recent-purchases-listing" class="dataTable">

                             <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Full Name</th>
                                            <th>User Name</th>
                                            <th>Account Status</th>
                                            {{-- <th>Address</th>
                                            <th>Mobile</th>
                                            <th>Bussiness Name</th>
                                            <th>Bussiness Type
                                            <th>Registration</th>
                                            <th>Year In Bussiness</th>
                                            <th>Gelocation</th> --}}
                                            <th>Distributor</th>
                                        </tr>
                                    </thead>
                      <tbody>
                                         @if(!empty($client) && $client->count())


                                      @foreach($client as $clients)
                                      <tr>
                                            <td>{{$clients->id}}</td>
                                            <td>{{$clients->firstName}} {{$clients->middleName}} {{$clients->lastName}}</td>
                                            <td>{{$clients->userName}}</td>
                                            <td>
                                             <input data-id="{{$clients->user_id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="active" data-off="inactive" {{ $clients->status ? 'checked' : '' }}>
                                            </td>
                                            {{-- <td>{{$clients->client_address}}</td>
                                            <td>{{$clients->client_mobile}}</td>
                                            <td>{{$clients->client_businessName}}</td>
                                            <td>{{$clients->client_businessType}}</td>
                                            <td>{{$clients->client_BusinessRegisteration}}</td>
                                            <td>{{$clients->client_yearsInBusiness}}</td>
                                            <td>{{$clients->client_longtude}} {{$clients->client_latitude}}</td> --}}
                                            <td>{{$clients->distro_id}}</td>
                                        </tr>
                                @endforeach
                                          @else
                                          <tr>
                    <td colspan="10">There are no data.</td>
                </tr>
            @endif
                                    </tbody>
                    </table>
                    {!! $client->links() !!}


                  </div>
                </div>
              </div>
            </div>
        </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
     <script>


      $(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0 ;
        var client_id = $(this).data('user_id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/admin/client/changestatus',
            data: {'status': status, 'client_id': client_id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  });

      </script>

@endsection
