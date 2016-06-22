<?php
namespace ClientAccount\Entity;

use Account\Entity\AccountEntity;

class AccountEntity
{

    /**
     *
     * @var number
     */
    protected $clientAccountId;

    /**
     *
     * @var number
     */
    protected $clientId;

    /**
     *
     * @var number
     */
    protected $accountId;

    /**
     *
     * @var AccountEntity
     */
    protected $accountEntity;

    /**
     *
     * @return the $clientAccountId
     */
    public function getClientAccountId()
    {
        return $this->clientAccountId;
    }

    /**
     *
     * @return the $clientId
     */
    public function getClientId()
    {
        return $this->clientId;
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
     * @return the $accountEntity
     */
    public function getAccountEntity()
    {
        return $this->accountEntity;
    }

    /**
     *
     * @param number $clientAccountId            
     */
    public function setClientAccountId($clientAccountId)
    {
        $this->clientAccountId = $clientAccountId;
    }

    /**
     *
     * @param number $clientId            
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
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
     * @param \Account\Entity\AccountEntity $accountEntity            
     */
    public function setAccountEntity($accountEntity)
    {
        $this->accountEntity = $accountEntity;
    }
}
