


@extends('layouts.mainlayout')
@section('content')



<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">

            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{__('User Registeration')}}</h4>
                  <form class="form-sample" action="/admin/create/user/post" method="POST" enctype="multipart/form-data">
                    @csrf
                    <p class="card-description">
                      User info
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label>First Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control  @error('firstName') is-invalid @enderror"
                                 id="firstName" name="firstName" value="{{ old('firstName') }}"required>
                                            @error('firstName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label>Middle Name</label>
                          <div class="col-sm-9">
                              <input type="text" class="form-control  @error('middleName') is-invalid @enderror"
                                                id="middleName" name="middleName" value="{{ old('middleName') }}" required>

                                        @error('middleName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                            </div>
                         </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label>Last Name</label>
                          <div class="col-sm-9">
                           <input type="text" class="form-control  @error('lastName') is-invalid @enderror"
                                                id="lastName" name="lastName" value="{{ old('lastName') }}" required>
                                            @error('lastName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label>User Name</label>
                          <div class="col-sm-9">
                           <input type="text" class="form-control  @error('userName') is-invalid @enderror"
                                                id="userName" name="userName" value="{{ old('userName') }}"required>
                                            @error('userName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                          </div>
                        </div>
                      </div>
                    </div>

                     <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label>Email</label>
                          <div class="col-sm-9">
                             <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" autocomplete="email">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label>Select User Type</label>
                          <div class="col-sm-9">
                             <select id="userType" name="userType" class="form form-control">
                                                    <option value=""></option>

                                                    <option value="key distributor">Key Distributor</option>
                                                    <option value="ROM">ROM</option>
                                                    <option value="RSP">RSP</option>
                                                    <option value="agent">Agent</option>
                                                </select>
                                                @error('userType')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label>Password</label>
                          <div class="col-sm-9">
                            <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete ="off">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label>Confirm Password</label>
                          <div class="col-sm-9">
                           <input id="password-confirm" type="password" class="form-control"
                                                    name="password_confirmation" required autocomplete="off">
                          </div>
                        </div>
                      </div>
                    </div>


                        <div class="row">

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label>Status</label>
                          <div class="col-sm-9">
                             <select id="status" name="status" class="form form-control">
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
                    </div>
                     <div class="row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-outline-success"
                                                    onsubmit="setTimeout()">
                                                    {{ __('Register') }}
                                                </button>
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













































