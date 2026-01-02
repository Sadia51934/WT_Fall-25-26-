<?php
session_start();

/* Create cart if not exists */
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

/* Add item to cart */
if (isset($_POST['id'], $_POST['title'], $_POST['price'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $price = $_POST['price'];

    $item = array(
        "id" => $id,
        "title" => $title,
        "price" => $price,
        "qty" => 1
    );

    $found = false;
    foreach ($_SESSION['cart'] as &$cartItem) {
        if ($cartItem['id'] == $id) {
            $cartItem['qty']++;
            $found = true;
            break;
        }
    }
    if (!$found) {
        $_SESSION['cart'][] = $item;
    }
}

header("Location: view_cart.php");
exit();
?>
