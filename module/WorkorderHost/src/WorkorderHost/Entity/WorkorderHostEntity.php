<?php
namespace WorkorderHost\Entity;

use Host\Entity\HostEntity;

class WorkorderHostEntity
{

    /**
     *
     * @var number
     */
    protected $workorderHostId;

    /**
     *
     * @var number
     */
    protected $hostId;

    /**
     *
     * @var number
     */
    protected $workorderId;

    /**
     *
     * @var HostEntity
     */
    protected $hostEntity;

    /**
     *
     * @return the $workorderHostId
     */
    public function getWorkorderHostId()
    {
        return $this->workorderHostId;
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
     * @return the $workorderId
     */
    public function getWorkorderId()
    {
        return $this->workorderId;
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
     * @param number $workorderHostId            
     */
    public function setWorkorderHostId($workorderHostId)
    {
        $this->workorderHostId = $workorderHostId;
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
     * @param number $workorderId            
     */
    public function setWorkorderId($workorderId)
    {
        $this->workorderId = $workorderId;
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

