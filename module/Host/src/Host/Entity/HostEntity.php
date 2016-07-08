<?php
namespace Host\Entity;

use HostType\Entity\TypeEntity;
use Location\Entity\LocationEntity;

class HostEntity
{

    /**
     *
     * @var number
     */
    protected $hostId;

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
     * @var number
     */
    protected $hostTypeId;

    /**
     *
     * @var string
     */
    protected $hostName;

    /**
     *
     * @var string
     */
    protected $hostDescription;

    /**
     *
     * @var string
     */
    protected $hostIp;

    /**
     *
     * @var string
     */
    protected $hostStatus;

    /**
     *
     * @var string
     */
    protected $hostHealth;

    /**
     *
     * @var number
     */
    protected $hostCreated;

    /**
     *
     * @var TypeEntity
     */
    protected $typeEntity;

    /**
     *
     * @var LocationEntity
     */
    protected $locationEntity;

    /**
     *
     * @return the $hostId
     */
    public function getHostId()
    {
        return $this->hostId;
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
     * @return the $hostTypeId
     */
    public function getHostTypeId()
    {
        return $this->hostTypeId;
    }

    /**
     *
     * @return the $hostName
     */
    public function getHostName()
    {
        return $this->hostName;
    }

    /**
     *
     * @return the $hostDescription
     */
    public function getHostDescription()
    {
        return $this->hostDescription;
    }

    /**
     *
     * @return the $hostIp
     */
    public function getHostIp()
    {
        return $this->hostIp;
    }

    /**
     *
     * @return the $hostStatus
     */
    public function getHostStatus()
    {
        return $this->hostStatus;
    }

    /**
     *
     * @return the $hostHealth
     */
    public function getHostHealth()
    {
        return $this->hostHealth;
    }

    /**
     *
     * @return the $hostCreated
     */
    public function getHostCreated()
    {
        return $this->hostCreated;
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
     * @return the $locationEntity
     */
    public function getLocationEntity()
    {
        return $this->locationEntity;
    }

    /**
     *
     * @param number $hostId            
     */
    public function setHostId($hostId)
    {
        $this->hostId = $hostId;
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
     * @param number $hostTypeId            
     */
    public function setHostTypeId($hostTypeId)
    {
        $this->hostTypeId = $hostTypeId;
    }

    /**
     *
     * @param string $hostName            
     */
    public function setHostName($hostName)
    {
        $this->hostName = $hostName;
    }

    /**
     *
     * @param string $hostDescription            
     */
    public function setHostDescription($hostDescription)
    {
        $this->hostDescription = $hostDescription;
    }

    /**
     *
     * @param string $hostIp            
     */
    public function setHostIp($hostIp)
    {
        $this->hostIp = $hostIp;
    }

    /**
     *
     * @param string $hostStatus            
     */
    public function setHostStatus($hostStatus)
    {
        $this->hostStatus = $hostStatus;
    }

    /**
     *
     * @param string $hostHealth            
     */
    public function setHostHealth($hostHealth)
    {
        $this->hostHealth = $hostHealth;
    }

    /**
     *
     * @param number $hostCreated            
     */
    public function setHostCreated($hostCreated)
    {
        $this->hostCreated = $hostCreated;
    }

    /**
     *
     * @param \HostType\Entity\TypeEntity $typeEntity            
     */
    public function setTypeEntity($typeEntity)
    {
        $this->typeEntity = $typeEntity;
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