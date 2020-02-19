<!DOCTYPE html>
<html>
  <head>
    <title>Google Maps Simple</title>
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
    <script type="text/javascript">
        src="//www.google.com/maps/?q=<?php print $_REQUEST['address']; ?>";
	window.location.href = src;
    </script>
  </head>
  <body>
    <div id="map_canvas"></div>
  </body>
</html>
