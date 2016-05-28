<?php
namespace User\Entity;

use Client\Entity\ClientEntity;
use Location\Entity\LocationEntity;

class UserEntity implements UserEntityInterface
{

    /**
     *
     * @var number
     */
    protected $userId;

    /**
     *
     * @var number
     */
    protected $clientId;

    /**
     *
     * @var number
     */
    protected $locationId;

    /**
     *
     * @var string
     */
    protected $userStatus;

    /**
     *
     * @var string
     */
    protected $userNameFirst;

    /**
     *
     * @var string
     */
    protected $userNameLast;

    /**
     *
     * @var string
     */
    protected $userJobTitle;

    /**
     *
     * @var string
     */
    protected $userEmail;

    /**
     *
     * @var string
     */
    protected $userType;

    /**
     *
     * @var ClientEntity
     */
    protected $clientEntity;

    /**
     *
     * @var LocationEntity
     */
    protected $locationEntity;

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
     * @return the $clientId
     */
    public function getClientId()
    {
        return $this->clientId;
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
     * @return the $userStatus
     */
    public function getUserStatus()
    {
        return $this->userStatus;
    }

    /**
     *
     * @return the $userNameFirst
     */
    public function getUserNameFirst()
    {
        return $this->userNameFirst;
    }

    /**
     *
     * @return the $userNameLast
     */
    public function getUserNameLast()
    {
        return $this->userNameLast;
    }

    /**
     *
     * @return the $userJobTitle
     */
    public function getUserJobTitle()
    {
        return $this->userJobTitle;
    }

    /**
     *
     * @return the $userEmail
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     *
     * @return the $userType
     */
    public function getUserType()
    {
        return $this->userType;
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
     * @return the $locationEntity
     */
    public function getLocationEntity()
    {
        return $this->locationEntity;
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
     * @param number $clientId            
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
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
     * @param string $userStatus            
     */
    public function setUserStatus($userStatus)
    {
        $this->userStatus = $userStatus;
    }

    /**
     *
     * @param string $userNameFirst            
     */
    public function setUserNameFirst($userNameFirst)
    {
        $this->userNameFirst = $userNameFirst;
    }

    /**
     *
     * @param string $userNameLast            
     */
    public function setUserNameLast($userNameLast)
    {
        $this->userNameLast = $userNameLast;
    }

    /**
     *
     * @param string $userJobTitle            
     */
    public function setUserJobTitle($userJobTitle)
    {
        $this->userJobTitle = $userJobTitle;
    }

    /**
     *
     * @param string $userEmail            
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;
    }

    /**
     *
     * @param string $userType            
     */
    public function setUserType($userType)
    {
        $this->userType = $userType;
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
     * @param \Location\Entity\LocationEntity $locationEntity            
     */
    public function setLocationEntity($locationEntity)
    {
        $this->locationEntity = $locationEntity;
    }
}