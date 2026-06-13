<?php
session_start();
include '../config.php';

header('Content-Type: application/json; charset=utf-8');

// สร้าง cart ถ้ายังไม่มี
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

$response = [
  'success' => false,
  'count'   => array_sum($_SESSION['cart'])
];

// รับ id จาก AJAX
if (isset($_POST['id']) && is_numeric($_POST['id'])) {

  $id = (int)$_POST['id'];

  if (empty($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id] = 1;
  } else {
    $_SESSION['cart'][$id] += 1;
  }

  $response['success'] = true;
  $response['count']   = array_sum($_SESSION['cart']);
}

echo json_encode($response);
exit;