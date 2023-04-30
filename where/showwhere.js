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

var fleet, staff, initfit;
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
  map = new google.maps.Map(
      document.getElementById('map'),
      {center: new google.maps.LatLng(37.852435,-122.0864287), zoom: 11, mapTypeId: 'hybrid' });
  
  trafficLayer = new google.maps.TrafficLayer();
  trafficLayer.setMap(map);
  
  initAuthentication(initFirebase.bind(undefined, ''));
}
var markers = [];

function geoFindMe() {

  function success(position) {
    const latitude  = position.coords.latitude;
    const longitude = position.coords.longitude;
    var out = {}, name;
    document.cookie.split(/;\s*/).forEach(function(x) { var k = x.split(/=/,2); if (k[0]==='name') { out[k[0]] = who = k[1].replace(/\W/, '_'); name = k[1]; } })
    
    if (who) {
      var d = new Date();
      var o = {lat: latitude, long: longitude, updated: d.toISOString(), icon: "/where/img/" + who + ".png", name: name }; 
      console.log("geoFindMe: who="+who);
      console.dir(o);
      firebase.database().ref('people/' + who).set(o);
    }
  }

  function error() {
    status.textContent = 'Unable to retrieve your location';
  }

  if (!navigator.geolocation) {
    status.textContent = 'Geolocation is not supported by your browser';
  } else {
    navigator.geolocation.getCurrentPosition(success, error);
  }

}

function addBuses(buses) {
   console.dir(buses);
   for (var i = 0; i < buses.length; i++) {
      markers[i] = new google.maps.Marker({
         position: new google.maps.LatLng((buses[i].latitude_mdeg / 1000000), (buses[i].longitude_mdeg / 1000000)),
         icon: 'bus10.png',
         map: map
      });
   };

}
var infoWindows = [], markers = [], makers = [];
var iconPath = '/where/img/';
function updateBuses(buses) {
   console.dir(buses);
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
   //                     icon: busIcon,
                    icon: {
                     url: iconPath + 'bus10.png',
                     labelOrigin: new google.maps.Point(60,20),
                     size: new google.maps.Size(150, 100),
                     anchor: new google.maps.Point(75, 50)

                  },

                  map: map,
                  labelClass: 'labels',
                  label: {
                     text: buses[i].objectname,
                     color: '#ffff00',
                     fontSize: '18px',
                     fontWeight: 'normal'
                  }

                  
               });
               markers[i].bus = buses[i];
               bounds.extend (markers[i].position);
               var iw;
               markers[i].infowin = iw = new google.maps.InfoWindow({ 
                  content: '<h1>Bus #' + buses[i]['objectname'] + '</h1><div>' + buses[i]['postext'] + '</div>'
               });
     
               let url = 'https://dharristours.simpsf.com/where/businfo.php?bus=' + buses[i]['objectno'];
               let bus = buses[i];
               let mark = markers[i];


         fetch(url).then(res => res.json())
         .then((out) => {
              var html = "<h2>Bus #" + bus['objectname'];
              if (out && out[0] && out[0].Driver) {
                  html += " - " + out[0].Driver;
              }
              html += "</h2>" + bus['postext'] + "<br>\n";
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


