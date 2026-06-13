<?php
session_start();
require_once '../config.php';
require_once '../db.php';
?>

<!DOCTYPE html>
<html lang="th">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Categories</title>

  <link href="<?= $base_url ?>/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= $base_url ?>/assets/fontawesome/css/solid.min.css" rel="stylesheet">

</head>

<body>

  <div class="container mt-5">

    <h2 class="mb-4">
      <i class="fa-solid fa-layer-group"></i>
      Product Categories
    </h2>

    <div class="row">

      <?php

      $stmt = $conn->query("SELECT * FROM categories ORDER BY id DESC");

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

      ?>

      <div class="col-md-4 mb-3">

        <div class="card shadow-sm">

          <div class="card-body text-center">

            <h5 class="card-title">
              <?= htmlspecialchars($row['name']) ?>
            </h5>

            <a href="<?= $base_url ?>/Products/products.php?category=<?= $row['id'] ?>" class="btn btn-primary">

              View Products

            </a>

          </div>

        </div>

      </div>

      <?php } ?>

    </div>

  </div>

  <script src="<?= $base_url ?>/assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>