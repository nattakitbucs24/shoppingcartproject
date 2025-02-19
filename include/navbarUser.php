<!DOCTYPE html >
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="<?php echo $base_url; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/assets/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/assets/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/assets/fontawesome/css/solid.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="<?php echo $base_url; ?>/assets/css/bootstrap.min.css" rel="stylesheet"></script>
    <script src="<?php echo $base_url; ?>/assets/js/bootstrap.min.js" rel="stylesheet"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    
</head>
<body class="p-3 m-0 border-0 bd-example m-0 border-0">
<nav class="navbar navbar-expand-lg bg-black  fixed-top">
  <div class="container-fluid">
  <a class="navbar-brand" aria-current="page" href="<?php echo $base_url; ?>/index.php">
  <img src="<?php echo $base_url; ?>/assets/images/ninja_logo.png" alt="logo" height="50" class="img-circle" >
</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="navbar-brand dropdown">
        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">รายการสินค้า</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?php echo $base_url; ?>/product-listUser.php" >สินค้าทั้งหมด</a></li>
            <li><a class="dropdown-item" href="#">อุปกรณ์พีซี</a></li>
            <li><a class="dropdown-item" href="#">อุปกรณ์คอนโซล</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">อุปกร์ณอื่นๆ</a></li>
          </ul>
        </li> 
        <li class="navbar-brand"><a class="nav-link" href="<?php echo $base_url; ?>/cartUser.php" style="color: white;">ตะกร้าสินค้า</a></li>

        <li class="navbar-brand dropdown">
        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">แจ้งการชำระเงิน</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?php echo $base_url; ?>/paymentUser.php" >ส่งหลักฐานการชำระเงิน</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">เช็คสถานะการชำระเงิน</a></li>
          </ul>
        </li> 
      </ul>      
        
      <form class="d-flex" role="search" method="GET" action="searchUser.php">
                    <label for="Speech Recognition"></label>
                    <input class="form-control me-2"  placeholder="Search" name="keyword" id="speechToText" onclick="record()" >
                                <script>
                                    function record() {
                                        var recognition = new webkitSpeechRecognition();
                                        recognition.lang = "th-en";  // Corrected the variable name from "recognit" to "recogni tion"

                                        recognition.onresult = function(event) {
                                            console.log(event);
                                            document.getElementById('speechToText').value = event.results[0][0].transcript;  // Corrected the result indexing
                                        };

                                        recognition.start();
                                    }
                                </script>
                                 <button class="btn btn-outline-success" type="submit">Search</button>
                                 </form>         
    </div>
    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
    <li class="navbar-brand dropdown"><a class="nav-link" href="<?php echo $base_url; ?>/user.php" style="color: white;"><i class="fa-regular fa-user" style="color: white;"></i></a></li>
    <li> <a href="logout.php" class="btn btn-danger">Logout</a>
        </li>
    
  </div>
</nav>



  
<!-- End Example Code -->
</body>

</html>


