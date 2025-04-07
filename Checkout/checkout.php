<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_login'])) {
    header('Location: user.php');
    exit(); 
}


$user_login = $_SESSION['user_login'];

$productIds = [];
foreach (($_SESSION['cart'] ?? []) as $cartId => $cartValue) {
    $productIds[] = $cartId;
}

$ids = 0;
if (count($productIds) > 0) {
    $ids = implode(',', $productIds);
}

// Product query
$query = mysqli_query($conn, "SELECT * FROM products WHERE id IN ($ids)");
$rows = mysqli_num_rows($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List Product</title>
    <link href="<?php echo $base_url; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/assets/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/assets/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/assets/fontawesome/css/solid.min.css" rel="stylesheet">
    <?php include 'include/navbar.php' ?>
</head>

<body class="bg-body-tertiary">
    <div class="container" style="margin-top: 30px;">
        <?php if (!empty($_SESSION['message'])) : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        
        <h4 style="font-size: 30px;">Checkout</h4>
<form action="<?php echo $base_url; ?>/checkout-form.php" method="post">
    <div class="row g-5">
        <div class="col-md-6 ">
            <div class="row g-3">
                <div class="col-sm-6">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter your Name" value="" required>
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Tel.</label>
                    <input type="tel" class="form-control" id="tel" name="tel" placeholder="Enter your telephone number" value="" required>
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" value="" required>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-5 order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary cart">Your cart</span>
                <span class="badge bg-primary rounded-pill cart-count"><?php echo $rows; ?></span>
            </h4>
            <?php if ($rows > 0) : ?>
                <ul class="list-group mb-3">
                    <?php $grand_total = 0; ?>
                    <?php while ($product = mysqli_fetch_assoc($query)) : ?>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0"><?php echo $product['product_name']; ?> (<?php echo $_SESSION['cart'][$product['id']] ?>)</h6>
                                <small class="text-body-secondary"><?php echo nl2br($product['detail']); ?></small>
                                <input type="hidden" name="product[<?php echo $product['id']; ?>][price]" value="<?php echo $product['price']; ?>">
                                <input type="hidden" name="product[<?php echo $product['id']; ?>][name]" value="<?php echo $product['product_name']; ?>">
                            </div>
                            <span class="text-body-secondary">฿<?php echo number_format($_SESSION['cart'][$product['id']] * $product['price'], 2); ?></span>
                        </li>
                        <?php $grand_total += $_SESSION['cart'][$product['id']] * $product['price']; ?>
                    <?php endwhile; ?>
                    <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
                        <div class="text-success">
                            <h6 class="my-0">Grand Total</h6>
                            <small>amount</small>
                        </div>
                        <span class="text-success"><strong>฿<?php echo number_format($grand_total, 2); ?></strong></span>
                    </li>
                </ul>
                <input type="hidden" name="grand_total" value="<?php echo $grand_total; ?>">
            <?php endif; ?>
        </div>
    </div>
    <hr class="my-4">
    <div class="text-center checkout-buttons">
        <a href="<?php echo $base_url; ?>/product-list.php" class="btn btn-secondary btn-lg" role="alert" type="submit">Back</a>
        <button class="btn btn-primary btn-lg" type="submit">Continue to checkout</button>
    </div>
</form>

</html>
