<?php

   include '../config.php';
   session_start();

   if(isset($_POST['submit'])){//lấy thông tin đăng nhập từ form submit name='submit'

      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

      $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

      if(mysqli_num_rows($select_users) > 0){//kiểm tra tài khoản có tồn tại không

         $row = mysqli_fetch_assoc($select_users);
         //kiểm tra quyền của tài khoản và đưa đến trang tương ứng
         if($row['user_type'] == 'admin'){

            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:../admin/admin_products.php');

         }elseif($row['user_type'] == 'user'){

            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('location:../home.php');

         }

      }else{
         $message[] = 'Email hoặc mật khẩu không chính xác!';
      }

   }

?>

<!DOCTYPE html> 
<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<link rel="stylesheet" href="style.css"/> 
</head> 
<style>
     input[type=email] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }
</style>
<body> 
    <form action='login.php' class="dangnhap" method='POST'> 
        Email : <input type='email' name='email' /> 
        Mật khẩu : <input type='password' name='password' /> 
        <input type='submit' class="button" name="submit" value='Đăng nhập' /> 
        <a href='../dangky/register.php' title='Đăng ký'>Đăng ký</a> 
    <form> 
</body> 
</html>