
@extends('layouts.mainlayout')
@section('content')



<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">

            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                    <h1 class="mt-4">Profile Setup</h1>
                    <div class="row">

                                Fill The Form and Click Submit to Complete Profile Setup
                            </div>
                            <div class="card-body">
                            <div class="container rounded bg-white mt-5 mb-5">
                                <div class="row mt-2">
                                    <center>
                                        <form action="/agent/create/posts" method= "POST" enctype="multipart/form-data">
                                        </center>
                                        @csrf
                                        <div class="col-md-6">
                                            <label class="labels"><strong>  {{('messages.UserPhoto')}}
                                                </strong></label>
                                            <input type="file" class="form-control @error('profilePicture') is-invalid @enderror"  placeholder="" id="profilePicture" name="profilePicture">
                                        @error('profilePicture')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                        <div class="col-md-6"> <label class="labels"><strong> {{('messages.HomeAdress')}}</strong></label>
                                            <input type="text" class="form-control floating form-control @error('address') is-invalid @enderror"  placeholder="Home Address" name="address" value="{{ old('address') }}"id="homeAddress" tabindex="10"required>
                                            <div id="map">
                                         </div>
                                        <div id="infowindow-content">
                                             <span id="place-name" class="title"></span><br />
                                             <span id="place-address"></span>
                                         </div>
                                         @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                        <div class="col-md-6"><label class="labels"><strong> {{('messages.Mobile')}}</strong></label>
                        <input type="text" class="form-control @error('mobile') is-invalid @enderror"  placeholder="Phone number" id="mobile" name="mobile" value="{{ old('mobile') }}"required>
                            @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>

                        <div class="col-md-6"><label class="labels"><strong> {{('messages.YourId')}}</strong></label>
                        <input type="file" class="form-control @error('id_path') is-invalid @enderror"  placeholder="" id="id_path" name="id_path" value="{{ old('id_path') }}"required>
                        @error('id_path')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                     </div>

