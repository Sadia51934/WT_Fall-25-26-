<?php
session_start();


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$action = $_GET['action'] ?? '';
$id     = $_GET['id'] ?? '';


if ($action === "cancel") {
    $_SESSION['cart'] = [];   
    header("Location: view_cart.php");
    exit();
}


foreach ($_SESSION['cart'] as $key => &$item) {

    if ($item['id'] == $id) {

        if ($action === "increase") {
            $item['qty']++;
        }

        if ($action === "decrease") {
            if ($item['qty'] > 1) {
                $item['qty']--;
            }
        }

        if ($action === "remove") {
            unset($_SESSION['cart'][$key]);
        }

        break;
    }
}


$_SESSION['cart'] = array_values($_SESSION['cart']);

header("Location: view_cart.php");
exit();
