                    <!-- File Upload Input -->
                    <div class="form-group mb-3">
                        <label for="inputGroupFile04" class="form-label">Upload Resume (PDF)</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="resume" aria-describedby="inputGroupFileAddon04" accept=".pdf" aria-label="Upload" required>
                        </div>
                    </div>
                    enctype="multipart/form-data"


                    <!-- Department Filter -->
                    <div class="col-4">
                        <div class="mx-3 ">
                            <form action="" method="GET">
                                <div class="form-group d-flex">
                                    <?php
                                    // Get selected department from the query string
                                    $selectedDepartment = isset($_GET['department']) ? $_GET['department'] : '';
                                    ?>
                                    <select class="form-select" name="department" onchange="this.form.submit()">
                                        <option value="" disabled <?php echo empty($selectedDepartment) ? 'selected' : ''; ?>>
                                            Select a Department
                                        </option>
                                        <?php
                                        // Fetch departments and order them alphabetically
                                        $sql = "SELECT * FROM departments ORDER BY name ASC";
                                        $result = $connection->query($sql);

                                        if (!$result) {
                                            die("Invalid Query: " . $connection->error);
                                        }

                                        // Display departments and maintain selected one
                                        while ($row = $result->fetch_assoc()) {
                                            echo "";
                                        }
                                        ?>
                                    </select>

                                    <!-- Reset Button -->
                                    <button type="button" class="btn btn-primary ms-2" onclick="resetFilter()">
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>


                    <script>
                        // JavaScript to reset the department and search filter
                        function resetFilter() {
                            // Clear the search and department fields
                            const url = new URL(window.location.href);
                            url.searchParams.delete('search');
                            url.searchParams.delete('department');
                            window.location.href = url.toString();
                        }
                    </script>