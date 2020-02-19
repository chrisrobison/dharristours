
<!DOCTYPE html>
<html>
  <head>
    <title>Google Maps API v3 Example: Distance Matrix</title>
    <script src="//maps.googleapis.com/maps/api/js?sensor=false"></script>
    </script>
    

    <style type="text/css">
      body {
        margin: 20px;
        font-family: courier, sans-serif;
        font-size: 12px;
      }
      #map {
        height: 480px;
        width: 640px;
        border: solid thin #333;
        margin-top: 20px;
      }
    </style>

  </head>
  <body onload="initialize()">
    <div id="inputs">
      <p><label>Origin: </label> <input type='text' id='origin' value='621 Holloway Ave, SF CA'></p>
      <p><label>Destination: </label> <input type='text' id='dest' value='Lake Tahoe, CA'></p>
      <p><button type="button" onclick="calculateDistances();">Calculate distances</button></p>
    </div>
    <div id="outputDiv"></div>
    <div id="map"></div>
    <script>
      $(function() {
         var map;
         var geocoder;
         var bounds = new google.maps.LatLngBounds();
         var markersArray = [];
         
         var origin = $("#origin").val();
         var dest = $("#dest").val();

         var destinationIcon = "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=D|FF0000|000000";
         var originIcon = "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=O|FFFF00|000000";

         function initialize() {
           var opts = {
             center: new google.maps.LatLng(37.7643286, -122.4943836),
             zoom: 10,
             mapTypeId: google.maps.MapTypeId.ROADMAP
           };
           map = new google.maps.Map(document.getElementById('map'), opts);
           geocoder = new google.maps.Geocoder();
         }
       
         function calculateDistances() {
            origin = $("#origin").val();
            dest = $("#dest").val();

           var service = new google.maps.DistanceMatrixService();
           service.getDistanceMatrix(
             {
               origins: [origin],
               destinations: [dest],
               travelMode: google.maps.TravelMode.DRIVING,
               unitSystem: google.maps.UnitSystem.IMPERIAL,
               avoidHighways: false,
               avoidTolls: false
             }, callback);
         }

         function callback(response, status) {
           if (status != google.maps.DistanceMatrixStatus.OK) {
             alert('Error was: ' + status);
           } else {
             var origins = response.originAddresses;
             var destinations = response.destinationAddresses;
             var outputDiv = document.getElementById('outputDiv');
             outputDiv.innerHTML = '';
             deleteOverlays();

             for (var i = 0; i < origins.length; i++) {
               var results = response.rows[i].elements;
               addMarker(origins[i], false);
               for (var j = 0; j < results.length; j++) {
                 addMarker(destinations[j], true);
                 outputDiv.innerHTML += origins[i] + " to " + destinations[j]
                     + ": " + results[j].distance.text + " in "
                     + results[j].duration.text + "<br />";
               }
             }
           }
         }

         function addMarker(location, isDestination) {
           var icon;
           if (isDestination) {
             icon = destinationIcon;
           } else {
             icon = originIcon;
           }
           geocoder.geocode({'address': location}, function(results, status) {
             if (status == google.maps.GeocoderStatus.OK) {
               bounds.extend(results[0].geometry.location);
               map.fitBounds(bounds);
               var marker = new google.maps.Marker({
                 map: map,
                 position: results[0].geometry.location,
                 icon: icon
               });
               markersArray.push(marker);
             } else {
               alert("Geocode was not successful for the following reason: "
                 + status);
             }
           });
         }
         
         function deleteOverlays() {
           if (markersArray) {
             for (i in markersArray) {
               markersArray[i].setMap(null);
             }
             markersArray.length = 0;
           }
         }
      });
    </script>
  </body>
</html>
