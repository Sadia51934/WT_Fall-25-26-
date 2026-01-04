<?php
session_start();

/* CHECK LOGIN FIRST */
if (!isset($_SESSION['username'])) {
    $_SESSION['login_error'] = "Please login to add books to cart";
    header("Location: login.php");
    exit();
}

/* Create cart if not exists */
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

/* Add item to cart */
if (!empty($_POST['id']) && !empty($_POST['title']) && isset($_POST['price'])) {

    $id = $_POST['id'];
    $title = htmlspecialchars($_POST['title']);
    $price = (float) $_POST['price'];

    $found = false;

    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $id) {
            $item['qty']++;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = [
            "id" => $id,
            "title" => $title,
            "price" => $price,
            "qty" => 1
        ];
    }
}

header("Location: view_cart.php");
exit();
?>