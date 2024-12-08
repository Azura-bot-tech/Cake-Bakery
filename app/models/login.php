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

        // Kiểm tra trong bảng user
        $sql_user = "SELECT * FROM user WHERE username='$username'";
        $result_user = $conn->query($sql_user);

        // Kiểm tra trong bảng admin
        $sql_admin = "SELECT * FROM admin WHERE username='$username'";
        $result_admin = $conn->query($sql_admin);

        if ($result_user->num_rows > 0) {
            $row = $result_user->fetch_assoc();
            if ($password !== $row['password']) {
                echo "<script>alert('Incorrect username or password.'); window.location.href='login.php';</script>";
                exit();
            } else {
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = 'user'; // Lưu vai trò là user
                echo "<script>alert('Login successful!'); window.location.href='../controller/home.php';</script>";
                exit();
            }
        } elseif ($result_admin->num_rows > 0) {
            $row = $result_admin->fetch_assoc();
            if ($password !== $row['password']) {
                echo "<script>alert('Incorrect username or password.'); window.location.href='login.php';</script>";
                exit();
            } else {
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = 'admin'; // Lưu vai trò là admin
                echo "<script>alert('Admin login successful!'); window.location.href='../controller/home.php';</script>";
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
                    <input type="password" id="register-password" placeholder="Your Password" name="password" />
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.0" stroke="currentColor" width="16" height="16" class="eye eye-open1 hidden">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.0" stroke="currentColor" class="eye eye-close1" width="16" height="16">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                    <label></label>
                </div>
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
                    <input type="password" id="login-password" placeholder="Password" name="password"/>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2,0" stroke="currentColor" width="16" height="16" class="eye eye-open2 hidden">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.0" stroke="currentColor" width="16" height="16" class="eye eye-close2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
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

      const inputPasswordRegister = document.getElementById('register-password');
      const inputPasswordLogin = document.getElementById('login-password');
      const eyeOpen1 = document.querySelector('.eye-open1');
      const eyeClose1 = document.querySelector('.eye-close1');
      const eyeOpen2 = document.querySelector('.eye-open2');
      const eyeClose2 = document.querySelector('.eye-close2');

      eyeOpen1.addEventListener('click', () => {
        eyeOpen1.classList.add('hidden');
        eyeClose1.classList.remove('hidden');
        inputPasswordRegister.setAttribute('type', 'password');
      });

      eyeClose1.addEventListener('click', () => {
        eyeOpen1.classList.remove('hidden');
        eyeClose1.classList.add('hidden');
        inputPasswordRegister.setAttribute('type', 'text');
      });

      overlayBtn.addEventListener('click', () => {
        container.classList.toggle('right-panel-active');

        overlayBtn.classList.remove('btnScaled');
        window.requestAnimationFrame(() => {
          overlayBtn.classList.add('btnScaled');
        });
      });

      eyeOpen2.addEventListener('click', () => {
        eyeOpen2.classList.add('hidden');
        eyeClose2.classList.remove('hidden');
        inputPasswordLogin.setAttribute('type', 'password');
      });

      eyeClose2.addEventListener('click', () => {
        eyeOpen2.classList.remove('hidden');
        eyeClose2.classList.add('hidden');
        inputPasswordLogin.setAttribute('type', 'text');
      });
    </script>

</body>
</html>