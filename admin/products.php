<?php
include('../connection.php');

if (isset($_GET['category'])) {
    $category_id = $_GET['category'];
    $query = "SELECT * FROM products WHERE category_id = $category_id";
} else {
    $query = "SELECT * FROM products"; // Show all products if no category is selected
}
$products = mysqli_query($conn, $query);
?>

<h2>Products</h2>
<div class="product-container">
    <?php while ($product = mysqli_fetch_assoc($products)) { ?>
        <div class="product">
            <h3><?= $product['name']; ?></h3>
            <p>Price: $<?= $product['price']; ?></p>
            <a href="product-details.php?id=<?= $product['id']; ?>">View Details</a>
            <form action="cart.php" method="POST">
                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                <input type="hidden" name="price" value="<?= $product['price']; ?>">
                <button type="submit" name="addToCart">Add to Cart</button>
            </form>
        </div>
    <?php } ?>
</div>
