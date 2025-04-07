<?php 
    session_start();
    require_once 'db.php';
    include 'config.php';

    // Execute SQL query to fetch products
    $query = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List Product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <?php include 'include/navbar.php'; ?>

<body class="bg-light">
  <div class="container mt-5"><br>
    <!-- Display header -->
    <div><?php require_once 'include/header.php'; ?></div><br><br><br> <!-- List Products -->
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

    <!-- Pagination (if needed) -->
    <nav aria-label="Page navigation" class="mt-4">
      <ul class="pagination justify-content-center">
        <!-- Your pagination logic here -->
      </ul>
    </nav>

    <!-- Footer -->
    <div><?php include 'footer.php'; ?></div>
  </div>

  <!-- External JS Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
</body>


</html>