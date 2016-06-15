<?php
namespace Task\Entity;

use Employee\Entity\EmployeeEntity;
use Client\Entity\ClientEntity;
use TaskPriority\Entity\PriorityEntity;

class TaskEntity
{

    /**
     *
     * @var number
     */
    protected $taskId;

    /**
     *
     * @var number
     */
    protected $employeeId;

    /**
     *
     * @var number
     */
    protected $clientId;

    /**
     *
     * @var number
     */
    protected $taskDateStart;

    /**
     *
     * @var number
     */
    protected $taskDateEnd;

    /**
     *
     * @var string
     */
    protected $taskStatus;

    /**
     *
     * @var string
     */
    protected $taskPriority;

    /**
     *
     * @var number
     */
    protected $taskDateReminder;

    /**
     *
     * @var string
     */
    protected $taskTitle;

    /**
     *
     * @var string
     */
    protected $taskDescription;

    /**
     *
     * @var EmployeeEntity
     */
    protected $employeeEntity;

    /**
     *
     * @var ClientEntity
     */
    protected $clientEntity;

    /**
     *
     * @var PriorityEntity
     */
    protected $priorityEntity;

    /**
     *
     * @return the $taskId
     */
    public function getTaskId()
    {
        return $this->taskId;
    }

    /**
     *
     * @return the $employeeId
     */
    public function getEmployeeId()
    {
        return $this->employeeId;
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
     * @return the $taskDateStart
     */
    public function getTaskDateStart()
    {
        return $this->taskDateStart;
    }

    /**
     *
     * @return the $taskDateEnd
     */
    public function getTaskDateEnd()
    {
        return $this->taskDateEnd;
    }

    /**
     *
     * @return the $taskStatus
     */
    public function getTaskStatus()
    {
        return $this->taskStatus;
    }

    /**
     *
     * @return the $taskPriority
     */
    public function getTaskPriority()
    {
        return $this->taskPriority;
    }

    /**
     *
     * @return the $taskDateReminder
     */
    public function getTaskDateReminder()
    {
        return $this->taskDateReminder;
    }

    /**
     *
     * @return the $taskTitle
     */
    public function getTaskTitle()
    {
        return $this->taskTitle;
    }

    /**
     *
     * @return the $taskDescription
     */
    public function getTaskDescription()
    {
        return $this->taskDescription;
    }

    /**
     *
     * @return the $employeeEntity
     */
    public function getEmployeeEntity()
    {
        return $this->employeeEntity;
    }

    /**
     *
     * @return the $clientEntity
     */
    public function getClientEntity()
    {
        return $this->clientEntity;
    }

    /**
     *
     * @return the $priorityEntity
     */
    public function getPriorityEntity()
    {
        return $this->priorityEntity;
    }

    /**
     *
     * @param number $taskId            
     */
    public function setTaskId($taskId)
    {
        $this->taskId = $taskId;
    }

    /**
     *
     * @param number $employeeId            
     */
    public function setEmployeeId($employeeId)
    {
        $this->employeeId = $employeeId;
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
     * @param number $taskDateStart            
     */
    public function setTaskDateStart($taskDateStart)
    {
        $this->taskDateStart = $taskDateStart;
    }

    /**
     *
     * @param number $taskDateEnd            
     */
    public function setTaskDateEnd($taskDateEnd)
    {
        $this->taskDateEnd = $taskDateEnd;
    }

    /**
     *
     * @param string $taskStatus            
     */
    public function setTaskStatus($taskStatus)
    {
        $this->taskStatus = $taskStatus;
    }

    /**
     *
     * @param string $taskPriority            
     */
    public function setTaskPriority($taskPriority)
    {
        $this->taskPriority = $taskPriority;
    }

    /**
     *
     * @param number $taskDateReminder            
     */
    public function setTaskDateReminder($taskDateReminder)
    {
        $this->taskDateReminder = $taskDateReminder;
    }

    /**
     *
     * @param string $taskTitle            
     */
    public function setTaskTitle($taskTitle)
    {
        $this->taskTitle = $taskTitle;
    }

    /**
     *
     * @param string $taskDescription            
     */
    public function setTaskDescription($taskDescription)
    {
        $this->taskDescription = $taskDescription;
    }

    /**
     *
     * @param \Employee\Entity\EmployeeEntity $employeeEntity            
     */
    public function setEmployeeEntity($employeeEntity)
    {
        $this->employeeEntity = $employeeEntity;
    }

    /**
     *
     * @param \Client\Entity\ClientEntity $clientEntity            
     */
    public function setClientEntity($clientEntity)
    {
        $this->clientEntity = $clientEntity;
    }

    /**
     *
     * @param \TaskPriority\Entity\PriorityEntity $priorityEntity            
     */
    public function setPriorityEntity($priorityEntity)
    {
        $this->priorityEntity = $priorityEntity;
    }
}