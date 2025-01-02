<?php
require 'db.php'; // Include database connection
// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
// Calculate cart count
$cartCount = array_sum(array_column($_SESSION['cart'], 'quantity'));
// Check if blog_id is passed in the query string
if (!isset($_GET['blog_id'])) {
    die("Blog not found.");
}

$blog_id = intval($_GET['blog_id']);

// Fetch the blog details from the database
$query = "SELECT * FROM blogs WHERE id = :blog_id";
$stmt = $conn->prepare($query);
$stmt->execute([':blog_id' => $blog_id]);
$blog = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$blog) {
    die("Blog not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars(substr(strip_tags($blog['text_content']), 0, 150)) . '...'; ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($blog['title'], ENT_QUOTES); ?>">
    <title><?php echo htmlspecialchars($blog['title'], ENT_QUOTES); ?></title> <!-- SEO Title -->
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/view_blog.css">
    
</head>
<body>
<?php include 'navbar.php'; ?>
    <div class="blog-container">
        <h1><?php echo htmlspecialchars($blog['title'], ENT_QUOTES); ?></h1>
        <p><strong>Date:</strong> <?php echo htmlspecialchars($blog['date'], ENT_QUOTES); ?></p>
        <?php if ($blog['image_path']): ?>
            <img src="<?php echo htmlspecialchars($blog['image_path'], ENT_QUOTES); ?>" alt="Blog Image">
        <?php endif; ?>
        <div style="margin-top: 20px;">
            <h3>Content:</h3>
            <p><?php echo $blog['text_content']; ?></p> <!-- Display full content with HTML tags -->
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>

