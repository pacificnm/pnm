<?php
namespace AccountLedger\Mapper;

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
use AccountLedger\Entity\LedgerEntity;

class LedgerMapper implements LedgerMapperInterface
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
     * @var LedgerEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param LedgerEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, LedgerEntity $prototype)
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
     * @see \AccountLedger\Mapper\LedgerMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('account_ledger');
        
        if (array_key_exists('accountId', $filter) && ! empty($filter['accountId'])) {
            $select->where(array(
                'account_ledger.account_id = ?' => $filter['accountId']
            ));
        }
 
        // join from account
        $select->join('account', 'account_ledger.from_account_id = account.account_id', array(
            'account_type_id',
            'account_name'
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
     * @see \AccountLedger\Mapper\LedgerMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('account_ledger');
        
        $select->where(array(
            'account_ledger.account_ledger_id = ?' => $id
        ));
        
        // join from account
        $select->join('account', 'account_ledger.from_account_id = account.account_id', array(
            'account_type_id',
            'account_name'
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
     * @see \AccountLedger\Mapper\LedgerMapperInterface::save()
     */
    public function save(LedgerEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getAccountLedgerId()) {
            
            // ID present, it's an Update
            $action = new Update('account_ledger');
            
            $action->set($postData);
            
            $action->where(array(
                'account_ledger.account_ledger_id = ?' => $entity->getAccountLedgerId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('account_ledger');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setAccountLedgerId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \AccountLedger\Mapper\LedgerMapperInterface::delete()
     */
    public function delete(LedgerEntity $entity)
    {
        $action = new Delete('account_ledger');
        
        $action->where(array(
            'account_ledger.account_ledger_id = ?' => $entity->getAccountLedgerId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}
