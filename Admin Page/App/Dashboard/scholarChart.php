<?php
include('../../../Database/db.php');

// Fetch employee names and active days
$sql = "SELECT username, DATEDIFF(CURDATE(), hire_date) AS active_days FROM employees";
$result = $connection->query($sql);

$username = [];
$active_days = [];

// Loop through the result and store the data in arrays
while ($row = $result->fetch_assoc()) {
    $username[] = $row['username'];
    $active_days[] = $row['active_days'];
}

$connection->close();
?>

<!-- Pass PHP data to JavaScript -->
<script>
    const employeeNames = <?php echo json_encode($username); ?>;
    const activeDays = <?php echo json_encode($active_days); ?>;
</script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Active Days Line Graph</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="col-sm-6 mb-3 col-lg-3 col-md-6" style="width: 50%; margin: auto;">
        <div class="card border-0 shadow-sm">
            <canvas id="activeDaysChart"></canvas>
        </div>
    </div>
    <style>
        #activeDaysChart {
            max-width: 800px;
            height: auto;
        }
    </style>

    <script>
        // Create the line chart
        const ctx = document.getElementById('activeDaysChart').getContext('2d');
        const activeDaysChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: employeeNames, // X-axis labels (employee names)
                datasets: [{
                    label: 'Active Days',
                    data: activeDays, // Y-axis data (active days)
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgb(0, 178, 178)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }]
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
                            text: 'Employee Names'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Active Days'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>