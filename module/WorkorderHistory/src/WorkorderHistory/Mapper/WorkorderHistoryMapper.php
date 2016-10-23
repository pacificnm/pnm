<?php
namespace WorkorderHistory\Mapper;

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
use WorkorderHistory\Entity\WorkorderHistoryEntity;

class WorkorderHistoryMapper implements WorkorderHistoryMapperInterface
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
     * @var WorkorderHistoryEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param WorkorderHistoryEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, WorkorderHistoryEntity $prototype)
    {
        $this->readAdapter = $readAdapter;
        
        $this->writeAdapter = $writeAdapter;
        
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \WorkorderHistory\mapper\WorkorderHistoryMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_history');
        
        // join history
        $select->join('history', 'history.history_id = workorder_history.history_id', array(
            'auth_id',
            'history_action',
            'history_url',
            'history_note',
            'history_time'
        ), 'inner');
        
        // join auth
        $select->join('auth', 'auth.auth_id = history.auth_id', array(
            'auth_role',
            'auth_email',
            'auth_name',
            'auth_type',
            'user_id',
            'employee_id'
        ), 'inner');
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }

    public function getWorkorderHistory($workorderId)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_history');
        
        // join history
        $select->join('history', 'history.history_id = workorder_history.history_id', array(
            'auth_id',
            'history_action',
            'history_url',
            'history_note',
            'history_time'
        ), 'inner');
        
        // join auth
        $select->join('auth', 'auth.auth_id = history.auth_id', array(
            'auth_role',
            'auth_email',
            'auth_name',
            'auth_type',
            'user_id',
            'employee_id'
        ), 'inner');
        
        $select->where(array('workorder_history.workorder_id = ?' => $workorderId));
        
        $select->order('history.history_id');
        
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
     * {@inheritdoc}
     *
     * @see \WorkorderHistory\mapper\WorkorderHistoryMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_history');
        
        $select->where(array(
            'workorder_history.workorder_history_id = ?' => $id
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
     * {@inheritdoc}
     *
     * @see \WorkorderHistory\mapper\WorkorderHistoryMapperInterface::save()
     */
    public function save(WorkorderHistoryEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getWorkorderHistoryId()) {
            
            // ID present, it's an Update
            $action = new Update('workorder_history');
            
            $action->set($postData);
            
            $action->where(array(
                'workorder_history.workorder_history_id = ?' => $entity->getWorkorderHistoryId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('workorder_history');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setWorkorderHistoryId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \WorkorderHistory\mapper\WorkorderHistoryMapperInterface::delete()
     */
    public function delete(WorkorderHistoryEntity $entity)
    {
        $action = new Delete('workorder_history');
        
        $action->where(array(
            'workorder_history.workorder_history_id = ?' => $entity->getWorkorderHistoryId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}

