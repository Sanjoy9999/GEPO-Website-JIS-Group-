<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "config.php";

// Fetch counts for dashboard
$sql_partnerships = "SELECT COUNT(*) as count FROM partnerships WHERE status = 'Active'";
$sql_programs = "SELECT COUNT(*) as count FROM programs WHERE status = 'Active'";
$sql_events = "SELECT COUNT(*) as count FROM events WHERE status = 'Upcoming'";
$sql_applications = "SELECT COUNT(*) as count FROM applications WHERE status = 'Pending'";

$active_partnerships = $ongoing_programs = $upcoming_events = $pending_applications = 0;

if($result = mysqli_query($conn, $sql_partnerships)){
    if($row = mysqli_fetch_assoc($result)){
        $active_partnerships = $row['count'];
    }
    mysqli_free_result($result);
}

if($result = mysqli_query($conn, $sql_programs)){
    if($row = mysqli_fetch_assoc($result)){
        $ongoing_programs = $row['count'];
    }
    mysqli_free_result($result);
}

if($result = mysqli_query($conn, $sql_events)){
    if($row = mysqli_fetch_assoc($result)){
        $upcoming_events = $row['count'];
    }
    mysqli_free_result($result);
}

if($result = mysqli_query($conn, $sql_applications)){
    if($row = mysqli_fetch_assoc($result)){
        $pending_applications = $row['count'];
    }
    mysqli_free_result($result);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEPO - Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="admin-styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header>
        <!-- Header content -->
    </header>

    <div class="admin-container">
        <aside class="admin-sidebar">
            <h2>Admin Portal</h2>
            <ul>
                <li><a href="admin.php" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="partnerships.php"><i class="fas fa-handshake"></i> Partnerships</a></li>
                <li><a href="programs.php"><i class="fas fa-graduation-cap"></i> Programs</a></li>
                <li><a href="events.php"><i class="fas fa-calendar-alt"></i> Events</a></li>
                <li><a href="applications.php"><i class="fas fa-file-alt"></i> Applications</a></li>
                <li><a href="reports.php"><i class="fas fa-chart-bar"></i> Reports</a></li>
                <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
            </ul>
        </aside>
        <main class="admin-content">
            <div class="admin-header">
                <h1>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></h1>
                <a href="logout.php" class="btn btn-danger ml-3">Sign Out</a>
            </div>
            <div class="admin-stats">
                <div class="stat-card">
                    <h3>Active Partnerships</h3>
                    <p><?php echo $active_partnerships; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Ongoing Programs</h3>
                    <p><?php echo $ongoing_programs; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Upcoming Events</h3>
                    <p><?php echo $upcoming_events; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Pending Applications</h3>
                    <p><?php echo $pending_applications; ?></p>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="applicationsChart"></canvas>
            </div>
        </main>
    </div>

    <footer>
        <!-- Footer content -->
    </footer>

    <script src="admin-script.js"></script>
</body>
</html>