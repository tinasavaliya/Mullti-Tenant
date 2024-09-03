<?php

session_start();

// Check if user data is stored in the session
if (isset($_SESSION['email'])) {
    // User data found, return user details
    echo json_encode([
        'status' => 'success',
        'data' => [
            'email' => $_SESSION['email'],
            'userId' => $_SESSION['userId'],
            'name' => $_SESSION['name'],
            'role' => $_SESSION['role']
        ]
    ]);
} else {
    // No user data found
    echo json_encode([
        'status' => 'error',
        'message' => 'No user is currently logged in.'
    ]);
}
?>

// require_once './includes/config.php';

// // Start the session if it's not already started
// if (!session_id()) {
// session_start();
// }

// // Check if the session variable 'admin_name' is set
// if (isset($_SESSION['name'])) {
// $response = [
// 'success' => true,
// 'name' => $_SESSION['name']
// ];
// } else {
// $response = [
// 'success' => false,
// 'message' => 'user not logged in'
// ];
// }

// // Return the response as JSON
// echo json_encode($response);