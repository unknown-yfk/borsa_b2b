{{-- @extends('layouts.app')
@section('content') --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Borsa</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{!! asset('that/vendors/mdi/css/materialdesignicons.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('that/vendors/base/vendor.bundle.base.css') !!}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{!! asset('that/css/style.css') !!}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{!! asset('that/images/favicon.png') !!}">


</head>

<body
    style="
    background-image: url('https://mdbcdn.b-cdn.net/img/Photos/Others/images/76.webp');
    height: 100vh;">
    @include('layout.partials.usertype.kd.kd-nav')
    <div class="container-fluid page-body-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Borsa') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
  {{ __('session expired, please, log out and back in to use the system!') }}

                                                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        {{-- @endsection --}}
        <script src="{!! asset('that/vendors/base/vendor.bundle.base.js') !!}"></script>
        <!-- endinject -->
        <!-- inject:js -->
        <script src="{!! asset('that/js/off-canvas.js') !!}"></script>
        <script src="{!! asset('that/js/hoverable-collapse.js') !!}"></script>
        <script src="{!! asset('that/js/template.js') !!}"></script>
        <!-- endinject -->
</body>

</html>
