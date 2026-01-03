<?php
session_start();

if (!isset($_SESSION['cart'])) {
    header("Location: view_cart.php");
    exit();
}

$action = $_GET['action'];
$id = $_GET['id'] ?? '';

foreach ($_SESSION['cart'] as $key => &$item) {

    if ($item['id'] == $id) {

        if ($action == "increase") {
            $item['qty']++;
        }

        if ($action == "decrease") {
            if ($item['qty'] > 1) {
                $item['qty']--;
            }
        }

        if ($action == "remove") {
            unset($_SESSION['cart'][$key]);
        }

        break;
    }
}

if ($action == "cancel") {
    unset($_SESSION['cart']);
}

$_SESSION['cart'] = array_values($_SESSION['cart']);

header("Location: view_cart.php");
exit();
