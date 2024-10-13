<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Landing Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../public/assets/css/employee/emInfo.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./Assets/Images/SEDPfavicon.png" type="image/x-icon">
    <style>
        body {
            background-color: #f0f0f0;
            font-family: 'Poppins', sans-serif;
        }

        .qualifications-header {
            padding: 15px;
            font-weight: bold;
            text-align: left;
            width: 250px;
            border-radius: 12px;
        }

        .qualification-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .qualification-item i {
            color: #28a745;
            font-size: 1.5rem;
            margin-right: 10px;
            margin-left: 10px;
            padding: 2px;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-gradient bg-opacity-75 fixed-top" style="background-color: #003c3c; ">
        <div class="container d-flex mb-1">
            <a class="navbar-brand text-white align-text-center fw-bolder fs-5" href="../login.php">
                SEDP Simbag Sa Pag-Asenso Inc.
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="container bg-light my-3 shadow rounded mt-5">
        <div class="row">
            <nav aria-label="breadcrumb" class="my-2 mt-4 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../login.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Job LandingPage</li>
                </ol>
                <div class="ms-auto m-2">
                    <a href="./Form/SEDP-Employee Form.docx" class="btn text-white fw-500" style="background-color: #003c3c;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom">Download File</a>
                </div>

            </nav>
            <div class="text-center pt-2">
                <img src="../Assets/Images/job-poster.png" alt="Hiring Image" class="img-fluid rounded shadow my-4" style="height: auto; width: 800px;">
                <p class="lead text-muted p-2 m-2 my-3 mx-5">
                    At <span class="fs-4 fw-bold">SEDP Simbag Sa Pag-Asenso Inc</span>, we foster talent, embrace innovation, and drive success.
                    Join us today and be part of a company that values and invests in your future.
                </p>
            </div>
        </div>
    </div>
    <div class="container bg-light my-3 shadow rounded mt-5">
        <div class="row">
            <div class="col-md-12 m-4">
                <div class="qualifications-header">
                    <h4 class="fw-bold">QUALIFICATIONS:</h4>
                </div>
                <div class="row qualifications-container">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <div class="qualification-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span class="text-dark fs-5 fw-bold">Undergraduate/graduate of any business-related courses</span>
                        </div>
                        <div class="qualification-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span class="text-dark fs-5 fw-bold">Physically fit to do field work</span>
                        </div>
                        <div class="qualification-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span class="text-dark fs-5 fw-bold">Willing to be assigned in any SEDP area of Operations</span>
                        </div>
                        <div class="qualification-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span class="text-dark fs-5">Work experience as an Account Officer is an advantage</span>
                        </div>
                        <div class="qualification-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span class="text-dark fs-5">Computer literate</span>
                        </div>
                    </div>
                    <!-- Right Column -->
                    <div class="col-md-6">
                        <div class="qualification-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span class="text-dark fs-5">Good communication skills</span>
                        </div>
                        <div class="qualification-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span class="text-dark fs-5">Driving skills with driver's license is an advantage</span>
                        </div>
                        <div class="qualification-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span class="text-dark fs-5">Has positive work attitude, adaptable, and able to work well under pressure</span>
                        </div>
                        <div class="qualification-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span class="text-dark fs-5">Preferably from Camarines Sur, Sorsogon, and Masbate</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section>
        <div class="container mb-5 mt-5 bg-light p-3">
            <div class="row">
                <h1 class="text-center fw-bold fs-3 my-5">Our Company is Currently Looking for the Following:</h1>
            </div>
            <div class="row align-items-center justify-content-center">
                <?php
                // Database Connection
                include("../Database/db.php");

                // Read job postings from the database
                $sql = "SELECT * FROM job LIMIT 6";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid Query: " . $connection->error);
                }

                // Display job postings
                while ($row = $result->fetch_assoc()) {
                    $ViewJobId = "viewApplicantModal" . $row['job_id'];
                    echo "
                    <div class='col-lg-5 mx-2 mb-3'>
                        <div class='card mb-3 shadow'>
                            <div class='card-body'>
                                <h5 class='card-title'><i class='bi bi-briefcase-fill'></i> {$row['title']}</h5>
                                <p class='card-text mx-2'><i class='bi bi-card-checklist'></i> Responsibilities: {$row['JobDescription']}</p>
                                <p class='card-text mx-2'><i class='bi bi-clipboard-check'></i> Requirements: {$row['qualification']}</p>
                                <div class='d-flex flex-row-reverse'>
                                <button type='button' class='btn btn-md text-white mx-2' style='background-color: #003c3c;' 
                                    data-bs-toggle='modal' data-bs-target='#JobApplicant' onclick='setJobApplicant({$row['job_id']})'>
                                    Apply
                                </button>
                                <button type='button' class='btn btn-info btn-md' data-bs-toggle='modal' 
                                    data-bs-target='#$ViewJobId' onclick='setJobApplicant({$row['job_id']})'>
                                    View
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    ";
                    echo "
                        <div class='modal fade' id='$ViewJobId' tabindex='-1' aria-labelledby='viewApplicantLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-lg modal-dialog-centered'> <!-- Increased size of modal -->
                                <div class='modal-content rounded'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='viewApplicantLabel'>Applicant Information</h5>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                    </div>
                                    <div class='modal-body'>
                                        <div class='row'> <!-- Added row for better layout -->
                                            <div class='col-md-6'>
                                                <h6 class='fw-semi-bold fs-5'>Job Title:</h6>
                                                <p class='mx-3'>{$row['title']}</p>
                                            </div>
                                            <div class='col-md-6'>
                                                <h6 class='fw-semi-bold fs-5'>Job Description:</h6>
                                                <p class='mx-3'>{$row['JobDescription']}</p>
                                            </div>
                                            <div class='col-md-6'>
                                                <h6 class='fw-semi-bold fs-5'>Job Qualification:</h6>
                                                <p class='mx-3'>{$row['qualification']}</p>
                                            </div>
                                            <div class='col-md-6'>
                                                <h6 class='fw-semi-bold fs-5'>Job Salary Range:</h6>
                                                <p class='mx-3'>{$row['min_salary']} - {$row['max_salary']}</p> <!-- Fixed salary display -->
                                            </div>
                                            <div class='col-md-6'>
                                                <h6 class='fw-semi-bold fs-5'>Job Designation Location:</h6>
                                                <p class='mx-3'>{$row['branch']}</p>
                                            </div>
                                            <div class='col-md-6'>
                                                <h6 class='fw-semi-bold fs-5'>Job Employment Type:</h6>
                                                <p class='mx-3'>{$row['EmployeeType']}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";
                }

                ?>
            </div>
            <div class="d-flex justify-content-center my-3">
                <a href="./SearchJob.php" class="btn btn-info">View More</a>
            </div>
        </div>
    </section>

    <!--Footer-->
    <div class="container-fluid bg-dark text-center text-light mt-5" style="padding: 10px 0;">
        <div class="footer-content" style="min-height: 100px; line-height: 30px;">
            <p class="mb-2">&copy; 2024 Your Organization. All Rights Reserved.</p>

            <ul class="list-inline mb-2">
                <li class="list-inline-item"><a href="https://sedp.ph/about-us/" class="text-light">About Us</a></li>
                <li class="list-inline-item"><a href="https://sedp.ph/services/" class="text-light">Services</a></li>
                <li class="list-inline-item"><a href="/privacy-policy" class="text-light">Privacy Policy</a></li>
                <li class="list-inline-item"><a href="/terms-of-service" class="text-light">Terms of Service</a></li>
            </ul>

            <p class="mb-2">Contact Us: <a href="mailto:simbag_sedp@yahoo.com" class="text-light">simbag_sedp@yahoo.com</a></p>

            <div class="social-media-links mb-2">
                <a href="https://web.facebook.com/sedp.ph" target="_blank" class="mx-2 text-light"><i class="fa fa-facebook"></i></a>
                <a href="https://twitter.com/yourprofile" class="mx-2 text-light"><i class="fa fa-twitter"></i></a>
                <a href="https://linkedin.com/in/yourprofile" class="mx-2 text-light"><i class="fa fa-linkedin"></i></a>
            </div>
        </div>
    </div>

    <!-- Modal for Job Application -->
    <?php
    include("./ApplyModal.php");
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

<?php
if (!empty($_GET['file'])) {
    $filename = basename($_GET['file']);
    $filepath = 'destination/' . $filename;
    if (!empty($filename) && file_exists($filepath)) {

        header("Cashe-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/zip");
        header("Content-Transper-Emcoding: binary");

        readfile($filepath);
        exit;
    } else {
        echo "This file Does not exist";
    }
}
?>