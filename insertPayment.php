<?php 
include 'config.php';

$orderID = $_POST['order_id'];
$totalPrice = $_POST['total_price'];
$payDate = $_POST['pay_date'];
$payTime = $_POST['pay_time'];

//อัปโหลดรูป
if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
    $new_image_name = 'b_' . uniqid() . "." . pathinfo($_FILES['file1']['name'], PATHINFO_EXTENSION);
    $image_upload_path = "./upload_image/payment/" . $new_image_name;
    move_uploaded_file($_FILES['file1']['tmp_name'], $image_upload_path);
} else {
    $new_image_name = "";
}

$sql = "INSERT INTO payment (orderID, pay_money, pay_date, pay_time, pay_image)
        VALUES ('$orderID', '$totalPrice', '$payDate', '$payTime', '$new_image_name')";
$hand = mysqli_query($conn, $sql);

if ($hand) {
    echo "<script>window.location='payment.php';</script>";
            $_SESSION['error']="บันทึกข้อมูลเรียบร้อย";
} else {
    echo "<script>window.location='payment.php';</script>";
    $_SESSION['error']="ไม่สามารถบันทึกข้อมูลได้";
}

mysqli_close($conn);
?>
