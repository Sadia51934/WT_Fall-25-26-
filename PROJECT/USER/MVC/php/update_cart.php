<?php
session_start();

$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? '';

if ($action == "cancel") {
    // Clear the cart
    unset($_SESSION['cart']);
    // Redirect to book list page
    header("Location: booklist.php");
    exit();
}

if (!isset($_SESSION['cart'])) {
    header("Location: view_cart.php");
    exit();
}

// Handle increase, decrease, remove actions
foreach ($_SESSION['cart'] as $key => &$item) {

    if ($item['id'] == $id) {

        if ($action == "increase") {
            $item['qty']++;
        }

        if ($action == "decrease" && $item['qty'] > 1) {
            $item['qty']--;
        }

        if ($action == "remove") {
            unset($_SESSION['cart'][$key]);
        }

        break;
    }
}

// Reindex cart after remove
$_SESSION['cart'] = array_values($_SESSION['cart']);

// Redirect back to cart page
header("Location: view_cart.php");
exit();
