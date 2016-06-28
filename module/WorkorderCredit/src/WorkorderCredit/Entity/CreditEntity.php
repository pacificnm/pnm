<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace WorkorderCredit\Entity;

use PaymentOption\Entity\OptionEntity;
use Account\Entity\AccountEntity;
use AccountLedger\Entity\LedgerEntity;

/**
 * Work Order Credit Entity
 *
 * @author jaimie (pacificnm@gmail.com)
 *        
 */
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
     * @var number
     */
    protected $accountId;

    /**
     *
     * @var number
     */
    protected $accountLedgerId;

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
     * @var String
     */
    protected $workorderCreditType;

    /**
     *
     * @var OptionEntity
     */
    protected $optionEntity;

    /**
     *
     * @var AccountEntity
     */
    protected $accountEntity;

    /**
     *
     * @var LedgerEntity
     */
    protected $ledgerEntity;

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
     * @return the $accountId
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     *
     * @return the $accountLedgerId
     */
    public function getAccountLedgerId()
    {
        return $this->accountLedgerId;
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
     * @return the $workorderCreditType
     */
    public function getWorkorderCreditType()
    {
        return $this->workorderCreditType;
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
     * @return the $accountEntity
     */
    public function getAccountEntity()
    {
        return $this->accountEntity;
    }

    /**
     *
     * @return the $ledgerEntity
     */
    public function getLedgerEntity()
    {
        return $this->ledgerEntity;
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
     * @param number $accountId            
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
    }

    /**
     *
     * @param number $accountLedgerId            
     */
    public function setAccountLedgerId($accountLedgerId)
    {
        $this->accountLedgerId = $accountLedgerId;
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
     * @param \WorkorderCredit\Entity\String $workorderCreditType            
     */
    public function setWorkorderCreditType($workorderCreditType)
    {
        $this->workorderCreditType = $workorderCreditType;
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
     * @param \Account\Entity\AccountEntity $accountEntity            
     */
    public function setAccountEntity($accountEntity)
    {
        $this->accountEntity = $accountEntity;
    }

    /**
     *
     * @param \AccountLedger\Entity\LedgerEntity $ledgerEntity            
     */
    public function setLedgerEntity($ledgerEntity)
    {
        $this->ledgerEntity = $ledgerEntity;
    }
}
