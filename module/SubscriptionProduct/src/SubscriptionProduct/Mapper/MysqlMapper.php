<?php
namespace SubscriptionProduct\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Delete;
use Application\Mapper\CoreMysqlMapper;
use SubscriptionProduct\Entity\SubscriptionProductEntity;

class MysqlMapper extends CoreMysqlMapper implements MysqlMapperInterface
{

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param SubscriptionProductEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, SubscriptionProductEntity $prototype)
    {
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
        
        parent::__construct($readAdapter, $writeAdapter);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SubscriptionProduct\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $this->select = $this->readSql->select('subscription_product');
        
        $this->filter($filter);
        
        $this->joinProduct();
        
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
     * {@inheritdoc}
     *
     * @see \SubscriptionProduct\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $this->select = $this->readSql->select('subscription_product');
        
        $this->joinProduct();
        
        $this->select->where(array(
            'subscription_product.subscription_product_id = ?' => $id
        ));
        
        return $this->getRow();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SubscriptionProduct\Mapper\MysqlMapperInterface::getSubscriptionProducts()
     */
    public function getSubscriptionProducts($subscriptionId)
    {
        $this->select = $this->readSql->select('subscription_product');
        
        $this->joinProduct();
        
        $this->select->where(array(
            'subscription_product.subscription_id = ?' => $subscriptionId
        ));
        
        return $this->getRows();
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SubscriptionProduct\Mapper\MysqlMapperInterface::save()
     */
    public function save(SubscriptionProductEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        // if we have id then its an update
        if ($entity->getSubscriptionProductId()) {
            $this->update = new Update('subscription_product');
            
            $this->update->set($postData);
            
            $this->update->where(array(
                'subscription_product.subscription_product_id = ?' => $entity->getSubscriptionProductId()
            ));
            
            $this->updateRow();
        } else {
            $this->insert = new Insert('subscription_product');
            
            $this->insert->values($postData);
            
            $id = $this->createRow();
            
            $entity->setSubscriptionProductId($id);
        }
        
        return $this->get($entity->getSubscriptionProductId());
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \SubscriptionProduct\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(SubscriptionProductEntity $entity)
    {
        $this->delete = new Delete('subscription_product');
        
        $this->delete->where(array(
            'subscription_product.subscription_product_id = ?' => $entity->getSubscriptionProductId()
        ));
        
        return $this->deleteRow();
    }

    /**
     *
     * @param array $filter            
     * @return \SubscriptionProduct\Mapper\MysqlMapper
     */
    protected function filter($filter)
    {
        // subscriptionId
        if (array_key_exists('subscriptionId', $filter)) {
            $this->select->where(array(
                'subscription_product.subscription_id = ?' => $filter['subscriptionId']
            ));
        }
        return $this;
    }

    /**
     *
     * @return \SubscriptionProduct\Mapper\MysqlMapper
     */
    protected function joinProduct()
    {
        $this->select->join('product', 'subscription_product.product_id = product.product_id', array(
            'product_type_id',
            'product_name',
            'product_description_short',
            'product_description_long',
            'product_fee',
            'product_fee_setup',
            'product_fee_monthly',
            'product_fee_anual',
            'product_image',
            'product_status'
        ), 'inner');
        return $this;
    }
}

