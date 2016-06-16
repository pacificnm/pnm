<?php
namespace Location\Entity;

class LocationEntity
{

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
     * @var string
     */
    protected $locationType;

    /**
     *
     * @var string
     */
    protected $locationStreet;

    /**
     *
     * @var string
     */
    protected $locationStreetCont;

    /**
     *
     * @var string
     */
    protected $locationCity;

    /**
     *
     * @var string
     */
    protected $locationState;

    /**
     *
     * @var string
     */
    protected $locationZip;

    /**
     *
     * @var string
     */
    protected $locationStatus;

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
     * @return the $locationType
     */
    public function getLocationType()
    {
        return $this->locationType;
    }

    /**
     *
     * @return the $locationStreet
     */
    public function getLocationStreet()
    {
        return $this->locationStreet;
    }

    /**
     *
     * @return the $locationStreetCont
     */
    public function getLocationStreetCont()
    {
        return $this->locationStreetCont;
    }

    /**
     *
     * @return the $locationCity
     */
    public function getLocationCity()
    {
        return $this->locationCity;
    }

    /**
     *
     * @return the $locationState
     */
    public function getLocationState()
    {
        return $this->locationState;
    }

    /**
     *
     * @return the $locationZip
     */
    public function getLocationZip()
    {
        return $this->locationZip;
    }

    /**
     *
     * @return the $locationStatus
     */
    public function getLocationStatus()
    {
        return $this->locationStatus;
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
     * @param string $locationType            
     */
    public function setLocationType($locationType)
    {
        $this->locationType = $locationType;
    }

    /**
     *
     * @param string $locationStreet            
     */
    public function setLocationStreet($locationStreet)
    {
        $this->locationStreet = $locationStreet;
    }

    /**
     *
     * @param string $locationStreetCont            
     */
    public function setLocationStreetCont($locationStreetCont)
    {
        $this->locationStreetCont = $locationStreetCont;
    }

    /**
     *
     * @param string $locationCity            
     */
    public function setLocationCity($locationCity)
    {
        $this->locationCity = $locationCity;
    }

    /**
     *
     * @param string $locationState            
     */
    public function setLocationState($locationState)
    {
        $this->locationState = $locationState;
    }

    /**
     *
     * @param string $locationZip            
     */
    public function setLocationZip($locationZip)
    {
        $this->locationZip = $locationZip;
    }

    /**
     *
     * @param string $locationStatus            
     */
    public function setLocationStatus($locationStatus)
    {
        $this->locationStatus = $locationStatus;
    }
}
