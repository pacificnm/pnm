<?php
namespace AccountType\Mapper;

use AccountType\Entity\TypeEntity;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Zend\Stdlib\Hydrator\HydratorInterface;

class TypeMapper implements TypeMapperInterface
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
     * @var TypeEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param TypeEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, TypeEntity $prototype)
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
     * @see \AccountType\Mapper\TypeMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('account_type');
        
        $select->where(array(
            'account_type_active = ?' => 1
        ));
        
        
        $select->order('account_type_name');
        
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
     *
     * @see \AccountType\Mapper\TypeMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('account_type');
        
        $select->where(array(
            'account_type.account_type_id = ?' => $id
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
     * @see \AccountType\Mapper\TypeMapperInterface::save()
     */
    public function save(TypeEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getAccountTypeId()) {
            
            // ID present, it's an Update
            $action = new Update('account_type');
            
            $action->set($postData);
            
            $action->where(array(
                'account_type.account_type_id = ?' => $entity->getAccountTypeId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('account_type');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setAccountTypeId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \AccountType\Mapper\TypeMapperInterface::delete()
     */
    public function delete(TypeEntity $entity)
    {
        $action = new Delete('account_type');
        
        $action->where(array(
            'account_type.account_type_id = ?' => $entity->getAccountTypeId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}