<?php
session_start();

if (!isset($_SESSION['cart'])) {
    header("Location: view_cart.php");
    exit();
}

if (isset($_GET['action']) && isset($_GET['id'])) {

    $id = $_GET['id'];

    foreach ($_SESSION['cart'] as $key => &$item) {

        if ($item['id'] == $id) {

            /* Increase quantity */
            if ($_GET['action'] == 'increase') {
                $item['qty']++;
            }

            /* Decrease quantity */
            if ($_GET['action'] == 'decrease') {
                if ($item['qty'] > 1) {
                    $item['qty']--;
                } else {
                    unset($_SESSION['cart'][$key]); // remove if qty = 0
                }
            }

            /* Remove item */
            if ($_GET['action'] == 'remove') {
                unset($_SESSION['cart'][$key]);
            }

            break;
        }
    }

    $_SESSION['cart'] = array_values($_SESSION['cart']); // reindex
}

if (isset($_GET['action']) && $_GET['action'] == 'cancel') {
    unset($_SESSION['cart']);
}

header("Location: view_cart.php");
exit();
?>
