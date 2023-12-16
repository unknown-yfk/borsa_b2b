@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">


                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Client Detail</h4>

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
                                                    id="firstName" name="firstName" value={{ $user[0]->firstName }} disabled>
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
                                                    id="middleName" name="middleName" value={{ $user[0]->middleName }} disabled>

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
                                                    id="lastName" name="lastName" value={{ $user[0]->lastName }} disabled>
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
                                                    id="Mother_name" name="Mother_name" value={{ $user[0]->Mother_name }} disabled>
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
                                                    <option value="{{ $user[0]->Gender }}" selected> {{ $user[0]->Gender }}
                                                    </option>
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
                                                    id="birthdate" name="birthdate" value="{{ $user[0]->birthdate }}" disabled>
                                                @error('birthdate')
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
                                            <label><strong>Age</strong></label>
                                            <div class="col-sm-9">
                                                <input type="number"
                                                    class="form-control  @error('age') is-invalid @enderror" id="age"
                                                    name="age" value="{{ $user[0]->age }}" disabled>
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
                                                    <option value="{{ $user[0]->PhoneType }}" selected>{{ $user[0]->PhoneType }}
                                                    </option>

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
                                                    value={{ $user[0]->client_mobile_phone }} disabled >
                                                @error('client_mobile')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label><strong>Alternative Phone Number</strong></label>
                                            <div class="col-sm-9">
                                                <input type="tel"
                                                    class="form-control  @error('Alternative_Phone_Number') is-invalid @enderror"
                                                    id="Alternative_Phone_Number" name="Alternative_Phone_Number"
                                                    value={{ $user[0]->Alternative_Phone_Number }} disabled>

                                                @error('Alternative_Phone_Number')
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
                                            <label><strong>Nationality</strong></label>
                                            <div class="col-sm-9">
                                                <input type="text"
                                                    class="form-control  @error('Nationality') is-invalid @enderror"
                                                    id="Nationality" name="Nationality" value={{ $user[0]->Nationality }} disabled>
                                                @error('Nationality')
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
                                            <label><strong>Family Size</strong></label>
                                            <div class="col-sm-9">
                                                <input type="number"
                                                    class="form-control  @error('FamilySize') is-invalid @enderror"
                                                    id="FamilySize" name="FamilySize" value={{ $user[0]->FamilySize }} disabled>
                                                @error('FamilySize')
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
                                            <label><strong>Number of children</strong></label>
                                            <div class="col-sm-9">
                                                <input type="number"
                                                    class="form-control  @error('nochild') is-invalid @enderror"
                                                    id="nochild" name="nochild" value="{{ $user[0]->nochild }}" disabled>
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
                                                    value="{{ $user[0]->child_in_school }}" disabled>
                                                @error('child_in_school')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label><strong>Number of children under the age 2 years</strong></label>
                                            <div class="col-sm-9">
                                                <input type="number"
                                                    class="form-control  @error('child_in_school_under2') is-invalid @enderror"
                                                    id="child_in_school_under2" name="child_in_school_under2"
                                                    value="{{ $user[0]->child_in_school_under2 }}" disabled>
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
                                                    <option value="{{ $user[0]->Marital_Status }}" selected>
                                                        {{ $user[0]->Marital_Status }}</option>

                                                </select>
                                                @error('Marital_Status')
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
                                            <label><strong> User Name</strong></label>
                                            <div class="col-sm-9">

                                                <input type="text"
                                                    class="form-control  @error('userName') is-invalid @enderror"
                                                    id="userName" name="userName" value="{{ $user[0]->userName }}" disabled>
                                                @error('userName')
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
                                                    id="Country" name="Country" value="{{ $user[0]->Country }}" disabled>
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
                                            <strong><label> City </label></strong>
                                            <div class="col-sm-9">
                                                <input type="text"
                                                    class="form-control  @error('City') is-invalid @enderror"
                                                    id="City" name="City" value="{{ $user[0]->City }}" disabled>
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
                                            <label><strong> Region</strong></label>
                                            <div class="col-sm-9">

                                                <input type="text"
                                                    class="form-control  @error('Region') is-invalid @enderror"
                                                    id="Region" name="Region" value="{{ $user[0]->Region }}" disabled>
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
                                            <label><strong>Camp </strong></label>
                                            <div class="col-sm-9">
                                                <input type="text"
                                                    class="form-control  @error('camp') is-invalid @enderror"
                                                    id="camp" name="camp" value="{{ $user[0]->camp }}" disabled>
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
                                                    id="zone" name="zone" value="{{ $user[0]->zone }}" disabled>
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
                                                    id="kebele" name="kebele" value="{{ $user[0]->kebele }}" disabled>
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
                                                    value="{{ $user[0]->house_number }}" disabled>
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
                                            <label><strong> Do you have UNHCR ID</strong></label>
                                            <div class="col-sm-9">
                                                <select id="unhcr_id" name="unhcr_id"
                                                    class="form-control @error('unhcr_id') is-invalid @enderror">
                                                    <option value="{{ $user[0]->unhcr_id }}" selected>{{ $user[0]->unhcr_id }}
                                                    </option>


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
                                                    id="ID_Number" name="ID_Number" value="{{ $user[0]->ID_Number }}" disabled>
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
                                                    value="{{ $user[0]->ID_issue_date }}" disabled>
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
                                                    value="{{ $user[0]->ID_expiry_Date }}" disabled>
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
                                                    value="{{ $user[0]->client_business_Name }}" disabled>
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
                                                    <option value="{{ $user[0]->client_business_Type }}">
                                                        {{ $user[0]->client_business_Type }}</option>

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
                                                    value="{{ $user[0]->businesscamp }}" disabled>
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
                                                    value="{{ $user[0]->businesszone }}" disabled>
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
                                                    value="{{ $user[0]->businessRegisteration }}" disabled>
                                                @error('businessRegisteration')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label><strong>TIN Number</strong></label>
                                            <div class="col-sm-9">
                                                <input type="text"
                                                    class="form-control  @error('Tin_number') is-invalid @enderror"
                                                    id="Tin_number" name="Tin_number" value="{{ $user[0]->Tin_number }}" disabled>
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
                                                    value="{{ $user[0]->License_number }}" disabled>
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
                                                    value="{{ $user[0]->Distance_from_KD }}" disabled>
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
                                                    value="{{ $user[0]->establishment_date }}" disabled>
                                                @error('establishment_date')
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
                                            <label><strong>Work permit </strong></label>
                                            <div class="col-sm-9">
                                                <select id="workpermit" name="workpermit"
                                                    class="form form-control  @error('workpermit') is-invalid @enderror"
                                                    required>
                                                    <option value="{{ $user[0]->workpermit }}" selected>
                                                        {{ $user[0]->workpermit }}</option>
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
                                                    <option value="{{ $user[0]->Bank_Account }}" selected>
                                                        {{ $user[0]->Bank_Account }}</option>

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
                                                    <option value="{{ $user[0]->Bank_name }}" selected>
                                                        {{ $user[0]->Bank_name }}</option>

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
                                                    value="{{ $user[0]->Bank_Account_Number }}" disabled>
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
                                            <label><strong>Community Saving (like Equib)</strong></label>
                                            <div class="col-sm-9">
                                                <select id="Community_Saving" name="Community_Saving"
                                                    class="form-control @error('Community_Saving') is-invalid @enderror">
                                                    <option value="{{ $user[0]->Community_Saving }}" selected>
                                                        {{ $user[0]->Community_Saving }}</option>

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
                                                    <option value="{{ $user[0]->Community_loan }}" selected>
                                                        {{ $user[0]->Community_loan }}</option>

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
                                                        name="financialproduct_saving" value="saving"
                                                        @if (isset($user[0]->financialproduct_saving)) @if ($user[0]->financialproduct_saving == 'saving') checked @endif
                                                        @endif disabled>
                                                        <label class="form-check-label">Saving</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="check1"
                                                            name="financialproduct_loan" value="loan"
                                                            @if (isset($user[0]->financialproduct_loan)) @if ($user[0]->financialproduct_loan == 'loan') checked @endif
                                                            @endif disabled>
                                                        <label class="form-check-label">Loan</label>
                                                    </div>
                                                    <div class="form-check">

                                                        <input class="form-check-input" type="checkbox" id="check1"
                                                            name="financialproduct_remittance" value="remittance"
                                                            @if (isset($user[0]->financialproduct_remittance)) @if ($user[0]->financialproduct_remittance == 'remittance') checked @endif
                                                            @endif disabled>
                                                        <label class="form-check-label">Remittance</label>
                                                    </div>
                                                    <div class="form-check">

                                                        <input class="form-check-input" type="checkbox" id="check1"
                                                            name="financialproduct_payment" value="payment"
                                                            @if (isset($user[0]->financialproduct_payment)) @if ($user[0]->financialproduct_payment == 'payment') checked @endif
                                                            @endif disabled>
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
                                        {{-- </div>
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
                                    </div> --}}

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
                                                        <option value="{{ $user[0]->Receival_of_training }}" selected>
                                                            {{ $user[0]->Receival_of_training }}</option>

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
                                                        value="{{ $user[0]->Training_taking }}" disabled>
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
                                                <label><strong>Training provided by</strong></label>
                                                <div class="col-sm-9">
                                                    <input type="text"
                                                        class="form-control  @error('Training_provided_by') is-invalid @enderror"
                                                        id="Training_provided_by" name="Training_provided_by"
                                                        value="{{ $user[0]->Training_provided_by }}" disabled>
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
                                                            name="Training_module1" value="Module1"
                                                            @if (isset($user[0]->Training_module1)) @if ($user[0]->Training_module1 == 'Module1') checked @endif
                                                            @endif disabled>
                                                        <label class="form-check-label">Module 1</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="check1"
                                                            name="Training_module2" value="Module2"
                                                            @if (isset($user[0]->Training_module2)) @if ($user[0]->Training_module2 == 'Module2') checked @endif
                                                            @endif disabled>
                                                        <label class="form-check-label">Module 2</label>
                                                    </div>
                                                    <div class="form-check">

                                                        <input class="form-check-input" type="checkbox" id="check1"
                                                            name="Training_module3" value="Module3"
                                                            @if (isset($user[0]->Training_module3)) @if ($user[0]->Training_module3 == 'Module3') checked @endif
                                                            @endif disabled>
                                                        <label class="form-check-label">Module 3</label>
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
                                                <label><strong>Which areas of training interest you in relation to starting
                                                        a business </strong></label>
                                                <div class="col-sm-9">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="check1"
                                                            name="areas_intrested_finance" value="Finance & budget"
                                                            @if (isset($user[0]->areas_intrested_finance)) @if ($user[0]->areas_intrested_finance == 'Finance & budget') checked @endif
                                                            @endif disabled>
                                                        <label class="form-check-label">Finance & budget</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="check1"
                                                            name="areas_intrested_scale" value="Scale Business"
                                                            @if (isset($user[0]->areas_intrested_scale)) @if ($user[0]->areas_intrested_scale == 'Scale Business') checked @endif
                                                            @endif disabled>
                                                        <label class="form-check-label">Scale Business</label>
                                                    </div>
                                                    <div class="form-check">

                                                        <input class="form-check-input" type="checkbox" id="check1"
                                                            name="areas_intrested_digitize" value="Digitize payment"
                                                            @if (isset($user[0]->areas_intrested_digitize)) @if ($user[0]->areas_intrested_digitize == 'Digitize payment') checked @endif
                                                            @endif disabled>
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
                                        <h6 class="pl-2">PERSONAL & PROFESSIONAL GOALS</h6>
                                        </p>
                                    </div>
                    <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label><strong>What are your short-term personal goals</strong></label>
                                           <div class="col-sm-9">
                                                <textarea class="form-control  @error('short_term_personal_goals') is-invalid @enderror"
                                                    id="short_term_personal_goals" name="short_term_personal_goals" >{{ $user[0]->short_term_personal_goals }}</textarea>
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
                                            <label><strong>Desired place of residence (Ethiopia, home country,
                                                    somewhere else)</strong></label>
                                            <div class="col-sm-9">
                                                <div class="form-check">
                                                    <select id="Desired_place_of_residence"
                                                        name="Desired_place_of_residence"
                                                        class="form-control @error('Desired_place_of_residence') is-invalid @enderror">
                                                        <option value="{{ $user[0]->Desired_place_of_residence }}" selected>
                                                            {{ $user[0]->Desired_place_of_residence }}</option>
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
                                                    <option value="{{ $user[0]->leaveethiopia }}" selected>
                                                        {{ $user[0]->leaveethiopia }}</option>

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
                                                    <option value="{{ $user[0]->when_leave }}" selected>
                                                        {{ $user[0]->when_leave }}</option>

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
                                                    <textarea class="form-control  @error('Long_term_business_goals') is-invalid @enderror" id="Long_term_business_goals"
                                                        name="Long_term_business_goals" >{{ $user[0]->Long_term_business_goals }}</textarea>

                                                    @error('Long_term_business_goals')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                    </div>
                                     <div class="col-md-4">
                                            <div class="form-group row">
                                                <label><strong>Long term (5-7 years) personal goals</strong></label>
                                                <div class="col-sm-9">

                                                    <textarea class="form-control  @error('Long_term_personal_goals') is-invalid @enderror" id="Long_term_personal_goals"
                                                        name="Long_term_personal_goals" >{{ $user[0]->Long_term_personal_goals }}</textarea>

                                                    @error('Long_term_personal_goals')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                     </div>
                    </div>









                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
