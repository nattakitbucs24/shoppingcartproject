<?php
ob_start(); // กัน headers error
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config.php'; // เชื่อม DB

// เช็คการเชื่อมต่อก่อน
if (!$conn) {
  die("Database connection failed: " . mysqli_connect_error());
}

// ===== Pagination =====
$perpage = 12;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

if ($page < 1) {
  $page = 1;
}

$start = ($page - 1) * $perpage;

// ===== นับจำนวนทั้งหมด =====
$countQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM products");

if (!$countQuery) {
  die("Count Query Error: " . mysqli_error($conn));
}

$countResult = mysqli_fetch_assoc($countQuery);
$total_rows = $countResult['total'];
$total_page = ceil($total_rows / $perpage);

// กัน page เกิน
if ($page > $total_page && $total_page > 0) {
  $page = $total_page;
  $start = ($page - 1) * $perpage;
}

// ===== ดึงสินค้า =====
$start = (int)$start;
$perpage = (int)$perpage;

$sql = "SELECT id, name, price, img
        FROM products
        ORDER BY id DESC
        LIMIT $start, $perpage";

$result = mysqli_query($conn, $sql);

if (!$result) {
  die("Query Error: " . mysqli_error($conn));
}

$products = [];

while ($row = mysqli_fetch_assoc($result)) {
  $products[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>STORE</title>

  <link href="<?= $base_url; ?>/assets/fontawesome/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



  <style>
  body {
    padding-top: 76px;
    background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
    min-height: 100vh;
  }

  .main-content {
    margin-top: 110px;
    margin-bottom: 60px;
  }

  .card {
    border: none;
    border-radius: 15px;
    transition: 0.3s;
  }

  .card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
  }

  .card img {
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
  }

  .btn-primary {
    border-radius: 30px;
  }

  .pagination .active .page-link {
    background: #000;
    border-color: #000;
  }

  /* animation */
  .bounce {
    animation: bounce 0.4s;
  }

  @keyframes bounce {
    0% {
      transform: scale(1);
    }

    50% {
      transform: scale(1.15);
    }

    100% {
      transform: scale(1);
    }
  }

  .shake {
    animation: shake 0.5s;
  }

  @keyframes shake {
    0% {
      transform: rotate(0);
    }

    25% {
      transform: rotate(-15deg);
    }

    50% {
      transform: rotate(15deg);
    }

    75% {
      transform: rotate(-10deg);
    }

    100% {
      transform: rotate(0);
    }
  }

  .product-card {
    border: none;
    border-radius: 20px;
    overflow: hidden;
    transition: 0.3s ease;
    background: #fff;
  }

  .product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  }

  .product-card img {
    height: 220px;
    object-fit: cover;
  }

  .price-tag {
    font-size: 18px;
    font-weight: bold;
    color: #198754;
  }

  .add-to-cart {
    border-radius: 30px;
    transition: 0.3s;
  }

  .add-to-cart:hover {
    background: #0d6efd;
    /* เปลี่ยนเป็นน้ำเงิน */
    color: #fff;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
  }

  .product-img {
    height: 220px;
    object-fit: contain;
  }


  .custom-pagination .page-link {
    background: rgba(255, 255, 255, 0.08);
    border: none;
    color: #fff;
    margin: 0 4px;
    border-radius: 12px;
    padding: 8px 14px;
    transition: 0.3s;
  }

  .custom-pagination .page-link:hover {
    background: #ffc107;
    color: #000;
  }

  .custom-pagination .page-item.active .page-link {
    background: #ffc107;
    color: #000;
    font-weight: bold;
  }

  .custom-pagination .page-item.disabled .page-link {
    opacity: 0.4;
  }

  .hero-section {
    background: linear-gradient(135deg, #1a2a33, #203a43, #2c5364);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
  }

  .product-img {
    height: 220px;
    object-fit: cover;
  }
  </style>
</head>

<body>

  <?php include 'include/header.php'; ?>

  <section class="hero-section text-white py-5 mb-5">
    <div class="container text-center">

      <h1 class="fw-bold display-5">Discover Quality Products</h1>

      <p class="lead text-light">
        Shop the best products at great prices. Find everything you need in one place.
      </p>

      <a href="#product-section" class="btn btn-warning btn-lg rounded-pill px-4 shadow">
        <i class="fa-solid fa-bag-shopping me-2"></i>Shop Now
      </a>

    </div>
  </section>

  <div class="container main-content" id="product-section">

    <h2 class="mb-4 fw-bold text-white">Latest Products</h2>
    <div class="row g-4">
      <?php if (!empty($products)): ?>
      <?php foreach ($products as $product): ?>
      <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="card h-100 product-card position-relative">

          <?php if (!empty($product['img'])): ?>
          <div class="position-absolute top-0 start-0 m-2">
            <span class="badge bg-danger rounded-pill px-3">NEW</span>
          </div>
          <!-- 
            <div class="position-absolute top-0 start-0 m-2">

              <span class="badge bg-danger">SALE</span>
            </div> -->
          <img src="<?= $base_url ?>/assets/images/products/<?= $product['img'] ?>" class="card-img-top">
          <?php else: ?>
          <img src="<?= $base_url; ?>/assets/images/no-image.png" class="card-img-top">
          <?php endif; ?>

          <div class="card-body d-flex flex-column">
            <h5><?= htmlspecialchars($product['name']); ?></h5>
            <div class="rating">
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star-half"></i>
              (0 reviews)
            </div>
            <p class="price-tag">
              ฿<?= number_format($product['price'], 2); ?>
            </p>

            <button type="button" class="btn btn-warning mt-auto add-to-cart rounded-pill"
              data-id="<?= $product['id']; ?>">

              <span class="btn-text">
                <i class="fa-solid fa-cart-plus me-1"></i>
                Add to Cart
              </span>

              <span class="spinner-border spinner-border-sm d-none"></span>

            </button>

          </div>
        </div>
      </div>
      <?php endforeach; ?>
      <?php else: ?>
      <div class="col">
        <h4 class="text-danger">No products available</h4>
      </div>
      <?php endif; ?>
    </div>

    <!-- pagination -->
    <?php if ($total_page > 1): ?>
    <nav class="mt-5">
      <ul class="pagination justify-content-center custom-pagination">

        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
          <a class="page-link" href="?page=<?= max(1, $page - 1) ?>">Previous</a>
        </li>

        <?php for ($i = 1; $i <= $total_page; $i++): ?>
        <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
          <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
        </li>
        <?php endfor; ?>

        <li class="page-item <?= ($page >= $total_page) ? 'disabled' : '' ?>">
          <a class="page-link" href="?page=<?= min($total_page, $page + 1) ?>">Next</a>
        </li>

      </ul>
    </nav>
    <?php endif; ?>

  </div>

  <!-- modal -->
  <div class="modal fade" id="cartSuccessModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-center p-4 border-0 rounded-4 shadow-lg">

        <div class="modal-body">

          <div class="mb-3">
            <i class="fa-solid fa-circle-check text-success" style="font-size:70px;"></i>
          </div>

          <h3 class="fw-bold">เพิ่มสินค้าแล้ว!</h3>
          <p class="text-muted mb-4">
            สินค้าได้ถูกเพิ่มลงในตะกร้าเรียบร้อยแล้ว
          </p>

          <div class="d-flex justify-content-center gap-3">

            <button class="btn btn-outline-secondary px-4 rounded-pill" data-bs-dismiss="modal">
              เลือกสินค้าต่อ
            </button>

            <a href="<?= $base_url; ?>/Cart/cart.php" class="btn btn-primary px-4 rounded-pill shadow-sm">
              ไปที่ตะกร้า
            </a>

          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- jQuery -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
  $(document).on('click', '.add-to-cart', function(e) {

    e.preventDefault();

    let btn = $(this);
    let id = btn.data('id');

    console.log("CLICKED", id); // ทดสอบว่าปุ่มทำงานไหม

    if (!id) {
      alert("ไม่พบสินค้า");
      return;
    }

    btn.prop('disabled', true);

    $.ajax({
      url: '<?= $base_url; ?>/Cart/ajax-add-to-cart.php',
      type: 'POST',
      data: {
        id: id
      },
      dataType: 'json',

      // 🔥 เริ่มโหลด
      beforeSend: function() {
        btn.prop('disabled', true);
        btn.html('<span class="spinner-border spinner-border-sm me-2"></span>Adding...');
      },

      success: function(res) {

        console.log("AJAX RESPONSE:", res);

        if (res && res.success) {

          $('#cart-count').text(res.count);

          var myModalEl = document.getElementById('cartSuccessModal');
          var modal = bootstrap.Modal.getOrCreateInstance(myModalEl);
          modal.show();

        } else {
          alert("เพิ่มสินค้าไม่สำเร็จ");
        }

      },

      error: function(xhr) {
        console.log("AJAX ERROR:", xhr.responseText);
        alert("AJAX ยิงไม่สำเร็จ");
      },

      complete: function() {

        // 🔥 คืนปุ่ม
        btn.prop('disabled', false);
        btn.html('<i class="fa-solid fa-cart-plus me-1"></i> Add to Cart');

      }

    });
  });
  </script>
  <?php include 'include/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <?php if (!empty($_SESSION['success'])): ?>

  <script>
  Swal.fire({
    icon: 'success',
    title: 'เข้าสู่ระบบสำเร็จ',
    text: 'ยินดีต้อนรับเข้าสู่ระบบ',
    confirmButtonColor: '#3085d6'
  });
  </script>

  <?php unset($_SESSION['success']);
  endif; ?>
</body>

</html>