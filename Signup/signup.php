<?php
session_start();
require_once '../db.php';
include '../config.php';
?>

<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>สมัครสมาชิก</title>
  <link href="<?php echo $base_url; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo $base_url; ?>/assets/fontawesome/css/fontawesome.min.css" rel="stylesheet">
  <link href="<?php echo $base_url; ?>/assets/fontawesome/css/brands.min.css" rel="stylesheet">
  <link href="<?php echo $base_url; ?>/assets/fontawesome/css/solid.min.css" rel="stylesheet">
  <style>
  body {
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
  }

  .signup-card {
    width: 100%;
    max-width: 500px;
    padding: 2rem;
    border-radius: 1rem;
    background-color: #fff;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  }
  </style>
</head>

<body>
  <div class="signup-card">
    <h4 class="text-center mb-4"><i class="fas fa-user-plus"></i> สมัครสมาชิก</h4>

    <?php if (isset($_SESSION['error'])) { ?>
    <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php } ?>
    <?php if (isset($_SESSION['success'])) { ?>
    <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php } ?>
    <?php if (isset($_SESSION['warning'])) { ?>
    <div class="alert alert-warning"><?php echo $_SESSION['warning']; unset($_SESSION['warning']); ?></div>
    <?php } ?>

    <form action="signup_db.php" method="post">
      <div class="mb-3">
        <label for="firstname" class="form-label">ชื่อ</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-user"></i></span>
          <input type="text" class="form-control" name="firstname" required>
        </div>
      </div>

      <div class="mb-3">
        <label for="lastname" class="form-label">นามสกุล</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
          <input type="text" class="form-control" name="lastname" required>
        </div>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">อีเมล</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          <input type="email" class="form-control" name="email" required>
        </div>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">รหัสผ่าน</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-lock"></i></span>
          <input type="password" class="form-control" name="password" required>
        </div>
      </div>

      <div class="mb-3">
        <label for="c_password" class="form-label">ยืนยันรหัสผ่าน</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-lock"></i></span>
          <input type="password" class="form-control" name="c_password" required>
        </div>
      </div>

      <div class="d-grid mb-3">
        <button type="submit" name="signup" class="btn btn-success">
          <i class="fas fa-user-plus"></i> สมัครสมาชิก
        </button>
      </div>
    </form>

    <div class="d-flex justify-content-between">
      <a href="/Signin/signin.php" class="btn btn-outline-primary"><i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ</a>
      <a href="<?php echo $base_url; ?>" class="btn btn-link">กลับหน้าหลัก</a>
    </div>
  </div>

  <script src="<?php echo $base_url; ?>/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>