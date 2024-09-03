<?php
include './includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle Update Property Logic
    $id = $_POST['id'];  // Property ID
    $name = $_POST['name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $price = $_POST['price'];
    $image = $_FILES['image'] ?? null;

    if (!empty($id) && !empty($name) && !empty($description) && !empty($price) && !empty($location)) {
        // Handle file upload if there is a new image
        if ($image && $image['tmp_name']) {
            $imagePath = basename($image['name']);
            move_uploaded_file($image['tmp_name'], $imagePath);
            $imageSql = ", image = '$imagePath'";
        } else {
            $imageSql = '';
        }

        // Update property in the database
        $sql = "UPDATE properties SET name = ?, description = ?, location = ?, price = ?, $imageSql WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssdi', $name, $description, $location, $price, $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Property updated successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error updating property: ' . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}

$conn->close();
