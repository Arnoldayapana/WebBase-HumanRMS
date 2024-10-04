<?php
$title = 'Job Applicants | SEDP HRMS';
$page = 'JOb Applicants';

include("../../../Database/db.php");

$name = "";
$email = "";
$applied_date = "";
$contact = "";
$comment = "";
$status = "";

?>

<!-- View Employee Modal -->
<div class="modal fade" id="ViewJobApplicant" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <!-- Use modal-fullscreen for fullscreen and modal-dialog-scrollable for scrollable content -->
    <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
        <div class="modal-content rounded">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Applicant Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-2 mx-2">
                    <div class="col-md-4">
                        <h1 class="fs-6 fw-semi-bold">Full Name :</h1>
                        <p class="ofset">{$row['name']}</p>
                    </div>

                    <div class="col-md-4">
                        <h1 class="fs-6 fw-semi-bold">Email Address :</h1>
                        <p class="ofset">{$row['email']}</p>
                    </div>

                    <div class="col-md-4">
                        <h1 class="fs-6 fw-semi-bold">Applied Date :</h1>
                        <p class="ofset">{$row['applied_date']}</p>
                    </div>
                </div>

                <div class="row mb-2 mx-2">
                    <div class="col-md-4">
                        <h1 class="fs-6 fw-semi-bold">Contact Number :</h1>
                        <p class="ofset">{$row['contact']}</p>
                    </div>
                    <div class="col-md-4">
                        <h1 class="fs-6 fw-semi-bold">Applied Position :</h1>
                        <p>{$row['title']}</p>
                    </div>
                </div>

                <div class="row mx-2">
                    <div class="col-md-4">
                        <h1 class="fs-6 fw-semi-bold">File Uploaded :</h1>
                        <img src="../../Public/Assets/Images/registration.png" alt="img" class="img-fluid" style="max-width: 100%; height: auto;">
                        <div class="mt-3">
                            <button class="btn btn-primary">Download</button>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label fs-6 fw-bold">Comments :</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5">{$row['comment']}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <!-- Apply Button -->
                <button type="button" class="btn btn-primary">Apply</button>
            </div>
        </div>
    </div>
</div>

<script>
    function setJobApplicantIdForView(applicantId) {
        document.getElementById('applicant_id').value = applicantId;
    }
</script>