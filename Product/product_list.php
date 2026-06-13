<?php
session_start();
include '../config.php';
/** @var mysqli $conn */
if (!isset($conn)) {
  die("Database connection error");
}

$perpage = 12;

$page = isset($_GET['page']) && is_numeric($_GET['page'])
  ? (int)$_GET['page']
  : 1;

if ($page < 1) {
  $page = 1;
}

$start = ($page - 1) * $perpage;

/* ===== นับจำนวนสินค้า ===== */
if (isset($_GET['category'])) {

  $cat_id = (int)$_GET['category'];

  $countQuery = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total 
     FROM products 
     WHERE category_id = $cat_id"
  );
} else {

  $countQuery = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total 
     FROM products"
  );
}

if (!$countQuery) {
  die(mysqli_error($conn));
}

$countResult = mysqli_fetch_assoc($countQuery);
$total_rows = (int)$countResult['total'];
$total_page = ceil($total_rows / $perpage);

if ($page > $total_page && $total_page > 0) {
  $page = $total_page;
  $start = ($page - 1) * $perpage;
}

/* ===== ดึงสินค้า ===== */

$start = (int)$start;
$perpage = (int)$perpage;

if (isset($_GET['category'])) {

  $cat_id = (int)$_GET['category'];

  $sql = "SELECT id, name, price, img
          FROM products
          WHERE category_id = $cat_id
          ORDER BY id DESC
          LIMIT $start, $perpage";
} else {

  $sql = "SELECT id, name, price, img
          FROM products
          ORDER BY id DESC
          LIMIT $start, $perpage";
}

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
  <title>Product</title>

  <link href="<?= $base_url; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= $base_url; ?>/assets/fontawesome/css/all.min.css" rel="stylesheet">
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

  .pagination .page-item.active .page-link {
    background: #000;
    border-color: #000;
  }

  /* 🔥 ปุ่มเด้ง */
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

  /* 🔥 ไอคอนตะกร้ากระดิก */
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
  </style>
</head>

<body>

  <?php include '../include/header.php'; ?>

  <div class="container main-content">

    <h2 class="mb-4 fw-bold text-white">Products</h2>

    <div class="row g-4">
      <?php if (!empty($products)): ?>
      <?php foreach ($products as $product): ?>

      <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="card h-100 shadow-sm">

          <?php if (!empty($product['img'])): ?>
          <img src="<?= $base_url ?>/assets/images/products/<?= htmlspecialchars($product['img']) ?>"
            class="card-img-top" style="height:200px;object-fit:cover;">

          <?php else: ?>
          <img src="<?= $base_url ?>/assets/images/no-image.png" class="card-img-top"
            style="height:200px;object-fit:cover;">
          <?php endif; ?>
          <div class="card-body d-flex flex-column">

            <h5 class="fw-semibold">
              <?= htmlspecialchars($product['name']) ?>
            </h5>

            <p class="text-success fw-bold mb-3">
              ฿<?= number_format($product['price'], 2) ?>
            </p>

            <button class="btn btn-dark mt-auto add-to-cart rounded-pill" data-id="<?= $product['id'] ?>">
              <i class="fa-solid fa-cart-plus me-1"></i>
              Add to Cart
            </button>

          </div>

        </div>
      </div>
      <?php endforeach; ?>
      <?php else: ?>
      <div class="col">
        <h4 class="text-danger">No products found</h4>
      </div>
      <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if ($total_page > 1): ?>

    <?php
      $cat_param = isset($_GET['category']) ? "&category=" . $_GET['category'] : "";
      ?>

    <nav class="mt-5">
      <ul class="pagination justify-content-center">

        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
          <a class="page-link" href="?page=<?= $page - 1 ?><?= $cat_param ?>">
            Previous
          </a>
        </li>

        <?php for ($i = 1; $i <= $total_page; $i++): ?>

        <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
          <a class="page-link" href="?page=<?= $i ?><?= $cat_param ?>">
            <?= $i ?>
          </a>
        </li>

        <?php endfor; ?>

        <li class="page-item <?= ($page >= $total_page) ? 'disabled' : '' ?>">
          <a class="page-link" href="?page=<?= $page + 1 ?><?= $cat_param ?>">
            Next
          </a>
        </li>

      </ul>
    </nav>

    <?php endif; ?>

  </div>

  <!-- SUCCESS MODAL -->
  <div class="modal fade" id="cartSuccessModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-center p-4">
        <div class="modal-body">
          <i class="fa-solid fa-circle-check text-success" style="font-size:70px;"></i>
          <h2 class="mt-3">เพิ่มสินค้าแล้ว!</h2>
          <p class="text-muted">สินค้าได้ถูกเพิ่มลงในตะกร้าเรียบร้อยแล้ว</p>
          <div class="mt-4">
            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">เลือกสินค้าต่อ</button>
            <a href="<?= $base_url; ?>/Cart/cart.php" class="btn btn-primary">ไปที่ตะกร้า</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
  $(document).on('click', '.add-to-cart', function(e) {

    e.preventDefault();

    let btn = $(this);
    let productId = btn.data('id');

    if (!productId) {
      alert("ไม่พบสินค้า");
      return;
    }

    if (btn.prop('disabled')) return;

    btn.prop('disabled', true);

    $.ajax({
      url: '<?= $base_url; ?>/Cart/cart-add.php',
      method: 'POST',
      data: {
        id: productId
      },
      dataType: 'json',

      success: function(response) {

        if (response && response.success) {

          if ($('#cart-count').length) {
            $('#cart-count').text(response.count);
          }

          btn.addClass('bounce');
          setTimeout(() => btn.removeClass('bounce'), 400);

          if ($('#cart-icon').length) {
            $('#cart-icon').addClass('shake');
            setTimeout(() => $('#cart-icon').removeClass('shake'), 500);
          }

          var modal = new bootstrap.Modal(
            document.getElementById('cartSuccessModal')
          );
          modal.show();

        } else {
          alert("เพิ่มสินค้าไม่สำเร็จ");
        }
      },

      error: function(xhr) {
        console.log(xhr.responseText);
        alert("เกิดข้อผิดพลาดในการเชื่อมต่อ");
      },

      complete: function() {
        btn.prop('disabled', false);
      }

    });

  });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <?php include '../include/footer.php'; ?>
</body>


</html>