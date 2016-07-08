<?php
/**
 * Pacific NM (https://www.pacificnm.com)
 *
 * @link      https://github.com/pacificnm/pnm for the canonical source repository
 * @copyright Copyright (c) 20011-2016 Pacific NM USA Inc. (https://www.pacificnm.com)
 * @license   https://www.pacificnm.com/license/new-bsd New BSD License
 */
namespace WorkorderCredit\Mapper;

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
use Zend\Db\ResultSet\ResultSet;
use WorkorderCredit\Entity\CreditEntity;

/**
 * Work Order Credit Mapper
 *
 * @author jaimie (pacificnm@gmail.com)
 *        
 */
class CreditMapper implements CreditMapperInterface
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
     * @var CreditEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param CreditEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, CreditEntity $prototype)
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
     * @see \WorkorderCredit\Mapper\CreditMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder');
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderCredit\Mapper\CreditMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_credit');
        
        $select->where(array(
            'workorder_credit.workorder_credit_id = ?' => $id
        ));
        
        // join payment option
        $select->join('payment_option', 'workorder_credit.payment_option_id = payment_option.payment_option_id', array(
            'payment_option_name',
            'payment_option_enabled'
        ), 'inner');
        
        // join account
        $select->join('account', 'workorder_credit.account_id = account.account_id', array(
            'account_name',
            'account_type_id',
            'account_description',
            'account_number',
            'account_balance',
            'account_created',
            'account_active',
            'account_visible'
        ), 'inner');
        
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
     * @see \WorkorderCredit\Mapper\CreditMapperInterface::save()
     */
    public function save(CreditEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getWorkorderCreditId()) {
            
            // ID present, it's an Update
            $action = new Update('workorder_credit');
            
            $action->set($postData);
            
            $action->where(array(
                'workorder_credit.workorder_credit_id = ?' => $entity->getWorkorderCreditId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('workorder_credit');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setWorkorderCreditId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderCredit\Mapper\CreditMapperInterface::delete()
     */
    public function delete(CreditEntity $entity)
    {
        $action = new Delete('workorder_credit');
        
        $action->where(array(
            'workorder_credit.workorder_credit_id = ?' => $entity->getWorkorderCreditId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderCredit\Mapper\CreditMapperInterface::getWorkorderTotal()
     */
    public function getWorkorderTotal($workorderId)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_credit');
        
        $select->where(array(
            'workorder_credit.workorder_id = ?' => $workorderId
        ));
        
        $select->columns(array(
            'workorder_credit_total' => new \Zend\Db\Sql\Expression('SUM(workorder_credit_amount_left)')
        ));
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $stmt = $sql->prepareStatementForSqlObject($select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            
            $resultSet = new ResultSet();
            
            $resultSet->initialize($result);
            
            $row = $resultSet->current();
            
            return $row['workorder_credit_total'];
        }
        
        return 0;
    }

    public function getWorkorderCredit($workorderId)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_credit');
        
        $select->where(array(
            'workorder_credit.workorder_id = ?' => $workorderId
        ));
        
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
     * @see \WorkorderCredit\Mapper\CreditMapperInterface::getWorkorderCreditBalance()
     */
    public function getWorkorderCreditBalance($clientId)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_credit');
        
        $select->join('workorder', 'workorder_credit.workorder_id = workorder.workorder_id', array(
            'client_id'
        ), 'inner');
        
        $select->where(array(
            'workorder.client_id = ?' => $clientId
        ));
        
        $select->where->greaterThan('workorder_credit.workorder_credit_amount_left', 0);
        
        $stmt = $sql->prepareStatementForSqlObject($select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
        
            $resultSet = new HydratingResultSet($this->hydrator, $this->prototype);
        
            $resultSet->buffer();
        
            return $resultSet->initialize($result)->current();
        }
        
        return array();
    }

    public function getWorkorderLaborCredit($workorderId)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_credit');
        
        $select->where(array(
            'workorder_credit.workorder_id = ?' => $workorderId
        ));
        
        $select->where(array(
            'workorder_credit.workorder_credit_type = ?' => 'Labor'
        ));
        
        $select->where->greaterThan('workorder_credit.workorder_credit_amount_left', 0);
        
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
     * @see \WorkorderCredit\Mapper\CreditMapperInterface::getWorkorderPartCredit()
     */
    public function getWorkorderPartCredit($workorderId)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_credit');
        
        $select->where(array(
            'workorder_credit.workorder_id = ?' => $workorderId
        ));
        
        $select->where(array(
            'workorder_credit.workorder_credit_type = ?' => 'Parts'
        ));
        
        $select->where->greaterThan('workorder_credit.workorder_credit_amount_left', 0);
        
        $stmt = $sql->prepareStatementForSqlObject($select);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface && $result->isQueryResult()) {
            
            $resultSet = new HydratingResultSet($this->hydrator, $this->prototype);
            
            $resultSet->buffer();
            
            return $resultSet->initialize($result)->current();
        }
        
        return array();
    }
}