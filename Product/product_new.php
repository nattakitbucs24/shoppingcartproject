<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include '../config.php';

/* ===== ดึงสินค้าใหม่ ===== */

$sql = "SELECT id, name, price, img
        FROM products
        ORDER BY id DESC
        LIMIT 24";

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

  <title>New Products</title>

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

  .product-card {
    border: none;
    border-radius: 20px;
    overflow: hidden;
    transition: 0.3s;
    background: #fff;
  }

  .product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
  }

  .product-img {
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
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
  }
  </style>

</head>

<body>

  <?php include '../include/header.php';; ?>

  <div class="container main-content">

    <h2 class="fw-bold text-white mb-4">
      <i class="fa-solid fa-fire me-2"></i>
      New Products
    </h2>

    <div class="row g-4">

      <?php if (!empty($products)): ?>

      <?php foreach ($products as $product): ?>

      <div class="col-lg-3 col-md-4 col-sm-6">

        <div class="card h-100 product-card position-relative">

          <?php if (!empty($product['img'])): ?>

          <div class="position-absolute top-0 start-0 m-2">
            <span class="badge bg-danger rounded-pill px-3">
              NEW
            </span>
          </div>

          <img src="<?= $base_url ?>/assets/images/products/<?= $product['img'] ?>" class="card-img-top product-img">

          <?php else: ?>

          <img src="<?= $base_url ?>/assets/images/no-image.png" class="card-img-top product-img">

          <?php endif; ?>

          <div class="card-body d-flex flex-column">

            <h5>
              <?= htmlspecialchars($product['name']); ?>
            </h5>

            <div class="rating mb-2">

              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star-half"></i>

              <small>(0 reviews)</small>

            </div>

            <p class="price-tag">

              ฿<?= number_format($product['price'], 2); ?>

            </p>

            <button class="btn btn-warning mt-auto add-to-cart rounded-pill" data-id="<?= $product['id']; ?>">

              <i class="fa-solid fa-cart-plus me-1"></i>
              Add to Cart

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

  </div>

  <!-- SUCCESS MODAL -->

  <div class="modal fade" id="cartSuccessModal" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

      <div class="modal-content text-center p-4 border-0 rounded-4 shadow-lg">

        <div class="modal-body">

          <div class="mb-3">

            <i class="fa-solid fa-circle-check text-success" style="font-size:70px"></i>

          </div>

          <h3 class="fw-bold">
            เพิ่มสินค้าแล้ว!
          </h3>

          <p class="text-muted mb-4">
            สินค้าได้ถูกเพิ่มลงในตะกร้าเรียบร้อยแล้ว
          </p>

          <div class="d-flex justify-content-center gap-3">

            <button class="btn btn-outline-secondary px-4 rounded-pill" data-bs-dismiss="modal">

              เลือกสินค้าต่อ

            </button>

            <a href="<?= $base_url; ?>/Cart/cart.php" class="btn btn-primary px-4 rounded-pill">

              ไปที่ตะกร้า

            </a>

          </div>

        </div>

      </div>

    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
  $(document).on('click', '.add-to-cart', function(e) {

    e.preventDefault();

    let btn = $(this);
    let id = btn.data('id');

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

      beforeSend: function() {

        btn.html('<span class="spinner-border spinner-border-sm me-2"></span>Adding...');

      },

      success: function(res) {

        if (res.success) {

          $('#cart-count').text(res.count);

          var modal = new bootstrap.Modal(document.getElementById('cartSuccessModal'));

          modal.show();

        } else {

          alert("เพิ่มสินค้าไม่สำเร็จ");

        }

      },

      error: function() {

        alert("AJAX ERROR");

      },

      complete: function() {

        btn.prop('disabled', false);

        btn.html('<i class="fa-solid fa-cart-plus me-1"></i> Add to Cart');

      }

    });

  });
  </script>

  <?php include '../include/footer.php';; ?>

</body>

</html>