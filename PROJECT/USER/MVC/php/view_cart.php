<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Cart</title>
    <link rel="stylesheet" href="../Css/view_cart.css">
</head>
<body>

<div class="container">

    <h2 class="page-title">My Cart</h2>

    <?php if (empty($_SESSION['cart'])) { ?>

        <p class="empty-cart">Your cart is empty</p>

        <div class="cart-actions">
            <a href="booklist.php">Go Shopping</a>
        </div>

    <?php } else { ?>

        <?php
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {

            $subtotal = $item['price'] * $item['qty'];
            $total += $subtotal;
        ?>

        <div class="cart-card">

            <div class="cart-left">
                <h3 class="book-title">
                    <?= htmlspecialchars($item['title']); ?>
                </h3>

                <p class="unit-price">
                    Price: ৳<?= number_format($item['price'], 2); ?>
                </p>

                <div class="qty-box">
                    <a class="qty-btn"
                       href="update_cart.php?action=decrease&id=<?= $item['id']; ?>">−</a>

                    <span class="qty"><?= $item['qty']; ?></span>

                    <a class="qty-btn"
                       href="update_cart.php?action=increase&id=<?= $item['id']; ?>">+</a>
                </div>
            </div>

            <div class="cart-right">
                <div class="item-subtotal">
                    ৳<?= number_format($subtotal, 2); ?>
                </div>

                <a class="remove-link"
                   href="update_cart.php?action=remove&id=<?= $item['id']; ?>">
                    Remove
                </a>
            </div>

        </div>

        <?php } ?>

        <div class="total">
            Total: ৳<?= number_format($total, 2); ?>
        </div>

        <div class="cart-actions">
            <a href="booklist.php">Continue Shopping</a>
            <a href="checkout.php" class="checkout-btn">Checkout</a>
            <a href="update_cart.php?action=cancel" class="cancel">Cancel Order</a>
        </div>

    <?php } ?>

</div>

</body>
</html>
