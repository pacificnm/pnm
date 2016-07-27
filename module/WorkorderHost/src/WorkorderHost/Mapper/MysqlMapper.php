<?php
namespace WorkorderHost\Mapper;

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
use WorkorderHost\Entity\WorkorderHostEntity;

class MysqlMapper implements MysqlMapperInterface
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
     * @var WorkorderHostEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param WorkorderHostEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, WorkorderHostEntity $prototype)
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
     * @see \WorkorderHost\Mapper\WorkorderHostMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_host');
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderHost\Mapper\WorkorderHostMapperInterface::getWorkorderHosts()
     */
    public function getWorkorderHosts($workorderId)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_host');
        
        $select->where(array(
            'workorder_host.workorder_id = ?' => $workorderId
        ));
        
        $select->join('host', 'workorder_host.host_id = host.host_id', array(
            'host_name',
            'host_description',
            'host_ip'
        ), 'inner');
        
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
     * @see \WorkorderHost\Mapper\MysqlMapperInterface::getNotInWorkorderHosts()
     */
    public function getNotInWorkorderHosts($clientId, $workorderId)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_host');
       
        
        
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
     * @see \WorkorderHost\Mapper\WorkorderHostMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_host');
        
        $select->where(array(
            'workorder_host.workorder_host_id = ?' => $id
        ));
        
        $select->join('host', 'workorder_host.host_id = host.host_id', array(
            'host_name',
            'host_description',
            'host_ip'
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
     * {@inheritdoc}
     *
     * @see \WorkorderHost\Mapper\WorkorderHostMapperInterface::save()
     */
    public function save(WorkorderHostEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getWorkorderHostId()) {
            
            // ID present, it's an Update
            $action = new Update('workorder_host');
            
            $action->set($postData);
            
            $action->where(array(
                'workorder_host.workorder_host_id = ?' => $entity->getWorkorderHostId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('workorder_host');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setWorkorderHostId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \WorkorderHost\Mapper\WorkorderHostMapperInterface::delete()
     */
    public function delete(WorkorderHostEntity $entity)
    {
        $action = new Delete('workorder_host');
        
        $action->where(array(
            'workorder_host.workorder_host_id = ?' => $entity->getWorkorderHostId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}

