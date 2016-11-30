<?php
namespace PayrollDeduction\Mapper;

use PayrollDeduction\Entity\PayrollDeductionEntity;

interface MysqlMapperInterface
{

    /**
     *
     * @param unknown $filter            
     * @return PayrollDeductionEntity
     */
    public function getAll($filter);

    /**
     *
     * @param unknown $id            
     * @return PayrollDeductionEntity
     */
    public function get($id);

    /**
     *
     * @param number $payrollId            
     * @return PayrollDeductionEntity
     */
    public function getPayrollDeductions($payrollId);

    /**
     *
     * @param PayrollDeductionEntity $entity            
     * @return PayrollDeductionEntity
     */
    public function save(PayrollDeductionEntity $entity);

    /**
     *
     * @param PayrollDeductionEntity $entity
     *            return bool
     */
    public function delete(PayrollDeductionEntity $entity);
}

