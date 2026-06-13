<?php
session_start();
require_once '../config.php';
?>

<!DOCTYPE html>
<html lang="th">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Sign Up</title>

  <link href="<?= $base_url ?>/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= $base_url ?>/assets/fontawesome/css/fontawesome.min.css" rel="stylesheet">
  <link href="<?= $base_url ?>/assets/fontawesome/css/brands.min.css" rel="stylesheet">
  <link href="<?= $base_url ?>/assets/fontawesome/css/solid.min.css" rel="stylesheet">

  <style>
  body {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;

    background: linear-gradient(135deg,
        #0f2027,
        #203a43,
        #2c5364);

    padding: 20px;
  }

  .signup-card {
    width: 100%;
    max-width: 500px;

    background: rgba(255, 255, 255, .08);
    backdrop-filter: blur(15px);

    border: 1px solid rgba(255, 255, 255, .15);
    border-radius: 25px;

    padding: 35px;

    box-shadow: 0 20px 50px rgba(0, 0, 0, .35);
  }

  .logo-icon {
    width: 90px;
    height: 90px;

    margin: 0 auto 20px;

    display: flex;
    justify-content: center;
    align-items: center;

    border-radius: 50%;

    background: #ffc107;
    color: #000;

    font-size: 38px;
  }

  .signup-title {
    color: #fff;
    text-align: center;
    font-weight: 700;
  }

  .signup-subtitle {
    color: rgba(255, 255, 255, .7);
    text-align: center;
    margin-bottom: 25px;
  }

  .form-label {
    color: #fff;
  }

  .input-group-text {
    background: rgba(255, 255, 255, .08);
    border: 1px solid rgba(255, 255, 255, .15);
    color: #fff;
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
    border-color: #ffc107;
    color: #fff;
    box-shadow: none;
  }

  .btn-signup-main {
    background: #ffc107;
    color: #000;
    border: none;

    border-radius: 50px;
    padding: 12px;

    font-weight: 600;
    transition: .3s;
  }

  .btn-signup-main:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(255, 193, 7, .35);
  }

  .btn-signin {
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

  .alert {
    border: none;
  }
  </style>

</head>



<body>

  ```
  <div class="signup-card">

    <div class="logo-icon">
      <i class="fas fa-user-plus"></i>
    </div>

    <h2 class="signup-title">
      Create Account
    </h2>

    <p class="signup-subtitle">
      Join us and start your journey
    </p>

    <?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger rounded-4">
      <?= $_SESSION['error'];
        unset($_SESSION['error']); ?>
    </div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success rounded-4">
      <?= $_SESSION['success'];
        unset($_SESSION['success']); ?>
    </div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['warning'])): ?>
    <div class="alert alert-warning rounded-4">
      <?= $_SESSION['warning'];
        unset($_SESSION['warning']); ?>
    </div>
    <?php endif; ?>

    <form action="signup_db.php" method="post">

      <div class="mb-3">

        <label class="form-label">
          Username
        </label>

        <div class="input-group">

          <span class="input-group-text">
            <i class="fas fa-user"></i>
          </span>

          <input type="text" class="form-control" name="username" placeholder="Enter username" required>

        </div>

      </div>

      <div class="mb-3">

        <label class="form-label">
          Email Address
        </label>

        <div class="input-group">

          <span class="input-group-text">
            <i class="fas fa-envelope"></i>
          </span>

          <input type="email" class="form-control" name="email" placeholder="Enter email address" required>

        </div>

      </div>

      <div class="mb-3">

        <label class="form-label">
          Password
        </label>

        <div class="input-group">

          <span class="input-group-text">
            <i class="fas fa-lock"></i>
          </span>

          <input type="password" class="form-control" name="password" placeholder="Enter password" required>

        </div>

      </div>

      <div class="mb-4">

        <label class="form-label">
          Confirm Password
        </label>

        <div class="input-group">

          <span class="input-group-text">
            <i class="fas fa-shield-alt"></i>
          </span>

          <input type="password" class="form-control" name="c_password" placeholder="Confirm password" required>

        </div>

      </div>

      <div class="d-grid">

        <button type="submit" name="signup" class="btn btn-signup-main">

          <i class="fas fa-user-plus me-2"></i>
          Create Account

        </button>

      </div>

    </form>

    <div class="divider">
      OR
    </div>

    <div class="d-grid mb-3">

      <a href="<?= $base_url ?>/Signin/signin.php" class="btn btn-outline-light btn-signin">

        <i class="fas fa-sign-in-alt me-2"></i>
        Already have an account?

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
  ```

</body>

<script src="<?= $base_url ?>/assets/js/bootstrap.bundle.min.js"></script>


</html>