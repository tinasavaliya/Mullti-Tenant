<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
$conn = new mysqli("localhost", "root", "", "react-crud");

if ($conn->connect_error) {
    $response = array("result" => "Database connection error");
    echo json_encode($response);
    exit();
}
