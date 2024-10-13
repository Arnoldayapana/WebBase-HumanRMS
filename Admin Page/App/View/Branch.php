<?php
//connection
$title = 'Branch | SEDP HRMS';
$page = 'Branch';

include("../../../Database/db.php");
include('../../Core/Includes/header.php');
$name = "";

?>
<div class="wrapper">
    <!--sidebar-->
    <?php include_once('../../core/includes/sidebar.php'); ?>

    <!--main content-->
    <main class="main">
        <!--header-->
        <?php include '../../core/includes/navBar.php'; ?>

        <div class="container-fluid shadow p-3 mb-5 bg-body-tertiary rounded-4">
            <!--Alert Message for error and successMessage-->
            <?php include('../../Core/Includes/alertMessages.php'); ?>

            <h3 class="fw-bold fs-4">List Of Branch</h3>
            <hr>
            <div class="row">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end px-6">
                    <form id="searchForm" action="../Branches/SearchBranch.php" method="GET">
                        <div class="input-group mb-2">
                            <input type="text" name="search" id="searchInput" class="form-control" placeholder="Search Branch">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                    <div class="ms-auto me-3">
                        <button type='button' class='btn btn-primary btn-md' data-bs-toggle='modal' data-bs-target='#CreateBranch'>
                            Add Branch
                        </button>
                    </div>
                </div>
            </div>
            <br>
            <table class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>BRANCH NAME</th>
                        <th>CREATED DATE</th>
                        <th>OPERATIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //read all rows from the branches table
                    $result = $connection->query("SELECT * FROM branches");

                    if ($result && $result->num_rows > 0) {
                        // Loop through each row
                        while ($row = $result->fetch_assoc()) {
                            $modalId = "editBranchModal" . $row['branch_id'];
                            $viewId = "viewBranch" . $row['branch_id'];

                            echo "
                            <tr>
                                <td>{$row['branch_id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['created_date']}</td>
                                <td>

                                    <!-- view Button -->
                                    <a href='../Branches/ViewBranch.php?branch_id={$row['branch_id']}' class='btn btn-warning btn-sm'>
    <i class='bi bi-eye'></i>
</a>

                                
                                    <!-- Edit Button -->
                                    <button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#$modalId'>
                                        <i class='bi bi-pencil-square'></i>
                                    </button>

                                    <!-- Edit Modal -->
                                    <div class='modal fade' id='$modalId' tabindex='-1' aria-labelledby='editBranchLabel' aria-hidden='true'>
                                        <div class='modal-dialog modal-dialog-centered'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title'>Edit Branch</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <form action='../Branches/EditBranch.php' method='POST'>
                                                    <div class='modal-body'>
                                                        <input type='hidden' name='branch_id' value='{$row['branch_id']}'>
                                                        <div class='mb-3'>
                                                            <label for='name' class='form-label'>Name</label>
                                                            <input type='text' class='form-control' name='name' value='{$row['name']}' required>
                                                        </div>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-outline-secondary' data-bs-dismiss='modal'>Close</button>
                                                        <button type='submit' class='btn btn-primary'>Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Button -->
                                    <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' 
                                        data-bs-target='#DeleteBranch' onclick='setBranchIdForDelete({$row['branch_id']})'>
                                        <i class='bi bi-trash'></i>
                                    </button>
                                </td>
                            </tr>
                            ";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No branches found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

<!-- Modals -->
<?php
include("../../App/Branches/CreateBranche.php");
include("../../App/Branches/DeleteBranch.php");
?>

<!-- Scripts -->
<?php
include("../../Core/Includes/script.php");
?>

</body>

</html>