<?php
session_start();

// Initialize the cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle adding items to the cart
if (isset($_POST['addToCart'])) {
    $product_id = $_POST['product_id'];
    $price = $_POST['price'];
    $quantity = 1;

    // Check if the product is already in the cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_id'] == $product_id) {
            $item['quantity'] += 1;
            $found = true;
            break;
        }
    }

    // If the product is not in the cart, add it
    if (!$found) {
        $_SESSION['cart'][] = [
            'product_id' => $product_id,
            'price' => $price,
            'quantity' => $quantity
        ];
    }

    header("Location: cart.php");
    exit();
}

// Handle updating quantities
if (isset($_POST['updateCart'])) {
    foreach ($_POST['quantities'] as $product_id => $quantity) {
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['product_id'] == $product_id) {
                $item['quantity'] = $quantity;
                break;
            }
        }
    }

    header("Location: cart.php");
    exit();
}

// Handle removing items from the cart
if (isset($_POST['removeFromCart'])) {
    $product_id = $_POST['product_id'];
    $_SESSION['cart'] = array_filter($_SESSION['cart'], function($item) use ($product_id) {
        return $item['product_id'] != $product_id;
    });

    header("Location: cart.php");
    exit();
}

// Display Cart Items
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Shopping Cart</h2>
    <?php if (!empty($_SESSION['cart'])): ?>
        <form action="cart.php" method="POST">
            <table>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['product_id']); ?></td>
                            <td>Rs <?php echo htmlspecialchars($item['price']); ?></td>
                            <td>
                                <input type="number" name="quantities[<?php echo htmlspecialchars($item['product_id']); ?>]" value="<?php echo htmlspecialchars($item['quantity']); ?>" min="1">
                            </td>
                            <td>Rs <?php echo htmlspecialchars($item['price'] * $item['quantity']); ?></td>
                            <td>
                                <form action="cart.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($item['product_id']); ?>">
                                    <button type="submit" name="removeFromCart">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" name="updateCart">Update Cart</button>
        </form>
        <a href="checkout.php">Proceed to Checkout</a>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</body>
</html>
