<?php
namespace User\Mapper;
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
use User\Entity\UserEntity;

class UserMapper implements UserMapperInterface
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
     * @var UserEntity
     */
    protected $prototype;
    
    /**
     *
     * @param AdapterInterface $readAdapter
     * @param AdapterInterface $writeAdapter
     * @param HydratorInterface $hydrator
     * @param UserEntity $prototype
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, UserEntity $prototype)
    {
        $this->readAdapter = $readAdapter;
    
        $this->writeAdapter = $writeAdapter;
    
        $this->hydrator = $hydrator;
    
        $this->prototype = $prototype;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \User\Mapper\UserMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('user');
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        $paginator->getIterator()->buffer();
        
        return $paginator;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \User\Mapper\UserMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('user');
        
        $select->where(array(
            'user.user_id = ?' => $id
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
     * @see \User\Mapper\UserMapperInterface::save()
     */
    public function save(UserEntity $userEntity)
    {
        $postData = $this->hydrator->extract($userEntity);
        
        if ($userEntity->getUserId()) {
        
            // ID present, it's an Update
            $action = new Update('user');
        
            $action->set($postData);
        
            $action->where(array(
                'user.user_id = ?' => $userEntity->getUserId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('user');
        
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
        
            if ($newId) {
                // When a value has been generated, set it on the object
                $userEntity->setUserId($newId);
            }
        
            return $userEntity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     * 
     * {@inheritDoc}
     * @see \User\Mapper\UserMapperInterface::delete()
     */
    public function delete(UserEntity $userEntity)
    {
        $action = new Delete('user');
        
        $action->where(array(
            'user.user_id = ?' => $userEntity->getUserId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}