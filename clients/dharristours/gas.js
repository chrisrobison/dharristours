const $ = (str) => document.querySelector(str);
const $$ = (str) => document.querySelectorAll(str); 

(function() {
   let app = {
      config: {
         apiKey: "5b3ce3597851110001cf62481189071ea9104ad6a88e51717cb62e65"
      },
      init: function() {
         app.getPrice();
         app.getMiles();

      },
      data: {
         stations: {}
      },
      state:{
         start: {
            name: "",
            address: ""
         },
         stops: [

         ],
         destination: {
            name: "",
            address: ""
         }
      },
      saveLeg: function(wrap) {
         
      },
      addLeg: function() {
         let out = `<div class='leg'><label><input type='text' placeholder='Destination name' size=20></label><address><input type='text' placeholder='Address' size=40></address><button onclick='app.removeLeg(this.parentNode)'>x</button><button onclick='app.saveLeg(this.parentNode)'>+</button></div>`;
         $("#trip").innerHTML += out;
      },
      getPrice: function() {
          fetch("stations.js").then(res=>res.json()).then(data=>{
            app.data.stations = data;
            let max = 0,
                min = 100.00,
                tot = 0,
                cnt = 0,
                val;
            app.data.stations.primaryStations.forEach((item)=>{
               val = parseFloat(item.price);
               if (val && !isNaN(val)) {
                  if (val < min) min = val;
                  if (val > max) max = val;
                  tot += val;
                  ++cnt;
               }
            });
            out = {
               max: max,
               min: min,
               avg: Math.floor((tot / cnt) * 100) / 100
            };
            console.dir("price map");
            console.dir(out);
            console.dir(data);
          });
      },

      calculateDistanceInMiles: async function (origin, destination) {
        const apiUrl = `https://api.openrouteservice.org/v2/directions/driving-car?api_key=${app.config.apiKey}&start=${origin}&end=${destination}`;
        
        const response = await fetch(apiUrl);
        const data = await response.json();
        
        console.dir(data);
        const distanceInMeters = data.features[0].properties.segments.reduce((total, segment) => {
          return total + segment.distance;
        }, 0);
        
        const distanceInMiles = distanceInMeters / 1609.344;
        console.log(distanceInMiles);
        return distanceInMiles;
      },
      getMiles: function(orig, dest) {
         const origin = orig ? orig : '-122.241661,38.054248'; // "longitude,latitude" of origin
         const destination = dest ? dest : '-122.401636,37.646312'; // longitude,latitude of destination

         app.calculateDistanceInMiles(origin, destination)
           .then(distance => console.log(`Distance: ${distance} mi`))
           .catch(error => console.error(error.message));

      },
      geocodeAddress: async function(address) {
         const apiUrl = `https://api.openrouteservice.org/geocode/search?api_key=${app.config.apiKey}&text=${address}`;

         const response = await fetch(apiUrl);
         const data = await response.json();

         if (data.features.length === 0) {
             throw new Error('No location found');
         }

         const location = data.features[0].geometry.coordinates;
         const latitude = location[1];
         const longitude = location[0];

         return { latitude, longitude };
      },
      doSuggestions: function(who, evt) {
         console.dir(evt);
         var txt = document.querySelector("#"+who).value;
         if (evt.key.length===1) {
            txt += evt.key;
         }
         
         // Handle 'ESC' key
         if (evt.keyCode === 27) {
            if (window.dialogState.open) {
               window.dialogState.nosuggestions = true;
               const dd = document.querySelector("#" + who + "_suggestions");
               if (dd) {
                  dd.style.height = "0px";
                  dd.style.border = "0px";
               }
            }
         }

         if ((evt.key == "Tab") || (evt.keyCode === 13)) {
            if (window.suggestions.length) {
               pickSuggestion(window.suggestions[0], who);
            }

            if (who == 'customer') {
               document.querySelector('#pickup').focus();
            } else if (who == 'pickup') {
               document.querySelector('#dropoff').focus();
            } else if (who == 'dropoff') {
               document.querySelector('#dlg_cancel').focus();
            }
            window.suggestions = [];
            window.dialogState.nosuggestions = false;
            evt.preventDefault();
            evt.stopPropagation();
            return false;
         }

         if (evt.key == "Backspace") {
            return true;
            txt = txt.substr(0, txt.length - 1);
         }
         if (!txt.match(/\w/)) {
            var el = document.querySelector("#" + who + "_suggestions");
            el.innerHTML = '';
            el.style.height = "0px";
            el.style.border = "0px solid #3330";
            return true;
         }
         if (!window.dialogState.nosuggestions) {
            fetch("api.php?type=suggestion&rsc=" + who + "&q=" + txt).then((response) => { return response.json(); }).then((data) => {
               var out = '';
               window.suggestions = data['results'];

               for (var i in data['results']) {
                  var item = data['results'][i];
                  out += `<div class='suggestion'><a href='#' onmouseover='this.parentNode.classList.add("hilite")' onmouseout='this.parentNode.classList.remove("hilite")' onclick='return pickSuggestion("${item}", "${who}")'>${item}</a></div>`;
               }
               var el = document.querySelector("#" + who + "_suggestions");
               el.innerHTML = out;
               el.style.height = "9rem";
               el.style.border = "1px solid #333";
               window.dialogState.open = who;
            });
         }
      }

   
   }
   window.app = app;
   app.init();
})();
