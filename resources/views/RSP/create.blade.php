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
                                Fill the Form and Click Submit To Complete Profile Setup
                            </div>
                            <div class="card-body">
                                <div class="container rounded bg-white mt-5 mb-5">

                                    <div class="row mt-2">
                                        <center>
                                            <form action="/rsp/create/posts" method="POST"
                                                enctype="multipart/form-data">
                                        </center>
                                        @csrf
                                        <div class="col-md-6">
                                            <label class="labels">User Photo</label>
                                            <input type="file"
                                                class="form-control @error('profilePicture') is-invalid @enderror"
                                                id="profilePicture" name="profilePicture">
                                            @error('profilePicture')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6"> <label class="labels"><strong>Home Address</strong></label>
                                            <input type="text"
                                                class="form-control floating form-control @error('address') is-invalid @enderror"
                                                    name="address" id="homeAddress"
                                                tabindex="10" value="{{ old('address') }}"required>
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
                                        </div>
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

                                        <div class="col-md-6"><label class="labels"><strong>Your Goverment
                                                    ID</strong></label>
                                            <input type="file"
                                                class="form-control @error('id_path') is-invalid @enderror"
                                                placeholder="" id="id_path" name="id_path"  value="{{ old('id_path') }}"required>
                                            @error('id_path')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6"><label class="labels"><strong>ID type</strong></label>

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
                                        <div class="col-md-6"><label class="labels"><strong>ID number</strong> </label>
                                            <input type="text"
                                                class="form-control @error('ID_number') is-invalid @enderror" id="ID_number"
                                                name="ID_number"  value="{{ old('ID_number') }}" required>
                                            @error('ID_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6"><label class="labels"><strong>ID Issue Date
                                                </strong></label>
                                            <input type="date"
                                                class="form-control @error('ID_issue_date') is-invalid @enderror" id="ID_issue_date"
                                                name="ID_issue_date"  value="{{ old('ID_issue_date') }}" required>
                                            @error('ID_issue_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6"><label class="labels"><strong>ID Expiry Date
                                                </strong></label>
                                            <input type="date"
                                                class="form-control @error('ID_expiry_date') is-invalid @enderror" id = "ID_expiry_date"
                                                name="ID_expiry_date" value="{{ old('ID_expiry_date') }}" required>
                                            @error('ID_expiry_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <input type="submit" class="form form-control btn btn-outline-success mt-5"
                                            value="Submit">
                                        <input type="reset" class="form form-control btn btn-outline-danger mt-2"
                                            value="Clear">
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
