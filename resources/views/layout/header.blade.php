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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/css-layout/1.1.1/css-layout.min.js" integrity="sha512-WeFxT4bqnrM1Laaz9RzBX3ttu+vleafd9wICGomR7KUPmaJUf6+Ysu9Zoqm4UyEjgsIArS4JsnHSWrPKOACDgQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.6.0/pagination.min.css" integrity="sha512-K1k7jSn9RDKEcn/ugqVVvWYu0bcS3q1w6m/5pQSnrj0bCfIqF6Wk49lkmckSb4wglvTP9V17LtS0q0XxYccXbg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.21.4/bootstrap-table.min.js" integrity="sha512-rZAhvMayqW5e/N+xdp011tYAIdxgMMJtKxUXx7scO4iBPSUXAKdkrKIPRu6tLr0O9V6Bs9QujJF3MqmgSNfYPA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.7/metisMenu.min.js" integrity="sha512-o36qZrjup13zLM13tqxvZTaXMXs+5i4TL5UWaDCsmbp5qUcijtdCFuW9a/3qnHGfWzFHBAln8ODjf7AnUNebVg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sidebar/0.2.2/js/sidebar.min.js" integrity="sha512-Xi6aCyh+yjpOerq/MaYflpETc1+Mumal7xdoISqm4AVSDRH5ChsB7AMJjU0/iJkKJuCs8JHI8GnFKAk4005VYw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.6.0/pagination.min.js" integrity="sha512-GzbaI5EsNzdEUq6/2XLYpr1y9CUZRIVsUeWTAFgULtQa5jZ3Nug8i0nZKM6jp9NffBCZhymPPQFcF0DK+JkRpw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
