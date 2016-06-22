<?php
namespace Vendor\Entity;

class VendorEntity
{

    /**
     *
     * @var number
     */
    protected $vendorId;

    /**
     *
     * @var string
     */
    protected $vendorName;

    /**
     *
     * @var string
     */
    protected $vendorAccountNumber;

    /**
     *
     * @var string
     */
    protected $vendorStreet;

    /**
     *
     * @var string
     */
    protected $vendorStreetCont;

    /**
     *
     * @var string
     */
    protected $vendorCity;

    /**
     *
     * @var string
     */
    protected $vendorState;

    /**
     *
     * @var string
     */
    protected $vendorPostal;

    /**
     *
     * @var string
     */
    protected $vendorPhone;

    /**
     *
     * @var string
     */
    protected $vendorWebsite;

    /**
     *
     * @var boolean
     */
    protected $vendorActive;

    /**
     *
     * @return the $vendorId
     */
    public function getVendorId()
    {
        return $this->vendorId;
    }

    /**
     *
     * @return the $vendorName
     */
    public function getVendorName()
    {
        return $this->vendorName;
    }

    /**
     *
     * @return the $vendorAccountNumber
     */
    public function getVendorAccountNumber()
    {
        return $this->vendorAccountNumber;
    }

    /**
     *
     * @return the $vendorStreet
     */
    public function getVendorStreet()
    {
        return $this->vendorStreet;
    }

    /**
     *
     * @return the $vendorStreetCont
     */
    public function getVendorStreetCont()
    {
        return $this->vendorStreetCont;
    }

    /**
     *
     * @return the $vendorCity
     */
    public function getVendorCity()
    {
        return $this->vendorCity;
    }

    /**
     *
     * @return the $vendorState
     */
    public function getVendorState()
    {
        return $this->vendorState;
    }

    /**
     *
     * @return the $vendorPostal
     */
    public function getVendorPostal()
    {
        return $this->vendorPostal;
    }

    /**
     *
     * @return the $vendorPhone
     */
    public function getVendorPhone()
    {
        return $this->vendorPhone;
    }

    /**
     *
     * @return the $vendorWebsite
     */
    public function getVendorWebsite()
    {
        return $this->vendorWebsite;
    }

    /**
     *
     * @return the $vendorActive
     */
    public function getVendorActive()
    {
        return $this->vendorActive;
    }

    /**
     *
     * @param number $vendorId            
     */
    public function setVendorId($vendorId)
    {
        $this->vendorId = $vendorId;
    }

    /**
     *
     * @param string $vendorName            
     */
    public function setVendorName($vendorName)
    {
        $this->vendorName = $vendorName;
    }

    /**
     *
     * @param string $vendorAccountNumber            
     */
    public function setVendorAccountNumber($vendorAccountNumber)
    {
        $this->vendorAccountNumber = $vendorAccountNumber;
    }

    /**
     *
     * @param string $vendorStreet            
     */
    public function setVendorStreet($vendorStreet)
    {
        $this->vendorStreet = $vendorStreet;
    }

    /**
     *
     * @param string $vendorStreetCont            
     */
    public function setVendorStreetCont($vendorStreetCont)
    {
        $this->vendorStreetCont = $vendorStreetCont;
    }

    /**
     *
     * @param string $vendorCity            
     */
    public function setVendorCity($vendorCity)
    {
        $this->vendorCity = $vendorCity;
    }

    /**
     *
     * @param string $vendorState            
     */
    public function setVendorState($vendorState)
    {
        $this->vendorState = $vendorState;
    }

    /**
     *
     * @param string $vendorPostal            
     */
    public function setVendorPostal($vendorPostal)
    {
        $this->vendorPostal = $vendorPostal;
    }

    /**
     *
     * @param string $vendorPhone            
     */
    public function setVendorPhone($vendorPhone)
    {
        $this->vendorPhone = $vendorPhone;
    }

    /**
     *
     * @param string $vendorWebsite            
     */
    public function setVendorWebsite($vendorWebsite)
    {
        $this->vendorWebsite = $vendorWebsite;
    }

    /**
     *
     * @param boolean $vendorActive            
     */
    public function setVendorActive($vendorActive)
    {
        $this->vendorActive = $vendorActive;
    }
}
