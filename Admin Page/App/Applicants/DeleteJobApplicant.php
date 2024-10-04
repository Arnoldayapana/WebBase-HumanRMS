<!-- Delete Confirmation Modal -->
<div class="modal fade" id="DeleteJobApplicant" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="deleteModalLabel">Delete Applicant?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this applicant?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-dark" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" action="../Dao/JobApplicants-db/DeleteJobApplicants_db.php">
                    <input type="hidden" id="applicant_id" name="applicant_id" value="">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function setJobApplicantIdForDelete(applicantId) {
        document.getElementById('applicant_id').value = applicantId;
    }
</script>