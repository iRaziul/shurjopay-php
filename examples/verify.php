<?php

use Raziul\ShurjoPay\ShurjoPayException;

require __DIR__ . '/../vendor/autoload.php';

// load config
$config = require __DIR__ . '/config.php';

// retrieve order_id from success callback
$order_id = trim($_GET['order_id']);

try {
    // create ShurjoPay instance
    $shurjopay = new \Raziul\ShurjoPay\ShurjoPay($config);

    // verify payment
    $payment = $shurjopay->verify($order_id);

    // You can also chain methods like below 😎
    // ShurjoPay::create($config)->verify($order_id);

    // payment success
    if ($payment->success()) {
        echo '<h1>Payment Successful 👍</h1>';
        echo '<p>Order ID: ' . $payment->customerOrderId() . '</p>';
        echo '<p>Payment Method: ' . $payment->paymentMethod() . '</p>';

        // dump the response
        echo '<pre>';
        var_dump($payment->toArray());
        echo '</pre>';
    }
} catch (ShurjoPayException $e) {
    echo $e->getMessage();
}
