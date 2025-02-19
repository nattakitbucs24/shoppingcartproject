<!DOCTYPE html >
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </head>
<body>
<div id="carouselExample" class="carousel slide">
  <div class="carousel-inner">
    <div class="carousel-item active">
    <img src="<?php echo $base_url; ?>/assets/images/bg/1.png"  class="d-block w-100" alt="Product Image">
    </div>
    <div class="carousel-item">
    <img src="<?php echo $base_url; ?>/assets/images/bg/2.png"  class="d-block w-100" alt="Product Image">
    </div>
    <div class="carousel-item">
    <img src="<?php echo $base_url; ?>/assets/images/bg/3.png"  class="d-block w-100" alt="Product Image">
    </div>
    <div class="carousel-item">
    <img src="<?php echo $base_url; ?>/assets/images/bg/44.png"  class="d-block w-100" alt="Product Image">
    </div>
    <div class="carousel-item">
    <img src="<?php echo $base_url; ?>/assets/images/bg/5.png"  class="d-block w-100" alt="Product Image">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

</body>
</html>


