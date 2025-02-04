<?php
session_start();
include('connection.php');

if (isset($_POST['placeOrder'])) {
    $user_id = $_SESSION['user_id'];
    $total_price = 0;

    foreach ($_SESSION['cart'] as $item) {
        $total_price += $item['price'];
    }

    $query = "INSERT INTO orders (user_id, total_price) VALUES ('$user_id', '$total_price')";
    mysqli_query($conn, $query);

    $_SESSION['cart'] = []; // Clear cart after order
    echo "Order Placed Successfully!";
}
?>

<h2>Checkout</h2>
<form action="checkout.php" method="POST">
    <button type="submit" name="placeOrder">Place Order</button>
</form>
