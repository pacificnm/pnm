<?php
namespace WorkorderTime\Entity;

use Employee\Entity\EmployeeEntity;

class TimeEntity
{

    /**
     *
     * @var number
     */
    protected $workorderTimeId;

    /**
     *
     * @var number
     */
    protected $workorderId;

    /**
     *
     * @var number
     */
    protected $workorderTimeIn;

    /**
     *
     * @var number
     */
    protected $workorderTimeOut;

    /**
     *
     * @var number
     */
    protected $workorderTimeTotal;

    /**
     *
     * @var number
     */
    protected $laborId;

    /**
     *
     * @var string
     */
    protected $laborName;

    /**
     *
     * @var float
     */
    protected $laborRate;

    /**
     *
     * @var float
     */
    protected $laborTotal;

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
     * @return the $workorderTimeId
     */
    public function getWorkorderTimeId()
    {
        return $this->workorderTimeId;
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
     * @return the $workorderTimeIn
     */
    public function getWorkorderTimeIn()
    {
        return $this->workorderTimeIn;
    }

    /**
     *
     * @return the $workorderTimeOut
     */
    public function getWorkorderTimeOut()
    {
        return $this->workorderTimeOut;
    }

    /**
     *
     * @return the $workorderTimeTotal
     */
    public function getWorkorderTimeTotal()
    {
        return $this->workorderTimeTotal;
    }

    /**
     *
     * @return the $laborId
     */
    public function getLaborId()
    {
        return $this->laborId;
    }

    /**
     *
     * @return the $laborName
     */
    public function getLaborName()
    {
        return $this->laborName;
    }

    /**
     *
     * @return the $laborRate
     */
    public function getLaborRate()
    {
        return $this->laborRate;
    }

    /**
     *
     * @return the $laborTotal
     */
    public function getLaborTotal()
    {
        return $this->laborTotal;
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
     * @param number $workorderTimeId            
     */
    public function setWorkorderTimeId($workorderTimeId)
    {
        $this->workorderTimeId = $workorderTimeId;
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
     * @param number $workorderTimeIn            
     */
    public function setWorkorderTimeIn($workorderTimeIn)
    {
        $this->workorderTimeIn = $workorderTimeIn;
    }

    /**
     *
     * @param number $workorderTimeOut            
     */
    public function setWorkorderTimeOut($workorderTimeOut)
    {
        $this->workorderTimeOut = $workorderTimeOut;
    }

    /**
     *
     * @param number $workorderTimeTotal            
     */
    public function setWorkorderTimeTotal($workorderTimeTotal)
    {
        $this->workorderTimeTotal = $workorderTimeTotal;
    }

    /**
     *
     * @param number $laborId            
     */
    public function setLaborId($laborId)
    {
        $this->laborId = $laborId;
    }

    /**
     *
     * @param string $laborName            
     */
    public function setLaborName($laborName)
    {
        $this->laborName = $laborName;
    }

    /**
     *
     * @param number $laborRate            
     */
    public function setLaborRate($laborRate)
    {
        $this->laborRate = $laborRate;
    }

    /**
     *
     * @param number $laborTotal            
     */
    public function setLaborTotal($laborTotal)
    {
        $this->laborTotal = $laborTotal;
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