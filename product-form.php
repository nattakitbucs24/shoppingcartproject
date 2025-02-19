<?php 
session_start();
include 'config.php';

// นำเข้าและเชื่อมต่อกับฐานข้อมูล
$product_name = trim($_POST['product_name']);
$price = $_POST['price'] ?: 0;
$detail = mysqli_real_escape_string($conn, trim($_POST['detail']));
$product_type = mysqli_real_escape_string($conn, $_POST['product_type']); // เพิ่มการเชื่อมต่อและนำเข้า product_type
$image_name = $_FILES['profile_image']['name'];
$image_tmp = $_FILES['profile_image']['tmp_name'];
$folder = 'upload_image/';
$image_location = $folder . $image_name;

// เช็คว่ามีการส่ง ID หรือไม่
if(empty($_POST['id'])) {
    // ถ้าไม่มี ID ให้ทำการเพิ่มข้อมูลใหม่
    $query = mysqli_query($conn, "INSERT INTO products (product_name, price, profile_image, detail, product_type) VALUES ('{$product_name}', '{$price}', '{$image_name}', '{$detail}', '{$product_type}')") or die('query failed');
} else {
    // ถ้ามี ID ให้ทำการอัปเดตข้อมูล
    $query_product = mysqli_query($conn, "SELECT * FROM products WHERE id='{$_POST['id']}'");
    $result = mysqli_fetch_assoc($query_product);

    if(empty($image_name)) {
        $image_name = $result['profile_image'];
    } else {
        @unlink($folder . $result['profile_image']);
    }

    $query = mysqli_query($conn, "UPDATE products SET product_name ='{$product_name}', price ='{$price}', profile_image ='{$image_name}', detail ='{$detail}', product_type ='{$product_type}' WHERE id ='{$_POST['id']}'") or die('query failed');
}

mysqli_close($conn); 

// เช็คว่า Query สำเร็จหรือไม่
if ($query) {
    move_uploaded_file($image_tmp, $image_location);
    $_SESSION['message'] = 'Product Saved success!';
    header('location: ' . $base_url . '/updataproduct.php');
} else {
    $_SESSION['message'] = 'Product could not be Saved! ' . mysqli_error($conn);
    header('location: ' . $base_url . '/updataproduct.php');
}
