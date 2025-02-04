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
    <title><?php echo $product_data['name']; ?> - Details</title>
</head>
<body>

<h2><?php echo $product_data['name']; ?></h2>
<p>Price: $<?php echo $product_data['price']; ?></p>
<p>Description: <?php echo $product_data['description']; ?></p>
<a href="cart.php?add=<?php echo $product_data['id']; ?>">Add to Cart</a>

</body>
</html>
