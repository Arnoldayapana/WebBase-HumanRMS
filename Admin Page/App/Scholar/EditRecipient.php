<?php
// Connection
include("../../../Database/db.php");

$recipient_id = "";
$name = "";
$email = "";
$school = "";
$contact = "";
$branch = "";
$GradeLevel = "";


$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["recipient_id"])) {
        header("location:../View/recipients.php");
        exit;
    }

    $recipient_id = $_GET["recipient_id"];

    //read the row of the selected datas
    $sql = "SELECT * FROM `recipient` WHERE recipient_id = $recipient_id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location:../View/recipient.php");
        exit;
    }

    $name = $row["name"];
    $email = $row["email"];
    $school = $row["school"];
    $contact = $row["contact"];
    $branch = $row["branch"];
    $GradeLevel = $row["GradeLevel"];
} else {
    //Update the data go the recipient
    $recipient_id = $_POST['recipient_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $school = $_POST['school'];
    $contact = $_POST['contact'];
    $branch = $_POST['branch'];
    $GradeLevel = $_POST['GradeLevel'];

    do {
        if (empty($recipient_id) || empty($name) || empty($email) || empty($school) || empty($contact) || empty($GradeLevel) || empty($branch)) {
            $errorMessage = "all the field are required";
            header("location:../View/recipients.php?error_msg=$errorMessage");
            break;
        }
        $sql = "UPDATE recipient SET name = '$name', email = '$email', school = '$school', contact = '$contact', GradeLevel = '$GradeLevel' , branch = '$branch'" .
            "WHERE recipient_id = $recipient_id";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            header("location:../View/recipients.php?error_msg=$errorMessage");
            break;
        }

        $successMessage = "recipient Updated Succefuly!";
        header("location:../View/recipients.php?msg=$successMessage");
        exit;
    } while (false);
}
