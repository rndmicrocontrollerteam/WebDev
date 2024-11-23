<?php

include("backend.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Smart MCC Batam</title>
</head>

<body style="overflow-x: hidden;"
    class="bg-gray-100 text-gray-800 transition-all duration-300 selection:bg-fuchsia-300 selection:text-fuchsia-900">
    <div class="flex h-100">
        <aside id="sidebar"
            class="w-64 px-2 bg-gradient-to-br from-blue-500 to-blue-700 text-white shadow-xl transition-all duration-300">
            <a href="index.php" class="flex items-center mt-3 px-4 py-3 text-white hover:text-slate-200">
                <span class="material-icons text-blue-100 p-2 rounded-lg shadow-lg">cloud</span>
                <span class="ml-3 sidebar-text">MCC Batam</span>
            </a>
            <hr class="h-1 my-3 mx-4 bg-gradient-to-r from-transparent via-indigo-500 to-transparent">
            <nav class="mt-6 space-y-2">
                <a href="index.php" class="flex items-center px-4 py-3 text-white shadow-xl rounded-md">
                    <span class="material-icons text-blue-100 p-2 rounded-lg shadow-lg">dashboard</span>
                    <span class="ml-3 sidebar-text">Dashboard</span>
                </a>
                <a href="table.php"
                    class="flex items-center px-4 py-3 text-white hover:bg-blue-600 hover:shadow-xl rounded-md">
                    <span class="material-icons text-blue-100 p-2 rounded-lg shadow-lg">table_rows</span>
                    <span class="ml-3 sidebar-text">Table</span>
                </a>
                <a href="map.php"
                    class="flex items-center px-4 py-3 text-white hover:bg-blue-600 hover:shadow-xl rounded-md">
                    <span class="material-icons text-blue-100 p-2 rounded-lg shadow-lg">map</span>
                    <span class="ml-3 sidebar-text">Map</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-white hover:bg-blue-600 hover:shadow-xl rounded-md">
                    <span class="material-icons text-blue-100 p-2 rounded-lg shadow-lg">settings</span>
                    <span class="ml-3 sidebar-text">Settings</span>
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-white hover:bg-blue-600 hover:shadow-xl rounded-md">
                    <span class="material-icons text-blue-100 p-2 rounded-lg shadow-lg">logout</span>
                    <span class="ml-3 sidebar-text">Logout</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <!-- Navbar -->
            <div class="flex justify-between">
                <div class="flex items-center mb-6">
                    <!-- Breadcrumb -->
                    <nav class="hidden md:flex items-center space-x-2 text-sm text-gray-600">
                        <a href="index.php" class="material-icons text-blue-500">home</a>
                        <span>/</span>
                        <a href="index.php">Dashboard</a>
                        <span>/</span>
                        <a href="index.php" class="font-semibold">MCC BATAM</a>
                        <span>/</span>
                        <a href="index.php" class="font-bold">EM_PLC</a>
                    </nav>
                    <button id="toggleSidebar"
                        class="hidden md:flex text-3xl text-blue-500 hover:text-blue-600 ml-4 z-[999]">
                        <img src="assets/menu.svg" alt="menu icon" class="h-5 w-auto">
                    </button>
                </div>

                <!-- <button id="toggleTheme"
                    class="ml-auto text-3xl text-gray-700 hover:text-gray-900 z-[999] rounded-lg shadow-md py-1 px-3">
                    <span id="themeIcon" class="material-icons">brightness_4</span>
                </button> -->
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="flex flex-col">
                    <div class="flex flex-col md:flex-row items-center justify-between">
                        <h1 class="text-sm md:text-3xl font-bold text-blue-600 mt-6">Monitoring Smart MCC Batam</h1>
                        <span class="text-sm md:text-md font-semibold italic text-sky-300 mt-6">| Topic:
                            MCC/BATAM/EM_PLC/</span>
                    </div>
                    <hr class="h-1 my-3 bg-gradient-to-r from-indigo-500 to-transparent">

                    <div class="grid grid-rows-2 gap-4">
                        <!-- Voltage Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="p-4 bg-gradient-to-br from-amber-100/10 to-transparent shadow-md rounded-lg">
                                <div class="flex justify-between">
                                    <div class="flex-col">
                                        <h3 class="text-sm md:text-md font-bold text-gray-700">Voltage 1</h3>
                                        <p class="text-md md:text-2xl font-semibold text-blue-500">
                                            <?= $data['volt1'] ?? 'N/A' ?> V
                                        </p>
                                    </div>
                                    <div
                                        class="flex h-fit p-2 rounded-lg shadow-md bg-gradient-to-r from-blue-400 to-blue-700">
                                        <span class="material-icons text-lg md:text-4xl">electric_bolt</span>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 bg-gradient-to-br from-amber-100/10 to-transparent shadow-md rounded-lg">
                                <div class="flex justify-between">
                                    <div class="flex-col">
                                        <h3 class="text-sm md:text-md font-bold text-gray-700">Voltage 2</h3>
                                        <p class="text-md md:text-2xl font-semibold text-blue-500">
                                            <?= $data['volt2'] ?? 'N/A' ?> V
                                        </p>
                                    </div>
                                    <div
                                        class="flex h-fit p-2 rounded-lg shadow-md bg-gradient-to-r from-blue-400 to-blue-700">
                                        <span class="material-icons text-lg md:text-4xl">electric_bolt</span>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 bg-gradient-to-br from-amber-100/10 to-transparent shadow-md rounded-lg">
                                <div class="flex justify-between">
                                    <div class="flex-col">
                                        <h3 class="text-sm md:text-md font-bold text-gray-700">Voltage 3</h3>
                                        <p class="text-md md:text-2xl font-semibold text-blue-500">
                                            <?= $data['volt3'] ?? 'N/A' ?> V
                                        </p>
                                    </div>
                                    <div
                                        class="flex h-fit p-2 rounded-lg shadow-md bg-gradient-to-r from-blue-400 to-blue-700">
                                        <span class="material-icons text-lg md:text-4xl">electric_bolt</span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Total kVAh Card -->
                        <div class="grid grid-cols-1">
                            <div
                                class="h-fit p-4 bg-gradient-to-br from-amber-900/10 to-transparent shadow-md rounded-lg">
                                <div class="flex justify-between">
                                    <div class="flex-col">
                                        <h3 class="text-sm md:text-md font-bold text-gray-700">Total kVAh</h3>
                                        <p class="text-sm md:text-2xl font-semibold text-blue-500">
                                            <?= $data['netKVA'] ?? 'N/A' ?> kVAh
                                        </p>
                                    </div>
                                    <div
                                        class="flex h-fit p-2 rounded-lg shadow-md bg-gradient-to-r from-blue-400 to-blue-700">
                                        <span class="material-icons text-lg md:text-4xl">energy_savings_leaf</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Current Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="p-4 bg-gradient-to-br from-lime-100/10 to-transparent shadow-md rounded-lg">
                                <div class="flex justify-between">
                                    <div class="flex-col">
                                        <h3 class="text-sm md:text-md font-bold text-gray-700">Current 1</h3>
                                        <p class="text-md md:text-2xl font-semibold text-blue-500">
                                            <?= $data['arus1'] ?? 'N/A' ?> V
                                        </p>
                                    </div>
                                    <div
                                        class="flex h-fit p-2 rounded-lg shadow-md bg-gradient-to-r from-blue-400 to-blue-700">
                                        <span class="material-icons text-lg md:text-4xl">electrical_services</span>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 bg-gradient-to-br from-lime-100/10 to-transparent shadow-md rounded-lg">
                                <div class="flex justify-between">
                                    <div class="flex-col">
                                        <h3 class="text-sm md:text-md font-bold text-gray-700">Current 2</h3>
                                        <p class="text-md md:text-2xl font-semibold text-blue-500">
                                            <?= $data['arus2'] ?? 'N/A' ?> A
                                        </p>
                                    </div>
                                    <div
                                        class="flex h-fit p-2 rounded-lg shadow-md bg-gradient-to-r from-blue-400 to-blue-700">
                                        <span class="material-icons text-lg md:text-4xl">electrical_services</span>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 bg-gradient-to-br from-lime-100/10 to-transparent shadow-md rounded-lg">
                                <div class="flex justify-between">
                                    <div class="flex-col">
                                        <h3 class="text-sm md:text-md font-bold text-gray-700">Current 3</h3>
                                        <p class="text-md md:text-2xl font-semibold text-blue-500">
                                            <?= $data['arus3'] ?? 'N/A' ?> A
                                        </p>
                                    </div>
                                    <div
                                        class="flex h-fit p-2 rounded-lg shadow-md bg-gradient-to-r from-blue-400 to-blue-700">
                                        <span class="material-icons text-lg md:text-4xl">electrical_services</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="h-auto mt-6 p-6 bg-gradient-to-br from-blue-100/10 to-transparent shadow-md rounded-lg mb-4">
                        <h3 class="text-lg font-bold text-gray-700 mb-4">Voltage Chart</h3>
                        <hr class="h-1 my-3 bg-gradient-to-r from-indigo-500 to-transparent">
                        <canvas id="realtimeChart"></canvas>
                    </div>

                    <div class="grid grid-rows-3 gap-4">
                        <div class="grid grid-cols-2 row-span-1 gap-4">
                            <div class="p-4 bg-gradient-to-br from-amber-900/10 to-transparent shadow-md rounded-lg">
                                <div class="flex justify-between">
                                    <div class="flex-col">
                                        <h3 class="text-sm md:text-md font-bold text-gray-700">Total kW</h3>
                                        <p class="text-md md:text-2xl font-semibold text-blue-500">
                                            <?= $data['netkW'] ?? 'N/A' ?> kW
                                        </p>
                                    </div>
                                    <div
                                        class="flex h-fit p-2 rounded-lg shadow-md bg-gradient-to-r from-blue-400 to-blue-700">
                                        <span class="material-icons text-lg md:text-4xl">electric_meter</span>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 bg-gradient-to-br from-amber-900/10 to-transparent shadow-md rounded-lg">
                                <div class="flex justify-between">
                                    <div class="flex-col">
                                        <h3 class="text-sm md:text-md font-bold text-gray-700">Total kVAh</h3>
                                        <p class="text-md md:text-2xl font-semibold text-blue-500">
                                            <?= $data['netKVA'] ?? 'N/A' ?> kVAh
                                        </p>
                                    </div>
                                    <div
                                        class="flex h-fit p-2 rounded-lg shadow-md bg-gradient-to-r from-blue-400 to-blue-700">
                                        <span class="material-icons text-lg md:text-4xl">electric_meter</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 row-span-2 gap-4">
                            <div
                                class="h-full p-6 bg-gradient-to-br from-green-900/10 to-transparent shadow-md rounded-lg">
                                <div
                                    class="flex h-fit p-2 rounded-lg shadow-md justify-between mb-4 items-center bg-gradient-to-r from-blue-400 to-blue-700">
                                    <h3 class="text-lg font-bold text-gray-700">Android Battery</h3>
                                    <span
                                        class="material-icons text-lg -rotate-90 w-9 md:text-4xl">battery_full_alt</span>
                                </div>
                                <p class="text-6xl font-semibold text-blue-500"><?= $data_battery['battery'] ?? 'N/A' ?>
                                </p>
                            </div>
                            <div class="gird grid-rows-2">
                                <div
                                    class="p-4 bg-gradient-to-br from-green-900/10 to-transparent shadow-md rounded-lg mb-4">
                                    <div class="flex justify-between">
                                        <div class="flex-col">
                                            <h3 class="text-sm md:text-md font-bold text-gray-700">Lora Battery</h3>
                                            <p class="text-md md:text-2xl font-semibold text-blue-500">
                                                <?= $data_lora['battery_level'] ?? 'N/A' ?> kVAh
                                            </p>
                                        </div>
                                        <div
                                            class="flex h-fit p-2 rounded-lg shadow-md bg-gradient-to-r from-blue-400 to-blue-700">
                                            <span class="material-icons text-lg md:text-4xl">data_exploration</span>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="p-4 bg-gradient-to-br from-green-900/10 to-transparent shadow-md rounded-lg">
                                    <div class="flex justify-between">
                                        <div class="flex-col">
                                            <h3 class="text-sm md:text-md font-bold text-gray-700">Lora Frequency</h3>
                                            <p class="text-md md:text-2xl font-semibold text-blue-500">
                                                <?= $data_lora['frequency'] ?? 'N/A' ?> kVAh
                                            </p>
                                        </div>
                                        <div
                                            class="flex h-fit p-2 rounded-lg shadow-md bg-gradient-to-r from-blue-400 to-blue-700">
                                            <span class="material-icons text-lg md:text-4xl">data_exploration</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="flex flex-col gap-4">
                    <canvas id="scene" class="-mt-24 ms-12" width="710" height="710"></canvas>

                    <div class="grid grid-cols-1 md:grid-cols-3 ms-4 gap-4">
                        <div class="p-4 bg-gradient-to-br from-green-900/10 to-transparent shadow-md rounded-lg">
                            <div class="flex justify-between">
                                <div class="flex-col">
                                    <h3 class="text-sm md:text-md font-bold text-gray-700">kVA1</h3>
                                    <p class="text-md md:text-2xl font-semibold text-blue-500">
                                        <?= $data['kVA1'] ?? 'N/A' ?> kVAh
                                    </p>
                                </div>
                                <div
                                    class="flex h-fit p-2 rounded-lg shadow-md bg-gradient-to-r from-blue-400 to-blue-700">
                                    <span class="material-icons text-lg md:text-4xl">energy_savings_leaf</span>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 bg-gradient-to-br from-green-900/10 to-transparent shadow-md rounded-lg">
                            <div class="flex justify-between">
                                <div class="flex-col">
                                    <h3 class="text-sm md:text-md font-bold text-gray-700">kVA2</h3>
                                    <p class="text-md md:text-2xl font-semibold text-blue-500">
                                        <?= $data['kVA2'] ?? 'N/A' ?> kVAh
                                    </p>
                                </div>
                                <div
                                    class="flex h-fit p-2 rounded-lg shadow-md bg-gradient-to-r from-blue-400 to-blue-700">
                                    <span class="material-icons text-lg md:text-4xl">energy_savings_leaf</span>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 bg-gradient-to-br from-green-900/10 to-transparent shadow-md rounded-lg">
                            <div class="flex justify-between">
                                <div class="flex-col">
                                    <h3 class="text-sm md:text-md font-bold text-gray-700">kVA3</h3>
                                    <p class="text-md md:text-2xl font-semibold text-blue-500">
                                        <?= $data['kVA3'] ?? 'N/A' ?> kVAh
                                    </p>
                                </div>
                                <div
                                    class="flex h-fit p-2 rounded-lg shadow-md bg-gradient-to-r from-blue-400 to-blue-700">
                                    <span class="material-icons text-lg md:text-4xl">energy_savings_leaf</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ms-4 h-fit bg-transparent items-center justify-center p-4 shadow-md rounded-lg">
                        <h3 class="text-lg font-bold text-gray-700 mb-4">Current Chart</h3>
                        <hr class="h-1 my-3 bg-gradient-to-r from-indigo-500 to-transparent">
                        <canvas id="currentChart"></canvas>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/script.js"></script>

</body>

</html>