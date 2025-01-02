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
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/signup.css">
</head>
<body>
<div class="signup_all">
        <div class="signup_box">
            
    <form method="POST">
        
    <div class="signup_title">
    <div class="logo"></div>
    <h3> Signup - <span>Sarah Krispy Snack</span></h3>
    </div>
        <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
      <div class="forms">
      <label for="name">Full Name:</label>
      <input type="text" placeholder="Enter your full name" name="name" required>
      </div>
        
       <div class="forms">
       <label for="email">Email Address:</label>
       <input type="email" placeholder="Enter your email address" name="email" required>
       </div>
       
        
        <div class="forms">
        <label for="password">Password:</label>
        <input type="password" placeholder="Enter your password " name="password" required>
        </div>
        
      <div class="forms">
      <button type="submit" name="signup">Sign Up</button>
      </div>
    </form>
  <div class="forms">
  <p>Already have an account? <a href="customer_login.php">Login here</a></p>
  <p>Back to Login <a href="index.php">Click here</a></p>
  </div>
        </div>
</div>
</body>
</html>
