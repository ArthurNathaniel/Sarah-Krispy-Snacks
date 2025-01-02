<?php
require 'db.php'; // Include database connection
// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
// Calculate cart count
$cartCount = array_sum(array_column($_SESSION['cart'], 'quantity'));
// Fetch all blogs from the database
$query = "SELECT * FROM blogs ORDER BY date DESC";
$stmt = $conn->prepare($query);
$stmt->execute();
$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Explore our collection of blogs covering a wide range of topics, tips, and news. Stay updated with the latest trends and insights.">
    <meta name="keywords" content="Blog, Our Blog, Articles, News, Trends, Insights, Tips">
    <meta name="author" content="Sarah Krispy Snacks & Catering Services">
    <meta name="robots" content="index, follow">
    <title>Our Blog - Latest Articles & Insights</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/blog.css">
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
    <div class="blog_all">
    <h1 style="text-align:center; margin-top: 20px;">Latest Blogs</h1>

<div class="blog-container">
    <?php foreach ($blogs as $blog): ?>
        <a href="view_blog.php?blog_id=<?php echo $blog['id']; ?>">
        <div class="blog-card">
            <img src="<?php echo htmlspecialchars($blog['image_path'], ENT_QUOTES); ?>" alt="<?php echo htmlspecialchars($blog['title'], ENT_QUOTES); ?>">
            <div class="blog-card-content">
                <h3><?php echo htmlspecialchars($blog['title'], ENT_QUOTES); ?></h3>
                <p><?php echo htmlspecialchars(substr(strip_tags($blog['text_content']), 0, 150)) . '...'; ?></p>
              
                <hr>
                <div class="card_below">
                <p><strong>Sarah-Krispy Snacks</strong> </p>
                <p><strong>Date:</strong> <?php echo htmlspecialchars($blog['date'], ENT_QUOTES); ?></p>
                </div>
            </div>
        </div>
        </a>
    <?php endforeach; ?>
</div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
