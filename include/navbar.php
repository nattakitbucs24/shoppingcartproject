<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Professional Design</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
  body {
    padding-top: 70px;
  }

  .navbar {
    background-color: #212529;
  }

  .navbar-brand img {
    height: 50px;
  }

  .nav-link {
    color: white !important;
  }

  .dropdown-menu {
    background-color: #343a40;
  }

  .dropdown-item {
    color: white !important;
  }

  .dropdown-item:hover {
    background-color: #495057;
  }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo $base_url; ?>/index.php">
        <img src="<?php echo $base_url; ?>/assets/images/ninja_logo.png" alt="logo">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="productDropdown" role="button" data-bs-toggle="dropdown">
              รายการสินค้า
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?php echo $base_url; ?>/product-list.php">สินค้าทั้งหมด</a></li>
              <li><a class="dropdown-item" href="<?php echo $base_url; ?>/product_pc.php">อุปกรณ์พีซี</a></li>
              <li><a class="dropdown-item" href="<?php echo $base_url; ?>/product_console.php">อุปกรณ์คอนโซล</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="<?php echo $base_url; ?>/product_other.php">อุปกรณ์อื่นๆ</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $base_url; ?>/cart.php">ตะกร้าสินค้า</a>
          </li>
        </ul>
        <form class="d-flex" method="GET" action="search.php">
          <input class="form-control me-2" type="search" placeholder="Search" name="keyword">
          <button class="btn btn-outline-light" type="submit">ค้นหา</button>
        </form>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $base_url; ?>/signin.php">ล็อกอิน</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $base_url; ?>/signup.php">สมัครสมาชิก</a>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="btn btn-danger ms-2">Logout</a>
          </li>
        </ul>

      </div>
    </div>
  </nav>
</body>

</html>