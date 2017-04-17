<?php

namespace Omnipay\PayGate;

use Illuminate\Http\Request;
use Omnipay\Common\AbstractGateway;
use Omnipay\PayGate\Message\CompleteResponse;

/**
 * PayGate Gateway
 *
 * @link TODO
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'PayGate';
    }

    public function getDefaultParameters()
    {
        return array(
            'merchantId' => '',
            'keyVersion' => '',
            'currency' => '',
            'country' => '',
            'locale' => '',
            'payMethod' => '',
            'payMethodDetail' => '',
            'notifyUrl' => '',
            'returnUrl' => '',
            'testMode' => false,
        );
    }

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
        return $this->getParameter('payMmethod');
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

    public function getFormRedirectUrl()
    {
        return 'https://secure.paygate.co.za/payweb3/process.trans';
    }



    // BASE

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PayGate\Message\PurchaseRequest', $parameters);
    }

    public function complete(array $parameters = array())
    {
        return new CompleteResponse($parameters);
    }

    // CUSTOM

    public function query(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PayGate\Message\QueryRequest', $parameters);
    }

}
