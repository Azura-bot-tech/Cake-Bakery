<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cakes</title>
    <link rel="shortcut icon" type="image" href="../image/logo.png" />
    <link rel="stylesheet" href="./cakes.css" />
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
    <div class="all-content">
      <!-- navbar -->
      <nav class="navbar navbar-expand-md" id="navbar">
        <div class="container-fluid">
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <!-- Brand -->
          <a class="navbar-brand" href="../../index.html" id="logo"
            ><img src="../../image/logo.png" alt="" width="50px" />Cake Bakery</a
          >

          <!-- Toggler/collapsibe Button -->
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#collapsibleNavbar"
          >
            <span><img src="../../image/menu.png" alt="" width="30px" /></span>
          </button>

          <!-- Navbar links -->
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="../../index.html">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cakes.php">Cakes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Galary</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.html">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact</a>
              </li>
            </ul>
            <form class="d-flex">
              <input
                class="form-control me-2"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
              <button class="btn text-white" type="submit">Search</button>
            </form>
          </div>
          <!-- icons -->
          <div class="icons">
            <img src="../../image/user.png" alt="" width="20px" />
            <img src="../../image/heart.png" alt="" width="20px" />
            <img src="../../image/add.png" alt="" width="24px" />
          </div>
          <!-- icons -->
        </div>
      </nav>
      <!-- navbar end -->

      <!-- product cards -->
      <?php
        include '../../config/config.php';

        // Fetch products from the database
        $sql = "SELECT * FROM product WHERE distribution = 'Cakes'";
        $result = $conn->query($sql);
      ?>

      <section id="product-cards" data-aos="fade-up" data-aos-duration="1500">
        <div class="container">
          <h1>CAKES</h1>
          <div class="row" style="margin-top: 50px" data-aos="fade-up" data-aos-duration="1500">
            <?php
              if ($result->num_rows > 0) {
              // Output data of each row
                while($row = $result->fetch_assoc()) {
                // Display each product
            ?>
            <div class="col-md-3 py-3 py-md-0" style="margin-bottom: 20px">
              <div class="card">
                <div class="overlay">
                  <button type="button" class="btn btn-secondary" title="Quick View">
                    <i><img src="../../image/views.png" alt="" width="30px" /></i>
                  </button>
                  <button type="button" class="btn btn-secondary" title="Add to Wishlist">
                    <i><img src="../../image/heart.png" alt="" width="30px" /></i>
                  </button>
                  <button type="button" class="btn btn-secondary" title="Add to Cart">
                    <i><img src="../../image/add.png" alt="" width="30px" /></i>
                  </button>
                </div>
                <img src="<?php echo $row['image_url']; ?>" alt="" />
                <div class="card-body">
                  <h3><?php echo $row['name']; ?></h3>
                  <div class="star">
                    <!-- Assuming you want to display stars based on some rating logic -->
                    <?php $randomStars = rand(1, 5); for ($i = 5; $i >= 0; $i--): ?>
                      <i class="bx bxs-star <?php echo ($i >= 6 - $randomStars) ? 'checked' : ''; ?>"></i>
                    <?php endfor; ?>
                </div>
                <p><?php echo $row['description']; ?></p>
                <h6>
                  Price: $<?php echo number_format($row['price'], 2); ?> <span><button>Add Cart</button></span>
                </h6>
              </div>
            </div>
          </div>
          <?php
              }
            } else {
              echo "No products found.";
            }
            $conn->close();
          ?>  
        </div>
      </section>
      
      <?php
        include '../../config/config.php';

        // Fetch products from the database
        $sql = "SELECT * FROM product WHERE distribution = 'Birthday Cakes'";
        $result = $conn->query($sql);
      ?>
      
      <!-- birthday cake cards -->
      <section id="product-cards" data-aos="fade-up" data-aos-duration="1500">
        <div class="container">
          <h1>BIRTHDAY CAKES</h1>
            <div class="row" style="margin-top: 50px">
              <?php
                if ($result->num_rows > 0) {
                  // Output data of each row
                  while($row = $result->fetch_assoc()) {
                  // Display each product
                ?>
                <div class="col-md-3 py-3 py-md-0" style="margin-bottom: 20px">
                  <div class="card">
                    <div class="overlay">
                      <button type="button" class="btn btn-secondary" title="Quick View">
                        <i><img src="../../image/views.png" alt="" width="30px" /></i>
                      </button>
                      <button type="button" class="btn btn-secondary" title="Add to Wishlist">
                        <i><img src="../../image/heart.png" alt="" width="30px" /></i>
                      </button>
                      <button type="button" class="btn btn-secondary" title="Add to Cart">
                        <i><img src="../../image/add.png" alt="" width="30px" /></i>
                      </button>
                    </div>
                    <img src="<?php echo $row['image_url']; ?>" alt="" />
                    <div class="card-body">
                      <h3><?php echo $row['name']; ?></h3>
                      <div class="star">
                        <!-- Assuming you want to display stars based on some rating logic -->
                        <?php $randomStars = rand(1, 5); for ($i = 5; $i >= 0; $i--): ?>
                          <i class="bx bxs-star <?php echo ($i >= 6 - $randomStars) ? 'checked' : ''; ?>"></i>
                        <?php endfor; ?>
                    </div>
                    <p><?php echo $row['description']; ?></p>
                    <h6>
                      Price: $<?php echo number_format($row['price'], 2); ?> <span><button>Add Cart</button></span>
                    </h6>
                  </div>
                </div>
              </div>
              <?php
                  }
                } else {
                  echo "No products found.";
                }
                $conn->close();
              ?>
          </div>
        </div>
      </section>

      <!-- product cards end-->

      <!-- footer -->
      <footer id="footer" data-aos="fade-up" data-aos-duration="1500">
        <h1 class="text-center">Cake Bakery</h1>
        <p class="text-center">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae,
          accusantium.
        </p>
        <div class="icons text-center">
          <i class="bx bxl-twitter"></i>
          <i class="bx bxl-facebook"></i>
          <i class="bx bxl-google"></i>
          <i class="bx bxl-skype"></i>
          <i class="bx bxl-instagram"></i>
        </div>
        <div class="copyright text-center">
          &copy; Copyright <strong>Cake Bakery</strong> .All Rights Reserved
        </div>
        <div class="credite text-center">
          Designed By
          <a href="https://oisp.hcmut.edu.vn/en/"
            ><span>HO CHI MINH UNIVERSITY OF SCIENCE AND TECHNOLOGY</span></a
          >
        </div>
      </footer>
      <!-- footer -->
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
  </body>
</html>
