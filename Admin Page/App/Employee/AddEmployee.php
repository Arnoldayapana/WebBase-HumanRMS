<div class="modal fade" id="AddEmployee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="width: 600px;">
            <div class="modal-header">
                <h2 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Add Employee?</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="../Dao/Employee-db/AddEmployee_db.php" method="POST">
                <div class="modal-body" style="max-height: 550px; overflow-y: auto;">
                    <input type="hidden" class="form-control" name="usertype" value="employee">
                    <div class="form-group mb-3">
                        <label for="username" class="col col-form-label">Name</label>
                        <input type="text" class="form-control" id="username" name="username" minlength="3" maxlength="50" value="<?php echo htmlspecialchars($username); ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="col col-form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="ContactNumber" class="col col-form-label">Contact Number</label>
                        <input type="tel" class="form-control" id="ContactNumber" name="ContactNumber" pattern="[0-9]{11}" inputmode="numeric" value="<?php echo htmlspecialchars($ContactNumber); ?>" maxlength="11" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="department" class="col col-form-label">Department</label>
                        <select class="form-select" id="department" name="department" required>
                            <option value="" disabled <?php echo empty($department) ? 'selected' : ''; ?>>Select</option>
                            <?php
                            // Fetch departments from the database
                            $sql = "SELECT * FROM departments";
                            $result = $connection->query($sql);
                            if (!$result) {
                                die("Invalid Query: " . $connection->error);
                            }
                            // Display each department as an option
                            while ($row = $result->fetch_assoc()) {
                                // Set the selected attribute only if $department matches the current row's name
                                $selected = ($department == $row['name']) ? 'selected' : '';
                                echo "<option value='{$row['name']}' $selected>{$row['name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="branch" class="col col-form-label">Branch</label>
                        <select class="form-select" id="branch" name="branch" required>
                            <option value="" disabled <?php echo empty($branch) ? 'selected' : ''; ?>>Select</option>
                            <?php
                            // Fetch branches from the database
                            $sql = "SELECT * FROM branches";
                            $result = $connection->query($sql);
                            if (!$result) {
                                die("Invalid Query: " . $connection->error);
                            }
                            // Display each branch as an option
                            while ($row = $result->fetch_assoc()) {
                                // Set the selected attribute only if $branch matches the current row's name
                                $selected = ($branch == $row['name']) ? 'selected' : '';
                                echo "<option value='{$row['name']}' $selected>{$row['name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="col col-form-label">Password</label>
                        <div class="input-group">
                            <input type="password" id="password" class="form-control" name="password" pattern="^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$" title="Password must be at least 8 characters long, include one uppercase letter, one number, and one special character." required>
                            <span class="input-group-text" onclick="togglePasswordVisibility('password', 'togglePasswordIcon')" style="cursor: pointer;">
                                <i id="togglePasswordIcon" class="fa fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="confirm_password" class="col col-form-label">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" id="confirm_password" class="form-control" name="confirm_password" pattern="^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$" title="Password must be at least 8 characters long, include one uppercase letter, one number, and one special character." required>
                            <span class="input-group-text" onclick="togglePasswordVisibility('confirm_password', 'toggleConfirmPasswordIcon')" style="cursor: pointer;">
                                <i id="toggleConfirmPasswordIcon" class="fa fa-eye"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function togglePasswordVisibility(passwordFieldId, toggleIconId) {
        var passwordField = document.getElementById(passwordFieldId);
        var toggleIcon = document.getElementById(toggleIconId);
        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }
</script>

<!-- FontAwesome for the eye icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">