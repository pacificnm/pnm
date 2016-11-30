<?php
namespace PayrollDeductionType\Entity;

class PayrollDeductionTypeEntity
{

    /**
     *
     * @var number
     */
    protected $payrollDeductionTypeId;

    /**
     *
     * @var string
     */
    protected $payrollDeductionTypeName;

    /**
     *
     * @return the $payrollDeductionTypeId
     */
    public function getPayrollDeductionTypeId()
    {
        return $this->payrollDeductionTypeId;
    }

    /**
     *
     * @return the $payrollDeductionTypeName
     */
    public function getPayrollDeductionTypeName()
    {
        return $this->payrollDeductionTypeName;
    }

    /**
     *
     * @param number $payrollDeductionTypeId            
     */
    public function setPayrollDeductionTypeId($payrollDeductionTypeId)
    {
        $this->payrollDeductionTypeId = $payrollDeductionTypeId;
    }

    /**
     *
     * @param string $payrollDeductionTypeName            
     */
    public function setPayrollDeductionTypeName($payrollDeductionTypeName)
    {
        $this->payrollDeductionTypeName = $payrollDeductionTypeName;
    }
}