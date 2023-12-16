


@extends('layouts.mainlayout')
@section('content')



<div class="main-panel">
        <div class="content-wrapper">
          <div class="row">

            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{__('messages.ChangePassword')}}</h4>
                  <form class="form-sample" action="key_distro/password/change/post" method="POST" enctype="multipart/form-data">
                    @csrf
                    <p class="card-description">
                     {{__('messages.ChangePassword')}}
                    </p>
                                    <div class="row mt-2">

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="current_password"
                                                                    class="control-label">{{__('messages.current_password')}}</label>
                                                                <input type="password" name="current_password"
                                                                    id="current_password" value=""
                                                                    class="form-control @error('current_password') is-invalid @enderror"
                                                                    required autocomplete="off">
                                                                @error('current_password')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row gy-4">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="password"
                                                                    class="control-label">{{__('messages.new_password')}}</label>
                                                                <input type="password" name="new_password" id="new_password"
                                                                    class="form-control @error('new_password') is-invalid @enderror"
                                                                    required autocomplete="off">
                                                                @error('new_password')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="password_confirmation"
                                                                    class="control-label">{{__('messages.confirm_password')}}</label>
                                                                <input type="password" name="new_password_confirmation"
                                                                    id="new_password_confirmation"
                                                                    class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                                                    required autocomplete="off">
                                                                @error('new_password_confirmation')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer border-top ">
                                                    <button type="submit"
                                                        class="btn btn-primary  float-right">{{__('messages.Save')}}</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
</div>
                            </div>
                        </div>
          </div>
        </div>
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ url('js/scripts.js') }}"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ url('assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ url('assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="{{ url('js/datatables-simple-demo.js') }}"></script> --}}
@endsection
