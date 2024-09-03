<?php
include('./includes/config.php');

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

// Check if email and password are provided
if (isset($input['email']) && isset($input['password'])) {
    $email = $input['email'];
    $password = $input['password'];

    // Query to check user credentials
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    error_log("current user: " . print_r($user, true));

    if ($user) {
        if (password_verify($password, $user['password'])) {
            // Store user data in session
            $_SESSION['email'] = $email;
            $_SESSION["userId"] = $user['userId'];
            $_SESSION["name"] = $user['name'];
            $_SESSION["role"] = $user['role'];

            session_regenerate_id(true); // Secure the session

            echo json_encode(['status' => 'success', 'message' => 'Login successful']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid password']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid email']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Email and password are required']);
}

error_log("Session data after login: " . print_r($_SESSION, true));

$conn->close();
