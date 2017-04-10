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

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PayGate\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PayGate\Message\CompletePurchaseRequest', $parameters);
    }
}
