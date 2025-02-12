<?php
session_start();

if (isset($_POST['addToCart'])) {
    $product_id = $_POST['product_id'];
    $price = $_POST['price'];

    $_SESSION['cart'][] = [
        'product_id' => $product_id,
        'price' => $price
    ];

    header("Location: cart.php");
    exit();
}

// Display Cart Items
echo "<h2>Shopping Cart</h2>";
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        echo "Product ID: " . $item['product_id'] . " - Price: Rs " . $item['price'] . "<br>";
    }
    echo '<a href="checkout.php">Proceed to Checkout</a>';
} else {
    echo "Your cart is empty.";
}
?>
