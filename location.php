<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Map with OpenStreetMap</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <style>
        #map { height: 500px; width: 100%; }
        #controls-container { padding: 10px; display: flex; gap: 10px; flex-wrap: wrap; }
        input, button { padding: 10px; }
        @media (max-width: 768px) {
            #map { height: 100vh; }
        }
    </style>
</head>
<body>
    <h1>Enhanced Map with GPS, Traffic, and Tools</h1>
    <div id="controls-container">
        <input type="text" id="search-input" placeholder="Search location..." />
        <button id="search-btn">Search</button>
        <button id="route-btn">Add Route</button>
        <button id="traffic-btn">Toggle Traffic</button>
        <button id="measure-btn">Measure Distance</button>
        <button id="clear-overlays-btn">Clear Overlays</button>
    </div>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.min.js"></script>
    <script src="https://unpkg.com/leaflet-measure/dist/leaflet-measure.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-measure/dist/leaflet-measure.css" />
    <script>
        let map, userMarker, routingControl, trafficLayer;
        const savedMarkers = JSON.parse(localStorage.getItem('markers') || '[]');
        let measureControl;

        // Initialize the map
        function initMap(lat, lon) {
            map = L.map('map').setView([lat, lon], 13);

            const streets = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
            const satellite = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png');
            trafficLayer = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png');

            L.control.layers({ "Streets": streets, "Satellite": satellite, "Traffic": trafficLayer }).addTo(map);

            userMarker = L.marker([lat, lon]).addTo(map)
                .bindPopup('You are here')
                .openPopup();

            // Load saved markers
            savedMarkers.forEach(latlng => {
                L.marker(latlng).addTo(map);
            });
        }

        // Update user location
        function updateLocation(position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;
            userMarker.setLatLng([lat, lon]);
            map.setView([lat, lon], 13);
        }

        // Search for a location
        function searchLocation(query) {
            const apiKey = 'YOUR_OPENCAGE_API_KEY'; // Replace with your OpenCage API Key
            fetch(`https://api.opencagedata.com/geocode/v1/json?q=${encodeURIComponent(query)}&key=${apiKey}`)
                .then(response => response.json())
                .then(data => {
                    if (data.results.length > 0) {
                        const { lat, lng } = data.results[0].geometry;
                        map.setView([lat, lng], 13);
                        userMarker.setLatLng([lat, lng])
                            .bindPopup(`Location: ${data.results[0].formatted}`)
                            .openPopup();
                    } else {
                        alert("No results found. Try a different location.");
                    }
                })
                .catch(err => alert("Error fetching location: " + err.message));
        }

        // Add routing between two points
        function addRouting() {
            if (routingControl) map.removeControl(routingControl); // Remove existing routes
            routingControl = L.Routing.control({
                waypoints: [
                    L.latLng(51.505, -0.09), // Example Start
                    L.latLng(51.515, -0.1)   // Example End
                ],
                routeWhileDragging: true
            }).addTo(map);
        }

        // Toggle traffic layer
        function toggleTraffic() {
            if (map.hasLayer(trafficLayer)) {
                map.removeLayer(trafficLayer);
            } else {
                map.addLayer(trafficLayer);
            }
        }

        // Enable measure distance tool
        function measureDistance() {
            if (measureControl) {
                map.removeControl(measureControl);
                measureControl = null;
            } else {
                measureControl = new L.Control.Measure({
                    primaryLengthUnit: 'meters',
                    secondaryLengthUnit: 'kilometers'
                });
                map.addControl(measureControl);
            }
        }

        // Clear overlays (routes, measurement tools)
        function clearOverlays() {
            if (routingControl) {
                map.removeControl(routingControl);
                routingControl = null;
            }
            if (measureControl) {
                map.removeControl(measureControl);
                measureControl = null;
            }
        }

        // Get user location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                const { latitude: lat, longitude: lon } = position.coords;
                initMap(lat, lon);
                navigator.geolocation.watchPosition(updateLocation, err => alert("Error: " + err.message));
            }, () => alert("Geolocation not supported or denied."));
        } else {
            alert("Geolocation is not supported by this browser.");
        }

        // Event listeners
        document.getElementById('search-btn').addEventListener('click', () => {
            const query = document.getElementById('search-input').value;
            if (query) searchLocation(query);
        });
        document.getElementById('route-btn').addEventListener('click', addRouting);
        document.getElementById('traffic-btn').addEventListener('click', toggleTraffic);
        document.getElementById('measure-btn').addEventListener('click', measureDistance);
        document.getElementById('clear-overlays-btn').addEventListener('click', clearOverlays);
    </script>
</body>
</html>
