<?php
header('Access-Control-Allow-Origin: http://localhost:3000'); // Replace with your React app's URL
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

include('./includes/config.php');

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();

    // Check if user is logged in by verifying the session
    if (isset($_SESSION['email'])) {
        // Return user data from session
        echo json_encode([
            'status' => 'success',
            'user' => [
                'userId' => $_SESSION['userId'],
                'name' => $_SESSION['name'],
                'email' => $_SESSION['email'],
                'role' => $_SESSION['role']
            ]
        ]);
    } else {
        // User is not logged in
        echo json_encode(['status' => 'error', 'message' => 'No user is currently logged in.']);
    }
}
