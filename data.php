<?php

header('Content-Type: application/json');
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

echo json_encode([
    'volt1' => $data['volt1'],
    'volt2' => $data['volt2'],
    'volt3' => $data['volt3'],
    'arus1' => $data['arus1'],
    'arus2' => $data['arus2'],
    'arus3' => $data['arus3'],
    'kVAh' => $data['kVAh'],
    'kVA1' => $data['kVA1'],
    'kVA2' => $data['kVA2'],
    'kVA3' => $data['kVA3'],
    'netkW' => $data['netkW'],
    'neKkVA' => $data['netKVA'],
]);
?>