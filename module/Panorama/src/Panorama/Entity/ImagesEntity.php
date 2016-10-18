<?php
namespace Panorama\Entity;

class ImagesEntity
{

    /**
     *
     * @var string
     */
    protected $device;

    /**
     *
     * @var string
     */
    protected $manufacturer;

    /**
     *
     * @var string
     */
    protected $os;

    /**
     *
     * @return the $device
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     *
     * @return the $manufacturer
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     *
     * @return the $os
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     *
     * @param string $device            
     */
    public function setDevice($device)
    {
        $this->device = $device;
    }

    /**
     *
     * @param string $manufacturer            
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }

    /**
     *
     * @param string $os            
     */
    public function setOs($os)
    {
        $this->os = $os;
    }
}