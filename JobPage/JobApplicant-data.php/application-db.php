<?php
// Connection
include("../../Database/db.php");

// Initialize variables to avoid "root" issue in input field
$name = "";
$email = "";
$contact = "";
$message = "";
$job_id = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $message = $_POST['message'];
    $job_id = $_POST['job_id']; // Capture the job_id from the form

    // Check if email already exists
    $check_email = mysqli_query($connection, "SELECT * FROM applicants WHERE email ='$email'");
    if (mysqli_num_rows($check_email) > 0) {
        header("Location: ../Jobpage.php?error_msg=The email you entered already exists. Please use a different email.");
        exit;
    } else {
        // Validation of form fields
        if (empty($name) || empty($email) || empty($contact) || empty($message) || empty($job_id)) {
            header("Location: ../Jobpage.php?error_msg=All fields are required.");
            exit;
        } else {
            // Prepare SQL query with prepared statements to avoid SQL injection
            $stmt = $connection->prepare("INSERT INTO applicants (name, email, contact, message, job_id) VALUES ( ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssi", $name, $email, $contact, $message, $job_id);

            if ($stmt->execute()) {
                // Reset form values after successful submission
                $name = "";
                $email = "";
                $contact = "";
                $message = "";

                // Redirect after successful form submission
                header("Location: ../ApplicantStatus.php?msg=Application Submitted Successfully");
                exit;
            } else {
                $errorMessage = "Invalid query: " . $connection->error;
                echo $errorMessage;
            }
        }
    }
}
