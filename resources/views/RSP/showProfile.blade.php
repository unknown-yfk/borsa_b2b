


@extends('layouts.mainlayout')
@section('content')



<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">

            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{__('messages.Profile')}}</h4>
                  {{-- <form class="form-sample" action="/admin/create/user/post" method="POST" enctype="multipart/form-data"> --}}
                    @csrf
                    <p class="card-description">
                      User info
                    </p>
                                    <div class="row mt-2">
                                        @foreach ($rspProfile as $profile)
                                            <div class="col-md-6">
                                                <img src="../../assets/users_img/{{ Auth::user()->userPhoto }}"
                                                    class="rounded-circle shadow-4-strong"
                                                    alt="{{ Auth::user()->userName }}" width="100rem" height="100rem">
                                            </div>
                                            <div class="col-md-6"><label class="labels"><strong>First
                                                        Name</strong></label>
                                                <p class="form-control">{{ $profile->firstName }}</p>
                                            </div>
                                            <div class="col-md-6"><label class="labels"><strong>Middle
                                                        Name</strong></label>
                                                <p class="form-control">{{ $profile->middleName }}</p>
                                            </div>
                                            <div class="col-md-6"><label class="labels"><strong>Last
                                                        Name</strong></label>
                                                <p class="form-control">{{ $profile->lastName }}</p>
                                            </div>
                                            <div class="col-md-6"><label class="labels"><strong>User
                                                        Name</strong></label>
                                                <p class="form-control">{{ $profile->userName }}</p>
                                            </div>


                                            <div class="col-md-6"><label class="labels"><strong>Email</strong></label>
                                                <p class="form-control">{{ $profile->email }}</p>
                                            </div>
                                            <div class="col-md-6"><label class="labels"><strong>Resident
                                                        Address</strong></label>
                                                <p class="form-control">{{ $profile->address }}</p>
                                            </div>


                                            <div class="col-md-6"><label class="labels"><strong>Phone
                                                        Number</strong></label>
                                                <p class="form-control">{{ $profile->mobile }}</p>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="labels"><strong>Your ID</strong></label>
                                                <img src="../../assets/gov_img/{{ $profile->id_filepath }}"
                                                    class="rounded float-start" alt="{{ $profile->id_file_path }}"
                                                    width="200rem" height="200rem">

                                            </div>
                                            <div class="col-md-6"><label class="labels"><strong>ID Type</strong></label>
                                                <p class="form-control">{{ $profile->ID_type }}</p>
                                            </div>
                                            <div class="col-md-6"><label class="labels"><strong>ID
                                                        Number</strong></label>
                                                <p class="form-control">{{ $profile->ID_number }}</p>
                                            </div>
                                            <div class="col-md-6"><label class="labels"><strong>ID Issue
                                                        Date</strong></label>
                                                <p class="form-control">{{ $profile->ID_issue_date }}</p>
                                            </div>
                                            <div class="col-md-6"><label class="labels"><strong>ID Expiry
                                                        Date</strong></label>
                                                <p class="form-control">{{ $profile->ID_expiry_date }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                  <div class="row mt-2">
                                    <center><a href="/rsp/update/edit"><button class="btn btn-primary">Update</button></a></center>
                                   </div>
                                </div>
                            </div>
                        </div>
            </main>
        </div>
</div>







@endsection
