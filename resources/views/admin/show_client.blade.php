@extends('layouts.mainlayout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">

                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mt-2">
                                <div class="col-md-6 mt-6"><label class="labels"><strong> First Name</strong></label>
                                    <input type="text" class="form-control  @error('firstName') is-invalid @enderror"
                                        placeholder="First Name" id="firstName" name="firstName"
                                        value="{{ $user[0]->firstName }}" disabled>
                                    @error('firstName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6"><label class="labels"><strong>Middle Name</strong></label>
                                    <input type="text" class="form-control @error('middleName') is-invalid @enderror"
                                        placeholder="Middle Name" id="middleName" name="middleName"
                                        value="{{ $user[0]->middleName }}" disabled>
                                    @error('middleName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6"><label class="labels"><strong>Last Name</strong></label>
                                    <input type="text" class="form-control   @error('lastName') is-invalid @enderror"
                                        placeholder="Last Name" id="lastName" name="lastName"
                                        value="{{ $user[0]->lastName }}" disabled>
                                    @error('lastName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-6 mt-6"><label class="labels"><strong> Client Unique
                                                Id</strong></label>
                                        <input type="text"
                                            class="form-control  @error('client_unique_id') is-invalid @enderror"
                                            placeholder="Client Unique Id" id="client_unique_id" name="client_unique_id"
                                            value="{{ $client->client_unique_id }}" disabled>
                                        @error('client_unique_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6"><label class="labels"><strong>Pin Code</strong></label>
                                        <input type="text" class="form-control @error('PinCode') is-invalid @enderror"
                                            placeholder="PinCode" id="PinCode" name="PinCode"
                                            value="{{ $client->PinCode }}"required>
                                        @error('PinCode')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6"><label class="labels"><strong>QrPassword</strong></label>
                                        <img src="data:image/png;base64, {!! base64_encode(
                                            QrCode::format('png')->merge('/public/uploads/Elebat_Logo.png', 0.3, false)->size(400)->color(37, 42, 197)->gradient(37, 42, 197, 1, 2, 5, 'horizontal')->errorCorrection('H')->eyeColor(1, 226, 167, 67, 22, 33, 88)->generate($client->QRPassword),
                                        ) !!}">
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endsection
