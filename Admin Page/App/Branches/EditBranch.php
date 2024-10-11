<?php
// Connections
include("../../../Database/db.php");

$branch_id = "";
$name = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["branch_id"])) {
        header("location:../View/Branch.php");
        exit;
    }

    $branch_id = $_GET["branch_id"];

    // Read the row of the selected data
    $sql = "SELECT * FROM `branches` WHERE branch_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $branch_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location:../View/Branch.php");
        exit;
    }

    $name = $row["name"];
} else {
    // Update the data for the branch
    $branch_id = $_POST['branch_id'];
    $name = $_POST['name'];

    // Validation
    if (empty($branch_id) || empty($name)) {
        $errorMessage = "All fields are required.";
    } else {
        // Check if the branch name already exists (excluding the current branch being updated)
        $checkSql = "SELECT * FROM `branches` WHERE name = ? AND branch_id != ?";
        $stmt = $connection->prepare($checkSql);
        $stmt->bind_param("si", $name, $branch_id);
        $stmt->execute();
        $checkResult = $stmt->get_result();

        if ($checkResult->num_rows > 0) {
            header("location:../View/Branch.php?error_msg=The branch name already exists!");
            exit;
        } else {
            // Update branch data
            $sql = "UPDATE branches SET name = ? WHERE branch_id = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("si", $name, $branch_id);
            $result = $stmt->execute();

            if (!$result) {
                $errorMessage = "Invalid query: " . $connection->error;
            } else {
                header("location:../View/Branch.php?msg=The branch name already exists!");
                exit;
            }
        }
    }
}
