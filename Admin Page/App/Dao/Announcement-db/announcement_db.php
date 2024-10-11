<?php
// Database connection
include("../../../../Database/db.php");

// Initialize variables to avoid undefined variable issues in input field
$content = "";
$title = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize the user input to avoid XSS attacks
    $content = htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8');
    $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');

    // Validate form fields
    if (!empty($content) && !empty($title)) { // Changed || to &&
        // Prepare SQL query with prepared statements to avoid SQL injection
        $stmt = $connection->prepare("INSERT INTO announcement (content, title) VALUES (?, ?)"); // Fixed the SQL syntax

        if ($stmt) {
            // Bind the parameters
            $stmt->bind_param("ss", $content, $title);

            // Execute the statement
            if ($stmt->execute()) {
                // Redirect after successful form submission
                header("Location: ../../View/AdminDashboard.php?msg=New Post Added Successfully!");
                exit;
            } else {
                // Handle execution error (optional)
                echo "Error executing query: " . $stmt->error;
            }
            // Close the prepared statement
            $stmt->close();
        } else {
            // Handle preparation error (optional)
            echo "Error preparing statement: " . $connection->error;
        }
    } else {
        // Handle validation error (optional)
        echo "Both fields are required.";
    }
}

// Close the database connection
$connection->close();
