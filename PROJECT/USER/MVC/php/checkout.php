<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .container {
            max-width: 500px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0,0,0,0.1);
        }
        h2 { text-align: center; margin-bottom: 20px; }
        form input, form textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        form button {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        form button:hover { background-color: #218838; }
    </style>
</head>
<body>
<div class="container">
    <h2>Payment Details</h2>
    <form method="post" action="process_payment.php">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="text" name="mobile" placeholder="Mobile Number" required pattern="\d{10,14}">
        <textarea name="address" placeholder="Address" rows="4" required></textarea>
        <button type="submit">Proceed to Pay</button>
    </form>
</div>
</body>
</html>
