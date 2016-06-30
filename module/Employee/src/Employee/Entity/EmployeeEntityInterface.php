<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Employee\Entity;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *
 */
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