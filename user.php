<?php 
session_start();
include 'config.php';
require_once 'db.php';

if (!isset($_SESSION['user_login'])) {
    $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
    header('location: signin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <title>User Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="<?php echo $base_url; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo $base_url; ?>/assets/fontawesome/css/fontawesome.min.css" rel="stylesheet">
  <link href="<?php echo $base_url; ?>/assets/fontawesome/css/brands.min.css" rel="stylesheet">
  <link href="<?php echo $base_url; ?>/assets/fontawesome/css/solid.min.css" rel="stylesheet">

  <style>
  body {
    background-color: #f8f9fa;
  }

  .user-card {
    max-width: 500px;
    margin: 80px auto;
    padding: 2rem;
    border-radius: 1rem;
    background-color: #fff;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  }
  </style>
</head>

<body>

  <?php include 'include/navbar.php'; ?>

  <div class="container">
    <?php 
      $user_id = $_SESSION['user_login'];
      $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

    <div class="user-card text-center">
      <h3 class="mb-3"><i class="fas fa-user-circle fa-2x text-primary"></i></h3>
      <h4>ยินดีต้อนรับคุณ</h4>
      <h5 class="text-muted"><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></h5>
      <p class="mt-3">คุณเข้าสู่ระบบเรียบร้อยแล้ว</p>

      <div class="d-flex justify-content-center gap-3 mt-4">
        <a href="<?php echo $base_url; ?>/signout.php" class="btn btn-danger">
          <i class="fas fa-sign-out-alt"></i> ออกจากระบบ
        </a>
        <a href="<?php echo $base_url; ?>" class="btn btn-outline-primary">
          <i class="fas fa-home"></i> หน้าหลัก
        </a>
      </div>
    </div>
  </div>

  <script src="<?php echo $base_url; ?>/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>