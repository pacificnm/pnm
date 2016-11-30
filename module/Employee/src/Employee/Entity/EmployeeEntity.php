<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace Employee\Entity;

use Auth\Entity\AuthEntity;

/**
 *
 * @author jaimie <pacificnm@gmail.com>
 * @version 2.5.0
 *         
 */
class EmployeeEntity
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
    protected $employeePhone;

    /**
     *
     * @var string
     */
    protected $employeePhoneMobile;

    /**
     *
     * @var string
     */
    protected $employeeStreet;

    /**
     *
     * @var string
     */
    protected $employeeStreetCont;

    /**
     *
     * @var string
     */
    protected $employeeCity;

    /**
     *
     * @var unknown
     */
    protected $employeeState;

    /**
     *
     * @var string
     */
    protected $employeePostal;

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
     * @var string
     */
    protected $employeeSsn;

    /**
     *
     * @var string
     */
    protected $employeBirthday;

    /**
     *
     * @var string
     */
    protected $employeeMaritalStatus;

    /**
     *
     * @var float
     */
    protected $employeeWage;

    /**
     *
     * @var number
     */
    protected $employeeTaxAllowance;

    /**
     *
     * @var AuthEntity
     */
    protected $authEntity;

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
     * @return the $employeeEmail
     */
    public function getEmployeeEmail()
    {
        return $this->employeeEmail;
    }

    /**
     *
     * @return the $employeePhone
     */
    public function getEmployeePhone()
    {
        return $this->employeePhone;
    }

    /**
     *
     * @return the $employeePhoneMobile
     */
    public function getEmployeePhoneMobile()
    {
        return $this->employeePhoneMobile;
    }

    /**
     *
     * @return the $employeeStreet
     */
    public function getEmployeeStreet()
    {
        return $this->employeeStreet;
    }

    /**
     *
     * @return the $employeeStreetCont
     */
    public function getEmployeeStreetCont()
    {
        return $this->employeeStreetCont;
    }

    /**
     *
     * @return the $employeeCity
     */
    public function getEmployeeCity()
    {
        return $this->employeeCity;
    }

    /**
     *
     * @return the $employeeState
     */
    public function getEmployeeState()
    {
        return $this->employeeState;
    }

    /**
     *
     * @return the $employeePostal
     */
    public function getEmployeePostal()
    {
        return $this->employeePostal;
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
     * @return the $employeeSsn
     */
    public function getEmployeeSsn()
    {
        return $this->employeeSsn;
    }

    /**
     *
     * @return the $employeBirthday
     */
    public function getEmployeBirthday()
    {
        return $this->employeBirthday;
    }

    /**
     *
     * @return the $employeeMaritalStatus
     */
    public function getEmployeeMaritalStatus()
    {
        return $this->employeeMaritalStatus;
    }

    /**
     *
     * @return the $employeeWage
     */
    public function getEmployeeWage()
    {
        return $this->employeeWage;
    }

    /**
     *
     * @return the $employeeTaxAllowance
     */
    public function getEmployeeTaxAllowance()
    {
        return $this->employeeTaxAllowance;
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
     * @param string $employeeEmail            
     */
    public function setEmployeeEmail($employeeEmail)
    {
        $this->employeeEmail = $employeeEmail;
    }

    /**
     *
     * @param string $employeePhone            
     */
    public function setEmployeePhone($employeePhone)
    {
        $this->employeePhone = $employeePhone;
    }

    /**
     *
     * @param string $employeePhoneMobile            
     */
    public function setEmployeePhoneMobile($employeePhoneMobile)
    {
        $this->employeePhoneMobile = $employeePhoneMobile;
    }

    /**
     *
     * @param string $employeeStreet            
     */
    public function setEmployeeStreet($employeeStreet)
    {
        $this->employeeStreet = $employeeStreet;
    }

    /**
     *
     * @param string $employeeStreetCont            
     */
    public function setEmployeeStreetCont($employeeStreetCont)
    {
        $this->employeeStreetCont = $employeeStreetCont;
    }

    /**
     *
     * @param string $employeeCity            
     */
    public function setEmployeeCity($employeeCity)
    {
        $this->employeeCity = $employeeCity;
    }

    /**
     *
     * @param \Employee\Entity\unknown $employeeState            
     */
    public function setEmployeeState($employeeState)
    {
        $this->employeeState = $employeeState;
    }

    /**
     *
     * @param string $employeePostal            
     */
    public function setEmployeePostal($employeePostal)
    {
        $this->employeePostal = $employeePostal;
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
     * @param string $employeeSsn            
     */
    public function setEmployeeSsn($employeeSsn)
    {
        $this->employeeSsn = $employeeSsn;
    }

    /**
     *
     * @param string $employeBirthday            
     */
    public function setEmployeBirthday($employeBirthday)
    {
        $this->employeBirthday = $employeBirthday;
    }

    /**
     *
     * @param string $employeeMaritalStatus            
     */
    public function setEmployeeMaritalStatus($employeeMaritalStatus)
    {
        $this->employeeMaritalStatus = $employeeMaritalStatus;
    }

    /**
     *
     * @param number $employeeWage            
     */
    public function setEmployeeWage($employeeWage)
    {
        $this->employeeWage = $employeeWage;
    }

    /**
     *
     * @param number $employeeTaxAllowance            
     */
    public function setEmployeeTaxAllowance($employeeTaxAllowance)
    {
        $this->employeeTaxAllowance = $employeeTaxAllowance;
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
