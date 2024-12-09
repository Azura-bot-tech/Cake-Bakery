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
          <?php if (!isset($_SESSION['username'])): ?>
            <a class="navbar-brand" href="../../../index.php" id="logo"
              ><img src="../../../image/logo.png" alt="" width="50px" />Cake Bakery</a
          >
          <?php else: ?>
            <a class="navbar-brand" href="../controller/home.php" id="logo"
              ><img src="../../../image/logo.png" alt="" width="50px" />Cake Bakery</a
          >
          <?php endif; ?>

          <!-- Toggler/collapsibe Button -->
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#collapsibleNavbar"
          >
            <span><img src="../../../image/menu.png" alt="" width="30px" /></span>
          </button>

          <!-- Navbar links -->
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="nav-item">
                <?php if (!isset($_SESSION['username'])): ?>
                    <a class="nav-link" href="../../../index.php">Home</a>
                <?php else: ?>
                    <a class="nav-link" href="../controller/home.php">Home</a>
                <?php endif; ?>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cakes.php">Cakes</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" href="#">Galary</a>
              </li> -->
              <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
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
            <?php 
            if (!isset($_SESSION['username'])): ?>
                <a href="../models/login.php"><img src="../../../image/user.png" alt="" width="20px" /></a>
            <?php else: ?>
                <a href="../controller/user.php"><img src="../../../image/user.png" alt="" width="20px" /></a>
            <?php endif; ?>

            <?php if (!isset($_SESSION['username'])): ?>
                <a href="../models/login.php"><img src="../../../image/heart.png" alt="" width="20px" /></a>
            <?php else: ?>
                <a href="../controller/wishlist.php"><img src="../../../image/heart.png" alt="" width="20px" /></a>
            <?php endif; ?>
            <img src="../../../image/add.png" alt="" width="24px" />
          </div>
          <!-- icons -->
        </div>
      </nav>
      <!-- navbar end -->