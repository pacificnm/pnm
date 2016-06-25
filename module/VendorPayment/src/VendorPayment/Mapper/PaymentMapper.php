<?php
namespace VendorPayment\Mapper;

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
use VendorPayment\Entity\PaymentEntity;

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
     * @see \VendorPayment\Mapper\PaymentMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('vendor_payment');
        
        if (array_key_exists('vendorBillId', $filter) && ! empty($filter['vendorBillId'])) {
            $select->where(array(
                'vendor_payment.vendor_bill_id = ?' => $filter['vendorBillId']
            ));
        }
        
        $select->where(array(
            'vendor_payment_active = ?' => 1
        ));
        
        $select->join('account', 'vendor_payment.account_id = account.account_id', array(
            'account_name',
            'account_active'
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
     * @see \VendorPayment\Mapper\PaymentMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('vendor_payment');
        
        $select->where(array(
            'vendor_payment.vendor_payment_id = ?' => $id
        ));
        
        $select->join('account', 'vendor_payment.account_id = account.account_id', array(
            'account_name',
            'account_active'
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
     * @see \VendorPayment\Mapper\PaymentMapperInterface::save()
     */
    public function save(PaymentEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getVendorPaymentId()) {
            
            // ID present, it's an Update
            $action = new Update('vendor_payment');
            
            $action->set($postData);
            
            $action->where(array(
                'vendor_payment.vendor_payment_id = ?' => $entity->vendor_payemnt()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('vendor_payment');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setVendorPaymentId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \VendorPayment\Mapper\PaymentMapperInterface::delete()
     */
    public function delete(PaymentEntity $entity)
    {
        $action = new Delete('vendor_payment');
        
        $action->where(array(
            'vendor_payment.vendor_payment_id = ?' => $entity->getVendorPaymentId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}