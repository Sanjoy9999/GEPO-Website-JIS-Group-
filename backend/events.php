<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "config.php";

$sql = "SELECT * FROM events";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEPO - Events Management</title>
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
                <h1>Events Management</h1>
                <a href="add_event.php" class="btn btn-primary">Add New Event</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['date'] . "</td>";
                            echo "<td>" . $row['location'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "<td>
                                    <a href='edit_event.php?id=".$row['id']."' class='btn btn-sm btn-primary'>Edit</a>
                                    <a href='delete_event.php?id=".$row['id']."' class='btn btn-sm btn-danger'>Delete</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No events found</td></tr>";
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