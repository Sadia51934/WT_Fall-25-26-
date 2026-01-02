<?php
session_start();
?>

<h2>My Cart</h2>

<?php
if(empty($_SESSION['cart'])) {
    echo "Cart is empty";
} else {
?>
<table border="1" cellpadding="10">
<tr>
    <th>Book</th>
    <th>Price</th>
    <th>Qty</th>
    <th>Total</th>
</tr>

<?php
$total = 0;
foreach($_SESSION['cart'] as $item) {
    $sub = $item['price'] * $item['qty'];
    $total += $sub;
?>
<tr>
    <td><?php echo $item['title']; ?></td>
    <td><?php echo $item['price']; ?></td>
    <td><?php echo $item['qty']; ?></td>
    <td><?php echo $sub; ?></td>
</tr>
<?php } ?>

<tr>
    <td colspan="3"><b>Grand Total</b></td>
    <td><b><?php echo $total; ?></b></td>
</tr>
</table>
<?php } ?>
