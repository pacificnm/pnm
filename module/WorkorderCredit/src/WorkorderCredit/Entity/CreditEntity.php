<?php
namespace WorkorderCredit\Entity;

use PaymentOption\Entity\OptionEntity;

class CreditEntity
{

    /**
     *
     * @var number
     */
    protected $workorderCreditId;

    /**
     *
     * @var number
     */
    protected $workorderId;

    /**
     *
     * @var float
     */
    protected $workorderCreditAmount;

    /**
     *
     * @var float
     */
    protected $workorderCreditAmountLeft;

    /**
     *
     * @var number
     */
    protected $paymentOptionId;

    /**
     *
     * @var string
     */
    protected $workorderCreditDetail;

    /**
     *
     * @var number
     */
    protected $workorderCreditDate;

    /**
     *
     * @var OptionEntity
     */
    protected $optionEntity;

    /**
     *
     * @var String
     */
    protected $workorderCreditType;

    /**
     *
     * @return the $workorderCreditId
     */
    public function getWorkorderCreditId()
    {
        return $this->workorderCreditId;
    }

    /**
     *
     * @return the $workorderId
     */
    public function getWorkorderId()
    {
        return $this->workorderId;
    }

    /**
     *
     * @return the $workorderCreditAmount
     */
    public function getWorkorderCreditAmount()
    {
        return $this->workorderCreditAmount;
    }

    /**
     *
     * @return the $workorderCreditAmountLeft
     */
    public function getWorkorderCreditAmountLeft()
    {
        return $this->workorderCreditAmountLeft;
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
     * @return the $workorderCreditDetail
     */
    public function getWorkorderCreditDetail()
    {
        return $this->workorderCreditDetail;
    }

    /**
     *
     * @return the $workorderCreditDate
     */
    public function getWorkorderCreditDate()
    {
        return $this->workorderCreditDate;
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
     * @return the $workorderCreditType
     */
    public function getWorkorderCreditType()
    {
        return $this->workorderCreditType;
    }

    /**
     *
     * @param number $workorderCreditId            
     */
    public function setWorkorderCreditId($workorderCreditId)
    {
        $this->workorderCreditId = $workorderCreditId;
    }

    /**
     *
     * @param number $workorderId            
     */
    public function setWorkorderId($workorderId)
    {
        $this->workorderId = $workorderId;
    }

    /**
     *
     * @param number $workorderCreditAmount            
     */
    public function setWorkorderCreditAmount($workorderCreditAmount)
    {
        $this->workorderCreditAmount = $workorderCreditAmount;
    }

    /**
     *
     * @param number $workorderCreditAmountLeft            
     */
    public function setWorkorderCreditAmountLeft($workorderCreditAmountLeft)
    {
        $this->workorderCreditAmountLeft = $workorderCreditAmountLeft;
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
     * @param string $workorderCreditDetail            
     */
    public function setWorkorderCreditDetail($workorderCreditDetail)
    {
        $this->workorderCreditDetail = $workorderCreditDetail;
    }

    /**
     *
     * @param number $workorderCreditDate            
     */
    public function setWorkorderCreditDate($workorderCreditDate)
    {
        $this->workorderCreditDate = $workorderCreditDate;
    }

    /**
     *
     * @param \PaymentOption\Entity\OptionEntity $optionEntity            
     */
    public function setOptionEntity($optionEntity)
    {
        $this->optionEntity = $optionEntity;
    }

    /**
     *
     * @param \WorkorderCredit\Entity\String $workorderCreditType            
     */
    public function setWorkorderCreditType($workorderCreditType)
    {
        $this->workorderCreditType = $workorderCreditType;
    }
}
