<?php
namespace TaskPriority\Entity;

class PriorityEntity
{
    /**
     * 
     * @var number
     */
    protected $taskPriorityId;
    
    /**
     * 
     * @var string
     */
    protected $taskPriorityValue;
    
    /**
     * @return the $taskPriorityId
     */
    public function getTaskPriorityId()
    {
        return $this->taskPriorityId;
    }

    /**
     * @return the $taskPriorityValue
     */
    public function getTaskPriorityValue()
    {
        return $this->taskPriorityValue;
    }

    /**
     * @param number $taskPriorityId
     */
    public function setTaskPriorityId($taskPriorityId)
    {
        $this->taskPriorityId = $taskPriorityId;
    }

    /**
     * @param string $taskPriorityValue
     */
    public function setTaskPriorityValue($taskPriorityValue)
    {
        $this->taskPriorityValue = $taskPriorityValue;
    }

    
    
}