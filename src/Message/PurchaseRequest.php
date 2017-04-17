<?php
namespace Omnipay\PayGate\Message;

use GuzzleHttp\Client;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Exception\InvalidRequestException;

/**
 * PayGate Initiate Request
 */
class PurchaseRequest extends AbstractRequest
{
    public $testEndpoint = 'https://secure.paygate.co.za/payweb3/initiate.trans';
    public $liveEndpoint = 'https://secure.paygate.co.za/payweb3/initiate.trans';

    public function getCurrency()
    {
        return $this->getParameter('currency');
    }
    public function setCurrency($value)
    {
        return $this->setParameter('currency', $value);
    }
    public function getCountry()
    {
        return $this->getParameter('country');
    }
    public function setCountry($value)
    {
        return $this->setParameter('country', $value);
    }
    public function getLocale()
    {
        return $this->getParameter('locale');
    }
    public function setLocale($value)
    {
        return $this->setParameter('locale', $value);
    }
    public function getPayMethod()
    {
        return $this->getParameter('payMethod');
    }
    public function setPayMethod($value)
    {
        return $this->setParameter('payMethod', $value);
    }
    public function getPayMethodDetail()
    {
        return $this->getParameter('payMethodDetail');
    }
    public function setPayMethodDetail($value)
    {
        return $this->setParameter('payMethodDetail', $value);
    }
    public function getNotifyUrl()
    {
        return $this->getParameter('notifyUrl');
    }
    public function setNotifyUrl($value)
    {
        return $this->setParameter('notifyUrl', $value);
    }
    public function getReturnUrl()
    {
        return $this->getParameter('returnUrl');
    }
    public function setReturnUrl($value)
    {
        return $this->setParameter('returnUrl', $value);
    }




    public function getReference()
    {
        return $this->getParameter('reference');
    }
    public function setReference($value)
    {
        return $this->setParameter('reference', $value);
    }
    public function getAmount()
    {
        return $this->getParameter('amount');
    }
    public function setAmount($value)
    {
        return $this->setParameter('amount', $value);
    }
    public function getEmail()
    {
        return $this->getParameter('email');
    }
    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
    }
    public function getUser1()
    {
        return $this->getParameter('user1');
    }
    public function setUser1($value)
    {
        return $this->setParameter('user1', $value);
    }
    public function getUser2()
    {
        return $this->getParameter('user2');
    }
    public function setUser2($value)
    {
        return $this->setParameter('user2', $value);
    }
    public function getUser3()
    {
        return $this->getParameter('user3');
    }
    public function setUser3($value)
    {
        return $this->setParameter('user3', $value);
    }




    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }
    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    public function getSecretKey()
    {
        return $this->getParameter('secretKey');
    }

    public function setSecretKey($value)
    {
        return $this->setParameter('secretKey', $value);
    }

    public function getData()
    {
        $this->validate(
            'reference',
            'amount',
            'email',
            'user1',
            'user2',
            'user3'
        );

        $data = [];
        $data['PAYGATE_ID'] = $this->getMerchantId();
        $data['REFERENCE'] = $this->getReference();
        $data['AMOUNT'] = $this->getAmount();
        $data['CURRENCY'] = $this->getCurrency();
        $data['RETURN_URL'] = $this->getReturnUrl();
        $data['TRANSACTION_DATE'] = date('Y-m-d H:i:s', time());
        $data['LOCALE'] = $this->getLocale();
        $data['COUNTRY'] = $this->getCountry();
        $data['EMAIL'] = $this->getEmail();

        if(!empty($this->getPayMethod()) && !empty($this->getPayMethodDetail())) {
            $data['PAY_METHOD'] = $this->getPayMethod();
            $data['PAY_METHOD_DETAIL'] = $this->getPayMethodDetail();
        }

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
            throw new InvalidRequestException('Missing data parameters');
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
        $httpResponse = $client->post($this->getEndpoint(), ['form_params' => $data]);
        $this->response = new PurchaseResponse($this, $httpResponse->getBody()->getContents());
        return $this->response;
    }

    public function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}
