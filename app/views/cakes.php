<?php 
  session_start(); // Bắt đầu session để lấy thông tin người dùng
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cakes</title>
    <link rel="shortcut icon" type="image" href="../../image/logo.png" />
    <link rel="stylesheet" href="cakes.css" />
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
    <?php include "template/navbar.php"; ?> 

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
                  <button type="button" class="btn btn-secondary" title="Add to Wishlist" onclick="addToWishlist(<?php echo $row['id']; ?>)">
                    <i><img src="../../image/heart.png" alt="" width="30px" /></i>
                  </button>
                  <button type="button" class="btn btn-secondary" title="Add to Cart" onclick="addToCart(<?php echo $row['id']; ?>)">
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
                      <button type="button" class="btn btn-secondary" title="Add to Wishlist" onclick="addToWishlist(<?php echo $row['id']; ?>)">
                        <i><img src="../../image/heart.png" alt="" width="30px" /></i>
                      </button>
                      <button type="button" class="btn btn-secondary" title="Add to Cart" onclick="addToCart(<?php echo $row['id']; ?>)">
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
    <?php include "template/footer.php";?>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>

    <script>
      function addToWishlist(productId) {
        // ... existing code ...
        // New AJAX request to add product to wishlist
        fetch('../models/add_to_wishlist.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({ id: productId }),
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert('Product added to wishlist!');
          } else {
            alert('Failed to add to wishlist.');
          }
        })
        .catch((error) => {
          console.error('Error:', error);
        });
      }

      function addToCart(productId) {
        // ... existing code ...
        // New AJAX request to add product to wishlist
        fetch('../models/add_to_cart.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({ id: productId }),
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert('Product added to cart!');
          } else {
            alert('Failed to add to cart.');
          }
        })
        .catch((error) => {
          console.error('Error:', error);
        });
      }
    </script>
    
  </body>
</html>
