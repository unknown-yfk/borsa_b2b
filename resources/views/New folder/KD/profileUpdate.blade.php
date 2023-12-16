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
<script>

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  }
}

function showPosition(position) {
    document.getElementById("latitude").value =  position.coords.latitude ;
    document.getElementById("longitude").value =  position.coords.longitude;
}
</script>
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6FjTNtaiuf3PGaAVvVFHYgc6M_tdM24k&callback=initMap&libraries=places&v=weekly"
      async></script>
   <script>
      function initMap() {
         const map = new google.maps.Map(document.getElementById("map"), {
           center: { lat: 40.749933, lng: -73.98633 },
           zoom: 13,
           mapTypeControl: false,
         });
         const card = document.getElementById("pac-card");
         const input = document.getElementById("pac-input");
         const input1 = document.getElementById("pac-role");
         const biasInputElement = document.getElementById("use-location-bias");
         const strictBoundsInputElement = document.getElementById("use-strict-bounds");

         const options = {
           fields: ["formatted_address", "geometry", "name"],
           strictBounds: false,
           types: ["establishment"],
         };

         map.controls[google.maps.ControlPosition.TOP_LEFT].push(card);

         const autocomplete = new google.maps.places.Autocomplete(input, options);

         autocomplete.bindTo("bounds", map);

         const infowindow = new google.maps.InfoWindow();
         const infowindowContent = document.getElementById("infowindow-content");

         infowindow.setContent(infowindowContent);

         const marker = new google.maps.Marker({
           map,
           anchorPoint: new google.maps.Point(0, -29),
         });

         autocomplete.addListener("place_changed", () => {
           infowindow.close();
           marker.setVisible(false);

           const place = autocomplete.getPlace();

           if (!place.geometry || !place.geometry.location) {

             window.alert("No details available for input: '" + place.name + "'");
             return;
           }

           // If the place has a geometry, then present it on a map.
           if (place.geometry.viewport) {
             map.fitBounds(place.geometry.viewport);
           } else {
             map.setCenter(place.geometry.location);
             map.setZoom(17);
           }
            $('#pac-role').val(place.geometry.location.lng());
            $('#pac-lan').val(place.geometry.location.lat());

           marker.setPosition(place.geometry.location);
           marker.setVisible(true);
           infowindowContent.children["place-name"].textContent = place.name;
           infowindowContent.children["place-address"].textContent =
             place.formatted_address;
           infowindow.open(map, marker);
         });

       }
       </script>
