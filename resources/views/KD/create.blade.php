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
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        Fill the form and click submit to complete profile setup.
                                    </div>
                                    <div class="card-body">
                                        <div class="container rounded bg-white mt-5 mb-5">
                                            <div class="row mt-2">
                                                <center>
                                                    <form action="/key_distros/create/posts" method="POST"
                                                        enctype="multipart/form-data">
                                                </center>
                                                @csrf
                                                <div class="col-md-6">
                                                    <label class="labels">User Photo</label>
                                                    <input type="file"
                                                        class="form-control @error('profilePicture') is-invalid @enderror"
                                                        value="" placeholder="" id="profilePicture"
                                                        name="profilePicture" required>
                                                    @error('profilePicture')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6"> <label class="labels"><strong>Home
                                                            Address</strong></label>
                                                    <input type="text"
                                                        class="form-control floating form-control @error('address') is-invalid @enderror"
                                                        name="address" id="address" tabindex="10"
                                                        value="{{ old('address') }}" required>
                                                    <div id="map">
                                                    </div>
                                                    @error('address')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                {{-- <div class="col-md-6"> <label class="labels"><strong>Home Address</strong></label>
                                            <input type="text"
                                                class="form-control floating form-control @error('address') is-invalid @enderror"
                                                name="address" id="pac-input" tabindex="10"required>
                                            <div id="map">
                                            </div>
                                            <div id="infowindow-content">
                                                <span id="place-name" class="title"></span><br />
                                                <span id="place-address"></span>
                                            </div>
                                            <input name="lng" id="pac-role" type="hidden">
                                            <input name="lat" id="pac-lan" type="hidden">
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> --}}






                                                <div class="col-md-6"><label class="labels"><strong>Mobile</strong></label>
                                                    <input type="text"
                                                        class="form-control @error('mobile') is-invalid @enderror"
                                                        id="mobile" name="mobile" value="{{ old('mobile') }}" required>
                                                    @error('mobile')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6"><label class="labels"><strong>Your ID</strong></label>
                                                    <input type="file"
                                                        class="form-control @error('id_path') is-invalid @enderror"
                                                        id="id_path" name="id_path" value="{{ old('id_path') }}"required>
                                                    @error('id_path')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6"><label class="labels"><strong>ID Type</strong></label>
                                                    <select id="idType" name="idType" value="{{ old('idType') }}"
                                                        class="form-control @error('idType') is-invalid @enderror"
                                                        value="{{ old('idType') }}" required>
                                                        <option value=""></option>
                                                        @foreach ($idType as $idType)
                                                            <option value="{{ $idType->idTypeName }}"
                                                                {{ old('idType') == $idType->idTypeName ? 'selected' : '' }}>
                                                                {{ $idType->idTypeName }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('idType')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6"><label class="labels"><strong>ID Number</strong>
                                                    </label>
                                                    <input type="text"
                                                        class="form-control @error('ID_number') is-invalid @enderror"
                                                        id="ID_number" name="ID_number" value="{{ old('ID_number') }}"
                                                        required>
                                                    @error('ID_number')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6"><label class="labels"><strong>ID Issue Date
                                                        </strong></label>
                                                    <input type="date"
                                                        class="form-control @error('ID_issue_date') is-invalid @enderror"
                                                        id="ID_issue_date" name="ID_issue_date" max="{{ $today }}"
                                                        value="{{ old('ID_issue_date') }}"required>
                                                    @error('ID_issue_date')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6"><label class="labels"><strong>ID Expiry Date
                                                        </strong></label>
                                                    <input type="date"
                                                        class="form-control @error('ID_expiry_date') is-invalid @enderror"
                                                        id="ID_expiry_date" name="ID_expiry_date" min="{{ $today }}"
                                                        value="{{ old('ID_expiry_date') }}"required>
                                                    @error('ID_expiry_date')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6"><label class="labels"><strong>Business
                                                            Name</strong></label>
                                                    <input type="text"
                                                        class="form-control @error('businessName') is-invalid @enderror"
                                                        id="businessName" name="businessName"
                                                        value="{{ old('businessName') }}" required>
                                                    @error('businessName')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6"><label class="labels"><strong>Business
                                                            Type</strong></label>
                                                    <select id="businessType" name="businessType" class="form-control"
                                                        value="{{ old('businessType') }}"required>
                                                        <option value=""></option>
                                                        @foreach ($businessType as $businessTypes)
                                                            <option value="{{ $businessTypes->id }}"
                                                                {{ old('businessType') == $businessTypes->id ? 'selected' : '' }}>
                                                                {{ $businessTypes->businessName }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6"> <label class="labels"><strong>Business
                                                            Address</strong></label>
                                                    <input type="text"
                                                        class="form-control floating form-control @error('businessAddress') is-invalid @enderror"
                                                        name="businessAddress" id="pac-input" tabindex="10"
                                                        value="{{ old('businessAddress') }}"required>
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
                                                    <label class="labels"><strong>Buisness Licence</strong></label>
                                                    <input type="file"
                                                        class="form-control @error('licenceFilePath') is-invalid @enderror"
                                                        id="licenceFilePath" name="licenceFilePath"
                                                        value="{{ old('licenceFilePath') }}"required>
                                                    @error('LicenceFilePath')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6"><label class="labels"><strong>Licence
                                                            Number</strong></label>
                                                    <input type="text"
                                                        class="form-control @error('licenceNumber') is-invalid @enderror"
                                                        id="licenceNumber" name="licenceNumber"
                                                        value="{{ old('licenceNumber') }}" required>
                                                    @error('licenceNumber')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6"><label class="labels"><strong>Licence Issue
                                                            Date</strong></label>
                                                    <input type="date"
                                                        class="form-control @error('issueDate') is-invalid @enderror"
                                                        id="issueDate" name="issueDate" max="{{ $today }}"
                                                        value="{{ old('issueDate') }}"required>
                                                    @error('issueDate')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6"><label class="labels"><strong>Licence Expiry
                                                            Date</strong></label>
                                                    <input type="date"
                                                        class="form-control @error('expiryDate') is-invalid @enderror"
                                                        id="expiryDate" name="expiryDate" min="{{ $today }}"
                                                        value="{{ old('expiryDate') }}"required>
                                                    @error('expiryDate')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6"><label class="labels"><strong>Tin
                                                            Number</strong></label>
                                                    <input type="text"
                                                        class="form-control @error('tinNumber') is-invalid @enderror"
                                                        id="tinNumber" name="tinNumber" value="{{ old('tinNumber') }}"
                                                        required>
                                                    @error('tinNumber')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6"><label class="labels"><strong>Buisness
                                                            Established</strong></label>
                                                    <input type="text"
                                                        class="form-control  @error('businessEstablishmentYear') is-invalid @enderror"
                                                        placeholder="eg: 2002" id="businessEstablishmentYear"
                                                        name="businessEstablishmentYear"
                                                        value="{{ old('businessEstablishmentYear') }}" required>

                                                    @error('businessEstablishmentYear')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div> <br>
                                                <br><br>
                                                <div class="col-md-4">
                                                    <div class="form-group row">
                                                        <label><strong>CBE  Account Number</strong></label>
                                                        <div class="col-sm-9">
                                                            <input type="number" value="0"
                                                                class="form-control  @error('CBEBank_Account_Number') is-invalid @enderror"
                                                                id="CBEBank_Account_Number" name="CBEBank_Account_Number"
                                                                >
                                                            @error('CBEBank_Account_Number')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group row">
                                                        <label><strong>Amhara bank Account Number</strong></label>
                                                        <div class="col-sm-9">
                                                            <input type="number" value="0"
                                                                class="form-control  @error('AmharaBank_Account_Number') is-invalid @enderror"
                                                                id="AmharaBank_Account_Number" name="AmharaBank_Account_Number"
                                                                >
                                                            @error('AmharaBank_Account_Number')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group row">
                                                        <label><strong>Hibret  Account Number</strong></label>
                                                        <div class="col-sm-9">
                                                            <input type="number" value="0"
                                                                class="form-control  @error('HibretBank_Account_Number') is-invalid @enderror"
                                                                id="HibretBank_Account_Number" name="HibretBank_Account_Number"
                                                                >
                                                                {{-- value="{{ $profile->HibretBank_Account_Number }}" --}}
                                                            @error('HibretBank_Account_Number')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="submit"
                                                    class="form form-control btn btn-outline-success mt-5" value="Submit">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </main>
                                {{-- @include('layout.footer') --}}
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
