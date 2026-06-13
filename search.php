<?php
session_start();
include 'config.php';

$perpage = 12;

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$start = ($page - 1) * $perpage;

$key_word = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

if (!isset($_GET['keyword'])) {

  $query = null;
  $total_rows = 0;
} else {

  if ($key_word === '') {

    $query = null;
    $total_rows = 0;
  } else {

    $sql = "SELECT * FROM products
            WHERE name LIKE ?
            ORDER BY id DESC
            LIMIT ?, ?";

    $stmt = $conn->prepare($sql);
    $like = "%{$key_word}%";
    $stmt->bind_param("sii", $like, $start, $perpage);
    $stmt->execute();
    $query = $stmt->get_result();

    $count_sql = "SELECT COUNT(*) as total FROM products WHERE name LIKE ?";
    $count_stmt = $conn->prepare($count_sql);
    $count_stmt->bind_param("s", $like);
    $count_stmt->execute();

    $total_rows = $count_stmt->get_result()->fetch_assoc()['total'];
  }
}

$total_page = ceil($total_rows / $perpage);
?>

<!DOCTYPE html>
<html lang="th">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Search</title>

  <link href="<?= $base_url ?>/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= $base_url ?>/assets/fontawesome/css/all.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <style>
  body {
    padding-top: 76px;
    background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
    min-height: 100vh;
  }

  /* title */

  .page-title {
    color: white;
    font-weight: 700;
    letter-spacing: 1px;
  }

  /* product card */

  .product-card {
    border-radius: 20px;
    overflow: hidden;
    background: rgba(255, 255, 255, 0.95);
    transition: 0.35s;
    border: none;
  }

  .product-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 45px rgba(0, 0, 0, 0.45);
  }

  /* image */

  .card-img-top {
    height: 220px;
    object-fit: cover;
  }

  /* price */

  .price-text {
    font-weight: 700;
    color: #00b894;
    font-size: 19px;
  }

  /* add to cart */

  .add-to-cart {
    border-radius: 30px;
    font-weight: 600;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border: none;
    transition: 0.3s;
  }

  .add-to-cart:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(118, 75, 162, 0.5);
  }

  /* empty result */

  .empty-box {
    background: rgba(255, 255, 255, 0.1);
    padding: 50px;
    border-radius: 20px;
    color: white;
    text-align: center;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.15);
  }

  /* pagination */

  .pagination {
    justify-content: center;
    margin-top: 50px;
  }

  .pagination .page-link {
    border: none;
    border-radius: 12px;
    margin: 0 6px;
    background: rgba(255, 255, 255, 0.15);
    color: white;
    transition: 0.25s;
  }

  .pagination .page-link:hover {
    background: #00f5ff;
    color: black;
  }

  .pagination .active .page-link {
    background: #00f5ff;
    color: black;
    font-weight: 600;
  }

  /* responsive */

  @media (max-width:768px) {

    .card-img-top {
      height: 180px;
    }

  }

  .product-card {
    animation: fadeUp 0.5s ease;
  }

  @keyframes fadeUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  </style>

</head>

<body>

  <?php include 'include/header.php'; ?>

  <div class="container pt-4">

    <h2 class="page-title text-center mb-4">
      🔍 Search Results
      <?php if ($key_word !== ''): ?>
      : "<span><?= htmlspecialchars($key_word) ?></span>"
      <?php endif; ?>
    </h2>

    <div class="row g-4">

      <?php if ($query && $query->num_rows > 0): ?>

      <?php while ($product = $query->fetch_assoc()): ?>

      <div class="col-lg-3 col-md-4 col-sm-6">

        <div class="card product-card h-100 border-0 shadow-sm">

          <?php if (!empty($product['img'])): ?>

          <img src="<?= $base_url ?>/assets/images/products/<?= htmlspecialchars($product['img']) ?>"
            class="card-img-top">

          <?php else: ?>

          <img src="<?= $base_url ?>/assets/images/no-image.png" class="card-img-top">

          <?php endif; ?>

          <div class="card-body d-flex flex-column">

            <h5 class="card-title">
              <?= htmlspecialchars($product['name']) ?>
            </h5>

            <p class="card-text text-muted small">
              <?= nl2br(htmlspecialchars($product['detail'])) ?>
            </p>

            <div class="mt-auto">

              <p class="price-text mb-3">
                <?= number_format($product['price'], 2) ?> BAHT
              </p>

              <button class="btn w-100 add-to-cart text-white" data-id="<?= $product['id'] ?>">
                <i class="fa-solid fa-cart-plus me-1"></i>
                เพิ่มลงตะกร้า
              </button>

            </div>

          </div>

        </div>

      </div>

      <?php endwhile; ?>

      <?php elseif (isset($_GET['keyword'])): ?>

      <div class="col-12">
        <div class="empty-box">
          <h4>No products found</h4>
          <p>Try a different keyword</p>
        </div>
      </div>

      <?php endif; ?>

    </div>


    <?php if ($total_page > 1): ?>

    <nav>
      <ul class="pagination">

        <li class="page-item <?= ($page == 1) ? 'disabled' : '' ?>">
          <a class="page-link" href="?keyword=<?= urlencode($key_word) ?>&page=<?= $page - 1 ?>">
            Previous
          </a>
        </li>

        <?php for ($i = 1; $i <= $total_page; $i++): ?>

        <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
          <a class="page-link" href="?keyword=<?= urlencode($key_word) ?>&page=<?= $i ?>">
            <?= $i ?>
          </a>
        </li>

        <?php endfor; ?>

        <li class="page-item <?= ($page == $total_page) ? 'disabled' : '' ?>">
          <a class="page-link" href="?keyword=<?= urlencode($key_word) ?>&page=<?= $page + 1 ?>">
            Next
          </a>
        </li>

      </ul>
    </nav>

    <?php endif; ?>

  </div>


  <script>
  $(document).on('click', '.add-to-cart', function() {

    let btn = $(this);
    let id = btn.data('id');

    btn.prop('disabled', true);

    $.ajax({

      url: '<?= $base_url ?>/Cart/ajax-add-to-cart.php',
      type: 'POST',
      data: {
        id: id
      },
      dataType: 'json',

      success: function(res) {

        if (res.success) {

          $('#cart-count').text(res.count);
          alert('เพิ่มสินค้าแล้ว');

        } else {

          alert('เพิ่มสินค้าไม่สำเร็จ');

        }

      },

      error: function() {
        alert('AJAX Error');
      },

      complete: function() {
        btn.prop('disabled', false);
      }

    });

  });
  </script>

  <?php include 'include/footer.php'; ?>
  <script src="<?= $base_url ?>/assets/js/bootstrap.bundle.min.js"></script>


</body>


</html>