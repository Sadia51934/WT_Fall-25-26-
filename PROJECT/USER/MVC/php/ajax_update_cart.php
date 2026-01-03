<?php
session_start();

$id = $_POST['id'];
$action = $_POST['action'];

$response = [
    'qty' => 0,
    'subtotal' => 0,
    'total' => 0,
    'removed' => false
];

foreach ($_SESSION['cart'] as $key => &$item) {

    if ($item['id'] == $id) {

        if ($action == 'increase') {
            $item['qty']++;
        }

        if ($action == 'decrease') {
            if ($item['qty'] > 1) {
                $item['qty']--;
            } else {
                unset($_SESSION['cart'][$key]);
                $response['removed'] = true;
                break;
            }
        }

        if (!$response['removed']) {
            $response['qty'] = $item['qty'];
            $response['subtotal'] = number_format($item['price'] * $item['qty'], 2);
        }
    }
}

/* Reindex */
$_SESSION['cart'] = array_values($_SESSION['cart']);

/* Calculate total */
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['qty'];
}

$response['total'] = number_format($total, 2);

echo json_encode($response);
