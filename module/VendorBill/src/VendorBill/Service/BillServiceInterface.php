<?php
namespace VendorBill\Service;

use VendorBill\Entity\BillEntity;

interface BillServiceInterface
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
    
    /**
     *  @return BillEntity
     */
    public function getUnpaidBills();
    
}