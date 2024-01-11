<?php
    include('config.php');
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
    <!---------------------------- Slider ------------------------------>
    <section id="Slider">
        <div class="aspect-ratio-169">
            <img src="images/anh-nen-nhe-nhang-don-gian-cuc-dep_025018889.jpg" alt="" class="bgr">
            <img src="images/anh-trang-chu.jpg" alt="" class="bgr">
            <img src="images/chup-anh-quan-ao-thoi-trang.jpg" alt="" class="bgr">
            <img src="images/chup-anh-shop-thoi-trang.jpg" alt="" class="bgr">
            <img src="images/anh-nen.jpg" alt="" class="bgr">
        </div>
        <div class="dot-container">
            <div class="dot active"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </section>
    <!-- -----------------------Footer ----------------------->  
    <?php  include('footer.php') ?>
</body>
<script>
    const imgPosition = document.querySelectorAll(".aspect-ratio-169 img")
    const imgContainer = document.querySelector(".aspect-ratio-169")
   const dotItem = document.querySelectorAll(".dot")
    let imgNumber = imgPosition.length
    let index = 0
    imgPosition.forEach(function (image, index) {
        image.style.left = index * 100 + "%"
        dotItem[index].addEventListener("click",function(){
            slider(index)
        })
    })
    function imgSlide() {
        index++;
        if(index>=imgNumber){index=0}
        slider(index)
    }
    setInterval(imgSlide, 4000)
    function slider(index){
        imgContainer.style.left = "-" + index * 100 + "%"
        const dotActive = document.querySelector('.active')
        dotActive.classList.remove("active")
        dotItem[index].classList.add("active")
    }
</script>

</html>