<?php
namespace AccountType\Entity;

class TypeEntity
{

    /**
     *
     * @var number
     */
    protected $accountTypeId;

    /**
     *
     * @var string
     */
    protected $accountTypeName;

    /**
     *
     * @var Boolean
     */
    protected $accountTypeActive;

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
     * @return the $accountTypeName
     */
    public function getAccountTypeName()
    {
        return $this->accountTypeName;
    }

    /**
     *
     * @return the $accountTypeActive
     */
    public function getAccountTypeActive()
    {
        return $this->accountTypeActive;
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
     * @param string $accountTypeName            
     */
    public function setAccountTypeName($accountTypeName)
    {
        $this->accountTypeName = $accountTypeName;
    }

    /**
     *
     * @param \AccountType\Entity\Boolean $accountTypeActive            
     */
    public function setAccountTypeActive($accountTypeActive)
    {
        $this->accountTypeActive = $accountTypeActive;
    }
}