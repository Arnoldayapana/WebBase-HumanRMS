<?php
// connection
include("../../../../Database/db.php");

$name = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize inputs
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';

    // Check if the department name already exists
    if (empty($name)) {
        $errorMessage = "All fields are required!";
        header("Location: ../../View/Department.php?error_msg=$errorMessage");
    } else {
        // Use a prepared statement to prevent SQL injection
        $stmt = $connection->prepare("SELECT * FROM departments WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            header("Location: ../../View/Department.php?error_msg='The Department name already exists!");
        } else {
            // Add new department to the database using a prepared statement
            $stmt = $connection->prepare("INSERT INTO departments (name) VALUES (?)");
            $stmt->bind_param("s", $name);
            $result = $stmt->execute();

            if (!$result) {
                $errorMessage = "Invalid query: " . $connection->error;
            } else {
                // Clear the form values and show success message
                $name = "";
                header("Location: ../../View/Department.php?msg=New Department created successfully!");
                exit;  // Ensure the script stops execution after redirect
            }
        }
        $stmt->close(); // Close the statement
    }
}
