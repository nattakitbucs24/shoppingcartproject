<?php
session_start();
include 'config.php';


//product all
$query = mysqli_query($conn, "SELECT * FROM products");
$rows = mysqli_num_rows($query);

// var product form

$result = [
    'id' => '',
    'product_name' => '',
    'price' => '',
    'profile_image' => '',
    'detail' => '',
    'profile_image' => '',
    'product_type'=> '',
];



// product select edit
if(!empty($_GET['id'])) {
    $query_product = mysqli_query($conn, "SELECT * FROM products WHERE id='{$_GET['id']}'");
    $row_product = mysqli_num_rows($query_product);

    if($row_product == 0) {
        header('location:' .  $base_url . '/updataproduct.php');
    }
    
    $result = mysqli_fetch_assoc($query_product);
    
    
}

?>

<!DOCTYPE html>
<html lang="en">  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List product</title>
    <link href="<?php echo $base_url; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/assets/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/assets/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="<?php echo $base_url; ?>/assets/fontawesome/css/solid.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <?php include 'include/navbar.php'; ?>
</head>
<body class="p-3 m-0 border-0 bd-example m-0 border-0">
    <div class="container" style="margin-top: 30px;">
    <?php if(!empty($_SESSION['message'])): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert" >
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php unset($_SESSION['message']); ?>
    <?php endif; ?>



     <div class="row g-5 " class="text-dark">
            <div class="col-md-8 col-sm-12">
                <form action="<?php echo $base_url; ?>/product-form.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $result['id'];?>">
                <div class="row g-3 mb-3">
                    <div class="col-sm-6">
                        <label  class="form-label">ชื่อผลิตภัณฑ์</label>
                        <input type="text" name="product_name" class="form-control" value="<?php echo $result['product_name'] ?>">                   
                    </div>
                    <div class="col-sm-6">
                        <label  class="form-label">ประเภทสินค้า</label>
                        <input type="text" name="product_type" class="form-control" value="<?php echo $result['product_type'] ?>">                   
                    </div>
                    
                    <div class="col-sm-6">
                        <label  class="form-label">ราคา</label>
                    <input type="text" name="price" class="form-control" value="<?php echo $result['price'] ?>">
                </div>  
                
                <div class="col-md-6">
                <?php if(!empty($result['profile_image'])): ?>
                    <div>
                    <img src="<?php echo $base_url; ?>/upload_image/<?php echo $result['profile_image']; ?>" width="100" alt="Product Image">                      
                    </div>   
                    <?php endif; ?>
                    <label for="formFile" class="form-label">เลือกรูป</label>
                    <input type="file"  name="profile_image" class="form-control" accept="image/png, image/jpg, image/jpeg">
                </div>

                <div class="col-sm-12">
                        <label  class="form-label">รายละเอียด</label>
                    <textarea name="detail" class="form-control" rows="3"><?php echo $result['detail'] ?></textarea>
                </div>
            </div>
        </div>
        <div class="w-50 p-4 g-1" >


        <?php if(!empty($result['id'])): ?>
                <button class="btn btn-primary" href="<?php echo $base_url; ?>/updataproduct.php " type="submit"><i class="fa-regular fa-floppy-disk m-1 "></i>อัพเดท</button>
                <?php else: ?>
                    <button class="btn btn-dark" href="<?php echo $base_url; ?>/updataproduct.php " type="submit"><i class="fa-regular fa-floppy-disk m-1 "></i>สร้าง</button>
                <?php endif; ?>
                <a role="button" class="btn btn-danger" href="<?php echo $base_url; ?>/updataproduct.php "><i class="fa-solid fa-rotate-left m-1"></i>ยกเลิก</a>

        </div>
        </form>
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered border-info">
                    <thead>
                        <th style="width: 100px;">รูปภาพ</th>
                        <th>ชื่อผลิตภัณฑ์</th>
                        <th>ประเภทสินค้า</th>
                        <th style="width: 200px;">ราคา</th>
                        <th style="width: 200px;">จัดการ</th>
                    </thead>
                    <tbody>
                        <?php if($rows > 0): ?>
                            <?php while($product = mysqli_fetch_assoc($query)): ?>
                        <tr>
                                <td>    
                                    <?php if(!empty($product['profile_image'])): ?>
                                        <img src="<?php echo $base_url; ?>/upload_image/<?php echo $product['profile_image']; ?>" width="100" alt="Product Image">
                                        <?php else: ?>
                                        <img src="<?php echo $base_url; ?>/assets/images/no-image.png" width="100" alt="Product Image">
                                            <?php endif; ?>
                                </td>
                            <td><?php echo $product['product_name']; ?>
                            <div>
                                <small class="text-muted"><?php echo nl2br ($product['detail']); ?></small>
                            </div>
                        </td>   
                        <td><?php echo $product['product_type']; ?></td>
                            <td><?php echo number_format($product['price'], 2); ?></td>
                            <td>
                                <a role="button" href="<?php echo $base_url; ?>/updataproduct.php?id=<?php echo $product['id']; ?>"class="btn btn-outline-dark"><i class="fa-solid fa-pen-to-square"></i>Edit</a>
                                <a onclick="return confirm('Are you sure want to delete?');" role="button" href="<?php echo $base_url; ?>/product-delete.php?id=<?php echo $product['id']; ?>"class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i>Delete</a>
                            </td>
                            
                        </tr>
                                <?php endwhile;?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4"><h4 class="text-center text-danger">ไม่มีรายการสินค้า</h4></td>
                            </tr>
                            <?php endif; ?>
                            
                    </tbody>  
                        </table> 
                </div>    
        </div>
    </div>



<script src="<?php echo $base_url; ?>/assets/css/bootstrap.min.css" rel="stylesheet"></script>
<script src="<?php echo $base_url; ?>/assets/js/bootstrap.min.js" rel="stylesheet"></script>
<script src="<?php echo $base_url; ?>/assets/js/bootstrap.min.js"></script>


    
</body>
</html>
