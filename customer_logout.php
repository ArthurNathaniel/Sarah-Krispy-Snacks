<?php
session_start(); // Start the session

// Destroy the session to log the customer out
session_unset(); // Remove all session variables
session_destroy(); // Destroy the session

// Redirect to the login page
header("Location: customer_login.php");
exit(); // Ensure no further code is executed
?>
