<?php
namespace Workorder\Entity;

use Phone\Entity\PhoneEntity;
use Location\Entity\LocationEntity;
use User\Entity\UserEntity;
use Client\Entity\ClientEntity;

class WorkorderEntity
{

    /**
     *
     * @var number
     */
    protected $workorderId;

    /**
     *
     * @var number
     */
    protected $locationId;

    /**
     *
     * @var number
     */
    protected $clientId;

    /**
     *
     * @var number
     */
    protected $userId;

    /**
     *
     * @var number
     */
    protected $phoneId;

    /**
     *
     * @var string
     */
    protected $workorderStatus;

    /**
     *
     * @var string
     */
    protected $workorderTitle;

    /**
     *
     * @var string
     */
    protected $workorderDescription;

    /**
     *
     * @var float
     */
    protected $workorderLabor;

    /**
     *
     * @var float
     */
    protected $workorderParts;

    /**
     *
     * @var number
     */
    protected $workorderDateCreate;

    /**
     *
     * @var number
     */
    protected $workorderDateScheduled;

    /**
     *
     * @var number
     */
    protected $workorderDateEnd;

    /**
     *
     * @var number
     */
    protected $workorderDateClose;

    /**
     *
     * @var string
     */
    protected $workorderSignature;

    /**
     *
     * @var number
     */
    protected $invoiceId;

    /**
     *
     * @var ClientEntity
     */
    protected $clientEntity;

    /**
     *
     * @var UserEntity
     */
    protected $userEntity;

    /**
     *
     * @var PhoneEntity
     */
    protected $phoneEntity;

    /**
     *
     * @var LocationEntity
     */
    protected $locationEntity;

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
     * @return the $locationId
     */
    public function getLocationId()
    {
        return $this->locationId;
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
     * @return the $userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     *
     * @return the $phoneId
     */
    public function getPhoneId()
    {
        return $this->phoneId;
    }

    /**
     *
     * @return the $workorderStatus
     */
    public function getWorkorderStatus()
    {
        return $this->workorderStatus;
    }

    /**
     *
     * @return the $workorderTitle
     */
    public function getWorkorderTitle()
    {
        return $this->workorderTitle;
    }

    /**
     *
     * @return the $workorderDescription
     */
    public function getWorkorderDescription()
    {
        return $this->workorderDescription;
    }

    /**
     *
     * @return the $workorderLabor
     */
    public function getWorkorderLabor()
    {
        return $this->workorderLabor;
    }

    /**
     *
     * @return the $workorderParts
     */
    public function getWorkorderParts()
    {
        return $this->workorderParts;
    }

    /**
     *
     * @return the $workorderDateCreate
     */
    public function getWorkorderDateCreate()
    {
        return $this->workorderDateCreate;
    }

    /**
     *
     * @return the $workorderDateScheduled
     */
    public function getWorkorderDateScheduled()
    {
        return $this->workorderDateScheduled;
    }

    /**
     *
     * @return the $workorderDateEnd
     */
    public function getWorkorderDateEnd()
    {
        return $this->workorderDateEnd;
    }

    /**
     *
     * @return the $workorderDateClose
     */
    public function getWorkorderDateClose()
    {
        return $this->workorderDateClose;
    }

    /**
     *
     * @return the $workorderSignature
     */
    public function getWorkorderSignature()
    {
        return $this->workorderSignature;
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
     * @return the $clientEntity
     */
    public function getClientEntity()
    {
        return $this->clientEntity;
    }

    /**
     *
     * @return the $userEntity
     */
    public function getUserEntity()
    {
        return $this->userEntity;
    }

    /**
     *
     * @return the $phoneEntity
     */
    public function getPhoneEntity()
    {
        return $this->phoneEntity;
    }

    /**
     *
     * @return the $locationEntity
     */
    public function getLocationEntity()
    {
        return $this->locationEntity;
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
     * @param number $locationId            
     */
    public function setLocationId($locationId)
    {
        $this->locationId = $locationId;
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
     * @param number $userId            
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     *
     * @param number $phoneId            
     */
    public function setPhoneId($phoneId)
    {
        $this->phoneId = $phoneId;
    }

    /**
     *
     * @param string $workorderStatus            
     */
    public function setWorkorderStatus($workorderStatus)
    {
        $this->workorderStatus = $workorderStatus;
    }

    /**
     *
     * @param string $workorderTitle            
     */
    public function setWorkorderTitle($workorderTitle)
    {
        $this->workorderTitle = $workorderTitle;
    }

    /**
     *
     * @param string $workorderDescription            
     */
    public function setWorkorderDescription($workorderDescription)
    {
        $this->workorderDescription = $workorderDescription;
    }

    /**
     *
     * @param number $workorderLabor            
     */
    public function setWorkorderLabor($workorderLabor)
    {
        $this->workorderLabor = $workorderLabor;
    }

    /**
     *
     * @param number $workorderParts            
     */
    public function setWorkorderParts($workorderParts)
    {
        $this->workorderParts = $workorderParts;
    }

    /**
     *
     * @param number $workorderDateCreate            
     */
    public function setWorkorderDateCreate($workorderDateCreate)
    {
        $this->workorderDateCreate = $workorderDateCreate;
    }

    /**
     *
     * @param number $workorderDateScheduled            
     */
    public function setWorkorderDateScheduled($workorderDateScheduled)
    {
        $this->workorderDateScheduled = $workorderDateScheduled;
    }

    /**
     *
     * @param number $workorderDateEnd            
     */
    public function setWorkorderDateEnd($workorderDateEnd)
    {
        $this->workorderDateEnd = $workorderDateEnd;
    }

    /**
     *
     * @param number $workorderDateClose            
     */
    public function setWorkorderDateClose($workorderDateClose)
    {
        $this->workorderDateClose = $workorderDateClose;
    }

    /**
     *
     * @param string $workorderSignature            
     */
    public function setWorkorderSignature($workorderSignature)
    {
        $this->workorderSignature = $workorderSignature;
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
     * @param \Client\Entity\ClientEntity $clientEntity            
     */
    public function setClientEntity($clientEntity)
    {
        $this->clientEntity = $clientEntity;
    }

    /**
     *
     * @param \User\Entity\UserEntity $userEntity            
     */
    public function setUserEntity($userEntity)
    {
        $this->userEntity = $userEntity;
    }

    /**
     *
     * @param \Phone\Entity\PhoneEntity $phoneEntity            
     */
    public function setPhoneEntity($phoneEntity)
    {
        $this->phoneEntity = $phoneEntity;
    }

    /**
     *
     * @param \Location\Entity\LocationEntity $locationEntity            
     */
    public function setLocationEntity($locationEntity)
    {
        $this->locationEntity = $locationEntity;
    }
}
