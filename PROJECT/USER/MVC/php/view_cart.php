<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Cart</title>
    <link rel="stylesheet" href="../Css/view_cart.css">
</head>
<body>

<div class="container">
    <h2 class="page-title">🛒 My Cart</h2>

<?php if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0): ?>

    <div class="empty-cart">
        <p>Your cart is empty</p>
        <a href="booklist.php" class="btn primary">← Continue Shopping</a>
    </div>

<?php else: ?>

<?php
$total = 0;
foreach ($_SESSION['cart'] as $item):
    $subtotal = $item['price'] * $item['qty'];
    $total += $subtotal;
?>

<div class="cart-card" id="item-<?php echo $item['id']; ?>">

    <div class="cart-left">
        <h3><?php echo htmlspecialchars($item['title']); ?></h3>
        <p>Unit Price: ৳<?php echo number_format($item['price'],2); ?></p>

        <div class="qty-box">
            <button onclick="updateQty(<?php echo $item['id']; ?>, 'decrease')" class="qty-btn">−</button>
            <span id="qty-<?php echo $item['id']; ?>"><?php echo $item['qty']; ?></span>
            <button onclick="updateQty(<?php echo $item['id']; ?>, 'increase')" class="qty-btn">+</button>
        </div>
    </div>

    <div class="cart-right">
        <p class="item-subtotal" id="subtotal-<?php echo $item['id']; ?>">
            ৳<?php echo number_format($subtotal,2); ?>
        </p>

        <a href="update_cart.php?action=remove&id=<?php echo $item['id']; ?>" class="remove-link">
            Remove
        </a>
    </div>

</div>

<?php endforeach; ?>

<h3 class="total">
    Total: ৳<span id="grandTotal"><?php echo number_format($total,2); ?></span>
</h3>

<div class="cart-actions">
    <a href="booklist.php" class="btn secondary">← Continue Shopping</a>
    <a href="checkout.php" class="btn primary">Proceed to Payment →</a>
    <a href="update_cart.php?action=cancel" class="btn danger">Cancel Order</a>
</div>

<?php endif; ?>
</div>

<!--AJAX SCRIPT-->
<script>
function updateQty(id, action) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax_update_cart.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (this.status === 200) {
            var data = JSON.parse(this.responseText);

            if (data.removed) {
                document.getElementById("item-" + id).remove();
            } else {
                document.getElementById("qty-" + id).innerText = data.qty;
                document.getElementById("subtotal-" + id).innerText = "৳" + data.subtotal;
            }

            document.getElementById("grandTotal").innerText = data.total;
        }
    };

    xhr.send("id=" + id + "&action=" + action);
}
</script>

</body>
</html>
