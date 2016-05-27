<?php
namespace Employee\Entity;

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
    protected $employeeTitle;

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
     * @return the $employeeId
     */
    public function getEmployeeId()
    {
        return $this->employeeId;
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
     * @param number $employeeId            
     */
    public function setEmployeeId($employeeId)
    {
        $this->employeeId = $employeeId;
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
}
