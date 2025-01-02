<?php
require 'db.php'; // Include your database connection file
session_start();

// Handle customer login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the customer exists
    $query = "SELECT * FROM customers WHERE email = ?";
    $stmt = $conn->prepare($query); // Use $conn here instead of $pdo
    $stmt->execute([$email]);
    $customer = $stmt->fetch();

    if ($customer && password_verify($password, $customer['password'])) {
        $_SESSION['customer_id'] = $customer['id'];
        $_SESSION['customer_email'] = $customer['email'];
        header("Location: index.php"); // Redirect to checkout
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/login.css">

</head>

<body>
    <div class="login_all">
        <div class="login_box">
            <form method="POST">
                <div class="logo"></div>
                <div class="login_title">
                  <h3> Login - <span>Sarah Krispy Snack</span></h3>
                </div>
                <?php if (isset($error)) {
                    echo "<p>$error</p>";
                } ?>
                <div class="forms">
                    <label for="email">Email Address:</label>
                    <input type="email" placeholder="Enter your email address" name="email" required>
                </div>

                <div class="forms">
                    <label for="password">Password:</label>
                    <input type="password" placeholder="Enter your password" name="password" required>
                </div>

                <div class="forms">
                    <button type="submit" name="login">Login</button>
                </div>
                <div class="forms">
                    <p>Don't have an account? <a href="customer_signup.php">Sign up here</a></p>

                </div>
            </form>
        </div>
    </div>
    </div>
</body>

</html>