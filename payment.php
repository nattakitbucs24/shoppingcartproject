<?php
session_start();
include 'config.php';
$order_id = "";
$cusname = "";
$total = 0;



if (isset($_POST['btn1'])) {
    $key_word = $_POST['keyword'];
    if ($key_word != "") {
        $sql = "SELECT * FROM orders WHERE id ='$key_word' ";
        unset($_SESSION['error']);
        $hand = mysqli_query($conn, $sql);
        $num1=mysqli_num_rows($hand);
        if($num1==0) {
             echo "<script>window.location='payment.php';</script>";
            $_SESSION['error']="ไม่พบข้อมูลเลขที่ใบสั่งซื้อ";
        } else {
            $row = mysqli_fetch_array($hand);
            if ($row) {
                $order_id = $row['id'];
                $cusname = $row['fullname'];
                $total = $row['grand_total'];
            } else {
                echo "<script>window.location='payment.php';</script>";
                unset($_SESSION['error']);
            }
        }
        }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List Product</title>
    <link href="<?php echo $base_url; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/assets/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/assets/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/assets/fontawesome/css/solid.min.css" rel="stylesheet">
    <?php include 'include/navbar.php'; ?>
</head>

<body>
    <div class="container">
        <?php if (!empty($_SESSION['message'])) : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="alert alert-success" role="alert">แจ้งการชำระเงิน</div>
                <!--ฟอร์ม หาเลขที่ใบเสร็จ -->
                <form action="<?php echo $base_url; ?>/payment.php" method="post">
                    <div class="border mt-5 p-2 my-2" style="background-color: #f0f0f5">
                        <label class="form-label">เลขที่ใบสั่งซื้อ</label>
                        <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Enter your Name" value=""> <br>
                        <button class="btn btn-success mt-2" type="submit" name="btn1"> ค้นหา </button> <br>
                    </div>
                    <?php
                    if(isset($_SESSION['error'])){
                        echo "<div class='text-danger'> ";
                        echo $_SESSION['error'];
                        echo "</div> ";
                    }
                    ?>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <form method="post" action="<?php echo $base_url; ?>/insertPayment.php" enctype="multipart/form-data">
                    <label class="mt-4">เลขที่ใบสั่งซื้อ</label>
                    <input type="text" name="order_id" required value="<?php echo $order_id; ?>">
                    <label class="mt-4">ชื่อ-นามสกุล (ลูกค้า)</label>
                    <textarea class="form-control" name="cusName" required rows="1"><?php echo $cusname; ?></textarea>
                    <label for="mt-4">จำนวนเงิน</label>
                    <input type="number" class="form-control" name="total_price" required value="<?php echo number_format($total,2); ?>">
                    <label for="mt-4">วันที่โอน</label>
                    <input type="date" class="form-control" name="pay_date" required>
                    <label for="mt-4">เวลาที่โอน</label>
                    <input type="time" class="form-control" name="pay_time" required>
                    <label for="mt-4">หลักฐานการชำระเงิน</label>
                    <input type="file" class="form-control" name="file1" required> <br>
                    <button type="submit" name="btn2" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
