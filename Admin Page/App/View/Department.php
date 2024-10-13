<?php
//connection
$title = 'Department | SEDP HRMS';
$page = 'Department';

include("../../../Database/db.php");
include('../../Core/Includes/header.php');

$name = "";
$location = "";

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
            <h3 class="fw-bold fs-4">List Of Departments</h3>
            <hr>
            <div class="row">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end px-6">
                    <form id="searchForm" action="../Departments/SearchDepartment.php" method="GET" onsubmit="return validateSearch()">
                        <div class="input-group mb-2">
                            <input type="text" name="search" value="" class="form-control" placeholder="Search Department">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                    <div class="ms-auto me-3">
                        <button type='button' class='btn btn-primary btn-md' data-bs-toggle='modal' data-bs-target='#CreateDepartment'>
                            Add Department
                        </button>
                    </div>
                </div>
            </div>
            <br>
            <table class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>DEPARTMENT NAME</th>
                        <th>CREATED DATE</th>
                        <th>OPERATIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //connection
                    include("../../../Database/db.php");
                    //read all row from database table
                    $sql = "SELECT * FROM departments";
                    $result = $connection->query($sql);

                    if (!$result) {
                        die("Invalid Query" . $connection->error);
                    }
                    //read data of each row
                    while ($row = $result->fetch_assoc()) {
                        // create a unique modal ID for each employee
                        $modalId = "editDepartmentModal" . $row['department_id'];

                        echo "
                        <tr>
                            <td>$row[department_id]</td>
                            <td>$row[name]</td>
                            <td>$row[created_date]</td>
                            <td>
                                <!-- Edit Button (Opens Modal) -->
                                    <button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#$modalId'>
                                        <i class='bi bi-pencil-square'></i>
                                    </button>

                                    <!-- Modal for Editing Employee -->
                                    <div class='modal fade' id='$modalId' tabindex='-1' aria-labelledby='editDepartmentLabel' aria-hidden='true'>
                                        <div class='modal-dialog modal-dialog-centered'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title fw-bold fs-5' id='editDepartmentLabel'>Edit Department ?</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <form action='../Departments/EditDepartment.php' method='POST'>
                                                    <div class='modal-body'>
                                                        <input type='hidden' name='department_id' value='$row[department_id]'>

                                                        <div class='mb-3'>
                                                            <label for='name' class='form-label'>Name of Department</label>
                                                            <input type='text' class='form-control' name='name' value='$row[name]' required>
                                                        </div>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-outline-secondary me-2' data-bs-dismiss='modal'>Close</button>
                                                        <button type='submit' class='btn btn-primary'>Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Delete Button -->
                                     <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' 
                                        data-bs-target='#DeleteDepartment' onclick='setDepartmentIdForDelete($row[department_id])'>
                                        <i class='bi bi-trash'></i>
                                    </button>
                                </td>
                            </tr>
                            ";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</div>
<!-- Modal Add Employee-->
<?php
include("../../App/Departments/CreateDepartment.php");
include("../../App/Departments/DeleteDepartment.php");
?>

<!-- Scripts -->
<?php
include("../../Core/Includes/script.php");
?>
</body>

</html>