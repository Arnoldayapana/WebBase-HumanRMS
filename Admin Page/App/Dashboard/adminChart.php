<?php
include('../../../Database/db.php');

// Helper function to generate all months between two dates
function getAllMonths($startDate, $endDate)
{
    $months = [];
    $current = strtotime($startDate);
    $end = strtotime($endDate);

    while ($current <= $end) {
        $months[] = date('Y-m', $current);
        $current = strtotime('+1 month', $current);
    }

    return $months;
}

// Fetch the earliest application date from both tables
$sql_min_date = "
    SELECT MIN(applied_date) AS min_date FROM (
        SELECT MIN(applied_date) FROM scholar_applicant
        UNION ALL
        SELECT MIN(applied_date) FROM applicants
    ) AS combined_dates";
$result_min_date = $connection->query($sql_min_date);
$min_date_row = $result_min_date->fetch_assoc();
$min_date = $min_date_row['min_date'] ?? date('Y-m-01'); // Default to current month if no data

// Generate all months from the earliest date to the current month
$all_months = getAllMonths($min_date, date('Y-m-01'));

// Initialize arrays to store counts
$scholar_counts = array_fill_keys($all_months, 0);
$job_counts = array_fill_keys($all_months, 0);

// Function to fetch applicant counts by month
function fetchApplicantCounts($connection, $tableName)
{
    $sql = "SELECT DATE_FORMAT(applied_date, '%Y-%m') AS month, COUNT(*) AS count 
            FROM $tableName 
            GROUP BY month";
    return $connection->query($sql);
}

// Store counts for scholar applicants
$result_scholar = fetchApplicantCounts($connection, 'scholar_applicant');
while ($row = $result_scholar->fetch_assoc()) {
    $scholar_counts[$row['month']] = $row['count'];
}

// Store counts for job applicants
$result_job = fetchApplicantCounts($connection, 'applicants');
while ($row = $result_job->fetch_assoc()) {
    $job_counts[$row['month']] = $row['count'];
}

$connection->close();
?>

<!-- Pass PHP data to JavaScript -->
<script>
    const months = <?php echo json_encode($all_months); ?>;
    const scholarCounts = <?php echo json_encode(array_values($scholar_counts)); ?>;
    const jobCounts = <?php echo json_encode(array_values($job_counts)); ?>;
</script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Applicants Line Graph</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="col-6 shadow">
        <canvas id="applicantChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('applicantChart').getContext('2d');
        const applicantChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                        label: 'Scholar Applicants',
                        data: scholarCounts,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.3
                    },
                    {
                        label: 'Job Applicants',
                        data: jobCounts,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Number of Applicants'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>