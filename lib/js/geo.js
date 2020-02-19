function getDistance(origin, dest, tgt, mode, unit) {
   mode = mode ? mode : 'driving';
   unit = unit ? unit : 'imperial';
   tgt  = tgt  ? tgt  : $("<div/>").appendTo($("body"));

   var url = "/tools/distance.php?origin=" + encodeURI(origin) + "&dest=" + encodeURI(dest) + "&mode=" + mode + "&unity=" + unit + "language=en-US&sensor=false";

   $.getJSON(url, function(data) {
      $(tgt).html(
         data.rows[0]['elements'][0].distance.text + " / " + 
         data.rows[0]['elements'][0].duration.text
      );
   });
}

function codeAddress() {
    var address = document.getElementById("address").value;
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
