<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
require_once __DIR__ . '/../db.php';
include_once __DIR__ . '/../config.php';


$cartCount = 0;
if (isset($_SESSION['cart'])) {
  $cartCount = array_sum($_SESSION['cart']);
}

$cat_query = $conn->query("SELECT * FROM categories ORDER BY name ASC");
?>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
.navbar-custom {
  background: rgba(0, 0, 0, 0.85);
  backdrop-filter: blur(8px);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
  transition: .3s;
}

.navbar-custom .nav-link {
  transition: .3s;
}

.navbar-custom .nav-link:hover {
  color: #00f5ff !important;
  transform: translateY(-2px);
}

.cart-badge {
  font-size: 12px;
  box-shadow: 0 0 10px rgba(255, 0, 0, .7);
}

.navbar-brand img {
  transition: .3s;
}

.navbar-brand img:hover {
  transform: scale(1.05);
}

.search-input {
  border-radius: 30px;
  padding-left: 15px;
}

.search-btn {
  border-radius: 30px;
}

.dropdown-menu {
  border-radius: 10px;
  padding: 10px;
}

.dropdown-item {
  padding: 8px 15px;
  transition: .2s;
}

.dropdown-item:hover {
  background: #f1f3f5;
  padding-left: 20px;
}

.nav-account {
  padding: 8px 16px;
  border-radius: 25px;
  background: rgba(255, 255, 255, 0.08);
  color: white !important;
  font-weight: 600;
  transition: 0.3s;
}

.nav-account:hover {
  background: rgba(255, 255, 255, 0.18);
  transform: translateY(-2px);
}

.btn-logout {
  background: linear-gradient(135deg, #ff4b2b, #ff416c);
  border: none;
  color: white;
  padding: 8px 18px;
  border-radius: 25px;
  font-weight: 600;
  transition: 0.3s;
}

.btn-logout:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(255, 65, 108, 0.4);
}
</style>

<script>
function logoutConfirm() {
  Swal.fire({
    title: 'ออกจากระบบ?',
    text: 'คุณต้องการออกจากระบบจริงหรือไม่',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#6c757d',
    confirmButtonText: 'ออกจากระบบ',
    cancelButtonText: 'ยกเลิก',
    reverseButtons: true
  }).then((result) => {
    if (result.isConfirmed) {

      Swal.fire({
        title: 'กำลังออกจากระบบ...',
        icon: 'success',
        timer: 1200,
        showConfirmButton: false
      });

      setTimeout(function() {
        window.location.href = "logout.php";
      }, 1200);

    }
  });
}
</script>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">

  <div class="container-fluid px-4">

    <a class="navbar-brand d-flex align-items-center" href="<?= $base_url ?>/index.php">
      <img src="<?= $base_url ?>/assets/images/ford.png" height="40" class="me-2">
      <span class="fw-bold">STORE</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">

      <ul class="navbar-nav me-auto ms-3">

        <li class="nav-item">
          <a class="nav-link fw-semibold" href="<?= $base_url ?>/Product/product_new.php">
            <i class="fa-solid fa-bolt me-1"></i> New
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link fw-semibold text-danger" href="<?= $base_url ?>/Product/product_sale.php">
            <i class="fa-solid fa-tag me-1"></i> Sale
          </a>
        </li>

        <li class="nav-item dropdown">

          <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">

            <i class="fa-solid fa-layer-group me-1"></i> Categories
          </a>

          <ul class="dropdown-menu shadow border-0">

            <li>
              <a class="dropdown-item" href="<?= $base_url ?>/Product/product_list.php">
                <i class="fa-solid fa-store me-2"></i>
                All Products
              </a>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <?php while ($cat = $cat_query->fetch(PDO::FETCH_ASSOC)): ?>

            <li>
              <a class="dropdown-item" href="<?= $base_url ?>/Product/product_list.php?category=<?= $cat['id'] ?>">

                <i class="fa-solid fa-tag me-2"></i>
                <?= htmlspecialchars($cat['name']) ?>

              </a>
            </li>

            <?php endwhile; ?>

          </ul>

        </li>

      </ul>

      <form class="d-flex me-4" method="GET" action="<?= $base_url ?>/search.php">

        <input class="form-control me-2 search-input" type="search" name="keyword" placeholder="Search products...">

        <button class="btn btn-info text-dark search-btn" type="submit">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>

      </form>

      <ul class="navbar-nav align-items-center">

        <li class="nav-item me-3">
          <a href="<?= $base_url ?>/Cart/cart.php" class="nav-link position-relative">
            <i class="fa-solid fa-cart-shopping fa-lg"></i>

            <?php if ($cartCount > 0): ?>

            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-badge">

              <?= $cartCount ?>

            </span>

            <?php endif; ?>

          </a>
        </li>

        <?php if (isset($_SESSION['user_login'])): ?>

        <li class="nav-item me-2">
          <a class="nav-link nav-account" href="<?= $base_url ?>/user.php">
            <i class="fa-solid fa-user me-1"></i>
            Account
          </a>
        </li>

        <li class="nav-item">
          <a href="#" onclick="logoutConfirm()" class="btn btn-logout">
            <i class="fa-solid fa-right-from-bracket me-1"></i>
            Sign Out
          </a>
        </li>

        <?php else: ?>

        <li class="nav-item">
          <a class="nav-link fw-semibold" href="<?= $base_url ?>/Signin/signin.php">
            <i class="fa-solid fa-right-to-bracket"></i> Signin
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link fw-semibold" href="<?= $base_url ?>/Signup/signup.php">
            <i class="fa-solid fa-user-plus"></i> Signup
          </a>
        </li>

        <?php endif; ?>

      </ul>

    </div>

  </div>

</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">