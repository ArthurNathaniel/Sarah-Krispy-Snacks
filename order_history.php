<?php
require 'db.php'; // Include your database connection file
session_start();

// Check if customer is logged in
if (!isset($_SESSION['customer_id'])) {
    // Redirect to login page if not logged in
    header("Location: customer_login.php");
    exit();
}

$customer_id = $_SESSION['customer_id']; // Get the logged-in customer's ID

// Fetch orders for the logged-in customer
$query = "SELECT * FROM orders WHERE customer_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->execute([$customer_id]);
$orders = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <?php include 'cdn.php'; ?>
    <style>
        .order-card {
            border: 1px solid #ddd;
            padding: 15px;
            margin: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .order-card h4 {
            margin-bottom: 10px;
        }

        .order-details {
            margin-bottom: 10px;
        }

        .order-items {
            padding-left: 20px;
        }
        
        .order-card p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h3>Your Order History</h3>
    <?php if (empty($orders)) { ?>
        <p>No orders found.</p>
    <?php } else { ?>
        <div class="order-cards">
            <?php foreach ($orders as $order) { ?>
                <div class="order-card">
                    <h4>Order ID: <?php echo $order['id']; ?></h4>
                    <p><strong>Order Name:</strong> <?php echo $order['name']; ?></p>
                    <p><strong>Phone:</strong> <?php echo $order['phone']; ?></p>
                    <p><strong>Email:</strong> <?php echo $order['email']; ?></p>
                    <p><strong>Pickup/Delivery:</strong> <?php echo $order['pickup_delivery']; ?></p>
                    <p><strong>Address:</strong> <?php echo $order['address']; ?></p>
                    <p><strong>Total:</strong> <?php echo $order['total']; ?></p>
                    <p><strong>Created At:</strong> <?php echo $order['created_at']; ?></p>

                    <div class="order-items">
                        <h5>Order Items:</h5>
                        <?php
                        // Fetch order items for the current order
                        $order_id = $order['id'];
                        $item_query = "SELECT oi.item_name, oi.quantity, oi.item_price AS total_price
                                       FROM order_items oi
                                       WHERE oi.order_id = ?";
                        $item_stmt = $conn->prepare($item_query);
                        $item_stmt->execute([$order_id]);
                        $order_items = $item_stmt->fetchAll();
                        
                        if (empty($order_items)) {
                            echo "<p>No items found for this order.</p>";
                        } else {
                            foreach ($order_items as $item) {
                                echo "<p>" . $item['item_name'] . " (Quantity: " . $item['quantity'] . ", Total Price: " . $item['total_price'] . ")</p>";
                            }
                        }
                        ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</body>
</html>
