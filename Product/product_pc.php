<?php
session_start();
include '../config.php';

// กำหนดค่าต่ำสุดสำหรับจำนวนรายการต่อหน้า
$perpage = 12;
// แบ่งหน้าเพจ
if(isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$start = ($page - 1) * $perpage;

// product all
$query = mysqli_query($conn, "SELECT * FROM products WHERE product_type = 'pc'");

$rows = mysqli_num_rows($query);



// product select edit
if (!empty($_GET['id'])) {
    $product_id = $_GET['id'];
    $query_product = mysqli_query($conn, "SELECT * FROM products WHERE id = $product_id");
    $row_product = mysqli_num_rows($query_product);

    if ($row_product == 0) {
        header('location:' . $base_url . '/index.php');
    }

    $result = mysqli_fetch_assoc($query_product);
}

?>


<?php
$sql1 = "SELECT * FROM products";
$query1 = mysqli_query($conn,$sql1);
$total_rows = mysqli_num_rows($query1); // นับจำนวนรายการทั้งหมด 
$total_page = ceil($total_rows / $perpage); // คำนวณจำนวนหน้าทั้งหมด
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <?php include '../include/navbar.php'; ?>
</head>

<body>
  <div class="container mt-5"><br>
    <!-- Display header -->
    <div><?php require_once '../include/header.php'; ?></div><br><br><br> <!-- List Products -->
    <div class="row">
      <?php while($product = mysqli_fetch_assoc($query)): ?>
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 rounded">
          <img src="<?php echo $base_url; ?>/upload_image/<?php echo $product['profile_image']; ?>" class="card-img-top"
            alt="Product Image" style="height: 200px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title text-dark"><?php echo $product['product_name']; ?></h5>
            <p class="card-text text-muted">ID: <?php echo $product['id']; ?></p>
            <p class="card-text text-success fw-bold"><?php echo number_format($product['price'], 2); ?> BATH</p>
            <a href="cart-add.php?id=<?php echo $product['id']; ?>" class="btn btn-primary w-100">
              <i class="fa-solid fa-cart-shopping me-1"></i> Add to Cart
            </a>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
    <div class="container mt-4">
      <?php if(!empty($_SESSION['message'])): ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php unset($_SESSION['message']); ?>
      <?php endif; ?>

      <div class="row">
        <?php if($rows > 0): ?>
        <?php while($product = mysqli_fetch_assoc($query)): ?>
        <div class="col-md-2">
          <div class="card">
            <?php if(!empty($product['profile_image'])): ?>
            <img src="<?php echo $base_url; ?>/upload_image/<?php echo $product['profile_image']; ?>" onclick=();
              class="card-img-top" height="200" alt="Product Image">
            <?php else: ?>
            <img src="<?php echo $base_url; ?>/assets/images/no-image.png" alt="Product Image">
            <?php endif; ?>
            <div class="card-body">
              <h5 class="card-title fw-bold"><?php echo $product['product_name']; ?></h5>
              <h5 class="card-title fw-bold">ID:<?php echo $product['id']; ?></h5>
              <p class="card-text text-success fw-bold mb-0"><?php echo number_format($product['price'], 2); ?> BATH</p>
              <a href="<?php echo $base_url; ?>/cart-add.php?id=<?php echo $product['id']; ?>"
                class="btn btn-primary w-100"><i class="fa-solid fa-cart-shopping me-1"></i>Add Cart</a>
            </div>
          </div>
        </div>
        <?php endwhile; ?>
        <?php else: ?>
        <div class="col">
          <h4 class="text-danger">ไม่มีรายการสินค้า</h4>
        </div>
        <?php endif; ?>
      </div>
    </div>



    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <!-- Added justify-content-center -->
        <li class="page-item"><a class="page-link" href="product-list.php?page=<?= max(1, $page - 1); ?>">Previous</a>
        </li>
        <?php for ($i = 1; $i <= $total_page; $i++) { ?>
        <li class="page-item"><a class="page-link" href="product-list.php?page=<?= $i ?>"><?= $i ?></a></li>
        <?php } ?>
        <?php if ($page < $total_page) { ?>
        <li class="page-item"><a class="page-link" href="product-list.php?page=<?=$total_page?>">Next</a></li>
        <?php } ?>
      </ul>
    </nav>


    <script src="<?php echo $base_url; ?>/assets/js/bootstrap.min.js"></script>
</body>


</html>