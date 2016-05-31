<?php
namespace Employee\Entity;

interface EmployeeEntityInterface
{
    /**
     * @return the $employeeEmail
     */
    public function getEmployeeEmail();
    
    /**
     * @param string $employeeEmail
     */
    public function setEmployeeEmail($employeeEmail);
    
    /**
     *
     * @return the $employeeId
     */
    public function getEmployeeId();

    /**
     *
     * @return the $employeeName
     */
    public function getEmployeeName();

    /**
     *
     * @return the $employeeTitle
     */
    public function getEmployeeTitle();

    /**
     *
     * @return the $employeeIm
     */
    public function getEmployeeIm();

    /**
     *
     * @return the $employeeImage
     */
    public function getEmployeeImage();

    /**
     *
     * @return the $employeeStatus
     */
    public function getEmployeeStatus();

    /**
     *
     * @return the $authEntity
     */
    public function getAuthEntity();

    /**
     *
     * @param number $employeeId            
     */
    public function setEmployeeId($employeeId);

    /**
     *
     * @param string $employeeName            
     */
    public function setEmployeeName($employeeName);

    /**
     *
     * @param string $employeeTitle            
     */
    public function setEmployeeTitle($employeeTitle);

    /**
     *
     * @param string $employeeIm            
     */
    public function setEmployeeIm($employeeIm);

    /**
     *
     * @param string $employeeImage            
     */
    public function setEmployeeImage($employeeImage);

    /**
     *
     * @param string $employeeStatus            
     */
    public function setEmployeeStatus($employeeStatus);

    /**
     *
     * @param \Auth\Entity\AuthEntity $authEntity            
     */
    public function setAuthEntity($authEntity);
}