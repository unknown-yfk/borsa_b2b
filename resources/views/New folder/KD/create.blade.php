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
<link href="{{ url('https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css') }}" rel="stylesheet" />
<link href="css/styles.css" rel="stylesheet" />
<script src="{{url ('https://use.fontawesome.com/releases/v6.1.0/js/all.js') }}" crossorigin="anonymous"></script>

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

    <body class="sb-nav-fixed" onload="getLocation()">

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="//key_distroDashboard"> {{ Auth::user()->firstName }} {{ Auth::user()->middleName }}</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

            </form>
            <!-- Navbar-->
            @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <ul class="navbar-nav float-end ">
                          <!-- ============================================================== -->
                          <!-- Comment -->
                          <!-- ============================================================== -->




                          </li>
                          <!-- ============================================================== -->
                          <!-- End Comment -->
                          <!-- ============================================================== -->


                          <!-- ============================================================== -->
                          <!-- User profile and search -->
                          <!-- ============================================================== -->
                          <li class="nav-item dropdown">
                              <a class="
                    nav-link
                    dropdown-toggle
                    text-muted
                    waves-effect waves-dark
                    pro-pic
                  "
                                  href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                  aria-expanded="false">
                                  <img src="" alt="{{ Auth::user()->userName }}"
                                      class="rounded-circle" width="31" />

                              </a>
                              <ul class="dropdown-menu dropdown-menu-end user-dd animated"
                                  aria-labelledby="navbarDropdown">
                                  @if (auth()->user()->key_distro == Null)
                                  <a class="dropdown-item" href="/key_distro/create/post"><i
                                    class="mdi mdi-settings me-1 ms-1"></i> Set-Up Account</a>
                                  @else

                                    <a class="dropdown-item" href="/key_distroProfile"><i
                                        class="mdi mdi-account me-1 ms-1"></i> My Profile</a>
                                  @endif
                                  <div class="ps-4 p-10">
                                      <li>
                                          <form action="{{ route('logout') }}" method="post">
                                              @csrf
                                              <input class="btn btn-sm btn-success btn-rounded text-white" type="submit"
                                                  value="Logout">
                                          </form>
                                      </li>
                                  </div>
                              </ul>
                          </li>
                          <!-- ============================================================== -->
                          <!-- User profile and search -->
                          <!-- ============================================================== -->
                      </ul>

                        @endguest
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading"></div>
                            <a class="nav-link" href="/key_distroDashboard">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                               Profile
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/key_distroProfile/show">show profile</a>
                                    <a class="nav-link" href="/key_distro/update/edit">update profile</a>

                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#"  aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                              clients

                            </a>




                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                              orders
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                      New Orders
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>

                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                     delivered Orders
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>

                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Product Stocks</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                               Add new Product stock
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                              view Product stocks
                            </a>
                        </div>
                    </div>

                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
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
                    <center><form action="/key_distros/create/posts" method= "POST" enctype="multipart/form-data"></center>
                    @csrf

                    <div class="col-md-6"><label class="labels">Address</label>
                        <input type="text" class="form-control" placeholder="your home address" id="address" name="address"></div>
                        <div class="col-md-6"><label class="labels">Mobile</label>
                        <input type="text" class="form-control" value="" placeholder="Phone number" id="mobile" name="mobile"></div>
                        <div class="col-md-6"><label class="labels">attach your Goverment ID</label>
                        <input type="file" class="form-control" value="" placeholder="" id="id_path" name="id_path"></div>
                        <div class="col-md-6"><label class="labels">ID type</label>
                        <select id="ID_type" name="ID_type"  class="form-control">

        <option value="woreda ID">wordera ID</option>
        <option value="passport">PASSPORT</option>
        <option value="driving licence">driving licence</option>
        <option value="temporary">temporary id</option>
      </select></div>
                        <div class="col-md-6"><label class="labels">ID number </label>
                        <input type="text" class="form-control" value="" placeholder="id number" id="ID_number" name="ID_number"></div>
                        <div class="col-md-6"><label class="labels">ID issue date </label>
                        <input type="date" class="form-control" value="" placeholder="when was you id issued" id="ID_issue_date" name="ID_issue_date"></div>
                        <div class="col-md-6"><label class="labels">ID expiry date </label>
                        <input type="date" class="form-control" value="" placeholder="when will it expire" id="ID_expiry_date" name="ID_expiry_date"></div>
                        <div class="col-md-6"><label class="labels">business Name </label>
                        <input type="text" class="form-control" value="" placeholder="business name" id="businessName" name="businessName"></div>
                        <div class="col-md-6"><label class="labels">business type</label>
                        <select id="businessType" name="businessType"  class="form-control">

                        @foreach ( $businessType as $businessType)
  <option value="{{ $businessType->businessName }}"> {{ $businessType->businessName }}
   </option>
    @endforeach
      </select></div>
      <div class="col-md-6"> <label class="labels">Business Address </label>
        <input type="text" class="form-control floating" name="businessAddress" id="pac-input" tabindex="10">
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
                        <input type="text" class="form-control" value="" placeholder="licence number" id="licenceNumber" name="licenceNumber"></div>
                        <div class="col-md-6"><label class="labels">Licence issue date </label>
                        <input type="date" class="form-control" value="" placeholder="" id="issueDate" name="issueDate"></div>
                        <div class="col-md-6"><label class="labels">Licence expiry Date </label>
                        <input type="date" class="form-control" value="" placeholder="" id="expiryDate" name="expiryDate"></div>
                        <div class="col-md-6"><label class="labels">Tin number </label>
                        <input type="text" class="form-control" value="" placeholder="you goverment issued tin number" id="tinNumber" name="tinNumber"></div>
                        <div class="col-md-6"><label class="labels">When was Your Buisness established </label>
                        <input type="text" class="form-control" value="" placeholder="eg: 2002" id="businessEstablishmentYear" name="businessEstablishmentYear"></div>
                          <br>
                        <br><br>

                        <small><input type="submit" class="form-control" value="submit" ></small></div><br>
                        <input type="reset" class="form-control" value="clear" ></div>
                    </form>








                </div>
            </div>

    </div>



                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ url('js/scripts.js') }}"></script>
        <script src=" https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{url ('assets/demo/chart-area-demo.js')}}"></script>
        <script src="{{url ('assets/demo/chart-bar-demo.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="{{url ('js/datatables-simple-demo.js') }}"></script>
   </body>
</html>
