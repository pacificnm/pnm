<?php
namespace File\Mapper;

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
use File\Entity\FileEntity;

class FileMapper implements FileMapperInterface
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
     * @var FileEntity
     */
    protected $prototype;
    
    /**
     *
     * @param AdapterInterface $readAdapter
     * @param AdapterInterface $writeAdapter
     * @param HydratorInterface $hydrator
     * @param FileEntity $prototype
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, FileEntity $prototype)
    {
        $this->readAdapter = $readAdapter;
    
        $this->writeAdapter = $writeAdapter;
    
        $this->hydrator = $hydrator;
    
        $this->prototype = $prototype;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \File\Mapper\FileMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('file');
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \File\Mapper\FileMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('file');
        
        $select->where(array(
            'file.file_id = ?' => $id
        ));

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
     * @see \File\Mapper\FileMapperInterface::save()
     */
    public function save(FileEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getFileId()) {
        
            // ID present, it's an Update
            $action = new Update('file');
        
            $action->set($postData);
        
            $action->where(array(
                'file.file_id = ?' => $entity->getFileId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('file');
        
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
        
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setFileId($newId);
            }
        
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     * 
     * {@inheritDoc}
     * @see \File\Mapper\FileMapperInterface::delete()
     */
    public function delete(FileEntity $entity)
    {
        $action = new Delete('file');
        
        $action->where(array(
            'file.file_id = ?' => $entity->getFileId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}

