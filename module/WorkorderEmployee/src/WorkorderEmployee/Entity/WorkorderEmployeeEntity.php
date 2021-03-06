<?php
namespace WorkorderEmployee\Entity;

use Employee\Entity\EmployeeEntity;
use Workorder\Entity\WorkorderEntity;

class WorkorderEmployeeEntity
{

    /**
     *
     * @var number
     */
    protected $workorderEmployeeId;

    /**
     *
     * @var number
     */
    protected $workorderId;

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
     * @var WorkorderEntity
     */
    protected $workorderEntity;

    /**
     *
     * @return the $workorderEmployeeId
     */
    public function getWorkorderEmployeeId()
    {
        return $this->workorderEmployeeId;
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
     * @return the $workorderEntity
     */
    public function getWorkorderEntity()
    {
        return $this->workorderEntity;
    }

    /**
     *
     * @param number $workorderEmployeeId            
     */
    public function setWorkorderEmployeeId($workorderEmployeeId)
    {
        $this->workorderEmployeeId = $workorderEmployeeId;
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

    /**
     *
     * @param \Workorder\Entity\WorkorderEntity $workorderEntity            
     */
    public function setWorkorderEntity($workorderEntity)
    {
        $this->workorderEntity = $workorderEntity;
    }
}
