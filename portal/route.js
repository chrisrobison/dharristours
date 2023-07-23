(function() {
    if (!window.app) window.app = {};

    let app = {
        ...window.app,
        init: function() {
            
        },
        config: {
            apiKey: "5b3ce3597851110001cf62481189071ea9104ad6a88e51717cb62e65"
        },
        data: {
            roundtrip: 0,
            stations: {},
            busIcon: L.icon({ iconUrl: "/portal/assets/bus4sm.png", iconSize: [40, 17], iconAnchor: [40, 17], popupAnchor: [0, 0] }),
            pinIcon: L.icon({ iconUrl: "/portal/assets/mappin.svg", iconSize: [20, 32], iconAnchor: [10, 16], popupAnchor: [0, 0] }),
            stops: {
                Pickup: {},
                DropOff: {},
                FinalDropOff: {}
            },
            waypoints: [],
            waypoint: 0
        },
        state: {
            markers:[]

        },
        addLeg: function() {
            let out = `<div class='leg'><button onclick='app.removeLeg(this.parentNode)' class='delete'>X</button><label><input type='text' placeholder='Destination name' size=20></label><address><input type='text' placeholder='Address' size=40></address><button onclick='app.saveLeg(this.parentNode)' style="font-family:Wingdings;"></button> </div>`;
            $("#trip").innerHTML += out;
        },
        addMarker: async function(address) {
            let coord = await app.geocodeAddress(address);
        },
        roundTrip: function(evt) {
            console.log("roundtrip");
            console.dir(evt);
            if (evt.target.checked) {
                app.data.roundtrip = 1;
                document.querySelector("#FinalDropOffAC").setAttribute("readonly", true);
                document.querySelector("#FinalDropOff").setAttribute("readonly", true);
            } else {
                app.data.roundtrip = 0;
                document.querySelector("#FinalDropOffAC").removeAttribute("readonly");
                document.querySelector("#FinalDropOff").removeAttribute("readonly");
            }
        },
        addStop: async function(who, what, evt, isOrigin=false, isFinal=false) {
            let btn = document.querySelector("#updateRoutesButton");
            if (btn) {
                setTimeout(function() { let btn = document.querySelector("#updateRoutesButton"); btn.classList.add("animate__animated"); btn.classList.add("animate__rubberBand"); btn.classList.add("animate__infinite"); }, 500);
            }
            let addr = await app.geocodeAddress(what);
            if (addr) {
                let stop = { coord: [addr.latitude, addr.longitude], source: who, address: what};
    console.log("addStop");
    console.log(`who: ${who} what: ${what}`);
    console.dir(stop);
                let tmpmark = L.marker([addr.latitude, addr.longitude], {icon: app.data.pinIcon});
                app.state.markers.push(tmpmark);
                tmpmark.addTo(app.maps[0]);

                if (!isOrigin && !isFinal) {
                    app.data.stops[who] = stop;
                } else if (isOrigin) {
                    app.data.origin = app.data.stops.Pickup = stop;
                } else if (isFinal) {
                    app.data.final = app.data.stops.FinalDropOff = stop;
                }
                app.data.stops[who].address = document.querySelector(`#${who}`).value;
            }
        },
        removeWaypoint: function(who) {
            document.querySelector(`#Waypoint${who}Wrap`).parentNode.removeChild(document.querySelector(`#Waypoint${who}Wrap`));
            app.data.waypoints.splice(who, 1);
            app.data.waypoint--;
            app.refreshWaypoints();
        },
        refreshWaypoints: function() {
            let container = document.querySelector("#waypoints");
            container.innerHTML = '';
            app.data.waypoints = [];
            
            for (let i=0; i<app.data.waypoint; i++) {
                let item = app.data.stops[`Waypoint${i+1}`];
                let el = app.makeWaypoint(i + 1, item.address);

                container.appendChild(el);
                app.data.waypoints.push(el);
            };
        },
        stopChanged: function(who, what) {
            console.log(`stopChanged: who ${who} what ${what}`);
        },
        updateRoutes: function(evt) {
            evt.stopPropagation();
            evt.preventDefault();
            let mapstops = "";
            document.querySelector("#map0").scrollIntoView();
            if (!app.data.stops.Pickup || !app.data.stops.FinalDropOff) {
                return;
            }
            app.data.stops.Pickup.address = document.querySelector("#Pickup").value;
            app.data.stops.FinalDropOff.address = document.querySelector("#FinalDropOff").value;

            let out = [];
            if (app.data.stops.Pickup.coord) {
                out = [[app.data.stops.Pickup.coord[1], app.data.stops.Pickup.coord[0]]];
            }
            document.querySelectorAll(".waypoint").forEach(el=>el.parentNode.removeChild(el));
            document.querySelector("#showDate").innerHTML = document.querySelector("#Date").value;
            document.querySelector("#pickup0").innerHTML = app.data.stops.Pickup.address.replace(/CA.*/, '');
            document.querySelector("#destination0").innerHTML = app.data.stops.FinalDropOff.address.replace(/CA.*/, '');
            document.querySelector("#pickup0Time").innerHTML = document.querySelector("#Start").value;
            
            let anchor = document.querySelector("#map-waypoints");
            for (let i=0; i<app.data.waypoints.length; i++) {
                let key = `Waypoint${i+1}`;
                let wp = app.data.stops[key];
                wp.address = document.querySelector(`#${key}`).value.replace(/CA.*/, '');
                let node = document.createElement("div");
                node.className = "waypoint";
                node.innerHTML = `<i class="fas fa-location-dot bg-blue"></i><div class="timeline-item"><span class="time"><i class="fas fa-clock"></i> <span id="wp-segment${i}"></span></span><h3 class="timeline-header no-border" id="Waypoint${i+1}">${wp.address}</h3></div>`;
                anchor.insertAdjacentElement("beforebegin", node);
                // mapstops += `<div><i class="fas fa-location-dot bg-blue"></i><div class="timeline-item"><span class="time"><i class="fas fa-clock"></i> <span id="Waypoint${i+1}Time"></span></span><h3 class="timeline-header no-border" id="Waypoint${i+1}">${wp.address}</h3></div></div>`;
                // mapstops += `<div class='waypointMetrics' id='wp-segment${i}'></div><div class='form-flex'><img src="/portal/assets/mappin.svg" height="32" width="32" style="float: left; height: 26px; width: 19px; margin: 0.25rem;"><label>Stop ${i+1}</label><div class='showval'>${wp.address}</div></div>`;
                out.push([app.data.stops[`Waypoint${i+1}`].coord[1], app.data.stops[`Waypoint${i+1}`].coord[0]]);
            }
            // mapstops += `<div class='waypointMetrics' id='wp-segment${app.data.waypoints.length}'></div><div class='form-flex'><img src="/portal/assets/finishflag.svg" height="32" width="32" style="float: left; height: 1.2rem; width: 1.5rem; margin: 0.25rem;"><label>Final Dropoff</label><div class='showval'>${app.data.stops.FinalDropOff.address}</div></div>`;
            //document.querySelector("#map-waypoints").innerHTML = mapstops;
            out.push([app.data.stops.FinalDropOff.coord[1], app.data.stops.FinalDropOff.coord[0]]);
            let obj = { "coordinates": out };
            let json = JSON.stringify(obj);
            
            fetch(`/portal/multistops.php?json=${json}`).then(r=>r.json()).then(data=>{
                console.log("updateRoutes");
                console.dir(data);
                app.data.routes = data;
                L.geoJSON(data).addTo(app.maps[0]);

                document.querySelector("#distance0").innerHTML = Math.round(data.features[0].properties.summary.distance * 0.000621371) + " miles";
                
                let dur = app.cleanTime(data.features[0].properties.summary.duration);
                
                document.querySelector(`#duration0`).innerHTML = dur;
                let segs =  data.features[0].properties.segments;
                for (let i=0; i< segs.length-1; i++) {
                    let item = segs[i]; 
                    document.querySelector(`#wp-segment${i}`).innerHTML = app.cleanTime(item.duration) ;// + ' | ' + (Math.floor((item.distance * 0.000621371) * 10) / 10) + " miles";
                };
                document.querySelector(`#WaypointFinalTime`).innerHTML = app.cleanTime(segs[segs.length-1].duration)
            });
            return false;
        },
        getRouteMulti: async function(json) {
            let waypoints = app.data.record.Destination.split(/\|/);
            let addrs = [app.data.record.Pickup].concat(waypoints);
            addrs.push(app.data.record.Return);

            let coord = [];
            let mrks = L.featureGroup().addTo(app.maps[0]);

            for (let i=0; i<addrs.length; i++) {
                let addr = addrs[i];
                let wpcoord = await app.geocodeAddress(addr);
                let mrk = L.marker([wpcoord['latitude'], wpcoord['longitude']]);
                mrks.addLayer(mrk);
                if (wpcoord) coord.push([wpcoord["longitude"], wpcoord["latitude"]]);

            }
            let myobj = { coordinates: coord };

            let myjson = encodeURIComponent(JSON.stringify(myobj));
            fetch(`/portal/multistops.php?json=${myjson}`).then(r=>r.json()).then(data=>{
                console.log("getRouteMulti");
                console.dir(data);
                app.data.routes = data;
                let feature = L.geoJSON(data).addTo(app.maps[0]);
                app.maps[0].fitBounds(feature.getBounds());
                document.querySelector("#distance0").innerHTML = Math.round(data.features[0].properties.summary.distance * 0.000621371) + " miles";
                
                let dur = app.cleanTime(data.features[0].properties.summary.duration);
                
                document.querySelector(`#duration0`).innerHTML = dur;
                let segs =  data.features[0].properties.segments, el, item;
                for (let i=0; i< segs.length-1; i++) {
                    item = segs[i]; 
                    el = document.querySelector(`#wp-segment${i}`);
                    if (el) el.innerHTML = app.cleanTime(item.duration) ;
                };
                el = document.querySelector(`#WaypointFinalTime`);
                if (el) el.innerHTML = app.cleanTime(segs[segs.length-1].duration);
            });

        },
        cleanTime: function(totsec) {
            if (totsec > 0) {
                let hr = 0, min = Math.ceil(totsec / 60);
                if (min > 60) {
                    hr = Math.floor(min / 60);
                    min = (min - (hr * 60));
                } else {
                    hr = 0;
                    min = Math.floor(totsec / 60);
                }
                if (min < 10) {
                    min = '0' + min;
                }
//                if ((hr < 10) && (hr != 0)) { hr = '0' + hr; }
                if (hr > 0) {
                    return `${hr}:${min}`;
                } else if (hr == 0) {
                    return `0:${min}`;
                }
                return `${hr}:${min}`;
            } else {
                return '0:00';
            }
         
        },
        addWaypoint: function(address, who) {
            app.data.waypoint++;
            let WaypointNumber = app.data.waypoint;

            let el = app.makeWaypoint(WaypointNumber);
            app.data.stops[`Waypoint${WaypointNumber}`] = { id: WaypointNumber, address:"" };
            document.querySelector("#waypoints").appendChild(el);
            app.data.waypoints.push(el);
        },
        makeWaypoint: function(stopNum, value="") {
            let el = document.createElement("div");
            el.id = `Waypoint${stopNum}Wrap`;
            el.className = "form-group";
            let ac = document.createElement("auto-complete");
            ac.id = `Waypoint${stopNum}AC`;
            ac.setAttribute("src", "/portal/address2.php");
            ac.setAttribute("for", `Waypoint${stopNum}-popup`);
            ac.style ="width:100%;";
            ac.className = "input-group";
            ac.addEventListener("auto-complete-change", function(event) {
                app.acSelect(event.relatedTarget, event);
            });
            ac.innerHTML = `<div class="input-group-prepend"><div class="input-group-icon waypoint-icon"><img src="/portal/assets/mappin.svg"><\/div><\/div><input type="text" name="Waypoint${stopNum}" id="Waypoint${stopNum}" value="${value}" name='Waypoint[Address]' class="form-control"><div class="input-group-append"><button onclick="return app.removeWaypoint(${stopNum})" class="input-group-icon"><i class="far fa-trash-alt waypoint-trash"><\/i><\/button><\/div><ul class="acpopup" id="Waypoint${stopNum}-popup" onclick="app.doClickAC('Waypoint${stopNum}', event)"><\/ul>`;
            ac.querySelector("input").addEventListener("change", function(evt) {
                console.log(`${this.id} was changed`);
                console.dir(evt);
                app.addStop(evt.target.id, evt.target.value, evt, false, false);
            });
            el.innerHTML = `<label for="Waypoint${stopNum}AC">Stop #${stopNum}</label>`;
            el.appendChild(ac);
            setTimeout(function() { document.querySelector(`#Waypoint${stopNum}`).focus(); }, 200);
            ac.querySelector("input").focus();

            return el;
        },
        doClickAC: function(who, evt) {
            console.log(`doClickAC\n${who}`);
            console.dir(evt);
        },
        acSelect: async function( el, evt) {
            console.log("acSelect");
            console.dir(evt);
            let selected = evt.target;
            if (!(selected instanceof HTMLElement)) return;
            console.log(`selected: ${selected}`);

            const value = evt.relatedTarget.value;
            if (!app.data.stops[evt.relatedTarget.id]) {
                app.data.stop[evt.relatedTarget.id] = {};
            }
            console.log(`autocomplete target: ${evt.relatedTarget.id}`);

            app.data.stops[evt.relatedTarget.id].address = value;
            console.log(`Selected autocomplete item: ${value}`);
            
            let coord = await app.geocodeAddress(value);
            app.data.stops[evt.relatedTarget.id] = {address: value, coord: coord};

            if (app.data.roundtrip && evt.relatedTarget.id == "Pickup") {
                document.querySelector("#FinalDropOff").value = value;
                app.data.stops.FinalDropOff.coord = [coord.latitude, coord.longitude];
                app.data.stops.FinalDropOff.address = value;
            }

            app.addStop(el.id, value, event);
        },
        makeRequest: function(evt) {
            evt.stopPropagation();
            evt.preventDefault();

            let req = {};
            
            req.Pickup = app.data.stops.Pickup.address;
            let wps = [];

            for (let i=0; i<app.data.waypoint; i++) {
                wps.push(app.data.stops[`Waypoint${i+1}`].address);
            }
            req.Destination = wps.join("|");
            req.Return = app.data.stops.FinalDropOff.address;
            req.Start = document.querySelector("#Start").value;
            req.End = document.querySelector("#End").value;
            req.RoundTrip = (document.querySelector("#input_RoundTrip").checked) ? true : false;
            req.Cargo = (document.querySelector("#input_Cargo").checked) ? true : false;
            req.ADA = (document.querySelector("#input_ADA").checked) ? true : false;
            req.SPAB = (document.querySelector("#input_SPAB").checked) ? true : false;
            req.Pax = document.querySelector("#Passengers").value;
            req.Date = document.querySelector("#Date").value;
            req.Notes = document.querySelector("#Notes").value;
            
            app.postData("/portal/api.php?type=makeRequest", { data: req }).then(data=>{
                if (data.newid) {
                    document.location.href = `/portal/trips/view-quote.php?id=${data.newid}`;
                }
            });;
/*
            fetch("/portal/api.php?type=makeRequest", {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({data: req})
            }).then(r=>r.json()).then(data=>{
                app.state.response = data;
                document.location.href = `/portal/trips/view-quote.php?id=${data.newid}`;
            });
            */
            return false;
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
        getGeoJSON2: function(origin, dest, mapidx) {
            let tgtmap = document.querySelector(`map${mapidx}`);

            fetch(`/portal/directions.php?start=${origin}&end=${dest}`).then(r=>r.json()).then(data=>{
                L.geoJSON(data).addTo(app.maps[mapidx]);
                console.log("directions:");
                console.dir(data);
                let bounds = [[data.bbox[3], data.bbox[2]], [data.bbox[1], data.bbox[0]]];
                app.maps[mapidx].fitBounds(bounds, {padding: [50, 50]} );

                document.querySelector(`#distance${mapidx}`).innerHTML = Math.round(data.features[0].properties.summary.distance * 0.000621371) + " miles";

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
                document.querySelector(`#duration${mapidx}`).innerHTML = `${hr}:${min}`;
                document.querySelector(`#overlay${mapidx}`).style.display = "none";
                 
            });
        },
        makeStaticMap: function() {
            domtoimage.toPng(document.querySelector("#map")).then((dataUrl) => {
                let img = new Image();
                img.src = dataUrl;
                document.body.appendChild(img);
                document.querySelector("#static")?.appendChild(img);
                console.log(dataUrl)
            });
        },
        getGeoJSON: function(coord, tgtmap=app.map) {
            
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

                L.geoJSON(data).addTo(tgtmap);
                let bounds = [[data.bbox[3], data.bbox[2]], [data.bbox[1], data.bbox[0]]];

                tgtmap.fitBounds(bounds);

                document.querySelector("#distance").innerHTML = Math.round(app.data.geojson.features[0].properties.summary.distance * 0.000621371) + " miles";

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
                
                setTimeout(function() {
                    if (domtoimage) {
                        console.log("creating static image");
                        domtoimage.toPng(document.querySelector("#map")).then((dataUrl) => {
                        let img = new Image();
                        img.src = dataUrl;
                        document.body.appendChild(img);
                        document.querySelector("#static")?.appendChild(img);
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
        getAddress: async function(address) {
            address = await app.cleanAddress(address);
            let g = app.geocodeAddress(address);
        },
        getRoute: async function(address1="", address2="", mapidx=0) {
            if (!address1 || !address2) {
                return false;
            }
            
            let overlay = document.querySelector(`#overlay${mapidx}`);
            if (overlay) {
                overlay.style.display = "block";
            }
            
            console.log(`getRoute: ${address1} to ${address2}`);
            let newaddr1 = await app.cleanAddress(address1);
            let newaddr2 = await app.cleanAddress(address2);
            
            console.log(`clean addr 1: ${newaddr1}\nclean addr 2: ${newaddr2}\n`);
            if (newaddr1) {
                address1 = newaddr1;
            }

            if (newaddr2) {
                address2 = newaddr2;
            }
            document.querySelector(`#pickup${mapidx}`).innerHTML = address1;
            document.querySelector(`#destination${mapidx}`).innerHTML = address2;

            let g1 = app.geocodeAddress(address1);// .then(coord=>{ app.data.origin = coord; console.log("geocode1"); console.dir(coord); });
            let g2 = app.geocodeAddress(address2);// .then(coord=>{ app.data.dest = coord; console.log("geocode2"); console.dir(coord); });
            Promise.all([ g1, g2]).then((values) => {
                let orig = [values[0].latitude, values[0].longitude];

                app.getGeoJSON2([values[0].longitude, values[0].latitude], [values[1].longitude, values[1].latitude], mapidx);
            });

            return false;
        },
        cleanAddress: async function(address) {
            let clean = {}, cleanTxt = "", city;
            address = address.replace(/SF/g, "San Francisco");
            address = address.replace(/CA/g, "");
            address = address.replace(/\(.*/, '');
            let parts = address.split(/,/);
            console.log(address);
            if (matches = address.match(/(\d+\s[^,]+),\s*([^,]+)/)) {
                console.log("***Matches:");
                console.dir(matches);
                city = matches[2].trim();
                if (city.match(/sf/i)) {
                    city = "San Francisco";
                }

                cleanTxt = matches[1] + ', ' + city + ', CA';
                return cleanTxt;
            }
            const resp = await fetch(`https://nominatim.openstreetmap.org/search/${address}?format=geojson&addressdetails=1&limit=1&polygon_svg=1`);
            const data = await resp.json();
            if (data && data.features && data.features.length) {
                let addr = data.features[0].properties.address;
                let state = addr.state;
                if (addr['ISO3166-2-lvl4']) {
                    state = addr['ISO3166-2-lvl4'].substring(addr['ISO3166-2-lvl4'].length - 2)
                }
                cleanTxt = addr.house_number + ' ' + addr.road + ', ' + addr.city + ' ' + state + ' ' + addr.postcode;
                clean.address = addr.house_number + ' ' + addr.road;
                clean.city = addr.city;
                clean.state = state;
                clean.zip = addr.postcode;
            }
            return cleanTxt;
        },
        geocodeAddress: async function(address) {
            const apiUrl = `/portal/geocode.php?addr=${address}`;
            // const apiUrl = `https://api.openrouteservice.org/geocode/search?api_key=${app.config.apiKey}&text=${address}`;

            const response = await fetch(apiUrl);
            const data = await response.json();
            let latitude , longitude ;

            if (data.features) {
                if (data.features.length === 0) {
                    return null;
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
    app.init();
})();