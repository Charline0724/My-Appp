<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Map with Control Panel</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.min.css" />
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
        }

        #map {
            height: 500px;
            width: 70%;
            margin: 20px 0;
        }

        /* Control Panel Styling */
        .panel {
            width: 300px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 16px;
        }

        .panel h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .section {
            margin-bottom: 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .grid-item {
            text-align: center;
            font-size: 14px;
            color: #555;
        }

        .grid-item img {
            width: 40px;
            height: 40px;
            margin-bottom: 6px;
        }

        .checkbox-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .checkbox-group label {
            font-size: 14px;
            color: #555;
        }

        button {
            padding: 12px 15px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        button:hover {
            background-color: #0056b3;
        }

        button:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>
    <h1>Interactive Map with Control Panel</h1>
    <div id="map"></div>
    <div class="panel">
        <!-- Map Details Section -->
        <div class="section">
            <h3>Map Details</h3>
            <div class="grid">
                <div class="grid-item">
                    <img src="https://via.placeholder.com/40" alt="Transit">
                    <p>Transit</p>
                </div>
                <div class="grid-item">
                    <img src="https://via.placeholder.com/40" alt="Traffic">
                    <p>Traffic</p>
                </div>
                <div class="grid-item">
                    <img src="https://via.placeholder.com/40" alt="Biking">
                    <p>Biking</p>
                </div>
                <div class="grid-item">
                    <img src="https://via.placeholder.com/40" alt="Terrain">
                    <p>Terrain</p>
                </div>
                <div class="grid-item">
                    <img src="https://via.placeholder.com/40" alt="Street View">
                    <p>Street View</p>
                </div>
                <div class="grid-item">
                    <img src="https://via.placeholder.com/40" alt="Wildfires">
                    <p>Wildfires</p>
                </div>
                <div class="grid-item">
                    <img src="https://via.placeholder.com/40" alt="Air Quality">
                    <p>Air Quality</p>
                </div>
            </div>
        </div>

        <!-- Map Tools Section -->
        <div class="section">
            <h3>Map Tools</h3>
            <button id="toggle-traffic">Toggle Traffic</button>
            <button id="measure-distance">Measure Distance</button>
            <button id="clear-overlays">Clear Overlays</button>
        </div>

        <!-- Map Type Section -->
        <div class="section">
            <h3>Map Type</h3>
            <button id="toggle-satellite">Toggle Satellite View</button>
            <div class="checkbox-group">
                <label>
                    <input type="checkbox"> Globe View
                </label>
                <label>
                    <input type="checkbox" checked> Labels
                </label>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.min.js"></script>
    <script>
        let map, trafficLayer, satelliteLayer, measureTool;

        // Initialize map
        function initMap() {
            map = L.map('map').setView([7.8896, 125.0935], 10);

            const streetLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            satelliteLayer = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenTopoMap contributors'
            });

            trafficLayer = L.tileLayer('https://tile.openstreetmap.org/traffic/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            });
        }

        // Toggle traffic layer
        document.getElementById('toggle-traffic').addEventListener('click', () => {
            if (map.hasLayer(trafficLayer)) {
                map.removeLayer(trafficLayer);
            } else {
                map.addLayer(trafficLayer);
            }
        });

        // Measure distance
        document.getElementById('measure-distance').addEventListener('click', () => {
            if (!measureTool) {
                measureTool = L.polyline([], { color: 'blue' }).addTo(map);

                map.on('click', function (e) {
                    measureTool.addLatLng(e.latlng);
                    if (measureTool.getLatLngs().length > 1) {
                        const distance = measureTool.getLatLngs().reduce((total, latlng, i, arr) => {
                            if (i === 0) return total;
                            return total + arr[i - 1].distanceTo(latlng);
                        }, 0);
                        alert(`Distance: ${(distance / 1000).toFixed(2)} km`);
                    }
                });
            }
        });

        // Clear overlays
        document.getElementById('clear-overlays').addEventListener('click', () => {
            if (measureTool) {
                map.removeLayer(measureTool);
                measureTool = null;
            }
        });

        // Toggle satellite view
        document.getElementById('toggle-satellite').addEventListener('click', () => {
            if (map.hasLayer(satelliteLayer)) {
                map.removeLayer(satelliteLayer);
            } else {
                map.addLayer(satelliteLayer);
            }
        });

        // Initialize map
        initMap();
    </script>
</body>
</html>
