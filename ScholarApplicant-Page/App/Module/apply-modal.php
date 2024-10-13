<style>
    .custom-modal {
        max-width: 600px;
        /* Set your desired width */
    }
</style>
<!-- Modal for Application Form -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered custom-modal"> <!-- Centered modal with custom width -->
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Application Form</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="applicationForm" action="../db/apply-modal.php" method="POST" enctype="multipart/form-data"> <!-- Added enctype for file upload -->
                <div class="modal-body" style="max-height: 550px; overflow-y: auto;">
                    <!-- Name Input -->
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name" minlength="3" maxlength="50" required>
                    </div>
                    <!-- Email Input -->
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
                    </div>
                    <!-- Contact Number Input -->
                    <div class="form-group mb-3">
                        <label for="contact" class="form-label">Contact Number</label>
                        <input type="tel" class="form-control" name="contact" id="contact" placeholder="e.g., 12345678901" pattern="[0-9]{11}" inputmode="numeric" maxlength="11" required>
                    </div>
                    <!-- School Input -->
                    <div class="form-group mb-3">
                        <label for="school" class="form-label">School</label>
                        <input class="form-control" name="school" id="school" placeholder="Enter the name of your school" rows="4" required>
                    </div>
                    <!-- File Upload Input -->
                    <div class="form-group mb-3">
                        <label for="resume" class="form-label">Upload Resume</label>
                        <input type="file" class="form-control" name="resume" id="resume" accept=".pdf,.doc,.docx" required>
                        <small class="text-muted">Accepted file formats: .pdf, .doc, .docx</small>
                    </div>
                    <!-- Message/Qualification Input -->
                    <div class="form-group mb-3">
                        <label for="message" class="form-label">Additional Information</label>
                        <textarea class="form-control" name="message" id="message" placeholder="Include any qualifications or messages" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Apply</button>
                </div>
            </form>
        </div>
    </div>
</div>