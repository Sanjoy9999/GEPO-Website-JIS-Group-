<?php
// ...existing code...

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    
    // Check if email exists in the database
    if (empty($email)) {
        echo "Please enter an email address.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "your_database_name";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        // Generate a unique token
        $token = bin2hex(random_bytes(50));
        
        // Store the token in the database with an expiration time
        $query = "UPDATE users SET reset_token='$token', token_expiry=DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email='$email'";
        mysqli_query($conn, $query);
        
        // Send reset password email
        $resetLink = "http://yourwebsite.com/resetpassword.php?token=$token";
        $subject = "Password Reset Request";
        $message = "Click the following link to reset your password: $resetLink";
        $headers = "From: no-reply@yourwebsite.com";
        
        mail($email, $subject, $message, $headers);
        
        echo "A password reset link has been sent to your email.";
    } else {
        echo "No account found with that email.";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GEPO - Login</title>
    <link rel="stylesheet" href="../css_files/styles.css" />
    <link rel="stylesheet" href="../css_files/login.css" />
    <link rel="shortcut icon" href="../assets/images/favicon.ico" />
    <script
      src="https://kit.fontawesome.com/4bd740a6dc.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <header>
      <div class="logo">
        <a href="../index.html">
          <img src="../assets/images/logo.png" alt="JIS Logo" loading="lazy" />
        </a>
      </div>
      <nav id="navBar">
        <ul>
          <li><a href="../index.html">Home</a></li>
          <li><a href="./about.html">About Us</a></li>
          <li>
            <a href="./partnerships.html">Global Partnerships</a>
          </li>
          <li>
            <a href="./programs.html">Programs & Initiatives</a>
          </li>
          <li><a href="./resources.html">Resources & Support</a></li>
          <li><a href="./events.html">Events & News</a></li>
          <li><a href="./contact.html">Contact Us</a></li>
          <li>
            <a href="#" class="active">Login</a>
          </li>
          <li><a href="../admin/admin.html">Admin</a></li>
        </ul>
      </nav>
      <img
        class="hamburger"
        src="../assets/images/svgs/hamburger.svg"
        alt="hamburger"
      />
    </header>

    <main>
      <section class="login-section">
        <div class="login-container">
        <div class="login-header">
            <h2>Welcome to JIS Group</h2>
            <h3 id="login_header">Log in</h3>
          </div>


          <form action="POST" id="loginForm" class="login-form">
            <div class="form-group">
              <label for="email">Enter Your Email</label>
              <input type="email" id="email" name="email" required />
            </div>
            <div class="form-group">
              <label for="password">Enter Your New Password</label>
              <input type="password" id="password" name="password" required />
            </div>
            <div class="form-group">
              <label for="password">Enter Confirm Password</label>
              <input type="password" id="password" name="password" required />
            </div>


            
            <button type="submit" class="cta-button">Log In</button>
          
          </form>


          <div class="login-footer">
            <p>
              Don't have an account?
              <a href="./signup.php" style="color: var(--primary-color); font-weight: bold"
                >Sign Up</a
              >
            </p>
          </div>
        </div>
      </section>
    </main>

    <footer>
      <div class="footer-content">
        <div class="footer-section">
          <h3>Quick Links</h3>
          <ul>
            <li>
              <a href="./html_files/programs.html">Study Abroad Programs</a>
            </li>
            <li>
              <a href="./html_files/programs.html">International Admissions</a>
            </li>
            <li>
              <a href="./html_files/programs.html">Faculty Exchange Programs</a>
            </li>
            <li>
              <a href="./html_files/partnerships.html"
                >Research Collaborations</a
              >
            </li>
            <li>
              <a href="./html_files/events.html"
                >Upcoming International Events</a
              >
            </li>
          </ul>
        </div>
        <div class="footer-section">
          <h3>Contact Us</h3>
          <p>Global Engagement & Partnerships Office</p>
          <p>Email: gepo@jis.edu</p>
          <p>Phone: +1 234 567 8900</p>
        </div>
        <div class="footer-section">
          <h3>Follow Us</h3>
          <div class="social-icons">
            <a href="https://x.com/jisgroupindia" target="_blank"
              ><i class="fab fa-twitter"></i
            ></a>
            <a
              href="https://www.linkedin.com/company/jisgroup/?originalSubdomain=in"
              target="_blank"
              ><i class="fab fa-linkedin"></i
            ></a>
            <a
              href="https://www.facebook.com/JISGroupEducationalInitiatives/"
              target="_blank"
              ><i class="fab fa-facebook"></i
            ></a>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <p>
          &copy; 2025 Global Engagement & Partnerships Office. All rights
          reserved.
        </p>
      </div>
    </footer>

    <script src="../js_files/script.js"></script>
    <script src="../js_files/login.js"></script>
  </body>
</html>
