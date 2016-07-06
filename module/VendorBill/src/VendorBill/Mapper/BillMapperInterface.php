<?php
namespace VendorBill\Mapper;

use VendorBill\Entity\BillEntity;

interface BillMapperInterface
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