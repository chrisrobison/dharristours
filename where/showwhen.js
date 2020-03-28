/**
* Starting point for running the program. Authenticates the user.
* @param {function()} onAuthSuccess - Called when authentication succeeds.
*/
function initAuthentication(onAuthSuccess) {
  firebase.auth().signInAnonymously().catch(function(error) {
    console.log(error.code + ', ' + error.message);
  }, {remember: 'sessionOnly'});

  firebase.auth().onAuthStateChanged(function(user) {
    if (user) {
      // data.sender = user.uid;
      onAuthSuccess();
    } else {
      // User is signed out.
    }
  });
}
var who = '';

var fleet = {}, staff, initfit;
function initFirebase() {
   var startTime = new Date().getTime() - (60 * 10 * 1000);
   
   var buses = firebase.database().ref('bus/');
   buses.on('value', function(snapshot) {
      var val = snapshot.val();
      fleet = val;
      console.dir(val);
      updateBuses(val);
   });
/*
 * var people = firebase.database().ref('people/');
   people.on('value', function(snapshot) {
      var val = snapshot.val();
      staff = val;
      console.dir(val);
      updatePeople(val);
   });
*/
   // geoFindMe();
}

var map, trafficLayer;
function initMap() {
   var mapStyle = [{
      "featureType":"poi",
      "elementType": "all",
      "stylers": [{'visibility': 'off'}]
      }//, 
  //    { "featureType": "road", "elementType": "all", "stylers": [ { "color": "#AAFFFF" } ] }
   ]; 
  map = new google.maps.Map(
      document.getElementById('map'),
      {center: new google.maps.LatLng(37.852435,-122.0864287), zoom: 11,
      styles: mapStyle,
      mapTypeId: 'hybrid' });
  
  // trafficLayer = new google.maps.TrafficLayer();
  // trafficLayer.setMap(map);
  
  // initAuthentication(initFirebase.bind(undefined, ''));
}
var markers = [];

function addBuses(buses) {
   console.dir(buses);
   var ico = {
      path: 'm 17.708333,41.220239 8.245266,-0.01441 -0.206572,23.617177 16.188495,0.02378 0.258634,-19.954646 -16.115537,-0.0056 0.484134,-3.712717 20.359045,-0.01728 -0.194714,24.101278 h 15.875 V 44.884904 H 48.05 l -1.074873,-3.737982 20.396995,-0.02336 0.304853,23.809492 16.341489,-0.0032 0.09856,-20.111742 -15.776443,-0.0034 -0.975999,-3.633975 h 25.4 l 0.264586,38.629168 h 5.027084 l 0.264583,-34.395834 h 2.381255 v 34.395834 h 5.29166 l 0.11763,-28.155013 3.11775,0.217924 0.45062,12.030463 4.41495,0.05466 5.69343,0.175913 -10.10152,-11.051716 -3.75737,-1.317354 0.0645,-6.879878 H 93.029168 l -0.160855,-3.64615 15.465037,-0.167349 c 0,0 3.86905,0.595237 3.42262,3.869047 l 0.0827,3.852381 -2.29822,1.223809 2.86072,1.983929 9.78809,11.111308 10.38334,4.017859 1.65357,6.382142 1.6369,1.785715 -0.0661,4.910714 -4.39821,-0.148809 -1.62024,3.869047 c -0.89285,2.232143 -2.54642,4.712498 -7.01071,4.11726 -6.84524,0.446429 -7.88691,-8.283927 -7.88691,-8.283927 l -5.20833,1.636903 -0.89286,1.785716 H 89.599403 L 88.557736,81.101188 62.748215,80.654762 c 0,0 -1.469048,8.228155 -9.259525,7.771426 -9.40744,0.456729 -9.755357,-8.234523 -9.755357,-8.234523 l -27.959524,-1.769047 0.14881,-2.232144 1.785714,-1.934522 z',
      fillOpacity:.8,
      fillColor:"#ffffff",
      scale:1,
      strokeColor:"#ffffff",
      strokeWeight: 3
   };

   if (buses[0] && buses[0].objectno) {
      for (var i = 0; i < buses.length; i++) {
         buses[i] = new google.maps.Marker({
            position: new google.maps.LatLng((buses[i].latitude_mdeg / 1000000), (buses[i].longitude_mdeg / 1000000)),
            icon: "img/bus10.png",
            map: map
         });
      };
   } else {
       buses = new google.maps.Marker({
         position: new google.maps.LatLng((buses.latitude_mdeg / 1000000), (buses.longitude_mdeg / 1000000)),
         icon: "img/bus10.png",
         map: map
      });
   }
}

