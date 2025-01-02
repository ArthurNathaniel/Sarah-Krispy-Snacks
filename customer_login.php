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
</head>
<body>
    <form method="POST">
        <h3>Customer Login</h3>
        <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        
        <button type="submit" name="login">Login</button>
    </form>
    <p>Don't have an account? <a href="customer_signup.php">Sign up here</a></p>
</body>
</html>
