<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$user = 'root';
$password = 'rnd.admin1';
$database = 'mcc_batam';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$page = max($page, 1);

$limit = 10;
$offset = ($page - 1) * $limit;

$totalResult = $conn->query("SELECT COUNT(*) AS total FROM em_plc_data");
$totalRows = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

$query = "SELECT * FROM em_plc_data LIMIT $limit OFFSET $offset";
$result = $conn->query($query);
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

<body class="bg-gray-100 text-gray-800 transition-all duration-300">
    <div class="flex h-screen">
        <aside id="sidebar"
            class="w-64 px-2 bg-gradient-to-br from-blue-500 to-blue-700 text-white shadow-xl transition-all duration-300">
            <a href="index.php" class="flex items-center mt-3 px-4 py-3 text-white hover:text-slate-200">
                <span class="material-icons text-blue-100 p-2 rounded-lg shadow-lg">cloud</span>
                <span class="ml-3 sidebar-text">MCC Batam</span>
            </a>
            <hr class="h-1 my-3 mx-4 bg-gradient-to-r from-transparent via-indigo-500 to-transparent">
            <nav class="mt-6 space-y-2">
                <a href="index.php"
                    class="flex items-center px-4 py-3 text-white hover:bg-blue-600 hover:shadow-xl rounded-md">
                    <span class="material-icons text-blue-100 p-2 rounded-lg shadow-lg">dashboard</span>
                    <span class="ml-3 sidebar-text">Dashboard</span>
                </a>
                <a href="table.php" class="flex items-center px-4 py-3 text-white shadow-xl rounded-md">
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
            <div class="hidden md:flex justify-between items-center mb-6">
                <nav class="flex items-center space-x-2 text-sm text-gray-600">
                    <a href="index.php" class="material-icons text-blue-500">home</a>
                    <span>/</span>
                    <a href="index.php">Dashboard</a>
                    <span>/</span>
                    <a href="table.php" class="font-semibold">Table</a>
                </nav>
            </div>

            <h1 class="text-3xl font-bold text-blue-600">Monitoring Smart MCC Batam - Data Table</h1>
            <hr class="my-4 bg-indigo-500">

            <!-- Table to display data -->
            <div class="table-auto md:table-fixed shadow-lg rounded-lg">
                <table class="min-w-full bg-white rounded-lg border-separate border-spacing-0">
                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left">ID</th>
                            <th class="px-6 py-3 text-left">Voltage 1</th>
                            <th class="px-6 py-3 text-left">Voltage 2</th>
                            <th class="px-6 py-3 text-left">Voltage 3</th>
                            <th class="px-6 py-3 text-left">Current 1</th>
                            <th class="px-6 py-3 text-left">Current 2</th>
                            <th class="px-6 py-3 text-left">Current 3</th>
                            <th class="px-6 py-3 text-left">Total kVAh</th>
                            <th class="px-6 py-3 text-left">kVA 1</th>
                            <th class="px-6 py-3 text-left">kVA 2</th>
                            <th class="px-6 py-3 text-left">kVA 3</th>
                            <th class="px-6 py-3 text-left">Net KW</th>
                            <th class="px-6 py-3 text-left">Net KVA</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-800">
                        <?php if ($result->num_rows > 0): ?>
                            <?php while ($data = $result->fetch_assoc()): ?>
                                <tr class="border-b hover:bg-blue-50">
                                    <td class="px-6 py-3"><?= $data['id'] ?></td>
                                    <td class="px-6 py-3"><?= $data['volt1'] ?></td>
                                    <td class="px-6 py-3"><?= $data['volt2'] ?></td>
                                    <td class="px-6 py-3"><?= $data['volt3'] ?></td>
                                    <td class="px-6 py-3"><?= $data['arus1'] ?></td>
                                    <td class="px-6 py-3"><?= $data['arus2'] ?></td>
                                    <td class="px-6 py-3"><?= $data['arus3'] ?></td>
                                    <td class="px-6 py-3"><?= $data['kVAh'] ?></td>
                                    <td class="px-6 py-3"><?= $data['kVA1'] ?></td>
                                    <td class="px-6 py-3"><?= $data['kVA2'] ?></td>
                                    <td class="px-6 py-3"><?= $data['kVA3'] ?></td>
                                    <td class="px-6 py-3"><?= $data['netkW'] ?></td>
                                    <td class="px-6 py-3"><?= $data['netKVA'] ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="13" class="px-6 py-3 text-center text-red-500">No data available</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination Buttons -->
            <div class="flex justify-center mt-6">
                <nav aria-label="Page navigation">
                    <ul class="flex space-x-2">
                        <li>
                            <a href="?page=1"
                                class="material-icons px-2 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 <?= $page == 1 ? 'cursor-not-allowed opacity-50' : '' ?>"
                                <?= $page == 1 ? 'disabled' : '' ?>>keyboard_double_arrow_left</a>
                        </li>
                        <li>
                            <a href="?page=<?= $page - 1 ?>"
                                class="material-icons px-2 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 <?= $page == 1 ? 'cursor-not-allowed opacity-50' : '' ?>"
                                <?= $page == 1 ? 'disabled' : '' ?>>chevron_left</a>
                        </li>

                        <li>
                            <span class="px-4 py-2 bg-blue-200 text-white rounded-md"><?= $page ?> /
                                <?= $totalPages ?></span>
                        </li>

                        <li>
                            <a href="?page=<?= $page + 1 ?>"
                                class="material-icons px-2 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 <?= $page == $totalPages ? 'cursor-not-allowed opacity-50' : '' ?>"
                                <?= $page == $totalPages ? 'disabled' : '' ?>>chevron_right</a>
                        </li>
                        <li>
                            <a href="?page=<?= $totalPages ?>"
                                class="material-icons px-2 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 <?= $page == $totalPages ? 'cursor-not-allowed opacity-50' : '' ?>"
                                <?= $page == $totalPages ? 'disabled' : '' ?>>keyboard_double_arrow_right</a>
                        </li>
                    </ul>
                </nav>
            </div>

        </main>
    </div>
</body>

</html>

<?php
$conn->close();
?>