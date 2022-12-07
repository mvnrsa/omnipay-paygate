# Sample Controller
This folder contains a sample controller you can use with OmniPay in Laravel.  
Feel free to copy and change for your needs.

## Routing
You will need a couple of payment routes in your `routes/web.php`:

```
// Payments
Route::get('payment/{id}', 'PaymentController@pay')->name('payment.pay');
Route::get('payment/{id}/redirect/{method}', 'PaymentController@redirect')->name('payment.redirect');
Route::post('payment/{id}/returnPage/{method}', 'PaymentController@returnPage')->name('payment.returnPage');
```

- The first route will display a payment page for a given order.
- The second will redirect to the gateway's payment page (using the amount from the order or an amount in the request).
- The third displays a thank you page after payment.

## Configuration sample
You will need a `config/payment_gateways.php` file with the setters and values needed for each gateway.  This makes it easier to add gateways without changing anything other than the config file.  
See the sample `payment_gateways.php` in this folder.
