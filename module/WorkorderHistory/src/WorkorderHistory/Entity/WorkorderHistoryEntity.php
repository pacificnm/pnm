<?php
namespace WorkorderHistory\Entity;

use History\Entity\HistoryEntity;

class WorkorderHistoryEntity
{

    /**
     *
     * @var number
     */
    protected $workorderHistoryId;

    /**
     *
     * @var number
     */
    protected $workorderId;

    /**
     *
     * @var number
     */
    protected $historyId;

    /**
     *
     * @var HistoryEntity
     */
    protected $historyEntity;

    /**
     *
     * @return the $workorderHistoryId
     */
    public function getWorkorderHistoryId()
    {
        return $this->workorderHistoryId;
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
     * @return the $historyId
     */
    public function getHistoryId()
    {
        return $this->historyId;
    }

    /**
     *
     * @return the $historyEntity
     */
    public function getHistoryEntity()
    {
        return $this->historyEntity;
    }

    /**
     *
     * @param number $workorderHistoryId            
     */
    public function setWorkorderHistoryId($workorderHistoryId)
    {
        $this->workorderHistoryId = $workorderHistoryId;
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
     * @param number $historyId            
     */
    public function setHistoryId($historyId)
    {
        $this->historyId = $historyId;
    }

    /**
     *
     * @param \History\Entity\HistoryEntity $historyEntity            
     */
    public function setHistoryEntity($historyEntity)
    {
        $this->historyEntity = $historyEntity;
    }
}

