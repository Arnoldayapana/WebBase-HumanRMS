<?php
$title = 'Branch Employees | SEDP HRMS';
$page = 'Branch Employees';

include('../../Core/Includes/header.php');

// Check if branch_id is provided in the URL
if (isset($_GET['branch_id'])) {
    $branch_id = $_GET['branch_id'];
} else {
    die("Branch ID not provided.");
}

// Connect to the database
include("../../../Database/db.php");

// Fetch the branch details for display
$branch_query = $connection->prepare("SELECT * FROM branches WHERE branch_id = ?");
$branch_query->bind_param('i', $branch_id);
$branch_query->execute();
$branch_result = $branch_query->get_result();
$branch = $branch_result->fetch_assoc();

// Fetch employees related to this branch (Assuming `branch` column stores the branch name)
$employee_query = $connection->prepare("
    SELECT employees.username, employees.email, employees.ContactNumber, employees.password, employees.department, employees.branch, employees.hire_date
    FROM employees
    WHERE employees.branch = ?
");
$employee_query->bind_param('s', $branch['name']);  // Using the branch name from the `branches` table
$employee_query->execute();
$employees = $employee_query->get_result();
?>
<div class="wrapper">
    <?php include("../../Core/Includes/sidebar.php"); ?>

    <div class="main p-3">
        <?php include('../../Core/Includes/navBar.php'); ?>

        <div class="container-fluid shadow p-3 mb-5 bg-body-tertiary rounded-4">
            <h3 class="fw-bold fs-4">Employees in <?= $branch['name']; ?> Branch</h3>
            <hr style="padding-bottom: 1.5rem;">

            <table class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Employee Name</th>
                        <th>Contact</th>
                        <th>Department</th>
                        <th>BRANCH</th>
                        <th>OPERATION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($employees->num_rows > 0) {
                        $index = 1;
                        while ($employee = $employees->fetch_assoc()) {
                            echo "
                            <tr>
                                <td>{$index}</td>
                                <td>{$employee['username']}</td>
                                <td>{$employee['email']}</td>
                                <td>{$employee['department']}</td>
                                <td>{$employee['branch']}</td>
                                <td>
                                    <button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal'>
                                            <i class='bi bi-pencil-square'></i>
                                        </button>

                                        <!-- Delete Button -->
                                        <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' 
                                        data-bs-target='#DeleteEmployee'>
                                            <i class='bi bi-trash'></i>
                                        </button>
                                </td>
                            </tr>";
                            $index++;
                        }
                    } else {
                        echo "<tr><td colspan='4'>No employees found for this branch</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('../../../Assets/Js/bootstrap.js'); ?>

</body>

</html>