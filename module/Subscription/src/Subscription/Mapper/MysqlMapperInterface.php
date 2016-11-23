<?php
namespace Subscription\Mapper;

use Subscription\Entity\SubscriptionEntity;

interface MysqlMapperInterface
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
     *
     * @return SubscriptionEntity
     */
    public function getActive();

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