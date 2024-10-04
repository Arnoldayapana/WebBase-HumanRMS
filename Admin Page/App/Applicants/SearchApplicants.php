<?php
$title = "Job Applicants | SEDP HRMS";
$page = "jobapplicants";
include('../../Core/Includes/header.php');
?>
<div class="wrapper">
    <!--sidebars-->
    <?php
    include_once('../../Core/Includes/sidebar.php');
    ?>
    <!--add employee-->
    <main class="main">
        <?php
        include '../../Core/Includes/navbar.php';
        ?>
        <div class="container-fluid shadow p-3 mb-5 bg-body-tertiary rounded-4">
            <h3 class="fw-bold">List Of Applicants</h3>
            <hr>
            <div class="d-flex">
                <div class="col-3">
                    <form action="#" method="GET">
                        <div class="input-group mb-3 ">
                            <input type="text" name="search" value="" class="form-control" placeholder="Search here!">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
                <div class="ms-auto me-3">
                    <a href="../View/JobApplicants.php" class="btn btn-dark">Back</a>
                </div>
            </div>
            <table class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>APPLIED DATE</th>
                        <th>OPERATIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Connection
                    include("../../../Database/db.php");

                    // Check if search term is set and not empty
                    $search = isset($_GET['search']) ? $_GET['search'] : '';

                    // Prepare SQL query
                    if (!empty($search)) {
                        $searchTerm = $connection->real_escape_string($search);
                        $sql = "SELECT a.applicant_id, a.name, a.email, a.contact, a.status, a.applied_date, a.message, j.title
                        FROM applicants a
                        JOIN job j ON a.job_id = j.job_id WHERE name LIKE '%$searchTerm%' ORDER BY applicant_id ASC LIMIT 5";
                    } else {
                        $sql = "SELECT a.applicant_id, a.name, a.email, a.contact, a.status, a.applied_date, a.message, j.title
                        FROM applicants a
                        JOIN job j ON a.job_id = j.job_id LIMIT 5";
                    }

                    $result = $connection->query($sql);

                    if (!$result) {
                        die("Invalid Query: " . $connection->error);
                    }

                    // Read data of each row
                    while ($row = $result->fetch_assoc()) {
                        // Create a unique modal ID for each applicant
                        $modalId = "viewApplicantModal" . $row['applicant_id'];

                        echo "<tr>
                            <td>{$row['applicant_id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['status']}</td>
                            <td>
                                <!-- View Applicant Button -->
                                <button type='button' class='btn btn-warning btn-sm' data-bs-toggle='modal' 
                                    data-bs-target='#$modalId'>
                                    <i class='bi bi-eye'></i>
                                </button>

                                <!-- Delete Button -->
                                <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' 
                                    data-bs-target='#DeleteJobApplicant' onclick='setJobApplicantIdForDelete({$row['applicant_id']})'>
                                    <i class='bi bi-trash'></i>
                                </button>
                            </td>
                        </tr>";

                        // View Modal for each applicant
                        echo "
                        <div class='modal fade' id='$modalId' tabindex='-1' aria-labelledby='viewApplicantLabel' aria-hidden='true'>
                            <div class='modal-dialog modal-fullscreen modal-dialog-scrollable'>
                                <div class='modal-content rounded' style='width: 70%; height: auto;'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='viewApplicantLabel'>Applicant Information</h5>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                    </div>
                                    <div class='modal-body'>
                                        <div class='row mb-2 mx-2'>
                                            <div class='col-md-4'>
                                                <h1 class='fs-6 fw-semi-bold'>Full Name :</h1>
                                                <p>{$row['name']}</p>
                                            </div>
                                            <div class='col-md-4'>
                                                <h1 class='fs-6 fw-semi-bold'>Email Address :</h1>
                                                <p>{$row['email']}</p>
                                            </div>
                                            <div class='col-md-4'>
                                                <h1 class='fs-6 fw-semi-bold'>Applied Date :</h1>
                                                <p>{$row['applied_date']}</p>
                                            </div>
                                        </div>

                                        <div class='row mb-2 mx-2'>
                                            <div class='col-md-4'>
                                                <h1 class='fs-6 fw-semi-bold'>Contact Number :</h1>
                                                <p>{$row['contact']}</p>
                                            </div>
                                            <div class='col-md-4'>
                                                <h1 class='fs-6 fw-semi-bold'>Applied Position :</h1>
                                                <p>{$row['title']}</p>
                                            </div>
                                        </div>

                                        <div class='row mx-2'>
                                            <div class='col-md-4'>
                                                <h1 class='fs-6 fw-semi-bold'>File Uploaded :</h1>
                                                <img src='../../Public/Assets/Images/registration.png' alt='img' class='img-fluid' style='max-width: 100%; height: auto;'>
                                                <div class='mt-3'>
                                                    <button class='btn btn-primary'>Download</button>
                                                </div>
                                            </div>

                                            <div class='col-md-6'>
                                                <div class='mb-3'>
                                                    <label for='exampleFormControlTextarea1' class='form-label fs-6 fw-bold'>Comments :</label>
                                                    <textarea class='form-control' id='exampleFormControlTextarea1' rows='5'>{$row['message']}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    }

                    ?>
                </tbody>

            </table>
        </div>
    </main>
</div>

<!-- Modal Add Applicants-->
<?php
include("DeleteJobApplicant.php");
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
<script src="../../public/assets/javascript/AdminPage.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</body>

</html>