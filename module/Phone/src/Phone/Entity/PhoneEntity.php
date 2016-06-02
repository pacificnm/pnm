<?php
namespace Phone\Entity;

use Location\Entity\LocationEntity;

class PhoneEntity
{

    /**
     *
     * @var nuber
     */
    protected $phoneId;

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
    protected $phoneType;

    /**
     *
     * @var string
     */
    protected $phoneNum;

    /**
     *
     * @var LocationEntity
     */
    protected $locationEntity;

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
     * @return the $phoneType
     */
    public function getPhoneType()
    {
        return $this->phoneType;
    }

    /**
     *
     * @return the $phoneNum
     */
    public function getPhoneNum()
    {
        return $this->phoneNum;
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
     * @param \Phone\Entity\nuber $phoneId            
     */
    public function setPhoneId($phoneId)
    {
        $this->phoneId = $phoneId;
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
     * @param string $phoneType            
     */
    public function setPhoneType($phoneType)
    {
        $this->phoneType = $phoneType;
    }

    /**
     *
     * @param string $phoneNum            
     */
    public function setPhoneNum($phoneNum)
    {
        $this->phoneNum = $phoneNum;
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