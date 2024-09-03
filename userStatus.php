<?php
// Include the database configuration file

// use_current.php
session_start();
header('Content-Type: application/json'); // Ensure the content type is JSON

// Check if the user is logged in
if (isset($_SESSION['name'])) {
    // Send the username back as a JSON response
    echo json_encode(['name' => $_SESSION['name']]);
} else {
    // Send an empty response or an error message if not logged in
    echo json_encode(['error' => 'User not logged in']);
}

// require_once './includes/config.php';
// // current_user.php
// session_start();

// // Check if the user is logged in
// if (isset($_SESSION['name'])) {
// // Send the username back as a JSON response
// echo json_encode(['name' => $_SESSION['name']]);
// } else {
// // Send an empty response or an error message if not logged in
// echo json_encode(['error' => 'User not logged in']);
// }