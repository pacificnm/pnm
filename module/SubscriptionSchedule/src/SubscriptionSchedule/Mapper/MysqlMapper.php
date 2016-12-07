<?php
namespace SubscriptionSchedule\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Application\Mapper\CoreMysqlMapper;
use SubscriptionSchedule\Entity\SubscriptionScheduleEntity;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param SubscriptionScheduleEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, SubscriptionScheduleEntity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionSchedule\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('subscription_schedule');
        
        $this->filter($filter);
        
        // if pagination is disabled
        if (array_key_exists('pagination', $filter && $filter['pagination'] == 'off')) {
            return $this->getRows();
        }
        
        return $this->getPaginator();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionSchedule\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('subscription_schedule');
        
        $this->select->where(array(
            'subscription_schedule.subscription_schedule_id = ?' => $id
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionSchedule\Mapper\MysqlMapperInterface::getActive()
     */
    public function getActive()
    {
        $this->select = $this->readSql->select('subscription_schedule');
        
        return $this->getRows();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionSchedule\Mapper\MysqlMapperInterface::save()
     */
    public function save(SubscriptionScheduleEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        // if we have id then its an update
        if ($entity->getSubscriptionScheduleId()) {
            $this->update = new Update('subscription_schedule');
            
            $this->update->set($postData);
            
            $this->update->where(array(
                'subscription_schedule.subscription_schedule_id = ?' => $entity->getSubscriptionScheduleId()
            ));
            
            $this->updateRow();
        } else {
            $this->insert = new Insert('subscription_schedule');
            
            $this->insert->values($postData);
            
            $id = $this->createRow();
            
            $entity->setSubscriptionScheduleId($id);
        }
        
        return $this->get($entity->getSubscriptionScheduleId());
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionSchedule\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(SubscriptionScheduleEntity $entity)
    {
        $this->delete = new Delete('subscription_schedule');
        
        $this->delete->where(array(
            'subscription_schedule.subscription_schedule_id = ?' => $entity->getSubscriptionScheduleId()
        ));
        
        return $this->deleteRow();
    }

    /**
     *
     * @param unknown $filter            
     * @return \SubscriptionSchedule\Mapper\MysqlMapper
     */
    protected function filter($filter)
    {
        return $this;
    }
}