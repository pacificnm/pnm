<?php
namespace HostAttributeValue\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Stdlib\Hydrator\HydratorInterface;
use HostAttributeValue\Entity\ValueEntity;

class ValueMapper implements ValueMapperInterface
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
     * @var ValueEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param ValueEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, ValueEntity $prototype)
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
     * @see \HostAttributeValue\Mapper\ValueMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('host_attribute_value');
        
        if(array_key_exists('hostAttributeId', $filter) && ! empty($filter['hostAttributeId'])) {
            $select->where(array(
                'host_attribute_value.host_attribute_id = ?' => $filter['hostAttributeId']
            ));
        }
        
        $select->order('host_attribute_value_name');
        
        if(array_key_exists('pagination', $filter) && $filter['pagination'] == 'off') {
        
            $stmt = $sql->prepareStatementForSqlObject($select);
            
            $result = $stmt->execute();
            
            if ($result instanceof ResultInterface && $result->isQueryResult()) {
                
                $resultSet = new HydratingResultSet($this->hydrator, $this->prototype);
                
                $resultSet->buffer();
                
                return $resultSet->initialize($result);
            }
            
            return array();
        }
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \HostAttributeValue\Mapper\ValueMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('host_attribute_value');
        
        $select->where(array(
            'host_attribute_value.host_attribute_value_id = ?' => $id
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
     * @see \HostAttributeValue\Mapper\ValueMapperInterface::getValue()
     */
    public function getValue($value)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('host_attribute_value');
        
        $select->where(array(
            'host_attribute_value.host_attribute_value_name = ?' => $value
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
     *
     * @see \HostAttributeValue\Mapper\ValueMapperInterface::save()
     */
    public function save(ValueEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getHostAttributeValueId()) {
            
            // ID present, it's an Update
            $action = new Update('host_attribute_value');
            
            $action->set($postData);
            
            $action->where(array(
                'host_attribute_value.host_attribute_value_id = ?' => $entity->getHostAttributeValueId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('host_attribute_value');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setHostAttributeValueId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \HostAttributeValue\Mapper\ValueMapperInterface::delete()
     */
    public function delete(ValueEntity $entity)
    {
        $action = new Delete('host_attribute_value');
        
        $action->where(array(
            'host_attribute_value.host_attribute_value_id = ?' => $entity->getHostAttributeValueId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}