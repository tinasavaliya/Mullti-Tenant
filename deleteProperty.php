<?php
include './includes/config.php';

// Check if 'id' is provided in the request
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare SQL to delete the property by its ID
    $sql = "DELETE FROM properties WHERE id = ?";

    // Initialize prepared statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        // If delete is successful
        echo json_encode(['success' => true, 'message' => 'Property deleted successfully.']);
    } else {
        // If there is an error during deletion
        echo json_encode(['success' => false, 'message' => 'Error deleting property: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    // If 'id' is not provided in the request
    echo json_encode(['success' => false, 'message' => 'Property ID is required.']);
}

$conn->close();
