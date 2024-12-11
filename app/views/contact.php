<?php 
  session_start(); // Bắt đầu session để lấy thông tin người dùng
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact</title>
    <link rel="shortcut icon" type="image" href="../../image/logo.png" />
    <link rel="stylesheet" href="contact.css" />
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
    <?php include "template/navbar.php";?>
      <!-- contact  -->

      <?php
        include "../../config/config.php";

        // Kiểm tra xem form đã được gửi hay chưa
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $message = $_POST['message'];

            if (empty($name) || empty($email) || empty($phone) || empty($message)) {
                echo "<script>alert('Please fill in all fields.'); window.location.href='contact.php';</script>";
                exit();
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<script>alert('Invalid email format.'); window.location.href='contact.php';</script>";
                exit();
            }

            // Thực hiện câu lệnh INSERT
            $sql = "INSERT INTO contact_message (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Message sent successfully!'); window.location.href='contact.php';</script>";
                exit();
            } else {
                echo "<script>alert('Error sending message.'); window.location.href='contact.php';</script>"; 
                exit();
            }
        }
      ?>
      <div
        class="container"   
        id="contact"
        data-aos="fade-up"
        data-aos-duration="1500"
      >
        <h1>CONTACT US</h1>
        <form method="POST" action="contact.php">
          <div class="row">
            <div class="col-md-4 py-1 py-md-0">
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  id="usr"
                  name="name" 
                  placeholder="Name"
                />
              </div>
            </div>
            <div class="col-md-4 py-1 py-md-0">
              <div class="form-group">
                <input
                  type="email"
                  class="form-control"
                  id="eml"
                  name="email"
                  placeholder="Email"
                />
              </div>
            </div>
            <div class="col-md-4 py-1 py-md-0">
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  id="phn"
                  name="phone" 
                  placeholder="Phone"
                />
              </div>
            </div>
          </div>
          <div class="form-group">
            <textarea
              class="form-control"
              rows="5"
              id="comment"
              name="message" 
              placeholder="Message"
            ></textarea>
          </div>
          <div id="messagebtn"><button type="submit" name="send_message">Send Message</button></div>
        </form>
      </div>
      <!-- contact end -->
    
    <?php include "template/footer.php";?>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
  </body>
</html>
