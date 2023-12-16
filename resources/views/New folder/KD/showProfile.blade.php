<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>e-pace</title>
    <link href="{{ url('css/styles.css') }}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
<link href="css/styles.css" rel="stylesheet" />
<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>


<style>
body {
    background: rgb(99, 39, 120)
}

.form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels {
    font-size: 11px
}

.add-experience:hover {
    background: #BA68C8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #BA68C8
}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="{{ url('js/scripts.js') }}"></script>
<script src=" https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="{{url ('assets/demo/chart-area-demo.js')}}"></script>
<script src="{{url ('assets/demo/chart-bar-demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="{{url ('js/datatables-simple-demo.js') }}"></script>
</head>
<body class="sb-nav-fixed">
    @include('nav.kd_navbar')
        <div id="layoutSidenav">
            @include('Sidenavbar.kdSidebar')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">My Profile</h1>
                        <div class="row">
                        <div class="card mb-4">
                            <div class="card-body">
                            <div class="container rounded bg-white mt-5 mb-5">
                    <div class="row mt-2">
                    @foreach($kdProfile as $profile)
                    <div class="col-md-6"><label class="labels">First Name</label>
                        <p class="form-control">{{ $profile->firstName }}</p></div>
                        <div class="col-md-6"><label class="labels">Middle Name</label>
                        <p class="form-control" >{{$profile->middleName}}</p></div>
                        <div class="col-md-6"><label class="labels">Last Name</label>
                        <p class="form-control">{{$profile->lastName}}</p></div>
                        <div class="col-md-6"><label class="labels">User Name</label>
                        <p class="form-control" >{{$profile->userName}}</p></div>
                        <div class="col-md-6"><label class="labels">Email</label>
                        <p class="form-control">{{$profile->email}}</p></div>
                        <div class="col-md-6"><label class="labels">Resident Address</label>
                        <p class="form-control" >{{$profile->address}}</p></div>
                        <div class="col-md-6"><label class="labels">Phone Number</label>
                        <p class="form-control">{{$profile->mobile}}</p></div>
                        <div class="col-md-6"><label class="labels">ID type</label>
                        <p class="form-control" >{{$profile->ID_type}}</p></div>
                        <div class="col-md-6"><label class="labels">ID number</label>
                        <p class="form-control">{{$profile->ID_number}}</p></div>
                        <div class="col-md-6"><label class="labels">ID issue date</label>
                        <p class="form-control" >{{$profile->ID_issue_date}}</p></div>
                        <div class="col-md-6"><label class="labels">ID expiry date</label>
                        <p class="form-control">{{$profile->ID_expiry_date}}</p></div>
                        <div class="col-md-6"><label class="labels">Business Name</label>
                        <p class="form-control" >{{$profile->businessName}}</p></div>
                        <div class="col-md-6"><label class="labels">Buisness Type</label>
                        <p class="form-control">{{$profile->businessType}}</p></div>
                        <div class="col-md-6"><label class="labels">Busienss Address</label>
                        <p class="form-control" >{{$profile->businessAddress}}</p></div>
                        <div class="col-md-6"><label class="labels">Buisness Licence Number</label>
                        <p class="form-control">{{$profile->licenceNumber}}</p></div>
                        <div class="col-md-6"><label class="labels">issue date</label>
                        <p class="form-control" >{{$profile->issueDate}}</p></div>
                        <div class="col-md-6"><label class="labels">expiry date</label>
                        <p class="form-control">{{$profile->expiryDate}}</p></div>
                        <div class="col-md-6"><label class="labels">Tin Number</label>
                        <p class="form-control" >{{$profile->tinNumber}}</p></div>
                        <div class="col-md-6"><label class="labels">Business establishment year</label>
                        <p class="form-control" >{{$profile->businessEstablishmentYear}}</p></div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</main>
    @include('layout.footer')
    </div>
</div>
   </body>
</html>
