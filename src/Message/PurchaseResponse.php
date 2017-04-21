<?php

namespace Omnipay\PayGate\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * PayGate Purchase Response
 */
class PurchaseResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        // todo: validate response from paygate... $this->data;
        return false;
    }
}
