<?php
session_start();
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('location: ' . $base_url . '/cart.php');
    exit;
}

if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['product']) && is_array($_POST['product'])) {

    foreach ($_POST['product'] as $productId => $data) {

        $productId = (int)$productId;
        $qty = isset($data['quantity']) ? (int)$data['quantity'] : 1;

        if ($qty > 0) {
            $_SESSION['cart'][$productId] = $qty;
        } else {
            unset($_SESSION['cart'][$productId]); // ลบถ้าเป็น 0 หรือติดลบ
        }
    }
}

$_SESSION['message'] = 'Cart Update success';

header('location: ' . $base_url . '/cart.php');
exit;