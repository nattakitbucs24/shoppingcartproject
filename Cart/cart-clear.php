<?php
session_start();
require_once '../config.php';

// ล้างตะกร้า
unset($_SESSION['cart']);

// flash message
$_SESSION['message'] = "ลบสินค้าทั้งหมดเรียบร้อยแล้ว";

// กลับไปหน้าตะกร้า
header("Location: " . $base_url . "/Cart/cart.php");
exit();