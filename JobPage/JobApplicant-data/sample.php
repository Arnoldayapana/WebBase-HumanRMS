<?php
// Connection
include("../../Database/db.php");

// Initialize variables
$name = "";
$email = "";
$contact = "";
$message = "";
$job_id = "";

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form inputs
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $message = $_POST['message'];
    $job_id = $_POST['job_id'];


    // File upload validation
    $resume = $_FILES['resume'];
    $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    $maxFileSize = 2 * 1024 * 1024; // 2MB

    // Check if email already exists
    $check_email = mysqli_query($connection, "SELECT * FROM applicants WHERE email = '$email'");
    if (mysqli_num_rows($check_email) > 0) {
        header("Location: ../Jobpage.php?error_msg=The email you entered already exists. Please use a different email.");
        exit;
    } else {
        // Validation of form fields and file upload
        if (empty($name) || empty($email) || empty($contact) || empty($message) || empty($job_id)) {
            header("Location: ../Jobpage.php?error_msg=All fields are required.");
            exit;
        }

        // Check if file is uploaded
        if ($resume['error'] !== UPLOAD_ERR_OK) {
            header("Location: ../Jobpage.php?error_msg=File upload error.");
            exit;
        }

        // File type and size validation
        if (!in_array($resume['type'], $allowedTypes)) {
            header("Location: ../Jobpage.php?error_msg=Invalid file format. Only PDF, DOC, and DOCX are allowed.");
            exit;
        }

        if ($resume['size'] > $maxFileSize) {
            header("Location: ../Jobpage.php?error_msg=File size too large. Maximum allowed size is 2MB.");
            exit;
        }

        // File upload handling (move the file to the uploads directory)
        $uploadDir = "../../../uploads/resumes/";
        echo realpath($uploadDir); // To see the absolute path

        $fileName = time() . "_" . basename($resume['name']);
        $uploadFilePath = $uploadDir . $fileName;

        // Ensure the uploads directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Create the directory if it doesn't exist
        }

        // Move uploaded file to the specified directory
        if (move_uploaded_file($resume['tmp_name'], $uploadFilePath)) {
            // Log the file name before inserting it into the database
            error_log("File Name: " . $fileName);

            // Prepare SQL query with prepared statements to avoid SQL injection
            $stmt = $connection->prepare("INSERT INTO applicants (name, email, contact, message, resume, job_id) VALUES (?, ?, ?, ?, ?, ?)");
            if (!$stmt) {
                error_log("Statement preparation failed: " . $connection->error);
                exit;
            }

            // Bind parameters
            $stmt->bind_param("sssssi", $name, $email, $contact, $message, $fileName, $job_id);

            // Execute the query
            if ($stmt->execute()) {
                // Reset form values after successful submission
                $name = "";
                $email = "";
                $contact = "";
                $message = "";
                $job_id = "";

                // Redirect after successful form submission
                header("Location: ../ApplicantStatus.php");
                exit;
            } else {
                error_log("Query execution failed: " . $stmt->error);
                header("Location: ../ApplicantStatus.php");
                exit;
            }
        } else {
            error_log("Failed to move uploaded file.");
            header("Location: ../ApplicantStatus.php");
            exit;
        }
    }
}
