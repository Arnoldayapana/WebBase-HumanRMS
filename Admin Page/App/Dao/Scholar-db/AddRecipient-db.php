<?php
// Connection
include("../../../../Database/db.php");

// Initialize variables to avoid "root" issue in input field
$name = "";
$email = "";
$school = "";
$contact = "";
$branch = "";
$GradeLevel = "";
$branch = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $school = $_POST['school'];
    $contact = $_POST['contact'];
    $branch = $_POST['branch'];
    $GradeLevel = $_POST['GradeLevel'];

    // Check if email already exists
    $check_email = mysqli_query($connection, "SELECT * FROM employees WHERE email ='$email'");
    if (mysqli_num_rows($check_email) > 0) {
        $errorMessage = "The Email already exists!";
        header("Location: ../../View/recipients.php?error_msg=$errorMessage");
        exit;
    } else {
        do {
            if (empty($name) || empty($email) || empty($school) || empty($contact) || empty($GradeLevel) || empty($branch)) {
                $errorMessage = "All fields are required";
                header("Location: ../../View/recipients.php?error_msg=$errorMessage");
                break;
            }

            // Insert new employee into the database
            $sql = "INSERT INTO recipient (name, email, school, contact, GradeLevel , branch) 
                    VALUES ('$name','$email','$school','$contact','$GradeLevel' ,'$branch')";
            $result = $connection->query($sql);

            if (!$result) {
                $errorMessage = "Invalid query: " . $connection->error;
                header("Location: ../../View/recipients.php?error_msg=$errorMessage");
                break;
            }

            // Reset form values after successful submission
            $name = "";
            $email = "";
            $school = "";
            $contact = "";
            $branch = "";
            $GradeLevel = "";

            $successMessage = "New Employee added successfully!";
            // Redirect after successful form submission
            header("Location: ../../View/recipients.php?msg=$successMessage");
            exit;
        } while (false);
    }
}
