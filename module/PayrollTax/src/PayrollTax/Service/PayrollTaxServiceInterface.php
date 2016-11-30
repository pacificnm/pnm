<?php
namespace PayrollTax\Service;

use PayrollTax\Entity\PayrollTaxEntity;

interface PayrollTaxServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return PayrollTaxEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return PayrollTaxEntity
     */
    public function get($id);

    /**
     *
     * @param PayrollTaxEntity $entity            
     * @return PayrollTaxEntity
     */
    public function save(PayrollTaxEntity $entity);

    /**
     *
     * @param PayrollTaxEntity $entity            
     * @return bool
     */
    public function delete(PayrollTaxEntity $entity);
}

