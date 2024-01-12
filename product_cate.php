<?php
    include('config.php');
    if(isset($_GET['cate_id'])) {
        $cate_id = $_GET['cate_id'];
    } else {
        $cate_id = 1;
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
        <?php  
            $select_categories = mysqli_query($conn, "SELECT * FROM categories where id = $cate_id") or die('query failed');
            $fetch_categories = mysqli_fetch_assoc($select_categories)
        ?>
            <div class="category-top">
                <p>Trang chủ</p> <span>&#10230;</span>
                <p><?php echo $fetch_categories['name'] ?></p>
            </div>
        </div>
        <div class="container">

            <div class="category-left">
                <ul>
                <?php  
                    $select_categories = mysqli_query($conn, "SELECT * FROM categories") or die('query failed');
                    if(mysqli_num_rows($select_categories) > 0){
                        while($fetch_categories = mysqli_fetch_assoc($select_categories)){
                ?>
                        <li class="category-left-li "><a href="./product_cate.php?cate_id=<?php echo $fetch_categories['id'] ?>"><?php echo $fetch_categories['name']; ?></a></li>
                <?php
                        }
                    }else{
                        echo '<p class="empty">Chưa có danh mục nào!</p>';
                    }
                ?>
                </ul>
            </div>
            <div class="category-right">
                <div class="category-right-top">
                    <div class="category-right-top-item">
                    </div>
                    <div class="category-right-top-item">
                        <select onchange="redirectToPage(this.value)">
                            <option>
                                Sắp xếp
                            </option>
                            <option value="?cate_id=<?php echo $cate_id ?>&sort=asc">
                                Giá thấp đến cao
                            </option>
                            <option value="?cate_id=<?php echo $cate_id ?>&sort=desc">
                                Giá cao đến thấp
                            </option>
                        </select>
                    </div>
                </div>
                <?php
                    if(isset($_GET['sort'])) {
                        $sort = $_GET['sort'];
                ?>
                    <div style="gap: 15px; margin-bottom: 83px;" class="category-right-content">
                        <?php  
                            $select_products = mysqli_query($conn, "SELECT * FROM products where cate_id = $cate_id ORDER BY price $sort") or die('query failed');
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
                            } else{
                                echo '<p class="empty">Chưa có sản phẩm nào!</p>';
                            }
                        ?>
                    </div>
                <?php } else {?>
                    <div style="gap: 15px; margin-bottom: 83px;" class="category-right-content">
                        <?php  
                            $select_products = mysqli_query($conn, "SELECT * FROM products where cate_id = $cate_id") or die('query failed');
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
                                echo '<p class="empty">Chưa có sản phẩm nào!</p>';
                            }
                        ?>
                    </div>
                <?php   } ?>
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

    function redirectToPage(url) {
        if (url) {
            window.location.href = url;
        }
    }
</script>

</html>