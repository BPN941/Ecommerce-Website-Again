<?php
include('connection.php');

// Get product ID from URL
$product_id = isset($_GET['id']) ? $_GET['id'] : 0;

// Fetch product details
$query = "SELECT * FROM products WHERE id = '$product_id'";
$product = mysqli_query($conn, $query);
$product_data = mysqli_fetch_assoc($product);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($product_data['name']); ?> - Details</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to the CSS file -->
</head>
<body>

<div class="container">
    <div class="product-details">
        <h2><?php echo htmlspecialchars($product_data['name']); ?></h2>
        <img src="<?php echo htmlspecialchars($product_data['image']); ?>" alt="<?php echo htmlspecialchars($product_data['name']); ?>" class="product-image">
        <p>Price: Rs <?php echo htmlspecialchars($product_data['price']); ?></p>
        <p>Description: <?php echo htmlspecialchars($product_data['description']); ?></p>
        <form action="cart.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product_data['id']); ?>">
            <input type="hidden" name="price" value="<?php echo htmlspecialchars($product_data['price']); ?>">
            <button type="submit" name="addToCart">Add to Cart</button>
        </form>
    </div>
</div>

</body>
</html>
