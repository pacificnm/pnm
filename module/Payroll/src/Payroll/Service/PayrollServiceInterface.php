<?php
namespace Payroll\Service;

use Payroll\Entity\PayrollEntity;

interface PayrollServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return PayrollEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return PayrollEntity
     */
    public function get($id);

    /**
     *
     * @param number $employeeId
     * @param number $year
     * @return float
     */
    public function getYtdFederalIncomeTax($employeeId, $year);
    
    /**
     *
     * @param number $employeeId
     * @param number $year
     * @return float
     */
    public function getYtdSocialSecurityTax($employeeId, $year);
    
    /**
     *
     * @param number $employeeId
     * @param number $year
     * @return float
     */
    public function getYtdMedicareTax($employeeId, $year);
    
    /**
     *
     * @param number $employeeId
     * @param number $year
     * @return float
     */
    public function getYtdStateTax($employeeId, $year);
    
    /**
     *
     * @param number $employeeId
     * @param number $year
     * @return float
     */
    public function getYtdGross($employeeId, $year);
    
    /**
     *
     * @param number $employeeId
     * @param number $year
     * @return float
     */
    public function getYtdNet($employeeId, $year);
    
    /**
     *
     * @param PayrollEntity $entity            
     * @return PayrollEntity
     */
    public function save(PayrollEntity $entity);

    /**
     *
     * @param PayrollEntity $entity            
     * @return bool
     */
    public function delete(PayrollEntity $entity);
}