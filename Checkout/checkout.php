<?php
session_start();

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../include/header.php';

if (!isset($_SESSION['user_login'])) {
    header('Location: ../user.php');
    exit();
}

$user_login = $_SESSION['user_login'];

/* =========================
   GET CART PRODUCTS
========================= */

$productIds = array_keys($_SESSION['cart'] ?? []);
$rows = 0;
$query = null;

if (!empty($productIds)) {

    $ids = implode(',', array_map('intval', $productIds));
    $query = mysqli_query($conn, "SELECT * FROM products WHERE id IN ($ids)");

    if ($query) {
        $rows = mysqli_num_rows($query);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Checkout</title>

  <link href="<?= $base_url ?>/assets/css/bootstrap.min.css" rel="stylesheet">

  <link href="<?= $base_url ?>/assets/fontawesome/css/fontawesome.min.css" rel="stylesheet">
  <link href="<?= $base_url ?>/assets/fontawesome/css/brands.min.css" rel="stylesheet">
  <link href="<?= $base_url ?>/assets/fontawesome/css/solid.min.css" rel="stylesheet">

</head>

<body class="bg-body-tertiary">



  <div class="container" style="margin-top:30px; max-width:1100px;">

    <?php if (!empty($_SESSION['message'])) : ?>

    <div class="alert alert-warning alert-dismissible fade show">
      <?= $_SESSION['message']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <?php unset($_SESSION['message']);
        endif; ?>

    <h3 class="mb-4 fw-bold">Checkout</h3>

    <form action="<?= $base_url ?>/checkout-form.php" method="post">

      <div class="row g-5">

        <!-- LEFT : CUSTOMER INFO -->

        <div class="col-md-6">

          <div class="row g-3">

            <div class="col-sm-6">
              <label class="form-label">Name</label>
              <input type="text" class="form-control" name="fullname" placeholder="Enter your name" required>
            </div>

            <div class="col-sm-6">
              <label class="form-label">Tel.</label>
              <input type="tel" class="form-control" name="tel" placeholder="Enter telephone number" required>
            </div>

            <div class="col-12">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
            </div>

          </div>

        </div>


        <!-- RIGHT : CART SUMMARY -->

        <div class="col-md-6 col-lg-5 order-md-last">

          <h5 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-primary">Your cart</span>
            <span class="badge bg-primary rounded-pill"><?= $rows ?></span>
          </h5>

          <?php if ($rows > 0): ?>

          <ul class="list-group mb-3">

            <?php $grand_total = 0; ?>

            <?php while ($product = mysqli_fetch_assoc($query)):

                                $qty = $_SESSION['cart'][$product['id']];
                                $subtotal = $qty * $product['price'];
                                $grand_total += $subtotal;

                            ?>

            <li class="list-group-item d-flex justify-content-between">

              <div>
                <h6 class="my-0">
                  <?= htmlspecialchars($product['product_name']) ?>
                  (<?= $qty ?>)
                </h6>

                <small class="text-muted">
                  <?= htmlspecialchars($product['detail']) ?>
                </small>

                <!-- hidden data -->

                <input type="hidden" name="product[<?= $product['id'] ?>][name]"
                  value="<?= htmlspecialchars($product['product_name']) ?>">

                <input type="hidden" name="product[<?= $product['id'] ?>][price]" value="<?= $product['price'] ?>">

                <input type="hidden" name="product[<?= $product['id'] ?>][qty]" value="<?= $qty ?>">

              </div>

              <span>
                ฿<?= number_format($subtotal, 2) ?>
              </span>

            </li>

            <?php endwhile; ?>

            <li class="list-group-item d-flex justify-content-between bg-light">

              <div class="text-success">
                <strong>Grand Total</strong>
              </div>

              <span class="text-success">
                <strong>฿<?= number_format($grand_total, 2) ?></strong>
              </span>

            </li>

          </ul>

          <input type="hidden" name="grand_total" value="<?= $grand_total ?>">

          <?php else: ?>

          <div class="alert alert-warning">
            Your cart is empty
          </div>

          <?php endif; ?>

        </div>

      </div>

      <hr class="my-4">

      <div class="text-center">

        <a href="<?= $base_url ?>/product-list.php" class="btn btn-secondary btn-lg">
          Back
        </a>

        <button class="btn btn-primary btn-lg">
          Continue to checkout
        </button>

      </div>

    </form>

  </div>

  <script src="<?= $base_url ?>/assets/js/bootstrap.bundle.min.js"></script>
  <?php include '../include/footer.php'; ?>
</body>

</html>