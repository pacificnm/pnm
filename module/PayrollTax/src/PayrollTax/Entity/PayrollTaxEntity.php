<?php
namespace PayrollTax\Entity;

class PayrollTaxEntity
{

    /**
     *
     * @var number
     */
    protected $payrollTaxId;

    /**
     *
     * @var float
     */
    protected $payrollTaxFederal;

    /**
     *
     * @var float
     */
    protected $payrollTaxSocialSecurity;

    /**
     *
     * @var float
     */
    protected $payrollTaxMedicare;

    /**
     *
     * @var float
     */
    protected $payrollTaxState;

    /**
     *
     * @return the $payrollTaxId
     */
    public function getPayrollTaxId()
    {
        return $this->payrollTaxId;
    }

    /**
     *
     * @return the $payrollTaxFederal
     */
    public function getPayrollTaxFederal()
    {
        return $this->payrollTaxFederal;
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
     * @return the $payrollTaxMedicare
     */
    public function getPayrollTaxMedicare()
    {
        return $this->payrollTaxMedicare;
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
     * @param number $payrollTaxId            
     */
    public function setPayrollTaxId($payrollTaxId)
    {
        $this->payrollTaxId = $payrollTaxId;
    }

    /**
     *
     * @param number $payrollTaxFederal            
     */
    public function setPayrollTaxFederal($payrollTaxFederal)
    {
        $this->payrollTaxFederal = $payrollTaxFederal;
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
     * @param number $payrollTaxMedicare            
     */
    public function setPayrollTaxMedicare($payrollTaxMedicare)
    {
        $this->payrollTaxMedicare = $payrollTaxMedicare;
    }

    /**
     *
     * @param number $payrollTaxState            
     */
    public function setPayrollTaxState($payrollTaxState)
    {
        $this->payrollTaxState = $payrollTaxState;
    }
}

