<?php
namespace SubscriptionStatus\Mapper;

use SubscriptionStatus\Entity\SubscriptionStatusEntity;

interface MysqlMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return SubscriptionStatusEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return SubscriptionStatusEntity
     */
    public function get($id);

    /**
     *
     * @return SubscriptionStatusEntity
     */
    public function getActive();

    /**
     *
     * @param SubscriptionStatusEntity $entity            
     * @return SubscriptionStatusEntity
     */
    public function save(SubscriptionStatusEntity $entity);

    /**
     *
     * @param SubscriptionStatusEntity $entity            
     * @return bool
     */
    public function delete(SubscriptionStatusEntity $entity);
}