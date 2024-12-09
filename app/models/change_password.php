<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cake Bakery</title>
    <link rel="shortcut icon" type="image" href="../../image/logo.png" />
    <link rel="stylesheet" href="change_password.css" />
    <!-- bootstrap links -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
      integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
      integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
      crossorigin="anonymous"
    ></script>
    <!-- bootstrap links -->
    <!-- fonts links -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Uchen&display=swap"
      rel="stylesheet"
    />
    <!-- fonts links -->
    <!-- icons links -->
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"
    />
    <!-- icons links -->
    <!-- animation links -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <!-- animation links -->
  </head>
  <body>
    <!-- content -->
    <?php
    // Connect to the database
    include '../../config/config.php';
    // Kiểm tra vai trò người dùng
    $is_admin = (isset($_SESSION['role']) && $_SESSION['role'] === 'admin');  
    // Lấy thông tin tài khoản đang đăng nhập
    $username = $_SESSION['username'];
    
    if (!$is_admin) {
        // Tài khoản là user
        $sql_user = "SELECT full_name, email FROM user WHERE username='$username'";
        $result_user = $conn->query($sql_user);
        $user = $result_user->fetch_assoc();
        $user_type = 'user';
        $full_name = $user['full_name'];
        $email = $user['email'];
    } elseif ($is_admin) {
        // Tài khoản là admin
        $sql_admin = "SELECT full_name, email FROM admin WHERE username='$username'";
        $result_admin = $conn->query($sql_admin);
        $admin = $result_admin->fetch_assoc();
        $user_type = 'admin';
        $full_name = $admin['full_name'];
        $email = $admin['email'];
    } else {
        // Tài khoản không tồn tại
        echo "<script>alert('User not found.'); window.location.href='login.php';</script>";
        exit();
    }
    ?>
    <?php include $is_admin ? "template/navbar_admin.php" : "template/navbar.php"; ?>
    <div id="user" data-aos="fade-up" data-aos-duration="1500">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
        <h2>Your account information:</h2>
        <p>Full name: <?php echo htmlspecialchars($full_name); ?></p>
        <p>Email: <?php echo htmlspecialchars($email); ?></p>
    
        <h3>Change password:</h3>
        <?php
        // Xử lý thay đổi mật khẩu
        if (isset($_POST['change_password'])) {
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];
        
            if ($new_password === $confirm_password) {
                // Xác định bảng cần cập nhật dựa trên loại tài khoản
                $table = ($user_type === 'user') ? 'user' : 'admin';
                $sql_update = "UPDATE $table SET password=? WHERE username=?";
                $stmt = $conn->prepare($sql_update);
                $stmt->bind_param('ss', $new_password, $username);
            
                if ($stmt->execute()) {
                  if ($is_admin) echo "<script>alert('Password changed successfully!'); window.location.href='../controller/admin.php';</script>";
                  elseif (!$is_admin)
                    echo "<script>alert('Password changed successfully!'); window.location.href='../controller/user.php';</script>";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                echo "<script>alert('Passwords do not match!');</script>";
            }
        }
        ?>
    
        <form action="" method="post">
            <input type="password" name="new_password" placeholder="New password" required>
            <input type="password" name="confirm_password" placeholder="Confirm password" required>
            <input type="submit" name="change_password" value="Change password">
        </form>
    </div>
    <!-- content -->

    <?php include "template/footer.php"; ?>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
  </body>
</html>
