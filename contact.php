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
    <meta name="description" content="Get in touch with Sarah Krispy Snacks & Catering Services! Contact us for the best plantain chips, coated peanuts, and exceptional catering services for your events. We are here to serve you!">
    <meta name="keywords" content="Contact Sarah Krispy Snacks, Catering Services Contact, Plantain Chips, Coated Peanuts, Event Catering, Snacks in Ghana, Customer Support, Quality Snacks">
    <meta name="author" content="Sarah Krispy Snacks & Catering Services">
    <meta name="robots" content="index, follow">
    <title>Contact Us - Sarah Krispy Snacks & Catering Services | Quality Snacks & Catering</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/contact.css">
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
    <div class="contact_us_all">
        <div class="contact_title">
            <h1>Get In Touch</h1>
        </div>
        <div class="contact_grid">
        <div class="ct_box">
                <h3>VISIT US</h3>
                <h1><i class="fa-solid fa-location-arrow"></i></h1>
                <p>
                    Kumasi - Ghana
                </p>
            </div>

            <div class="ct_box">
                <h3>CALL US</h3>
                <h1><i class="fa-solid fa-phone"></i></h1>
                <p>
                    <a href="tel:">+233 000 000 000</a>
                </p>
            </div>

            <div class="ct_box">
                <h3>EMAIL</h3>
                <h1><i class="fa-solid fa-envelope"></i></h1>
                <p>
                    <a href="mailto:info@sarah-krispy-snacks.com">info@sarah-krispy-snacks.com</a>
                </p>
            </div>

        </div>

        <div class="contact_two_all">
            <div class="map"></div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>