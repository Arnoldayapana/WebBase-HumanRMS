<?php
$title = 'Scholar Book Expenses | SEDP HRMS';
$page = 'scholar book expenses';
include('../../Core/Includes/header.php');
?>

<div class="container-fluid" style="margin-top: 5.5rem;
    max-width: 1000px;
    background-color: rgba(0, 60,60, 0.85);
    border-radius: 1rem;
">
    <div class="container shadow-lg mb-5 rounded-4" style="padding: 1rem 4rem 2.5rem;">
        <h3 class="fw-bold fs-3 text-center mb-4" style="color: white;">Book Expenses</h3>
        <hr style="padding-bottom: 1.5rem;">

        <form action="submit_narrative.php" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="reportTitle" class="form-label" style="color: white;">Report Title</label>
                <input type="text" class="form-control shadow-sm border-0" id="reportTitle" name="reportTitle" placeholder="Enter report title" required>
                <div class="form-text" style="color: white;">Provide a concise and clear title for your report.</div>
            </div>

            <div class="mb-4">
                <label for="submissionDate" class="form-label" style="color: white;">Submission Date</label>
                <input type="date" class="form-control shadow-sm border-0" id="submissionDate" name="submissionDate" required>
            </div>

            <div class="mb-4">
                <label for="reportContent" class="form-label" style="color: white;">Report Content</label>
                <textarea class="form-control shadow-sm border-0" id="reportContent" name="reportContent" rows="8" placeholder="Enter detailed narrative report" required></textarea>
                <div class="form-text" style="color: white;">Provide a comprehensive description of your report.</div>
            </div>

            <div class="mb-4">
                <label for="fileUpload" class="form-label" style="color: white;">Attach Supporting Files</label>
                <input type="file" class="form-control shadow-sm border-0" id="fileUpload" name="fileUpload" accept=".pdf,.doc,.docx,.png,.jpg">
                <small class="form-text" style="color: white;">Allowed file types: PDF, DOC, DOCX, PNG, JPG</small>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg shadow" style="background-color: #3498DB; border: none;">Submit Report</button>
            </div>
        </form>
    </div>
</div>

<?php
include('../../../Assets/Js/bootstrap.js');
?>
<?php include('../../Core/Includes/footer.php'); ?>