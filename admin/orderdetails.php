<?php
// filepath: /c:/xampp/htdocs/ecommerce/admin/orderdetails.php
session_start();
include('../connection.php');

// Check if the admin is logged in
if (!isset($_SESSION['auth']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$order_id = $_GET['order_id'];

// Fetch order details from the database
$query = "SELECT * FROM orders WHERE id = '$order_id'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching order details: " . mysqli_error($conn));
}

$order = mysqli_fetch_assoc($result);

if (!$order) {
    die("Order not found!");
}

// Fetch user details
$user_id = $order['user_id'];
$user_query = "SELECT * FROM users WHERE id = '$user_id'";
$user_result = mysqli_query($conn, $user_query);

if (!$user_result) {
    die("Error fetching user details: " . mysqli_error($conn));
}

$user = mysqli_fetch_assoc($user_result);

if (!$user) {
    die("User not found!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Details</title>
    <link rel="stylesheet" href="../styles.css"> <!-- Add your CSS file -->
</head>
<body>
    <?php include('includes/navbar.php'); ?>

    <div class="container">
        <h2>Order Details</h2>
        <table>
            <tr>
                <th>Order ID</th>
                <td><?php echo htmlspecialchars($order['id']); ?></td>
            </tr>
            <tr>
                <th>User Name</th>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
            </tr>
            <tr>
                <th>Delivery Location</th>
                <td><?php echo htmlspecialchars($order['delivery_location']); ?></td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td><?php echo htmlspecialchars($order['phone_number']); ?></td>
            </tr>
            <tr>
                <th>Total Price</th>
                <td>Rs <?php echo htmlspecialchars($order['total_price']); ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?php echo htmlspecialchars($order['status']); ?></td>
            </tr>
            <tr>
                <th>Order Date</th>
                <td><?php echo htmlspecialchars($order['created_at']); ?></td>
            </tr>
        </table>
        <a href="orders.php" class="btn">Back to Orders</a>
    </div>

    <?php include('includes/footer.php'); ?>
</body>
</html>