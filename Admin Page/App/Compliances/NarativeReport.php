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
            <h3 class="fw-bold fs-4">Narrative Report</h3>
            <hr style="padding-bottom: 1.5rem;">

            <!-- Form for Narrative Report submission -->
            <form action="submit_narrative.php" method="POST" enctype="multipart/form-data">

                <!-- Report Title -->
                <div class="mb-3">
                    <label for="reportTitle" class="form-label">Report Title</label>
                    <input type="text" class="form-control" id="reportTitle" name="reportTitle" placeholder="Enter report title" required>
                </div>

                <!-- Submission Date -->
                <div class="mb-3">
                    <label for="submissionDate" class="form-label">Submission Date</label>
                    <input type="date" class="form-control" id="submissionDate" name="submissionDate" required>
                </div>

                <!-- Report Content -->
                <div class="mb-3">
                    <label for="reportContent" class="form-label">Report Content</label>
                    <textarea class="form-control" id="reportContent" name="reportContent" rows="8" placeholder="Enter the detailed narrative report" required></textarea>
                </div>

                <!-- File Upload for Attachments -->
                <div class="mb-3">
                    <label for="fileUpload" class="form-label">Attach Supporting Files</label>
                    <input type="file" class="form-control" id="fileUpload" name="fileUpload" accept=".pdf,.doc,.docx,.png,.jpg">
                    <small class="form-text text-muted">Allowed file types: PDF, DOC, DOCX, PNG, JPG</small>
                </div>

                <!-- Submission Button -->
                <button type="submit" class="btn btn-primary">Submit Report</button>

            </form>
            <!-- End of Form -->

        </div>

        <?php
        include('../../../Assets/Js/bootstrap.js')
        ?>
        </body>

        </html>