<?php
session_start();
require_once '../config.php';

/* =========================
   เตรียมข้อมูลสินค้าในตะกร้า
========================= */

$cart = $_SESSION['cart'] ?? [];
$productIds = array_keys($cart);

$rows = 0;
$total = 0;
$products = [];

if (!empty($productIds)) {
  $ids = implode(',', array_map('intval', $productIds));
  $result = mysqli_query($conn, "SELECT * FROM products WHERE id IN ($ids)");

  if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
      $products[] = $row;
    }
    $rows = count($products);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ตะกร้าสินค้า</title>

  <link href="<?php echo $base_url; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo $base_url; ?>/assets/fontawesome/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-light">

  <div class="container mt-5">

    <!-- Flash Message -->
    <?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-success alert-dismissible fade show">
      <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <h2 class="mb-4">🛒 ตะกร้าสินค้า</h2>

    <form action="<?php echo $base_url; ?>/Cart/cart-update.php" method="post">

      <table class="table table-bordered bg-white align-middle">
        <thead class="table-dark text-center">
          <tr>
            <th width="120">รูปภาพ</th>
            <th>ชื่อสินค้า</th>
            <th width="120">ราคา</th>
            <th width="120">จำนวน</th>
            <th width="150">รวม</th>
            <th width="100">ลบ</th>
          </tr>
        </thead>
        <tbody>

          <?php if ($rows > 0): ?>

          <?php foreach ($products as $product):

              $qty = max(1, (int)$cart[$product['id']]);
              $subtotal = $product['price'] * $qty;
              $total += $subtotal;
            ?>

          <tr>
            <td class="text-center">
              <?php if (!empty($product['profile_image'])): ?>
              <img src="<?php echo $base_url; ?>/upload_image/<?php echo $product['profile_image']; ?>" width="80">
              <?php else: ?>
              <img src="<?php echo $base_url; ?>/assets/images/no-image.png" width="80">
              <?php endif; ?>
            </td>

            <td>
              <strong><?php echo $product['product_name']; ?></strong>
              <div>
                <small class="text-muted">
                  <?php echo nl2br($product['detail']); ?>
                </small>
              </div>
            </td>

            <td class="text-center">
              <?php echo number_format($product['price'], 2); ?>
            </td>

            <td>
              <input type="number" name="product[<?php echo $product['id']; ?>][quantity]" value="<?php echo $qty; ?>"
                min="1" class="form-control text-center">
            </td>

            <td class="text-center">
              <?php echo number_format($subtotal, 2); ?>
            </td>

            <td class="text-center">
              <a href="<?php echo $base_url; ?>/Cart/cart-delete.php?id=<?php echo $product['id']; ?>"
                onclick="return confirm('ลบสินค้านี้ใช่หรือไม่?');" class="btn btn-outline-danger btn-sm">
                <i class="fa-solid fa-trash"></i>
              </a>
            </td>
          </tr>

          <?php endforeach; ?>

          <!-- Grand Total -->
          <tr class="table-secondary">
            <td colspan="4" class="text-end"><strong>ยอดรวมทั้งหมด</strong></td>
            <td class="text-center"><strong><?php echo number_format($total, 2); ?></strong></td>
            <td></td>
          </tr>

          <tr>
            <td colspan="6" class="text-end">
              <button type="submit" class="btn btn-success">
                <i class="fa-solid fa-rotate"></i> อัพเดทตะกร้า
              </button>

              <a href="<?php echo $base_url; ?>/checkout.php" class="btn btn-primary">
                <i class="fa-solid fa-credit-card"></i> เช็คบิล
              </a>
            </td>
          </tr>

          <?php else: ?>

          <tr>
            <td colspan="6" class="text-center text-danger">
              <h5>ไม่มีสินค้าในตะกร้า</h5>
            </td>
          </tr>

          <?php endif; ?>

        </tbody>
      </table>

    </form>

    <a href="<?php echo $base_url; ?>/Product/product_list.php" class="btn btn-secondary">
      ← กลับไปเลือกสินค้า
    </a>

  </div>

  <script src="<?php echo $base_url; ?>/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>