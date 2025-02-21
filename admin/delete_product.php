<?php
session_start();
include('../connection.php'); // Ensure correct connection

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    // Delete Product using prepared statement
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $result = $stmt->execute();

    if ($result) {
        $_SESSION['message'] = "Product Deleted Successfully!";
    } else {
        $_SESSION['message'] = "Failed to delete product!";
    }

    header("Location: products.php"); // Redirect back to the products page
    exit();
} else {
    $_SESSION['message'] = "Invalid Product ID!";
    header("Location: products.php"); // Redirect back to the products page
    exit();
}
?>
