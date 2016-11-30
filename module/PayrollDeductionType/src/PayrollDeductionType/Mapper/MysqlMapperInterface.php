<?php
namespace PayrollDeductionType\Mapper;

use PayrollDeductionType\Entity\PayrollDeductionTypeEntity;

interface MysqlMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return PayrollDeductionTypeEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return PayrollDeductionTypeEntity
     */
    public function get($id);

    /**
     *
     * @param PayrollDeductionTypeEntity $entity            
     * @return PayrollDeductionTypeEntity
     */
    public function save(PayrollDeductionTypeEntity $entity);

    /**
     *
     * @param PayrollDeductionTypeEntity $entity            
     * @return bool
     */
    public function delete(PayrollDeductionTypeEntity $entity);
}