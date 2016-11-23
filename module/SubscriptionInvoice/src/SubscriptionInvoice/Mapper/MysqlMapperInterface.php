<?php
namespace SubscriptionInvoice\Mapper;

use SubscriptionInvoice\Entity\SubscriptionInvoiceEntity;

interface MysqlMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return SubscriptionInvoiceEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return SubscriptionInvoiceEntity
     */
    public function get($id);

    /**
     *
     * @param SubscriptionInvoiceEntity $entity            
     * @return SubscriptionInvoiceEntity
     */
    public function save(SubscriptionInvoiceEntity $entity);

    /**
     *
     * @param SubscriptionInvoiceEntity $entity            
     * @return bool
     */
    public function delete(SubscriptionInvoiceEntity $entity);
}