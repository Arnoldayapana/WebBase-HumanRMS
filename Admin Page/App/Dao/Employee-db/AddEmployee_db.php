<?php
// Connection
include("../../../../Database/db.php");

// Initialize variables to avoid "root" issue in input field
$username = "";
$email = "";
$ContactNumber = "";
$department = "";
$branch = "";
$password = "";
$confirm_password = "";
$usertype = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $ContactNumber = $_POST['ContactNumber'];
    $department = $_POST['department'];
    $branch = $_POST['branch'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $usertype = $_POST['usertype'];

    // Check if email already exists
    $check_email = mysqli_query($connection, "SELECT * FROM employees WHERE email ='$email'");
    if (mysqli_num_rows($check_email) > 0) {
        header("Location: ../../View/Employee.php?error_msg=The email you entered already exists. Please use a different email.");
        exit;
    } else {
        // Validation of form fields
        if (empty($username) || empty($email) || empty($ContactNumber) || empty($department) || empty($branch) || empty($password) || empty($confirm_password)) {
        } elseif ($password != $confirm_password) {
            header("Location: ../../View/Employee.php?error_msg=Passwords do not match. Please ensure both password fields are identical.");
            exit;
        } else {
            // Prepare SQL query with prepared statements to avoid SQL injection
            $stmt = $connection->prepare("INSERT INTO employees (username, email, ContactNumber, department, branch, password,usertype) VALUES (?, ?, ?, ?, ?,?,?)");
            $stmt->bind_param("sssssss", $username, $email, $ContactNumber, $department, $branch, $password, $usertype);

            if ($stmt->execute()) {
                // Reset form values after successful submission
                $username = "";
                $email = "";
                $ContactNumber = "";
                $department = "";
                $branch = "";
                $password = "";
                $confirm_password = "";

                // Redirect after successful form submission
                header("Location: ../../View/Employee.php?msg=New Employee Added Successfully");
                exit;
            } else {
                $errorMessage = "Invalid query: " . $connection->error;
            }
        }
    }
}
