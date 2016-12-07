<?php
namespace SubscriptionInvoice\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Application\Mapper\CoreMysqlMapper;
use SubscriptionInvoice\Entity\SubscriptionInvoiceEntity;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param SubscriptionEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, SubscriptionInvoiceEntity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionInvoice\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('subscription_invoice');
        
        $this->filter($filter);
        
        $this->joinInvoice()->joinSubscription();
        
        // if pagination is disabled
        if (array_key_exists('pagination', $filter) ) {
            if($filter['pagination'] == 'off') {
                return $this->getRows();
            }
        }
        
        return $this->getPaginator();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionInvoice\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('subscription_invoice');
        
        $this->select->where(array(
            'subscription_invoice.subscription_invoice_id = ?' => $id
        ));
        
        $this->joinInvoice()->joinSubscription();
        
        return $this->getRow();
    }

    /**
     * 
     * {@inheritDoc}
     * @see \SubscriptionInvoice\Mapper\MysqlMapperInterface::getBySubcription()
     */
    public function getBySubcription($subscriptionId)
    {
        $this->select = $this->readSql->select('subscription_invoice');
        
        $this->select->where(array(
            'subscription_invoice.subscription_id = ?' => $subscriptionId
        ));
        
        $this->joinInvoice()->joinSubscription();
        
        return $this->getRow();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \SubscriptionInvoice\Mapper\MysqlMapperInterface::getByInvoice()
     */
    public function getByInvoice($invoiceId)
    {
        $this->select = $this->readSql->select('subscription_invoice');
        
        $this->select->where(array(
            'subscription_invoice.invoice_id = ?' => $invoiceId
        ));
        
        $this->joinInvoice()->joinSubscription();
        
        return $this->getRow();
    }
    
    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionInvoice\Mapper\MysqlMapperInterface::save()
     */
    public function save(SubscriptionInvoiceEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        // if we have id then its an update
        if ($entity->getSubscriptionInvoiceId()) {
            $this->update = new Update('subscription_invoice');
            
            $this->update->set($postData);
            
            $this->update->where(array(
                'subscription_invoice.subscription_invoice_id = ?' => $entity->getSubscriptionId()
            ));
            
            $this->updateRow();
        } else {
            $this->insert = new Insert('subscription_invoice');
            
            $this->insert->values($postData);
            
            $id = $this->createRow();
            
            $entity->setSubscriptionInvoiceId($id);
        }
        
        return $this->get($entity->getSubscriptionInvoiceId());
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \SubscriptionInvoice\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(SubscriptionInvoiceEntity $entity)
    {
        $this->delete = new Delete('subscription_invoice');
        
        $this->delete->where(array(
            'subscription_invoice.subscription_invoice_id = ?' => $entity->getSubscriptionInvoiceId()
        ));
        
        return $this->deleteRow();
    }

    /**
     *
     * @param unknown $filter            
     * @return \SubscriptionInvoice\Mapper\MysqlMapper
     */
    protected function filter($filter)
    {
        // subscriptionId
        if(array_key_exists('subscriptionId', $filter)) {
            $this->select->where(array(
                'subscription_invoice.subscription_id = ?' => $filter['subscriptionId']
            ));
        }
        
        // invoiceId
        if(array_key_exists('invoiceId', $filter)) {
            $this->select->where(array(
                'subscription_invoice.invoiceId = ?' => $filter['invoiceId']
            ));
        }
        
        return $this;
    }

    /**
     *
     * @return \SubscriptionInvoice\Mapper\MysqlMapper
     */
    protected function joinInvoice()
    {
        $this->select->join('invoice', 'subscription_invoice.invoice_id = invoice.invoice_id', array(
            'invoice_date',
            'invoice_date_start',
            'invoice_date_end',
            'invoice_subtotal',
            'invoice_tax',
            'invoice_discount',
            'invoice_total',
            'invoice_payment',
            'invoice_balance',
            'invoice_status',
            'invoice_date_paid'
        ), 'inner');
        
        return $this;
    }

    /**
     *
     * @return \SubscriptionInvoice\Mapper\MysqlMapper
     */
    protected function joinSubscription()
    {
        $this->select->join('subscription', 'subscription_invoice.subscription_id = subscription.subscription_id', array(
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