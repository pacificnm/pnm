<?php
namespace EmployeeEmail\Entity;

use Email\Entity\EmailEntity;

class EmployeeEmailEntity
{

    /**
     *
     * @var number
     */
    protected $employeeEmailId;

    /**
     *
     * @var number
     */
    protected $emailId;

    /**
     *
     * @var number
     */
    protected $employeeId;

    /**
     *
     * @var EmailEntity
     */
    protected $emailEntity;

    /**
     *
     * @return the $employeeEmailId
     */
    public function getEmployeeEmailId()
    {
        return $this->employeeEmailId;
    }

    /**
     *
     * @return the $emailId
     */
    public function getEmailId()
    {
        return $this->emailId;
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
     * @return the $emailEntity
     */
    public function getEmailEntity()
    {
        return $this->emailEntity;
    }

    /**
     *
     * @param number $employeeEmailId            
     */
    public function setEmployeeEmailId($employeeEmailId)
    {
        $this->employeeEmailId = $employeeEmailId;
    }

    /**
     *
     * @param number $emailId            
     */
    public function setEmailId($emailId)
    {
        $this->emailId = $emailId;
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
     * @param \Email\Entity\EmailEntity $emailEntity            
     */
    public function setEmailEntity($emailEntity)
    {
        $this->emailEntity = $emailEntity;
    }
}