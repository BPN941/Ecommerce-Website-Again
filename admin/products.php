<?php
require_once 'includes/header.php'; // Include the header file
require_once '../config/function.php'; // Include the function file
require_once '../connection.php'; // Include the connection file

// Check if admin is logged in
if (!isset($_SESSION['auth']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

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
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Products</li>
                </ol>
            </nav>
        </div>
    </nav>
    <!-- End Navbar -->

    <div class="container mt-5">
        <h4>Product Lists</h4>
        <a href="products-create.php" class="btn btn-primary float-end mb-3">Add Product</a>

        <!-- Category Filter -->
        <form method="GET" action="products.php" class="mb-3">
            <label for="category">Filter by Category:</label>
            <select name="category" id="category" class="form-select" onchange="this.form.submit()">
                <option value="">All Categories</option>
                <?php while ($row = mysqli_fetch_assoc($categories)) { ?>
                    <option value="<?= htmlspecialchars($row['id']); ?>" <?= $category_id == $row['id'] ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($row['name']); ?>
                    </option>
                <?php } ?>
            </select>
        </form>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (mysqli_num_rows($products) > 0) {
                    while ($productItem = mysqli_fetch_assoc($products)) {
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($productItem['id']); ?></td>
                            <td><?= htmlspecialchars($productItem['name']); ?></td>
                            <td><?= htmlspecialchars($productItem['price']); ?></td>
                            <td><?= htmlspecialchars($productItem['category_id']); ?></td>
                            <td>
                                <a href="products-edit.php?id=<?= htmlspecialchars($productItem['id']); ?>" class="btn btn-success btn-sm">Edit</a>
                                <a href="delete_product.php?id=<?= htmlspecialchars($productItem['id']); ?>" 
                                    class="btn btn-danger btn-sm mx-2"
                                    onclick="return confirm('Are you sure you want to delete this data?')"
                                    >
                                    Delete
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="5">No Record Found</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php include('includes/footer.php'); ?>
</body>
</html>
