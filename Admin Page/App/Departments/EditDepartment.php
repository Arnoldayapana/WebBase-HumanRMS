<?php
// Connection
include("../../../Database/db.php");

// Initialize variables
$department_id = "";
$name = "";

// Check if request is GET or POST
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["department_id"])) {
        header("location:../View/Department.php?error_msg=Unknown department_id");
        exit;
    }

    // Get the department_id from URL and validate
    $department_id = intval($_GET["department_id"]);

    // Prepare and execute the query to read the selected data using prepared statement
    $stmt = $connection->prepare("SELECT * FROM departments WHERE department_id = ?");
    $stmt->bind_param("i", $department_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location:../View/Department.php?error_msg=Department not found");
        exit;
    }

    // Populate the form with existing data
    $name = htmlspecialchars($row["name"]); // Use htmlspecialchars to prevent XSS
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle POST request (update the data)
    $department_id = intval($_POST['department_id']);
    $name = trim($_POST['name']); // Remove whitespace

    // Error message handling
    $errorMessage = "";

    // Validate that both fields are not empty
    if (empty($department_id) || empty($name)) {
        $errorMessage = "Department ID and Name cannot be empty";
    } else {
        // Check for duplicate department name (case-insensitive)
        $stmt = $connection->prepare("SELECT * FROM departments WHERE LOWER(name) = LOWER(?) AND department_id != ?");
        $stmt->bind_param("si", $name, $department_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errorMessage = "Department name already exists.";
        } else {
            // Prepare the SQL query for updating the department name
            $stmt = $connection->prepare("UPDATE departments SET name = ? WHERE department_id = ?");
            $stmt->bind_param("si", $name, $department_id);
            $success = $stmt->execute();

            if (!$success) {
                $errorMessage = "Failed to update department: " . $stmt->error;
            } else {
                // Successful update
                header("location:../View/Department.php?msg=Department updated successfully!");
                exit;
            }
        }
    }

    // If there's an error, redirect back with an error message
    if (!empty($errorMessage)) {
        header("location:../View/Department.php?error_msg=" . urlencode($errorMessage));
        exit;
    }
}
