<?php
$title = 'Job Applicant | SEDP HRMS';
$page = 'Job Applicant';

include("../../Database/db.php");

// Check database connection
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Initialize variables
$name = $email = $contact = $message = $job_id = "";

// Form handling logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
    $check_email = mysqli_query($connection, "SELECT * FROM applicants WHERE email ='$email'");
    if (mysqli_num_rows($check_email) > 0) {
        header("Location: ../Jobpage.php?error_msg=The email you entered already exists. Please use a different email.");
        exit;
    }

    // Validate form fields
    if (empty($name) || empty($email) || empty($contact) || empty($message) || empty($job_id)) {
        header("Location: ../Jobpage.php?error_msg=All fields are required.");
        exit;
    }

    // Check if file is uploaded
    if ($resume['error'] !== UPLOAD_ERR_OK) {
        header("Location: ../Jobpage.php.php?error_msg=File upload error.");
        exit;
    }

    // File type and size validation
    if (!in_array($resume['type'], $allowedTypes)) {
        header("Location: ../Jobpage.php?error_msg=Invalid file format. Only PDF, DOC, and DOCX are allowed.");
        exit;
    }

    if ($resume['size'] > $maxFileSize) {
        header("Location: ../Jobpage.php.php?error_msg=File size too large. Maximum allowed size is 2MB.");
        exit;
    }

    // File upload handling
    $uploadDir = "../../../uploads/resumes/";
    $fileName = time() . "_" . basename($resume['name']);
    $uploadFilePath = $uploadDir . $fileName;

    // Ensure the uploads directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Move uploaded file to the specified directory
    if (move_uploaded_file($resume['tmp_name'], $uploadFilePath)) {
        // Prepare SQL query with prepared statements
        $stmt = $connection->prepare("INSERT INTO applicants (name, email, contact, message, resume, job_id) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Error preparing statement: " . $connection->error);
        }

        // Bind the parameters
        $stmt->bind_param("sssssi", $name, $email, $contact, $message, $fileName, $job_id); // Adjust data types if necessary

        // Execute the statement
        if (!$stmt->execute()) {
            die("Error executing statement: " . $stmt->error);
        }

        // Reset form values after successful submission
        $name = $email = $contact = $message = "";

        // Redirect after successful form submission
        header("Location: ../ApplicantStatus.php?msg=Application Submitted Successfully");
        exit;
    } else {
        header("Location: ../ApplicantStatus.php?error_msg=File upload error.");
        exit;
    }
}
