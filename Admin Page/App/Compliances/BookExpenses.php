<?php
$title = 'Narrative Report | SEDP HRMS';
$page = 'compliance narrative report';

include('../../Core/Includes/header.php');
?>
<div class="wrapper">
    <?php
    include("../../Core/Includes/sidebar.php");
    ?>

    <div class="main p-3">
        <?php
        include('../../Core/Includes/navBar.php');
        ?>

        <div class="container-fluid shadow p-3 mb-5 bg-body-tertiary rounded-4">
            <h3 class="fw-bold fs-4">Book Report</h3>
            <hr style="padding-bottom: 1.5rem;">
            <div class="row">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end px-6">
                    <form action="#" method="GET">
                        <div class="input-group mb-2">
                            <input type="text" name="search" value="" class="form-control" placeholder="Search Recipient">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <table class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>SUBMISION STATUS</th>
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
                        $modalId = "editRecipient" . $row['recipient_id'];
                        $ViewId = "viewRecipient" . $row['recipient_id'];
                        echo "
                        <tr>
                            <td>$row[recipient_id]</td>
                            <td>$row[name]</td>
                            <td>$row[email]</td>
                            <td class='text-warning fw-semi-bold fs-6'>pending</td>
                            <td>
                                    <!-- Check Button -->
                                    <button type='button' class='btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#$modalId'>
                                        <i class='bi bi-check-circle'></i>
                                    </button>
                                    <!-- Reject Button -->
                                    <button type='button' class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#$modalId'>
                                        <i class='bi bi-file-excel'></i>
                                    </button>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>

        </div>

        <?php
        include('../../../Assets/Js/bootstrap.js')
        ?>
        </body>

        </html>