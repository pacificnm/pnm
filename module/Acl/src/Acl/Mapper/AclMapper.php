<?php
namespace Acl\Mapper;

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
use Acl\Entity\AclEntity;

class AclMapper implements AclMapperInterface
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
     * @var AclEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param AclEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, AclEntity $prototype)
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
     * @see \Acl\Mapper\AclMapperInterface::getAclRule()
     */
    public function getAclRule($role, $resource)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('acl');
        
        $select->where(array(
            'acl.resource = ?' => $resource
        ));
        
        $select->where(array(
            'acl.role = ?' => $role
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
     * @see \Acl\Mapper\AclMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('acl');
        
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
     * @see \Acl\Mapper\AclMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('acl');
        
        $select->where(array(
            'acl.acl_id = ?' => $id
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
     * @see \Acl\Mapper\AclMapperInterface::save()
     */
    public function save(AclEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getAclId()) {
            
            // ID present, it's an Update
            $action = new Update('acl');
            
            $action->set($postData);
            
            $action->where(array(
                'acl.acl_id = ?' => $entity->getAclId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('acl');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setAclId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \Acl\Mapper\AclMapperInterface::delete()
     */
    public function delete(AclEntity $entity)
    {
        $action = new Delete('acl');
        
        $action->where(array(
            'acl.acl_id = ?' => $entity->getAclResourceId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}