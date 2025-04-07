<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'config.php';

// กำหนดจำนวนสินค้าต่อหน้า (ต้องคงที่ทุกหน้า)
$perpage = 12;

// ตรวจสอบว่าอยู่หน้าไหน
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); // ป้องกันเลขติดลบ

// คำนวณหาจุดเริ่มต้นของสินค้าหน้านั้น
$start = ($page - 1) * $perpage;

// ดึงข้อมูลสินค้าตามหน้าปัจจุบัน
$query = mysqli_query($conn, "SELECT * FROM products ORDER BY id LIMIT $start, $perpage");
$rows = mysqli_num_rows($query);

// นับสินค้าทั้งหมด
$result_total = mysqli_query($conn, "SELECT COUNT(*) as total FROM products");
$total_rows = mysqli_fetch_assoc($result_total)['total'];
$total_page = ceil($total_rows / $perpage); // คำนวณจำนวนหน้าทั้งหมด
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
    <script src="<?php echo $base_url; ?>/assets/js/bootstrap.min.js"></script>
</head>
<style>
    .card {
        border-radius: 12px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card img {
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }

    .card-body {
        text-align: center;
    }

    .btn-primary {
        border-radius: 8px;
        padding: 8px 0;
        font-weight: bold;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 5px;
    }

    .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
    }

    .page-item .page-link:hover {
        background-color: #0056b3;
        color: white;
    }
</style>
<body>

<div class="container mt-4">
    <div class="row">
        <?php if ($rows > 0): ?>
            <?php while ($product = mysqli_fetch_assoc($query)): ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="<?= !empty($product['profile_image']) ? $base_url . '/upload_image/' . $product['profile_image'] : $base_url . '/assets/images/no-image.png'; ?>" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?= $product['product_name']; ?></h5>
                            <p class="card-text text-success fw-bold mb-0"><?= number_format($product['price'], 2); ?> BATH</p>
                            <a href="<?= $base_url; ?>/detail.php?id=<?= $product['id']; ?>" class="btn btn-primary w-100">
                                <i class="fa-regular fa-circle-info"></i> รายละเอียดสินค้า
                            </a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col">
                <h4 class="text-danger text-center">ไม่มีรายการสินค้า</h4>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Pagination -->
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <li class="page-item <?= ($page == 1) ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=<?= max(1, $page - 1); ?>">Previous</a>
        </li>

        <?php for ($i = 1; $i <= $total_page; $i++): ?>
            <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <li class="page-item <?= ($page == $total_page) ? 'disabled' : ''; ?>">
            <a class="page-link" href="?page=<?= min($total_page, $page + 1); ?>">Next</a>
        </li>
    </ul>
</nav>

</body>
</html>


