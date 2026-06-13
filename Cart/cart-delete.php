<?php
session_start();
include '../config.php';

if (!empty($_GET['id'])) {
    unset($_SESSION['cart'][$_GET['id']]);
    $_SESSION['message'] = 'ลบสินค้าสำเร็จ';
}

header('location: ' . $base_url . '/Cart/cart.php');
exit();