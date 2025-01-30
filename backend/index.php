
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Connection</title>
</head>
<body style="text-align: center;">
    <h1>Welcome to Our Website</h1>
    <p >
        <?php
            // Include the database connection script
            include 'config.php';  // Adjust the path based on your folder structure
            echo "Connected successfully to the database.";
        ?>
    </p>
</body>
</html>
