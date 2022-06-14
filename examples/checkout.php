<?php

use Raziul\ShurjoPay\ShurjoPayException;

require __DIR__ . '/../vendor/autoload.php';

// load config
$config = require __DIR__ . '/config.php';

// Payload will be sent to ShurjoPay
$payload = [
    'currency' => 'BDT',
    'amount' => 1000,   // amount to be paid

    // Order information
    'order_id' => '1',
    'discsount_amount' => 0,
    'disc_percent' => 0,

    // Customer information
    'client_ip' => '127.0.0.1',
    'customer_name' => 'Raziul Islam',
    'customer_phone' => '+8801234567890',
    'customer_email' => 'raziul.cse@gmail.com',
    'customer_address' => 'Full Address',
    'customer_city' => 'City Name',
    'customer_state' => 'State Name',
    'customer_postcode' => 'Postcode',
    'customer_country' => 'Country Name',

    // Custom values
    'value1' => 'value1',
    'value2' => 'value2',
    'value3' => 'value3',
    'value4' => 'value4'
];

// callback url for success and cancel
$success_url = 'http://localhost/shurjopay/examples/verify.php';
$cancel_url = 'http://localhost/shurjopay/examples/verify.php';

try {
    // create ShurjoPay instance
    $shurjopay = new \Raziul\ShurjoPay\ShurjoPay($config);

    // set callback url
    $shurjopay->setCallbackUrl($success_url, $cancel_url);

    // make payment
    $shurjopay->makePayment($payload);      // it will redirect the user to the payment page

    // You can also chain methods like below 😎
    // ShurjoPay::create($config)->setCallbackUrl($success_url, $cancel_url)->makePayment($payload);

} catch (ShurjoPayException $e) {
    echo $e->getMessage();
}
