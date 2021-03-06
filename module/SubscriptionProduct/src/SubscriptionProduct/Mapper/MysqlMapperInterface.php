<?php
namespace SubscriptionProduct\Mapper;

use SubscriptionProduct\Entity\SubscriptionProductEntity;

interface MysqlMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return SubscriptionProductEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return SubscriptionProductEntity
     */
    public function get($id);

    /**
     * Gets subscription products
     *
     * @param number $subscriptionId            
     * @return SubscriptionProductEntity
     */
    public function getSubscriptionProducts($subscriptionId);

    /**
     *
     * @param SubscriptionProductEntity $entity            
     * @return SubscriptionProductEntity
     */
    public function save(SubscriptionProductEntity $entity);

    /**
     *
     * @param SubscriptionProductEntity $entity            
     * @return bool
     */
    public function delete(SubscriptionProductEntity $entity);
}

