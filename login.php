<?php
session_start();
include './config.php';
$eData = file_get_contents("php://input");
$dData = json_decode($eData, true);

$user = $dData['user'] ?? '';
$password = $dData['password'] ?? '';
$result = "";


if ($user != "" && $password != "") {
    $sql = "SELECT * FROM users WHERE user = '$user'";
    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        if ($password != $row['password']) {
            $result = "Invalid password";
        } else {
            // $_SESSION["id"] = $conn->insert_id;
            $_SESSION["name"] = $row['name'];
            // $_SESSION["user_role"] = $role;

            $result = "Login successfully!! Redirecting...";
            // echo json_encode(['success' => true, 'name' => $_SESSION['name']]);
        }
    } else {
        $result = "Invalid user or password";
    }
} else {
    $result = "Enter user and password";
}
$conn->close();
$response = array("result" => $result);
echo json_encode($response);



// include('./includes/config.php');

// // Start session if not already started
// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }

// // Get JSON input
// $input = json_decode(file_get_contents('php://input'), true);

// // Check if email and password are provided
// if (isset($input['email']) && isset($input['password'])) {
//     $email = $input['email'];
//     $password = $input['password'];

//     // Query to check user credentials
//     $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
//     $stmt->bind_param("s", $email);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     $user = $result->fetch_assoc();

//     error_log("current user: " . print_r($user, true));

//     if ($user) {
//         if (password_verify($password, $user['password'])) {
//             // Store user data in session
//             $_SESSION['email'] = $email;
//             $_SESSION["id"] = $user['userId'];
//             $_SESSION["name"] = $user['name'];
//             $_SESSION["role"] = $user['role'];

//             session_regenerate_id(true); // Secure the session

//             echo json_encode(['status' => 'success', 'message' => 'Login successful']);
//         } else {
//             echo json_encode(['status' => 'error', 'message' => 'Invalid password']);
//         }
//     } else {
//         echo json_encode(['status' => 'error', 'message' => 'Invalid email']);
//     }
// } else {
//     echo json_encode(['status' => 'error', 'message' => 'Email and password are required']);
// }

// error_log("Session data after login: " . print_r($_SESSION, true));

// $conn->close();
