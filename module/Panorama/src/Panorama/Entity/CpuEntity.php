<?php
namespace Panorama\Entity;

class CpuEntity
{

    /**
     *
     * @var String
     */
    protected $manufacturer;

    /**
     *
     * @var String
     */
    protected $model;

    /**
     *
     * @var String
     */
    protected $speed;

    /**
     *
     * @var number
     */
    protected $count;

    /**
     *
     * @var String
     */
    protected $cores;

    /**
     *
     * @var number
     */
    protected $bitSize;

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
     * @return the $model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     *
     * @return the $speed
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     *
     * @return the $count
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     *
     * @return the $cores
     */
    public function getCores()
    {
        return $this->cores;
    }

    /**
     *
     * @return the $bitSize
     */
    public function getBitSize()
    {
        return $this->bitSize;
    }

    /**
     *
     * @param \Panorama\Entity\String $manufacturer            
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }

    /**
     *
     * @param \Panorama\Entity\String $model            
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     *
     * @param \Panorama\Entity\String $speed            
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;
    }

    /**
     *
     * @param number $count            
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    /**
     *
     * @param \Panorama\Entity\String $cores            
     */
    public function setCores($cores)
    {
        $this->cores = $cores;
    }

    /**
     *
     * @param number $bitSize            
     */
    public function setBitSize($bitSize)
    {
        $this->bitSize = $bitSize;
    }
}
