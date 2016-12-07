<?php
namespace SubscriptionHost\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Application\Mapper\CoreMysqlMapper;
use SubscriptionHost\Entity\SubscriptionHostEntity;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param SubscriptionHostEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, SubscriptionHostEntity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SubscriptionHost\Mapper\MysqlMapperInterface::getHostsSubscription()
     */
    public function getHostsSubscription($subscriptionId)
    {
        $this->select = $this->readSql->select('subscription_host');
        
        $this->joinHost()
            ->joinHostType()
            ->joinSubscription();
        
        $this->select->where(array(
            'subscription_host.subscription_id = ?' => $subscriptionId
        ));
        
        return $this->getRows();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SubscriptionHost\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('subscription_host');
        
        $this->filter($filter);
        
        $this->joinHost()
            ->joinHostType()
            ->joinSubscription();
        
        // if pagination is disabled
        if (array_key_exists('pagination', $filter && $filter['pagination'] == 'off')) {
            return $this->getRows();
        }
        
        return $this->getPaginator();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SubscriptionHost\Mapper\MysqlMapperInterface::getHostSubscription()
     */
    public function getHostSubscription($hostId)
    {
        $this->select = $this->readSql->select('subscription_host');
        
        $this->joinHost()
            ->joinHostType()
            ->joinSubscription();
        
        $this->select->where(array(
            'subscription_host.host_id = ?' => $hostId
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SubscriptionHost\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('subscription_host');
        
        $this->joinHost()
            ->joinHostType()
            ->joinSubscription();
        
        $this->select->where(array(
            'subscription_host.subscription_host_id = ?' => $id
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SubscriptionHost\Mapper\MysqlMapperInterface::save()
     */
    public function save(SubscriptionHostEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        // if we have id then its an update
        if ($entity->getSubscriptionHostId()) {
            $this->update = new Update('subscription_host');
            
            $this->update->set($postData);
            
            $this->update->where(array(
                'subscription_host.subscription_host_id = ?' => $entity->getSubscriptionHostId()
            ));
            
            $this->updateRow();
        } else {
            $this->insert = new Insert('subscription_host');
            
            $this->insert->values($postData);
            
            $id = $this->createRow();
            
            $entity->setSubscriptionHostId($id);
        }
        
        return $this->get($entity->getSubscriptionHostId());
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SubscriptionHost\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(SubscriptionHostEntity $entity)
    {
        $this->delete = new Delete('subscription_host');
        
        $this->delete->where(array(
            'subscription_host.subscription_host_id = ?' => $entity->getSubscriptionHostId()
        ));
        
        return $this->deleteRow();
    }

    protected function filter($filter)
    {
        return $this;
    }

    /**
     *
     * @return \SubscriptionHost\Mapper\MysqlMapper
     */
    protected function joinHost()
    {
        $this->select->join('host', 'subscription_host.host_id = host.host_id', array(
            'location_id',
            'host_type_id',
            'host_name',
            'host_description',
            'host_ip',
            'host_status',
            'host_health',
            'host_created'
        ), 'inner');
        
        return $this;
    }

    /**
     *
     * @return \SubscriptionHost\Mapper\MysqlMapper
     */
    protected function joinHostType()
    {
        // join host type
        $this->select->join('host_type', 'host.host_type_id = host_type.host_type_id', array(
            'host_type_name'
        ), 'inner');
        
        return $this;
    }

    /**
     *
     * @return \SubscriptionHost\Mapper\MysqlMapper
     */
    protected function joinSubscription()
    {
        $this->select->join('subscription', 'subscription.subscription_id = subscription_host.subscription_id', array(
            'client_id',
            'subscription_date_create',
            'subscription_date_due',
            'subscription_date_update',
            'subscription_date_end',
            'payment_option_id',
            'subscription_schedule_id',
            'subscription_status_id'
        ), 'inner');
        
        return $this;
    }
}
