<?php
namespace SubscriptionInvoice\Service;

use SubscriptionInvoice\Entity\SubscriptionInvoiceEntity;

interface SubscriptionInvoiceServiceInterface
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
     * @param number $subscriptionId
     * @return SubscriptionInvoiceEntity
     */
    public function getBySubcription($subscriptionId);
    
    /**
     *
     * @param number $invoiceId
     * @return SubscriptionInvoiceEntity
     */
    public function getByInvoice($invoiceId);
    
    
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