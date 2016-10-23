<?php
namespace WorkorderFile\Mapper;

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
use WorkorderFile\Entity\WorkorderFileEntity;

class WorkorderFileMapper implements WorkorderFileMapperInterface
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
     * @var WorkorderFileEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param WorkorderFileEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, WorkorderFileEntity $prototype)
    {
        $this->readAdapter = $readAdapter;
        
        $this->writeAdapter = $writeAdapter;
        
        $this->hydrator = $hydrator;
        
        $this->prototype = $prototype;
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \WorkorderFile\Mapper\WorkorderFileMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_file');
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }

    public function getWorkorderFiles($workorderId)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_file');
        
        $select->where(array(
            'workorder_file.workorder_id = ?' => $workorderId
        ));
        
        // join file
        $select->join('file', 'workorder_file.file_id = file.file_id', array(
            'auth_id',
            'file_title',
            'file_name',
            'file_path',
            'file_mime',
            'file_size',
            'file_create'
        ), 'inner');
        
        // join auth
        $select->join('auth', 'file.auth_id = auth.auth_id', array(
            'auth_role',
            'auth_email',
            'auth_password',
            'auth_name',
            'auth_type',
            'user_id',
            'employee_id'
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
     * {@inheritdoc}
     *
     * @see \WorkorderFile\Mapper\WorkorderFileMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_file');
        
        // join file
        $select->join('file', 'workorder_file.file_id = file.file_id', array(
            'auth_id',
            'file_title',
            'file_name',
            'file_path',
            'file_mime',
            'file_size',
            'file_create'
        ), 'inner');
        
        // join auth
        $select->join('auth', 'file.auth_id = auth.auth_id', array(
            'auth_role',
            'auth_email',
            'auth_password',
            'auth_name',
            'auth_type',
            'user',
            'employee_id'
        ), 'inner');
        
        $select->where(array(
            'workorder_file.workorder_file_id = ?' => $id
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
     * {@inheritdoc}
     *
     * @see \WorkorderFile\Mapper\WorkorderFileMapperInterface::save()
     */
    public function save(WorkorderFileEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getWorkorderFileId()) {
            
            // ID present, it's an Update
            $action = new Update('workorder_file');
            
            $action->set($postData);
            
            $action->where(array(
                'workorder_file.workorder_file_id = ?' => $entity->getWorkorderFileId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('workorder_file');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setWorkorderFileId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see \WorkorderFile\Mapper\WorkorderFileMapperInterface::delete()
     */
    public function delete(WorkorderFileEntity $entity)
    {
        $action = new Delete('workorder_file');
        
        $action->where(array(
            'workorder_file.workorder_file_id = ?' => $entity->getWorkorderFileId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \WorkorderFile\Mapper\WorkorderFileMapperInterface::deleteWorkorderFile()
     */
    public function deleteWorkorderFile($fileId)
    {
        $action = new Delete('workorder_file');
        
        $action->where(array(
            'workorder_file.file_id = ?' => $fileId
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}

