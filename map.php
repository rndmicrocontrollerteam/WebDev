<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Smart MCC Batam</title>

    <!-- Leaflet.js CDN for interactive maps -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.1/dist/leaflet.js"></script>
</head>

<body class="bg-gray-100 text-gray-800 transition-all duration-300">

    <div class="flex h-screen">

        <!-- Sidebar -->
        <aside id="sidebar"
            class="w-64 px-2 bg-gradient-to-br from-blue-500 to-blue-700 text-white shadow-xl transition-all duration-300">
            <a href="index.php" class="flex items-center mt-5 px-4 py-3 text-white hover:text-slate-200">
                <span class="material-icons text-blue-100 p-2 rounded-lg shadow-lg">cloud</span>
                <span class="ml-3 text-xl font-semibold">MCC Batam</span>
            </a>
            <hr class="h-1 my-4 mx-4 bg-gradient-to-r from-transparent via-indigo-500 to-transparent">
            <nav class="mt-6 space-y-2">
                <a href="index.php"
                    class="flex items-center px-4 py-3 text-white hover:bg-blue-600 hover:shadow-xl rounded-md">
                    <span class="material-icons text-blue-100 p-2 rounded-lg shadow-lg">dashboard</span>
                    <span class="ml-3">Dashboard</span>
                </a>
                <a href="table.php"
                    class="flex items-center px-4 py-3 text-white hover:bg-blue-600 hover:shadow-xl rounded-md">
                    <span class="material-icons text-blue-100 p-2 rounded-lg shadow-lg">table_rows</span>
                    <span class="ml-3">Table</span>
                </a>
                <a href="map.php"
                    class="flex items-center px-4 py-3 text-white bg-blue-600 hover:bg-blue-700 shadow-xl rounded-md">
                    <span class="material-icons text-blue-100 p-2 rounded-lg shadow-lg">map</span>
                    <span class="ml-3">Map</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-white hover:bg-blue-600 hover:shadow-xl rounded-md">
                    <span class="material-icons text-blue-100 p-2 rounded-lg shadow-lg">settings</span>
                    <span class="ml-3">Settings</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-white hover:bg-blue-600 hover:shadow-xl rounded-md">
                    <span class="material-icons text-blue-100 p-2 rounded-lg shadow-lg">logout</span>
                    <span class="ml-3">Logout</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 bg-white rounded-lg shadow-xl overflow-y-auto">
            <h1 class="text-3xl font-semibold text-blue-600">Map of Batam</h1>
            <hr class="my-4 bg-indigo-500">

            <div class="bg-gray-50 rounded-lg shadow-lg p-4">
                <p class="text-lg text-gray-700 mb-4">Explore Batam with an interactive map. Here you can view various
                    data points marked on the map, with the ability to zoom in and out.</p>

                <!-- Map Container -->
                <div id="map" class="w-full h-[500px] rounded-lg overflow-hidden"></div>
            </div>
        </main>
    </div>

    <script>
        // Initialize the map centered at Batam, Indonesia
        var map = L.map('map').setView([1.1279, 104.0508], 12);

        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // You can add markers or other elements if necessary
        L.marker([1.1279, 104.0508]).addTo(map)
            .bindPopup('This is Batam, Indonesia')
            .openPopup();
    </script>
</body>

</html>