function initPlayback() {

}
var buslocations = {};

function getWhere(when, who) {
   fetch("where.php?date="+encodeURIComponent(when)).then(res => res.json())
      .then((out) => {
         Object.assign(buslocations, out);
         console.dir(out);
      });
}

var paths = {};
function getPath(start, end, who) {
   var whichbus = document.querySelectorAll("input[name=buses]:checked")[0].value;
   var query = [];
   
   if (who) {
      query[query.length] = "bus=" + encodeURIComponent(who);
   } 
   if (whichbus) {
      query[query.length] = "bus=" + encodeURIComponent(whichbus);
   } 
   if (start) {
      query.push("date=" + encodeURIComponent(start));
   }
   if (end) {
      query.push("end=" + encodeURIComponent(end));
   }
   drivePath = [];
   fetch("path.php?" + query.join('&')).then(res => res.json())
      .then((out) => {
console.dir(out);

 var lineSymbol = {
    path: google.maps.SymbolPath.CIRCLE,
   // "m 82.300942,206.4326 -0.01441,-8.24527 23.617178,0.20657 0.0238,-16.18849 -19.954647,-0.25864 -0.0056,16.11554 -3.712717,-0.48413 -0.01728,-20.35905 24.101274,0.19472 v -15.875 H 85.965607 v 14.55208 l -3.737982,1.07487 -0.02336,-20.39699 23.809495,-0.30486 -0.003,-16.34148 -20.111745,-0.0986 -0.0034,15.77644 -3.633975,0.976 v -25.4 l 38.62917,-0.26459 v -5.02708 l -34.395836,-0.26459 v -2.38125 h 34.395836 v -5.29166 l -28.155015,-0.11763 0.217924,-3.11775 12.030461,-0.45062 0.0547,-4.41495 0.17591,-5.69343 -11.051711,10.10152 -1.317354,3.75737 -6.879878,-0.0645 v 12.96457 l -3.64615,0.16086 -0.167349,-15.46504 c 0,0 0.595237,-3.86905 3.869047,-3.42262 l 3.852381,-0.0827 1.223809,2.29822 1.983929,-2.86072 11.111306,-9.78809 4.01786,-10.383341 6.38214,-1.65357 1.78572,-1.6369 4.91071,0.0661 -0.14881,4.39821 3.86905,1.62024 c 2.23214,0.89285 4.7125,2.54642 4.11726,7.010711 0.44643,6.84524 -8.28393,7.88691 -8.28393,7.88691 l 1.63691,5.20833 1.78571,0.89286 v 19.18031 l -2.08331,1.04166 -0.44643,25.80952 c 0,0 8.22816,1.46905 7.77143,9.25953 0.45673,9.40744 -8.23452,9.75536 -8.23452,9.75536 l -1.76905,27.95952 -2.23214,-0.14881 -1.93453,-1.78571 z",
 //   path: "m 78.221351,135.64258 4.122635,-0.007 -0.103285,11.80858 8.094245,0.0119 0.12932,-9.97732 -8.05777,-0.003 0.242065,-1.85636 10.179525,-0.009 -0.09736,12.05064 h 7.937504 v -10.18647 h -0.762537 l -0.163281,-0.11312 0.340328,9.63812 h -0.726022 l 0.07992,-9.62883 -0.488702,-0.0351 0.11765,10.08733 -0.389347,0.006 -0.18364,-10.07072 -0.717881,0.004 -0.235635,9.94951 -0.572539,0 0.142258,-9.82182 -0.646043,-0.0341 0.0305,9.85415 -0.6201,-7.5e-4 -0.05583,-9.82568 -0.455964,0.004 0.0045,9.83136 -0.444638,-0.004 -0.05386,-9.82842 -0.439515,-0.002 0.0676,9.82981 -0.469807,2.6e-4 0.01625,-9.81175 -0.495079,-0.009 -0.0062,9.81631 -0.506293,6.3e-4 0.03103,-9.83386 -0.202273,-0.002 -0.0083,-1.86899 10.19849,-0.0117 0.0893,11.90475 8.23382,-0.002 0.0493,-10.05587 -7.88822,-0.001 -0.488,-1.81699 h 12.7 l 0.1323,19.31458 h 2.51354 l 0.13229,-17.19791 h 1.19063 v 17.19791 h 2.64583 l 0.0588,-14.0775 1.55888,0.10896 0.22531,6.01523 2.20747,0.0273 2.84672,0.088 -5.05076,-5.52585 -1.87869,-0.65868 0.0323,-3.43994 h -6.48228 l -0.0804,-1.82307 7.73252,-0.0837 c 0,0 1.93452,0.29762 1.71131,1.93453 l 0.0413,1.92619 -1.14911,0.6119 1.43036,0.99197 4.89404,5.55565 5.19167,2.00893 0.82679,3.19107 0.81845,0.89286 -0.0331,2.45535 -2.19911,-0.0744 -0.81012,1.93452 c -0.44642,1.11607 -1.27321,2.35625 -3.50535,2.05863 -3.42262,0.22322 -3.94346,-4.14196 -3.94346,-4.14196 l -2.60416,0.81845 -0.44643,0.89286 h -9.59016 l -0.52083,-1.04166 -12.90476,-0.22321 c 0,0 -0.73452,4.11408 -4.62976,3.88571 -4.70372,0.22837 -4.87768,-4.11726 -4.87768,-4.11726 l -13.97976,-0.88452 0.0744,-1.11607 0.892855,-0.96727 z",
    anchor: new google.maps.Point(0,0),
    fillColor: '#fff',
    fillOpacity: 1,
    strokeWeight: 1,
    scale: 8,
    strokeColor: '#000',
    zIndex: 1
  };

         if (!Array.isArray(out)) {
            var colors = ['#490a3d','#bd1550','#e97f02','#f8ca00','#0CA230','#8a9b0f','#785fdd','#3e5aad','#274c91','#e52d30'];
            var cnt = 0, line;
            for (var idx in out) {
               if (!drivePath[idx]) {
                  drivePath[idx] = [];
               }
               line = new google.maps.Polyline({
                path: out[idx],
                icons: [{
                  icon: lineSymbol,
                  offset: '100%'
                }],
                geodesic: true,
                strokeColor: colors[Math.floor(Math.random()*colors.length)],
                strokeOpacity: .6,
                strokeWeight: 8,
                map:map,
                zIndex: 999
              });
              drivePath[idx] = line;
              animateCircle(line);
              paths[idx] = out[idx];
              
              cnt++;
              if (cnt > colors.length) {
                 cnt = 0;
               }
//               paths.push(idx);
            }
console.dir(drivePath[idx]);
console.log("updatePath");
            
         } else {
            drivePath = [];
           drivePath.push(new google.maps.Polyline({
             path: out,
             geodesic: true,
             strokeColor: '#FFff00',
             strokeOpacity: 1.0,
             strokeWeight: 8
           }));
           drivePath[drivePath.length-1].setMap(map); 
        }
      });
}
function animateCircle(line) {
    var count = 0;
    window.setInterval(function() {
      count = (count + 1) % 200;

      var icons = line.get('icons');
      icons[0].offset = (count / 2) + '%';
      line.set('icons', icons);
  }, 10);
}

