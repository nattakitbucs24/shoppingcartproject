<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../include/header.php';

if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

$cart = $_SESSION['cart'];
$products = [];
$total = 0;

/* =========================
   GET PRODUCTS FROM CART
========================= */

if (!empty($cart)) {

  $ids = array_keys($cart);
  $ids = array_filter(array_map('intval', $ids));

  if (!empty($ids)) {
    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    $sql = "SELECT * FROM products WHERE id IN ($placeholders)";
    $stmt = $conn->prepare($sql);
    $stmt->execute($ids);

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}

/* =========================
   CSRF TOKEN
========================= */

if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

?>

<style>
body {
  padding-top: 76px;
  background: radial-gradient(circle at top, #1e3c72, #0f2027);
  min-height: 100vh;
}

/* container */
.container {
  max-width: 1250px;
}

/* cart main card */
.cart-card {
  border: none;
  border-radius: 20px;
  background: rgba(255, 255, 255, .96);
  backdrop-filter: blur(6px);
  box-shadow: 0 20px 45px rgba(0, 0, 0, .12);
  padding: 10px;
}

/* cart item */
.cart-item {
  margin: 0;
  padding: 28px;
  border-radius: 20px;
  background: #fff;
  border: 1px solid #eef2f7;
  box-shadow: 0 8px 25px rgba(0, 0, 0, .06);
}

.cart-item+.cart-item {
  margin-top: 20px;
}

.cart-item:hover {
  transform: translateY(-4px);
  box-shadow: 0 18px 35px rgba(0, 0, 0, .15);
}

/* product image */
.cart-img {
  width: 120px;
  height: 120px;
  object-fit: cover;
  border-radius: 18px;
}

.cart-item:hover .cart-img {
  transform: scale(1.05);
}

/* title */
.product-title {
  font-size: 18px;
  font-weight: 600;
  color: #222;
}

/* price */
.product-price {
  font-size: 18px;
  font-weight: 700;
  color: #2563eb;
}

/* quantity */
.qty-box {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
}

.qty-btn {
  width: 34px;
  height: 34px;
  border: none;
  border-radius: 10px;
  background: #f1f3f5;
  font-weight: bold;
  transition: .2s;
}

.qty-btn:hover {
  background: #2563eb;
  color: white;
}

.qty-box input {
  width: 60px;
  text-align: center;
  border-radius: 10px;
  border: 1px solid #ddd;
  font-weight: 600;
}

/* summary card */
.summary-card {
  background: #fff;
  border: none;
  border-radius: 24px;
  box-shadow: 0 20px 50px rgba(0, 0, 0, .10);
  position: sticky;
  top: 100px;
}

.summary-card .card-body {
  padding: 32px !important;
}

/* modern buttons */
.btn-modern {
  border-radius: 40px;
  padding: 12px 24px;
  font-weight: 600;
  transition: .25s;
}

/* continue */
.btn-continue {
  background: rgba(255, 255, 255, .15) !important;
  border: 1px solid rgba(255, 255, 255, .35) !important;
  color: white !important;
  backdrop-filter: blur(5px) !important;
}

.btn-continue:hover {
  background: white !important;
  color: black !important;
}

/* checkout */
.btn-checkout {
  background: linear-gradient(135deg, #2563eb, #60a5fa);
  color: white;
  border: none;
}

.btn-checkout:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 30px rgba(37, 99, 235, .35);
}

/* update */
.btn-update {
  background: #0d6efd;
  color: white;
}

.btn-update:hover {
  background: #0b5ed7;
}

/* clear */
.btn-clear {
  background: #ffe3e3;
  color: #c92a2a;
  border: none;
}

.btn-clear:hover {
  background: #ffc9c9;
}

html,
body {
  height: 100%;
}

body {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

main {
  flex: 1;
}

.page-content {
  flex: 1;
}

.empty-cart {
  min-height: 50vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
</style>
<?php include '../include/header.php'; ?>
<main class="page-content">

  <div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

      <h2 class="fw-bold text-white">
        <i class="fa-solid fa-cart-shopping me-2"></i>
        Shopping Cart
      </h2>

      <a href="<?= $base_url ?>/index.php" class="btn btn-modern btn-continue">
        <i class="fa-solid fa-arrow-left me-2"></i>
        Continue Shopping
      </a>
    </div>


    <?php if (!empty($products)): ?>

    <form method="post" action="<?= $base_url ?>/Cart/cart-update.php">
      <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

      <div class="row g-4">

        <!-- LEFT SIDE -->
        <div class="col-lg-8">

          <div class="cart-card">

            <?php foreach ($products as $product):

              $id = (int)$product['id'];
              $qty = isset($cart[$id]) ? max(1, (int)$cart[$id]) : 1;
              $price = (float)$product['price'];
              $subtotal = $price * $qty;
              $total += $subtotal;

            ?>

            <div class="cart-item">

              <div class="row align-items-center g-3">

                ```
                <div class="col-lg-2 col-md-3 text-center">
                  <img src="..." class="cart-img">
                </div>

                <div class="col-lg-4 col-md-9">
                  <div class="product-title">
                    Product Name
                  </div>

                  <small class="text-muted">
                    Product Description...
                  </small>
                </div>

                <div class="col-lg-2 col-md-4 text-center product-price">
                  ฿1,999.00
                </div>

                <div class="col-lg-2 col-md-4">
                  <div class="qty-box">
                    ...
                  </div>
                </div>

                <div class="col-lg-1 col-md-2 text-center">
                  <a href="#" class="text-danger fs-5">
                    <i class="fa-solid fa-trash"></i>
                  </a>
                </div>

                <div class="col-lg-1 col-md-2 text-end fw-bold">
                  ฿3,998
                </div>
                ```

              </div>


            </div>

            <?php endforeach; ?>

          </div>

          <div class="mt-3">

            <button type="submit" class="btn btn-modern btn-update px-4">
              <i class="fa-solid fa-rotate"></i> Update Cart
            </button>

          </div>

        </div>


        <!-- RIGHT SIDE -->
        <div class="col-lg-4 mb-4">

          <div class="card summary-card">

            <div class="card-body p-4">

              <h5 class="fw-bold mb-4">Order Summary</h5>

              <div class="d-flex justify-content-between mb-2">
                <span>Subtotal</span>
                <span>฿<?= number_format($total, 2) ?></span>
              </div>

              <div class="d-flex justify-content-between mb-3">
                <span>Shipping</span>
                <span class="text-success">Free</span>
              </div>

              <hr>

              <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                <span>Total</span>
                <span class="text-primary">฿<?= number_format($total, 2) ?></span>
              </div>

              <a href="<?= $base_url ?>/Checkout/checkout.php" class="btn btn-modern btn-checkout w-100 mb-2">
                Proceed to Checkout
              </a>
              <a href="<?= $base_url ?>/Cart/cart-clear.php" class="btn btn-modern btn-clear w-100">
                Clear Cart
              </a>

            </div>

          </div>

        </div>

      </div>

    </form>


    <?php else: ?>

    <div class="empty-cart text-center">

      <i class="fa-solid fa-cart-shopping fa-3x mb-3 text-primary"></i>

      <h4 class="mb-3" style="color: yellow;">
        Your cart is empty
      </h4>

      <p class="mb-4   text-white">
        Looks like you haven't added anything yet.
      </p>

      <a href="<?= $base_url ?>/index.php" class="btn btn-warning rounded-pill px-4">
        Start Shopping
      </a>

    </div>

    <?php endif; ?>

  </div>


</main>
<?php include '../include/footer.php'; ?>


<?php include __DIR__ . '/../include/footer.php'; ?>