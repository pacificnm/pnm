<?php
namespace VendorBill\Mapper;

use VendorBill\Entity\BillEntity;

interface MysqlMapperInterface
{
    /**
     *
     * @param array $filter
     * @return BillEntity
     */
    public function getAll($filter);
    
    /**
     *
     * @param number $id
     * @return BillEntity
     */
    public function get($id);
    
    /**
     *
     * @return BillEntity
     */
    public function getDueBills();
    
    /**
     * 
     * @param number $start
     * @param number $end
     * @return float
     */
    public function getTotalForMonth($start, $end);
    
    /**
     *
     * @param BillEntity $entity
     * @return BillEntity
     */
    public function save(BillEntity $entity);
    
    /**
     *
     * @param BillEntity $entity
     * @return boolean
     */
    public function delete(BillEntity $entity);
}

