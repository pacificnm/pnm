<?php
namespace Subscription\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Subscription\Entity\SubscriptionEntity;
use Application\Mapper\CoreMysqlMapper;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{
    /**
     *
     * @param AdapterInterface $readAdapter
     * @param AdapterInterface $writeAdapter
     * @param HydratorInterface $hydrator
     * @param SubscriptionEntity $prototype
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, SubscriptionEntity $prototype)
    {
        $this->hydrator = $hydrator;
    
        $this->prototype = $prototype;
    
        parent::__construct($readAdapter, $writeAdapter);
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Subscription\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('subscription');
        
        $this->filter($filter);
        
        return $this->getPaginator();
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Subscription\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('subscription');
        
        $this->select->where(array(
            'subscription.subscription_id = ?' => $id
        ));
        
        return $this->getRow();
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Subscription\Mapper\MysqlMapperInterface::save()
     */
    public function save(SubscriptionEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        // if we have id then its an update
        if ($entity->getSubscriptionId()) {
            $this->update = new Update('subscription');
        
            $this->update->set($postData);
        
            $this->update->where(array(
                'subscription.subscription_id = ?' => $entity->getSubscriptionId()
            ));
        
            $this->updateRow();
        } else {
            $this->insert = new Insert('subscription');
        
            $this->insert->values($postData);
        
            $id = $this->createRow();
        
            $entity->setSubscriptionId($id);
        }
        
        return $this->get($entity->getSubscriptionId());
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Subscription\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(SubscriptionEntity $entity)
    {
        $this->delete = new Delete('subscription');
        
        $this->delete->where(array(
            'subscription.subscription_id = ?' => $entity->getSubscriptionId()
        ));
        
        return $this->deleteRow();
    }
    
    protected function filter($filter)
    {
        return $this;
    }
}