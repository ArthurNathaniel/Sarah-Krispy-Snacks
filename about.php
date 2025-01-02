<?php
require 'db.php';
session_start();
// Calculate cart count
$cartCount = array_sum(array_column($_SESSION['cart'], 'quantity'));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Welcome to Sarah Krispy Snacks & Catering Services! Experience the best plantain chips (ripe and unripe), coated peanuts, and exceptional catering for your events. Quality and tradition in every bite!">
    <meta name="keywords" content="Sarah Krispy Snacks, Catering Services, Plantain Chips, Coated Peanuts, Ripe Plantain Chips, Unripe Plantain Chips, Snacks in Ghana, Quality Snacks, Artisanal Snacks, Event Catering">
    <meta name="author" content="Sarah Krispy Snacks & Catering Services">
    <meta name="robots" content="index, follow">
    <title>About Us - Sarah Krispy Snacks & Catering Services | Artisanal Snacks & Catering</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/about.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="swiper_bg">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="./images/slide_1.jpg" alt="">
                </div>
                <div class="swiper-slide">
                    <img src="./images/slide_2.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="about_text_all">
        <div class="title">
            <h1>About Us – <span>Sarah Krispy Snacks</span></h1>
        </div>
        <div class="about_text">
            <p>
                At Sarah Krispy Snacks, we are passionate about delivering a unique snacking experience that blends tradition
                with modern tastes. Rooted in the rich heritage of plantain chips, we craft artisanal snacks that celebrate
                authentic flavors while meeting the highest standards of quality.
            </p>
            <p>
                Our journey began with a vision: to create snacks that not only satisfy cravings but also tell a story of culture,
                craftsmanship, and care. Each bite of our plantain chips is a tribute to the vibrant traditions and timeless recipes
                that inspire us.
            </p>
            <p>
                We believe in using only the finest ingredients, ensuring that every bag of Sarah Krispy Snacks reflects our commitment
                to excellence. From sourcing premium plantains to perfecting the crispy texture and bold flavors, we strive to provide a
                snack that feels like a connection to something special.
            </p>
            <p>
                Our mission is to bring joy to your everyday moments with snacks that are as authentic as they are delicious. Whether you’re
                enjoying a quick treat or sharing with loved ones, Sarah Krispy Snacks is here to make every occasion memorable.
            </p>
            <p>
                Join us in celebrating the rich flavors and cultural heritage of plantain chips—because at Sarah Krispy Snacks, we don’t just
                make snacks; we create a taste worth savoring.
            </p>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>