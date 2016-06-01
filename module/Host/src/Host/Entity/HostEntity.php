<?php
namespace Host\Entity;

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
    protected $hostType;

    /**
     *
     * @var string
     */
    protected $hostName;

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
     * @return the $hostType
     */
    public function getHostType()
    {
        return $this->hostType;
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
     * @param number $hostType            
     */
    public function setHostType($hostType)
    {
        $this->hostType = $hostType;
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
}