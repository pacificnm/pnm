<?php
namespace PayrollDeduction\Entity;

use PayrollDeductionType\Entity\PayrollDeductionTypeEntity;

class PayrollDeductionEntity
{

    /**
     *
     * @var number
     */
    protected $payrollDeductionId;

    /**
     *
     * @var number
     */
    protected $payrollId;

    /**
     *
     * @var number
     */
    protected $payrollDeductionTypeId;

    /**
     *
     * @var float
     */
    protected $payrollDeductionAmount;

    /**
     *
     * @var number
     */
    protected $payrollDeductionYear;

    /**
     * 
     * @var float
     */
    protected $payrollDeductionYtd;
    
    
    /**
     *
     * @var PayrollDeductionTypeEntity
     */
    protected $payrollDeductionTypeEntity;
    
    /**
     * @return the $payrollDeductionId
     */
    public function getPayrollDeductionId()
    {
        return $this->payrollDeductionId;
    }

    /**
     * @return the $payrollId
     */
    public function getPayrollId()
    {
        return $this->payrollId;
    }

    /**
     * @return the $payrollDeductionTypeId
     */
    public function getPayrollDeductionTypeId()
    {
        return $this->payrollDeductionTypeId;
    }

    /**
     * @return the $payrollDeductionAmount
     */
    public function getPayrollDeductionAmount()
    {
        return $this->payrollDeductionAmount;
    }

    /**
     * @return the $payrollDeductionYear
     */
    public function getPayrollDeductionYear()
    {
        return $this->payrollDeductionYear;
    }

    /**
     * @return the $payrollDeductionYtd
     */
    public function getPayrollDeductionYtd()
    {
        return $this->payrollDeductionYtd;
    }

    /**
     * @return the $payrollDeductionTypeEntity
     */
    public function getPayrollDeductionTypeEntity()
    {
        return $this->payrollDeductionTypeEntity;
    }

    /**
     * @param number $payrollDeductionId
     */
    public function setPayrollDeductionId($payrollDeductionId)
    {
        $this->payrollDeductionId = $payrollDeductionId;
    }

    /**
     * @param number $payrollId
     */
    public function setPayrollId($payrollId)
    {
        $this->payrollId = $payrollId;
    }

    /**
     * @param number $payrollDeductionTypeId
     */
    public function setPayrollDeductionTypeId($payrollDeductionTypeId)
    {
        $this->payrollDeductionTypeId = $payrollDeductionTypeId;
    }

    /**
     * @param number $payrollDeductionAmount
     */
    public function setPayrollDeductionAmount($payrollDeductionAmount)
    {
        $this->payrollDeductionAmount = $payrollDeductionAmount;
    }

    /**
     * @param number $payrollDeductionYear
     */
    public function setPayrollDeductionYear($payrollDeductionYear)
    {
        $this->payrollDeductionYear = $payrollDeductionYear;
    }

    /**
     * @param number $payrollDeductionYtd
     */
    public function setPayrollDeductionYtd($payrollDeductionYtd)
    {
        $this->payrollDeductionYtd = $payrollDeductionYtd;
    }

    /**
     * @param \PayrollDeductionType\Entity\PayrollDeductionTypeEntity $payrollDeductionTypeEntity
     */
    public function setPayrollDeductionTypeEntity($payrollDeductionTypeEntity)
    {
        $this->payrollDeductionTypeEntity = $payrollDeductionTypeEntity;
    }


    
}

