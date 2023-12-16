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
