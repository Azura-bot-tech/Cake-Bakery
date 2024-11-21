<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in || Sign up</title>
     <!-- font awesome icons -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css stylesheet -->
    <link rel="stylesheet" href="login.css">
</head>
<body>
  <?php include '../../config/config.php';

  session_start();

  // Xử lý đăng ký
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if (empty($full_name) || empty($username) || empty($password) || empty($email)) {
        echo "<script>alert('Please fill in all fields.'); window.location.href='login.php';</script>";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.'); window.location.href='login.php';</script>";
        exit();
    }

    $sql = "INSERT INTO user (full_name, username, password, email) VALUES ('$full_name', '$username', '$password', '$email')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['username'] = $row['username'];
        echo "<script>alert('Registration successful!'); window.location.href='../controller/home.php';</script>";
        exit();
    } else {
        echo "<script>alert('Registration failed. Please try again.'); window.location.href='login.php';</script>";
        exit();
    }
  }

  // Xử lý đăng nhập
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password !== $row['password']) {
            echo "<script>alert('Incorrect username or password.'); window.location.href='login.php';</script>";
            exit();
        } else {
            $_SESSION['username'] = $row['username'];
            echo "<script>alert('Login successful!'); window.location.href='../controller/home.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('User not found.'); window.location.href='login.php';</script>";
        exit();
    }
  }
  ?>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="#" method="POST">
                <h1>Create Account</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registration</span>
                <div class="infield">
                    <input type="text" placeholder="Enter your full name" name="full_name"/>
                    <label></label>
                </div>
                <div class="infield">
                    <input type="text" placeholder="Your Username" name="username"/>
                    <label></label>
                </div>
                <div class="infield">
                    <input type="email" placeholder="Your Email" name="email"/>
                    <label></label>
                </div>
                <div class="infield">
                    <input type="password" placeholder="Your Password" name="password" id="password"/>
                    <label></label>
                </div>
                <span id="show-password" onclick="togglePassword()"><i class="fas fa-eye"></i></span>
                <button type="submit" name="register">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="#" method="POST">
                <h1>Sign in</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your account</span>
                <div class="infield">
                    <input type="text" placeholder="Username" name="username"/>
                    <label></label>
                </div>
                <div class="infield">
                    <input type="password" placeholder="Password" name="password" id="password-login"/>
                    <span id="show-password-login" onclick="togglePasswordLogin()"><i class="fas fa-eye"></i></span>
                    <label></label>
                </div>
                <a href="#" class="forgot">Forgot your password?</a>
                <button type="submit" name="login">Sign In</button>
            </form>
        </div>
        <div class="overlay-container" id="overlayCon">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button>Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Welcome to our Cake Bakery! Hope you enjoy your time here.</p>
                    <button>Sign Up</button>
                </div>
            </div>
            <button id="overlayBtn"></button>
        </div>
    </div>
    
    <!-- js code -->
    <script>
      const container = document.getElementById('container');
      const overlayBtn = document.getElementById('overlayBtn');
      const overlayCon = document.getElementById('overlayCon');

      overlayBtn.addEventListener('click', () => {
        container.classList.toggle('right-panel-active');

        overlayBtn.classList.remove('btnScaled');
        window.requestAnimationFrame(() => {
          overlayBtn.classList.add('btnScaled');
        });
      });


    </script>

</body>
</html>