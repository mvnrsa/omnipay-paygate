<?php

namespace Omnipay\PayGate\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * PayGate Complete Request
 */
class CompletePurchaseRequest extends PurchaseRequest
{
    public function getData()
    {
        $this->validate('secretKey');

        $data = $this->httpRequest->request->all();

        if ($this->generateSignature($data) !== $this->httpRequest->request->get('Seal')) {
            throw new InvalidRequestException('Incorrect signature');
        }

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new CompleteResponse($this, $data);
    }
}
