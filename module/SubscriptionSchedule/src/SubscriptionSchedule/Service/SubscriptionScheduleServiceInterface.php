<?php
namespace SubscriptionSchedule\Service;

use SubscriptionSchedule\Entity\SubscriptionScheduleEntity;

interface SubscriptionScheduleServiceInterface
{

    /**
     *
     * @param array $filter            
     * @return SubscriptionScheduleEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return SubscriptionScheduleEntity
     */
    public function get($id);

    /**
     *
     * @return SubscriptionScheduleEntity
     */
    public function getActive();
    
    /**
     *
     * @param SubscriptionScheduleEntity $entity            
     * @return SubscriptionScheduleEntity
     */
    public function save(SubscriptionScheduleEntity $entity);

    /**
     *
     * @param SubscriptionScheduleEntity $entity            
     * @return bool
     */
    public function delete(SubscriptionScheduleEntity $entity);
}