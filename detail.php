<?php
session_start();
include 'config.php';

// เชื่อมต่อฐานข้อมูล
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die('connect failed'); 

// ตรวจสอบการเชื่อมต่อ
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// ตรวจสอบว่ามีการรับค่า id ของสินค้ามาหรือไม่
if (!empty($_GET['id'])) {
    $product_id = $_GET['id'];

    // คำสั่ง SQL เพื่อดึงข้อมูลของสินค้าจากฐานข้อมูล
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = mysqli_query($conn, $sql);

    // ตรวจสอบว่ามีข้อมูลสินค้าหรือไม่
    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        // ถ้าไม่พบสินค้า ให้ redirect ไปที่หน้า product-list.php
        header('location: product-list.php');
        exit();
    }
} else {
    // ถ้าไม่ได้รับค่า id ให้ redirect ไปที่หน้า product-list.php
    header('location: product-list.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <link href="<?php echo $base_url; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- เพิ่ม stylesheet หรือ CDN อื่น ๆ ตามต้องการ -->
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-5 offset-md-3">
                <div class="card">
                    <img src="<?php echo $base_url; ?>/upload_image/<?php echo $product['profile_image']; ?>" class="card-img-top" alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product['product_name']; ?></h5>
                        <p class="card-text">รายละเอียดสินค้า: <?php echo nl2br($product['detail']); ?></p>
                        <p class="card-text">ราคา: <?php echo number_format($product['price'], 2); ?> BATH</p>
                        <p class="class-text">ประเภทสินค้า: <?php echo $product['product_type']; ?></p>
                        <div class="text-center"><a href="<?php echo $base_url; ?>/cart-add.php?id=<?php echo $product['id']; ?>" class="btn btn-success "><i class="fa-solid fa-cart-shopping me-1"></i>Add Cart</a>  </div> <br>
                        <div class="text-center">
                        <p>
                        <a class="btn btn-primary" href="index.php">หน้าหลัก</a>
                        </p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo $base_url; ?>/assets/js/bootstrap.min.js"></script>
    <!-- เพิ่ม script อื่น ๆ ตามต้องการ -->
</body>
</html>

<?php mysqli_close($conn); ?>
