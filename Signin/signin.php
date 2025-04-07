<?php
session_start();
include '../config.php';
?>

<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>เข้าสู่ระบบ</title>
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

  .login-card {
    width: 100%;
    max-width: 400px;
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    background-color: #fff;
  }

  .form-control:focus {
    box-shadow: none;
    border-color: #0d6efd;
  }
  </style>
</head>

<body>

  <div class="login-card">
    <h4 class="text-center mb-4"><i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ</h4>
    <?php if (isset($_SESSION['error'])) { ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
    <?php } ?>
    <?php if (isset($_SESSION['success'])) { ?>
    <div class="alert alert-success" role="alert">
      <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
    <?php } ?>
    <form action="signin_db.php" method="post">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
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
      <div class="d-grid mb-2">
        <button type="submit" name="signin" class="btn btn-primary">
          <i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ
        </button>
      </div>
    </form>

    <!-- ปุ่มสมัครสมาชิก -->
    <div class="d-grid mb-3">
      <a href="../Signup/signup.php" class="btn btn-outline-secondary">
        <i class="fas fa-user-plus"></i> สมัครสมาชิก
      </a>
    </div>

    <div class="text-center">
      <a href="<?php echo $base_url; ?>" class="btn btn-link">กลับหน้าหลัก</a>
    </div>

    <script src="<?php echo $base_url; ?>/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>