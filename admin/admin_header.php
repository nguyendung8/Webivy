<?php
   //nhúng vào các trang quản trị
   if(isset($message)){
      foreach($message as $message){//in ra thông báo trên cùng khi biến message được gán giá trị từ các trang quản trị
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>';
      }
   }
?>
<link rel="stylesheet" href="./admin_style.css">
<header class="header">

   <div class="flex">

      <a href="./admin_products.php" class="logo">Quản lý</a>

      <nav style="margin-bottom: 0px !important;min-height: unset !important;" class="navbar">
         <a style="text-decoration: none !important;" href="admin_products.php">Sản phẩm</a>
         <a style="text-decoration: none !important;" href="admin_category.php">Danh mục</a>
         <a style="text-decoration: none !important;" href="admin_users.php">Người dùng</a></a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>Tên người dùng : <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>Email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="../logout.php" class="delete-btn">Đăng xuất</a>
      </div>

   </div>

</header>
<script src="admin_script.js"></script>