<div class="col-md-6"><label class="labels"><strong> {{('messages.IdType')}}</strong></label>
                          <select id="idType" name="idType" value="{{ old('idType') }}" class="form-control @error('idType') is-invalid @enderror"  value="{{ old('idType') }}" required>
                                <option value=""></option>
                                @foreach ( $idType as $idType)
                                <option value="{{ $idType->idTypeName }}" {{ old('idType') == $idType->idTypeName ? 'selected' : '' }}  >{{ $idType->idTypeName }}</option>
                                @endforeach
                            </select>


                            @error('idType')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6"><label class="labels"><strong> {{('messages.IdNumber')}}</strong> </label>
                        <input type="text" class="form-control @error('ID_number') is-invalid @enderror"  id="ID_number" name="ID_number" value="{{ old('ID_number') }}"required>
                        @error('ID_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror</div>
                        <div class="col-md-6"><label class="labels"><strong> {{('messages.IdIssueDate')}} </strong></label>
                        <input type="date" class="form-control @error('ID_issue_date') is-invalid @enderror"  placeholder="when was you id issued" id="ID_issue_date" name="ID_issue_date" value="{{ old('ID_issue_date') }}"required>
                        @error('ID_issue_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror</div>
                        <div class="col-md-6"><label class="labels"><strong> {{('messages.IdExpiryDate')}} </strong></label>
                        <input type="date" class="form-control @error('ID_expiry_date') is-invalid @enderror"  value="{{ old('ID_expiry_date') }}" placeholder=" " id="ID_expiry_date" name="ID_expiry_date" required>
                        @error('ID_expiry_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror</div>
                        <div class="col-md-6"><label class="labels"><strong> {{('messages.BussinessName')}}</strong></label>
                        <input type="text" class="form-control @error('businessName') is-invalid @enderror" placeholder="" id="businessName" name="businessName" value="{{ old('businessName') }}"required>
                        @error('businessName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror</div>
                       <div class="col-md-6"><label class="labels"><strong> {{('messages.BusinessType')}}</strong></label>
                            <select id="businessType" name="businessType"  class="form-control" value="{{ old('businessType') }}"required>
                                <option value=""></option>
                                @foreach ( $businessType as $businessTypes )
                                <option value="{{ $businessTypes->id }}" {{ old('businessType') == $businessTypes->id ? 'selected' : '' }} > {{ $businessTypes->businessName }}</option>
                                @endforeach


</select>


                               {{-- <select class="form-control" name="category_id" required>
        <option value="">Seleccione Categoría</option>
        @foreach ($categories as $category)
            <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
        @endforeach
    </select> --}}





                        </div>

                        <div class="col-md-6"><label class="labels"><strong> {{('messages.select_rom')}}</strong></label>
                            <select id="rom_id" name="rom_id"  class="form-control" value="{{ old('rom_id') }}"required>
                                <option value=""></option>
                                @foreach ( $roms as $rom )
                                <option value="{{ $rom->user_id }}" {{ old('rom_id') == $rom->user_id ? 'selected' : '' }} > {{ $rom->firstName . ' '. $rom->middleName . ' ' . $rom->lastName }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="col-md-6"> <label class="labels"><strong> {{('messages.BusinessAdress')}}</strong></label>
                           <input type="text" class="form-control floating form-control @error('businessAddress') is-invalid @enderror" name="businessAddress" id="pac-input" tabindex="10" value="{{ old('businessAddress') }}"required>
                              <div id="map">
                        </div>
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


<div class="col-md-6">
                            <label class="labels"><strong> {{('messages.BusinessLicence')}}</strong></label>
                        <input type="file" class="form-control @error('licenceFilePath') is-invalid @enderror"  placeholder="" id="licenceFilePath" name="licenceFilePath" value="{{ old('licenceFilePath') }}"required>
                        @error('LicenceFilePath')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        <div class="col-md-6"><label class="labels"><strong> {{('messages.LicenceNumber')}}</strong></label>
                        <input type="text" class="form-control @error('licenceNumber') is-invalid @enderror" value="{{ old('licenceNumber') }}" placeholder="licence number" id="licenceNumber" name="licenceNumber"  required>
                        @error('licenceNumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror</div>
                        <div class="col-md-6"><label class="labels"><strong> {{('messages.LicenceIssueDate')}}</strong></label>
                        <input type="date" class="form-control @error('issueDate') is-invalid @enderror"  placeholder="" id="issueDate" name="issueDate" value="{{ old('issueDate') }}" required>
                        @error('issueDate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror</div>
                        <div class="col-md-6"><label class="labels"><strong> {{('messages.ExpiryDate')}}</strong></label>
                        <input type="date" class="form-control @error('expiryDate') is-invalid @enderror"  placeholder="" id="expiryDate" name="expiryDate" value="{{ old('expiryDate') }}" required>
                        @error('expiryDate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror</div>
                        <div class="col-md-6"><label class="labels"><strong> {{('messages.TinNumber')}}</strong></label>
                        <input type="text" class="form-control @error('tinNumber') is-invalid @enderror"  placeholder="you goverment issued tin number" id="tinNumber" name="tinNumber" value="{{ old('tinNumber') }}" required>
                        @error('tinNumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror</div>
                        <div class="col-md-6"><label class="labels"><strong> {{('messages.BusinessEstablished_at')}}</strong></label>
                        <input type="text" class="form-control @error('businessEstablishmentYear') is-invalid @enderror" placeholder="eg: 2002" id="businessEstablishmentYear" name="businessEstablishmentYear" value="{{ old('businessEstablishmentYear') }}" required>
                        @error('businessEstablishmentYear')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div><br>
                        <br><br>
                            <input type="submit" class="form form-control btn btn-outline-success mt-5" value="Submit">


<input type="reset" class="form form-control btn btn-outline-danger mt-2" value="Clear">
                    </form>
                </div>
  </div>
                            </div>
                                    {{-- <div class="row mt-2">
                                        <center><a href="/key_distro/update/edit"><button
                                            class="btn btn-primary">Update</button></a></center>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
            {{-- </main> --}}
        </div>
</div>







@endsection
