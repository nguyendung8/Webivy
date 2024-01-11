<?php 
    include('config.php');
    session_start();

    if(isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
    } else {
        $product_id = 1;
    }
    if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id']; //tạo session người dùng thường
    }

    if(isset($_POST['add_to_cart'])){//thêm sách vào giỏi hàng từ form submit name='add_to_cart'
        if(!$user_id){// session không tồn tại => quay lại trang đăng nhập
            header('location:dangnhap/login.php');
        } else {   
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_image = $_POST['product_image'];
            $product_quantity = $_POST['product_quantity'];
            $size = $_POST['size'];
      
            if($product_quantity==0){
               echo '<script>';
               echo 'alert("Sản phẩm đã hết hàng!");';
               echo '</script>';
            }
            else{
               $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `carts` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
      
               if(mysqli_num_rows($check_cart_numbers) > 0){//kiểm tra sách có trong giỏ hàng chưa và tăng số lượng
                  $result=mysqli_fetch_assoc($check_cart_numbers);
                  $num=$result['quantity']+$product_quantity;
                  $select_quantity = mysqli_query($conn, "SELECT * FROM `products` WHERE name='$product_name'");
                  $fetch_quantity = mysqli_fetch_assoc($select_quantity);
                  if($num>$fetch_quantity['quantity']){
                     $num=$fetch_quantity['quantity'];
                  }
                  mysqli_query($conn, "UPDATE `carts` SET quantity='$num' WHERE name = '$product_name' AND user_id = '$user_id'");
                  echo '<script>';
                  echo 'alert("Sản phẩm đã có trong giỏ hàng và được thêm số lượng!");';
                  echo '</script>';
                  header('location:cart.php');
               }else{
                  mysqli_query($conn, "INSERT INTO `carts`(user_id, name, size, price, quantity, image) VALUES('$user_id', '$product_name', '$size', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
                  $message[] = 'Sản phẩm đã được thêm vào giỏ hàng!';
                  header('location:cart.php');
               }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://kit.fontawesome.com/1147679ae7.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="style.css">
    <title>Qinnn-Shop</title>

</head>

<body>
 <?php  include('header.php') ?>
    
    <!----------------------- Product------------ -->

        <?php  
            $select_product = mysqli_query($conn, "SELECT * FROM products where id = $product_id") or die('query failed');
            $fetch_product = mysqli_fetch_assoc($select_product)
        ?>
    <section class="product">
        <div class="container">
            <form  method="post" class="product-content">
                <div class="product-content-left">
                    <div class="product-content-left-big-img">
                        <img src="./admin/uploaded_img/<?php echo $fetch_product['image'] ?>" alt="">
                    </div>
                </div>
                <div class="product-content-right">
                    <div class="product-content-right-name">
                        <h1><?php echo $fetch_product['name'] ?></h1>
                    </div>
                    <div class="product-content-right-price">
                        <p><span style="font-weight: bold;">Giá :</span>
                        <span><?php echo number_format($fetch_product['price'], 0,',','.') ?><sup>đ</sup></span>
                    </div>
                    <div class="product-content-right-size">
                        <p style="color: red;font-size: 12px;">Xin quý khách chọn size *</p>
                        <span style="font-weight: bold;">Size :</span>
                        <select name="size" class="size">
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>
                    </div>
                    <div class="quantity">
                        <p style="font-weight:bold">Số lượng : </p>
                        <input type="number" min="<?=($fetch_product['quantity']>0) ? 1:0 ?>" max="<?php echo $fetch_product['quantity']; ?>" name="product_quantity" value="<?=($fetch_product['quantity']>0) ? 1:0 ?>" class="qty">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                    </div>
                    <div class="product-content-right-button">
                            <input style="padding-left: 7px; margin-bottom: 10px;" type="submit" value="Thêm vào giỏ hàng" name="add_to_cart" class="btn">
                    </div>
                    <div class="product-content-right-icon">
                        <div class="product-content-right-icon-item">
                            <i class="fas fa-phone-alt"></i>
                            <p>Hotline</p>
                        </div>
                        <div class="product-content-right-icon-item">
                            <i class="far fa-comments"></i>
                            <p>Chat</p>
                        </div>
                        <div class="product-content-right-icon-item">
                            <i class="far fa-envelope"></i>
                            <p>Mail</p>
                        </div>
                    </div>
                    <div class="product-content-right-bottom">
                        <div class="product-content-right-bottom-top">
                            &#8711;
                        </div>     
                        <div class="product-content-right-bottom-content-big">
                            <div class="product-content-right-bottom-content-title">
                                <div class="product-content-right-bottom-content-title-item chitiet">
                                    <p>Giới thiệu</p>
                                </div>
                                <div class="product-content-right-bottom-content-title-item baoquan">
                                    <p>Cách bảo quản</p>
                                </div>
                            </div>
                            <div class="product-content-right-bottom-content">
                                <div class="product-content-right-bottom-content-chitiet">
                                    <p>
                                        <?php echo $fetch_product['describes'] ?>
                                    </p>
                                </div>
                                <div class="product-content-right-bottom-content-baoquan">
                                    <p>
                                    <?php echo $fetch_product['preserve'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!------------------------ Footer-------------------- -->
    <?php  include('footer.php') ?>

</body>
<script>
    const bigImg = document.querySelector(".product-content-left-big-img img")
    const smallImg = document.querySelectorAll(".product-content-left-small-img img")
    smallImg.forEach(function(imgItem,X){
        imgItem.addEventListener("click",function(){
            bigImg.src = imgItem.src
        })
    })
    const baoquan = document.querySelector(".baoquan")
    const chitiet = document.querySelector(".chitiet")
    if(baoquan){
        baoquan.addEventListener("click",function(){
            document.querySelector(".product-content-right-bottom-content-chitiet").style.display = "none"
            document.querySelector(".product-content-right-bottom-content-baoquan").style.display = "block"
        })
    }
    if(baoquan){
        baoquan.addEventListener("click",function(){
           baoquan.style.fontWeight = "bold"
           chitiet.style.fontWeight = "normal"
        })
    }
    if(chitiet){
        chitiet.addEventListener("click",function(){
           chitiet.style.fontWeight = "bold"
           baoquan.style.fontWeight = "normal"
        })
    }
    if(chitiet){
        chitiet.addEventListener("click",function(){
            document.querySelector(".product-content-right-bottom-content-chitiet").style.display = "block"
            document.querySelector(".product-content-right-bottom-content-baoquan").style.display = "none"
        })
    }
    const Button = document.querySelector(".product-content-right-bottom-top")
    if(Button){
        Button.addEventListener("click",function(){
            document.querySelector(".product-content-right-bottom-content-big").classList.toggle("active")
        })
    }
</script>

</html>