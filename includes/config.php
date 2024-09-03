<?php
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header('Access-Control-Allow-Credentials: true');
header("Content-Type: application/json");

// header('Access-Control-Allow-Origin: http://localhost:3000'); // Replace with your React app's URL
// header('Access-Control-Allow-Credentials: true');
// header('Content-Type: application/json');
// Database configuration
// $host = 'localhost';
// $db = 'tennancyhub';
// $user = 'root';
// $password = '';

// Create a new PDO instance
// try {
//     $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     echo json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $e->getMessage()]);
//     exit();
// }
$conn = new mysqli("localhost", "root", "", "tennancyhub");

if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}
