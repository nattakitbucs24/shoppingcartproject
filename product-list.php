<?php
session_start();
include 'config.php';

// Set the number of items per page
$perpage = 12;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $perpage;

// Get all products
$query = mysqli_query($conn, "SELECT * FROM products ORDER BY id LIMIT $start, $perpage");
$rows = mysqli_num_rows($query);

// Product select for editing
if (!empty($_GET['id'])) {
    $product_id = $_GET['id'];
    $query_product = mysqli_query($conn, "SELECT * FROM products WHERE id = $product_id");
    $row_product = mysqli_num_rows($query_product);

    if ($row_product == 0) {
        header('location:' . $base_url . '/index.php');
        exit;
    }

    $result = mysqli_fetch_assoc($query_product);
}

// Get total products count for pagination
$sql1 = "SELECT * FROM products";
$query1 = mysqli_query($conn, $sql1);
$total_rows = mysqli_num_rows($query1);
$total_page = ceil($total_rows / $perpage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    
    <link href="<?php echo $base_url; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/assets/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/assets/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/assets/fontawesome/css/solid.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <?php include 'include/navbar.php'; ?>
</head>
<style>
    body {
        background-color: #262626;
    }
    .pagination {
        display: flex;
        justify-content: center;
    }
    .card-img-top {
        height: 200px;
        object-fit: cover;
    }
</style>
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
            <?php if($rows > 0): ?>
                <?php while($product = mysqli_fetch_assoc($query)): ?>
                    <div class="col-md-2 mb-4">
                        <div class="card">
                            <?php if (!empty($product['profile_image'])): ?>
                                <img src="<?php echo $base_url; ?>/upload_image/<?php echo $product['profile_image']; ?>" alt="Product Image" class="card-img-top">
                            <?php else: ?>
                                <img src="<?php echo $base_url; ?>/assets/images/no-image.png" alt="Product Image" class="card-img-top">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?php echo $product['product_name']; ?></h5>
                                <h5 class="card-title fw-bold">ID:<?php echo $product['id']; ?></h5>
                                <p class="card-text text-success fw-bold mb-0"><?php echo number_format($product['price'], 2); ?> BATH</p>
                                <a href="<?php echo $base_url; ?>/cart-add.php?id=<?php echo $product['id']; ?>" class="btn btn-primary w-100">
                                    <i class="fa-solid fa-cart-shopping me-1"></i>Add to Cart
                                </a>
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

        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="product-list.php?page=<?= max(1, $page - 1); ?>">Previous</a>
                </li>
                <?php for ($i = 1; $i <= $total_page; $i++): ?>
                    <li class="page-item <?= $page == $i ? 'active' : ''; ?>">
                        <a class="page-link" href="product-list.php?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item">
                    <a class="page-link" href="product-list.php?page=<?= min($total_page, $page + 1); ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>

    <script src="<?php echo $base_url; ?>/assets/js/bootstrap.min.js"></script>
</body>
</html>
