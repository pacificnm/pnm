<?php
namespace TaskPriority\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Zend\Stdlib\Hydrator\HydratorInterface;
use TaskPriority\Entity\PriorityEntity;

class PriorityMapper implements PriorityMapperInterface
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
     * @var PriorityEntity
     */
    protected $prototype;
    
    /**
     *
     * @param AdapterInterface $readAdapter
     * @param AdapterInterface $writeAdapter
     * @param HydratorInterface $hydrator
     * @param PriorityEntity $prototype
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, PriorityEntity $prototype)
    {
        $this->readAdapter = $readAdapter;
    
        $this->writeAdapter = $writeAdapter;
    
        $this->hydrator = $hydrator;
    
        $this->prototype = $prototype;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \TaskPriority\Mapper\PriorityMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('task_priority');
        
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
     * @see \TaskPriority\Mapper\PriorityMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('task_priority');
        
        $select->where(array(
            'task_priority.task_priority_id = ?' => $id
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
     * @see \TaskPriority\Mapper\PriorityMapperInterface::save()
     */
    public function save(PriorityEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getTaskPriorityId()) {
        
            // ID present, it's an Update
            $action = new Update('task_priority');
        
            $action->set($postData);
        
            $action->where(array(
                'task_priority.task_priority_id = ?' => $entity->getTaskPriorityId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('task_priority');
        
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
        
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setTaskPriorityId($newId);
            }
        
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     * 
     * {@inheritDoc}
     * @see \TaskPriority\Mapper\PriorityMapperInterface::delete()
     */
    public function delete(PriorityEntity $entity)
    {
        $action = new Delete('task_priority');
        
        $action->where(array(
            'task_priority.task_priority_id = ?' => $entity->getTaskPriorityId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}
