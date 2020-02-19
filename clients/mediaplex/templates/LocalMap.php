<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Local Search</title>
   <!-- maps api, ajax search api, map search control code -->
   <script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAAB4Tz-wcF9vqMlgFlZ1il0RQ4iVP1jbh0iZGyZWzqULlBXSn13BSReqM1_ynNZiV3b-FxwmqxPPHCGQ" type="text/javascript"></script>
   <script src="http://www.google.com/uds/api?file=uds.js&v=1.0&key=ABQIAAAAB4Tz-wcF9vqMlgFlZ1il0RQ4iVP1jbh0iZGyZWzqULlBXSn13BSReqM1_ynNZiV3b-FxwmqxPPHCGQ" type="text/javascript"></script>
   <script src="http://www.google.com/uds/solutions/mapsearch/gsmapsearch.js" type="text/javascript"></script>

   <!-- ajax search stylesheet, map search stylesheet -->
   <link href="http://www.google.com/uds/css/gsearch.css" rel="stylesheet" type="text/css"/>
   <link href="http://www.google.com/uds/solutions/mapsearch/gsmapsearch.css" rel="stylesheet" type="text/css"/>
   <style>
      #mapsearch { width:300px;height:250px;margin:10px;padding:4px;border:1px solid #f9f9f9; }
      #mapsearch .gsmsc-idleMapDiv { height : 200px; }
      #mapsearch .gsmsc-mapDiv { height : 300px; }
   </style>
   <script language="Javascript" type="text/javascript">
   //<![CDATA[
         function LoadMapSearch() {
            var options = {
               zoomControl : GSmapSearchControl.ZOOM_CONTROL_ENABLE_ALL,
               title : "Best Buy Locations",
               url : "http://www.11oclocktoast.org/",
               idleMapZoom : GSmapSearchControl.ACTIVE_MAP_ZOOM,
               activeMapZoom : GSmapSearchControl.ACTIVE_MAP_ZOOM,
               showResultList : GSmapSearchControl.DEFAULT_RESULT_LIST
            };

           myMapControl = new GSmapSearchControl(
                 document.getElementById("mapsearch"),             // container
                 "San Francisco, CA",   // center point
                 options
                 );
         }
         /**
          * Arrange for LoadMapSearch to run once the page loads.
          */
         GSearch.setOnLoadCallback(LoadMapSearch);
    //]]>
    </script>
  </head>
  <body>
    <div id="mapsearch">Loading...</div>
  </body>
</html>
