<?php
namespace SubscriptionProduct\Service;

use SubscriptionProduct\Entity\SubscriptionProductEntity;

interface SubscriptionProductServiceInterface
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

