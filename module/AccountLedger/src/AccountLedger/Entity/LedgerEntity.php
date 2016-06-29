<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace AccountLedger\Entity;

use Account\Entity\AccountEntity;

/**
 * 
 * @author jaimie
 *
 */
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
     * @var string
     */
    protected $accountLedgerMemo;

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
     * @return the $accountLedgerMemo
     */
    public function getAccountLedgerMemo()
    {
        return $this->accountLedgerMemo;
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
     * @param string $accountLedgerMemo            
     */
    public function setAccountLedgerMemo($accountLedgerMemo)
    {
        $this->accountLedgerMemo = $accountLedgerMemo;
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