<?php
namespace ClientFile\Mapper;

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
use ClientFile\Entity\ClientFileEntity;

class ClientFileMapper implements ClientFileMapperInterface
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
     * @var ClientFileEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param ClientFileEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, ClientFileEntity $prototype)
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
     * @see \ClientFile\Mapper\ClientFileMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('client_file');
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ClientFile\Mapper\ClientFileMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('client_file');
        
        $select->where(array(
            'client_file.client_file_id = ?' => $id
        ));
        
        $select->join('file', 'client_file.file_id = file.file_id', array(
            'auth_id',
            'file_title',
            'file_name',
            'file_path',
            'file_mime',
            'file_size',
            'file_create'
        ), 'inner');
        
        $select->join('auth', 'auth.auth_id = file.auth_id', array('auth_name'), 'inner');
        
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
     * @see \ClientFile\Mapper\ClientFileMapperInterface::save()
     */
    public function save(ClientFileEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getClientFileId()) {
            
            // ID present, it's an Update
            $action = new Update('client_file');
            
            $action->set($postData);
            
            $action->where(array(
                'client_file.client_file_id = ?' => $entity->getClientFileId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('client_file');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setClientFileId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ClientFile\Mapper\ClientFileMapperInterface::delete()
     */
    public function delete(ClientFileEntity $entity)
    {
        $action = new Delete('client_file');
        
        $action->where(array(
            'client_file.client_file_id = ?' => $entity->getClientFileId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \ClientFile\Mapper\ClientFileMapperInterface::getClientFiles()
     */
    public function getClientFiles($clientId)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('client_file');
        
        $select->where(array(
            'client_file.client_id = ?' => $clientId
        ));
        
        $select->join('file', 'client_file.file_id = file.file_id', array(
            'auth_id',
            'file_title',
            'file_name',
            'file_path',
            'file_mime',
            'file_size',
            'file_create'
        ), 'inner');
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \ClientFile\Mapper\ClientFileMapperInterface::createClientFile()
     */
    public function createClientFile($fileId, $clientId)
    {
        $entity = new ClientFileEntity();
        
        $entity->setClientId($clientId);
        
        $entity->setFileId($fileId);
        
        $clientFileEntity = $this->save($entity);
        
        return $clientFileEntity;
    }
}