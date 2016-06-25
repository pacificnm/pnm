<?php
namespace VendorAccount\Mapper;

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
use VendorAccount\Entity\AccountEntity;

class AccountMapper implements AccountMapperInterface
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
     * @var VendorEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param VendorEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, AccountEntity $prototype)
    {
        $this->readAdapter = $readAdapter;
        
        $this->writeAdapter = $writeAdapter;
        
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \VendorAccount\Mapper\AccountMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('vendor_account');
         
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \VendorAccount\Mapper\AccountMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('vendor_account');
        
        $select->where(array(
            'vendor_account.vendor_account_id = ?' => $id
        ));
        
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
     * @see \VendorAccount\Mapper\AccountMapperInterface::getVendorAccount()
     */
    public function getVendorAccount($vendorId)
    {
        $sql = new Sql($this->readAdapter);
    
        $select = $sql->select('vendor_account');
    
        $select->where(array(
            'vendor_account.vendor_id = ?' => $vendorId
        ));
    
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
     * @see \VendorAccount\Mapper\AccountMapperInterface::save()
     */
    public function save(AccountEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getVendorAccountId()) {
        
            // ID present, it's an Update
            $action = new Update('vendor_account');
        
            $action->set($postData);
        
            $action->where(array(
                'vendor_account.vendor_account_id = ?' => $entity->getVendorAccountId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('vendor_account');
        
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
        
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setVendorAccountId($newId);
            }
        
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     * 
     * {@inheritDoc}
     * @see \VendorAccount\Mapper\AccountMapperInterface::delete()
     */
    public function delete(AccountEntity $entity)
    {
        $action = new Delete('vendor_account');
        
        $action->where(array(
            'vendor_account.vendor_account_id = ?' => $entity->getVendorAccountId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}