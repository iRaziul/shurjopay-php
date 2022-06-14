![ShurjoPay payment gateway integration for PHP applications](https://www.shurjopay.com.bd/dev/images/shurjoPay.png)

# ShurjoPay PHP Library
Using this library you can integrate **ShurjoPay** payment gateway into your PHP applications.

---

_If you face any problem then create issues or make a PR with your solution._

## Requirement

- PHP 7.3 or Later
- curl extension

## Installation

The installation is pretty easy using [Composer](https://getcomposer.org/)

```sh
composer require raziul/shurjopay-php
```

## Usage

You can check the [examples](./examples) directory for full code.

### Configuration

```php
$config = [
	// set this to false if you are running in live mode
	'sandbox_mode'  =>  true,

	// ShurjoPay credentials [Change these with your details]
	'username' => 'sp_sandbox',
	'password' => 'pyyk97hu&6u6',
	'prefix'  =>  'NOK',
];
```

### Creating a payment

```php
require __DIR__ . '/vendor/autoload.php';

// create ShurjoPay instance
$sp = new \Raziul\ShurjoPay\ShurjoPay($config);

// set callback url
$sp->setCallbackUrl($success_url, $cancel_url);

// make payment
$sp->makePayment($payload); // it will redirect to the payment page

```

You can also use method chaining like below

```php
ShurjoPay::create($config)->setCallbackUrl($success_url, $cancel_url)->makePayment($payload);
```

> After making a successfull payment, user will be redirected to the
> _success_url_ with `order_id` query parameter in the URI.

### Verify Payment

```php
// retrieve order id from the URI
$order_id = $_GET['order_id'];

// verify payment
$payment = $sp->verify($order_id);

// check success status
if ($payment->success()) {
	// show the payment method
	echo $payment->paymentMethod();
}
```

Available methods in the **Payment** class.
| Method | Description |
|--|--|
| $payment->success() | Return payment success status |
| $payment->failed() | Return payment failed status |
| $payment->message() | Get the success/error message |
| $payment->orderId() | Get the order ID |
| $payment->currency() | Get currency code |
| $payment->amount() | Get the amount |
| $payment->customerOrderId() | Get customer order ID |
| $payment->paymentMethod() | Get the payment method name |
| $payment->dateTime() | Get the transaction date time |
| $payment->toArray() | Get all the data as array |

### Error Handling

This package throws `Raziul\ShurjoPay\ShurjoPayException` on error. You can use `try-catch` for better error handling.

```php
try {
	// making payment
	ShurjoPay::create($config)
		->setCallbackUrl($success_url, $cancel_url)
		->makePayment($payload);

	// also for verfication
	ShurjoPay::create($config)
		->verify($order_id);

} catch (Raziul\ShurjoPay\ShurjoPayException $ex) {
	echo $e->getMessage();
}
```

## Suggestion/Issues

If you found any issues or have any suggestion then please create an [issue](https://github.com/iRaziul/shurjopay-php/issues).

You can also submit PR regarding any issues.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

## Thank You

Thanks for using this package and If you foound this package useful then consider giving it a star.
