<?php
    include('config.php');
    session_start();
    $user_id = $_SESSION['user_id'];

    if(isset($_POST['update_cart'])){//cập nhật giỏ hàng từ form submit name='update_cart'
        $cart_id = $_POST['cart_id'];
        $cart_quantity = $_POST['cart_quantity'];
        mysqli_query($conn, "UPDATE `carts` SET quantity = '$cart_quantity' WHERE id = $cart_id") or die('query failed');
        echo '<script>';
        echo 'alert("Giỏ hàng đã được cập nhật!");';
        echo '</script>';
     }
  
     if(isset($_GET['delete'])){//xóa sách khỏi giỏ hàng từ onclick href='delete'
        $delete_id = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM `carts` WHERE id = '$delete_id'") or die('query failed');
        echo '<script>';
        echo 'alert("Sản phẩm đã được xóa khỏi giỏ hàng!");';
        echo '</script>';
        header('location: cart.php');
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

    <!--------------- Cart ------------------------->

    <section class="cart">
        <div class="container">
            <div class="cart-top-wrap">
                <div class="cart-top">
                    <div class="cart-top-cart cart-top-item">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="cart-top-adress cart-top-item">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="cart-top-payment cart-top-item">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="cart-content">
                <div class="cart-content-left">
                    <table>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Tên sản phẩm </th>
                            <th>Size</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền SP</th>
                            <th>Xóa SP</th>
                        </tr>
                        <?php
                            $grand_total = 0;
                            $select_cart = mysqli_query($conn, "SELECT * FROM `carts` WHERE user_id = $user_id") or die('query failed');//lấy ra giỏ hàng tương ứng với id người dùng
                            if(mysqli_num_rows($select_cart) > 0){
                                while($fetch_cart = mysqli_fetch_assoc($select_cart)){ 
                                $name_product = $fetch_cart['name'];
                                $select_quantity = mysqli_query($conn, "SELECT * FROM `products` WHERE name='$name_product'");
                                $fetch_quantity = mysqli_fetch_assoc($select_quantity); 
                                $grand_total += $fetch_cart['price'] * $fetch_cart['quantity'];
                        ?>
                        <form method="post">
                            <tr>
                                <td><img src="./admin/uploaded_img/<?php echo ($fetch_cart['image'])  ?>" alt=""></td>
                                <td>
                                    <p><?php echo($fetch_cart['name'])  ?></p>
                                </td>
                                <td>
                                    <p><?php echo($fetch_cart['size'])  ?></p>
                                </td>
                                <td>
                                    <input style="padding-left: 4px; width: 40px;" type="number" min="1" max="<?=$fetch_quantity['quantity']?>" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                                    <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                                    <input style="width: unset;" type="submit" name="update_cart" value="Cập nhật">
                                </td>
                                <td>
                                    <p><?php echo number_format($fetch_cart['price']* $fetch_cart['quantity'],0,',','.' ); ?><sup>đ</sup></p>
                                </td>
                                <td>
                                    <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('Xóa sản phẩm này khỏi giỏ hàng?');">
                                        <span>X</span>
                                    </a>
                                </td>
                            </tr>
                        </form>
                        <?php
                                }
                            }else{
                                echo '<p class="empty">Giỏ hàng của bạn trống!</p>';
                            }
                        ?>
                    </table>
                </div>
                <div class="cart-content-right">
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
                    <div class="cart-content-right-text">
                        <p style="color: red;">* Miễn phí ship với hóa đơn trên 1.000.000 <sup>đ</sup></p>
                    </div>
                    <div class="cart-content-right-button">
                        <a href="product_cate.php"><button>TIẾP TỤC MUA SẮM </button></a>
                        <a href="checkout.php"><button>THANH TOÁN </button></a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!----------------- Footer ----------------->
    <?php  include('footer.php') ?>

</body>

</html>