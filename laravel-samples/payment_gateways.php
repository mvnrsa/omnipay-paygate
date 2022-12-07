<?php
return [
	// For some gateways like PayGate this must be FALSE - Use a test/sandbox MerchantId instead
	'payments_test_mode' => env('PAYMENTS_TEST_MODE',false),

	'paygate' => [
    				'gateway' => 'PayGate',
					'setters' => [
    					'setMerchantId'	=> env('PAYGATE_ID', '10011072130'),	// Defaults to sandbox
    					'setSecretKey'	=> env('PAYGATE_SECRET', 'secret'),		// Defaults to sandbox
    					'setCurrency'	=> env('PAYGATE_CURRENCY', 'ZAR'),
    					'setCountry'	=> env('PAYGATE_COUNTRY', 'ZAF'),
    					'setLocale'		=> env('PAYGATE_LOCALE', 'en'),
					],
				],
];
