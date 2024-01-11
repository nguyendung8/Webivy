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
                        <tr>
                            <td><img src="images/sanpham1.jpg" alt=""></td>
                            <td>
                                <p>Đầm trễ vai xoắn ngực</p>
                            </td>
                            <td>
                                <p>S</p>
                            </td>
                            <td><input type="number" value="1" min="1"></td>
                            <td>
                                <p>700.000 <sup>đ</sup></p>
                            </td>
                            <td>
                                <span>X</span>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="images/sanpham1.2.jpg" alt=""></td>
                            <td>
                                <p>Đầm trễ vai xoắn ngực </p>
                            </td>
                            <td>
                                <p>L</p>
                            </td>
                            <td><input type="number" value="1" min="1"></td>
                            <td>
                                <p>700.000 <sup>đ</sup></p>
                            </td>
                            <td>
                                <span>X</span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="cart-content-right">
                    <table>
                        <tr>
                            <th colspan="2">Tổng tiền trong giỏ hàng</th>
                        </tr>
                        <tr>
                            <td>Tổng sản phẩm </td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>Tổng tiền hàng</td>
                            <td>
                                <p>700.000 <sup> đ</sup></p>
                            </td>
                        </tr>
                        <tr>
                            <td>Tạm tính</td>
                            <td>
                                <p style="color: black;font-weight: bold;">700.000 <sup> đ</sup></p>
                            </td>
                        </tr>
                    </table>
                    <div class="cart-content-right-text">
                        <p style="color: red;">* Miễn phí ship với hóa đơn trên 1.000.000 <sup>đ</sup></p>
                    </div>
                    <div class="cart-content-right-button">
                        <a href="category.html"><button>TIẾP TỤC MUA SẮM </button></a>
                        <button>THANH TOÁN </button>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!----------------- Footer ----------------->
    <?php  include('footer.php') ?>

</body>

</html>