<?php
session_start();
require_once "config.php";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Function to get count
function getCount($conn, $table, $condition = '') {
    $sql = "SELECT COUNT(*) as count FROM $table $condition";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
}

// Get counts
$total_partnerships = getCount($conn, 'partnerships');
$active_partnerships = getCount($conn, 'partnerships', "WHERE status = 'Active'");
$total_programs = getCount($conn, 'programs');
$active_programs = getCount($conn, 'programs', "WHERE status = 'Active'");
$total_events = getCount($conn, 'events');
$upcoming_events = getCount($conn, 'events', "WHERE status = 'Upcoming'");
$total_applications = getCount($conn, 'applications');
$pending_applications = getCount($conn, 'applications', "WHERE status = 'Pending'");

// Get application statistics
$sql = "SELECT status, COUNT(*) as count FROM applications GROUP BY status";
$application_stats = mysqli_query($conn, $sql);

// Get program popularity
$sql = "SELECT p.name, COUNT(a.id) as application_count 
        FROM programs p 
        LEFT JOIN applications a ON p.id = a.program_id 
        GROUP BY p.id 
        ORDER BY application_count DESC 
        LIMIT 5";
$program_popularity = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reports</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Reports</h2>
        
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Partnerships</h5>
                        <p class="card-text">Total: <?php echo $total_partnerships; ?></p>
                        <p class="card-text">Active: <?php echo $active_partnerships; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Programs</h5>
                        <p class="card-text">Total: <?php echo $total_programs; ?></p>
                        <p class="card-text">Active: <?php echo $active_programs; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Events</h5>
                        <p class="card-text">Total: <?php echo $total_events; ?></p>
                        <p class="card-text">Upcoming: <?php echo $upcoming_events; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Applications</h5>
                        <p class="card-text">Total: <?php echo $total_applications; ?></p>
                        <p class="card-text">Pending: <?php echo $pending_applications; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <h3>Application Status</h3>
                <canvas id="applicationChart"></canvas>
            </div>
            <div class="col-md-6">
                <h3>Program Popularity</h3>
                <canvas id="programChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Application Status Chart
        var applicationCtx = document.getElementById('applicationChart').getContext('2d');
        var applicationChart = new Chart(applicationCtx, {
            type: 'pie',
            data: {
                labels: [<?php
                    $labels = [];
                    $data = [];
                    mysqli_data_seek($application_stats, 0);
                    while ($row = mysqli_fetch_assoc($application_stats)) {
                        $labels[] = "'" . $row['status'] . "'";
                        $data[] = $row['count'];
                    }
                    echo implode(',', $labels);
                ?>],
                datasets: [{
                    data: [<?php echo implode(',', $data); ?>],
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0']
                }]
            }
        });

        // Program Popularity Chart
        var programCtx = document.getElementById('programChart').getContext('2d');
        var programChart = new Chart(programCtx, {
            type: 'bar',
            data: {
                labels: [<?php
                    $labels = [];
                    $data = [];
                    mysqli_data_seek($program_popularity, 0);
                    while ($row = mysqli_fetch_assoc($program_popularity)) {
                        $labels[] = "'" . $row['name'] . "'";
                        $data[] = $row['application_count'];
                    }
                    echo implode(',', $labels);
                ?>],
                datasets: [{
                    label: 'Number of Applications',
                    data: [<?php echo implode(',', $data); ?>],
                    backgroundColor: '#36A2EB'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>

<?php
mysqli_close($conn);
?>