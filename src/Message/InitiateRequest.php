<?php
namespace Omnipay\PayGate\Message;

use GuzzleHttp\Client;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Exception\InvalidRequestException;

/**
 * PayGate Initiate Request
 */
class InitiateRequest extends AbstractRequest
{
    public $testEndpoint = 'https://secure.paygate.co.za/payweb3/initiate.trans';
    public $liveEndpoint = 'https://secure.paygate.co.za/payweb3/initiate.trans';

    public function getPaygateId()
    {
        return $this->getParameter('PAYGATE_ID');
    }
    public function setPayGateId($value)
    {
        return $this->setParameter('PAYGATE_ID', $value);
    }
    public function getReference()
    {
        return $this->getParameter('REFERENCE');
    }
    public function setReference($value)
    {
        return $this->setParameter('REFERENCE', $value);
    }
    public function getAmount()
    {
        return $this->getParameter('AMOUNT');
    }
    public function setAmount($value)
    {
        return $this->setParameter('AMOUNT', $value);
    }
    public function getCurrency()
    {
        return $this->getParameter('CURRNECY');
    }
    public function setCurrency($value)
    {
        return $this->setParameter('CURRENCY', $value);
    }
    public function getReturnUrl()
    {
        return $this->getParameter('RETURN_URL');
    }
    public function setReturnUrl($value)
    {
        return $this->setParameter('RETURN_URL', $value);
    }
    public function getLocale()
    {
        return $this->getParameter('LOCALE');
    }
    public function setLocale($value)
    {
        return $this->setParameter('LOCALE', $value);
    }
    public function getCountry()
    {
        return $this->getParameter('COUNTRY');
    }
    public function setCountry($value)
    {
        return $this->setParameter('COUNTRY', $value);
    }
    public function getEmail()
    {
        return $this->getParameter('EMAIL');
    }
    public function setEmail($value)
    {
        return $this->setParameter('EMAIL', $value);
    }
    public function getPayMethod()
    {
        return $this->getParameter('PAY_METHOD');
    }
    public function setPayMethod($value)
    {
        return $this->setParameter('PAY_METHOD', $value);
    }
    public function getPayMethodDetail()
    {
        return $this->getParameter('PAY_METHOD_DETAIL');
    }
    public function setPayMethodDetail($value)
    {
        return $this->setParameter('PAY_METHOD_DETAIL', $value);
    }
    public function getNotifyUrl()
    {
        return $this->getParameter('NOTIFY_URL');
    }
    public function setNotifyUrl($value)
    {
        return $this->setParameter('NOTIFY_URL', $value);
    }
    public function getUser1()
    {
        return $this->getParameter('USER1');
    }
    public function setUser1($value)
    {
        return $this->setParameter('USER1', $value);
    }
    public function getUser2()
    {
        return $this->getParameter('USER2');
    }
    public function setUser2($value)
    {
        return $this->setParameter('USER2', $value);
    }
    public function getUser3()
    {
        return $this->getParameter('USER3');
    }
    public function setUser3($value)
    {
        return $this->setParameter('USER3', $value);
    }
    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }
    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }
    public function getKeyVersion()
    {
        return $this->getParameter('keyVersion');
    }
    public function setKeyVersion($value)
    {
        return $this->setParameter('keyVersion', $value);
    }
    public function getSecretKey()
    {
        return $this->getParameter('secretKey');
    }
    public function setSecretKey($value)
    {
        return $this->setParameter('secretKey', $value);
    }
    public function getOrderId()
    {
        return $this->getParameter('orderId');
    }
    public function setOrderId($value)
    {
        return $this->setParameter('orderId', $value);
    }
    public function getCustomerLanguage()
    {
        return $this->getParameter('customerLanguage');
    }
    public function setCustomerLanguage($value)
    {
        return $this->setParameter('customerLanguage', $value);
    }
    public function getData()
    {
        $this->validate(
            'PAYGATE_ID',
            'REFERENCE',
            'AMOUNT',
            'CURRENCY',
            'RETURN_URL',
            'LOCALE',
            'COUNTRY',
            'EMAIL',
            'PAY_METHOD',
            'PAY_METHOD_DETAIL',
            'NOTIFY_URL',
            'USER1',
            'USER2',
            'USER3'
        );
//        $transRef = $this->getTransactionReference() ?: $this->getTransactionId();
        $data = [];
        $data['PAYGATE_ID'] = $this->getPaygateId();
        $data['REFERENCE'] = $this->getReference();
        $data['AMOUNT'] = $this->getAmount();
        $data['CURRENCY'] = $this->getCurrency();
        $data['RETURN_URL'] = $this->getReturnUrl();
        $data['LOCALE'] = $this->getLocale();
        $data['COUNTRY'] = $this->getCountry();
        $data['EMAIL'] = $this->getEmail();
        $data['PAY_METHOD'] = $this->getPayMethod();
        $data['PAY_METHOD_DETAIL'] = $this->getPayMethodDetail();
        $data['NOTIFY_URL'] = $this->getNotifyUrl();
        $data['USER1'] = $this->getUser1();
        $data['USER2'] = $this->getUser2();
        $data['USER3'] = $this->getUser3();
        $data['CHECKSUM'] = $this->generateSignature($data);

        return $data;
    }
    public function generateSignature($data)
    {
        if (empty($data)) {
            throw new InvalidRequestException('Missing Data parameter');
        }
        $checksum = "";
        foreach ($data as $dKey => $dValue) {
            $checksum .= $dValue;
        }
        return md5($checksum . $this->getSecretKey());
    }


    public function sendData($data)
    {
        $client = new Client();
        $httpResponse = $client->post($this->getEndpoint(), null, $data);
        return $this->response = new PurchaseResponse($this, $httpResponse->getBody()->getContents());
    }

    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}
