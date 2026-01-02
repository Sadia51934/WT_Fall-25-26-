<?php
session_start();

if(isset($_POST['add_cart'])) {

    $id    = $_POST['id'];
    $title = $_POST['title'];
    $price = $_POST['price'];

    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if(isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty'] += 1;
    } else {
        $_SESSION['cart'][$id] = [
            'title' => $title,
            'price' => $price,
            'qty'   => 1
        ];
    }

    header("Location: booklist.php");
}
?>
