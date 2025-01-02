<?php
require 'db.php'; // Include your database connection file

// Handle customer signup
if (isset($_POST['signup'])) {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $name = $_POST['name'];

    // Check if the email already exists
    $query = "SELECT * FROM customers WHERE email = ?";
    $stmt = $conn->prepare($query); // Use $conn here
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        $error = "Email already exists!";
    } else {
        // Insert new customer into the database
        $query = "INSERT INTO customers (email, password, name) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query); // Use $conn here
        $stmt->execute([$email, $password, $name]);
        header("Location: customer_login.php"); // Redirect to login page
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Signup</title>
    <?php include 'cdn.php'; ?>
</head>
<body>
    <form method="POST">
        <h3>Customer Signup</h3>
        <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
        <label for="name">Full Name:</label>
        <input type="text" name="name" required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        
        <button type="submit" name="signup">Sign Up</button>
    </form>
    <p>Already have an account? <a href="customer_login.php">Login here</a></p>
</body>
</html>
