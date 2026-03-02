<?php
session_start();
require_once 'db.php';
include 'config.php';

$query = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List Product</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <style>
  /* 🔥 ปุ่มเด้ง */
  .bounce {
    animation: bounce 0.4s;
  }

  @keyframes bounce {
    0% {
      transform: scale(1);
    }

    50% {
      transform: scale(1.2);
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

<body class="bg-light">

  <!-- 🔥 NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">MyShop</a>

      <div class="ms-auto">
        <a href="<?php echo $base_url; ?>/Cart/cart.php" class="btn btn-outline-light position-relative">
          <i id="cart-icon" class="fa-solid fa-cart-shopping"></i>
          <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            <?php echo isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0; ?>
          </span>
        </a>
      </div>
    </div>
  </nav>

  <div class="container mt-5 pt-5">
    <div class="row">

      <?php while ($product = mysqli_fetch_assoc($query)): ?>
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 rounded">

          <img src="<?php echo $base_url; ?>/upload_image/<?php echo $product['profile_image']; ?>" class="card-img-top"
            style="height:200px;object-fit:cover;">

          <div class="card-body">
            <h5 class="card-title"><?php echo $product['product_name']; ?></h5>

            <p class="text-success fw-bold">
              <?php echo number_format($product['price'], 2); ?> BAHT
            </p>

            <button type="button" class="btn btn-primary add-to-cart w-100" data-id="<?php echo $product['id']; ?>">
              <i class="fa-solid fa-cart-plus me-1"></i> Add to Cart
            </button>

          </div>
        </div>
      </div>
      <?php endwhile; ?>

    </div>
  </div>

  <!-- 🔥 SUCCESS MODAL -->
  <div class="modal fade" id="cartSuccessModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-center p-4">

        <div class="modal-body">
          <i class="fa-solid fa-circle-check text-success" style="font-size:70px;"></i>
          <h2 class="mt-3">เพิ่มสินค้าแล้ว!</h2>
          <p class="text-muted">สินค้าได้ถูกเพิ่มลงในตะกร้าเรียบร้อยแล้ว</p>

          <div class="mt-4">
            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">เลือกสินค้าต่อ</button>

            <a href="<?php echo $base_url; ?>/Cart/cart.php" class="btn btn-primary">ไปที่ตะกร้า</a>
          </div>

        </div>
      </div>
    </div>
  </div>

  <!-- 🔥 AJAX -->
  <script>
  $(document).ready(function() {

    $('.add-to-cart').click(function(e) {

      e.preventDefault();

      let btn = $(this);
      let productId = btn.data('id');

      $.ajax({
        url: '<?php echo $base_url; ?>/Cart/cart-add.php',
        method: 'GET',
        data: {
          id: productId
        },
        dataType: 'json',

        success: function(response) {

          if (response.success) {

            // อัปเดตเลขตะกร้า
            $('#cart-count').text(response.count);

            // 🔥 ปุ่มเด้ง
            btn.addClass('bounce');
            setTimeout(() => btn.removeClass('bounce'), 400);

            // 🔥 ไอคอนกระดิก
            $('#cart-icon').addClass('shake');
            setTimeout(() => $('#cart-icon').removeClass('shake'), 500);

            // 🔥 เปิด modal
            var myModal = new bootstrap.Modal(document.getElementById('cartSuccessModal'));
            myModal.show();

          }

        }

      });

    });

  });
  </script>

</body>

</html>