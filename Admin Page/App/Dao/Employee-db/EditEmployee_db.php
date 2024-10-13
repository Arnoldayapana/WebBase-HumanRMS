<?php
// Connection
include("../../../../Database/db.php");

// Initialize variables
$employee_id = "";
$username = "";
$email = "";
$department = "";
$branch = "";
$ContactNumber = "";
$password = "";

// Handle GET request to load employee data
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["employee_id"])) {
        header("Location: ../../View/Employee.php?error_msg=Missing Employee ID. Please provide a valid ID to view or modify employee details.");
        exit;
    }

    $employee_id = $_GET["employee_id"];

    // Read the row of the selected employee
    $sql = "SELECT * FROM `employees` WHERE employee_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $employee_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: ../../View/Employee.php?error_msg=No employee found with the provided ID. Please check the ID and try again.");
        exit;
    }

    // Assign the employee data to variables
    $username = $row["username"];
    $email = $row["email"];
    $department = $row["department"];
    $branch = $row["branch"];
    $ContactNumber = $row["ContactNumber"];
    $password = $row["password"];
}

// Handle POST request to update employee data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_id = $_POST['employee_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $branch = $_POST['branch'];
    $ContactNumber = $_POST['ContactNumber'];
    $password = $_POST['password'];

    // Check for empty required fields
    if (empty($employee_id) || empty($username) || empty($email) || empty($department) || empty($branch) || empty($ContactNumber) || empty($password)) {
        $errorMessage = "All fields are required. Please fill out the form completely.";
        header("Location: ../../View/Employee.php?error_msg=$errorMessage");
        exit;
    }

    // SQL query to update employee data
    $stmt = $connection->prepare("UPDATE employees SET username = ?, email = ?, department = ?, branch = ?, ContactNumber = ?, password = ? WHERE employee_id = ?");
    $stmt->bind_param("ssssssi", $username, $email, $department, $branch, $ContactNumber, $password, $employee_id);

    // Execute query and check for errors
    if ($stmt->execute()) {
        $successMessage = "Employee data updated successfully!";
        header("Location: ../../View/Employee.php?msg=$successMessage");
        exit;
    } else {
        $errorMessage = "Error updating employee: " . $stmt->error;
        header("Location: ../../View/Employee.php?error_msg=$errorMessage");
        exit;
    }
}
