
@extends('layouts.mainlayout')
@section('content')
 @include('sweetalert::alert')
<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">

            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{__('Edit Profile')}}</h4>

                     <p class="card-description">
                  <code> Edit your Profile Here!</code>
                  </p>
                              <form action="/rom/update/edits" method="POST"
                                                enctype="multipart/form-data">

                                        @foreach ($romProfile as $profile)
                                            @csrf
                                            @method('PUT')
                                            <div class="col-md-12">
                                                <img src="../../assets/users_img/{{ Auth::user()->userPhoto }}"
                                                    class="rounded float-start" alt="{{ Auth::user()->userName }}"
                                                    width="100rem" height="100rem">
                                                <input type="file"
                                                    class="form-control @error('userPhoto') is-invalid @enderror"
                                                    id="userPhoto" name="userPhoto">
                                                <input type="hidden" value="{{ Auth::user()->userPhoto }}"
                                                    id="userPhoto_recover" name="userPhoto_recover">
                                                @error('userPhoto')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6 mt-6"><label class="labels"><strong> First
                                                    Name</strong></label>
                                            <input type="text"
                                                class="form-control  @error('firstName') is-invalid @enderror"
                                                placeholder="First Name" id="firstName" name="firstName"
                                                value="{{ $profile->firstName }}" required>
                                            @error('firstName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6"><label class="labels"><strong>Middle Name</strong></label>
                                            <input type="text"
                                                class="form-control @error('middleName') is-invalid @enderror"
                                                placeholder="Middle Name" id="middleName" name="middleName"
                                                value="{{ $profile->middleName }}"required>
                                            @error('middleName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6"><label class="labels"><strong>Last Name</strong></label>
                                            <input type="text"
                                                class="form-control   @error('lastName') is-invalid @enderror"
                                                placeholder="Last Name" id="lastName" name="lastName"
                                                value="{{ $profile->lastName }}"required>
                                            @error('lastName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6"><label class="labels"><strong>User Name</strong></label>
                                            <input type="text"
                                                class="form-control   @error('userName') is-invalid @enderror"
                                                placeholder="User Name" id="userName" name="userName"
                                                value="{{ $profile->userName }}"required>
                                            @error('userName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6"><label class="labels"><strong>E-mail</strong></label>
                                            <input type="email"
                                                class="form-control   @error('email') is-invalid @enderror"
                                                placeholder="" id="email" name="email"
                                                value="{{ $profile->email }}"required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6"> <label class="labels"><strong>Address</strong> </label>
                                            <input type="text"
                                                class="form-control floating form-control @error('address') is-invalid @enderror"
                                                name="address" id="pac-input" tabindex="10" value="{{$profile->address}}">
                                            <div id="map">
                                            </div>
                                            <div id="infowindow-content">
                                                <span id="place-name" class="title"></span><br />
                                                <span id="place-address"></span>
                                            </div>
                                            <input name="lng" id="pac-role" type="hidden" value="{{$profile->longtude}}">
                                            <input name="lat" id="pac-lan" type="hidden" value="{{$profile->latitude}}">
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6"><label class="labels"><strong>Mobile</strong></label>
                                            <input type="text"
                                                class="form-control   @error('mobile') is-invalid @enderror"
                                                placeholder="Phone number" id="mobile" name="mobile"
                                                value="{{ $profile->mobile }}"required>
                                            @error('mobile')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

<div class="col-md-6">
    <label><strong>Key Distributor</strong></label>
    <select id="kd" name="kd" class="form-control @error('kd') is-invalid @enderror" required>
        <option value=""></option>
        @foreach ($key_distro as $kd)
            <option value="{{ $kd->user_id }}" {{ $kd->user_id == $profile->kd_id? 'selected' : '' }}>
                {{ $kd->firstName }} {{ $kd->middleName }} {{ $kd->lastName }}
            </option>
        @endforeach
    </select>
    @error('kd')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12"><label class="labels"><strong>Your ID</strong></label>
                                            <img src="../../assets/gov_img/{{ $profile->id_filepath }}"
                                                class="rounded float-start" alt="{{ $profile->id_file_path }}"
                                                width="100rem" height="100rem">
                                            <input type="file"
                                                class="form-control  @error('id_path') is-invalid @enderror"
                                                value="" placeholder="" id="id_path" name="id_path">
                                            <input type="hidden" name="id_path_recover"
                                                value="{{ $profile->id_filepath }}">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6"><label class="labels"><strong>ID type</strong></label>
                                            <select id="idType" name="idType"
                                                class="form-control @error('idType') is-invalid @enderror" required>
                                                <option value=""></option>
                                                @foreach ($idType as $idType)
                                                    <option value="{{ $idType->idTypeName }}"
                                                        {{ $profile->ID_type === $idType->idTypeName ? 'selected' : '' }}>
                                                        {{ $idType->idTypeName }}</option>
                                                @endforeach
                                            </select>
                                            @error('idType')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="col-md-6"><label class="labels"><strong>ID Number</strong></label>
                                            <input type="text"
                                                class="form-control  @error('ID_number') is-invalid @enderror"
                                                value="{{ $profile->ID_number }}" placeholder="id number"
                                                id="ID_number" name="ID_number"required>
                                            @error('ID_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6"><label class="labels"><strong>ID Issue Date
                                                </strong></label>
                                            <input type="date"
                                                class="form-control  @error('ID_issue_date') is-invalid @enderror"
                                                value={{ $profile->ID_issue_date }} placeholder="" id="ID_issue_date"
                                                name="ID_issue_date"required>
                                            @error('ID_issue_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6"><label class="labels"><strong>ID Expiry Date
                                                </strong></label>
                                            <input type="date"
                                                class="form-control  @error('ID_expiry_date') is-invalid @enderror"
                                                value={{ $profile->ID_expiry_date }} placeholder="when will it expire"
                                                id="ID_expiry_date" name="ID_expiry_date" required>
                                            @error('ID_expiry_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <br>
                                        <br><br>
                                        <input type="submit" class="form-control btn btn-outline-success mt-4"
                                            value="Submit">
                                        @endforeach
                                    </div>
                                    </form>

                </div>


            </div>
        </div>
    </div>

</div>
</div>
@endsection
