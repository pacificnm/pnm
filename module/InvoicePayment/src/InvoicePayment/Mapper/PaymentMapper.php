<?php
namespace InvoicePayment\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\DbSelect;
use InvoicePayment\Entity\PaymentEntity;

class PaymentMapper implements PaymentMapperInterface
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
     * @var PaymentEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param PaymentEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, PaymentEntity $prototype)
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
     * @see \InvoicePayment\Mapper\PaymentMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('invoice_payment');
        
        $select->join('payment_option', 'invoice_payment.payment_option_id = payment_option.payment_option_id', array(
            'payment_option_name',
            'payment_option_enabled'
        ), 'inner');
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \InvoicePayment\Mapper\PaymentMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('invoice_payment');
        
        $select->where(array(
            'invoice_payment.invoice_payment_id = ?' => $id
        ));
        
        $select->join('payment_option', 'invoice_payment.payment_option_id = payment_option.payment_option_id', array(
            'payment_option_name',
            'payment_option_enabled'
        ), 'inner');
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
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
     * @see \InvoicePayment\Mapper\PaymentMapperInterface::getInvoicePayments()
     */
    public function getInvoicePayments($invoiceId)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('invoice_payment');
        
        $select->where(array(
            'invoice_payment.invoice_id = ?' => $invoiceId
        ));
        
        $select->join('payment_option', 'invoice_payment.payment_option_id = payment_option.payment_option_id', array(
            'payment_option_name',
            'payment_option_enabled'
        ), 'inner');
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
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
     * @see \InvoicePayment\Mapper\PaymentMapperInterface::save()
     */
    public function save(PaymentEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getInvoicePaymentId()) {
            
            // ID present, it's an Update
            $action = new Update('invoice_payment');
            
            $action->set($postData);
            
            $action->where(array(
                'invoice_payment.invoice_payment_id = ?' => $entity->getInvoicePaymentId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('invoice_payment');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setInvoicePaymentId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \InvoicePayment\Mapper\PaymentMapperInterface::delete()
     */
    public function delete(PaymentEntity $entity)
    {
        $action = new Delete('invoice_payment');
        
        $action->where(array(
            'invoice_payment.invoice_payment_id = ?' => $entity->getInvoicePaymentId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}