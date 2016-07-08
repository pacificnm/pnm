<?php
namespace HostAttributeMap\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Zend\Stdlib\Hydrator\HydratorInterface;
use HostAttributeMap\Entity\MapEntity;

class MapMapper implements MapMapperInterface
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
     * @var MapEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param MapEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, MapEntity $prototype)
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
     * @see \HostAttributeMap\Mapper\MapMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('host_attribute_map');
        
        // host id
        if (array_key_exists('hostId', $filter) && ! empty($filter['hostId'])) {
            $select->where(array(
                'host_attribute_map.host_id = ?' => $filter['hostId']
            ));
        }
        
        // join attribute
        $select->join('host_attribute', 'host_attribute_map.host_attribute_id = host_attribute.host_attribute_id', array(
            'host_attribute_name',
            'host_attribute_type'
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
     *
     * @see \HostAttributeMap\Mapper\MapMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('host_attribute_map');
        
        $select->where(array(
            'host_attribute_map.host_attribute_map_id = ?' => $id
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
     * @see \HostAttributeMap\Mapper\MapMapperInterface::save()
     */
    public function save(MapEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getHostAttributeMapId()) {
            
            // ID present, it's an Update
            $action = new Update('host_attribute_map');
            
            $action->set($postData);
            
            $action->where(array(
                'host_attribute_map.host_attribute_map_id = ?' => $entity->getHostAttributeMapId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('host_attribute_map');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setHostAttributeMapId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \HostAttributeMap\Mapper\MapMapperInterface::delete()
     */
    public function delete(MapEntity $entity)
    {
        $action = new Delete('host_attribute_map');
        
        $action->where(array(
            'host_attribute_map.host_attribute_map_id = ?' => $entity->getHostAttributeMapId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \HostAttributeMap\Mapper\MapMapperInterface::deleteHostMaps()
     */
    public function deleteHostMaps($hostId)
    {
        $action = new Delete('host_attribute_map');
        
        $action->where(array(
            'host_attribute_map.host_id = ?' => $hostId
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}
