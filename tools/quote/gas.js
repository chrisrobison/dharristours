const $ = (str) => document.querySelector(str);
const $$ = (str) => document.querySelectorAll(str);

(function() {
    let app = {
        config: {
            apiKey: "5b3ce3597851110001cf62481189071ea9104ad6a88e51717cb62e65"
        },
        init: function() {
            app.getStations();
            app.getPrice();
            app.getMiles();
        },
        getStations: function(lat, lon) {
            // '-122.241661,38.054248'
            // 38.040461, -121.836503 (upper-right of area / near Antioch)
            // 37.722145, -122.537506 (lower-left / SF)
     curl -X POST 'https://www.gasbuddy.com/gaspricemap/map?fuelTypeId=4&height=600&width=1265&maxLat=38.040461&maxLng=-121.836503&minLat=37.722145&minLng=-122.537506&usa=true'
            fetch("https://www.gasbuddy.com/gaspricemap/map?fuelTypeId=4&height=600&width=1265&maxLat=38.040461&maxLng=-121.836503&minLat=37.722145&minLng=-122.537506&usa=true", {
                method: "POST",
                mode: "no-cors"
            }).then(resp => resp.json()).then(data => {
                app.data.stations = data;
                console.dir(data);
            });
        },
        data: {
            stations: {}
        },
        state: {},
        addLeg: function() {
            let out = `<div class='leg'><button onclick='app.removeLeg(this.parentNode)' class='delete'>X</button><label><input type='text' placeholder='Destination name' size=20></label><address><input type='text' placeholder='Address' size=40></address><button onclick='app.saveLeg(this.parentNode)' style="font-family:Wingdings;"></button> </div>`;
            $("#trip").innerHTML += out;
        },
        getPrice: function() {
            fetch("stations.js").then(res => res.json()).then(data => {
                app.data.stations = data;
                let max = 0,
                    min = 100.00,
                    tot = 0,
                    cnt = 0,
                    val;
                app.data.stations.primaryStations.forEach((item) => {
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

            return {
                latitude,
                longitude
            };
        }
    }
    window.app = app;
    app.init();
})();
