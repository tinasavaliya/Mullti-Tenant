<?php
  include './config.php';
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: GET, POST");
// header("Access-Control-Allow-Headers: Content-Type");

// $conn = new mysqli("localhost", "root", "", "react-crud");

$sql = mysqli_query($conn, "select * from users");
$json_data = array();

while ($res = mysqli_fetch_assoc($sql)) {
    $json_data = $res;
}
// echo $json_data;

// echo console.log(json_data);
echo json_encode(['phpresult' => $json_data]);
