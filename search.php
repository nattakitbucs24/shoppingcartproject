<?php
session_start();
include 'config.php';

// กำหนดค่าต่ำสุดสำหรับจำนวนรายการต่อหน้า
$perpage = 12;
// แบ่งหน้าเพจ
$page = isset($_GET['page']) ? $_GET['page'] : 1;  
$start = ($page - 1) * $perpage;
    
// ค้นหาสินค้า
$key_word = isset($_GET['keyword']) ? $_GET['keyword'] : '';
if ($key_word !== '') {
    $query = mysqli_query($conn, "SELECT * FROM products WHERE id='$key_word' OR product_name LIKE '%$key_word%' ORDER BY id LIMIT $start, $perpage");
} else {
    $query = mysqli_query($conn, "SELECT * FROM products ORDER BY id LIMIT $start, $perpage");
}

// ตรวจสอบจำนวนสินค้าทั้งหมด
$sql1 = "SELECT * FROM products";
$query1 = mysqli_query($conn, $sql1);
$total_rows = mysqli_num_rows($query1); // นับจำนวนรายการทั้งหมด
$total_page = ceil($total_rows / $perpage); // คำนวณจำนวนหน้าทั้งหมด
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Search</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <?php include 'include/navbar.php'; ?>

</head>

<body>
  <div class="container mt-4">
    <?php if(!empty($_SESSION['message'])): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <?php echo $_SESSION['message']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <div class="row">
      <?php while($product = mysqli_fetch_assoc($query)): ?>
      <div class="col-md-3 col-sm-6">
        <div class="card">
          <?php if(!empty($product['profile_image'])): ?>
          <img src="<?php echo $base_url; ?>/upload_image/<?php echo $product['profile_image']; ?>" class="card-img-top"
            alt="Product Image">
          <?php else: ?>
          <img src="<?php echo $base_url; ?>/assets/images/no-image.png" class="card-img-top" alt="Product Image">
          <?php endif; ?>
          <div class="card-body">
            <h5 class="card-title"><?php echo $product['product_name']; ?></h5>
            <p class="card-text text-muted"><?php echo nl2br($product['detail']); ?></p>
            <p class="text-success"><?php echo number_format($product['price'], 2); ?> BATH</p>
            <a href="<?php echo $base_url; ?>/Cart/cart-add.php?id=<?php echo $product['id']; ?>"
              class="btn btn-primary w-100">
              <i class="fas fa-cart-plus me-1"></i>Add to Cart
            </a>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>

    <nav aria-label="Page navigation">
      <ul class="pagination">
        <!-- Previous button -->
        <li class="page-item <?= ($page == 1) ? 'disabled' : '' ?>">
          <a class="page-link"
            href="../Product/product_list.php?keyword=<?= urlencode($key_word) ?>&page=<?= max(1, $page - 1); ?>">Previous</a>
        </li>

        <!-- Page number buttons -->
        <?php for ($i = 1; $i <= $total_page; $i++) { ?>
        <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
          <a class="page-link"
            href="../Product/product_list.php?keyword=<?= urlencode($key_word) ?>&page=<?= $i ?>"><?= $i ?></a>
        </li>
        <?php } ?>

        <!-- Next button -->
        <li class="page-item <?= ($page == $total_page) ? 'disabled' : '' ?>">
          <a class="page-link"
            href="../Product/product_list.php?keyword=<?= urlencode($key_word) ?>&page=<?= ($page < $total_page) ? $page + 1 : $total_page ?>">Next</a>
        </li>
      </ul>
    </nav>
  </div>
</body>

</html>