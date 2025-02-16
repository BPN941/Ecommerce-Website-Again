<?php
require 'vendor/autoload.php';
include('connection.php');

\Stripe\Stripe::setApiKey('your_stripe_secret_key');

$order_id = $_GET['order_id'];
$session_id = $_GET['session_id'];

$session = \Stripe\Checkout\Session::retrieve($session_id);

if ($session->payment_status == 'paid') {
    // Update the order status to 'Paid'
    $query = "UPDATE orders SET status = 'Paid' WHERE id = '$order_id'";
    mysqli_query($conn, $query);

    echo "Payment Successful! Your order has been placed.";
} else {
    echo "Payment verification failed!";
}
?>