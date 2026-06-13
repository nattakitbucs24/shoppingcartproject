<?php
session_start();
require_once '../config.php';
?>

<!DOCTYPE html>
<html lang="th">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Sign In</title>

  <link href="<?= $base_url ?>/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= $base_url ?>/assets/fontawesome/css/fontawesome.min.css" rel="stylesheet">
  <link href="<?= $base_url ?>/assets/fontawesome/css/brands.min.css" rel="stylesheet">
  <link href="<?= $base_url ?>/assets/fontawesome/css/solid.min.css" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;

      background: linear-gradient(135deg,
          #0f2027,
          #203a43,
          #2c5364);

      font-family: 'Segoe UI', sans-serif;
    }

    .login-card {
      width: 100%;
      max-width: 450px;

      background: rgba(255, 255, 255, .08);
      backdrop-filter: blur(15px);

      border: 1px solid rgba(255, 255, 255, .15);
      border-radius: 25px;

      padding: 35px;

      box-shadow: 0 15px 40px rgba(0, 0, 0, .35);
    }

    .logo-icon {
      width: 90px;
      height: 90px;

      background: linear-gradient(135deg, #ffc107, #ffda6a);
      color: #000;

      border-radius: 50%;

      display: flex;
      align-items: center;
      justify-content: center;

      margin: auto;
      margin-bottom: 20px;

      font-size: 38px;
    }

    .login-title {
      color: #fff;
      font-weight: 700;
      text-align: center;
    }

    .login-subtitle {
      color: rgba(255, 255, 255, .7);
      text-align: center;
      margin-bottom: 30px;
    }

    .form-label {
      color: #fff;
    }

    .input-group-text {
      background: rgba(255, 255, 255, .08);
      color: #fff;
      border: 1px solid rgba(255, 255, 255, .15);
    }

    .form-control {
      background: rgba(255, 255, 255, .08);
      color: #fff;
      border: 1px solid rgba(255, 255, 255, .15);
    }

    .form-control::placeholder {
      color: rgba(255, 255, 255, .5);
    }

    .form-control:focus {
      background: rgba(255, 255, 255, .12);
      color: #fff;
      border-color: #ffc107;
      box-shadow: none;
    }

    .btn-login {
      background: #ffc107;
      color: #000;
      font-weight: 600;
      border: none;
      border-radius: 50px;
      padding: 12px;
      transition: .3s;
    }

    .btn-login:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(255, 193, 7, .3);
    }

    .btn-signup {
      border-radius: 50px;
      padding: 12px;
    }

    .back-link {
      color: #ffc107;
      text-decoration: none;
    }

    .back-link:hover {
      color: #fff;
    }

    .divider {
      color: rgba(255, 255, 255, .5);
      text-align: center;
      margin: 20px 0;
    }

    body {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;

      background: linear-gradient(135deg,
          #0f2027,
          #203a43,
          #2c5364);
    }

    .login-card {
      width: 100%;
      max-width: 450px;

      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(15px);

      border: 1px solid rgba(255, 255, 255, 0.12);
      border-radius: 24px;

      padding: 35px;

      box-shadow: 0 20px 50px rgba(0, 0, 0, .35);
    }

    .logo-icon {
      width: 90px;
      height: 90px;

      margin: 0 auto 20px;

      border-radius: 50%;

      display: flex;
      justify-content: center;
      align-items: center;

      background: #ffc107;
      color: #000;

      font-size: 38px;
    }

    .login-title {
      text-align: center;
      color: #fff;
      font-weight: 700;
    }

    .login-subtitle {
      text-align: center;
      color: rgba(255, 255, 255, .7);
      margin-bottom: 30px;
    }

    .form-label {
      color: #fff;
    }

    .input-group-text {
      background: rgba(255, 255, 255, .08);
      color: #fff;
      border: 1px solid rgba(255, 255, 255, .15);
    }

    .form-control {
      background: rgba(255, 255, 255, .08);
      border: 1px solid rgba(255, 255, 255, .15);
      color: #fff;
    }

    .form-control::placeholder {
      color: rgba(255, 255, 255, .5);
    }

    .form-control:focus {
      background: rgba(255, 255, 255, .12);
      color: #fff;
      border-color: #ffc107;
      box-shadow: none;
    }

    .btn-login {
      background: #ffc107;
      color: #000;
      border: none;
      border-radius: 50px;
      padding: 12px;
      font-weight: 600;
      transition: .3s;
    }

    .btn-login:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 25px rgba(255, 193, 7, .35);
    }

    .btn-signup {
      border-radius: 50px;
      padding: 12px;
    }

    .divider {
      text-align: center;
      color: rgba(255, 255, 255, .5);
      margin: 20px 0;
    }

    .back-link {
      color: #ffc107;
      text-decoration: none;
    }

    .back-link:hover {
      color: #fff;
    }
  </style>

</head>

```html

<body>

  <div class="login-card">

    <div class="logo-icon">
      <i class="fas fa-user-lock"></i>
    </div>

    <h2 class="login-title">
      Welcome Back
    </h2>

    <p class="login-subtitle">
      Sign in to continue your account
    </p>

    <form id="loginForm" action="signin_db.php" method="post">

      <div class="mb-3">

        <label class="form-label">
          Email / Username / Phone
        </label>

        <div class="input-group">

          <span class="input-group-text">
            <i class="fas fa-user"></i>
          </span>

          <input type="text" class="form-control" name="login" placeholder="Enter email, username or phone" required
            autocomplete="username">

        </div>

      </div>

      <div class="mb-4">

        <label class="form-label">
          Password
        </label>

        <div class="input-group">

          <span class="input-group-text">
            <i class="fas fa-lock"></i>
          </span>

          <input type="password" class="form-control" name="password" placeholder="Enter your password" required
            autocomplete="current-password">

        </div>

      </div>

      <div class="d-grid">

        <button type="submit" name="signin" class="btn btn-login">

          <i class="fas fa-sign-in-alt me-2"></i>
          Sign In

        </button>

      </div>

    </form>

    <div class="divider">
      OR
    </div>

    <div class="d-grid mb-3">

      <a href="<?= $base_url ?>/Signup/signup.php" class="btn btn-outline-light btn-signup">

        <i class="fas fa-user-plus me-2"></i>
        Create Account

      </a>

    </div>

    <div class="text-center">

      <a href="<?= $base_url ?>" class="back-link">

        <i class="fas fa-arrow-left me-1"></i>
        Back to Home

      </a>

    </div>

  </div>

  <script src="<?= $base_url ?>/assets/js/bootstrap.bundle.min.js"></script>

  <script>
    document.getElementById("loginForm").addEventListener("submit", function() {

      Swal.fire({
        title: 'กำลังเข้าสู่ระบบ...',
        text: 'กรุณารอสักครู่',
        icon: 'info',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => {
          Swal.showLoading()
        }
      });

    });
  </script>

  <?php if (!empty($_SESSION['error'])): ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Login Failed',
        text: '<?= $_SESSION['error']; ?>',
        confirmButtonColor: '#dc3545'
      });
    </script>
  <?php unset($_SESSION['error']);
  endif; ?>

  <?php if (!empty($_SESSION['success'])): ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '<?= $_SESSION['success']; ?>',
        confirmButtonColor: '#198754'
      });
    </script>
  <?php unset($_SESSION['success']);
  endif; ?>

</body>
```


</html>