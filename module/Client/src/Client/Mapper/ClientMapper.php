<?php
namespace Client\Mapper;

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
use Client\Entity\ClientEntity;

class ClientMapper implements ClientMapperInterface
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
     * @var EmployeeEntity
     */
    protected $prototype;
    
    /**
     *
     * @param AdapterInterface $readAdapter
     * @param AdapterInterface $writeAdapter
     * @param HydratorInterface $hydrator
     * @param ClientEntity $prototype
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, ClientEntity $prototype)
    {
        $this->readAdapter = $readAdapter;
    
        $this->writeAdapter = $writeAdapter;
    
        $this->hydrator = $hydrator;
    
        $this->prototype = $prototype;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Client\Mapper\ClientMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('client');
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        //$paginator->getIterator()->buffer();
        
        return $paginator;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Client\Mapper\ClientMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('client');
        
        $select->where(array(
            'client.client_id = ?' => $id
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
     * @see \Client\Mapper\ClientMapperInterface::save()
     */
    public function save(ClientEntity $clientEntity)
    {
        $postData = $this->hydrator->extract($clientEntity);
        
        if ($clientEntity->getClientId()) {
        
            // ID present, it's an Update
            $action = new Update('client');
        
            $action->set($postData);
        
            $action->where(array(
                'client.client_id = ?' => $clientEntity->getClientId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('client');
        
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
        
            if ($newId) {
                // When a value has been generated, set it on the object
                $clientEntity->setClientId($newId);
            }
        
            return $clientEntity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Client\Mapper\ClientMapperInterface::delete()
     */
    public function delete(ClientEntity $clientEntity)
    {
        $action = new Delete('client');
        
        $action->where(array(
            'client.client_id = ?' => $clientEntity->getClientId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}
