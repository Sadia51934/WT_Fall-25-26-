<?php
session_start();
include "../Db/dbregister.php";

/* Security checks */
if (!isset($_SESSION['username']) || !isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    header("Location: checkout.php");
    exit();
}

/* Get form data */
$username = $_SESSION['username'];
$name     = trim($_POST['name']);
$mobile   = trim($_POST['mobile']);
$address  = trim($_POST['address']);
$method   = $_POST['payment_method'];

$payment_number = "";

/* Payment validation */
if ($method == "bKash") {
    if (empty($_POST['bkash_number'])) {
        $_SESSION['checkout_error'] = "bKash number is required";
        header("Location: checkout.php");
        exit();
    }
    $payment_number = $_POST['bkash_number'];
}

if ($method == "Nagad") {
    if (empty($_POST['nagad_number'])) {
        $_SESSION['checkout_error'] = "Nagad number is required";
        header("Location: checkout.php");
        exit();
    }
    $payment_number = $_POST['nagad_number'];
}

/* Calculate total */
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['qty'];
}

/* Insert into orders */
$sql = "INSERT INTO orders 
        (username, name, mobile, address, payment_method, payment_number, total_amount)
        VALUES 
        ('$username', '$name', '$mobile', '$address', '$method', '$payment_number', '$total')";

if (!$conn->query($sql)) {
    die("Order insert failed");
}

$order_id = $conn->insert_id;

/* Insert order items */
foreach ($_SESSION['cart'] as $item) {

    $book_id = $item['id'];
    $title   = $item['title'];
    $price   = $item['price'];
    $qty     = $item['qty'];

    $sql_item = "INSERT INTO order_items
                 (order_id, book_id, book_title, price, quantity)
                 VALUES
                 ('$order_id', '$book_id', '$title', '$price', '$qty')";

    $conn->query($sql_item);
}

/* Clear cart */
unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Successful</title>
    <link rel="stylesheet" href="../Css/process_payment.css">
</head>

<body>

<div class="success-card">
    <div class="check">✔</div>
    <h2>Order Placed Successfully!</h2>
    <p>Thank you, <b><?php echo htmlspecialchars($name); ?></b></p>

    <div class="details">
        <center><p><span>Order ID:</span> <?php echo $order_id; ?></p></center>
        <center><p><span>Payment Method:</span> <?php echo htmlspecialchars($method); ?></p></center>
        <center><p><span>Total Amount:</span> ৳<?php echo number_format($total, 2); ?></p></center>
    </div>

    <a href="../php/index.php" class="btn">Back to Home</a>
</div>

</body>
</html>
