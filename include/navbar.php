<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Professional Design</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="path/to/style.css">
</head>

<body>
  <?php 
// เช็คว่า session เริ่มแล้วหรือยัง
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo $base_url; ?>/index.php">
        <img src="<?php echo $base_url; ?>/assets/images/ninja_logo.png" alt="logo" height="40">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="productDropdown" role="button" data-bs-toggle="dropdown">
              Product List
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?php echo $base_url; ?>/Product/product_list.php">All Products</a>
              </li>
              <li><a class="dropdown-item" href="<?php echo $base_url; ?>/Product/product_pc.php">Pc</a></li>
              <li><a class="dropdown-item" href="<?php echo $base_url; ?>/Product/product_console.php">Console</a>
              </li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="<?php echo $base_url; ?>/Product/product_other.php">Other</a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $base_url; ?>/Cart/cart.php">Cart</a>
          </li>
        </ul>

        <form class="d-flex me-3" method="GET" action="<?php echo $base_url; ?>/search.php">
          <input class="form-control me-2" type="search" name="keyword" placeholder="Search">
          <button class="btn btn-outline-light" type="submit">Search</button>
        </form>

        <ul class="navbar-nav ms-auto">
          <?php if (isset($_SESSION['user_login'])): ?>
          <!-- ผู้ใช้ล็อกอินแล้ว -->
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $base_url; ?>/user.php">
              <i class="fas fa-user"></i> Account
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-danger" href="<?php echo $base_url; ?>../signout.php">
              <i class="fas fa-sign-out-alt"></i> Signout
            </a>
          </li>
          <?php else: ?>
          <!-- ยังไม่ล็อกอิน -->
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $base_url; ?>/Signin/signin.php">
              <i class="fas fa-sign-in-alt"></i> Signin
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $base_url; ?>/Signup/signup.php">
              <i class="fas fa-user-plus"></i> Signup
            </a>
          </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

</body>

</html>