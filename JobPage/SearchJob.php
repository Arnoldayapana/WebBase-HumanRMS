<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Landing Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../public/assets/css/employee/emInfo.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
</head>

<body>
    <style>
        body {
            background-color: #f0f0f0;
            font-family: 'poppins', sans-serif;
        }
    </style>
    <!--Nav-->
    <nav class="navbar navbar-expand-lg navbar-light bg-gradient bg-opacity-75" style="background-color: #003c3c;">
        <div class="container d-flex mb-1">
            <a class="navbar-brand text-white align-text-center fw-bolder fs-5" href="../index.php">
                SEDP Simbag Sa Pag-Asenso Inc.
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Job Listings -->
    <section>
        <div class="container mb-5 mt-2 bg-light">
            <!-- Search Bar and Filter Dropdown -->
            <div class="col mt-3 p-4">
                <form method="GET" action="">
                    <div class="row g-3">
                        <!-- Dropdown for sorting filter -->
                        <div class="col-md-4">
                            <?php
                            $filter = isset($_GET['filter']) ? $_GET['filter'] : ''; // Get the selected filter
                            ?>
                            <select class="form-select" name="filter" onchange="this.form.submit()">
                                <option value="" <?= empty($filter) ? 'selected' : '' ?>>All Jobs</option>
                                <option value="newest" <?= $filter == 'newest' ? 'selected' : '' ?>>Newest</option>
                                <option value="oldest" <?= $filter == 'oldest' ? 'selected' : '' ?>>Oldest</option>
                                <option value="urgent" <?= $filter == 'urgent' ? 'selected' : '' ?>>Urgent Hiring</option>
                            </select>
                        </div>
                        <!-- Search Bar -->
                        <div class="col-md-5 ms-auto">
                            <?php
                            // Keep the search term in the input field after submission
                            $search = isset($_GET['search']) ? $_GET['search'] : '';
                            ?>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search here!" name="search" value="<?= htmlspecialchars($search) ?>">
                                <button class="btn text-white" style="background-color: #003c3c;" type="submit">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row">
                <h1 class="text-center fw-bold fs-3 my-5">Our Company is Currently Looking for the Following:</h1>
            </div>
            <div class="row align-items-center justify-content-center">
                <?php
                // Connection
                include("../Database/db.php");

                // Prepare SQL query based on search and filter
                $sql = "SELECT * FROM job WHERE 1"; // Base query

                // If the user searched for a term, add to the query
                if (!empty($search)) {
                    // Escape the search term to avoid SQL injection
                    $searchTerm = $connection->real_escape_string($search);
                    $sql .= " AND (title LIKE '%$searchTerm%' OR JobDescription LIKE '%$searchTerm%' OR qualification LIKE '%$searchTerm%')";
                }

                // Apply filter for sorting
                if (!empty($filter)) {
                    if ($filter == 'newest') {
                        $sql .= " ORDER BY job_id DESC"; // Sort by newest (job_id in descending order)
                    } elseif ($filter == 'oldest') {
                        $sql .= " ORDER BY job_id ASC"; // Sort by oldest (job_id in ascending order)
                    } elseif ($filter == 'urgent') {
                        // Assuming 'job_type' column exists in the 'job' table and holds the value 'urgent'
                        $sql = "SELECT * FROM job WHERE job_type = 'urgent' ORDER BY job_id DESC"; // Only urgent jobs, sorted by newest
                    }
                } else {
                    // Default sorting by newest if no filter is selected or "All Jobs" is chosen
                    $sql .= " ORDER BY job_id DESC";
                }

                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid Query: " . $connection->error);
                }

                // Display the jobs
                while ($row = $result->fetch_assoc()) {
                    $ViewJobId = "viewApplicantModal" . $row['job_id'];
                    echo "
                    <div class='col-lg-5 mx-2 mb-3'>
                        <div class='card mb-3 shadow'>
                            <div class='card-body'>
                                <h5 class='card-title'><i class='bi bi-briefcase-fill'></i> {$row['title']}</h5>
                                <p class='card-text mx-2'><i class='bi bi-card-checklist'></i> Responsibilities: {$row['JobDescription']}</p>
                                <p class='card-text mx-2'><i class='bi bi-clipboard-check'></i> Requirements: {$row['qualification']}</p>
                                    <div class='d-flex flex-row-reverse'>
                                        <button type='button' class='btn btn-md text-white mx-2' style='background-color: #003c3c;' 
                                            data-bs-toggle='modal' data-bs-target='#JobApplicant' onclick='setJobApplicant({$row['job_id']})'>
                                            Apply
                                        </button>
                                        <button type='button' class='btn btn-info btn-md' data-bs-toggle='modal' 
                                            data-bs-target='#$ViewJobId' onclick='setJobApplicant({$row['job_id']})'>
                                            View
                                        </button>
                                    </div>
                            </div>
                        </div>
                    </div>
                    ";
                    echo "
                    <div class='modal fade' id='$ViewJobId' tabindex='-1' aria-labelledby='viewApplicantLabel' aria-hidden='true'>
                        <div class='modal-dialog modal-lg modal-dialog-centered'> <!-- Increased size of modal -->
                            <div class='modal-content rounded'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='viewApplicantLabel'>Applicant Information</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <div class='modal-body'>
                                    <div class='row'> <!-- Added row for better layout -->
                                        <div class='col-md-6'>
                                            <h6 class='fw-semi-bold fs-5'>Job Title:</h6>
                                            <p class='mx-3'>{$row['title']}</p>
                                        </div>
                                        <div class='col-md-6'>
                                            <h6 class='fw-semi-bold fs-5'>Job Description:</h6>
                                            <p class='mx-3'>{$row['JobDescription']}</p>
                                        </div>
                                        <div class='col-md-6'>
                                            <h6 class='fw-semi-bold fs-5'>Job Qualification:</h6>
                                            <p class='mx-3'>{$row['qualification']}</p>
                                        </div>
                                        <div class='col-md-6'>
                                            <h6 class='fw-semi-bold fs-5'>Job Salary Range:</h6>
                                            <p class='mx-3'>{$row['min_salary']} - {$row['max_salary']}</p> <!-- Fixed salary display -->
                                        </div>
                                        <div class='col-md-6'>
                                            <h6 class='fw-semi-bold fs-5'>Job Designation Location:</h6>
                                            <p class='mx-3'>{$row['branch']}</p>
                                        </div>
                                        <div class='col-md-6'>
                                            <h6 class='fw-semi-bold fs-5'>Job Employment Type:</h6>
                                            <p class='mx-3'>{$row['EmployeeType']}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Modal for Adding Applicants -->
    <?php
    include("./ApplyModal.php");
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>