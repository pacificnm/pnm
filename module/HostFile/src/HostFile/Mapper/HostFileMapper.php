<?php
namespace HostFile\Mapper;

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
use HostFile\Entity\HostFileEntity;

class HostFileMapper implements HostFileMapperInterface
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
     * @var HostFileEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param HostFileEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, HostFileEntity $prototype)
    {
        $this->readAdapter = $readAdapter;
        
        $this->writeAdapter = $writeAdapter;
        
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \HostFile\Mapper\HostFileMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('host_file');
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \HostFile\Mapper\HostFileMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('host_file');
        
        $select->where(array(
            'host_file.host_file_id = ?' => $id
        ));
        
        $select->join('file', 'host_file.file_id = file.file_id', array(
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
     * @see \HostFile\Mapper\HostFileMapperInterface::save()
     */
    public function save(HostFileEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getHostFileId()) {
        
            // ID present, it's an Update
            $action = new Update('host_file');
        
            $action->set($postData);
        
            $action->where(array(
                'host_file.host_file_id = ?' => $entity->getHostFileId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('host_file');
        
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
        
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setHostFileId($newId);
            }
        
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    
    public function createHostFile($fileId, $hostId)
    {
        
    }

    public function delete(HostFileEntity $entity)
    {}

    /**
     * 
     * {@inheritDoc}
     * @see \HostFile\Mapper\HostFileMapperInterface::getHostFiles()
     */
    public function getHostFiles($hostId)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('host_file');
        
        $select->where(array(
            'host_file.host_id = ?' => $hostId
        ));
        
        $select->join('file', 'host_file.file_id = file.file_id', array(
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

    public function deleteHostFile($fileId)
    {}
}