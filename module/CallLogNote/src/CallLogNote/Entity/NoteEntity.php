<?php
namespace CallLogNote\Entity;

use Employee\Entity\EmployeeEntity;

class NoteEntity
{

    /**
     *
     * @var number
     */
    protected $callLogNoteId;

    /**
     *
     * @var number
     */
    protected $callLogId;

    /**
     *
     * @var text
     */
    protected $callLogNoteText;

    /**
     *
     * @var number
     */
    protected $callLogNoteCreateBy;

    /**
     *
     * @var number
     */
    protected $callLogCreated;

    /**
     *
     * @var EmployeeEntity
     */
    protected $employeeEntity;

    /**
     *
     * @return the $callLogNoteId
     */
    public function getCallLogNoteId()
    {
        return $this->callLogNoteId;
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
     * @return the $callLogNoteText
     */
    public function getCallLogNoteText()
    {
        return $this->callLogNoteText;
    }

    /**
     *
     * @return the $callLogNoteCreateBy
     */
    public function getCallLogNoteCreateBy()
    {
        return $this->callLogNoteCreateBy;
    }

    /**
     *
     * @return the $callLogCreated
     */
    public function getCallLogCreated()
    {
        return $this->callLogCreated;
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
     * @param number $callLogNoteId            
     */
    public function setCallLogNoteId($callLogNoteId)
    {
        $this->callLogNoteId = $callLogNoteId;
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
     * @param \CallLogNote\Entity\text $callLogNoteText            
     */
    public function setCallLogNoteText($callLogNoteText)
    {
        $this->callLogNoteText = $callLogNoteText;
    }

    /**
     *
     * @param number $callLogNoteCreateBy            
     */
    public function setCallLogNoteCreateBy($callLogNoteCreateBy)
    {
        $this->callLogNoteCreateBy = $callLogNoteCreateBy;
    }

    /**
     *
     * @param number $callLogCreated            
     */
    public function setCallLogCreated($callLogCreated)
    {
        $this->callLogCreated = $callLogCreated;
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
