<?php
require_once 'includes/header.php'; // Include the header file
require_once '../config/function.php'; // Include the function file
require_once '../connection.php'; // Include the connection file


// Check if admin is logged in
$isAdmin = isset($_SESSION['auth']) && $_SESSION['role'] === 'admin';

// Get category from URL if selected
$category_id = isset($_GET['category']) ? intval($_GET['category']) : null;

// Fetch categories
$category_query = "SELECT * FROM categories";
$categories = mysqli_query($conn, $category_query);
if (!$categories) {
    die("Error fetching categories: " . mysqli_error($conn));
}

// Fetch products based on category using prepared statements
if ($category_id) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = ?");
    $stmt->bind_param("i", $category_id);
} else {
    $stmt = $conn->prepare("SELECT * FROM products");
}
$stmt->execute();
$products = $stmt->get_result();
if (!$products) {
    die("Error fetching products: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add your CSS file -->
</head>
<body>

<h2>Product Categories</h2>
<div class="category-container">
    <a href="products.php" class="btn">All</a> <!-- Show all products -->
    <?php while ($category = mysqli_fetch_assoc($categories)): ?>
        <a href="products.php?category=<?= htmlspecialchars($category['id']) ?>" class="btn"><?= htmlspecialchars($category['name']) ?></a>
    <?php endwhile; ?>
</div>

<h2>Products</h2>
<div class="product-container">
    <?php if ($products->num_rows > 0) { ?>
        <?php while ($product = $products->fetch_assoc()) { ?>
            <div class="product-item">
                <h3><?= htmlspecialchars($product['name']) ?></h3>
                <p><?= htmlspecialchars($product['description']) ?></p>
                <p>Price: $<?= htmlspecialchars($product['price']) ?></p>
                <img src="../<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" width="100">
                <?php if ($isAdmin) { ?>
                    <form action="delete_product.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                        <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                        <button type="submit" name="deleteProduct" class="btn btn-danger">Delete</button>
                    </form>
                <?php } ?>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p>No products found in this category.</p>
    <?php } ?>
</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
