<?php
session_start();
require_once './includes/config.php'; // Ensure this file contains the database connection ($conn)

// Function to sanitize user input
function sanitizeInput($data)
{
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : null;
    $description = isset($_POST['description']) ? sanitizeInput($_POST['description']) : null;
    $price = isset($_POST['price']) ? sanitizeInput($_POST['price']) : null;
    $location = isset($_POST['location']) ? sanitizeInput($_POST['location']) : null;
    $image = $_FILES['image'] ?? null;

    // Check for required fields
    if (!$name || !$description || !$price || !$location) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }

    // Check if the property already exists
    $stmt = $conn->prepare("SELECT id FROM properties WHERE name = ? OR description = ?");
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param("ss", $name, $description);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Property already exists.']);
        $stmt->close();
        exit;
    }

    // Handle image upload if provided
    $imagePath = null;
    if ($image && $image['tmp_name']) {
        $imagePath = basename($image['name']);
        if (!move_uploaded_file($image['tmp_name'], $imagePath)) {
            echo json_encode(['status' => 'error', 'message' => 'Failed to upload image.']);
            $stmt->close();
            exit;
        }
    }

    // Insert new property into the database
    $stmt = $conn->prepare("INSERT INTO properties (name, description, price, location, image) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param("sssss", $name, $description, $price, $location, $imagePath);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Property added successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add property: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
