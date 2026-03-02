<?php
session_start();
require_once '../config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$response = [
    'success' => false,
    'count' => 0
];

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $id = (int) $_GET['id'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }

    $response['success'] = true;
    $response['count'] = array_sum($_SESSION['cart']);
}

echo json_encode($response);
exit();