<?php
// Connections
include("../../../../Database/db.php");
$job_id = "";
$title = "";
$JobDescription = "";
$qualification = "";
$branch = "";
$min_salary = "";
$max_salary = "";
$EmployeeType = "";


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["job_id"])) {
        header("location:../../View/ReqcruitmentPage.php");
        exit;
    }

    $job_id = $_GET["job_id"];

    //read the row of the selected data
    $sql = "SELECT * FROM `jobs` WHERE job_id = $job_id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location:../../View/ReqcruitmentPage.php");
        exit;
    }

    $title = $row["title"];
    $JobDescription = $row["JobDescription"];
    $qualification = $row["qualification"];
    $branch = $row["branch"];
    $min_salary = $row["min_salary"];
    $max_salary = $row["max_salary"];
    $EmployeeType = $row["EmployeeType"];
} else {
    //Update the data go the job
    $job_id = $_POST['job_id'];
    $title = $_POST['title'];
    $JobDescription = $_POST['JobDescription'];
    $qualification = $_POST['qualification'];
    $branch = $_POST['branch'];
    $min_salary = $_POST['min_salary'];
    $max_salary = $_POST['max_salary'];
    $EmployeeType = $_POST['EmployeeType'];

    do {
        if (empty($job_id) || empty($title) || empty($JobDescription) || empty($qualification) || empty($branch) || empty($min_salary) || empty($max_salary) || empty($EmployeeType)) {
            $errorMessage = "all the field are required";
            break;
        }
        $sql = "UPDATE job SET title = '$title', JobDescription = '$JobDescription', qualification = '$qualification', branch = '$branch', min_salary = '$min_salary', max_salary = '$max_salary', EmployeeType = '$EmployeeType'" .
            "WHERE job_id = $job_id";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "job Updated Succefuly!";

        header("location:../../View/ReqcruitmentPage.php?msg=$successMessage");
        exit;
    } while (false);
}
