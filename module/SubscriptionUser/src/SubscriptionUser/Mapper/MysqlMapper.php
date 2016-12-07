<?php
namespace SubscriptionUser\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Application\Mapper\CoreMysqlMapper;
use SubscriptionUser\Entity\SubscriptionUserEntity;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param SubscriptionUserEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, SubscriptionUserEntity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SubscriptionUser\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('subscription_user');
        
        $this->joinSubscription()->joinUser();
        
        $this->filter($filter);
        
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
     * @see \SubscriptionUser\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('subscription_user');
        
        $this->joinSubscription()->joinUser();
        
        $this->select->where(array(
            'subscription_user.subscription_user_id = ?' => $id
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SubscriptionUser\Mapper\MysqlMapperInterface::save()
     */
    public function save(SubscriptionUserEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        // if we have id then its an update
        if ($entity->getSubscriptionUserId()) {
            $this->update = new Update('subscription_user');
            
            $this->update->set($postData);
            
            $this->update->where(array(
                'subscription_user.subscription_user_id = ?' => $entity->getSubscriptionUserId()
            ));
            
            $this->updateRow();
        } else {
            $this->insert = new Insert('subscription_user');
            
            $this->insert->values($postData);
            
            $id = $this->createRow();
            
            $entity->setSubscriptionUserId($id);
        }
        
        return $this->get($entity->getSubscriptionUserId());
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SubscriptionUser\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(SubscriptionUserEntity $entity)
    {
        $this->delete = new Delete('subscription_user');
        
        $this->delete->where(array(
            'subscription_user.subscription_user_id = ?' => $entity->getSubscriptionUserId()
        ));
        
        return $this->deleteRow();
    }

    /**
     *
     * @param array $filter            
     * @return \SubscriptionUser\Mapper\MysqlMapper
     */
    protected function filter($filter)
    {
        if (array_key_exists('userId', $filter)) {
            $this->select->where(array(
                'subscription_user.user_id = ?' => $filter['userId']
            ));
        }
        
        if (array_key_exists('subscriptionId', $filter)) {
            $this->select->where(array(
                'subscription_user.subscription_id = ?' => $filter['subscriptionId']
            ));
        }
        
        return $this;
    }

    /**
     *
     * @return \SubscriptionUser\Mapper\MysqlMapper
     */
    protected function joinUser()
    {
        $this->select->join('user', 'subscription_user.user_id = user.user_id', array(
            'client_id',
            'location_id',
            'user_status',
            'user_name_first',
            'user_name_last',
            'user_job_title',
            'user_email',
            'user_type'
        ), 'inner');
        return $this;
    }

    /**
     *
     * @return \SubscriptionUser\Mapper\MysqlMapper
     */
    protected function joinSubscription()
    {
        $this->select->join('subscription', 'subscription_user.subscription_id = subscription.subscription_id', array(
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

