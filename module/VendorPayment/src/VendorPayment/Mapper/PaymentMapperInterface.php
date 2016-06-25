<?php
namespace VendorPayment\Mapper;

use VendorPayment\Entity\PaymentEntity;

interface PaymentMapperInterface
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
}
