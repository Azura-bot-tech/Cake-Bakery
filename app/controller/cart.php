<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cart</title>
    <link rel="shortcut icon" type="image" href="../../image/logo.png" />
    <link rel="stylesheet" href="cart.css" />
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

      <?php
      include '../../config/config.php';
      $username = $_SESSION['username'];

      $sqlCart = "SELECT * FROM cart WHERE username = '$username'";
      $resultCart = $conn->query($sqlCart);
      $totalPrice = 0; // Initialize totalPrice before using it

      if (isset($_POST['checkout'])) {
          $username = $_SESSION['username'];
          $sqlCart = "SELECT * FROM cart WHERE username = '$username'";
          $resultCart = $conn->query($sqlCart);

          if (mysqli_num_rows($resultCart) > 0) {
              while ($cart = mysqli_fetch_assoc($resultCart)) {
                  $productId = $cart['product_id'];
                  $sqlOrder = "INSERT INTO order_history (product_id, username) VALUES ('$productId', '$username')";
                  $conn->query($sqlOrder);
              }
              // Optionally, clear the cart after successful order
              $conn->query("DELETE FROM cart WHERE username = '$username'");
              echo "<script>window.location.href = '../models/payment.php';</script>";
              exit();
          }
      }
      ?>

      <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>

      <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Tên Sản Phẩm</th>
            <th>Mô Tả</th>
            <th>Giá</th>
            <th>Loại</th>
            <th>Thời Gian</th>
            <th></th>
        </tr>

        <?php if (mysqli_num_rows($resultCart) > 0): ?>
            <?php while ($cart = mysqli_fetch_assoc($resultCart)): 
                $productId = $cart['product_id'];
                $time = $cart['created_at'];
                $sqlProduct = "SELECT * FROM product WHERE id = '$productId'";
                $resultProduct = $conn->query($sqlProduct);
                $rowProduct = $resultProduct->fetch_assoc();
                $totalPrice += $rowProduct['price'];
                ?>
            <tr>
                <td><?= $rowProduct['name'] ?></td>
                <td><?= $rowProduct['description'] ?></td>
                <td><?= $rowProduct['price'] ?></td>
                <td><?= $rowProduct['distribution'] ?></td>
                <td><?= $time ?></td>
                <td>
                    <a href="../models/delete_cart.php?id=<?= $cart['id'] ?>" class="edit-btn">Xóa</a>
                </td>
            </tr>
        <?php endwhile; ?>
        <?php
        $_SESSION['totalPrice'] = $totalPrice;
        ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Không tìm thấy sản phẩm nào!</td>
            </tr>
        <?php endif; ?>

        <tr>
            <th colspan="5">Tổng Cộng: <?= $totalPrice ?></th>
            <th>
                <form method="POST">
                    <button type="submit" name="checkout" class="edit-btn">Thanh Toán</button>
                </form>
            </th>
        </tr>
      </table>  

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
  </body>
</html>