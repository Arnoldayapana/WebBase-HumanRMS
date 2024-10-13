<?php
$title = "Reqcruitment | SEDP HRMS";
$page = "reqcruitment";
include('../../Core/Includes/header.php');
include('../../../Database/db.php');

// Initialize variables
$title = "";
$JobDescription = "";
$qualification = "";
$branch = "";
$min_salary = "";
$max_salary = "";
$EmployeeType = "";

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'] ?? '';
    $JobDescription = $_POST['JobDescription'] ?? '';
    $qualification = $_POST['qualification'] ?? '';
    $branch = $_POST['branch'] ?? '';
    $min_salary = $_POST['min_salary'] ?? '';
    $max_salary = $_POST['max_salary'] ?? '';
    $EmployeeType = $_POST['EmployeeType'] ?? '';

    // Validate required field
    if (empty($title) || empty($JobDescription) || empty($qualification) || empty($branch) || empty($min_salary) || empty($max_salary) || empty($EmployeeType)) {
        $errorMessage = "All fields are required";
    } else {
        // Insert into the database
        $sql = "INSERT INTO job (title, JobDescription, qualification, branch, min_salary, max_salary, EmployeeType) 
                VALUES ('$title', '$JobDescription', '$qualification', '$branch', '$min_salary', '$max_salary', '$EmployeeType')";

        if (mysqli_query($connection, $sql)) {
            $successMessage = "New job added successfully!";
            header("Location: ReqcruitmentPage.php?msg=$successMessage");
            exit;
        } else {
            $errorMessage = "Error: " . mysqli_error($connection);
        }
    }
}
?>

