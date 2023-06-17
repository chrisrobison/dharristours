const $ = (str) => document.querySelector(str);
const $$ = (str) => document.querySelectorAll(str);

(function() {
    if (!window.app) window.app = {};

    let app = {
        ...window.app,
        config: {
            apiKey: "5b3ce3597851110001cf62481189071ea9104ad6a88e51717cb62e65"
        },
        data: {
            stations: {}
        },
        state: {},
        addLeg: function() {
            let out = `<div class='leg'><button onclick='app.removeLeg(this.parentNode)' class='delete'>X</button><label><input type='text' placeholder='Destination name' size=20></label><address><input type='text' placeholder='Address' size=40></address><button onclick='app.saveLeg(this.parentNode)' style="font-family:Wingdings;"></button> </div>`;
            $("#trip").innerHTML += out;
        },
        postData: async function(url = "", data = {}) {
            const response = await fetch(url, {
                method: "POST", // *GET, POST, PUT, DELETE, etc.
                mode: "no-cors", // no-cors, *cors, same-origin
                cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
                credentials: "same-origin", // include, *same-origin, omit
                headers: {
                    "Content-Type": "application/json",
                    // 'Content-Type': 'application/x-www-form-urlencoded',
                },
                redirect: "follow", // manual, *follow, error
                referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
                body: JSON.stringify(data), // body data type must match "Content-Type" header
            });
            return response.json(); // parses JSON response into na
        },
        reverseGeocode: function(coord) {
            if (coord) {
                let lat = coord[0];
                let lon = coord[1];

                var request = new XMLHttpRequest();

                request.open("GET", `https://api.openrouteservice.org/geocode/reverse?api_key=${app.config.apiKey}&point.lon=${lon}&point.lat=${lat}`);

                request.setRequestHeader('Accept', 'application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8');

                request.onreadystatechange = function () {
                  if (this.readyState === 4) {
                    console.log('Status:', this.status);
                    console.log('Headers:', this.getAllResponseHeaders());
                    console.log('Body:', this.responseText);
                  }
                };
                request.send();
            }
        },
        geocodeSearch: function(search) {
            var request = new XMLHttpRequest();

           request.open('GET', `https://api.openrouteservice.org/geocode/search?api_key=${app.config.apiKey}&text=${encodeURIComponent(search)}`);

            request.setRequestHeader('Accept', 'application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8');

            request.onreadystatechange = function () {
              if (this.readyState === 4) {
                console.log('Status:', this.status);
                console.log('Headers:', this.getAllResponseHeaders());
                console.log('Body:', this.responseText);
              }
            };

            request.send();  
        },
        getGeoJSON2: function(origin, dest) {
            fetch(`/portal/directions.php?start=${origin}&end=${dest}`).then(r=>r.json()).then(data=>{
                L.geoJSON(data).addTo(app.map);
                console.log("directions:");
                console.dir(data);
                let bounds = [[data.bbox[3], data.bbox[2]], [data.bbox[1], data.bbox[0]]];

                app.map.fitBounds(bounds);

                document.querySelector("#distance").innerHTML = Math.round(data.features[0].properties.summary.distance * 0.000621371) + " miles";

                let dur = data.features[0].properties.summary.duration;
                let hr = 0, min = Math.ceil(dur / 60);
                if (min > 60) {
                    hr = Math.floor(min / 60);
                    min = (min - (hr * 60));
                } else {
                    hr = 0;
                    min = Math.floor(dur / 60);
                }
                if (min < 10) {
                    min = '0' + min;
                }
                if (hr < 10) {
                    hr = '0' + hr;
                }
                document.querySelector("#duration").innerHTML = `${hr}:${min}`;
                document.querySelector("#overlay").style.display = "none";
                 
            });
        },
        makeStaticMap: function() {
            domtoimage.toPng($("#map")).then((dataUrl) => {
                let img = new Image();
                img.src = dataUrl;
                document.body.appendChild(img);
                $("#static")?.appendChild(img);
                console.log(dataUrl)
            });
        },
        getGeoJSON: function(coord) {
            
            let request = new XMLHttpRequest();

            request.open('POST', "https://api.openrouteservice.org/v2/directions/driving-car/geojson");

            request.setRequestHeader('Accept', 'application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8');
            request.setRequestHeader('Content-Type', 'application/json');
            request.setRequestHeader('Authorization', app.config.apiKey);

            request.onreadystatechange = function () {
              if (this.readyState === 4) {
                console.log('Status:', this.status);
                console.log('Headers:', this.getAllResponseHeaders());
                console.log('Body:', this.responseText);
                app.data.geojson = JSON.parse(this.responseText);
                let data = app.data.geojson;

                L.geoJSON(data).addTo(app.map);
                let bounds = [[data.bbox[3], data.bbox[2]], [data.bbox[1], data.bbox[0]]];

                app.map.fitBounds(bounds);

                $("#distance").innerHTML = Math.round(app.data.geojson.features[0].properties.summary.distance * 0.000621371) + " miles";

                let dur = data.features[0].properties.summary.duration;
                let hr = 0, min = Math.ceil(dur / 60);
                if (min > 60) {
                    hr = Math.floor(min / 60);
                    min = (min - (hr * 60));
                } else {
                    hr = 0;
                    min = Math.floor(dur / 60);
                }
                if (min < 10) {
                    min = '0' + min;
                }
                if (hr < 10) {
                    hr = '0' + hr;
                }
                $("#duration").innerHTML = `${hr}:${min}`;
                $("#overlay").style.display = "none";
                
                setTimeout(function() {
                    if (domtoimage) {
                        console.log("creating static image");
                        domtoimage.toPng($("#map")).then((dataUrl) => {
                        let img = new Image();
                        img.src = dataUrl;
                        document.body.appendChild(img);
                        $("#static")?.appendChild(img);
                        console.log(dataUrl)
                        }); 
                    }
                }, 2000);
              }
            };

            const body = {"coordinates":[coord]};

            request.send(JSON.stringify(body));
/*
            let body = {
                coordinates: [ origin, dest]
            };

            fetch(`https://api.openrouteservice.org/v2/directions/driving-car/geojson?api_key=${app.config.apiKey}`, {
                method: "POST",
                mode: "no-cors",
                headers: {
                    "Accept": "application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8",
                    "Content-Type": "application/json",
                    "Authorization": app.config.apiKey,
                },
                redirect: "follow", // manual, *follow, error
                referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
                body: JSON.stringify(body)
            }).then(resp=>resp.json()).then(data=>{
                L.geoJSON(data).addTo(app.map);
                console.log("geojson data");
                console.dir(data);
            });
            */
        },
        calculateDistanceInMiles: async function(origin, destination) {
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
        getRoute: function(address1="", address2="") {
            address1 = (address1) ? address1 : $("#origin").value;
            address2 = (address2) ? address2 : $("#destination").value;

            $("#overlay").style.display = "block";
            
            console.log(`getRoute: ${address1} to ${address2}`);

            let g1 = app.geocodeAddress(address1);// .then(coord=>{ app.data.origin = coord; console.log("geocode1"); console.dir(coord); });
            let g2 = app.geocodeAddress(address2);// .then(coord=>{ app.data.dest = coord; console.log("geocode2"); console.dir(coord); });
            Promise.all([ g1, g2]).then((values) => {
                console.log("In Promise");
                console.dir(values);
                let orig = [values[0].latitude, values[0].longitude];

                app.getGeoJSON2([values[0].longitude, values[0].latitude], [values[1].longitude, values[1].latitude]);
            });

            return false;
        },
        geocodeAddress: async function(address) {
            const apiUrl = `/portal/geocode.php?addr=${address}`;
            // const apiUrl = `https://api.openrouteservice.org/geocode/search?api_key=${app.config.apiKey}&text=${address}`;

            const response = await fetch(apiUrl);
            const data = await response.json();
            let latitude = 38.054, longitude = -122.241;

            if (data.features) {
                if (data.features.length === 0) {
                    throw new Error('No location found');
                }

                let location = data.features[0].geometry.coordinates;
                latitude = location[1];
                longitude = location[0];
            }
            return {
                    latitude,
                    longitude
            };
        }
    }
    window.app = app;
})();
