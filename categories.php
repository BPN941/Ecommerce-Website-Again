<?php
include('connection.php');

// Get category ID from URL
$category_id = isset($_GET['category']) ? $_GET['category'] : 0;

// Fetch products for the selected category
$query = "SELECT * FROM products WHERE category_id = '$category_id'";
$products = mysqli_query($conn, $query);

// Fetch category name
$category_query = "SELECT name FROM categories WHERE id = '$category_id'";
$category_result = mysqli_query($conn, $category_query);
$category_name = mysqli_fetch_assoc($category_result)['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $category_name; ?> - Products</title>
</head>
<body>

<h2><?php echo $category_name; ?> Products</h2>

<div class="product-list">
    <?php while ($row = mysqli_fetch_assoc($products)) { ?>
        <div class="product">
            <h3><?php echo $row['name']; ?></h3>
            <p>Price: $<?php echo $row['price']; ?></p>
            <a href="product-details.php?id=<?php echo $row['id']; ?>">View Details</a>
        </div>
    <?php } ?>
</div>

</body>
</html>
