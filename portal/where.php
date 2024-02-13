<?php
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/.env');
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/lib/auth.php');

    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");
    
    $in = $_REQUEST;
    
    $busID = (array_key_exists('busID', $in)) ? $in['busID'] : $_SESSION['Login']->BusinessID;
    if (array_key_exists("BusinessID", $_SESSION)) {
        $busID = $_SESSION['BusinessID'];
    }
    
    if ($busID==332) {
        $now = date("Y-m-d");
        $jobs = $boss->getObject("Job", "JobCancelled=0 AND JobDate='$now'");
    } else {
        $jobs = $boss->getObject("Job", "JobCancelled=0 AND BusinessID='{$busID}' AND JobDate='$now'");
    }
    $showbus = array();
    $buses = array();
    $busesObj = $boss->getObject("Bus");
    foreach ($busesObj->Bus as $bus) {
        if (isset($bus) && isset($bus->BusNumber)) {
           $buses[$bus->BusID] = $bus->BusNumber; 
           $showbus[$bus->BusNumber] = 1;
        }
    }

    /* foreach ($jobs->Job as $idx=>$job) {
        $showbus[$buses[$job->BusID]] = 1;
    }
    */
?>
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
      body {

      }
      #map {
        height: 95vh;

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
      .busIcon {
        width: 25px;

      }
      .control {
        height: 1.5rem;
        width: 1.5rem;
      }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css"/>
    <link rel="icon" type="image/png" href="/files/favicon.png" />

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script defer src="https://www.gstatic.com/firebasejs/7.7.0/firebase-app.js"></script>
    <script defer src="https://www.gstatic.com/firebasejs/7.7.0/firebase-analytics.js"></script>
    <script defer src="https://www.gstatic.com/firebasejs/7.7.0/firebase-auth.js"></script>
    <script defer src="https://www.gstatic.com/firebasejs/7.7.0/firebase-database.js"></script>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js" crossorigin=""></script>
    <script src="assets/MovingMarker.js"></script>
    <script defer src="/where/init-firebase.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/leaflet-rotatedmarker@0.2.0/leaflet.rotatedMarker.min.js"></script>
    <script defer src="/portal/showwhere.js"> </script>
  </head>
  <body>
    <div id="map"></div>
    <form onsubmit="return false;">
    <input type="range" id="history" name="history" min="0" max="100" onchange="app.showHistory(this.value)" /><button style='font-size:1.1em' class='control' onclick='return app.playHistory(event)'>▸</button><button class='control' onclick='return app.stopHistory(event)'>◼</button><span id="currentTime"></span>
    </form>
