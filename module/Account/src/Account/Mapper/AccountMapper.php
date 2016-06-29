<?php
namespace Account\Mapper;

use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\DbSelect;
use Account\Entity\AccountEntity;

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
     * @var AccountEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param AccountEntity $prototype            
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
     *
     * @see \Account\Mapper\AccountMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('account');
        
        $select->where(array(
            'account_active = ?' => 1
        ));
        
        // filter account type
        if (array_key_exists('accountTypeId', $filter) && ! empty($filter['accountTypeId'])) {
            $select->where(array(
                'account.account_type_id = ?' => $filter['accountTypeId']
            ));
        }
        
        if (array_key_exists('accountVisible', $filter) && ! empty($filter['accountVisible'])) {
            $select->where(array(
                'account.account_visible = ?' => $filter['accountVisible']
            ));
        }
        
        $select->join('account_type', 'account.account_type_id = account_type.account_type_id', array(
            'account_type_name'
        ), 'inner');
        
        $select->order('account_name');
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Account\Mapper\AccountMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('account');
        
        $select->where(array(
            'account.account_id = ?' => $id
        ));
        
        $select->join('account_type', 'account.account_type_id = account_type.account_type_id', array(
            'account_type_name'
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
     * @see \Account\Mapper\AccountMapperInterface::getNonSystemAccounts()
     */
    public function getNonSystemAccounts()
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('account');
        
        $select->where(array(
            'account.account_active = ?' => 1
        ));
        
        $select->where(array(
            'account.account_visible = ?' => 1
        ));
        
        $select->join('account_type', 'account.account_type_id = account_type.account_type_id', array(
            'account_type_name'
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

    public function save(AccountEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getAccountId()) {
            
            // ID present, it's an Update
            $action = new Update('account');
            
            $action->set($postData);
            
            $action->where(array(
                'account.account_id = ?' => $entity->getAccountId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('account');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setAccountId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Account\Mapper\AccountMapperInterface::delete()
     */
    public function delete(AccountEntity $entity)
    {
        $action = new Delete('account');
        
        $action->where(array(
            'account.account_id = ?' => $entity->getAccountId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}