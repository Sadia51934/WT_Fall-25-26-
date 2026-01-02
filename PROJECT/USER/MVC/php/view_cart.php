<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>My Cart</title>
    <link rel="stylesheet" href="../Css/view_cart.css">
</head>
<body>
<div class="container">
    <h2>My Cart</h2>
    <?php if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0): ?>
        <p style="text-align:center;">Your cart is empty</p>
        <div class="cart-actions">
            <a href="booklist.php">← Continue Shopping</a>
        </div>
    <?php else: ?>
        <?php 
        $total = 0;
        foreach ($_SESSION['cart'] as $item): 
            $total += $item['price'] * $item['qty'];
        ?>
            <div class="cart-item">
                <div>
                    <h3><?php echo $item['title']; ?></h3>
                    <p>Price: ৳<?php echo $item['price']; ?></p>
                    <p>Quantity: <?php echo $item['qty']; ?></p>
                </div>
                <div>
                    <a class="remove-btn" href="update_cart.php?action=remove&id=<?php echo $item['id']; ?>">Remove</a>
                </div>
            </div>
        <?php endforeach; ?>
        <h3>Total: ৳<?php echo $total; ?></h3>
        <div class="cart-actions">
            <a href="booklist.php">← Continue Shopping</a>
            <a href="checkout.php">Proceed to Payment →</a>
            <a class="remove-btn" href="update_cart.php?action=cancel">Cancel Order</a>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
