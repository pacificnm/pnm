<?php
namespace AccountLedger\Entity;

use Account\Entity\AccountEntity;

class LedgerEntity
{

    /**
     *
     * @var number
     */
    protected $accountLedgerId;

    /**
     *
     * @var number
     */
    protected $accountId;

    /**
     *
     * @var number
     */
    protected $fromAccountId;

    /**
     *
     * @var string
     */
    protected $accountLedgerType;

    /**
     *
     * @var float
     */
    protected $accountLedgerDebitAmount;

    /**
     *
     * @var float
     */
    protected $accountLedgerCreditAmount;

    /**
     *
     * @var float
     */
    protected $accountLedgerBalance;

    /**
     *
     * @var number
     */
    protected $accountLedgerCreate;

    /**
     *
     * @var number
     */
    protected $paymentId;

    /**
     *
     * @var number
     */
    protected $invoiceId;

    /**
     *
     * @var AccountEntity
     */
    protected $accountEntity;

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
     * @return the $accountId
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     *
     * @return the $fromAccountId
     */
    public function getFromAccountId()
    {
        return $this->fromAccountId;
    }

    /**
     *
     * @return the $accountLedgerType
     */
    public function getAccountLedgerType()
    {
        return $this->accountLedgerType;
    }

    /**
     *
     * @return the $accountLedgerDebitAmount
     */
    public function getAccountLedgerDebitAmount()
    {
        return $this->accountLedgerDebitAmount;
    }

    /**
     *
     * @return the $accountLedgerCreditAmount
     */
    public function getAccountLedgerCreditAmount()
    {
        return $this->accountLedgerCreditAmount;
    }

    /**
     *
     * @return the $accountLedgerBalance
     */
    public function getAccountLedgerBalance()
    {
        return $this->accountLedgerBalance;
    }

    /**
     *
     * @return the $accountLedgerCreate
     */
    public function getAccountLedgerCreate()
    {
        return $this->accountLedgerCreate;
    }

    /**
     *
     * @return the $paymentId
     */
    public function getPaymentId()
    {
        return $this->paymentId;
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
     * @return the $accountEntity
     */
    public function getAccountEntity()
    {
        return $this->accountEntity;
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
     * @param number $accountId            
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
    }

    /**
     *
     * @param number $fromAccountId            
     */
    public function setFromAccountId($fromAccountId)
    {
        $this->fromAccountId = $fromAccountId;
    }

    /**
     *
     * @param string $accountLedgerType            
     */
    public function setAccountLedgerType($accountLedgerType)
    {
        $this->accountLedgerType = $accountLedgerType;
    }

    /**
     *
     * @param number $accountLedgerDebitAmount            
     */
    public function setAccountLedgerDebitAmount($accountLedgerDebitAmount)
    {
        $this->accountLedgerDebitAmount = $accountLedgerDebitAmount;
    }

    /**
     *
     * @param number $accountLedgerCreditAmount            
     */
    public function setAccountLedgerCreditAmount($accountLedgerCreditAmount)
    {
        $this->accountLedgerCreditAmount = $accountLedgerCreditAmount;
    }

    /**
     *
     * @param number $accountLedgerBalance            
     */
    public function setAccountLedgerBalance($accountLedgerBalance)
    {
        $this->accountLedgerBalance = $accountLedgerBalance;
    }

    /**
     *
     * @param number $accountLedgerCreate            
     */
    public function setAccountLedgerCreate($accountLedgerCreate)
    {
        $this->accountLedgerCreate = $accountLedgerCreate;
    }

    /**
     *
     * @param number $paymentId            
     */
    public function setPaymentId($paymentId)
    {
        $this->paymentId = $paymentId;
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
     * @param \Account\Entity\AccountEntity $accountEntity            
     */
    public function setAccountEntity($accountEntity)
    {
        $this->accountEntity = $accountEntity;
    }
}