<?php
include('./includes/config.php');

// Retrieve the search query from the request
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// SQL query to search properties by name
$sql = "SELECT * FROM properties";
if (!empty($search)) {
    $sql .= " WHERE name LIKE '%$search%' OR location LIKE '%$search%' OR description LIKE '%$search%'";
}

$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    $data = ['message' => 'No records found'];
}

echo json_encode($data);
$conn->close();
