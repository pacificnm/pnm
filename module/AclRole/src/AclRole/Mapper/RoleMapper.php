<?php
namespace AclRole\Mapper;

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
use AclRole\Entity\RoleEntity;

class RoleMapper implements RoleMapperInterface
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
     * @var RoleEntity
     */
    protected $prototype;
    
    /**
     *
     * @param AdapterInterface $readAdapter
     * @param AdapterInterface $writeAdapter
     * @param HydratorInterface $hydrator
     * @param RoleEntity $prototype
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, RoleEntity $prototype)
    {
        $this->readAdapter = $readAdapter;
    
        $this->writeAdapter = $writeAdapter;
    
        $this->hydrator = $hydrator;
    
        $this->prototype = $prototype;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \AclRole\Mapper\RoleMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('acl_role');
        
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
     * @see \AclRole\Mapper\RoleMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('acl_role');
        
        $select->where(array(
            'acl_role.acl_role_id = ?' => $id
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
     * @see \AclRole\Mapper\RoleMapperInterface::getRole()
     */
    public function getRole($role)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('acl_role');
        
        $select->where(array(
            'acl_role.acl_role = ?' => $role
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
     * @see \AclRole\Mapper\RoleMapperInterface::save()
     */
    public function save(RoleEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getAclRoleId()) {
        
            // ID present, it's an Update
            $action = new Update('acl_role');
        
            $action->set($postData);
        
            $action->where(array(
                'acl_role.acl_role_id = ?' => $entity->getAclRoleId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('acl_role');
        
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
        
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setAclRoleId($newId);
            }
        
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     * 
     * {@inheritDoc}
     * @see \AclRole\Mapper\RoleMapperInterface::delete()
     */
    public function delete(RoleEntity $entity)
    {
        $action = new Delete('acl_role');
        
        $action->where(array(
            'acl_role.acl_role = ?' => $entity->getAclResourceId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}