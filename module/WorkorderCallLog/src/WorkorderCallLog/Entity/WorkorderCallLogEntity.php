<?php
namespace WorkorderCallLog\Entity;

use CallLog\V1\Rest\CallLog\CallLogEntity;
use Workorder\Entity\WorkorderEntity;

class WorkorderCallLogEntity
{

    /**
     *
     * @var number
     */
    protected $workorderCallLogId;

    /**
     *
     * @var number
     */
    protected $workorderId;

    /**
     *
     * @var number
     */
    protected $callLogId;

    /**
     *
     * @var number
     */
    protected $workorderCallLogCreated;

    /**
     *
     * @var CallLogEntity
     */
    protected $callLogEntity;

    /**
     *
     * @var WorkorderEntity
     */
    protected $workorderEntity;

    /**
     *
     * @return the $workorderCallLogId
     */
    public function getWorkorderCallLogId()
    {
        return $this->workorderCallLogId;
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
     * @return the $callLogId
     */
    public function getCallLogId()
    {
        return $this->callLogId;
    }

    /**
     *
     * @return the $workorderCallLogCreated
     */
    public function getWorkorderCallLogCreated()
    {
        return $this->workorderCallLogCreated;
    }

    /**
     *
     * @return the $callLogEntity
     */
    public function getCallLogEntity()
    {
        return $this->callLogEntity;
    }

    /**
     *
     * @return the $workorderEntity
     */
    public function getWorkorderEntity()
    {
        return $this->workorderEntity;
    }

    /**
     *
     * @param number $workorderCallLogId            
     */
    public function setWorkorderCallLogId($workorderCallLogId)
    {
        $this->workorderCallLogId = $workorderCallLogId;
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
     * @param number $callLogId            
     */
    public function setCallLogId($callLogId)
    {
        $this->callLogId = $callLogId;
    }

    /**
     *
     * @param number $workorderCallLogCreated            
     */
    public function setWorkorderCallLogCreated($workorderCallLogCreated)
    {
        $this->workorderCallLogCreated = $workorderCallLogCreated;
    }

    /**
     *
     * @param \CallLog\V1\Rest\CallLog\CallLogEntity $callLogEntity            
     */
    public function setCallLogEntity($callLogEntity)
    {
        $this->callLogEntity = $callLogEntity;
    }

    /**
     *
     * @param \Workorder\Entity\WorkorderEntity $workorderEntity            
     */
    public function setWorkorderEntity($workorderEntity)
    {
        $this->workorderEntity = $workorderEntity;
    }
}