<?php
namespace TaskNote\Entity;

use Employee\Entity\EmployeeEntity;

class NoteEntity
{

    /**
     *
     * @var number
     */
    protected $taskNoteId;

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
    protected $taskNoteDate;

    /**
     *
     * @var string
     */
    protected $taskNoteText;

    /**
     *
     * @var EmployeeEntity
     */
    protected $employeeEntity;

    /**
     *
     * @return the $taskNoteId
     */
    public function getTaskNoteId()
    {
        return $this->taskNoteId;
    }

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
     * @return the $taskNoteDate
     */
    public function getTaskNoteDate()
    {
        return $this->taskNoteDate;
    }

    /**
     *
     * @return the $taskNoteText
     */
    public function getTaskNoteText()
    {
        return $this->taskNoteText;
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
     * @param number $taskNoteId            
     */
    public function setTaskNoteId($taskNoteId)
    {
        $this->taskNoteId = $taskNoteId;
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
     * @param number $taskNoteDate            
     */
    public function setTaskNoteDate($taskNoteDate)
    {
        $this->taskNoteDate = $taskNoteDate;
    }

    /**
     *
     * @param string $taskNoteText            
     */
    public function setTaskNoteText($taskNoteText)
    {
        $this->taskNoteText = $taskNoteText;
    }

    /**
     *
     * @param \Employee\Entity\EmployeeEntity $employeeEntity            
     */
    public function setEmployeeEntity($employeeEntity)
    {
        $this->employeeEntity = $employeeEntity;
    }
}
