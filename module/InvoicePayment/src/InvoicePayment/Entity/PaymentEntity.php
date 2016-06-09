<?php
namespace InvoicePayment\Entity;

use PaymentOption\Entity\OptionEntity;

class PaymentEntity
{

    /**
     *
     * @var number
     */
    protected $invoicePaymentId;

    /**
     *
     * @var number
     */
    protected $invoiceId;

    /**
     *
     * @var number
     */
    protected $invoicePaymentDate;

    /**
     *
     * @var number
     */
    protected $paymentOptionId;

    /**
     *
     * @var float
     */
    protected $invoicePaymentAmount;

    /**
     *
     * @var string
     */
    protected $invoicePaymentDetail;

    /**
     *
     * @var OptionEntity
     */
    protected $optionEntity;

    /**
     *
     * @return the $invoicePaymentId
     */
    public function getInvoicePaymentId()
    {
        return $this->invoicePaymentId;
    }

    /**
     *
     * @return the $invoiceId
     */
    public function getInvoiceId()
    {
        return $this->invoiceId;
    }

    /**
     *
     * @return the $invoicePaymentDate
     */
    public function getInvoicePaymentDate()
    {
        return $this->invoicePaymentDate;
    }

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
     * @return the $invoicePaymentAmount
     */
    public function getInvoicePaymentAmount()
    {
        return $this->invoicePaymentAmount;
    }

    /**
     *
     * @return the $invoicePaymentDetail
     */
    public function getInvoicePaymentDetail()
    {
        return $this->invoicePaymentDetail;
    }

    /**
     *
     * @return the $optionEntity
     */
    public function getOptionEntity()
    {
        return $this->optionEntity;
    }

    /**
     *
     * @param number $invoicePaymentId            
     */
    public function setInvoicePaymentId($invoicePaymentId)
    {
        $this->invoicePaymentId = $invoicePaymentId;
    }

    /**
     *
     * @param number $invoiceId            
     */
    public function setInvoiceId($invoiceId)
    {
        $this->invoiceId = $invoiceId;
    }

    /**
     *
     * @param number $invoicePaymentDate            
     */
    public function setInvoicePaymentDate($invoicePaymentDate)
    {
        $this->invoicePaymentDate = $invoicePaymentDate;
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
     * @param number $invoicePaymentAmount            
     */
    public function setInvoicePaymentAmount($invoicePaymentAmount)
    {
        $this->invoicePaymentAmount = $invoicePaymentAmount;
    }

    /**
     *
     * @param string $invoicePaymentDetail            
     */
    public function setInvoicePaymentDetail($invoicePaymentDetail)
    {
        $this->invoicePaymentDetail = $invoicePaymentDetail;
    }

    /**
     *
     * @param \PaymentOption\Entity\OptionEntity $optionEntity            
     */
    public function setOptionEntity($optionEntity)
    {
        $this->optionEntity = $optionEntity;
    }
}
