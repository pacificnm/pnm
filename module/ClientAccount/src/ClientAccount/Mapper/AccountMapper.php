<?php
namespace ClientAccount\Mapper;

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
use ClientAccount\Entity\AccountEntity;

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
     * @see \ClientAccount\Mapper\AccountMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('client_account');
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ClientAccount\Mapper\AccountMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('client_account');
        
        $select->where(array(
            'client_account.client_account_id = ?' => $id
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

    public function getClientAccount($clientId)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('client_account');
        
        $select->where(array(
            'client_account.client_id = ?' => $clientId
        ));
        
        $select->join('account', 'client_account.account_id = account.account_id', array(
            'account_name',
            'account_number',
            'account_balance',
            'account_created',
            'account_active',
            'account_visible',
            'account_type_id'
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
     * @see \ClientAccount\Mapper\AccountMapperInterface::save()
     */
    public function save(AccountEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getClientAccountId()) {
            
            // ID present, it's an Update
            $action = new Update('client_account');
            
            $action->set($postData);
            
            $action->where(array(
                'client_account.client_account_id = ?' => $entity->getClientAccountId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('client_account');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setClientAccountId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ClientAccount\Mapper\AccountMapperInterface::delete()
     */
    public function delete(AccountEntity $entity)
    {
        $action = new Delete('client_account');
        
        $action->where(array(
            'client_account.client_account_id = ?' => $entity->getClientAccountId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}