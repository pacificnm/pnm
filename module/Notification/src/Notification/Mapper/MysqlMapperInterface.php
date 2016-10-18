<?php
namespace Notification\Mapper;

use Notification\Entity\NotificationEntity;

interface MysqlMapperInterface
{

    /**
     *
     * @param array $filter            
     * @return NotificationEntity
     */
    public function getAll($filter);

    /**
     *
     * @param number $id            
     * @return NotificationEntity
     */
    public function get($id);

    /**
     * 
     * @param number $employeeId
     * @return NotificationEntity
     */
    public function clearNotifications($employeeId);
    
    /**
     *
     * @param NotificationEntity $entity            
     * @return NotificationEntity
     */
    public function save(NotificationEntity $entity);

    /**
     *
     * @param NotificationEntity $entity            
     * @return boolean
     */
    public function delete(NotificationEntity $entity);
}
