<?php
namespace PanoramaHost\Entity;

use Host\Entity\HostEntity;

class PanoramaHostEntity
{

    /**
     *
     * @var number
     */
    protected $panoramaHostId;

    /**
     *
     * @var number
     */
    protected $hostId;

    /**
     *
     * @var string
     */
    protected $panoramaDeviceId;

    /**
     *
     * @var number
     */
    protected $panoramaHostLastSync;

    /**
     *
     * @var HostEntity
     */
    protected $hostEntity;

    /**
     *
     * @return the $panoramaHostId
     */
    public function getPanoramaHostId()
    {
        return $this->panoramaHostId;
    }

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
     * @return the $panoramaDeviceId
     */
    public function getPanoramaDeviceId()
    {
        return $this->panoramaDeviceId;
    }

    /**
     *
     * @return the $panoramaHostLastSync
     */
    public function getPanoramaHostLastSync()
    {
        return $this->panoramaHostLastSync;
    }

    /**
     *
     * @return the $hostEntity
     */
    public function getHostEntity()
    {
        return $this->hostEntity;
    }

    /**
     *
     * @param number $panoramaHostId            
     */
    public function setPanoramaHostId($panoramaHostId)
    {
        $this->panoramaHostId = $panoramaHostId;
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
     * @param string $panoramaDeviceId            
     */
    public function setPanoramaDeviceId($panoramaDeviceId)
    {
        $this->panoramaDeviceId = $panoramaDeviceId;
    }

    /**
     *
     * @param number $panoramaHostLastSync            
     */
    public function setPanoramaHostLastSync($panoramaHostLastSync)
    {
        $this->panoramaHostLastSync = $panoramaHostLastSync;
    }

    /**
     *
     * @param \Host\Entity\HostEntity $hostEntity            
     */
    public function setHostEntity($hostEntity)
    {
        $this->hostEntity = $hostEntity;
    }
}