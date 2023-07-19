<!DOCTYPE html>
<html>
  <head>
    <title>Realtime Bus Locations</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      * {
        box-sizing: border-box;
      }
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      h2 {
         padding-bottom:0px;
         margin-bottom:.25em;
         margin-top:.125em;
      }
      .labels { 
         background-color:#ffffff;
         padding:.25em;
         display:inline-block;
         border:.5em solid yellow;
      }
      .time {
         text-align:right;
      }
      .locations {
         border-collapse: collapse;
         border:0px;
         width:100%;
      }
       .details {
         border-collapse: collapse;
         border:1px solid #ccc;
         width:100%;
      }
      td, th {
         padding:.5em;
         vertical-align: top;
      }
      .details td { border-bottom: 1px solid #aaa; }
      th {
         background-color:#333;
         color:#ffffff;
         font-weight:bold;
         white-space: nowrap;
      }
      .subtable {
         margin:0px;
         padding:0px;
         font-size:.8em;
      }
      .subtable th {
         text-align:right;
         width:4em;
      }
      div.leaflet-pane div.mycluster {
        width: 5vw;
        height: 5vw;
        background-image: url("/portal/assets/bus-cluster.png");
        background-repeat: no-repeat;
        background-size: contain;
        background-position: center;
        border-radius: 50%;
        font-size: 1vw;
        background-color:#09f0;
        color: #ff0;
        text-shadow: 1px 1px 0px #000;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }
      div.mycluster span {
        background-color: #f009;
        color:#ff0;
        border-radius: 50%;
        width: 1.5vw;
        height: 1.5vw;
        text-align: center;
        transform: translate(0px, -1.5vw);
      }
      .marker-label {
        font-size: .8vw;
        background:#000;
        color:#0c0;
        height: 1vw;
        width: 3vw;
        text-align:center;
        font-weight: bold;
        position: relative;
        vertical-align: center;
        left: 22px;
      }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css"/>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script defer src="https://www.gstatic.com/firebasejs/7.7.0/firebase-app.js"></script>
    <script defer src="https://www.gstatic.com/firebasejs/7.7.0/firebase-analytics.js"></script>
    <script defer src="https://www.gstatic.com/firebasejs/7.7.0/firebase-auth.js"></script>
    <script defer src="https://www.gstatic.com/firebasejs/7.7.0/firebase-database.js"></script>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js" crossorigin=""></script>
    <script defer src="/where/init-firebase.js"></script>  
    <script defer src="/where/markerclustererplus.min.js"></script>  
    <script defer src="/portal/showwhere.js"> </script>
  </head>
  <body>
    <div id="map"></div>
    <!-- script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFP8KaKNAWOcD0iXL40U5VaKU0ZhY-oCA&callback=app.initMap"> </script-->
<script>
(function() {
    const $ = (str) => document.querySelector(str);
    const $$ = (str) => document.querySelectorAll(str);
    const params = new Proxy(new URLSearchParams(window.location.search), {
      get: (searchParams, prop) => searchParams.get(prop),
    });
    
    if (!window["app"]) window.app = app = {};

    app = {
        ...window["app"],
        init: function() {
            app.getCurrentPositions();
            
            app.map = L.map('map').setView([37.81, -122.29], 11);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>' }).addTo(app.map);
            
            app.state.loaded = true;
        },
        makeIcon: function(label) {
            return new L.DivIcon({
                className: 'mymarker',
                html: `<div class='marker-label'>${label}</div><img src='/portal/assets/bus4.png'>`,
                iconUrl: '/portal/assets/bus4.png',
                iconSize: L.point(75, 75), 
                popupAnchor: [0, -37]
            });

        },
        state: {
            loaded: false,
            markers: [],
            buses: [],
            icons: [],
            area: {},
            buses: [],
        },
        getParams: function() {
            let query = location.search.replace(/^\?/, '');
            let items = query.split(/&/);
            let out = {};
            items.forEach(item=>{
                let parts = item.split(/=/, 2);
                out[parts[0]] = parts[1];
            });

            return out;
        },
        update: function(data) {
            let query = app.getParams();
            if (query && query['bus']) {
                app.state.showBus = query['bus'].split(/\D/);
            }

            app.state.area = new L.FeatureGroup();
            app.state.markerClusterGroup = L.markerClusterGroup({
                iconCreateFunction: function(cluster) {
                    var markers = cluster.getAllChildMarkers();
                    var n = 0;

                    for (var i = 0; i < markers.length; i++) {
                      n += markers[i].number;
                    }
                    return L.divIcon({
                      html: `<span class='cluster-count'>${markers.length}</span>`,
                      className: 'mycluster',
                      iconSize: L.point(75, 75)
                    });
                }
            });
            let coord, tmpmark;
            data.forEach(item=>{
                if (!app.state.showBus || (app.state.showBus == item.objectname) || (app.state.showBus.includes(item.objectname))) {
                    coord = [item.longitude_mdeg / 1000000, item.latitude_mdeg / 1000000];
                    tmpmark = L.marker([item.latitude_mdeg / 1000000, item.longitude_mdeg / 1000000], {icon: app.makeIcon('#' + item.objectname) } );

                    app.getBusDetails(item.objectname, item.postext, tmpmark);
                    //tmpmark.bindPopup(`Bus #${item.objectname}`);

                    app.state.markerClusterGroup.addLayer(tmpmark);
                    app.state.area.addLayer(tmpmark);
                    app.state.markers.push(tmpmark);
                }
            });
            //app.state.area.addTo(app.map);
            app.map.addLayer(app.state.markerClusterGroup);
            app.map.fitBounds(app.state.area.getBounds());

        },
        getBusDetails: function(bus, addr, marker) {
            let url = 'https://dharristours.simpsf.com/where/businfo.php?bus=' + bus;
            fetch(url).then(res => res.json()).then((out) => {
              var html = "<h2>Bus #" + bus;
              if (out && out[0] && out[0].Driver) {
                  html += " - " + out[0].Driver;
              }
              html += "</h2>" + addr + "<br>\n";
              if (out.length) {
                 html += "<table class='details'>";
                 html += "<tr><th>Job ID</th><th>Job</th><th>Driver</th><th>Locations</th></tr>";
                 
                 for (var j=0; j<out.length; j++) {
                     //html += "<tr><td><a href='https://dharristours.simpsf.com/grid/view.php?pid=335&rsc=Job&id=" + out[j].JobID + "' target='_blank'>" + out[j].JobID + "</a></td><td><b>" + out[j].Job + "</b></td>\n" + "<td class='driver'>" + out[j].Driver + "</td>\n\t" + 
                     html += "<tr><td>" + out[j].JobID + "</td><td><b>" + out[j].Job + "</b></td>\n" + "<td class='driver'>" + out[j].Driver + "</td>\n\t" + 
                     "<td class='subtable'><table class='locations'>" + 
                        "<tr><th>Pickup</th><td>" + out[j].PickupFrom + "</td><td class='time'>" + out[j].PickupTime + "</td></tr>\n\t" +
                        "<tr><th>Drop Off</th><td>" + out[j].DropoffTo + "</td><td class='time'>" + out[j].DropoffTime + "</td></tr>\n" +
                     "</table></td></tr>";
                  }
                  html += "</table><br/>\n";
              }
              marker.bindPopup(html, { maxWidth: 800 });
              
            });

        },
        getCurrentPositions: function() {
            fetch("/where/latest.json").then(r=>r.json()).then(data=>{
                app.state.buses = data;
                app.update(data);
            });
        }
    }
    window.app = app;
    app.init();
})();

    </script>
  </body>
</html>

