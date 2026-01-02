<?php
session_start();

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'remove' && isset($_GET['id'])) {
        $id = $_GET['id'];
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['id'] == $id) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }
        $_SESSION['cart'] = array_values($_SESSION['cart']); // reindex array
    } elseif ($_GET['action'] == 'cancel') {
        unset($_SESSION['cart']); // cancel entire order
    }
}

header("Location: view_cart.php");
exit();
?>
