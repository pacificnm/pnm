<?php
namespace PaymentOption\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\ResultSet\ResultSet;
use PaymentOption\Entity\OptionEntity;

class OptionMapper implements OptionMapperInterface
{

    /**
     *
     * @var AdapterInterface
     */
    protected $readAdapter;

    /**
     *
     * @var AdapterInterface
     */
    protected $writeAdapter;

    /**
     *
     * @var HydratorInterface
     */
    protected $hydrator;

    /**
     *
     * @var OptionEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param OptionEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, OptionEntity $prototype)
    {
        $this->readAdapter = $readAdapter;
        
        $this->writeAdapter = $writeAdapter;
        
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PaymentOption\Mapper\OptionMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('payment_option');
        
        // paymentOptionEnabled
        if (array_key_exists('paymentOptionEnabled', $filter)) {
            $select->where(array(
                'payment_option.payment_option_enabled = ?' => $filter['paymentOptionEnabled']
            ));
        }
        
        $stmt = $sql->prepareStatementForSqlObject($select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            
            $resultSet = new HydratingResultSet($this->hydrator, $this->prototype);
            
            $resultSet->buffer();
            
            return $resultSet->initialize($result);
        }
        
        return array();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PaymentOption\Mapper\OptionMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('payment_option');
        
        $select->where(array(
            'payment_option.payment_option_id = ?' => $id
        ));
        
        $stmt = $sql->prepareStatementForSqlObject($select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            
            $resultSet = new HydratingResultSet($this->hydrator, $this->prototype);
            
            $resultSet->buffer();
            
            return $resultSet->initialize($result)->current();
        }
        
        return array();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PaymentOption\Mapper\OptionMapperInterface::save()
     */
    public function save(OptionEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getPaymentOptionId()) {
            
            // ID present, it's an Update
            $action = new Update('payment_option');
            
            $action->set($postData);
            
            $action->where(array(
                'payment_option.payment_option_id = ?' => $entity->getPaymentOptionId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('payment_option');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setPaymentOptionId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \PaymentOption\Mapper\OptionMapperInterface::delete()
     */
    public function delete(OptionEntity $entity)
    {
        $action = new Delete('payment_option');
        
        $action->where(array(
            'payment_option.payment_option_id = ?' => $entity->getPaymentOptionId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}
