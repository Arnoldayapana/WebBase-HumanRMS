<?php
// Connection
$title = 'Scholar Recipient | SEDP HRMS';
$page = 'Recipient';

include("../../../Database/db.php");
include('../../Core/Includes/header.php');

// Initialize variables
$name = $email = $school = $contact = $GradeLevel = "";
$errorMessage = $successMessage = "";

?>

<div class="wrapper">
    <!-- Sidebar -->
    <?php include_once('../../core/includes/sidebar.php'); ?>

    <!-- Main Content -->
    <main class="main">
        <!-- Header -->
        <?php include '../../core/includes/navBar.php'; ?>

        <div class="container-fluid shadow p-3 mb-5 bg-body-tertiary rounded-4 my-4">
            <!-- Alert Messages -->
            <?php include('../../Core/Includes/alertMessages.php'); ?>
            <h3 class="fw-bold fs-4">List Of Recipients</h3>
            <hr>
            <div class="row">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end px-6">
                    <form action="../Scholar/SearchRecipient.php" method="GET">
                        <div class="input-group mb-2">
                            <input type="text" name="search" class="form-control" placeholder="Search Recipient">
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
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>OPERATIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Read all rows from the database table
                    $sql = "SELECT * FROM recipient WHERE GradeLevel = 'College'";
                    $result = $connection->query($sql);

                    if (!$result) {
                        die("Invalid Query: " . $connection->error);
                    }

                    // Read data of each row
                    while ($row = $result->fetch_assoc()) {
                        $modalId = "editRecipient" . $row['recipient_id'];
                        $ViewId = "viewRecipient" . $row['recipient_id'];

                        echo "
                        <tr>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>
                                <!-- Edit Button (Opens Modal) -->
                                <button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#$modalId'>
                                    <i class='bi bi-pencil-square'></i>
                                </button>

                                <div class='modal fade' id='$modalId' tabindex='-1' aria-labelledby='editRecipientLabel' aria-hidden='true'>
                                    <div class='modal-dialog modal-dialog-centered'>
                                        <div class='modal-content' style='width: 550px;'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='editRecipientLabel'>Edit Recipient</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <form action='../Scholar/EditRecipient.php' method='POST'>
                                                <div class='modal-body'>
                                                    <input type='hidden' name='recipient_id' value='{$row['recipient_id']}'>
                                                    <div class='mb-3'>
                                                        <label for='name' class='form-label'>Name</label>
                                                        <input type='text' class='form-control' name='name' value='" . htmlspecialchars($row['name']) . "' required>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='email' class='form-label'>Email</label>
                                                        <input type='email' class='form-control' name='email' value='" . htmlspecialchars($row['email']) . "' required>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='school' class='form-label'>School</label>
                                                        <input type='text' class='form-control' name='school' value='" . htmlspecialchars($row['school']) . "' required>
                                                    </div>
                                                    <div class='mb-3'>
                                                        <label for='contact' class='form-label'>Contact</label>
                                                        <input type='text' class='form-control' name='contact' value='" . htmlspecialchars($row['contact']) . "' required>
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
                                       data-bs-target='#DeleteRecipient' onclick='setRecipientIdForDelete({$row['recipient_id']})'>
                                    <i class='bi bi-trash'></i>
                                </button>
                                <!-- View Button -->
                                <button type='button' class='btn btn-warning btn-sm' data-bs-toggle='modal' 
                                       data-bs-target='#$viewId' onclick='setRecipientIdForView({$row['recipient_id']})'>
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

<!-- Modal Add Recipient -->
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