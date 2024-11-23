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

$query = "SELECT * FROM em_plc_data ORDER BY id DESC LIMIT 1";
$result = $conn->query($query);
$data = $result->fetch_assoc();

$query_battery = "SELECT * FROM battery ORDER BY id DESC LIMIT 1";
$result_battery = $conn->query($query_battery);
$data_battery = $result_battery->fetch_assoc();

// Query to fetch data from lora_data
$query_lora = "SELECT * FROM lora_data ORDER BY id DESC LIMIT 1";
$result_lora = $conn->query($query_lora);
$data_lora = $result_lora->fetch_assoc();
?>