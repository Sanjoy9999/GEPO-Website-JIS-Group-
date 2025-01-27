<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "config.php";

$sql = "SELECT * FROM programs";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEPO - Programs Management</title>
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
                <h1>Programs Management</h1>
                <a href="add_program.php" class="btn btn-primary">Add New Program</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Duration</th>
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
                            echo "<td>" . $row['location'] . "</td>";
                            echo "<td>" . $row['duration'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "<td>
                                    <a href='edit_program.php?id=".$row['id']."' class='btn btn-sm btn-primary'>Edit</a>
                                    <a href='delete_program.php?id=".$row['id']."' class='btn btn-sm btn-danger'>Delete</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No programs found</td></tr>";
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