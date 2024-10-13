<?php
header("Content-Type: application/json");
include '../Database/api_db.php';

// Check if $pdo is set
if (!$pdo) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

// Fetch HTTP request method (GET, POST, PUT, DELETE)
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['employee_id'])) {
            $id = intval($_GET['employee_id']); // Use 'employee_id' here
            $stmt = $pdo->prepare("SELECT * FROM employees WHERE employee_id = ?");
            $stmt->execute([$id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // User found, return the user data with a 200 OK status
                http_response_code(200); // Optional, 200 is the default for successful responses
                echo json_encode($user);
            } else {
                // User not found, return a 404 Not Found status
                http_response_code(404);
                echo json_encode([
                    'status' => 404,
                    'message' => 'User not found',
                    'data' => null
                ]);
            }
        } else {
            // No specific user ID provided, return all users
            $stmt = $pdo->query("SELECT * FROM employees");
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            http_response_code(200); // Return all users with a 200 OK status
            echo json_encode($users);
        }
        break;


    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        $stmt = $pdo->prepare("INSERT INTO employees (username, email, ContactNumber,department, branch, password) VALUES (?, ?, ?, ?, ?, ?)");
        $result = $stmt->execute([$data->username, $data->email, $data->ContactNumber, $data->branch, $data->department, $data->password]);

        if ($result) {
            http_response_code(201); // Created
            echo json_encode(["success" => true, "message" => "User created successfully"]);
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(["success" => false, "message" => "Failed to create user"]);
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"));
        $stmt = $pdo->prepare("UPDATE employees SET username = ?, email = ?, ContactNumber = ?, department = ?, branch = ?, password = ? WHERE id = ?");
        $result = $stmt->execute([$data->username, $data->email, $data->ContactNumber, $data->branch, $data->department, $data->password, $data->id]);

        if ($result) {
            http_response_code(200); // OK
            echo json_encode(["success" => true, "message" => "User updated successfully"]);
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(["success" => false, "message" => "Failed to update user"]);
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $stmt = $pdo->prepare("DELETE FROM employees WHERE id = ?");
            $result = $stmt->execute([$id]);

            if ($result) {
                http_response_code(200); // OK
                echo json_encode(["success" => true, "message" => "User deleted successfully"]);
            } else {
                http_response_code(404); // Not Found
                echo json_encode(["success" => false, "message" => "User not found"]);
            }
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(["success" => false, "message" => "ID is required for deletion"]);
        }
        break;

    default:
        http_response_code(405); // Method Not Allowed
        echo json_encode([
            'status' => 405,
            'message' => 'Method Not Allowed',
            'data' => null
        ]);
        break;
}
