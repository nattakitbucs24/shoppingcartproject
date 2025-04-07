<?php 
    session_start();
    require_once 'db.php';
    include 'config.php';

    // Execute SQL query to fetch products
    $query = mysqli_query($conn, "SELECT * FROM products");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List Product</title>

  <!-- CSS and JS links -->
  <link href="<?php echo $base_url; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo $base_url; ?>/assets/fontawesome/css/fontawesome.min.css" rel="stylesheet">
  <link href="<?php echo $base_url; ?>/assets/fontawesome/css/brands.min.css" rel="stylesheet">
  <link href="<?php echo $base_url; ?>/assets/fontawesome/css/solid.min.css" rel="stylesheet">
  <script src="<?php echo $base_url; ?>/assets/js/bootstrap.min.js"></script>
  <link href="<?php echo $base_url; ?>/assets/css/docs.css" rel="stylesheet">

  <!-- Include navbar -->
  <?php include 'include/navbar.php'; ?>
</head>


<body class="p-3 mb-2 mg-2" style="background-color:rgb(175, 175, 175);">

  <div class="container mt-4">
    <!-- Display header -->
    <div><?php require_once 'include/header.php'; ?></div>
    <h1 style="color: white;">เครื่องคอนโซล อุปกรณ์ และ เกมหลายๆคุณเลือกซื้อได้</h1>
    <div><?php require_once 'include/list.php'; ?></div>
    <?php include 'footer.php'; ?>


  </div>
</body>

</html>