<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];

    $order_id = rand(1000,9999); 

    unset($_SESSION['cart']); // clear cart after order
    echo "<h2>Thank you, $name!</h2>";
    echo "<p>Your order (ID: $order_id) has been placed successfully.</p>";
    echo "<p>We will deliver to: $address</p>";
    echo "<p>Contact: $mobile</p>";
    echo '<a href="booklist.php">Back to Shop</a>';
}
?>
