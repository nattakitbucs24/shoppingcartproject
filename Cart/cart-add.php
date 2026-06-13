<?php
session_start();
include '../config.php';   // ถ้าไฟล์อยู่ในโฟลเดอร์ Cart

// ป้องกัน cart ไม่ถูกสร้าง
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// กำหนดตัวแปร
$products = [];
$cart = $_SESSION['cart'];

// ดึงสินค้าเฉพาะที่อยู่ใน cart
if (!empty($cart)) {

    $ids = array_keys($cart);
    $ids = array_map('intval', $ids);

    if (!empty($ids)) {
        $idList = implode(',', $ids);

        $sql = "SELECT * FROM products WHERE id IN ($idList)";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            while ($row = mysqli_fetch_assoc($query)) {
                $products[] = $row;
            }
        }
    }
}
?>

<div class="container py-5">

  <h2 class="fw-bold mb-4">🛒 Shopping Cart</h2>

  <?php
    $total = 0;
    if (!empty($products)):
    ?>

  <form method="post" action="<?php echo $base_url; ?>/Cart/cart-update.php">

    <?php
            // สร้าง CSRF ถ้ายังไม่มี
            if (empty($_SESSION['csrf_token'])) {
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            }
            ?>
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <div class="row">

      <!-- LEFT -->
      <div class="col-lg-8">

        <div class="card shadow-sm border-0">
          <div class="card-body p-0">

            <?php foreach ($products as $product):

                                $id = (int)$product['id'];
                                $qty = isset($cart[$id]) ? max(1, (int)$cart[$id]) : 1;
                                $price = (float)$product['price'];
                                $subtotal = $price * $qty;
                                $total += $subtotal;
                            ?>

            <div class="row align-items-center p-4 border-bottom">

              <div class="col-md-2 text-center">
                <img src="<?php
                                                    echo !empty($product['profile_image'])
                                                        ? $base_url . '/upload_image/' . htmlspecialchars($product['profile_image'])
                                                        : $base_url . '/assets/images/no-image.png';
                                                    ?>" class="img-fluid rounded">
              </div>

              <div class="col-md-4">
                <h6 class="fw-bold mb-1">
                  <?php echo htmlspecialchars($product['product_name']); ?>
                </h6>
                <small class="text-muted">
                  <?php echo !empty($product['detail'])
                                                ? htmlspecialchars(substr($product['detail'], 0, 80)) . '...'
                                                : '-'; ?>
                </small>
              </div>

              <div class="col-md-2 text-center fw-bold text-success">
                ฿<?php echo number_format($price, 2); ?>
              </div>

              <div class="col-md-2">
                <input type="number" name="qty[<?php echo $id; ?>]" value="<?php echo $qty; ?>" min="1"
                  class="form-control text-center">
              </div>

              <div class="col-md-1 text-center fw-bold">
                ฿<?php echo number_format($subtotal, 2); ?>
              </div>

              <div class="col-md-1 text-end">
                <a href="<?php echo $base_url; ?>/Cart/cart-delete.php?id=<?php echo $id; ?>"
                  onclick="return confirm('ลบสินค้านี้ใช่หรือไม่?');" class="text-danger">
                  <i class="fa-solid fa-trash"></i>
                </a>
              </div>

            </div>

            <?php endforeach; ?>

          </div>
        </div>

        <div class="mt-3">
          <button type="submit" class="btn btn-outline-success">
            <i class="fa-solid fa-rotate"></i> Update Cart
          </button>
        </div>

      </div>

      <!-- RIGHT -->
      <div class="col-lg-4">

        <div class="card shadow border-0">
          <div class="card-body">

            <h5 class="fw-bold mb-4">Order Summary</h5>

            <div class="d-flex justify-content-between mb-2">
              <span>Subtotal</span>
              <span>฿<?php echo number_format($total, 2); ?></span>
            </div>

            <div class="d-flex justify-content-between mb-2">
              <span>Shipping</span>
              <span class="text-success">Free</span>
            </div>

            <hr>

            <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
              <span>Total</span>
              <span class="text-primary">
                ฿<?php echo number_format($total, 2); ?>
              </span>
            </div>

            <a href="<?php echo $base_url; ?>/checkout.php" class="btn btn-primary w-100 mb-2">
              <i class="fa-solid fa-credit-card"></i> Proceed to Checkout
            </a>

            <a href="<?php echo $base_url; ?>/Cart/cart-clear.php"
              onclick="return confirm('ต้องการลบสินค้าทั้งหมดใช่หรือไม่?');" class="btn btn-outline-danger w-100">
              Clear Cart
            </a>

          </div>
        </div>

      </div>

    </div>

  </form>

  <?php else: ?>

  <div class="text-center py-5">
    <h4 class="text-muted">ไม่มีสินค้าในตะกร้า</h4>
    <a href="<?php echo $base_url; ?>/index.php" class="btn btn-primary mt-3">
      เลือกสินค้า
    </a>
  </div>

  <?php endif; ?>

</div>