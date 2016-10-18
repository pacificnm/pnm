<?php
namespace Notification\Mapper;

use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Adapter\AdapterInterface;
use Application\Mapper\CoreMysqlMapper;
use Notification\Entity\NotificationEntity;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param NotificationEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, NotificationEntity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
        
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Notification\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('notification');
        
        $this->filter($filter);
        
        return $this->getPaginator();
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Notification\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('notification');
        
        $this->select->where(array(
            'notification.notification_id = ?' => $id
        ));
        
        return $this->getRow();
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Notification\Mapper\MysqlMapperInterface::clearNotifications()
     */
    public function clearNotifications($employeeId)
    {
        $sql = "UPDATE notification SET notification_status = 'Inactive' WHERE employee_id = " . $employeeId;
        
        $resultSet = $this->writeAdapter->getDriver()->getConnection()->execute($sql);
        
        return $resultSet;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Notification\Mapper\MysqlMapperInterface::save()
     */
    public function save(NotificationEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        // if we have id then its an update
        if($entity->getNotificationId()) {
            $this->update = new Update('notification');
            
            $this->update->set($postData);
            
            $this->update->where(array(
                'notification.notification_id = ?' => $entity->getNotificationId()
            ));
            
            $this->updateRow();
        } else {
            $this->insert = new Insert('notification');
            
            $this->insert->values($postData);
            
            $id = $this->createRow();
            
            $entity->setNotificationId($id);
        }
        
        return $this->get($entity->getNotificationId());
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Notification\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(NotificationEntity $entity)
    {
        $this->delete = new Delete('notification');
        
        $this->delete->where(array(
            'notification.notification_id = ?' => $entity->getNotificationId()
        ));
        
        return $this->deleteRow();
    }

    /**
     * 
     * @param array $filter
     */
    protected function filter($filter)
    {
        // employee ID
        if(array_key_exists('employeeId', $filter)) {
            $this->select->where(array(
                'notification.employee_id = ?' => $filter['employeeId']
            ));
        }
        
        // notificationStatus
        if(array_key_exists('notificationStatus', $filter)) {
            $this->select->where(array(
                'notification.notification_status = ?' => $filter['notificationStatus']
            ));
        }
        
        return $this;
    }
}