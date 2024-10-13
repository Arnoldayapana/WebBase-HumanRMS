<!-- Modal for Creating Job Post -->
<div class="modal fade" id="CreateJobPost" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="CreateJobPostLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="width:600px;">
            <div class="modal-header">
                <h5 class="modal-title fs-5 fw-bold" id="CreateJobPostLabel">Post Job ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Form for creating a new job post -->
            <form method="post">
                <div class="modal-body" style="max-height: 540px; overflow-y: auto;">

                    <!-- Job Title Input -->
                    <div class="form-group mb-3">
                        <label for="jobTitle" class="col-form-label">Job Title</label>
                        <input required type="text" class="form-control" id="jobTitle" name="title" value="<?php echo htmlspecialchars($title); ?>">
                    </div>

                    <!-- Job Description Input -->
                    <div class="form-group mb-3">
                        <label for="jobDescription" class="col-form-label">Job Description</label>
                        <textarea required class="form-control" id="jobDescription" name="JobDescription" rows="3"><?php echo htmlspecialchars($JobDescription); ?></textarea>
                    </div>

                    <!-- Qualification Input -->
                    <div class="form-group mb-3">
                        <label for="qualification" class="col-form-label">Qualification</label>
                        <textarea required class="form-control" id="qualification" name="qualification" rows="3"><?php echo htmlspecialchars($qualification); ?></textarea>
                    </div>

                    <!-- Location Dropdown (with no default selection) -->
                    <div class="form-group mb-3">
                        <label for="location" class="col-form-label">Branch</label>
                        <select required class="form-select" id="branch" name="branch">
                            <option value="" disabled selected>Select</option> <!-- No pre-selected value -->
                            <?php
                            $sql = "SELECT * FROM branches";
                            $result = $connection->query($sql);

                            if ($result) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='{$row['name']}'>{$row['name']}</option>";
                                }
                            } else {
                                echo "<option value=''>No branches available</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Salary Range Inputs (Min and Max Salary) -->
                    <div class="form-group mb-3">
                        <label class="col-form-label">Salary Range</label>
                        <div class="d-flex align-items-center">
                            <input required type="number" class="form-control" name="min_salary" placeholder="Min" value="<?php echo htmlspecialchars($min_salary); ?>" min="0" max="500000">
                            <span class="mx-2">-</span>
                            <input required type="number" class="form-control" name="max_salary" placeholder="Max" value="<?php echo htmlspecialchars($max_salary); ?>" min="0" max="500000">
                        </div>
                    </div>

                    <!-- Employee Type Dropdown (with no default selection) -->
                    <div class="form-group mb-3">
                        <label for="employeeType" class="col-form-label">Employee Type</label>
                        <select required class="form-select" id="employeeType" name="EmployeeType">
                            <option value="" disabled selected>Select Type</option> <!-- No pre-selected value -->
                            <option value="PartTime" <?php echo ($EmployeeType == 'PartTime') ? 'selected' : ''; ?>>Part-time</option>
                            <option value="FullTime" <?php echo ($EmployeeType == 'FullTime') ? 'selected' : ''; ?>>Full-time</option>
                            <option value="Freelance" <?php echo ($EmployeeType == 'Freelance') ? 'selected' : ''; ?>>Freelance</option>
                        </select>
                    </div>

                </div>

                <!-- Modal Footer Buttons -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>
            </form>
        </div>
    </div>
</div>