<?php
namespace SubscriptionHost\Mapper;

use SubscriptionHost\Entity\SubscriptionHostEntity;

interface MysqlMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return SubscriptionHostEntity
     *
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return SubscriptionHostEntity
     */
    public function get($id);

    /**
     *
     * @param number $hostId            
     * @return SubscriptionHostEntity
     */
    public function getHostSubscription($hostId);

    /**
     *
     * @param number $subscriptionId            
     * @return SubscriptionHostEntity
     */
    public function getHostsSubscription($subscriptionId);

    /**
     *
     * @param SubscriptionHostEntity $entity            
     * @return SubscriptionHostEntity
     */
    public function save(SubscriptionHostEntity $entity);

    /**
     *
     * @param SubscriptionHostEntity $entity            
     * @return bool
     */
    public function delete(SubscriptionHostEntity $entity);
}
