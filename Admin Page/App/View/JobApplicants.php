<?php
$title = 'Employee | SEDP HRMS';
$page = 'Employee';

include("../../../Database/db.php");
include('../../Core/Includes/header.php');

// Handle department filter
$applicantStatus = isset($_GET['status']) ? $_GET['status'] : '';
?>

<div class="wrapper">
    <!--sidebar-->
    <?php
    include_once('../../core/includes/sidebar.php');
    ?>

    <!--add employee-->
    <main class="main">
        <!--header-->
        <?php
        include '../../core/includes/navBar.php';
        ?>

        <div class="container-fluid shadow p-3 mb-5 bg-body-tertiary rounded-4">

            <!--Alert Message for error and successMessage-->
            <?php
            include('../../Core/Includes/alertMessages.php');
            ?>

            <h3 class="fw-bold fs-5">List Of Job Applicants</h3>
            <hr style="padding-bottom: 1.5rem;">

            <div class="d-flex mt">
                <form id="searchForm" action="../Applicants/SearchApplicants.php" method="GET" onsubmit="return validateSearch()">
                    <div class="input-group mb-3">
                        <input type="text" name="search" value="" class="form-control" placeholder="Search here!" id="searchInput">
                        <button type="submit" class="btn btn-primary btn-md"><i class="bi bi-search"></i></button>
                    </div>
                </form>
                <div class="mx-3 mt-0">
                    <form action="" method="GET">
                        <div class="form-group d-flex">
                            <select class="form-select" name="status" onchange="this.form.submit()" required>
                                <option value="" disabled <?php echo empty($applicantStatus) ? 'selected' : ''; ?>>Filter by Status</option>
                                <?php
                                // Fetch statuses and order them alphabetically
                                $sql = "SELECT * FROM employee_status ORDER BY status_name ASC";
                                $result = $connection->query($sql);

                                if (!$result) {
                                    die("Invalid Query: " . $connection->error);
                                }

                                // Display employee statuses and maintain selected one
                                while ($row = $result->fetch_assoc()) {
                                    $selected = ($row['status_name'] == $applicantStatus) ? 'selected' : '';
                                    echo "<option value='{$row['status_name']}' $selected>{$row['status_name']}</option>";
                                }
                                ?>
                            </select>

                            <!-- Reset Button -->
                            <button type="button" class="btn btn-danger ms-2" onclick="resetFilter()">
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <table class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>STATUS</th>
                        <th>OPERATIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // SQL query for fetching applicants
                    $sql = "SELECT a.applicant_id, a.name, a.email, a.contact, a.status, a.applied_date, a.message, j.title
                            FROM applicants a
                            JOIN job j ON a.job_id = j.job_id";

                    if ($applicantStatus) {
                        $sql .= " WHERE a.status = ?";
                    }

                    $sql .= " LIMIT 5";

                    $stmt = $connection->prepare($sql);
                    if ($applicantStatus) {
                        $stmt->bind_param("s", $applicantStatus);
                    }

                    $stmt->execute();
                    $result = $stmt->get_result();

                    if (!$result) {
                        die("Invalid Query: " . $connection->error);
                    }

                    // Output applicant rows
                    while ($row = $result->fetch_assoc()) {
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
                                        <button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>Close</button>
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
<!-- Modal Add Employee-->
<?php
include("../Applicants/DeleteJobApplicant.php");
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<!-- Scripts -->
<?php include("../../Core/Includes/script.php"); ?>

</body>

</html>