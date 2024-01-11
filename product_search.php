<?php
    include('config.php');
    if(isset($_POST['submit'])) {
        $search_name = $_POST['search'];
    } else {
        $search_name = '';
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
    <!------------------- Category---------------------------- -->
    <section class="category">
        <div class="container">
            <div class="category-right">
                
                <h1>Danh sách sản phẩm theo từ khóa tìm kiểm của bạn</h1>
                <div style="gap: 15px;" class="category-right-content">
                <?php  
                        $select_products = mysqli_query($conn, "SELECT * FROM products where name  LIKE '%{$search_name}%'") or die('query failed');
                        if(mysqli_num_rows($select_products) > 0){
                            while($fetch_product = mysqli_fetch_assoc($select_products)){
                    ?>
                            
                    <div class="category-right-content-item">
                        <a href="product_detail.php?product_id=<?php echo $fetch_product['id'];?>"><img style="width: 280px; height: 390px;" src="./admin/uploaded_img/<?php echo $fetch_product['image'] ?>" alt="">
                        <h1><?php echo $fetch_product['name'] ?></h1>
                        <p><?php echo  number_format($fetch_product['price'], 0,',','.') ?><sup>đ</sup></p></a>
                    </div>
                        <?php
                                }
                            }else{
                                echo '<p class="empty">Không có sản phẩm phù hợp với yêu cầu tìm kiếm của bạn!</p>';
                            }
                        ?>
            </div>


        </div>

    </section>

    <!-- -----------------------Footer ----------------------->
    <?php  include('footer.php') ?>

</body>

<script>
    const itemsSliderbar = document.querySelectorAll(".category-left-li")
    itemsSliderbar.forEach(function (menu, index) {
        menu.addEventListener("click", function () {
            menu.classList.toggle("block")
        })
    })
</script>

</html>