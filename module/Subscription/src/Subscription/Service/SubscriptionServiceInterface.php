<?php
namespace Subscription\Service;

use Subscription\Entity\SubscriptionEntity;

interface SubscriptionServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return SubscriptionEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return SubscriptionEntity
     */
    public function get($id);

    /**
     * Gets a clients active subscription
     *
     * @param unknown $clientId            
     * @return SubscriptionEntity
     */
    public function getActive($clientId);
    
    /**
     * Gets all due subscriptions un-paginated
     *
     * @param number $subscriptionDateDue
     * @return SubscriptionEntity
     */
    public function getDue($subscriptionDateDue);
    
    /**
     *
     * @param SubscriptionEntity $entity            
     * @return SubscriptionEntity
     */
    public function save(SubscriptionEntity $entity);

    /**
     *
     * @param SubscriptionEntity $entity            
     * @return bool
     */
    public function delete(SubscriptionEntity $entity);
}