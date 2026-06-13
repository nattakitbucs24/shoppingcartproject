<style>
.ecom-footer {
  background: rgba(0, 0, 0, .92);
  backdrop-filter: blur(10px);
  border-top: 1px solid rgba(255, 255, 255, .08);
  color: #fff;
}

.footer-brand {
  font-size: 1.8rem;
  font-weight: 700;
}

.footer-brand span {
  color: #00f5ff;
}

.footer-desc {
  color: #94a3b8;
  line-height: 1.8;
}

.footer-title {
  color: #fff;
  font-weight: 600;
  margin-bottom: 18px;
  position: relative;
}

.footer-title::after {
  content: "";
  position: absolute;
  left: 0;
  bottom: -8px;
  width: 45px;
  height: 3px;
  border-radius: 10px;
  background: #00f5ff;
}

.ecom-footer a {
  color: #cbd5e1;
  text-decoration: none;
  margin-bottom: 10px;
  display: block;
  transition: .3s;
}

.ecom-footer a:hover {
  color: #00f5ff;
  transform: translateX(5px);
}

.social-icons a {
  display: inline-flex;
  justify-content: center;
  align-items: center;

  width: 45px;
  height: 45px;

  margin-right: 10px;

  border-radius: 50%;

  background: rgba(255, 255, 255, .08);

  color: #fff;

  transition: .3s;
}

.social-icons a:hover {
  background: #00f5ff;
  color: #000;
  transform: translateY(-5px);

  box-shadow: 0 0 20px rgba(0, 245, 255, .5);
}

.footer-contact i {
  width: 25px;
  color: #00f5ff;
}

.footer-divider {
  border-color: rgba(255, 255, 255, .08);
}

.footer-bottom {
  color: #94a3b8;
  font-size: .95rem;
}
</style>
<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!isset($base_url)) {
  include 'config.php';
}
?>

<footer class="ecom-footer py-5">
  <div class="container">
    <div class="row g-4">

      <!-- Brand -->
      <div class="col-lg-4 col-md-6">

        <div class="footer-brand mb-3">
          <i class="fa-solid fa-store me-2"></i>
          MY <span>STORE</span>
        </div>

        <p class="footer-desc">
          Premium online shopping experience with quality products,
          fast delivery and secure payment solutions.
        </p>

        <?php
        $facebook = "https://www.facebook.com/natakitford.fuesjangam";
        $instagram = "https://www.instagram.com/ntk.1347/";
        $youtube = "https://www.youtube.com/@nsrc24";
        $github = "https://github.com/nattakitbucs24";
        ?>

        <div class="social-icons mt-3">

          <a href="<?= $facebook ?>" target="_blank" rel="noopener noreferrer">
            <i class="fab fa-facebook-f"></i>
          </a>

          <a href="<?= $instagram ?>" target="_blank" rel="noopener noreferrer">
            <i class="fab fa-instagram"></i>
          </a>

          <a href="<?= $youtube ?>" target="_blank" rel="noopener noreferrer">
            <i class="fab fa-youtube"></i>
          </a>

          <a href="<?= $github ?>" target="_blank" rel="noopener noreferrer">
            <i class="fab fa-github"></i>
          </a>

        </div>

      </div>

      <!-- Shop -->
      <div class="col-lg-2 col-md-6">

        <h5 class="footer-title">
          Shop
        </h5>

        <a href="<?= $base_url ?>/index.php">
          Home
        </a>

        <a href="<?= $base_url ?>/Product/product_list.php">
          Products
        </a>

        <a href="<?= $base_url ?>/Product/product_new.php">
          New Arrivals
        </a>

        <a href="<?= $base_url ?>/Product/product_sale.php">
          Sale
        </a>

        <a href="<?= $base_url ?>/Cart/cart.php">
          Cart
        </a>

      </div>

      <!-- Account -->
      <div class="col-lg-3 col-md-6">

        <h5 class="footer-title">
          Account
        </h5>

        <?php if (!isset($_SESSION['user_login'])): ?>

        <a href="<?= $base_url ?>/Signin/signin.php">
          Sign In
        </a>

        <a href="<?= $base_url ?>/Signup/signup.php">
          Sign Up
        </a>

        <?php else: ?>

        <a href="<?= $base_url ?>/user.php">
          My Account
        </a>

        <a href="<?= $base_url ?>/logout.php">
          Logout
        </a>

        <?php endif; ?>

      </div>

      <!-- Contact -->
      <div class="col-lg-3 col-md-6">

        <h5 class="footer-title">
          Contact
        </h5>

        <div class="footer-contact">

          <a href="tel:+66959858529">
            <i class="fa-solid fa-phone"></i>
            +66 95 985 8529
          </a>

          <a href="mailto:nsrcford@outlook.com">
            <i class="fa-solid fa-envelope"></i>
            nsrcford@outlook.com
          </a>

          <a href="#">
            <i class="fa-solid fa-location-dot"></i>
            Bangkok, Thailand
          </a>

        </div>

      </div>

    </div>


    <hr class="footer-divider my-4">

    <div class="footer-bottom text-center">

      © <?= date('Y'); ?> MY STORE

      <span class="mx-2">|</span>

      All Rights Reserved

      <span class="mx-2">|</span>

      Developed with
      <i class="fa-solid fa-heart text-danger"></i>

      by <strong style="color:#00f5ff">Ford Nattakit</strong>

    </div>
  </div> <!-- ปิด container -->

</footer>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>