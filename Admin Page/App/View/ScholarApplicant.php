<?php
//connection
$title = 'Scholar Applicant | SEDP HRMS ';
$page = 'Recipient';

include("../../../Database/db.php");
include('../../Core/Includes/header.php');

$name = "";
$email = "";
$school = "";
$contact = "";
$GradeLevel = "";

$errorMessage = "";
$successMessage = "";
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

        <div class="container-fluid shadow p-3 mb-5 bg-body-tertiary rounded-4" my-4>
            <br>
            <h3 class="fw-bold">List Of Scholar Applicants</h3>
            <hr>
            <div class="row">
                <div class="col-4 ms-auto  me-4">
                    <form action="../ScholarApplicant/SearchScholarApplicant.php" method="GET">
                        <div class="input-group mb-2">
                            <input type="text" name="search" value="" class="form-control" placeholder="Search Recipient">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <table class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>SCHOOL</th>
                        <th>CONTACT</th>
                        <th>OPERATIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //connection
                    include("../../../Database/db.php");
                    //read all row from database table
                    $sql = "SELECT * FROM scholar_applicant ";
                    $result = $connection->query($sql);

                    if (!$result) {
                        die("Invalid Query" . $connection->error);
                    }
                    //read data of each row
                    while ($row = $result->fetch_assoc()) {
                        // create a unique modal ID for each employee
                        $modalId = "editScholarApplicant" . $row['scholar_id'];

                        echo "
                        <tr>
                            <td>$row[scholar_id]</td>
                            <td>$row[name]</td>
                            <td>$row[email]</td>
                            <td>$row[school]</td>
                            <td>$row[contact]</td>
                            <td>
                                <!-- Edit Button (Opens Modal) -->
                                    <button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#$modalId'>
                                        <i class='bi bi-pencil-square'></i>
                                    </button>

                                <div class='modal fade' id='$modalId' tabindex='-1' aria-labelledby='editScholarApplicantLabel' aria-hidden='true'>
                                    <div class='modal-dialog modal-dialog-centered'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='editScholarApplicantLabel'>Edit Recipient</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <form action='../ScholarApplicant/EditScholarApplicant.php' method='POST'>
                                                <div class='modal-body'>
                                                    <input type='hidden' name='scholar_id' value='{$row['scholar_id']}'>
                                                    <div class='mb-3'>
                                                        <label for='name' class='form-label'>Name</label>
                                                        <input type='text' class='form-control' name='name' value='{$row['name']}' required>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='email' class='form-label'>Email</label>
                                                        <input type='email' class='form-control' name='email' value='{$row['email']}' required>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='school' class='form-label'>School</label>
                                                        <input type='text' class='form-control' name='school' value='{$row['school']}' required>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='contact' class='form-label'>Contact</label>
                                                        <input type='text' class='form-control' name='contact' value='{$row['contact']}' required>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='GradeLevel' class='form-label'>Grade Level</label>
                                                        <select class='form-select' name='GradeLevel' required>
                                                            <option value=''>Select</option>";

                        // Fetch grade levels
                        $gradeLevelQuery = 'SELECT * FROM grade_level';
                        $gradeResult = $connection->query($gradeLevelQuery);

                        if (!$gradeResult) {
                            die('Invalid Query: ' . $connection->error);
                        }
                        while ($gradeRow = $gradeResult->fetch_assoc()) {
                            $selected = ($row['GradeLevel'] == $gradeRow['name']) ? 'selected' : '';
                            echo "<option value='" . htmlspecialchars($gradeRow['name']) . "' $selected>" . htmlspecialchars($gradeRow['name']) . "</option>";
                        }

                        echo "
                                                </select>
                                                    </div>
                                                </div>
                                                <div class='modal-footer'>
                                                    <button type='button' class='btn btn-danger' data-bs-dismiss='modal'>Cancel</button>
                                                    <button type='submit' class='btn btn-primary'>Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                    <!-- Delete Button -->
                                     <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' 
                                            data-bs-target='#DeleteScholarApplicant' onclick='setScholarApplicantIdForDelete($row[scholar_id])'>
                                           <i class='bi bi-trash'></i>
                                    </button>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</div>
<!-- Modal Add Employee-->
<?php
include("../../App/ScholarApplicant/DeleteScholarApplicant.php");
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
<script src="../../Public/Assets/Js/AdminPage.js"></script>
</body>

</html>