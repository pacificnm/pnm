<?php
namespace WorkorderNote\Entity;

use Employee\Entity\EmployeeEntity;

class NoteEntity
{

    /**
     *
     * @var number
     */
    protected $workorderNotesId;

    /**
     *
     * @var number
     */
    protected $workorderId;

    /**
     *
     * @var number
     */
    protected $workorderNotesDate;

    /**
     *
     * @var string
     */
    protected $workorderNotesNote;

    /**
     *
     * @var number
     */
    protected $employeeId;

    /**
     *
     * @var EmployeeEntity
     */
    protected $employeeEntity;

    /**
     *
     * @return the $workorderNotesId
     */
    public function getWorkorderNotesId()
    {
        return $this->workorderNotesId;
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
     * @return the $workorderNotesDate
     */
    public function getWorkorderNotesDate()
    {
        return $this->workorderNotesDate;
    }

    /**
     *
     * @return the $workorderNotesNote
     */
    public function getWorkorderNotesNote()
    {
        return $this->workorderNotesNote;
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
     * @return the $employeeEntity
     */
    public function getEmployeeEntity()
    {
        return $this->employeeEntity;
    }

    /**
     *
     * @param number $workorderNotesId            
     */
    public function setWorkorderNotesId($workorderNotesId)
    {
        $this->workorderNotesId = $workorderNotesId;
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
     * @param number $workorderNotesDate            
     */
    public function setWorkorderNotesDate($workorderNotesDate)
    {
        $this->workorderNotesDate = $workorderNotesDate;
    }

    /**
     *
     * @param string $workorderNotesNote            
     */
    public function setWorkorderNotesNote($workorderNotesNote)
    {
        $this->workorderNotesNote = $workorderNotesNote;
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
     * @param \Employee\Entity\EmployeeEntity $employeeEntity            
     */
    public function setEmployeeEntity($employeeEntity)
    {
        $this->employeeEntity = $employeeEntity;
    }
}