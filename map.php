<!DOCTYPE html>
<html>
  <head>
    <title>Google Maps JavaScript API v3 Example: Map Simple</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta charset="UTF-8">
    <style type="text/css">
      html, body, #map_canvas {
        margin: 0;
        padding: 0;
        height: 100%;
      }
    </style>
    <script type="text/javascript"
        src="//maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
      var map, geocoder;
      
      function initialize() {
         geocoder = new google.maps.Geocoder();   
         var myOptions = {
            zoom: 14,
            center: new google.maps.LatLng(-34.397, 150.644),
            mapTypeId: google.maps.MapTypeId.ROADMAP
         };
         
         map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);
         codeAddress('<?php print $_REQUEST['address']; ?>');
      }

      function codeAddress(address) {
         geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
               map.setCenter(results[0].geometry.location);
               var marker = new google.maps.Marker({
                  map: map,
                  position: results[0].geometry.location
               });
             } else {
                alert("Geocode was not successful for the following reason: " + status);
             }
         });
      }

      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
    <div id="map_canvas"></div>
  </body>
</html>
