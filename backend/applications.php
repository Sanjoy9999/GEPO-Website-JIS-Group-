<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "config.php";

$sql = "SELECT a.*, p.name as program_name FROM applications a LEFT JOIN programs p ON a.program_id = p.id";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEPO - Applications Management</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="admin-styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</head>
<body>
    <header>
        <!-- Header content -->
    </header>

    <div class="admin-container">
        <aside class="admin-sidebar">
            <!-- Sidebar content -->
        </aside>
        <main class="admin-content">
            <div class="admin-header">
                <h1>Applications Management</h1>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Applicant Name</th>
                        <th>Program</th>
                        <th>Status</th>
                        <th>Submitted At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['applicant_name'] . "</td>";
                            echo "<td>" . $row['program_name'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "<td>" . $row['submitted_at'] . "</td>";
                            echo "<td>
                                    <a href='view_application.php?id=".$row['id']."' class='btn btn-sm btn-primary'>View</a>
                                    <a href='update_application_status.php?id=".$row['id']."' class='btn btn-sm btn-warning'>Update Status</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No applications found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </main>
    </div>

    <footer>
        <!-- Footer content -->
    </footer>
</body>
</html>

<?php
mysqli_close($conn);
?>