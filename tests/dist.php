<?php
   $js = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins=621%20Holloway%20Ave,%20SF%20CA&destinations=Lake%20Tahoe,%20CA&mode=driving&language=en-US&sensor=false&units=imperial");
?>
<!DOCTYPE html> 
<html>
   <head>
      <meta charset="utf-8">
      <title></title>
      <link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
      <style>
         body, input, select { margin:0;padding:0;font-size:14px;font-family:Quicksand, Times, serif; }
         h1, h2, h3, h4, h5 { font-family: Quicksand, "Helvetica Neue", Optima, Verdana, sans-serif; }
         a { text-decoration:none;color:#00c; }
         a:hover { text-decoration:underline; }
         a:visited { color:#006; }
         a:active { color:#e00;display:inline-block;top:2px; }
         #main { margin:1em; }
         label { display: inline-block; width:8em; text-align:right; }
         label:after { content: ": "; }
         form { line-height:2em; }
      </style>
  </head>
   <body>
      <div id='main'>
         <form onsubmit="return false">
            <label>Origin</label> <input type='text' id='origin' size='50' value='621 Holloway Ave, SF CA'><br>
            <label>Destination</label> <input type='text' id='dest' size='50' value='Lake Tahoe, CA'><br>
            <label>Language</label> <input type='text' size='6' id='lang' value='en-US'><br>
            <label>Mode</label> <select id='mode'><option value='google.maps.TravelMode.DRIVING' selected='selected'>driving</option><option value='google.maps.TravelMode.WALKING'>walking</option><option value='google.maps.TravelMode.BICYCLING'>Bicycling</option></select><br>
            <label>Units</label> <select id='units'><option selected='selected'>imperial</option><option>metric</option></select><br>
            <button id='distButton'>Get Travel Time</button>
            <hr>
            <span id="distance"></span>
         </form>
      </div>
   </body>
   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   <script type="text/javascript" src="/lib/js/geo.js"></script>
   <script type='text/javascript'>
      
      function show(data, status) {
         $("#distance").html(data.rows[0]['elements'][0].distance.text + " / " + data.rows[0]['elements'][0].duration.text);
      }
      
      $(document).ready(function() {
         $("#distButton").click(function() {
            
            getDistance($("#origin").val(), $("#dest").val(), $("#distance"), $("#mode").val(), $("#units").val());
         });
      });
   </script>
</html>
