<?php
namespace Account\Entity;

use AccountType\Entity\TypeEntity;

class AccountEntity
{

    /**
     *
     * @var number
     */
    protected $accountId;

    /**
     *
     * @var number
     */
    protected $accountTypeId;

    /**
     *
     * @var string
     */
    protected $accountName;

    /**
     *
     * @var string
     */
    protected $accountDescription;

    /**
     *
     * @var string
     */
    protected $accountNumber;

    /**
     *
     * @var float
     */
    protected $accountBalance;

    /**
     *
     * @var number
     */
    protected $accountCreated;

    /**
     *
     * @var boolean
     */
    protected $accountActive;

    /**
     *
     * @var boolean
     */
    protected $accountVisible;

    /**
     *
     * @var TypeEntity
     */
    protected $typeEntity;

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
     * @return the $accountTypeId
     */
    public function getAccountTypeId()
    {
        return $this->accountTypeId;
    }

    /**
     *
     * @return the $accountName
     */
    public function getAccountName()
    {
        return $this->accountName;
    }

    /**
     *
     * @return the $accountDescription
     */
    public function getAccountDescription()
    {
        return $this->accountDescription;
    }

    /**
     *
     * @return the $accountNumber
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     *
     * @return the $accountBalance
     */
    public function getAccountBalance()
    {
        return $this->accountBalance;
    }

    /**
     *
     * @return the $accountCreated
     */
    public function getAccountCreated()
    {
        return $this->accountCreated;
    }

    /**
     *
     * @return the $accountActive
     */
    public function getAccountActive()
    {
        return $this->accountActive;
    }

    /**
     *
     * @return the $accountVisible
     */
    public function getAccountVisible()
    {
        return $this->accountVisible;
    }

    /**
     *
     * @return the $typeEntity
     */
    public function getTypeEntity()
    {
        return $this->typeEntity;
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
     * @param number $accountTypeId            
     */
    public function setAccountTypeId($accountTypeId)
    {
        $this->accountTypeId = $accountTypeId;
    }

    /**
     *
     * @param string $accountName            
     */
    public function setAccountName($accountName)
    {
        $this->accountName = $accountName;
    }

    /**
     *
     * @param string $accountDescription            
     */
    public function setAccountDescription($accountDescription)
    {
        $this->accountDescription = $accountDescription;
    }

    /**
     *
     * @param string $accountNumber            
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
    }

    /**
     *
     * @param number $accountBalance            
     */
    public function setAccountBalance($accountBalance)
    {
        $this->accountBalance = $accountBalance;
    }

    /**
     *
     * @param number $accountCreated            
     */
    public function setAccountCreated($accountCreated)
    {
        $this->accountCreated = $accountCreated;
    }

    /**
     *
     * @param boolean $accountActive            
     */
    public function setAccountActive($accountActive)
    {
        $this->accountActive = $accountActive;
    }

    /**
     *
     * @param boolean $accountVisible            
     */
    public function setAccountVisible($accountVisible)
    {
        $this->accountVisible = $accountVisible;
    }

    /**
     *
     * @param \AccountType\Entity\TypeEntity $typeEntity            
     */
    public function setTypeEntity($typeEntity)
    {
        $this->typeEntity = $typeEntity;
    }
}
