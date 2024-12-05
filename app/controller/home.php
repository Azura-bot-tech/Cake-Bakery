<?php 
  include '../../config/config.php'; 
  session_start(); // Bắt đầu session để lấy thông tin người dù
  // Kiểm tra vai trò người dùng
  $is_admin = (isset($_SESSION['role']) && $_SESSION['role'] === 'admin');   
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cake Bakery</title>
    <link rel="shortcut icon" type="image" href="../../image/logo.png" />
    <link rel="stylesheet" href="home.css" />
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
      <?php include $is_admin ? "template/navbar_admin.php" : "template/navbar.php"; ?>
      
      <!-- home section -->
      <div class="home">
        <div class="content" data-aos="zoom-out-right">
          <h3>Delicious <br />Cakes Bakery</h3>
          <h2>Category <span class="changecontent"></span></h2>
          <p>
            Welcome to Our Cake Bakery Shop!
            <br />Enjoy and choose your favorite Cake <br />
            ⬇⬇⬇
          </p>
          <a href="../views/cakes.php" class="btn">Order Now</a>
        </div>
        <div class="img" data-aos="zoom-out-left">
          <img src="../../image/background.png" alt="" />
        </div>
      </div>
      <!-- home section end -->
      <!-- top cards -->
      <div
        class="container"
        id="box"
        data-aos="fade-up"
        data-aos-duration="1500"
      >
        <div class="row">
          <div class="col-md-4 py-3 py-md-0">
            <div class="card">
              <img src="../../image/box1.jpg" alt="" />
            </div>
          </div>
          <div class="col-md-4 py-3 py-md-0">
            <div class="card">
              <img src="../../image/box2.jpg" alt="" />
            </div>
          </div>
          <div class="col-md-4 py-3 py-md-0">
            <div class="card">
              <img src="../../image/box3.jpg" alt="" />
            </div>
          </div>
        </div>
      </div>
      <!-- top cards end -->

      <!-- banner -->
      <div class="banner" data-aos="fade-up" data-aos-duration="1500">
        <div class="content">
          <h3>Delicious Cake</h3>
          <h2>UPTO 50% OFF</h2>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam,
            quod.
          </p>
          <div id="btnorder">
            <button>
              <a
                href="app/views/cakes.php"
                style="text-decoration: none; color: white"
                >Order Now</a
              >
            </button>
          </div>
        </div>
        <div class="img">
          <img src="../../image/banner-background.png" alt="" />
        </div>
      </div>
      <!-- banner end -->

      <!-- gallary -->
      <section id="gallary" data-aos="fade-up" data-aos-duration="1500">
        <div class="container">
          <h1>OUR GALLARY</h1>
          <div class="row" style="margin-top: 30px">
            <div class="col-md-4 py-3 py-md-0">
              <div class="card">
                <div class="overlay">
                  <h3 class="text-center">Donuts</h3>
                </div>
                <img src="../../image/o1.png" alt="" />
              </div>
            </div>
            <div class="col-md-4 py-3 py-md-0">
              <div class="card">
                <div class="overlay">
                  <h3 class="text-center">Ice Cream</h3>
                </div>
                <img src="../../image/o2.png" alt="" />
              </div>
            </div>
            <div class="col-md-4 py-3 py-md-0">
              <div class="card">
                <div class="overlay">
                  <h3 class="text-center">Cup Cake</h3>
                </div>
                <img src="../../image/o3.png" alt="" />
              </div>
            </div>
          </div>

          <div
            class="row"
            style="margin-top: 30px"
            data-aos="fade-up"
            data-aos-duration="1500"
          >
            <div class="col-md-4 py-3 py-md-0">
              <div class="card">
                <div class="overlay">
                  <h3 class="text-center">Delicious Cake</h3>
                </div>
                <img src="../../image/o4.png" alt="" />
              </div>
            </div>
            <div class="col-md-4 py-3 py-md-0">
              <div class="card">
                <div class="overlay">
                  <h3 class="text-center">Chocolate Cake</h3>
                </div>
                <img src="../../image/o5.png" alt="" />
              </div>
            </div>
            <div class="col-md-4 py-3 py-md-0">
              <div class="card">
                <div class="overlay">
                  <h3 class="text-center">Slice Cake</h3>
                </div>
                <img src="../../image/o6.png" alt="" />
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- gallary -->

      
      <?php include "template/footer.php"; ?>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
  </body>
</html>
