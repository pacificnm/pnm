<?php
namespace Invoice\Mapper;

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
use Invoice\Entity\InvoiceEntity;

class InvoiceMapper implements InvoiceMapperInterface
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
     * @var InvoiceEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param InvoiceEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, InvoiceEntity $prototype)
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
     * @see \Invoice\Mapper\InvoiceMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('invoice');
        
        // client id
        if (array_key_exists('clientId', $filter) && ! empty($filter['clientId'])) {
            $select->where(array(
                'invoice.client_Id = ?' => $filter['clientId']
            ));
        }
        
        // invoiceStatus
        if (array_key_exists('invoiceStatus', $filter) && ! empty($filter['invoiceStatus'])) {
            $select->where(array(
                'invoice.invoice_status = ?' => $filter['invoiceStatus']
            ));
        }
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Invoice\Mapper\InvoiceMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('invoice');
        
        $select->where(array(
            'invoice.invoice_id = ?' => $id
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
     * @see \Invoice\Mapper\InvoiceMapperInterface::getByDateRange()
     */
    public function getByDateRange($start, $end, $status)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('invoice');
        
        // join client
        $select->join('client', 'invoice.client_id = client.client_id', array(
            'client_name',
            'client_status'
        ), 'inner');
        
        // status
        $select->where(array(
            'invoice.invoice_status = ?' => $status
        ));
        
        // start
        if($start) {
            $select->where->greaterThanOrEqualTo('invoice.invoice_date_start', $start);
        }
        
        // end
        if($end) {
            $select->where->lessThanOrEqualTo('invoice.invoice_date_end', $end);
        }
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Invoice\Mapper\InvoiceMapperInterface::save()
     */
    public function save(InvoiceEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getInvoiceId()) {
            
            // ID present, it's an Update
            $action = new Update('invoice');
            
            $action->set($postData);
            
            $action->where(array(
                'invoice.invoice_id = ?' => $entity->getInvoiceId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('invoice');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setInvoiceId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Invoice\Mapper\InvoiceMapperInterface::delete()
     */
    public function delete(InvoiceEntity $entity)
    {
        $action = new Delete('invoice');
        
        $action->where(array(
            'invoice.invoice_id = ?' => $entity->getInvoiceId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}