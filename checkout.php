<?php

   include 'config.php';

   session_start();

   $user_id = $_SESSION['user_id']; //tạo session người dùng thường

   if(!isset($user_id)){// session không tồn tại => quay lại trang đăng nhập
      header('location:login.php');
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Thanh toán</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <style>
      .title {
         text-align: center;
      }
      .display-order {
         margin-top: 50px;
      }
      .container {
         display: flex;
         flex-direction: column;
         align-items: center;
         gap: 40px;
      }
   </style>
</head>
<body>
   
<?php include 'header.php'; ?>
<div class="container">
   <section class="display-order">
      
      <h1 class="title"> Thanh toán</h1>
      <?php  
         $grand_total = 0;
         $select_cart = mysqli_query($conn, "SELECT * FROM `carts` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
               $total_price = $fetch_cart['price'] * $fetch_cart['quantity'];
               $grand_total += $total_price;
      ?>
      <?php
            }
      ?>
      <table>
         <tr>
               <th colspan="2">Tổng tiền trong giỏ hàng</th>
         </tr>
         <tr>
               <td>Tổng sản phẩm </td>
               <td><?php echo mysqli_num_rows($select_cart)  ?></td>
         </tr>
         <tr>
               <td>Tổng tiền hàng</td>
               <td>
                  <p><?php echo number_format($grand_total,0,',','.' ); ?><sup> đ</sup></p>
               </td>
         </tr>
         <tr>
               <td>Tạm tính</td>
               <td>
                  <p style="color: black;font-weight: bold;"><?php echo number_format($grand_total,0,',','.' ); ?><sup> đ</sup></p>
               </td>
         </tr>
      </table>
      <?php
         }else{
            echo '<p class="empty">Giỏ hàng của bạn trống!</p>';
         }
      ?>
   </section>
   <section class="checkout">

      <form action="" method="post">
         <h3>Nhập thông tin đơn hàng</h3>
         <div class="flex">
            <div class="inputBox">
               <span>Họ tên:</span>
               <input type="text" name="name" required placeholder="Nguyễn Văn A">
            </div>
            <div class="inputBox">
               <span>Số điện thoại :</span>
               <input type="number" name="number" required placeholder="0123456789">
            </div>
            <div class="inputBox">
               <span>Email :</span>
               <input type="email" name="email" required placeholder="abc@gmail.com">
            </div>
            <div class="inputBox">
               <span>Phương thức thanh toán :</span>
               <select name="method">
                  <option value="Tiền mặt khi nhận hàng">Tiền mặt khi nhận hàng</option>
                  <option value="Thẻ ngân hàng">Thẻ ngân hàng</option>
                  <option value="Paypal">Paypal</option>
               </select>
            </div>
            <div class="inputBox">
               <span>Địa chỉ :</span>
               <input type="text" name="street" required placeholder="Số nhà, số đường, phường/xã, huyện/thị xã">
            </div>
            <div class="inputBox">
               <span>Thành phố:</span>
               <input type="text" name="city" required placeholder="Hà Nội">
            </div>
            <div class="inputBox">
               <span>Nước :</span>
               <input type="text" name="country" required placeholder="Việt Nam">
            </div>
            <div class="inputBox">
               <span>Ghi chú:</span>
               <input type="text" name="note" required placeholder="Lời nhắn">
            </div>
         </div>
         <input type="submit" value="Đặt hàng" class="btn" name="order_btn">
      </form>

   </section>
</div>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>