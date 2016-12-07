<?php
namespace SubscriptionUser\Mapper;

use SubscriptionUser\Entity\SubscriptionUserEntity;

interface MysqlMapperInterface
{

    /**
     *
     * @param unknown $filter            
     * @return SubscriptionUserEntity
     */
    public function getAll($filter);

    /**
     *
     * @param unknown $id            
     * @return SubscriptionUserEntity
     */
    public function get($id);

    /**
     *
     * @param SubscriptionUserEntity $entity            
     * @return SubscriptionUserEntity
     */
    public function save(SubscriptionUserEntity $entity);

    /**
     *
     * @param SubscriptionUserEntity $entity            
     * @return bool
     */
    public function delete(SubscriptionUserEntity $entity);
}

