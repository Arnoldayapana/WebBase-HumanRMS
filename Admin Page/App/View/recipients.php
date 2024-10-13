<?php
//connection
$title = 'Scholar Recipient | SEDP HRMS';
$page = 'Recipient';

include("../../../Database/db.php");
include('../../Core/Includes/header.php');

$name = "";
$email = "";
$school = "";
$contact = "";
$GradeLevel = "";
$branch = "";

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
            <!--Alert Message for error and successMessage-->
            <?php
            include('../../Core/Includes/alertMessages.php');
            ?>
            <h3 class="fw-bold fs-4">List Of Recipient</h3>
            <hr>
            <div class="row">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end px-6">
                    <form action="../Scholar/SearchRecipient.php" method="GET">
                        <div class="input-group mb-2">
                            <input type="text" name="search" value="" class="form-control" placeholder="Search Recipient">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                    <div class="ms-auto me-3">
                        <button type='button' class='btn btn-primary btn-md' data-bs-toggle='modal' data-bs-target='#AddRecipient'>
                            Add Recipient
                        </button>
                    </div>
                </div>
            </div>
            <br>
            <table class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>BRANCH</th>
                        <th>OPERATIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //connection
                    include("../../../Database/db.php");
                    //read all row from database table
                    $sql = "SELECT * FROM recipient";
                    $result = $connection->query($sql);

                    if (!$result) {
                        die("Invalid Query" . $connection->error);
                    }
                    //read data of each row
                    while ($row = $result->fetch_assoc()) {
                        // create a unique modal ID for each employee
                        $modalId = "editRecipient" . $row['recipient_id'];
                        $ViewId = "viewRecipient" . $row['recipient_id'];

                        echo "
                        <tr>
                            <td>$row[recipient_id]</td>
                            <td>$row[name]</td>
                            <td>$row[email]</td>
                            <td>$row[branch]</td>
                            <td>
                                <!-- Edit Button (Opens Modal) -->
                                    <button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#$modalId'>
                                        <i class='bi bi-pencil-square'></i>
                                    </button>

                                <div class='modal fade' id='$modalId' tabindex='-1' aria-labelledby='editRecipientLabel' aria-hidden='true'>
                                    <div class='modal-dialog modal-dialog-centered'>
                                        <div class='modal-content' style='width:550px;'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='editRecipientLabel'>Edit Recipient</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <form action='../Scholar/EditRecipient.php' method='POST'>
                                                <div class='modal-body'>
                                                    <input type='hidden' name='recipient_id' value='{$row['recipient_id']}'>
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
                                                    <button type='button' class='btn btn-outline-secondary me-2' data-bs-dismiss='modal'>Cancel</button>
                                                    <button type='submit' class='btn btn-primary'>Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Button -->
                                <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' 
                                       data-bs-target='#DeleteRecipient' onclick='setRecipientIdForDelete($row[recipient_id])'>
                                      <i class='bi bi-trash'></i>
                               </button>
                                <!-- View Button -->
                                <button type='button' class='btn btn-warning btn-sm' data-bs-toggle='modal' 
                                       data-bs-target='#$ViewId' onclick='setRecipientIdForView($row[recipient_id])'>
                                      <i class='bi bi-eye'></i>
                               </button>


                               
                            </td>
                        </tr>";

                        // View Modal for each applicant
                        include('../Scholar/ViewRecipientsModal.php');
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</div>
<!-- Modal Add Employee-->
<?php
include("../../App/Scholar/AddRecipient.php");
include("../../App/Scholar/DeleteRecipient.php");
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
<script src="../../Public/Assets/Js/AdminPage.js"></script>
</body>

</html>