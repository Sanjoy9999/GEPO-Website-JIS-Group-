<?php
session_start();

include 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);


if (isset($_POST['submit'])) {
    $required_fields = ['user_type', 'username', 'country', 'mobile_no', 'email', 'password', 'confirm_password'];
    
    foreach ($required_fields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            die("All fields are required!");
        }
    }

    $user_type = $_POST['user_type'];
    $username = htmlspecialchars($_POST['username']);
    $country = htmlspecialchars($_POST['country']);
    $mobile_no = preg_replace('/[^0-9]/', '', $_POST['mobile_no']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $confirm_hashed_password = password_hash($_POST['confirm_password'], PASSWORD_DEFAULT);

   


// Validate password match
if ($password !== $confirm_password) {
  die("Passwords do not match!");
 }

    // Use prepared statements
    // for student
    if ($user_type === 'student') {
        $stmt = $conn->prepare("INSERT INTO student ( name, country,mobile_no, email, password, confirm_password) VALUES ( ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $username, $country, $mobile_no, $email, $hashed_password, $confirm_hashed_password);
        if ($stmt->execute()) {
          header("Location: login.php"); // Redirect to login
          exit();
      } else {
          $error_message = "Student registration failed: " . $stmt->error;
      }
        $stmt->close();
    }
      // for faculty
    else if($user_type === 'faculty'){
        $stmt = $conn->prepare("INSERT INTO faculty ( name, country, contact_number, email, password, confirm_password) VALUES ( ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $username, $country, $mobile_no, $email, $hashed_password, $confirm_hashed_password);
        if ($stmt->execute()) {
          header("Location: login.php"); 
          exit();
      } else {
          $error_message = "Faculty registration failed: " . $stmt->error;
      }
        $stmt->close();
    } 
    // for international partner
    else if($user_type === 'international_partner'){
        $stmt = $conn->prepare("INSERT INTO international_partner ( name, country, contact_number, email, password, confirm_password) VALUES ( ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $username, $country, $mobile_no, $email, $hashed_password, $confirm_hashed_password);
        if ($stmt->execute()) {
          header("Location: login.php");  // Redirect to login
          exit();
      } else {
          $error_message = "International partner registration failed: " . $stmt->error;
      }
        $stmt->close();
     
    }
    else {
      $error_message = "Invalid user type!";
  }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GEPO - Sign Up</title>
    <link rel="stylesheet" href="../css_files/styles.css" />
    <link rel="stylesheet" href="../css_files/login.css" />
    <link rel="stylesheet" href="../css_files/signup.css" />
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

        <div class="signup-section">
          <div class="signup-container">
            <div class="signup-header">
              <h2>Welcome to JIS Group</h2>
              <h3 id="signup_header">Sign up</h3>


              <?php if (isset($success_message)): ?>
               <div class="alert success"><?= $success_message ?></div>
             <?php endif; ?>   

             
            </div>

        <form action="./signup.php" method="POST" id="signupForm" class="signup-form">

            <select name="user_type" id="user_type" required>
                <option value="student" name="student" >Student</option>
                <option value="faculty"name="faculty" >Faculty</option>
                <option value="international_partner" name="international_partner" >International Partner</option>
            </select>

            <div class="form-group">
                <label for="username">Your Name:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
              <label for="country">Country</label>
              <input type="country" id="country" name="country" required>
            </div>

            <div class="form-group">
                <label for="mobile_no">Mobile no</label>
                <input type="tel" id="mobile_no" name="mobile_no" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required>
    
<button type="submit" class="cta-button" name="submit" value="signup">Sign Up</button>
   
    
    <div class="signup-footer">
        <p>
          Already have an account?
          <a href="login.php" style="color: var(--primary-color); font-weight: bold"
            >Log in</a
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
<script src="../js_files/signup.js"></script>

</body>
</html>


