<!-- Modal for Job Application -->
<?php
$title = 'Job Applicant | SEDP HRMS';
$page = 'Job Applicant';

include("../Database/db.php");

$name = "";
$email = "";
$contact = "";
$message = "";
$applied_date = "";

?>
<!-- Modal Add Applicants-->
<div class="modal fade" id="JobApplicant" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apply Job ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Form -->
            <form action="./JobApplicant-data.php/application-db.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="job_id" name="job_id">

                    <!-- Name Input -->
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter your name" minlength="3" maxlength="50" value="<?php echo htmlspecialchars($name); ?>" required>
                    </div>

                    <!-- Email Input -->
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($email); ?>" required>
                    </div>

                    <!-- Contact Number Input -->
                    <div class="form-group mb-3">
                        <label for="contact" class="form-label">Contact Number</label>
                        <input type="tel" class="form-control" name="contact" placeholder="e.g., 12345678901" pattern="[0-9]{11}" inputmode="numeric" value="<?php echo htmlspecialchars($contact); ?>" maxlength="11" required>
                    </div>

                    <!-- Message/Qualification Input -->
                    <div class="form-group mb-3">
                        <label for="message" class="form-label">Additional Information</label>
                        <textarea class="form-control" name="message" placeholder="Include any qualifications or messages" rows="4" required><?php echo htmlspecialchars($message); ?></textarea>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Apply</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- FontAwesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
    // Function to set the Job Applicant's job_id in the modal before opening
    function setJobApplicant(jobId) {
        document.getElementById('job_id').value = jobId; // Set job_id dynamically
    }
</script>