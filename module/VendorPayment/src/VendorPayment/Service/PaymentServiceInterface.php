<?php
namespace VendorPayment\Service;

use VendorPayment\Entity\PaymentEntity;

interface PaymentServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return PaymentEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return PaymentEntity
     */
    public function get($id);

    /**
     *
     * @param PaymentEntity $entity            
     * @return PaymentEntity
     */
    public function save(PaymentEntity $entity);

    /**
     *
     * @param PaymentEntity $entity            
     * @return boolean
     */
    public function delete(PaymentEntity $entity);
    
    /**
     * 
     * @param number $vendorBillId
     * @return PaymentEntity
     */
    public function getVendorBillPayments($vendorBillId);
}