


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
                                        @foreach ($agentProfile as $profile)
                                            <div class="col-md-6">
                                                <img src="../../assets/users_img/{{ Auth::user()->userPhoto }}"
                                                    class="rounded-circle shadow-4-strong"
                                                    alt="{{ Auth::user()->userName }}" width="100rem" height="100rem">

                                            </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6"><label class="labels"><strong> First Name</strong></label>
                                            <p class="form-control">{{ $profile->firstName }}</p>
                                        </div>
                                        <div class="col-md-6"><label class="labels"><strong>Middle Name</strong></label>
                                            <p class="form-control">{{ $profile->middleName }}</p>
                                        </div>
                                        <div class="col-md-6"><label class="labels"><strong>Last Name</strong></label>
                                            <p class="form-control">{{ $profile->lastName }}</p>
                                        </div>
                                        <div class="col-md-6"><label class="labels"><strong>ROM</strong></label>
                                            <p class="form-control">{{Helper::get_rom_name($profile->rom_id)}}</p>
                                        </div>
                                        <div class="col-md-6"><label class="labels"><strong>User Name</strong></label>
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
                                            <label class="labels"><strong>Goverment ID</strong></label>
                                            <img src="../../assets/gov_img/{{ $profile->id_file_path }}"
                                                class="rounded float-start" alt="{{ $profile->id_file_path }}"
                                                width="100rem" height="100rem">

                                        </div>
                                        <div class="col-md-6"><label class="labels"><strong>ID type</strong></label>
                                            <p class="form-control">{{ $profile->ID_type }}</p>
                                        </div>
                                        <div class="col-md-6"><label class="labels"><strong>ID number</strong></label>
                                            <p class="form-control">{{ $profile->ID_number }}</p>
                                        </div>
                                        <div class="col-md-6"><label class="labels"><strong>ID issue
                                                    date</strong></label>
                                            <p class="form-control">{{ $profile->ID_issue_date->format('y-m-d') }}</p>
                                        </div>




                                        <div class="col-md-6"><label class="labels"><strong>ID expiry
                                                    date</strong></label>
                                            <p class="form-control">{{ $profile->ID_expiry_date->format('y-m-d') }}</p>
                                        </div>
                                        <div class="col-md-6"><label class="labels"><strong>Business
                                                    Name</strong></label>
                                            <p class="form-control">{{ $profile->businessName }}</p>
                                        </div>
                                        <div class="col-md-6"><label class="labels"><strong>Buisness
                                                    Type</strong></label>
                                            <p class="form-control">{{ $profile->businessType }}</p>
                                        </div>
                                        <div class="col-md-6"><label class="labels"><strong>Busienss
                                                    Address</strong></label>
                                            <p class="form-control">{{ $profile->businessAddress }}</p>
                                        </div>
                                        <div class="col-md-6"><label class="labels"><strong>Buisness Licence
                                                    Number</strong></label>
                                            <p class="form-control">{{ $profile->licenceNumber }}</p>
                                        </div>
                                        <div class="col-md-6"><label class="labels"><strong>issue date</strong></label>
                                            <p class="form-control">{{ $profile->issueDate }}</p>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="labels"><strong>Buisness Licence</strong></label>
                                            <img src="../../assets/licences_img/{{ $profile->licenceFilePath }}"
                                                class="rounded float-start" alt="{{ Auth::user()->userName }}"
                                                width="100rem" height="100rem">

                                        </div>
                                        <div class="col-md-6"><label class="labels"><strong>expiry date</strong></label>
                                            <p class="form-control">{{ $profile->expiryDate }}</p>
                                        </div>
                                        <div class="col-md-6"><label class="labels"><strong>Tin Number</strong></label>
                                            <p class="form-control">{{ $profile->tinNumber }}</p>
                                        </div>
                                        <div class="col-md-6"><label class="labels"><strong>Business establishment
                                                    year</strong></label>
                                            <p class="form-control">{{ $profile->businessEstablishmentYear }}</p>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="row mt-2">
                                        <center><a href="/agent/update/edit"><button
                                                    class="btn btn-primary">Update</button></a></center>
                                   </div>
                                </div>
                            </div>
                        </div>
            </main>
        </div>
</div>







@endsection
