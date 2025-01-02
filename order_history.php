<?php
require 'db.php'; // Include your database connection file
session_start();

// Check if customer is logged in
if (!isset($_SESSION['customer_id'])) {
    // Redirect to login page if not logged in
    header("Location: customer_login.php");
    exit();
}
// Calculate cart count
$cartCount = array_sum(array_column($_SESSION['cart'], 'quantity'));

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
    <meta name="description" content="View your order history at Sarah Krispy Snacks & Catering Services. Access details of your previous orders, including plantain chips, coated peanuts, and event catering services. Quality in every purchase!">
    <meta name="keywords" content="Order History, Sarah Krispy Snacks, Catering Services, Plantain Chips, Coated Peanuts, Event Orders, Snack Orders, Quality Snacks, Customer Orders">
    <meta name="author" content="Sarah Krispy Snacks & Catering Services">
    <meta name="robots" content="index, follow">
    <title>Order History - Sarah Krispy Snacks & Catering Services</title>
    <?php include 'cdn.php'; ?>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/order_history.css">
</head>

<body>
<?php include 'navbar.php'; ?>
<div class="order-cards">
<div class="order_title">
<h3>Your Order History</h3>
</div>
    <?php if (empty($orders)) { ?>
        <p>No orders found.</p>
    <?php } else { ?>
      
            <?php foreach ($orders as $order) { ?>
                <div class="order-card">
                    <h4>Order ID: <?php echo $order['id']; ?></h4>
                    <p><strong>Pickup/Delivery:</strong> <?php echo $order['pickup_delivery']; ?></p>
                    <p><strong>Address:</strong> <?php echo $order['address']; ?></p>

                    <p><strong>Created At:</strong> <?php echo $order['created_at']; ?></p>
                    <div class="order_items">
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
                            echo '<table class="order-items-table">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th>Item Name</th>';
                            echo '<th>Qty</th>';
                            echo '<th>Total Price</th>'; 
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';
                            foreach ($order_items as $item) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($item['item_name']) . '</td>';
                                echo '<td>' . htmlspecialchars($item['quantity']) . '</td>';
                                echo '<td> GH₵ ' . htmlspecialchars(number_format($item['total_price'], 2)) . '</td>';
                                echo '</tr>';
                            }
                            echo '</tbody>';
                            echo '</table>';
                            echo '<h3><strong>Total:</strong> GHS ' . htmlspecialchars(number_format($order['total'], 2)) . '</h3>';
                        }
                        ?>
                    </div>

                </div>
            <?php } ?>
        </div>
    <?php } ?>
    <?php include 'footer.php'; ?>
</body>

</html>