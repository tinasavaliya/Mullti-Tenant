<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once './includes/config.php'; // Ensure this file contains the database connection ($conn)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize input
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8') : null;
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;
    $role = isset($_POST['role']) ? htmlspecialchars(trim($_POST['role']), ENT_QUOTES, 'UTF-8') : null;

    // Check if the user already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE name = ? OR email = ?");
    if ($stmt) {
        $stmt->bind_param("ss", $name, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo json_encode(['status' => 'error', 'message' => 'User already exists']);
        } else {
            // Hash the password
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // Store user with hashed password
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("ssss", $name, $email, $passwordHash, $role);

                if ($stmt->execute()) {
                    // $_SESSION["userId"] = $conn->insert_id;
                    // $_SESSION["userId"] = 1;
                    $_SESSION["name"] = $name;
                    // $_SESSION["email"] = $email;
                    $_SESSION["role"] = $role;
                    session_regenerate_id(true);

                    echo json_encode(['status' => 'success', 'message' => 'Registration successful']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to register user: ' . $stmt->error]);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Database error']);
            }
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error']);
    }
    $stmt->close();
    $conn->close();
}




// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// session_start();
// require_once './includes/config.php'; // Ensure this file contains the database connection ($conn)

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Collect and sanitize input
//     $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8') : null;
//     $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : null;
//     $password = isset($_POST['password']) ? $_POST['password'] : null;
//     $role = isset($_POST['role']) ? htmlspecialchars(trim($_POST['role']), ENT_QUOTES, 'UTF-8') : null;

//     // Check if the user already exists
//     $stmt = $conn->prepare("SELECT * FROM users WHERE name = ? OR email = ?");
//     if ($stmt) {
//         $stmt->bind_param("ss", $name, $email);
//         $stmt->execute();
//         $stmt->store_result();

//         if ($stmt->num_rows > 0) {
//             echo json_encode(['status' => 'error', 'message' => 'User already exists']);
//         } else {
//             // Hash the password
//             $passwordHash = password_hash($password, PASSWORD_DEFAULT);

//             // Store user with hashed password
//             $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
//             if ($stmt) {
//                 $stmt->bind_param("ssss", $name, $email, $passwordHash, $role);

//                 if ($stmt->execute()) {
//                     $_SESSION["userId"] = $conn->insert_id;
//                     $_SESSION["name"] = $name;
//                     $_SESSION["email"] = $email;
//                     $_SESSION["role"] = $role;
//                     session_regenerate_id(true);

//                     echo json_encode(['status' => 'success', 'message' => 'Registration successful']);
//                 } else {
//                     echo json_encode(['status' => 'error', 'message' => 'Failed to register user: ' . $stmt->error]);
//                 }
//             } else {
//                 echo json_encode(['status' => 'error', 'message' => 'Database error']);
//             }
//         }
//     } else {
//         echo json_encode(['status' => 'error', 'message' => 'Database error']);
//     }
//     $stmt->close();
//     $conn->close();
// }
