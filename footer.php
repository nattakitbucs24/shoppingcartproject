<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Page Title</title>

  <!-- Link to Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  <style>
  /* Global Styles */
  body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
  }

  /* Footer Styles */
  .footer {
    background-color: #0a0a0a;
    color: #fff;
    padding: 80px 20px;
    font-size: 16px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 20px 30px rgba(0, 0, 0, 0.1);
    text-align: center;
    border-top: 5px solid #f39c12;
  }

  .footer .container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
  }

  .footer .box {
    flex: 1;
    min-width: 250px;
    padding: 20px;
    margin-right: 30px;
    margin-bottom: 30px;
  }

  .footer .box h3 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #fff;
    text-transform: uppercase;
    letter-spacing: 1px;
    position: relative;
    padding-bottom: 10px;
  }

  .footer .box h3::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 60px;
    height: 3px;
    background-color: #f39c12;
  }

  .footer .box a {
    display: block;
    color: #bbb;
    text-decoration: none;
    margin: 8px 0;
    font-size: 16px;
    transition: color 0.3s ease, transform 0.3s ease;
  }

  .footer .box a:hover {
    color: #f39c12;
    padding-left: 10px;
    transform: translateX(5px);
  }

  .footer .box i {
    margin-right: 10px;
  }

  /* Social Icons */
  .footer .social-icons a {
    display: inline-block;
    margin-right: 15px;
    font-size: 20px;
    color: #bbb;
    transition: color 0.3s ease, transform 0.3s ease, background-color 0.3s ease;
    padding: 10px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.2);
  }

  .footer .social-icons a:hover {
    color: #fff;
    background-color: #f39c12;
    transform: scale(1.2);
  }

  /* Background Animation */
  .footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to right, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.3));
    z-index: -1;
  }

  /* Credit Text */
  .footer .credit {
    margin-top: 30px;
    font-size: 14px;
    color: #bbb;
    text-transform: uppercase;
    letter-spacing: 2px;
  }

  .footer .credit span {
    color: #f39c12;
    font-weight: bold;
  }

  /* Mobile and Tablet Responsive */
  @media (max-width: 768px) {
    .footer .container {
      flex-direction: column;
      text-align: center;
    }

    .footer .box {
      margin-right: 0;
      margin-bottom: 30px;
    }
  }
  </style>
</head>

<body>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">

      <div class="box">
        <h3>Quick Links</h3>
        <a href="home.php"><i class="fas fa-angle-right"></i> Home</a>
        <a href="about.php"><i class="fas fa-angle-right"></i> About</a>
        <a href="shop.php"><i class="fas fa-angle-right"></i> Shop</a>
        <a href="contact.php"><i class="fas fa-angle-right"></i> Contact</a>
      </div>

      <div class="box">
        <h3>Extra Links</h3>
        <a href="user_login.php"><i class="fas fa-angle-right"></i> Login</a>
        <a href="user_register.php"><i class="fas fa-angle-right"></i> Register</a>
        <a href="cart.php"><i class="fas fa-angle-right"></i> Cart</a>
        <a href="orders.php"><i class="fas fa-angle-right"></i> Orders</a>
      </div>

      <div class="box">
        <h3>Contact Us</h3>
        <a href="tel:1234567890"><i class="fas fa-phone"></i> +66 959 8529</a>
        <a href="mailto:shaikh@gmail.com"><i class="fas fa-envelope"></i> nattakit_boo8529@outlook.com</a>
        <a href="https://www.google.com/myplace"><i class="fas fa-map-marker-alt"></i>Thailand, Bangkok</a>
      </div>

      <div class="box">
        <h3>Follow Us</h3>
        <div class="social-icons">
          <a href="#" target="_blank"><i class="fab fa-github"></i></a>
          <a href="#" target="_blank"><i class="fab fa-youtube"></i></a>
          <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
          <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
      </div>

    </div>

    <div class="credit">&copy; copyright @ <?= date('Y'); ?> by <span>Nattakit Boonmangam</span> | All Rights Reserved!
    </div>

  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>