<script>
(function() {
L.Marker.rotatedMarker= L.Marker.extend({
    _reset: function() {
        var pos = this._map.latLngToLayerPoint(this._latlng).round();

        L.DomUtil.setPosition(this._icon, pos);
        if (this._shadow) {
            L.DomUtil.setPosition(this._shadow, pos);
        }

        if (this.options.iconAngle) {
            this._icon.style.transform = L.DomUtil.getTranslateString(pos) + ' rotate(' + this.options.iconAngle + 'deg)';
        }

        this._icon.style.zIndex = pos.y;
    },

    setIconAngle: function (iconAngle) {

        if (this._map) {
            this._removeIcon();
        }

        this.options.iconAngle = iconAngle;

        if (this._map) {
            this._initIcon();
            this._reset();
        }
    }

});

    const $ = (str) => document.querySelector(str);
    const $$ = (str) => document.querySelectorAll(str);
    const params = new Proxy(new URLSearchParams(window.location.search), {
      get: (searchParams, prop) => searchParams.get(prop),
    });
    
    if (!window["app"]) window.app = app = {};

    app = {
        ...window["app"],
        init: function() {
            app.map = L.map('map').setView([37.81, -122.29], 11);
            let osmmap = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>' });
            let googleHybrid = L.tileLayer('https://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{ maxZoom: 20, subdomains:['mt0','mt1','mt2','mt3'] });
            let googleTraffic = L.tileLayer('https://mts0.google.com/vt/lyrs=h,traffic&x={x}&y={y}&z={z}&style=3',{ maxZoom: 20, subdomains:['mt0','mt1','mt2','mt3'] });
            var Esri_WorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', { attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community' });
            var Thunderforest_MobileAtlas = L.tileLayer('https://tile.thunderforest.com/mobile-atlas/{z}/{x}/{y}.png?apikey=9ec2826e615f4f09999da5f2e730dd4a', { attribution: '&copy; <a href="http://www.thunderforest.com/">Thunderforest</a>, &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors', apikey: '<your apikey>', maxZoom: 22 });
            app.state.basemaps = { "OpenStreetMap": osmmap, "GoogleMaps": googleHybrid, "ESRI World": Esri_WorldImagery, "Mobile Atlas": Thunderforest_MobileAtlas };
            app.layerControl = L.control.layers(app.state.basemaps, { "Traffic": googleTraffic }).addTo(app.map);

            app.getCurrentPositions(1);
            
            app.map.addLayer(googleHybrid);
            app.map.addLayer(googleTraffic);
            app.getTraffic();

            app.state.loaded = true;
        },
        makeIcon: function(label) {
            let num = label.replace(/\D*/g, '');
            let bussize = num[0] + '' + num[1];

            let newicon = new L.DivIcon({
                className: 'mymarker',
                html: `<img style='width:25px' class='busIcon' src='/portal/assets/buses/busicon.php?bus=${label.replace(/\D/,'')}'>`,
                iconUrl: '/portal/assets/bus4.png',
                iconSize: L.point(50, 100 + ((bussize - 25) * 2)), 
                popupAnchor: [0, -37]
            });
            return newicon;
        },
        state: {
            loaded: false,
            markers: [],
            icons: [],
            area: {},
            buses: [],
            basemaps: {},
            overlays: {},
            layerControl: {}
        }, 
        data: {
            buses: <?php print json_encode($buses); ?>,
            showbus: <?php print json_encode($showbus); ?>,
            cursor: 0,
            playing: 0,
<?php
$filter = " WHERE 1=1 ";
if (array_key_exists('date', $in)) {
    $filter .= " AND (Created>'{$in['date']} 08:00:00' AND Created<'{$in['date']} 18:00:00'";
}
if (array_key_exists('start', $in)) {
    if (!array_key_exists('end', $in)) {
        $in['end'] = date("Y-m-d H:i:s", strtotime($in['start']) + 43200);
    }
    $filter .= " AND (Created>'{$in['start']}' AND Created<'{$in['end']}')";
}

$sql = "SELECT * FROM WebfleetBus {$filter} ORDER BY Created DESC LIMIT 100;";

if ($results = mysqli_query($link, $sql)) {
    $json = array();
    while ($row = mysqli_fetch_object($results)) {
       $json[] = json_decode($row->JSON); 
    }
    print "history: " . json_encode($json)."\n";
}
?>
        
        },
        getLastHeadings: function() {
            app.state.headings = {};
            app.state.prevHeadings = {};
            app.data.history.forEach(item=>{ 
                item.forEach( bus=>{
                    if (bus.course) {
                        if (!app.state.headings[bus.objectname]) {
                            app.state.headings[bus.objectname] = {msgid:0,heading:0};
                            app.state.prevHeadings[bus.objectname] = {msgid:0,heading:0};
                        }
                        if (app.state.headings[bus.objectname].msgid < bus.msgid) {
                            app.state.headings[bus.objectname].msgid = bus.msgid;
                            app.state.headings[bus.objectname].heading = bus.course;
                        }
                        if (app.state.prevHeadings[bus.objectname].msgid > bus.msgid) {

                            app.state.prevHeadings[bus.objectname].msgid = bus.msgid;
                        }
                    }    
                });
            }); 
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
        showHistory: function(when) {
            app.map.removeLayer(app.state.markerClusterGroup);
            app.update(app.data.history[when]);
            console.dir(app.data.history[when]);
        },
        playHistory: function(evt) {
            evt.preventDefault();
            evt.stopPropagation();
            app.data.cursor = document.querySelector("#history").value;
            app.data.playing = 1;
            setTimeout(app.stepHistory, 1000);
            return false;
        },
        stopHistory: function(evt) {
            evt.preventDefault();
            evt.stopPropagation();
            app.data.playing = 0;
            return false;
        },
        stepHistory: function() {
            app.data.cursor++;

            if (app.data.cursor >= app.data.history.length) {
                app.data.cursor = 0;
            }


            app.map.removeLayer(app.state.markerClusterGroup);
            app.update(app.data.history[app.data.cursor]);
        
            if (app.data.playing) {
                setTimeout(app.stepHistory, 1000);
            }
        },
        update: function(data, zoom=0) {
            if (app.state.markerClusterGroup) {
                app.map.removeLayer(app.state.markerClusterGroup);
            }
            app.getLastHeadings();
            let query = app.getParams();
            if (query && query['bus']) {
                app.state.showBus = query['bus'].split(/\D/);
            }

            document.querySelector("#currentTime").innerHTML = data[0].pos_time;

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
                //if (!app.state.showBus || (app.state.showBus == item.objectname) || (app.state.showBus.includes(item.objectname))) {
                if (app.data.showbus[item.objectname]) {
                    coord = [item.longitude_mdeg / 1000000, item.latitude_mdeg / 1000000];
                    if (!item.course && app.state.headings[item.objectname] && app.state.headings[item.objectname.heading]) {
                        item.course = app.state.headings[item.objectname].heading;
                    }
                    tmpmark = L.marker([item.latitude_mdeg / 1000000, item.longitude_mdeg / 1000000], {icon: app.makeIcon('#' + item.objectname), rotationAngle: item.course, rotationOrigin: "center center" } );
                    if (zoom) {
                        // app.layerControl.addOverlay(tmpmark, 'Bus #' + item.objectname);
                        
                    }
                    //tmpmark.setIconAngle(item.course);
    
                    app.getBusDetails(item.objectname, item.postext, tmpmark, item);
                    //tmpmark.bindPopup(`Bus #${item.objectname}`);

                    app.state.markerClusterGroup.addLayer(tmpmark);
                    app.state.area.addLayer(tmpmark);
                    app.state.markers.push(tmpmark);
                }
            });
//            app.state.area.addTo(app.map);
            app.map.addLayer(app.state.markerClusterGroup);
            if (zoom) app.map.fitBounds(app.state.area.getBounds());
            setTimeout(app.getCurrentPositions, 60000);
        },
        getBusDetails: function(bus, addr, marker, rec) {
            let url = 'https://dharristours.simpsf.com/where/businfo.php?bus=' + bus;
            fetch(url).then(res => res.json()).then((out) => {
              var html = "<h2>Bus #" + bus;
              if (out && out[0] && out[0].Driver) {
                  html += " - " + out[0].Driver;
              }
              let dparts = rec.pos_time.split(/\D/);

              let newtime = dparts[1] + '/' + dparts[0] + '/' + dparts[2] + ' ' + dparts[3] + ':' + dparts[4];
              html += "</h2><div style='float:right;'>" + newtime + "</div><div>" +  addr + "</div>\n";
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
        /**
         * Returns direction bus is pointing based on two lat/lon points
         */
        getHeading: function(point1, point2) {
            const toRadians = (degrees) => {
              return degrees * (Math.PI / 180);
            };

            const toDegrees = (radians) => {
              return radians * (180 / Math.PI);
            };

            const lat1 = point1[0];
            const lon1 = point1[1];
            const lat2 = point2[0];
            const lon2 = point2[1];

            const dLon = toRadians(lon2 - lon1);
            const y = Math.sin(dLon) * Math.cos(toRadians(lat2));
            const x =
              Math.cos(toRadians(lat1)) * Math.sin(toRadians(lat2)) -
              Math.sin(toRadians(lat1)) *
                Math.cos(toRadians(lat2)) *
                Math.cos(dLon);
            let bearing = Math.atan2(y, x);
            bearing = toDegrees(bearing);
            bearing = (bearing + 360) % 360;

            return bearing;
        },
        getCurrentPositions: function(zoom=0) {
            Promise.all([
                fetch("/where/last.json"),
                fetch("/where/latest.json")
            ]).then(function(resp) { 
                    return Promise.all(
                        resp.map(
                            function(response) { 
                                return response.json(); 
                            }
                        )
                    ); 
                }).then(data=>{
                    app.state.last = data[0];
                    app.state.latest = data[1];
                    app.update(data[1], zoom);

                });
        },
        icons: {
            CONSTRUCTION: L.icon({
                iconUrl: '/portal/assets/img/construction.svg',
                shadowUrl: '/portal/assets/img/construction_shadow.svg',
                iconSize:     [18, 20], // size of the icon
                shadowSize:   [20, 22], // size of the shadow
                iconAnchor:   [9, 10], // point of the icon which will correspond to marker's location
                shadowAnchor: [9, 10],  // the same for the shadow
                popupAnchor:  [-3, -10]
            }),
            INCIDENT: L.icon({
                iconUrl: '/portal/assets/img/accident.svg',
                shadowUrl: '/portal/assets/img/accident_shadow.svg',
                iconSize:     [32, 32], // size of the icon
                shadowSize:   [34, 34], // size of the shadow
                iconAnchor:   [16, 16], // point of the icon which will correspond to marker's location
                shadowAnchor: [16, 16],  // the same for the shadow
                popupAnchor:  [-3, -10]
            }),
            SPECIAL_EVENT: L.icon({
                iconUrl: '/portal/assets/img/event.png',
                shadowUrl: '/portal/assets/img/event-shadow.png',
                iconSize:     [38, 95], // size of the icon
                shadowSize:   [50, 64], // size of the shadow
                iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
                shadowAnchor: [4, 62],  // the same for the shadow
                popupAnchor:  [-3, -76]
            }),
            WEATHER_CONDITION: L.icon({
                iconUrl: '/portal/assets/img/weather_condition.png',
                shadowUrl: '/portal/assets/img/weather_condition_shadow.png',
                iconSize:     [36, 36], // size of the icon
                shadowSize:   [54, 36], // size of the shadow
                iconAnchor:   [18, 36], // point of the icon which will correspond to marker's location
                shadowAnchor: [18, 36],  // the same for the shadow
                popupAnchor:  [-3, -40]
            }),
            ROAD_CONDITION: L.icon({
                iconUrl: '/portal/assets/img/roadclosed.png',
                shadowUrl: '/portal/assets/img/roadclosed-shadow.png',
                iconSize:     [32, 30], // size of the icon
                shadowSize:   [51, 30], // size of the shadow
                iconAnchor:   [16, 30], // point of the icon which will correspond to marker's location
                shadowAnchor: [4, 30],  // the same for the shadow
                popupAnchor:  [-3, -32]
            })


        },
        getTraffic() {
            fetch("https://api.511.org/traffic/events?api_key=e799a7c4-4076-43b6-afab-59cb04c2ab62&format=json").then(r=>r.json()).then(data=>{
                app.traffic = data;

                console.log("traffic data");
                console.dir(data);

                if (data.events) {
                    let tmpmark, tarr = [];
                    data.events.forEach(item=>{
                        tmpmark = L.marker([item.geography.coordinates[1], item.geography.coordinates[0]], { icon: app.icons[item.event_type] }).bindPopup(`<h2>${item.event_type}</h2><p>${item.headline}</p><hr><div style='display:flex;align-items:space-between;justify-content:space-between;'><span style='font-size:10px;'>${item.updated}</span></div>`);
                        tarr.push(tmpmark);
                    });
                    let group = L.layerGroup(tarr);
                    app.state.trafficLayer["alerts"] = group;
                    app.layerControl.addOverlay(group, "511 Alerts");
                    app.map.addLayer(group);
                }
            });
        }
        
    }
    window.app = app;
    app.init();
})();

    </script>
  </body>
</html>

