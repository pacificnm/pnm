<?php
namespace Panorama\Entity;

class LocationEntity
{

    /**
     *
     * @var bool
     */
    protected $manuallySet;

    /**
     *
     * @var float
     */
    protected $latitude;

    /**
     *
     * @var float
     */
    protected $longitude;

    /**
     *
     * @var string
     */
    protected $notes;

    /**
     *
     * @var string
     */
    protected $city;

    /**
     *
     * @var string
     */
    protected $country;

    /**
     *
     * @var string
     */
    protected $roaming;

    /**
     *
     * @var string
     */
    protected $publicIp;

    /**
     *
     * @return the $manuallySet
     */
    public function getManuallySet()
    {
        return $this->manuallySet;
    }

    /**
     *
     * @return the $latitude
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     *
     * @return the $longitude
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     *
     * @return the $notes
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     *
     * @return the $city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     *
     * @return the $country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     *
     * @return the $roaming
     */
    public function getRoaming()
    {
        return $this->roaming;
    }

    /**
     *
     * @return the $publicIp
     */
    public function getPublicIp()
    {
        return $this->publicIp;
    }

    /**
     *
     * @param boolean $manuallySet            
     */
    public function setManuallySet($manuallySet)
    {
        $this->manuallySet = $manuallySet;
    }

    /**
     *
     * @param number $latitude            
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     *
     * @param number $longitude            
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     *
     * @param string $notes            
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    /**
     *
     * @param string $city            
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     *
     * @param string $country            
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     *
     * @param string $roaming            
     */
    public function setRoaming($roaming)
    {
        $this->roaming = $roaming;
    }

    /**
     *
     * @param string $publicIp            
     */
    public function setPublicIp($publicIp)
    {
        $this->publicIp = $publicIp;
    }
}