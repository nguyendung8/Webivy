<?php
    include('config.php');
?>
    <link rel="stylesheet" href="style.css">
<section class="fixed-header">
        <div class="logo">
           <a href="./home.php"><img src="images/Logo.png" alt=""></a> 
        </div>
        <div class="menu"><a href=""></a>
        <?php  
            $select_categories = mysqli_query($conn, "SELECT * FROM categories") or die('query failed');
            if(mysqli_num_rows($select_categories) > 0){
                while($fetch_categories = mysqli_fetch_assoc($select_categories)){
        ?>
                <li><a href="./product_cate.php?cate_id=<?php echo $fetch_categories['id'] ?>"><?php echo $fetch_categories['name']; ?></a></li>
        <?php
                }
            }else{
                echo '<p class="empty">Chưa có danh mục nào!</p>';
            }
        ?>
        </div>
        <div class="others">
            <li>
            <form action="./product_search.php" method="post">
                <input name="search" placeholder="Tim kiem" type="text" style="height: 20px;padding-left: 5px;"><i class="fas fa-search" style="margin-top: 2px;"></i>
                <input type="submit" name="submit" value="Tìm kiếm" class="btn">
            </form>
                
            </li>
            <!-- <li><a href="" class="fa fa-paw"></a></li> -->
            <li><a href="dangnhap/login.php" class="fa fa-user"></a></li>
            <li><a href="" class="fa fa-shopping-bag"></a></li>
        </div>
    </section>