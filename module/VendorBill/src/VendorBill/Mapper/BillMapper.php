<?php
namespace VendorBill\Mapper;

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
use VendorBill\Entity\BillEntity;

class BillMapper implements BillMapperInterface
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
     * @var BillEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param BillEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, BillEntity $prototype)
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
     * @see \VendorBill\Mapper\BillMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('vendor_bill');
        
        // vendor
        if (array_key_exists('vendorId', $filter) && ! empty($filter['vendorId'])) {
            $select->where(array(
                'vendor_bill.vendor_id = ?' => $filter['vendorId']
            ));
        }
        
        // status
        if (array_key_exists('vendorBillStatus', $filter) && ! empty($filter['vendorBillStatus'])) {
            $select->where(array(
                'vendor_bill.vendor_bill_status = ?' => $filter['vendorBillStatus']
            ));
        }
        
        // join account
        $select->join('vendor', 'vendor_bill.vendor_id = vendor.vendor_id', array(
            'vendor_name',
            'vendor_active'
        ), 'left');
        
        $select->order('vendor_bill.vendor_bill_date_due');
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \VendorBill\Mapper\BillMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('vendor_bill');
        
        $select->where(array(
            'vendor_bill.vendor_bill_id = ?' => $id
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
     * @see \VendorBill\Mapper\BillMapperInterface::getDueBills()
     */
    public function getDueBills()
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('vendor_bill');
        
        $select->where(array(
            'vendor_bill.vendor_bill_status = ?' => 'Un-Paid'
        ));
        
        // join vendor
        $select->join('vendor', 'vendor_bill.vendor_id = vendor.vendor_id', array(
            'vendor_name',
            'vendor_active'
        ), 'left');
        
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
     * @see \VendorBill\Mapper\BillMapperInterface::save()
     */
    public function save(BillEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getVendorBillId()) {
            
            // ID present, it's an Update
            $action = new Update('vendor_bill');
            
            $action->set($postData);
            
            $action->where(array(
                'vendor_bill.vendor_bill_id = ?' => $entity->getVendorBillId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('vendor_bill');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setVendorBillId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \VendorBill\Mapper\BillMapperInterface::delete()
     */
    public function delete(BillEntity $entity)
    {
        $action = new Delete('vendor_bill');
        
        $action->where(array(
            'vendor_bill.vendor_bill_id = ?' => $entity->getVendorBillId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}