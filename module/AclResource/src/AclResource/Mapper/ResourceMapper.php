<?php
namespace AclResource\Mapper;

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
use AclResource\Entity\ResourceEntity;

class ResourceMapper implements ResourceMapperInterface
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
     * @var ResourceEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param ResourceEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, ResourceEntity $prototype)
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
     * @see \AclResource\Mapper\ResourceMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('acl_resource');
        
        // pagination off
        if(array_key_exists('pagination', $filter) && $filter['pagination'] == 'off') {
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
        
        // paginate
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \AclResource\Mapper\ResourceMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('acl_resource');
        
        $select->where(array(
            'acl_resource.acl_resource_id = ?' => $id
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
     * @see \AclResource\Mapper\ResourceMapperInterface::getReource()
     */
    public function getReource($resource)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('acl_resource');
        
        $select->where(array(
            'acl_resource.acl_resource = ?' => $resource
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
     * @see \AclResource\Mapper\ResourceMapperInterface::save()
     */
    public function save(ResourceEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getAclResourceId()) {
            
            // ID present, it's an Update
            $action = new Update('acl_resource');
            
            $action->set($postData);
            
            $action->where(array(
                'acl_resource.acl_resource_id = ?' => $entity->getAclResourceId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('acl_resource');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setAclResourceId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \AclResource\Mapper\ResourceMapperInterface::delete()
     */
    public function delete(ResourceEntity $entity)
    {
        $action = new Delete('acl_resource');
        
        $action->where(array(
            'acl_resource.acl_resource_id = ?' => $entity->getAclResourceId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}