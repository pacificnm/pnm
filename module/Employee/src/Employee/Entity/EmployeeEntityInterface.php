<?php
namespace Employee\Entity;

interface EmployeeEntityInterface
{
    /**
     * @return the $employeeId
     */
    public function getEmployeeId();
    
    /**
     * @return the $employeeTitle
     */
    public function getEmployeeTitle();
    
    /**
     * @return the $employeeIm
     */
    public function getEmployeeIm();
    
    /**
     * @return the $employeeImage
     */
    public function getEmployeeImage();
    
    /**
     * @return the $employeeStatus
     */
    public function getEmployeeStatus();
    
    /**
     * @param number $employeeId
     */
    public function setEmployeeId($employeeId);
    
    /**
     * @param string $employeeTitle
     */
    public function setEmployeeTitle($employeeTitle);
    
    /**
     * @param string $employeeIm
     */
    public function setEmployeeIm($employeeIm);
    
    /**
     * @param string $employeeImage
     */
    public function setEmployeeImage($employeeImage);
    
    /**
     * @param string $employeeStatus
     */
    public function setEmployeeStatus($employeeStatus);
}