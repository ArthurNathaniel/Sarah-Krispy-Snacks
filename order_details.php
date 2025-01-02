<?php
require 'db.php'; // Include your database connection file
session_start();

// Check if the customer is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: customer_login.php"); // Redirect to login page if not logged in
    exit();
}

$order_id = $_GET['order_id'];
$customer_id = $_SESSION['customer_id'];

// Retrieve order details
$query = "SELECT * FROM orders WHERE id = ? AND customer_id = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$order_id, $customer_id]);
$order = $stmt->fetch();

if (!$order) {
    die("Order not found or you do not have permission to view it.");
}

// Retrieve the products in the order
$query = "SELECT oi.*, p.product_name FROM order_items oi
          JOIN products p ON oi.product_id = p.id
          WHERE oi.order_id = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$order_id]);
$order_items = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <?php include 'cdn.php'; ?>
</head>
<body>
    <h3>Order Details</h3>

    <p><strong>Order Date:</strong> <?php echo $order['order_date']; ?></p>
    <p><strong>Total Amount:</strong> <?php echo number_format($order['total_amount'], 2); ?> USD</p>

    <h4>Products Ordered:</h4>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($order_items as $item): ?>
                <tr>
                    <td><?php echo $item['product_name']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td><?php echo number_format($item['price'], 2); ?> USD</td>
                    <td><?php echo number_format($item['total_price'], 2); ?> USD</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p><a href="order_history.php">Back to Order History</a></p>
</body>
</html>
