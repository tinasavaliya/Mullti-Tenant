<?php
include './includes/config.php';

$id = $_GET['id'];

// Prepare the SQL statement
$stmt = $conn->prepare("SELECT * FROM properties WHERE id = ?");
if ($stmt) {
    // Bind the parameters
    $stmt->bind_param("i", $id); // "i" denotes the type of the variable (integer in this case)

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the first (and only) row
        $row = $result->fetch_assoc();

        // Convert the row to JSON
        echo json_encode($row);
    } else {
        // No record found, return an empty JSON object
        echo json_encode(null);
    }

    // Close the statement
    $stmt->close();
} else {
    // If the statement failed to prepare, return an error message
    echo json_encode(['status' => 'error', 'message' => 'Failed to prepare the SQL statement']);
}

// Close the connection
$conn->close();
