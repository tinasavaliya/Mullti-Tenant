<?php
include('./includes/config.php');

// Retrieve the search query from the request


// SQL query to search properties by name
$sql = "SELECT * FROM propertytypes";


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
