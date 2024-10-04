<?php
if (isset($_POST["applicant_id"])) {
    $applicant_id = $_POST["applicant_id"];

    // Include database connection
    include("../../../../Database/db.php");

    // Step 1: Delete the record
    $sql_delete = "DELETE FROM applicants WHERE applicant_id = $applicant_id";
    if ($connection->query($sql_delete) === TRUE) {

        // Step 2: Renumber remaining records
        $sql_reorder = "SET @new_id = 0";
        $connection->query($sql_reorder);

        $sql_update_ids = "UPDATE applicants SET applicant_id = (@new_id := @new_id + 1) ORDER BY applicant_id";
        $connection->query($sql_update_ids);

        // Step 3: Reset AUTO_INCREMENT
        $sql_reset_ai = "ALTER TABLE applicants AUTO_INCREMENT = 1";
        $connection->query($sql_reset_ai);

        // Redirect with success message
        $successMessage = "Applicant data deleted successfully!";
        header("location:../../View/JobApplicants.php?msg=" . urlencode($successMessage));
    } else {
        // Handle deletion error
        $errorMessage = "Error deleting applicant data: " . $connection->error;
        header("location:../../View/JobApplicants.php?msg=" . urlencode($errorMessage));
    }
    exit;
}
