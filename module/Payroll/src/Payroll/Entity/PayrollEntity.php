<?php
namespace Payroll\Entity;

use Employee\Entity\EmployeeEntity;

class PayrollEntity
{

    /**
     *
     * @var number
     */
    protected $payrollId;

    /**
     *
     * @var number
     */
    protected $employeeId;

    /**
     *
     * @var number
     */
    protected $payrollCheck;

    /**
     *
     * @var number
     */
    protected $payrollDateCreate;

    /**
     *
     * @var number
     */
    protected $payrollDateStart;

    /**
     *
     * @var number
     */
    protected $payrollDateEnd;

    /**
     *
     * @var float
     */
    protected $payrollHours;

    /**
     *
     * @var float
     */
    protected $payrollHoursOt;

    /**
     *
     * @var float
     */
    protected $payrollHoursVacation;

    /**
     *
     * @var float
     */
    protected $payrollHoursSick;

    /**
     *
     * @var float
     */
    protected $payrollRate;

    /**
     *
     * @var float
     */
    protected $payrollRateOt;

    /**
     *
     * @var float
     */
    protected $payrollWages;

    /**
     *
     * @var float
     */
    protected $payrollWagesOt;

    /**
     *
     * @var float
     */
    protected $payrollWagesVacation;

    /**
     *
     * @var float
     */
    protected $payrollWagesSick;

    /**
     *
     * @var float
     */
    protected $payrollWagesGross;

    /**
     *
     * @var float
     */
    protected $payrollWagesNet;

    /**
     *
     * @var float
     */
    protected $payrollWagesState;

    /**
     *
     * @var float
     */
    protected $payrollWagesSocialSecurity;

    /**
     *
     * @var float
     */
    protected $payrollWagesMedicare;

    /**
     *
     * @var float
     */
    protected $payrollTaxFederalIncome;

    /**
     *
     * @var float
     */
    protected $payrollTaxSocialSecurity;

    /**
     *
     * @var float
     */
    protected $payrollTaxState;

    /**
     *
     * @var float
     */
    protected $payrollTaxMedicare;

    /**
     *
     * @var EmployeeEntity
     */
    protected $employeeEntity;

