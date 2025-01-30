<?php
session_start();
require_once "config.php";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$message = '';

// Update password
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_password'])) {
    $new_password = trim($_POST["new_password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    if($new_password != $confirm_password){
        $message = "The two passwords do not match.";
    } else {
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "si", $param_password, $_SESSION["id"]);
            if(mysqli_stmt_execute($stmt)){
                $message = "Password updated successfully.";
            } else {
                $message = "Error updating password.";
            }
            mysqli_stmt_close($stmt);
        }
    }
}

// Update email
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_email'])) {
    $new_email = trim($_POST["new_email"]);

    $sql = "UPDATE users SET email = ? WHERE id = ?";
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "si", $new_email, $_SESSION["id"]);
        if(mysqli_stmt_execute($stmt)){
            $message = "Email updated successfully.";
        } else {
            $message = "Error updating email.";
        }
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Settings</h2>
        <?php if(!empty($message)): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <div class="row">
            <div class="col-md-6">
                <h3>Change Password</h3>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="new_password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>
                    <input type="submit" name="update_password" class="btn btn-primary" value="Update Password">
                </form>
            </div>
            <div class="col-md-6">
                <h3>Update Email</h3>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>New Email</label>
                        <input type="email" name="new_email" class="form-control" required>
                    </div>
                    <input type="submit" name="update_email" class="btn btn-primary" value="Update Email">
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>