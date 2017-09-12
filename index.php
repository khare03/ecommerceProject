<?php
//require_once "header.php";
include "navHeader.php";
?>

<body>


<!-- Full Page Image Background Carousel Header -->
<header id="myCarousel" class="carousel slide">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for Slides -->
    <div class="carousel-inner">
        <div class="item active">
            <!-- Set the first background image using inline CSS below. -->
            <a href="Home.php">
                <div class="fill"
                     style="background-image:url('http://brandbuildingconsulting.com/wp-content/uploads/2016/01/ecommerce-marketplaces.gif');"></div>
            </a>
            <div class="carousel-caption">
                <h2></h2>
            </div>
        </div>
        <div class="item">
            <!-- Set the second background image using inline CSS below. -->
            <a href="Home.php">
                <div class="fill"
                     style="background-image:url('http://www.foodnavigator-usa.com/var/plain_site/storage/images/publications/food-beverage-nutrition/foodnavigator-usa.com/markets/is-online-grocery-shopping-failing-asks-tabs-analytics/11398297-6-eng-GB/Is-online-grocery-shopping-failing-asks-TABS-Analytics_strict_xxl.jpg');"></div>
            </a>
            <div class="carousel-caption">
                <h2>Best Price, Let The Good Time Roll</h2>
            </div>
        </div>
        <div class="item">
            <!-- Set the third background image using inline CSS below. -->
            <a href="Home.php">
                <div class="fill"
                     style="background-image:url('https://www.apple.com/v/iphone-7/d/images/shared/og.png?201703170823');"></div>
            </a>
            <div class="carousel-caption">
                <h2>Check Out Our Lowest Price</h2>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="icon-prev"></span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="icon-next"></span>
    </a>

</header>

<!-- Page Content -->
<div class="container">

    <div class="row">
        <div class="col-lg-12">
            <h1>One Destination To Buy All You Need At Lowest Price</h1>
            <p>A Different Kind Of Company, A Different Kind Of Best Price</p>
            <h3><a href="Home.php" role="button">Check Out the Best Price</a></h3>
        </div>
    </div>

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Anukrati Khare Website 2017</p>
            </div>
        </div>
        <!-- /.row -->
    </footer>

</div>
<!-- /.container -->

<!-- Script to Activate the Carousel -->
<script>
    $('.carousel').carousel({
        interval: 3000 //changes the speed
    })
</script>

</body>

</html>