    /**
     *
     * @return the $payrollId
     */
    public function getPayrollId()
    {
        return $this->payrollId;
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
     * @return the $payrollCheck
     */
    public function getPayrollCheck()
    {
        return $this->payrollCheck;
    }

    /**
     *
     * @return the $payrollDateCreate
     */
    public function getPayrollDateCreate()
    {
        return $this->payrollDateCreate;
    }

    /**
     *
     * @return the $payrollDateStart
     */
    public function getPayrollDateStart()
    {
        return $this->payrollDateStart;
    }

    /**
     *
     * @return the $payrollDateEnd
     */
    public function getPayrollDateEnd()
    {
        return $this->payrollDateEnd;
    }

    /**
     *
     * @return the $payrollHours
     */
    public function getPayrollHours()
    {
        return $this->payrollHours;
    }

    /**
     *
     * @return the $payrollHoursOt
     */
    public function getPayrollHoursOt()
    {
        return $this->payrollHoursOt;
    }

    /**
     *
     * @return the $payrollHoursVacation
     */
    public function getPayrollHoursVacation()
    {
        return $this->payrollHoursVacation;
    }

    /**
     *
     * @return the $payrollHoursSick
     */
    public function getPayrollHoursSick()
    {
        return $this->payrollHoursSick;
    }

    /**
     *
     * @return the $payrollRate
     */
    public function getPayrollRate()
    {
        return $this->payrollRate;
    }

    /**
     *
     * @return the $payrollRateOt
     */
    public function getPayrollRateOt()
    {
        return $this->payrollRateOt;
    }

    /**
     *
     * @return the $payrollWages
     */
    public function getPayrollWages()
    {
        return $this->payrollWages;
    }

    /**
     *
     * @return the $payrollWagesOt
     */
    public function getPayrollWagesOt()
    {
        return $this->payrollWagesOt;
    }

    /**
     *
     * @return the $payrollWagesVacation
     */
    public function getPayrollWagesVacation()
    {
        return $this->payrollWagesVacation;
    }

    /**
     *
     * @return the $payrollWagesSick
     */
    public function getPayrollWagesSick()
    {
        return $this->payrollWagesSick;
    }

    /**
     *
     * @return the $payrollWagesGross
     */
    public function getPayrollWagesGross()
    {
        return $this->payrollWagesGross;
    }

    /**
     *
     * @return the $payrollWagesNet
     */
    public function getPayrollWagesNet()
    {
        return $this->payrollWagesNet;
    }

    /**
     *
     * @return the $payrollWagesState
     */
    public function getPayrollWagesState()
    {
        return $this->payrollWagesState;
    }

    /**
     *
     * @return the $payrollWagesSocialSecurity
     */
    public function getPayrollWagesSocialSecurity()
    {
        return $this->payrollWagesSocialSecurity;
    }

    /**
     *
     * @return the $payrollWagesMedicare
     */
    public function getPayrollWagesMedicare()
    {
        return $this->payrollWagesMedicare;
    }

    /**
     *
     * @return the $payrollTaxFederalIncome
     */
    public function getPayrollTaxFederalIncome()
    {
        return $this->payrollTaxFederalIncome;
    }

    /**
     *
     * @return the $payrollTaxSocialSecurity
     */
    public function getPayrollTaxSocialSecurity()
    {
        return $this->payrollTaxSocialSecurity;
    }

    /**
     *
     * @return the $payrollTaxState
     */
    public function getPayrollTaxState()
    {
        return $this->payrollTaxState;
    }

    /**
     *
     * @return the $payrollTaxMedicare
     */
    public function getPayrollTaxMedicare()
    {
        return $this->payrollTaxMedicare;
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
     * @param number $payrollId            
     */
    public function setPayrollId($payrollId)
    {
        $this->payrollId = $payrollId;
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
     * @param number $payrollCheck            
     */
    public function setPayrollCheck($payrollCheck)
    {
        $this->payrollCheck = $payrollCheck;
    }

    /**
     *
     * @param number $payrollDateCreate            
     */
    public function setPayrollDateCreate($payrollDateCreate)
    {
        $this->payrollDateCreate = $payrollDateCreate;
    }

    /**
     *
     * @param number $payrollDateStart            
     */
    public function setPayrollDateStart($payrollDateStart)
    {
        $this->payrollDateStart = $payrollDateStart;
    }

    /**
     *
     * @param number $payrollDateEnd            
     */
    public function setPayrollDateEnd($payrollDateEnd)
    {
        $this->payrollDateEnd = $payrollDateEnd;
    }

    /**
     *
     * @param number $payrollHours            
     */
    public function setPayrollHours($payrollHours)
    {
        $this->payrollHours = $payrollHours;
    }

    /**
     *
     * @param number $payrollHoursOt            
     */
    public function setPayrollHoursOt($payrollHoursOt)
    {
        $this->payrollHoursOt = $payrollHoursOt;
    }

    /**
     *
     * @param number $payrollHoursVacation            
     */
    public function setPayrollHoursVacation($payrollHoursVacation)
    {
        $this->payrollHoursVacation = $payrollHoursVacation;
    }

    /**
     *
     * @param number $payrollHoursSick            
     */
    public function setPayrollHoursSick($payrollHoursSick)
    {
        $this->payrollHoursSick = $payrollHoursSick;
    }

    /**
     *
     * @param number $payrollRate            
     */
    public function setPayrollRate($payrollRate)
    {
        $this->payrollRate = $payrollRate;
    }

    /**
     *
     * @param number $payrollRateOt            
     */
    public function setPayrollRateOt($payrollRateOt)
    {
        $this->payrollRateOt = $payrollRateOt;
    }

    /**
     *
     * @param number $payrollWages            
     */
    public function setPayrollWages($payrollWages)
    {
        $this->payrollWages = $payrollWages;
    }

    /**
     *
     * @param number $payrollWagesOt            
     */
    public function setPayrollWagesOt($payrollWagesOt)
    {
        $this->payrollWagesOt = $payrollWagesOt;
    }

    /**
     *
     * @param number $payrollWagesVacation            
     */
    public function setPayrollWagesVacation($payrollWagesVacation)
    {
        $this->payrollWagesVacation = $payrollWagesVacation;
    }

    /**
     *
     * @param number $payrollWagesSick            
     */
    public function setPayrollWagesSick($payrollWagesSick)
    {
        $this->payrollWagesSick = $payrollWagesSick;
    }

    /**
     *
     * @param number $payrollWagesGross            
     */
    public function setPayrollWagesGross($payrollWagesGross)
    {
        $this->payrollWagesGross = $payrollWagesGross;
    }

    /**
     *
     * @param number $payrollWagesNet            
     */
    public function setPayrollWagesNet($payrollWagesNet)
    {
        $this->payrollWagesNet = $payrollWagesNet;
    }

    /**
     *
     * @param number $payrollWagesState            
     */
    public function setPayrollWagesState($payrollWagesState)
    {
        $this->payrollWagesState = $payrollWagesState;
    }

    /**
     *
     * @param number $payrollWagesSocialSecurity            
     */
    public function setPayrollWagesSocialSecurity($payrollWagesSocialSecurity)
    {
        $this->payrollWagesSocialSecurity = $payrollWagesSocialSecurity;
    }

    /**
     *
     * @param number $payrollWagesMedicare            
     */
    public function setPayrollWagesMedicare($payrollWagesMedicare)
    {
        $this->payrollWagesMedicare = $payrollWagesMedicare;
    }

    /**
     *
     * @param number $payrollTaxFederalIncome            
     */
    public function setPayrollTaxFederalIncome($payrollTaxFederalIncome)
    {
        $this->payrollTaxFederalIncome = $payrollTaxFederalIncome;
    }

    /**
     *
     * @param number $payrollTaxSocialSecurity            
     */
    public function setPayrollTaxSocialSecurity($payrollTaxSocialSecurity)
    {
        $this->payrollTaxSocialSecurity = $payrollTaxSocialSecurity;
    }

    /**
     *
     * @param number $payrollTaxState            
     */
    public function setPayrollTaxState($payrollTaxState)
    {
        $this->payrollTaxState = $payrollTaxState;
    }

    /**
     *
     * @param number $payrollTaxMedicare            
     */
    public function setPayrollTaxMedicare($payrollTaxMedicare)
    {
        $this->payrollTaxMedicare = $payrollTaxMedicare;
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