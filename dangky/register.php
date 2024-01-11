<?php
   //đăng ksy tài khoản người dùng
   include '../config.php';

   if(isset($_POST['submit'])){

      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
      $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
      // $user_type = $_POST['user_type'];
      $user_type = 'user';

      $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

      if(mysqli_num_rows($select_users) > 0){//kiểm tra email đã tồn tại chưa
      }else{//chưa thì kiểm tra mật khẩu xác nhận và tạo tài khoản
         if($pass != $cpass){
            echo '<script>';
            echo 'alert("Mật khẩu không khớp.");';
            echo '</script>';
         }else{
            mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die('query failed');
            echo '<script>';
            echo 'alert("Đăng ký thành công.");';
            echo '</script>';
         }
      }

   }

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="style.css"/>
</head>
<body>

<form method="post" action="register.php" class="form">

<h2>Đăng ký thành viên</h2>

Họ tên: <input type="text" name="name" placeholder="Nhập họ tên"  value="" required>

Email: <input type="email" name="email" placeholder="Nhập email" value="" required/>

Mật khẩu: <input type="password" name="password" placeholder="Nhập mật khẩu" value="" required/>

Nhập lại mật khẩu: <input type="password" name="cpassword" placeholder="Nhập lại mật khẩu" value="" required/>

<input type="submit" name="submit" value="Đăng Ký"/>
<a href='../dangnhap/login.php' title='Đăng nhập'>Đăng nhập</a> 
</form>

</body>
</html>