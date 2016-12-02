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
     * {@inheritdoc}
     *
     * @see \Subscription\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('subscription');
        
        $this->filter($filter);
        
        $this->joinPaymentOption()
            ->joinSubscriptionSchedule()
            ->joinSubscriptionStatus()
            ->joinClient();
        
        return $this->getPaginator();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \Subscription\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('subscription');
        
        $this->joinPaymentOption()
            ->joinSubscriptionSchedule()
            ->joinSubscriptionStatus()
            ->joinClient();
        
        $this->select->where(array(
            'subscription.subscription_id = ?' => $id
        ));
        
        return $this->getRow();
    }

    public function getActive()
    {
        $this->select = $this->readSql->select('subscription');
        
        return $this->getRows();
    }

    /**
     *
     * {@inheritdoc}
     *
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
     * {@inheritdoc}
     *
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

    /**
     *
     * @param unknown $filter            
     * @return \Subscription\Mapper\MysqlMapper
     */
    protected function filter($filter)
    {
        if (array_key_exists('clientId', $filter)) {
            $this->select->where(array(
                'subscription.client_id = ?' => $filter['clientId']
            ));
        }
        
        return $this;
    }

    /**
     *
     * @return \Subscription\Mapper\MysqlMapper
     */
    protected function joinSubscriptionSchedule()
    {
        $this->select->join('subscription_schedule', 'subscription_schedule.subscription_schedule_id = subscription.subscription_schedule_id', array(
            'subscription_schedule_name',
            'subscription_schedule_status'
        ), 'inner');
        
        return $this;
    }

    /**
     *
     * @return \Subscription\Mapper\MysqlMapper
     */
    protected function joinSubscriptionStatus()
    {
        $this->select->join('subscription_status', 'subscription_status.subscription_status_id = subscription.subscription_status_id', array(
            'subscription_status_name',
            'subscription_status_status'
        ), 'inner');
        
        return $this;
    }

    /**
     *
     * @return \Subscription\Mapper\MysqlMapper
     */
    protected function joinNextProduct()
    {
        $this->select->join('product', 'subscription.next_product_id = product.product_id', array(
            'product_name',
            'product_description_short',
            'product_fee',
            'product_fee_setup',
            'product_fee_monthly',
            'product_fee_anual',
            'product_image',
            'product_status'
        ), 'inner');
        
        return $this;
    }

    /**
     *
     * @return \Subscription\Mapper\MysqlMapper
     */
    protected function joinPaymentOption()
    {
        $this->select->join('payment_option', 'payment_option.payment_option_id = subscription.payment_option_id', array(
            'payment_option_name',
            'payment_option_enabled'
        ), 'inner');
        
        return $this;
    }

    /**
     *
     * @return \Subscription\Mapper\MysqlMapper
     */
    protected function joinClient()
    {
        $this->select->join('client', 'client.client_id = subscription.client_id', array(
            'client_name',
            'client_status',
            'client_created'
        ), 'inner');
        
        return $this;
    }
}