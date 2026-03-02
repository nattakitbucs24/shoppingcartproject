<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$cartCount = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">

    <a class="navbar-brand" href="<?php echo $base_url; ?>/index.php">
      <img src="<?php echo $base_url; ?>/assets/images/ninja_logo.png" height="40">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">

      <!-- Left menu -->
      <ul class="navbar-nav me-auto">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
            Product List
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?php echo $base_url; ?>/Product/product_list.php">All Products</a></li>
            <li><a class="dropdown-item" href="<?php echo $base_url; ?>/Product/product_pc.php">PC</a></li>
            <li><a class="dropdown-item" href="<?php echo $base_url; ?>/Product/product_console.php">Console</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="<?php echo $base_url; ?>/Product/product_other.php">Other</a></li>
          </ul>
        </li>

      </ul>

      <!-- Search -->
      <form class="d-flex me-3" method="GET" action="<?php echo $base_url; ?>/search.php">
        <input class="form-control me-2" type="search" name="keyword" placeholder="Search">
        <button class="btn btn-outline-light" type="submit">Search</button>
      </form>

      <!-- Right menu -->
      <ul class="navbar-nav ms-auto align-items-center">

        <!-- Cart Icon -->
        <li class="nav-item me-3">
          <a href="<?php echo $base_url; ?>/Cart/cart.php" class="nav-link position-relative">

            <i class="fa-solid fa-cart-shopping fa-lg"></i>

            <span id="cart-count"
              class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              <?php echo $cartCount; ?>
            </span>

          </a>
        </li>

        <?php if (isset($_SESSION['user_login'])): ?>

        <li class="nav-item">
          <a class="nav-link" href="<?php echo $base_url; ?>/user.php">
            <i class="fa-solid fa-user"></i> Account
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-danger" href="<?php echo $base_url; ?>/signout.php">
            <i class="fa-solid fa-right-from-bracket"></i> Signout
          </a>
        </li>

        <?php else: ?>

        <li class="nav-item">
          <a class="nav-link" href="<?php echo $base_url; ?>/Signin/signin.php">
            <i class="fa-solid fa-right-to-bracket"></i> Signin
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="<?php echo $base_url; ?>/Signup/signup.php">
            <i class="fa-solid fa-user-plus"></i> Signup
          </a>
        </li>

        <?php endif; ?>

      </ul>

    </div>
  </div>
</nav>