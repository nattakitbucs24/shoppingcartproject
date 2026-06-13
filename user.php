<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

include 'config.php';
require_once 'db.php';

if (!isset($_SESSION['user_login'])) {
  $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
  header('location: signin.php');
  exit();
}

$user_id = $_SESSION['user_login'];

$stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $user_id]);

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
  header("location: signin.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <title>User Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="<?= $base_url ?>/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= $base_url ?>/assets/fontawesome/css/fontawesome.min.css" rel="stylesheet">
  <link href="<?= $base_url ?>/assets/fontawesome/css/brands.min.css" rel="stylesheet">
  <link href="<?= $base_url ?>/assets/fontawesome/css/solid.min.css" rel="stylesheet">

  <style>
  body {
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    min-height: 100vh;
  }

  .dashboard-card {
    max-width: 600px;
    margin: 80px auto;
    border-radius: 20px;
    padding: 40px;
    background: white;
    box-shadow: 0 20px 40px rgba(0, 0, 0, .15);
    text-align: center;
  }

  .avatar {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    background: #0d6efd;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 45px;
    margin: auto;
    margin-bottom: 20px;
  }

  .user-info {
    margin-top: 20px;
  }

  .user-info p {
    margin: 4px 0;
    color: #6c757d;
  }

  .action-btns {
    margin-top: 30px;
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
  }
  </style>

</head>

<body>

  <?php include 'include/header.php'; ?>

  <div class="container">

    <div class="dashboard-card">

      <div class="avatar">
        <i class="fas fa-user"></i>
      </div>

      <h3 class="fw-bold">
        <?= htmlspecialchars($row['username'] . ' ' . $row['email']) ?>
      </h3>

      <div class="user-info">

        <p>
          <i class="fas fa-user me-2"></i>
          <?= htmlspecialchars($row['username']) ?>
        </p>

        <p>
          <i class="fas fa-envelope me-2"></i>
          <?= htmlspecialchars($row['email']) ?>
        </p>

        <p>
          <i class="fas fa-id-badge me-2"></i>
          Role : <?= htmlspecialchars($row['role']) ?>
        </p>

      </div>

      <div class="action-btns">

        <a href="<?= $base_url ?>" class="btn btn-primary">
          <i class="fas fa-store"></i> ไปที่ร้านค้า
        </a>

        <a href="<?= $base_url ?>/Cart/cart.php" class="btn btn-outline-dark">
          <i class="fas fa-shopping-cart"></i> ตะกร้า
        </a>

        <a href="<?= $base_url ?>/logout.php" class="btn btn-danger">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>

      </div>

    </div>

  </div>

  <script src="<?= $base_url ?>/assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>