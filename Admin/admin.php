<?php 
    include '../config.php';
    session_start();
    require_once '../db.php';
    if (!isset($_SESSION['admin_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: /Singin/signin.php');
    }
    $admin_login = $_SESSION['admin_login'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo $base_url; ?>/assets/fontawesome/css/fontawesome.min.css" rel="stylesheet">
  <link href="<?php echo $base_url; ?>/assets/fontawesome/css/brands.min.css" rel="stylesheet">
  <link href="<?php echo $base_url; ?>/assets/fontawesome/css/solid.min.css" rel="stylesheet">
  <?php include '../include/navbaradmin.php'; ?>
  <style>
  body {
    background-color: #f4f7fa;
  }

  .admin-header {
    margin-top: 30px;
  }

  .card {
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .card-body {
    padding: 30px;
  }

  .card-title {
    font-size: 1.5rem;
    font-weight: 600;
  }

  .card-text {
    font-size: 1.1rem;
  }

  .logout-btn {
    font-weight: bold;
    padding: 10px 20px;
    /* ปรับขนาดของปุ่มให้พอดี */
    font-size: 1rem;
    /* ขนาดข้อความ */
  }


  .back-link {
    font-size: 1.1rem;
  }
  </style>
</head>

<body>
  <div class="container">
    <?php 

      if (isset($_SESSION['admin_login'])) {
          $admin_id = $_SESSION['admin_login'];
          $stmt = $conn->query("SELECT * FROM users WHERE id = $admin_id");
          $stmt->execute();
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
      }
    ?>

    <div class="admin-header">
      <h3 class="text-center">Welcome, Admin</h3>
      <h4 class="text-center"><?php echo $row['firstname'] . ' ' . $row['lastname'] ?></h4>
    </div>

    <div class="card mt-4">
      <div class="card-body">
        <h5 class="card-title">Admin Dashboard</h5>
        <p class="card-text">จัดการข้อมูลทั้งหมดของเว็บไซต์ในที่เดียว</p>
        <p class="card-text">กลับไปที่ <a href="<?php echo $base_url; ?>indexadmin.php" class="back-link">หน้าหลัก</a>
        </p>
        <a href="logout.php" class="btn btn-danger btn-sm logout-btn">ล็อกเอ้า</a>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>