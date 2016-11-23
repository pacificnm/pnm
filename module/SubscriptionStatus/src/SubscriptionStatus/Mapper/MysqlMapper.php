<?php
namespace SubscriptionStatus\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Application\Mapper\CoreMysqlMapper;
use SubscriptionStatus\Entity\SubscriptionStatusEntity;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param SubscriptionStatusEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, SubscriptionStatusEntity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionStatus\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('subscription_status');
        
        $this->filter($filter);
        
        return $this->getPaginator();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionStatus\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('subscription_status');
        
        $this->select->where(array(
            'subscription_status.subscription_status_id = ?' => $id
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionStatus\Mapper\MysqlMapperInterface::save()
     */
    public function save(SubscriptionStatusEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        // if we have id then its an update
        if ($entity->getSubscriptionStatusId()) {
            $this->update = new Update('subscription_status');
            
            $this->update->set($postData);
            
            $this->update->where(array(
                'subscription_status.subscription_status_id = ?' => $entity->getSubscriptionStatusId()
            ));
            
            $this->updateRow();
        } else {
            $this->insert = new Insert('subscription_status');
            
            $this->insert->values($postData);
            
            $id = $this->createRow();
            
            $entity->setSubscriptionStatusId($id);
        }
        
        return $this->get($entity->getSubscriptionStatusId());
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionStatus\Mapper\MysqlMapperInterface::getActive()
     */
    public function getActive()
    {
        $this->select = $this->readSql->select('subscription_status');
        
        return $this->getRows();
    }

    public function delete(SubscriptionStatusEntity $entity)
    {
        $this->delete = new Delete('subscription_status');
        
        $this->delete->where(array(
            'subscription_status.subscription_status_id = ?' => $entity->getSubscriptionStatusId()
        ));
        
        return $this->deleteRow();
    }

    /**
     *
     * @param array $filter            
     * @return \SubscriptionStatus\Mapper\MysqlMapper
     */
    protected function filter($filter)
    {
        return $this;
    }
}