var pathIdx=0;
function updatePath(who) {
   

   pathIdx++;
   if (pathIdx > drivePath[who].length) {
      for (var o=0; o<drivePath[who].length; o++) {
         drivePath[who][o].setMap(null);
      }
      pathIdx = 0;
   }
   setTimeout("updatePath("+who+")", 500);

}
var infoWindows = [], markers = [], makers = [];
var iconPath = '/where/img/';
function updateBuses(buses) {
   var bounds = new google.maps.LatLngBounds ();
   if (buses && buses.length) {
      for (var i = 0; i < buses.length; i++) {
         if (i < 2000) { 
            if (buses[i] && buses[i].objectno) {
               fleet[buses[i].objectno] = buses[i];
            }
            
            if (!markers[i] && buses[i]) {
               window.busIcon = {
                  path: 'm 35.952763,42.53061 -11.088972,0.0356 -0.11272,-1.60322 10.588572,-0.310447 3.313515,-0.0092 -0.0056,15.897288 12.400959,-0.0055 0.133245,-14.025348 -12.134715,-9e-5 0.792693,-1.866412 13.62545,-0.154195 -0.01938,16.13171 12.793458,-0.132875 0.02877,-13.916518 -12.271456,-0.02363 0.03742,-2.009492 14.854087,-0.02646 -0.09621,15.84949 12.672863,-0.03634 0.156223,-13.822059 -11.257254,0.09834 0.06153,-2.121547 13.365272,0.0048 0.08507,16.005308 8.075562,0.01729 -0.02197,-13.954379 -7.436625,0.06455 0.735458,-2.254486 9.110947,0.17818 -0.147307,41.47979 h 12.964582 l -0.0624,-39.450395 -6.02568,0.02211 -0.005,39.428289 h -0.78837 l -0.0504,-39.416885 -5.150062,0.01996 0.553518,-2.02942 12.705944,0.476842 c 0,0 3.86905,0.595236 3.42262,3.869048 l 0.0827,3.85238 -3.35655,0.16548 -0.84345,4.100595 0.31129,9.118251 11.7757,0.08518 -11.15148,-11.799734 0.25709,-0.373246 7.74311,8.165147 3.7096,3.587092 -1.26972,0.211951 14.61666,4.01786 0.59524,7.440476 1.6369,1.785712 -0.59524,4.910716 -3.86904,-0.1488 -1.62024,3.869044 c -0.89284,2.232144 -2.54642,4.7125 -7.0107,4.11726 -6.84524,0.446432 -7.88691,-8.283924 -7.88691,-8.283924 l -5.20833,1.6369 -0.89286,1.785716 H 93.303488 L 92.26182,81.10117 61.160632,80.654742 c 0,0 -1.041668,7.539879 -7.14286,7.242263 -6.392772,2.061328 -9.226188,-6.647027 -9.226188,-6.647027 l -29.01786,-2.82738 0.1488,-2.232144 1.785716,-1.93452 2.48e-4,-33.0356 5.98124,-0.15932 -0.03012,15.372076 12.19283,0.0268',
                  fillColor: 'white',
                  fillOpacity: 1,
                  scale: 1,
                  strokeColor: 'black',
                  strokeWeight: 2,
                  labelOrigin: new google.maps.Point(60,20),
                  size: new google.maps.Size(150, 100),
                  rotation: 0
               };
               markers[i] = new google.maps.Marker({
                  position: new google.maps.LatLng((buses[i].latitude_mdeg / 1000000), (buses[i].longitude_mdeg / 1000000)),
//                    icon: busIcon,
                    icon: { url: iconPath + 'bus10.png', labelOrigin: new google.maps.Point(60,20), size: new google.maps.Size(150, 100), anchor: new google.maps.Point(75, 50) },

                  map: map,
                  labelClass: 'labels',
                  label: {
                     text: buses[i].objectno,
                     color: '#ffff00',
                     fontSize: '18px',
                     fontWeight: 'normal'
                  }

                  
               });
               markers[i].bus = buses[i];
               bounds.extend (markers[i].position);
               var iw;
               markers[i].infowin = iw = new google.maps.InfoWindow({ 
                  content: '<h1>Bus #' + buses[i]['objectno'] + '</h1><div>' + buses[i]['postext'] + '</div>'
               });
     
               let url = 'https://dharristours.simpsf.com/where/businfo.php?bus=' + buses[i]['objectno'];
               let bus = buses[i];
               let mark = markers[i];


         fetch(url).then(res => res.json())
         .then((out) => {
              var html = "<h2>Bus #" + bus['objectno'];
              if (out && out[0] && out[0].Driver) {
                  html += " - " + out[0].Driver;
              }
              html += "</h2>" + bus['postext'] + "<br>\n";
              if (out.length) {
                 html += "<table class='details'>";
                 html += "<tr><th>Job ID</th><th>Job</th><th>Driver</th><th>Locations</th></tr>";
                 
                 for (var j=0; j<out.length; j++) {
                     html += "<tr><td><a href='https://dharristours.simpsf.com/grid/view.php?pid=335&rsc=Job&id=" + out[j].JobID + "' target='_blank'>" + out[j].JobID + "</a></td><td><b>" + out[j].Job + "</b></td>\n" + "<td class='driver'>" + out[j].Driver + "</td>\n\t" + 
                     "<td class='subtable'><table class='locations'>" + 
                        "<tr><th>Pickup</th><td>" + out[j].PickupFrom + "</td><td class='time'>" + out[j].PickupTime + "</td></tr>\n\t" +
                        "<tr><th>Drop Off</th><td>" + out[j].DropoffTo + "</td><td class='time'>" + out[j].DropoffTime + "</td></tr>\n" +
                     "</table></td></tr>";
                  }
                  html += "</table><br/>\n";
               }
             mark.infowin.setContent(html);
             if (out.length) {
               // console.log('Checkout this JSON! ', out);
            }
         })
         .catch(err => { throw err });
               markers[i].addListener('click', function() {
                  this.infowin.open(map, this);
               });

            } else {
               if (markers && markers[i]) {
                  markers[i].setPosition(new google.maps.LatLng((buses[i].latitude_mdeg / 1000000), (buses[i].longitude_mdeg / 1000000)));
                  // bounds.extend(markers[i].position);
               }
            }
         }
      };

      if (!initfit) {
         map.fitBounds(bounds);
         initfit = 1;
      }
   } else {
      console.log("Tried to update buses but they're missing!!");
   }
   var markerCluster = new MarkerClusterer(map, markers, {imagePath: '/where/img/m', styles: [
      {textColor: "#00ff00", textSize: 22, height:50, width:100, url: "/where/img/m1.png", anchorText:[-32,0]},
      {textColor: "#00ff00", textSize: 28, height:75, width:150, url: "/where/img/m2.png", anchorText:[-38,0]},
      {textColor: "#00ff00", textSize: 28, height:75, width:150, url: "/where/img/m3.png", anchorText:[-38,0]},
      {textColor: "#00ff00", textSize: 36, height:90, width:180, url: "/where/img/m4.png", anchorText:[-46,0]},
      {textColor: "#00ff00", textSize: 48, height:100, width:200, url: "/where/img/m5.png", anchorText:[-50,0]}
   ]});

}
function updatePeople(people) {
   console.log("Staff dump:");
   console.dir(people);
   var bounds = new google.maps.LatLngBounds ();
   if (people) {
      for (var i in people) {
         if (people[i] && people[i].name) {
            staff[people[i].objectno] = people[i];
         }
         
         if (!makers[i] && people[i]) {
            makers[i] = new google.maps.Marker({
               position: new google.maps.LatLng(people[i].lat, people[i].long),
//                     icon: people[i].icon,
                 icon: {
                  url: people[i].icon,
                  labelOrigin: new google.maps.Point(60,20),
                  scaledSize: new google.maps.Size(100, 69)
               },

               map: map,
               labelClass: 'labels',
               label: {
                  text: people[i].name.replace(/\+/, ' '),
                  color: '#ffff00',
                  fontSize: '18px',
                  fontWeight: 'normal'
               }

               
            });
            makers[i].person = people[i];
            bounds.extend (makers[i].position);
  
         } else {
            if (makers && makers[i]) {
               makers[i].setPosition(new google.maps.LatLng((people[i].latitude_mdeg / 1000000), (people[i].longitude_mdeg / 1000000)));
               // bounds.extend(makers[i].position);
            }
         }
      };
   } else {
      console.log("Tried to update PEOPLE, but they're missing!!");
   }

}

function createInfoWindow(bus) {
   var infoWin = new google.maps.InfoWindow({ 
      content: '<h1>' + bus['objectno'] + ' - ' + bus['description'] + '</h1>'
   });
   return infoWin;
}
function degreesToRadians(degrees) {
  return degrees * Math.PI / 180;
}

function distanceInMilesBetweenEarthCoordinates(lat1, lon1, lat2, lon2) {
  var earthRadiusMiles = 3959;

  var dLat = degreesToRadians(lat2-lat1);
  var dLon = degreesToRadians(lon2-lon1);

  lat1 = degreesToRadians(lat1);
  lat2 = degreesToRadians(lat2);

  var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
          Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2); 
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
  return earthRadiusMiles * c;
}


