<?php 
    include('config.php');
    if(isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
    } else {
        $product_id = 1;
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
            <div class="product-content">
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
                        <p style="font-weight: bold;">Size :</p>
                        <p style="color: red;font-size: 12px;">Xin quý khách chọn size *</p>
                        <div class="size">
                            <span>S</span>
                            <span>M</span>
                            <span>L</span>
                            <span>XL</span>
                        </div>
                    </div>
                    <div class="quantity">
                        <p style="font-weight:bold">Số lượng : </p>
                        <input type="number" min="0" value="1">
                    </div>
                    <div class="product-content-right-button">
                        <button><i class="fas fa-shopping-cart"></i>
                           <a href="cart.html"><p style="padding-left: 7px;">Mua hàng </p></a> 
                        </button>
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