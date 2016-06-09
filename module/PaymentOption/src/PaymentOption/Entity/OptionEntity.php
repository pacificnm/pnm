<?php
namespace PaymentOption\Entity;

class OptionEntity
{

    /**
     *
     * @var number
     */
    protected $paymentOptionId;

    /**
     *
     * @var string
     */
    protected $paymentOptionName;

    /**
     *
     * @var bool
     */
    protected $paymentOptionEnabled;

    /**
     *
     * @return the $paymentOptionId
     */
    public function getPaymentOptionId()
    {
        return $this->paymentOptionId;
    }

    /**
     *
     * @return the $paymentOptionName
     */
    public function getPaymentOptionName()
    {
        return $this->paymentOptionName;
    }

    /**
     *
     * @return the $paymentOptionEnabled
     */
    public function getPaymentOptionEnabled()
    {
        return $this->paymentOptionEnabled;
    }

    /**
     *
     * @param number $paymentOptionId            
     */
    public function setPaymentOptionId($paymentOptionId)
    {
        $this->paymentOptionId = $paymentOptionId;
    }

    /**
     *
     * @param string $paymentOptionName            
     */
    public function setPaymentOptionName($paymentOptionName)
    {
        $this->paymentOptionName = $paymentOptionName;
    }

    /**
     *
     * @param boolean $paymentOptionEnabled            
     */
    public function setPaymentOptionEnabled($paymentOptionEnabled)
    {
        $this->paymentOptionEnabled = $paymentOptionEnabled;
    }
}