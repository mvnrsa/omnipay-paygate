<?php

namespace Omnipay\PayGate;

use Omnipay\Common\AbstractGateway;

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
            'secretKey' => '',
            'testMode' => false,
        );
    }

//'PAYGATE_ID' => '123',
//'REFERENCE' => '324',
//'AMOUNT' => '324',
//'CURRENCY' => '432',
//'RETURN_URL' => '324',
//'LOCALE' => '432',
//'COUNTRY' => '234',
//'EMAIL' => '432',
//'PAY_METHOD' => '432',
//'PAY_METHOD_DETAIL' => '234',
//'NOTIFY_URL' => 'testing',
//'USER1' => '234',
//'USER2' => '432',
//'USER3' => '234',
//'description' => 'test',
//'amount' => '234.32',
//'cancelUrl' => '234'

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


    public function initiate(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PayGate\Message\InitiateRequest', $parameters);
    }

    public function process(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PayGate\Message\CompletePurchaseRequest', $parameters);
    }

    public function query(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PayGate\Message\CompletePurchaseRequest', $parameters);
    }

// EXISTING

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PayGate\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PayGate\Message\CompletePurchaseRequest', $parameters);
    }

// EXISTING

}
