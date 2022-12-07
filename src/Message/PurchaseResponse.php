<?php

namespace Omnipay\PayGate\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;

/**
 * PayGate Purchase Response
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    public $testMode;

    public function __construct(RequestInterface $request, $data, $testMode = false)
    {
        $this->testMode = $testMode;
        parent::__construct($request, $data);
    }

    public function getRedirectUrl()
    {
        return 'https://secure.paygate.co.za/payweb3/process.trans';
    }

    public function isSuccessful()
    {
        // todo: validate response from paygate... $this->data;
        return false;
    }

	public function isRedirect()
	{
		return true;
	}

	public function getRedirectData()
	{
		parse_str($this->data, $data);
		unset($data['CHECKSUM']);

		$data['CHECKSUM'] = $this->request->generateSignature($data);

		return $data;
	}

	public function getRedirectMethod()
	{
		return 'POST';
	}
}