</head>
<body class="sb-nav-fixed"    onload= "initMap()">
    @include('sweetalert::alert')
    @include('nav.kd_navbar')
        <div id="layoutSidenav">
           @include('Sidenavbar.kdSidebar')
            <div id="layoutSidenav_content">
                <main>
                    <<div class="container-fluid px-4">
                        <h1 class="mt-4">Profile Update</h1>
                        <div class="row">
                        <div class="card-body">
                        <div class="card mb-4">
                            <div class="card-header">
                               <strong>Change Your Information and Click Submit !!</strong>
                            </div>
                            <div class="container rounded bg-white mt-5 mb-5">
                    <div class="row mt-2">
                    <center>
                        <form action="/key_distro/update/edits" method= "POST" enctype="multipart/form-data"></center>
                    @foreach($kdProfile as $profile)
                    @csrf
                    @method('PUT')
                        <div class="col-md-6"><label class="labels">First Name</label>
                        <input type="text" class="form-control" placeholder="" id="firstName" name="firstName"  value="{{$profile->firstName }}"></div>
                        <div class="col-md-6"><label class="labels">Middle Name</label>
                        <input type="text" class="form-control"  placeholder="Phone number" id="middleName" name="middleName"  value="{{$profile->middleName }}"></div>
                        <div class="col-md-6"><label class="labels">Last Name</label>
                        <input type="text" class="form-control" placeholder="your home address" id="lastName" name="lastName"  value="{{$profile->lastName }}"></div>
                        <div class="col-md-6"><label class="labels">User Name</label>
                        <input type="text" class="form-control" placeholder="Phone number" id="userName" name="userName"  value="{{$profile->userName }}"></div>
                        <div class="col-md-6"><label class="labels">E-mail</label>
                        <input type="text" class="form-control" placeholder="" id="email" name="email"  value="{{$profile->email }}"></div>

                        <!--<div class="col-md-6"> <label class="labels">Home Address </label>
                        <input type="text" class="form-control floating" name="address" id="pac-input" tabindex="10">
                                         <div id="map">
                                         </div>
                                        -- <div id="infowindow-content">
                                             <span id="place-name" class="title"></span><br />
                                             <span id="place-address"></span>
                                         </div>
                                         <input name="lng" id="pac-role" type="hidden">
                                         <input name="lat" id="pac-lan" type="hidden"></div>-->


    <div class="col-md-6"><label class="labels">Mobile</label>
                        <input type="text" class="form-control"  placeholder="Phone number" id="mobile" name="mobile" value="{{$profile->mobile }}"></div>
                        <div class="col-md-6"><label class="labels">attach your Goverment ID</label>
                        <input type="file" class="form-control" value="" placeholder="" id="id_path" name="id_path"></div>
                        <div class="col-md-6"><label class="labels">ID type</label>
                        <select id="ID_type" name="ID_type"  class="form-control" >

        <option value="{{$profile->ID_type }}" selected>{{$profile->ID_type }}</option>
        <option value="woreda ID">wordera ID</option>
        <option value="passport">PASSPORT</option>
        <option value="driving licence">driving licence</option>
        <option value="temporary">temporary id</option>
      </select></div>
                        <div class="col-md-6"><label class="labels">ID number </label>
                        <input type="text" class="form-control" value="{{$profile->ID_number }}" placeholder="id number" id="ID_number" name="ID_number"></div>
                        <div class="col-md-6"><label class="labels">ID issue date </label>
                        <input type="date" class="form-control" value="{{$profile->ID_issue_date }}" placeholder="when was you id issued" id="ID_issue_date" name="ID_issue_date"></div>
                        <div class="col-md-6"><label class="labels">ID expiry date </label>
                        <input type="date" class="form-control" value="{{$profile->ID_expiry_date }}" placeholder="when will it expire" id="ID_expiry_date" name="ID_expiry_date"></div>
                        <div class="col-md-6"><label class="labels">business Name </label>
                        <input type="text" class="form-control" value="{{$profile->businessName }}" placeholder="business name" id="businessName" name="businessName"></div>
                        <div class="col-md-6"><label class="labels">business Type </label>
                        <input type="text" class="form-control" value="{{$profile->businessType }}" placeholder="business type" id="businessType" name="businessType"></div>
                        <div class="col-md-6"> <label class="labels">Business Address </label>
                        <input type="text" class="form-control floating" name="businessAddress" id="pac-input" tabindex="10" value="{{$profile->businessAddress }}">
                                         <div id="map">
                                         </div>
                                         <div id="infowindow-content">
                                             <span id="place-name" class="title"></span><br />
                                             <span id="place-address"></span>
                                         </div>
                                         <input name="lng" id="pac-role" type="hidden">
                                         <input name="lat" id="pac-lan" type="hidden"> </div>

                        <div class="col-md-6"><label class="labels">Attach your buisness licence </label>
                        <input type="file" class="form-control" value="" placeholder="" id="licenceFilePath" name="licenceFilePath"></div>
                        <div class="col-md-6"><label class="labels">licence Number </label>
                        <input type="text" class="form-control" value="{{$profile->licenceNumber }}" placeholder="licence number" id="licenceNumber" name="licenceNumber"></div>
                        <div class="col-md-6"><label class="labels">Licence issue date </label>
                        <input type="date" class="form-control" value="{{$profile->issueDate }}" placeholder="" id="issueDate" name="issueDate"></div>
                        <div class="col-md-6"><label class="labels">Licence expiry Date </label>
                        <input type="date" class="form-control" value="{{$profile->expiryDate }}" placeholder="" id="expiryDate" name="expiryDate"></div>
                        <div class="col-md-6"><label class="labels">Tin number </label>
                        <input type="text" class="form-control" value="{{$profile->tinNumber }}" placeholder="you goverment issued tin number" id="tinNumber" name="tinNumber"></div>
                        <div class="col-md-6"><label class="labels">When was Your Buisness established </label>
                        <input type="text" class="form-control" value="{{$profile->businessEstablishmentYear }}" placeholder="eg: 2002" id="businessEstablishmentYear" name="businessEstablishmentYear"></div>
                        <br><br>
                        <input type="submit" class="form-control btn btn-outline-success mt-4" value="Submit">
                        <input type="reset" class="form-control btn btn-outline-danger mt-4" value="Clear"></div>
                   @endforeach
                      </form>
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
