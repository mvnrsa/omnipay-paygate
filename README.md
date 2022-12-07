# omnipay-paygate
Paygate driver for the Omnipay PHP payment processing library
\
Updated by mvnrsa to do redirect - 2022/12

## Installation

### Composer
If you use [Composer](http://getcomposer.org/), you can run the following command from the root of your project:

```
composer require mvnrsa/omnipay-paygate:dev-master
```

Or add [mvnrsa/omnipay-paygate](https://packagist.org/packages/mvnrsa/omnipay-paygate) to your `composer.json` file:

```json
{
  "require": {
    "mvnrsa/omnipay-paygate": "dev-master"
  }
  
}
```

### Laravel
The only specific PayGate package for laravel is abandoned and not compatible with php 8!  

This package can be used very easily with Laravel and OmniPay to accept PayGate payments.  
See the `laravel-samples` folder for a working Controller and sample config file.

mvnrsa  
2022/12/07
