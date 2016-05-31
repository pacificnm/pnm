<?php
namespace Employee\Entity;

use Auth\Entity\AuthEntity;

class EmployeeEntity implements EmployeeEntityInterface
{

    /**
     *
     * @var number
     */
    protected $employeeId;

    /**
     *
     * @var string
     */
    protected $employeeName;

    /**
     *
     * @var string
     */
    protected $employeeTitle;

    /**
     * 
     * @var string
     */
    protected $employeeEmail;
    
    /**
     *
     * @var string
     */
    protected $employeeIm;

    /**
     *
     * @var string
     */
    protected $employeeImage;

    /**
     *
     * @var string
     */
    protected $employeeStatus;

    /**
     *
     * @var AuthEntity
     */
    protected $authEntity;

    /**
     * @return the $employeeEmail
     */
    public function getEmployeeEmail()
    {
        return $this->employeeEmail;
    }

    /**
     * @param string $employeeEmail
     */
    public function setEmployeeEmail($employeeEmail)
    {
        $this->employeeEmail = $employeeEmail;
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
     * @return the $employeeName
     */
    public function getEmployeeName()
    {
        return $this->employeeName;
    }

    /**
     *
     * @return the $employeeTitle
     */
    public function getEmployeeTitle()
    {
        return $this->employeeTitle;
    }

    /**
     *
     * @return the $employeeIm
     */
    public function getEmployeeIm()
    {
        return $this->employeeIm;
    }

    /**
     *
     * @return the $employeeImage
     */
    public function getEmployeeImage()
    {
        return $this->employeeImage;
    }

    /**
     *
     * @return the $employeeStatus
     */
    public function getEmployeeStatus()
    {
        return $this->employeeStatus;
    }

    /**
     *
     * @return the $authEntity
     */
    public function getAuthEntity()
    {
        return $this->authEntity;
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
     * @param string $employeeName            
     */
    public function setEmployeeName($employeeName)
    {
        $this->employeeName = $employeeName;
    }

    /**
     *
     * @param string $employeeTitle            
     */
    public function setEmployeeTitle($employeeTitle)
    {
        $this->employeeTitle = $employeeTitle;
    }

    /**
     *
     * @param string $employeeIm            
     */
    public function setEmployeeIm($employeeIm)
    {
        $this->employeeIm = $employeeIm;
    }

    /**
     *
     * @param string $employeeImage            
     */
    public function setEmployeeImage($employeeImage)
    {
        $this->employeeImage = $employeeImage;
    }

    /**
     *
     * @param string $employeeStatus            
     */
    public function setEmployeeStatus($employeeStatus)
    {
        $this->employeeStatus = $employeeStatus;
    }

    /**
     *
     * @param \Auth\Entity\AuthEntity $authEntity            
     */
    public function setAuthEntity($authEntity)
    {
        $this->authEntity = $authEntity;
    }
}
