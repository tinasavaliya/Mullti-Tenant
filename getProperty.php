<?php
include './includes/config.php';

$qry = mysqli_query($conn, "SELECT * FROM propertytypes ORDER BY name ASC");
$classes = [];

if (mysqli_num_rows($qry) > 0) {
    while ($rows = mysqli_fetch_assoc($qry)) {
        $properties[] = [
            'id' => $rows['id'],
            'name' => $rows['name']
        ];
    }
}

echo json_encode(['success' => true, 'data' => $properties]);
$conn->close();
