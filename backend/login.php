

<!-- write login logic of the user here follow by sign up login
 if email id and password match to student  table so we will say that It is student 
  if email id and password match to faculty  table so we will say that It is faculty
  if email id and password match to international_partner  table so we will say that It is international_partner
  if email id and password match to admin  table so we will say that It is admin
   -->
  <?php
  session_start();
  require_once "config.php";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $roles = ['student', 'faculty', 'international_partner', 'admin'];
    $user_role = null;

    foreach ($roles as $role) {
      $sql = "SELECT id, email, password FROM $role WHERE email = ?";
      
      if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_email);
        $param_email = $email;
        
        if (mysqli_stmt_execute($stmt)) {
          mysqli_stmt_store_result($stmt);
          
          if (mysqli_stmt_num_rows($stmt) == 1) {
            mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
            if (mysqli_stmt_fetch($stmt)) {
              if (password_verify($password, $hashed_password)) {
                $user_role = $role;
                break;
              }
            }
          }
        }
        mysqli_stmt_close($stmt);
      }
    }

    if ($user_role) {
      $_SESSION["loggedin"] = true;
      $_SESSION["id"] = $id;
      $_SESSION["email"] = $email;
      $_SESSION["role"] = $user_role;

      switch ($user_role) {
        case 'student':
          header("location: student_dashboard.php");
          break;
        case 'faculty':
          header("location: faculty_dashboard.php");
          break;
        case 'international_partner':
          header("location: partner_dashboard.php");
          break;
        case 'admin':
          header("location: admin_dashboard.php");
          break;
      }
    } else {
      echo "Invalid email or password.";
    }

    mysqli_close($conn);
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


          <form  action="" method="POST"  id="loginForm" class="login-form">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" required />
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" name="password" required />
            </div>
            <button type="submit" class="cta-button" name="submit" value="login" >Log In</button>
            <div class="forgot-password">
              <a href="forgot_password.php">Forgot Password?</a>
            </div>
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




 <?php
// session_start();
// require_once "config.php";

// if($_SERVER["REQUEST_METHOD"] == "POST"){
//     $username = trim($_POST["username"]);
//     $password = trim($_POST["password"]);
    
//     $sql = "SELECT id, username, password FROM users WHERE username = ?";
    
//     if($stmt = mysqli_prepare($conn, $sql)){
//         mysqli_stmt_bind_param($stmt, "s", $param_username);
//         $param_username = $username;
        
//         if(mysqli_stmt_execute($stmt)){
//             mysqli_stmt_store_result($stmt);
            
//             if(mysqli_stmt_num_rows($stmt) == 1){
//                 mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
//                 if(mysqli_stmt_fetch($stmt)){
//                     if(password_verify($password, $hashed_password)){
//                         session_start();
                        
//                         $_SESSION["loggedin"] = true;
//                         $_SESSION["id"] = $id;
//                         $_SESSION["username"] = $username;
                        
//                         header("location: admin.php");
//                     } else{
//                         $login_err = "Invalid username or password.";
//                     }
//                 }
//             } else{
//                 $login_err = "Invalid username or password.";
//             }
//         } else{
//             echo "Oops! Something went wrong. Please try again later.";
//         }

//         mysqli_stmt_close($stmt);
//     }
    
//     mysqli_close($conn);
// }
?>



