
  @extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">

                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ __('User Profile Update') }}</h4>

                            <p class="card-description">
                                <code> Change Your Information and Click Submit !!</code>
                            </p>
                    <form action="{{url('/admin/editeduserStore',$user->id)}}" method= "POST" enctype="multipart/form-data"></center>

                    @csrf
                    {{-- @method('PUT') --}}
                       <div class="col-md-12">
                        {{-- <label class="labels"><strong>User Photo</strong></label>
                        <img src="../../assets/user_img/{{Auth::user()->userPhoto}}" class="rounded float-start" alt="{{ Auth::user()->userName }}" width="100rem" height="100rem">
                        <input type="file" class="form-control @error('userPhoto') is-invalid @enderror" id="userPhoto" name="userPhoto">
                        <input type="hidden" value="{{Auth::user()->userPhoto}}" id="userPhoto_recover" name="userPhoto_recover">
                        @error('userPhoto')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div> --}}
                    </div>
                     <div class="row mt-2">
                        <div class="col-md-6 mt-6"><label class="labels"><strong> First Name</strong></label>
                        <input type="text" class="form-control  @error('firstName') is-invalid @enderror" placeholder="First Name" id="firstName" name="firstName"  value="{{$user->firstName}}" required>
                          @error('firstName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6"><label class="labels"><strong>Middle Name</strong></label>
                        <input type="text" class="form-control @error('middleName') is-invalid @enderror"  placeholder="Middle Name" id="middleName" name="middleName"  value="{{$user->middleName }}"required>
                            @error('middleName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6"><label class="labels"><strong>Last Name</strong></label>
                        <input type="text" class="form-control   @error('lastName') is-invalid @enderror" placeholder="Last Name" id="lastName" name="lastName"  value="{{$user->lastName }}"required>
                        @error('lastName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                        <div class="col-md-6"><label class="labels"><strong>User Name</strong></label>
                        <input type="text" class="form-control   @error('userName') is-invalid @enderror" placeholder="User Name" id="userName" name="userName"  value="{{$user->userName}}"required>
                        @error('userName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                        <div class="col-md-6"><label class="labels"><strong>E-mail</strong></label>
                        <input type="email" class="form-control   @error('email') is-invalid @enderror" placeholder="" id="email" name="email"  value="{{$user->email }}"required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>

                        {{-- <div class="col-md-6"><label class="labels"><strong>Address</strong></label>
                        <input type="address" class="form-control @error('address') is-invalid @enderror" placeholder="your home address" id="address" name="address" value="{{$user->address }}"required>
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                        <div class="col-md-6"><label class="labels"><strong>Mobile</strong></label>
                        <input type="text" class="form-control   @error('mobile') is-invalid @enderror"  placeholder="Phone number" id="mobile" name="mobile" value="{{$user->mobile }}"required>
                        @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                     </div> --}}
                     {{-- <div class="row mt-2">
                    <div class="col-md-12"><label class="labels"><strong>Goverment ID</strong></label>
                         <img src="../../assets/gov_img/{{$profile->id_file_path}}" class="rounded float-start" alt="{{ $user->id_file_path }}" width="100rem" height="100rem">
                        <input type="file" class="form-control  @error('id_path') is-invalid @enderror" value="" placeholder="" id="id_path" name="id_path">
                        <input type="hidden" name="id_path_recover" value="{{$profile->id_file_path}}">
                    </div>
                     </div>
                      {{-- <div class="row mt-2">
                        <div class="col-md-6"><label class="labels"><strong>ID type</strong></label>
                            <select id="idType" name="idType" class="form-control @error('idType') is-invalid @enderror" required>
                                <option value=""></option>
                                @foreach ( $idType as $idType)
                                <option value="{{$idType->idTypeName}}" {{ Auth::user()->id_file_path === $idType->idTypeName ? 'selected' : '' }}>{{ $idType->idTypeName}}</option>
                                @endforeach
                            </select>
                              @error('idType')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                    </div>
                        <div class="col-md-6"><label class="labels"><strong>ID number </strong></label>
                        <input type="text" class="form-control  @error('ID_number') is-invalid @enderror" value="{{$profile->ID_number }}" placeholder="id number" id="ID_number" name="ID_number"required>
                                 @error('ID_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                        <div class="col-md-6"><label class="labels"><strong>ID Issue Date </strong></label>
                        <input type="date" class="form-control  @error('ID_issue_date') is-invalid @enderror" value={{$profile->ID_issue_date}} placeholder="" id="ID_issue_date" name="ID_issue_date"required>
                                 @error('ID_issue_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                        <div class="col-md-6"><label class="labels"><strong>ID Expiry Date </strong></label>
                        <input type="date" class= "form-control  @error('ID_expiry_date') is-invalid @enderror" value={{$profile->ID_expiry_date}} placeholder="when will it expire" id= "ID_expiry_date" name= "ID_expiry_date"required>
                                 @error('ID_expiry_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                        <div class="col-md-6"><label class="labels"><strong>Business Name </strong></label>
                        <input type="text" class="form-control   @error('businessName') is-invalid @enderror" value="{{$profile->businessName }}" placeholder="business name" id="businessName" name="businessName"required>
                                 @error('businessName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                     <div class="col-md-6"><label class="labels"><strong>Business Type</strong></label>
                            <select id="businessType" name="businessType" class="form-control @error('businessType') is-invalid @enderror" required>
                                <option value=""></option>
                                @foreach ( $businessType as $businessType)
                                <option value="{{$businessType->businessName}}" {{$profile->businessType === $businessType->businessName ? 'selected' : '' }}>{{ $businessType->businessName}}</option>
                                @endforeach
                            </select>
                             @error('businessType')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6"> <label class="labels"><strong>Business Address </strong></label>
                         <input type="text" class="form-control floating  @error('businessAddress') is-invalid @enderror" name="businessAddress" id="pac-input" tabindex="10" value="{{$profile->businessAddress }}"required>
                            <div id="map"></div>
                            <div id="infowindow-content">
                                <span id="place-name" class="title"></span><br />
                                <span id="place-address"></span>
                            </div>
                            <input name="lng" id="pac-role" type="hidden">
                            <input name="lat" id="pac-lan" type="hidden">
                            @error('businessAddress')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                     </div>
                      <div class="col-md-12">
                          <label class="labels"><strong>Buisness Licence</strong></label>
                         <img src="../../assets/licences_img/{{$profile->licenceFilePath}}" class="rounded float-start" alt="{{ Auth::user()->userName }}" width="100rem" height="100rem">
                         <input type="file" class="form-control   @error('licenceFilePath') is-invalid @enderror" value="" placeholder="" id="licenceFilePath" name="licenceFilePath">
                        <input type="hidden" id="$request->licenceFilePath_recover" name="licenceFilePath_recover" value="{{$profile->licenceFilePath}}">
                        @error('licenceFilePath')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                     <div class="row mt-2">
                        <div class="col-md-6"><label class="labels"><strong>Licence Number </strong> </label>
                        <input type="text" class="form-control   @error('licenceNumber') is-invalid @enderror" value="{{$profile->licenceNumber }}" placeholder="licence number" id="licenceNumber" name="licenceNumber"required>
                        @error('licenceNumber')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                        <div class="col-md-6"><label class="labels"><strong>Licence Issue Date </strong></label>
                        <input type="date" class="form-control   @error('issueDate') is-invalid @enderror" value="{{$profile->issueDate}}" placeholder="" id="issueDate" name="issueDate"required>
                        @error('issueDate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                        <div class="col-md-6"><label class="labels"><strong>Licence Expiry Date </strong> </label>
                        <input type="date" class="form-control   @error('expiryDate') is-invalid @enderror" value="{{$profile->expiryDate}}" placeholder="" id="expiryDate" name="expiryDate"required>
                        @error('expiryDate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                        <div class="col-md-6"><label class="labels"><strong>Tin Number</strong></label>
                        <input type="text" class="form-control   @error('tinNumber') is-invalid @enderror" value="{{$profile->tinNumber }}" placeholder="You Goverment Issued Tin Number" id="tinNumber" name="tinNumber"required>
                        @error('tinNumber')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                        <div class="col-md-6"><label class="labels"><strong>Buisness Established At</strong></label>
                        <input type="text" class="form-control   @error('businessEstablishmentYear') is-invalid @enderror" value="{{$profile->businessEstablishmentYear }}" placeholder="eg: 2002" id="businessEstablishmentYear" name="businessEstablishmentYear"required>
                        @error('businessEstablishmentYear')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div> <br> --}}
                        <br><br>
                        <input type="submit" class="form-control btn btn-outline-success mt-4" value="Submit">
                        <input type="reset" class="form-control btn btn-outline-danger mt-4" value="Clear"></div>
                        {{-- @endforeach --}}
                    </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>
@endsection
