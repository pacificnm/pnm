<?php
namespace Client\Entity;

use Phone\Entity\PhoneEntity;
use Location\Entity\LocationEntity;
use User\Entity\UserEntity;

class ClientEntity implements ClientEntityInterface
{

    /**
     *
     * @var number
     */
    protected $clientId;

    /**
     *
     * @var string
     */
    protected $clientName;

    /**
     *
     * @var string
     */
    protected $clientStatus;

    /**
     *
     * @var number
     */
    protected $clientCreated;

    /**
     *
     * @var LocationEntity
     */
    protected $locationEntity;

    /**
     *
     * @var PhoneEntity
     */
    protected $phoneEntity;

    /**
     *
     * @var UserEntity
     */
    protected $userEntity;

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
     * @return the $clientName
     */
    public function getClientName()
    {
        return $this->clientName;
    }

    /**
     *
     * @return the $clientStatus
     */
    public function getClientStatus()
    {
        return $this->clientStatus;
    }

    /**
     *
     * @return the $clientCreated
     */
    public function getClientCreated()
    {
        return $this->clientCreated;
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
     * @return the $phoneEntity
     */
    public function getPhoneEntity()
    {
        return $this->phoneEntity;
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
     * @param number $clientId            
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     *
     * @param string $clientName            
     */
    public function setClientName($clientName)
    {
        $this->clientName = $clientName;
    }

    /**
     *
     * @param string $clientStatus            
     */
    public function setClientStatus($clientStatus)
    {
        $this->clientStatus = $clientStatus;
    }

    /**
     *
     * @param number $clientCreated            
     */
    public function setClientCreated($clientCreated)
    {
        $this->clientCreated = $clientCreated;
    }

    /**
     *
     * @param \Location\Entity\LocationEntity $locationEntity            
     */
    public function setLocationEntity($locationEntity)
    {
        $this->locationEntity = $locationEntity;
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
     * @param \User\Entity\UserEntity $userEntity            
     */
    public function setUserEntity($userEntity)
    {
        $this->userEntity = $userEntity;
    }
}