<div class="wrapper">
    <!-- Sidebar -->
    <?php include '../../Core/Includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main">
        <!-- Header -->
        <?php include '../../Core/Includes/navbar.php'; ?>

        <!-- Main Content -->
        <div class="container-fluid">
            <div class="d-flex justify-content-end mx-lg-5 gap-2">
                <button type="button" class="btn btn-md text-white" style="background-color: #003c3c;" data-bs-toggle="modal" data-bs-target="#CreateJobPost">Post Job</button>
            </div>
            <!--Alert Message for error and successMessage-->
            <?php
            include('../../Core/Includes/alertMessages.php');
            ?>

            <!-- Job Offers Section -->
            <section id="content">
                <div class="container my-4 bg-light">
                    <div class="row">
                        <h1 class="text-center fw-bold fs-3 my-3">Company Current Job Offers:</h1>
                    </div>
                    <div class="row align-items-center justify-content-center">
                        <?php
                        // Read all rows from the database
                        $sql = "SELECT * FROM job";
                        $result = $connection->query($sql);

                        if (!$result) {
                            die("Invalid Query: " . $connection->error);
                        }

                        // Display each job
                        while ($row = $result->fetch_assoc()) {
                            $EditJobPost = "editJobPost" . $row['job_id'];
                            echo "
                                <div class='col-lg-6'>
                                    <div class='card mb-3 shadow'>
                                        <div class='card-body'>
                                            <h5 class='card-title'><i class='bi bi-briefcase-fill'></i> {$row['title']}</h5>
                                            <p class='card-text'><i class='bi bi-card-checklist'></i> Job Description: {$row['JobDescription']}</p>
                                            <p class='card-text'><i class='bi bi-clipboard-check'></i> Qualification: {$row['qualification']}</p>
                                            <div class='d-flex justify-content-end mx-2 gap-2'>
                                                <!-- Edit Button -->
                                                <button type='button' class='btn btn-sm text-white' style='background-color: #003c3c;' data-bs-toggle='modal' data-bs-target='#$EditJobPost'>
                                                <i class='bi bi-pencil-square'></i>
                                                </button>

                                                <!-- Edit Modal -->
                                                <div class='modal fade' id='$EditJobPost' tabindex='-1' aria-labelledby='editJobPostLabel' aria-hidden='true'>
                                                    <div class='modal-dialog modal-dialog-centered'>
                                                        <div class='modal-content'>
                                                            <div class='modal-header'>
                                                                 <h5 class='modal-title fw-bold fs-5' id='editJobPostLabel'>Edit Job ?</h5>
                                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                            </div>
                                                            <form method='POST' action='../Dao/Reqcruitement/EditJobPost.php'>
                                                                <div class='modal-body'style='max-height: 500px; overflow-y: auto';>
                                                                    <input type='hidden' name='job_id' value='{$row['job_id']}'>
                                                                    <div class='form-group mb-3'>
                                                                        <label class='col-form-label'>Job Title</label>
                                                                        <input type='text' class='form-control' name='title' value='{$row['title']}'>
                                                                    </div>
                                                                    <div class='form-group mb-3'>
                                                                        <label class='col-form-label'>Job Description</label>
                                                                        <textarea class='form-control' name='JobDescription'>{$row['JobDescription']}</textarea>
                                                                    </div>
                                                                    <div class='form-group mb-3'>
                                                                        <label class='col-form-label'>Qualification</label>
                                                                        <textarea class='form-control' name='qualification'>{$row['qualification']}</textarea>
                                                                    </div>

                                                        <div class='mb-2'>
                                                            <label for='branch' class='form-label'>Branch</label>
                                                             <select class='form-select' name='branch' required>
                                                                <option value='' disabled>Select a branch</option>";

                            // Fetch branchess from the database
                            $sql_dept = "SELECT * FROM branches ORDER BY name ASC";
                            $result_dept = $connection->query($sql_dept);

                            if ($result_dept) {
                                while ($dept_row = $result_dept->fetch_assoc()) {
                                    $selected = ($dept_row['name'] == $row['branches']) ? 'selected' : '';
                                    echo "<option value='{$dept_row['name']}' $selected>{$dept_row['name']}</option>";
                                }
                            } else {
                                echo "<option value=''>Error loading branches</option>";
                            }

                            echo "
                                                            </select> 
                                                        </div>
                                                                    <!-- Salary Range Inputs (Min and Max Salary) -->
                                                                    <div class='form-group mb-3'>
                                                                        <label class='col-form-label'>Salary Range</label>
                                                                        <div class='d-flex align-items-center'>
                                                                            <input required type='number' class='form-control' name='min_salary' placeholder='Min' value='{$row['min_salary']}' min='0' max='500000'>
                                                                            <span class='mx-2'>-</span>
                                                                            <input required type='number' class='form-control' name='max_salary' placeholder='Max' value='{$row['max_salary']}' min='0' max='500000'>
                                                                        </div>
                                                                    </div>
                                                                <!-- Employee Type Dropdown (with no default selection) -->
                                                                <div class='form-group mb-3'>
                                                                    <label for='employeeType' class='col-form-label'>Employee Type</label>
                                                                    <select required class='form-select' id='employeeType' name='EmployeeType'>
                                                                        <option value='' disabled selected>Select Type</option> <!-- No pre-selected value -->
                                                                        <option value='PartTime' <?php echo ($EmployeeType == 'PartTime') ? 'selected' : ''; ?>Part-time</option>
                                                                        <option value='FullTime' <?php echo ($EmployeeType == 'FullTime') ? 'selected' : ''; ?>Full-time</option>
                                                                        <option value='Freelance' <?php echo ($EmployeeType == 'Freelance') ? 'selected' : ''; ?>Freelance</option>
                                                                    </select>
                                                                </div>
                                                                </div>
                                                                <div class='modal-footer'>
                                                                    <button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>Cancel</button>
                                                                    <button type='submit' class='btn btn-primary'>Update</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Delete Button -->
                                                <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' 
                                                        data-bs-target='#DeleteJob' onclick='setJobIdForDelete($row[job_id])'>
                                                    <i class='bi bi-trash'></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ";
                        }
                        ?>
                    </div>
                </div>
            </section>
        </div>

        <!-- Create Job Post Modal -->
        <?php
        include('../Reqcruitement/CreateJobPost.php');
        include('../Reqcruitement/DeleteJobPost.php');
        ?>
    </div>
</div>
<style>
    #content {
        max-height: 700px;
        /* Set the maximum height */
        overflow-y: auto;
        /* Enable vertical scrolling */
    }
</style>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="../../public/assets/javascript/AdminPage.js"></script>
</body>

</html>