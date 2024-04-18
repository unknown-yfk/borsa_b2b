@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                {{-- <div class="col-md-6 grid-margin stretch-card">
              <div class="card">

              </div>
            </div> --}}
                {{-- <div class="col-md-6 grid-margin stretch-card"> --}}

                {{-- </div> --}}

                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ __('messages.ClientRegisteration') }}</h4>
                            <form class="form-sample" action="/admin/create/posts" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="py-1 my-2 text-light" style="background-color:#123c69;">
                                    <p class="card-description text-light ml-4">
                                    <h6 class="pl-2">PERSONAL INFORMATION</h6>
                                    </p>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label><strong>First Name</strong></label>
                                            <div class="col-sm-9">
                                                <input type="text"
                                                    class="form-control  @error('firstName') is-invalid @enderror"
                                                    id="firstName" name="firstName" value="{{ old('firstName') }}"required>
                                                @error('firstName')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label><strong>Middle Name</strong></label>
                                            <div class="col-sm-9">
                                                <input type="text"
                                                    class="form-control  @error('middleName') is-invalid @enderror"
                                                    id="middleName" name="middleName" value="{{ old('middleName') }}"
                                                    required>

                                                @error('middleName')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label><strong>Last Name</strong></label>
                                            <div class="col-sm-9">
                                                <input type="text"
                                                    class="form-control  @error('lastName') is-invalid @enderror"
                                                    id="lastName" name="lastName" value="{{ old('lastName') }}" required>
                                                @error('lastName')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>





                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label><strong>Mother's full name</strong></label>
                                            <div class="col-sm-9">
                                                <input type="text"
                                                    class="form-control  @error('Mother_name') is-invalid @enderror"
                                                    id="Mother_name" name="Mother_name"
                                                    value="{{ old('Mother_name') }}">
                                                @error('Mother_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label><strong>Gender</strong></label>
                                            <div class="col-sm-9">
                                                <select id="Gender" name="Gender"
                                                    class="form-control @error('Gender') is-invalid @enderror">
                                                    <option value=""></option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>



                                                </select>
                                                @error('Gender')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label><strong>Date of birth</strong></label>
                                            <div class="col-sm-9">
                                                <input type="date"
                                                    class="form-control  @error('birthdate') is-invalid @enderror"
                                                    id="birthdate" name="birthdate" value="{{ old('birthdate') }}"
                                                    >
                                                @error('birthdate')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label><strong>Age</strong></label>
                                            <div class="col-sm-9">
                                                <input type="number"
                                                    class="form-control  @error('age') is-invalid @enderror" id="age"
                                                    name="age" value="{{ old('age') }}">
                                                @error('age')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label><strong>Type of Mobile</strong></label>
                                            <div class="col-sm-9">
                                                <select id="PhoneType" name="PhoneType"
                                                    class="form-control @error('PhoneType') is-invalid @enderror">
                                                    <option value=""></option>
                                                    <option value="Keypad">Keypad</option>
                                                    <option value="Smart">Smart</option>
                                                </select>
                                                @error('PhoneType')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-md-4">
                                        <div class="form-group row">
                                            <label><strong>Mobile Number</strong></label>
                                            <div class="col-sm-9">

                                                <input type="text"
                                                    class="form-control  @error('client_mobile') is-invalid @enderror"
                                                    id="client_mobile_phone" name="client_mobile_phone"
                                                    value="{{ old('client_mobile_phone') }}">
                                                @error('client_mobile')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label><strong>Alternative mobile number</strong></label>
                                            <div class="col-sm-9">
                                                <input type="tel"
                                                    class="form-control  @error('Alternative_Phone_Number') is-invalid @enderror"
                                                    id="Alternative_Phone_Number" name="Alternative_Phone_Number"
                                                    value="{{ old('Alternative_Phone_Number') }}" >

                                                @error('Alternative_Phone_Number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label><strong>Nationality</strong></label>
                                            <div class="col-sm-9">
                                                <input type="text"
                                                    class="form-control  @error('Nationality') is-invalid @enderror"
                                                    id="Nationality" name="Nationality"
                                                    value="{{ old('Nationality') }}">
                                                @error('Nationality')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label><strong>Family Size</strong></label>
                                            <div class="col-sm-9">
                                                <input type="number"
                                                    class="form-control  @error('FamilySize') is-invalid @enderror"
                                                    id="FamilySize" name="FamilySize" value="{{ old('FamilySize') }}"
                                                    >
                                                @error('FamilySize')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{-- </div> --}}

                                </div>

                                <div class="row">

                                  
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label><strong>Number of children</strong></label>
                                            <div class="col-sm-9">
                                                <input type="number"
                                                    class="form-control  @error('nochild') is-invalid @enderror"
                                                    id="nochild" name="nochild" value="{{ old('nochild') }}" >
                                                @error('nochild')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label><strong>Number of children in school</strong></label>
                                            <div class="col-sm-9">
                                                <input type="number"
                                                    class="form-control  @error('child_in_school') is-invalid @enderror"
                                                    id="child_in_school" name="child_in_school"
                                                    value="{{ old('child_in_school') }}">
                                            </div>
                                        </div>
                                    </div>


                                    {{-- </div> --}}

                                </div>


                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label><strong>Number of children under the age 2 years</strong></label>
                                            <div class="col-sm-9">
                                                <input type="number"
                                                    class="form-control  @error('child_in_school_under2') is-invalid @enderror"
                                                    id="child_in_school_under2" name="child_in_school_under2"
                                                    value="{{ old('child_in_school_under2') }}">
                                                @error('child_in_school_under2')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <strong><label> Marital Status </label></strong>
                                            <div class="col-sm-9">
                                                <select id="Marital_Status" name="Marital_Status"
                                                    class="form-control @error('Marital_Status') is-invalid @enderror">
                                                    <option value=""></option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widowed">Widowed</option>
                                                    <option value="Divorce">Divorce</option>

                                                </select>
                                                @error('Marital_Status')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label><strong> User Name</strong></label>
                                            <div class="col-sm-9">

                                                <input type="text"
                                                    class="form-control  @error('userName') is-invalid @enderror"
                                                    id="userName" name="userName"
                                                    value="{{ old('userName') }}"required>
                                                @error('userName')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">



                                        {{-- </div> --}}

                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <strong><label> Photo </label></strong>
                                                <div class="col-sm-9">
                                                    <input type="file"
                                                        class="form-control  @error('Photo') is-invalid @enderror"
                                                        id="Photo" name="Photo" value="{{ old('Photo') }}"
                                                        >

                                                    @error('Photo')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="py-1 my-2 text-light" style="background-color:#123c69;">
                                        <p class="card-description text-light ml-4">
                                        <h6 class="pl-2">ADDRESS DETAIL </h6>
                                        </p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Country </strong></label>
                                                <div class="col-sm-9">



                                                    <input type="text"
                                                        class="form-control  @error('Country') is-invalid @enderror"
                                                        id="Country" name="Country"
                                                        value="{{ old('Country') }}"required>
                                                    @error('Country')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <strong><label for="Region">Region</label></strong>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="Region" name="Region" required
                                                        onchange="getCityOptions()">
                                                        <option value="">Select Region</option>
                                                        @foreach ($regions as $region)
                                                            <option value="{{ $region->name }}">{{ $region->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('Region')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <strong><label for="City">City</label></strong>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="City" name="City" required>
                                                        <option value="">Select City</option>
                                                          @foreach ($cities as $city)
                                                            <option value="{{ $city->name }}">{{ $city->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('City')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Camp </strong></label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control  @error('camp') is-invalid @enderror"
                                                        id="camp" name="camp"
                                                        value="{{ old('camp') }}">
                                                    @error('camp')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Zone/Woreda</strong></label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control  @error('zone') is-invalid @enderror"
                                                        id="zone" name="zone"
                                                        value="{{ old('Region') }}">
                                                    @error('zone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <strong><label> Block/Kebele </label></strong>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control  @error('kebele') is-invalid @enderror"
                                                        id="kebele" name="kebele"
                                                        value="{{ old('kebele') }}">
                                                    @error('kebele')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        {{-- </div> --}}
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong> House Number</strong></label>
                                                <div class="col-sm-9">

                                                    <input type="text"
                                                        class="form-control  @error('house_number') is-invalid @enderror"
                                                        id="house_number" name="house_number"
                                                        value="{{ old('house_number') }}">
                                                    @error('house_number')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="py-1 my-2 text-light" style="background-color:#123c69;">
                                        <p class="card-description text-light ml-4">
                                        <h6 class="pl-2">IDENTIFICATION</h6>
                                        </p>
                                    </div>



                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>ID type</strong></label>
                                                <div class="col-sm-9">
                                                    <select id="idType" name="ID_type"
                                                        class="form-control @error('idType') is-invalid @enderror">
                                                        <option value=""></option>
                                                        @foreach ($idType as $idType)
                                                            <option value="{{ $idType->idTypeName }}">
                                                                {{ $idType->idTypeName }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('idType')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong> Do you have UNHCR ID</strong></label>
                                                <div class="col-sm-9">
                                                    <select id="unhcr_id" name="unhcr_id"
                                                        class="form-control @error('unhcr_id') is-invalid @enderror">
                                                        <option value=""></option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>

                                                    </select>
                                                    @error('unhcr_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <strong><label> ID Number </label></strong>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control  @error('ID_Number ') is-invalid @enderror"
                                                        id="ID_Number" name="ID_Number"
                                                        value="{{ old('ID_Number') }}">
                                                    @error('ID_Number')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        {{-- </div> --}}
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong> ID issue date</strong></label>
                                                <div class="col-sm-9">

                                                    <input type="date"
                                                        class="form-control  @error('ID_issue_date') is-invalid @enderror"
                                                        id="ID_issue_date" name="ID_issue_date"
                                                        value="{{ old('ID_issue_date') }}">
                                                    @error('ID_issue_date')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>{{ __('ID expiry Date') }}</strong></label>
                                                <div class="col-sm-9">

                                                    <input type="date"
                                                        class="form-control  @error('ID_expiry_Date') is-invalid @enderror"
                                                        id="ID_expiry_Date" name="ID_expiry_Date"
                                                        value="{{ old('ID_expiry_Date') }}">
                                                    @error('ID_expiry_Date')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <input type="hidden" value="client" name="userType">

                                    <div class="row">

                                        <div class="col-md-4">
                                            {{-- <div class="form-group row">
                                            <label><strong>{{ __('Mobile') }}</strong></label>
                                            <div class="col-sm-9">
                                                <input type="text"
                                                    class="form-control  @error('mobile') is-invalid @enderror"
                                                    id="mobile" name="mobile" value="{{ old('mobile') }}">
                                                @error('mobile')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> --}}
                                        </div>
                                    </div>

                                    <div class="py-1 my-2 text-light" style="background-color:#123c69;">
                                        <p class="card-description text-light ml-4">
                                        <h6 class="pl-2"> EXISTING BUSINESS DETAIL</h6>
                                        </p>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Business Name</strong></label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control  @error('client_businessName') is-invalid @enderror"
                                                        id="client_businessName" name="client_business_Name"
                                                        value="{{ old('client_businessName') }}">
                                                    @error('client_businessName')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Business Type</strong></label>
                                                <div class="col-sm-9">
                                                    <select id="client_businessType" name="client_business_Type"
                                                        class="form-control @error('client_businessType') is-invalid @enderror">
                                                        <option value=""></option>
                                                        @foreach ($businessType as $businessType)
                                                            <option value="{{ $businessType->businessName }}">
                                                                {{ $businessType->businessName }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('client_businessType')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Business Address:</strong></label>
                                                <label><strong>Camp</strong></label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control  @error('businesscamp') is-invalid @enderror"
                                                        id="businesscamp" name="businesscamp"
                                                        value="{{ old('businesscamp') }}">
                                                    @error('businesscamp')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Zone</strong></label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control  @error('businesszone') is-invalid @enderror"
                                                        id="businesszone" name="businesszone"
                                                        value="{{ old('businesszone') }}">
                                                    @error('businesszone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Business Registration Number (if any)</strong></label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control  @error('businessRegisteration') is-invalid @enderror"
                                                        id="businessRegisteration" name="businessRegisteration"
                                                        value="{{ old('businessRegisteration') }}">
                                                    @error('businessRegisteration')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    {{--
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label><strong>{{ __('messages.IdType') }}</strong></label>
                                            <div class="col-sm-9"> --}}
                                    {{-- <select id="idType" name="idType"
                                                    class="form-control @error('idType') is-invalid @enderror">
                                                    <option value=""></option>
                                                    @foreach ($idType as $idType)
                                                        <option value="{{ $idType->idTypeName }}">
                                                            {{ $idType->idTypeName }}</option>
                                                    @endforeach
                                                </select>
                                                @error('idType')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror --}}
                                    {{-- </div>
                                        </div>
                                    </div>

                                </div> --}}


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>TIN Number</strong></label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control  @error('Tin_number') is-invalid @enderror"
                                                        id="Tin_number" name="Tin_number"
                                                        value="{{ old('Tin_number') }}">
                                                    @error('Tin_number')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>License number</strong></label>
                                                <div class="col-sm-9">
                                                    <input type="number"
                                                        class="form-control  @error('License_number') is-invalid @enderror"
                                                        id="License_number" name="License_number"
                                                        value="{{ old('License_number') }}">
                                                    @error('License_number')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Distance from KD</strong></label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control  @error('Distance_from_KD') is-invalid @enderror"
                                                        id="Distance_from_KD" name="Distance_from_KD"
                                                        value="{{ old('Distance_from_KD') }}">
                                                    @error('Distance_from_KD')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Establishment Date</strong></label>
                                                <div class="col-sm-9">
                                                    <input type="date"
                                                        class="form-control  @error('establishment_date') is-invalid @enderror"
                                                        id="establishment_date" name="establishment_date"
                                                        value="{{ old('establishment_date') }}">
                                                    @error('establishment_date')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Key Distributor</strong></label>
                                                <div class="col-sm-9">
                                                    <select id="kd" name="kd"
                                                        class="form-control  @error('kd') is-invalid @enderror" required>
                                                        <option value=""></option>
                                                        @foreach ($key_distro as $kd)
                                                            <option value="{{ $kd->user_id }}"> {{ $kd->firstName }}
                                                                {{ $kd->middleName }} {{ $kd->lastName }}
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
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Agent</strong></label>
                                                <div class="col-sm-9">
                                                    <select id="agent_id" name="agent_id"
                                                        class="form-control  @error('agent_id') is-invalid @enderror"
                                                        required>
                                                        <option value=""></option>
                                                        @foreach ($agents as $agent)
                                                            <option value="{{ $agent->user_id }}">
                                                                {{ $agent->firstName }}
                                                                {{ $agent->middleName }} {{ $agent->lastName }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('agent')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label><strong>{{ __('messages.IdType') }}</strong></label>
                                            <div class="col-sm-9"> --}}
                                    {{-- <select id="idType" name="idType"
                                                    class="form-control @error('idType') is-invalid @enderror">
                                                    <option value=""></option>
                                                    @foreach ($idType as $idType)
                                                        <option value="{{ $idType->idTypeName }}">
                                                            {{ $idType->idTypeName }}</option>
                                                    @endforeach
                                                </select>
                                                @error('idType')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror --}}
                                    {{-- </div>
                                        </div>
                                    </div>

                                </div> --}}










                                    {{--

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label><strong>Business Registeration</strong></label>
                                            <div class="col-sm-9">
                                                <input type="text"
                                                    class="form-control  @error('businessRegisteration') is-invalid @enderror"
                                                    id="businessRegisteration" name="businessRegisteration"
                                                    value="{{ old('businessRegisteration') }}">
                                                @error('businessRegisteration')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label><strong>The Year Your business
                                                    established</strong></label>
                                            <div class="col-sm-9">
                                                <input type="text"
                                                    class="form-control  @error('businessEstablishmentYear') is-invalid @enderror"
                                                    id="businessEstablishmentYear" name="businessEstablishmentYear"
                                                    value="{{ old('businessEstablishmentYear') }}">
                                                @error('businessEstablishmentYear')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Status</strong></label>
                                                <div class="col-sm-9">
                                                    <select id="status" name="status"
                                                        class="form form-control  @error('status') is-invalid @enderror"
                                                        required>
                                                        <option value=""></option>
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                    @error('status')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <br>

                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Password</strong></label>
                                                <div class="col-sm-9">

                                                    <input id="password" type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password" required autocomplete="off">

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Work permit </strong></label>
                                                <div class="col-sm-9">
                                                    <select id="workpermit" name="workpermit"
                                                        class="form form-control  @error('workpermit') is-invalid @enderror"
                                                        required>
                                                        <option value=""></option>
                                                        <option value="yes">Yes</option>
                                                        <option value="no">No</option>
                                                    </select>
                                                    @error('workpermit')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <br>

                                        </div>


                                    </div>


                                    <div class="py-1 my-2 text-light" style="background-color:#123c69;">
                                        <p class="card-description text-light ml-4">
                                        <h6 class="pl-2"> FINANCE</h6>
                                        </p>
                                    </div>





                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Bank Account(if any)</strong></label>
                                                <div class="col-sm-9">
                                                    <select id="Bank_Account" name="Bank_Account"
                                                        class="form-control @error('Bank_Account') is-invalid @enderror">
                                                        <option value=""></option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                    @error('Bank_Account')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Bank Name </strong></label>
                                                <div class="col-sm-9">

                                                    <select id="Bank_name" name="Bank_name"
                                                        class="form-control @error('Bank_name') is-invalid @enderror">
                                                        <option value=""></option>
                                                        <option value="CBE Birr">CBE Birr</option>
                                                        <option value="Hibret Bank">Hibret Bank</option>
                                                        <option value="Amhara Bank">Amhara Bank</option>
                                                    </select>
                                                    @error('Bank_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Bank Account Number</strong></label>
                                                <div class="col-sm-9">
                                                    <input type="number"
                                                        class="form-control  @error('Bank_Account_Number') is-invalid @enderror"
                                                        id="Bank_Account_Number" name="Bank_Account_Number"
                                                        value="{{ old('Bank_Account_Number') }}">
                                                    @error('Bank_Account_Number')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Do you have Community Saving (like Equib)</strong></label>
                                                <div class="col-sm-9">
                                                    <select id="Community_Saving" name="Community_Saving"
                                                        class="form-control @error('Community_Saving') is-invalid @enderror">
                                                        <option value=""></option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                    @error('Community_Saving')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Do you take community loan</strong></label>
                                                <div class="col-sm-9">
                                                    <select id="Community_loan" name="Community_loan"
                                                        class="form-control @error('Community_loan') is-invalid @enderror">
                                                        <option value=""></option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>



                                                    </select>
                                                    @error('Community_loan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>



                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>What kind of financial product do you use</strong></label>
                                                <div class="col-sm-9">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="check1"
                                                            name="financialproduct_saving" value="saving">
                                                        <label class="form-check-label">Saving</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="check1"
                                                            name="financialproduct_loan" value="loan">
                                                        <label class="form-check-label">Loan</label>
                                                    </div>
                                                    <div class="form-check">

                                                        <input class="form-check-input" type="checkbox" id="check1"
                                                            name="financialproduct_remittance" value="remittance">
                                                        <label class="form-check-label">Remittance</label>
                                                    </div>
                                                    <div class="form-check">

                                                        <input class="form-check-input" type="checkbox" id="check1"
                                                            name="financialproduct_payment" value="payment">
                                                        <label class="form-check-label">payment</label>
                                                    </div>
                                                    @error('Distance_from_KD')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                            </div>



                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Do you have another bank account</strong></label>
                                                <div class="col-sm-9">
                                                    <select id="otheraccount" name="otheraccount"
                                                        class="form-control @error('otheraccount') is-invalid @enderror">
                                                        <option value=""></option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>



                                                    </select>
                                                    @error('otheraccount')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>



                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>What product do you use it for</strong></label>
                                                <div class="col-sm-9">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="check1"
                                                            name="productused_saving" value="saving">
                                                        <label class="form-check-label">Saving</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="check1"
                                                            name="productused_loan" value="loan">
                                                        <label class="form-check-label">Loan</label>
                                                    </div>
                                                    <div class="form-check">

                                                        <input class="form-check-input" type="checkbox" id="check1"
                                                            name="productused_remittance" value="remittance">
                                                        <label class="form-check-label">Remittance</label>
                                                    </div>
                                                    <div class="form-check">

                                                        <input class="form-check-input" type="checkbox" id="check1"
                                                            name="productused_payment" value="payment">
                                                        <label class="form-check-label">payment</label>
                                                    </div>
                                                    @error('Distance_from_KD')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                            </div>

                                        </div>



                                    </div>


                                    <div class="py-1 my-2 text-light" style="background-color:#123c69;">
                                        <p class="card-description text-light ml-4">
                                        <h6 class="pl-2"> TRAINING</h6>
                                        </p>
                                    </div>



                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Have you received training before</strong></label>
                                                <div class="col-sm-9">
                                                    <select id="Receival_of_training" name="Receival_of_training"
                                                        class="form-control @error('Receival_of_training') is-invalid @enderror">
                                                        <option value=""></option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>



                                                    </select>
                                                    @error('Receival_of_training')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>List the trainings taken before</strong></label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control  @error('Training_taking') is-invalid @enderror"
                                                        id="Training_taking" name="Training_taking"
                                                        value="{{ old('Training_taking') }}">
                                                    @error('Training_taking')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Which organization provided the training</strong></label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control  @error('Training_given_org') is-invalid @enderror"
                                                        id="Training_given_org" name="Training_given_org"
                                                        value="{{ old('Training_given_org') }}">
                                                    @error('Training_given_org')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Training provided by</strong></label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control  @error('Training_provided_by') is-invalid @enderror"
                                                        id="Training_provided_by" name="Training_provided_by"
                                                        value="{{ old('Training_provided_by') }}">
                                                    @error('Training_provided_by')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Training Module</strong></label>
                                                <div class="col-sm-9">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="check1"
                                                            name="Training_module1" value="Module1">
                                                        <label class="form-check-label">Module 1</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="check1"
                                                            name="Training_module2" value="Module2">
                                                        <label class="form-check-label">Module 2</label>
                                                    </div>
                                                    <div class="form-check">

                                                        <input class="form-check-input" type="checkbox" id="check1"
                                                            name="Training_module3" value="Module3">
                                                        <label class="form-check-label">Module 3</label>
                                                    </div>
                                                    @error('Training_module3')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Which areas of training interest you in relation to starting
                                                        a business </strong></label>
                                                <div class="col-sm-9">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="check1"
                                                            name="areas_intrested_finance" value="Finance & budget">
                                                        <label class="form-check-label">Finance & budget</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="check1"
                                                            name="areas_intrested_scale" value="Scale Business">
                                                        <label class="form-check-label">Scale Business</label>
                                                    </div>
                                                    <div class="form-check">

                                                        <input class="form-check-input" type="checkbox" id="check1"
                                                            name="areas_intrested_digitize" value="Digitize payment">
                                                        <label class="form-check-label">Digitize payment</label>
                                                    </div>
                                                    @error('areas_intrested_digitize')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="py-1 my-2 text-light" style="background-color:#123c69;">
                                        <p class="card-description text-light ml-4">
                                        <h6 class="pl-2"> PERSONAL & PROFESSIONAL GOALS</h6>
                                        </p>
                                    </div>



                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>What are your short-term personal goals</strong></label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control  @error('short_term_personal_goals') is-invalid @enderror"
                                                        id="short_term_personal_goals" name="short_term_personal_goals"></textarea>
                                                    @error('short_term_personal_goals')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>What are your short-term business goals </strong></label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control  @error('short_term_business_goals') is-invalid @enderror"
                                                        id="short_term_business_goals" name="short_term_business_goals"></textarea>

                                                    @error('short_term_business_goals')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Desired place of residence (Ethiopia, home country,
                                                        somewhere else)</strong></label>
                                                <div class="col-sm-9">
                                                    <div class="form-check">
                                                        <select id="Desired_place_of_residence"
                                                            name="Desired_place_of_residence"
                                                            class="form-control @error('Desired_place_of_residence') is-invalid @enderror">
                                                            <option value=""></option>
                                                            <option value="Afghanistan">Afghanistan</option>
                                                            <option value="Albania">Albania</option>
                                                            <option value="Algeria">Algeria</option>
                                                            <option value="Andorra">Andorra</option>
                                                            <option value="Angola">Angola</option>
                                                            <option value="Antigua and Barbuda">Antigua and Barbuda
                                                            </option>
                                                            <option value="Argentina">Argentina</option>
                                                            <option value="Armenia">Armenia</option>
                                                            <option value="Australia">Australia</option>
                                                            <option value="Austria">Austria</option>
                                                            <option value="Azerbaijan">Azerbaijan</option>

                                                            <option value="The Bahamas">The Bahamas</option>
                                                            <option value="Bahrain">Bahrain</option>
                                                            <option value="Bangladesh">Bangladesh</option>
                                                            <option value="Barbados">Barbados</option>
                                                            <option value="Belarus">Belarus</option>
                                                            <option value="Belgium">Belgium</option>
                                                            <option value="Belize">Belize</option>
                                                            <option value="Benin">Benin</option>
                                                            <option value="Bhutan">Bhutan</option>
                                                            <option value="Bolivia">Bolivia</option>
                                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina
                                                            </option>
                                                            <option value="Botswana">Botswana</option>
                                                            <option value="Brazil">Brazil</option>
                                                            <option value="Brunei">Brunei</option>
                                                            <option value="Bulgaria">Bulgaria</option>
                                                            <option value="Burkina Faso">Burkina Faso</option>
                                                            <option value="Burundi">Burundi</option>
                                                            <option value="Cabo Verde">Cabo Verde</option>
                                                            <option value="Cambodia">Cambodia</option>
                                                            <option value="Cameroon">Cameroon</option>
                                                            <option value="Canada">Canada</option>
                                                            <option value="Central African Republic">Central African
                                                                Republic</option>
                                                            <option value="Chad">Chad</option>
                                                            <option value="Chile">Chile</option>
                                                            <option value="China">China</option>
                                                            <option value="Colombia">Colombia</option>
                                                            <option value="Comoros">Comoros</option>
                                                            <option value="Congo, Democratic Republic of the">Congo,
                                                                Democratic Republic of the</option>
                                                            <option value="Congo, Republic of the">Congo, Republic of the
                                                            </option>
                                                            <option value="Costa Rica">Costa Rica</option>
                                                            <option value="C�te dIvoire">C�te dIvoire</option>
                                                            <option value="Croatia">Croatia</option>
                                                            <option value="Cuba"> Cuba</option>
                                                            <option value="Cyprus"> Cyprus</option>
                                                            <option value="Czech Republic">Czech Republic</option>
                                                            <option value="Denmark"> Denmark</option>
                                                            <option value="Djibouti">Djibouti</option>
                                                            <option value="Dominica">Dominica</option>
                                                            <option value="Dominican Republic">Dominican Republic</option>

                                                            <option value="East Timor (Timor-Leste)">East Timor
                                                                (Timor-Leste)</option>
                                                            <option value="Ecuador">Ecuador</option>
                                                            <option value="Egypt">Egypt</option>
                                                            <option value="El Salvador">El Salvador</option>
                                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                            <option value="Eritrea">Eritrea</option>
                                                            <option value="Estonia">Estonia</option>
                                                            <option value="Eswatini">Eswatini</option>
                                                            <option value="Ethiopia">Ethiopia</option>

                                                            <option value="Fiji">Fiji</option>
                                                            <option value="Finland">Finland</option>
                                                            <option value="France">France</option>

                                                            <option value="Gabon">Gabon</option>
                                                            <option value="The Gambia">The Gambia</option>
                                                            <option value="Georgia">Georgia</option>
                                                            <option value="Germany">Germany</option>
                                                            <option value="Ghana">Ghana</option>
                                                            <option value="Greece">Greece</option>
                                                            <option value="Grenada">Grenada</option>
                                                            <option value="Guatemala">Guatemala</option>
                                                            <option value="Guinea">Guinea</option>
                                                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                                                            <option value="Guyana">Guyana</option>

                                                            <option value="Haiti">Haiti</option>
                                                            <option value="Honduras">Honduras</option>
                                                            <option value="Hungary">Hungary</option>

                                                            <option value="Iceland">Iceland</option>
                                                            <option value="India">India</option>
                                                            <option value="Indonesia">Indonesia</option>
                                                            <option value="Iran">Iran</option>
                                                            <option value="Iraq">Iraq</option>
                                                            <option value="Ireland">Ireland</option>
                                                            <option value="Israel">Israel</option>
                                                            <option value="Italy">Italy</option>

                                                            <option value="Jamaica">Jamaica</option>
                                                            <option value="Japan">Japan</option>
                                                            <option value="Jordan">Jordan</option>

                                                            <option value="Kazakhstan">Kazakhstan</option>
                                                            <option value="Kenya">Kenya</option>
                                                            <option value="Kiribati">Kiribati</option>
                                                            <option value="Korea, North">Korea, North</option>
                                                            <option value="Korea, South">Korea, South</option>
                                                            <option value="Kosovo">Kosovo</option>
                                                            <option value="Kuwait">Kuwait</option>
                                                            <option value="Kyrgyzstan">Kyrgyzstan</option>

                                                            <option value="Laos">Laos</option>
                                                            <option value="Latvia"> Latvia</option>
                                                            <option value="Lebanon">Lebanon</option>
                                                            <option value="Lesotho">Lesotho</option>
                                                            <option value="Liberia">Liberia</option>
                                                            <option value="Libya">Libya</option>
                                                            <option value="Liechtenstein">Liechtenstein</option>
                                                            <option value="Lithuania">Lithuania</option>
                                                            <option value="Luxembourg">Luxembourg</option>
                                                            <option value="Madagascar">Madagascar</option>
                                                            <option value="Malawi">Malawi</option>
                                                            <option value="Malaysia">Malaysia</option>
                                                            <option value="Maldives">Maldives</option>
                                                            <option value="Mali">Mali</option>
                                                            <option value="Malta">Malta</option>
                                                            <option value="Marshall Islands">Marshall Islands</option>
                                                            <option value="Mauritania">Mauritania</option>
                                                            <option value="Mauritius">Mauritius</option>
                                                            <option value="Mexico">Mexico</option>
                                                            <option value="Micronesia, Federated States of">Micronesia,
                                                                Federated States of</option>
                                                            <option value="Moldova">Moldova</option>
                                                            <option value="Monaco">Monaco</option>
                                                            <option value="Mongolia">Mongolia</option>
                                                            <option value="Montenegro">Montenegro</option>
                                                            <option value="Morocco">Morocco</option>
                                                            <option value="Mozambique">Mozambique</option>
                                                            <option value="Myanmar (Burma)">Myanmar (Burma)</option>
                                                            <option value="Namibia">Namibia</option>
                                                            <option value="Nauru">Nauru</option>
                                                            <option value="Nepal">Nepal</option>
                                                            <option value="Netherlands">Netherlands</option>
                                                            <option value="New Zealand">New Zealand</option>
                                                            <option value="Nicaragua">Nicaragua</option>
                                                            <option value="Niger">Niger</option>
                                                            <option value="Nigeria">Nigeria</option>
                                                            <option value="North Macedonia">North Macedonia</option>
                                                            <option value="Norway">Norway</option>
                                                            <option value="Oman">Oman</option>
                                                            <option value="Pakistan">Pakistan</option>
                                                            <option value="Palau">Palau</option>
                                                            <option value="Panama">Panama</option>
                                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                                            <option value="Paraguay">Paraguay</option>
                                                            <option value="Peru">Peru</option>
                                                            <option value="Philippines">Philippines</option>
                                                            <option value="Poland">Poland</option>
                                                            <option value="Portugal">Portugal</option>
                                                            <option value="Qatar">Qatar</option>
                                                            <option value="Romania">Romania</option>
                                                            <option value="Russia">Russia</option>
                                                            <option value="Rwanda">Rwanda</option>
                                                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis
                                                            </option>
                                                            <option value="Saint Lucia">Saint Lucia</option>
                                                            <option value="Saint Vincent and the Grenadines">Saint Vincent
                                                                and the Grenadines</option>
                                                            <option value="Samoa">Samoa</option>
                                                            <option value="San Marino">San Marino</option>
                                                            <option value="Sao Tome and Principe">Sao Tome and Principe
                                                            </option>
                                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                                            <option value="Senegal">Senegal</option>
                                                            <option value="Serbia">Serbia</option>
                                                            <option value="Seychelles">Seychelles</option>
                                                            <option value="Sierra Leone">Sierra Leone</option>
                                                            <option value="Singapore">Singapore</option>
                                                            <option value="Slovakia">Slovakia</option>
                                                            <option value="Slovenia">Slovenia
                                                            <option value="Solomon Islands">Solomon Islands</option>
                                                            <option value="Somalia">Somalia</option>
                                                            <option value="South Africa">South Africa</option>
                                                            <option value="Spain">Spain</option>
                                                            <option value="Sri Lanka">Sri Lanka</option>
                                                            <option value="Sudan">Sudan</option>
                                                            <option value="Sudan, South">Sudan, South</option>
                                                            <option value="Suriname">Suriname</option>
                                                            <option value="Sweden">Sweden</option>
                                                            <option value="Switzerland">Switzerland</option>
                                                            <option value="Syria">Syria</option>
                                                            <option value="Taiwan">Taiwan</option>
                                                            <option value="Tajikistan">Tajikistan</option>
                                                            <option value="Tanzania">Tanzania</option>
                                                            <option value="Thailand">Thailand</option>
                                                            <option value="Togo">Togo</option>
                                                            <option value="Tonga">Tonga</option>
                                                            <option value="Trinidad and Tobago">Trinidad and Tobago
                                                            </option>
                                                            <option value="Tunisia">Tunisia</option>
                                                            <option value="Turkey">Turkey</option>
                                                            <option value="Turkmenistan">Turkmenistan</option>
                                                            <option value="Tuvalu">Tuvalu</option>
                                                            <option value="Uganda">Uganda</option>
                                                            <option value="Ukraine">Ukraine</option>
                                                            <option value="United Arab Emirates">United Arab Emirates
                                                            </option>
                                                            <option value="United Kingdom">United Kingdom</option>
                                                            <option value="United States">United States</option>
                                                            <option value="Uruguay">Uruguay</option>
                                                            <option value="Uzbekistan">Uzbekistan</option>
                                                            <option value="Vanuatu">Vanuatu</option>
                                                            <option value="Vatican City">Vatican City</option>
                                                            <option value="Venezuela">Venezuela</option>
                                                            <option value="Vietnam">Vietnam</option>
                                                            <option value="Yemen">Yemen</option>
                                                            <option value="Zambia">Zambia</option>
                                                            <option value="Zimbabwe">Zimbabwe</option>

                                                        </select>
                                                        @error('Desired_place_of_residence')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>I have plans to leave Ethiopia</strong></label>
                                                <div class="col-sm-9">
                                                    <select id="leaveethiopia" name="leaveethiopia"
                                                        class="form-control @error('leaveethiopia') is-invalid @enderror">
                                                        <option value=""></option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>



                                                    </select>
                                                    @error('leaveethiopia')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>



                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>When</strong></label>
                                                <div class="col-sm-9">
                                                    <select id="when_leave" name="when_leave"
                                                        class="form-control @error('when_leave') is-invalid @enderror">
                                                        <option value=""></option>
                                                        <option value="0-2 years">0-2 years</option>
                                                        <option value="2-5years">2-5years</option>
                                                        <option value="5-7 years">5-7 years</option>



                                                    </select>
                                                    @error('when_leave')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>



                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Long term (5-7 years) business goals</strong></label>
                                                <div class="col-sm-9">
                                                    <div class="form-check">
                                                        <textarea class="form-control  @error('Long_term_business_goals') is-invalid @enderror" id="Long_term_business_goals"
                                                            name="Long_term_business_goals"></textarea>

                                                        @error('Long_term_business_goals')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Long term (5-7 years) personal goals</strong></label>
                                                <div class="col-sm-9">
                                                    <div class="form-check">
                                                        <textarea class="form-control  @error('Long_term_personal_goals') is-invalid @enderror" id="Long_term_personal_goals"
                                                            name="Long_term_personal_goals"></textarea>

                                                        @error('Long_term_personal_goals')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                        </div>









                                        {{-- <div class="col-md-6">
                                        <div class="form-group row">
                                            <label><strong>Password</strong></label>
                                            <div class="col-sm-9">
                                                <input type="password"
                                                    class="form-control  @error('password') is-invalid @enderror"
                                                    value="" placeholder="*********" id="password" minlength="6"
                                                    name="password" required>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> --}}
                                    </div>
                                    <input type="submit" class="form form-control btn btn-outline-success mt-5"
                                        value="Submit">
                                    <input type="reset" class="form form-control btn btn-outline-danger mt-2"
                                        value="Clear">








                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        {{-- <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright � <a href="https://www.bootstrapdash.com/" target="_blank">bootstrapdash.com </a>2021</span>
          <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Only the best <a href="https://www.bootstrapdash.com/" target="_blank"> Bootstrap dashboard  </a> templates</span>
        </div>
        </footer> --}}
        <!-- partial -->
    </div>
@endsection
