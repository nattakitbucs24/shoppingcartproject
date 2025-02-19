<?php
session_start();
require_once 'db.php';
include 'config.php';
?>



<!DOCTYPE html>
<html lang="en">  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo $base_url; ?>/assets/css/bootstrap.min.css" rel="stylesheet" >
    <link href="<?php echo $base_url; ?>/assets/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/assets/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/assets/fontawesome/css/solid.min.css" rel="stylesheet">
</head>



<body class="p-3 mb-2 bg-light">
<div class="container">
        <h3 class="mt-4">
            สมัครสมาชิก
        </h3>
        <hr>
        <form action="signup_db.php" method="post">
            <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
            </div>
            <?php } ?>
            <?php if(isset($_SESSION['success'])) { ?>
                <div class="alert alert-sucess" role="alert">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
            </div>
            <?php } ?>
            <?php if(isset($_SESSION['warning'])) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php
                    echo $_SESSION['warning'];
                    unset($_SESSION['warning']);
                    ?>
            </div>
            <?php } ?>

            

  <div class="mb-3">
    <label for="firstname" class="form-label">Firstname</label>
    <input type="text" class="form-control" name="firstname"  aria-describedby="firstname">
  </div>
  <div class="mb-3">
    <label for="lastname" class="form-label">Lastname</label>
    <input type="text" class="form-control" name="lastname"  aria-describedby="lastname">
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" name="email"  aria-describedby="email">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" name="password">
  </div>
 
  <div class="mb-3">
    <label for="confirm password" class="form-label">Confirm Password</label>
    <input type="password"  class="form-control" name="c_password">
  </div>
 
  <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
</form>
<hr>
<p><a href="signin.php"  class="btn btn-primary" >เข้าสู่ระบบ</a><p>
    <p><a href="index.php"  class="btn btn-primary">หน้าหลัก</a></p>
    </div> 



    <script src="<?php echo $base_url; ?>/assets/css/bootstrap.min.css" rel="stylesheet"></script>
<script src="<?php echo $base_url; ?>/assets/js/bootstrap.min.js" rel="stylesheet"></script>
<script src="<?php echo $base_url; ?>/assets/js/bootstrap.min.js"></script>


    
</body>
</html>


