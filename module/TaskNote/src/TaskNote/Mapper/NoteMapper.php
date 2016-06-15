<?php
namespace TaskNote\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Zend\Stdlib\Hydrator\HydratorInterface;
use TaskNote\Entity\NoteEntity;

class NoteMapper implements NoteMapperInterface
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
     * @var NoteEntity
     */
    protected $prototype;

    /**
     *
     * @param AdapterInterface $readAdapter            
     * @param AdapterInterface $writeAdapter            
     * @param HydratorInterface $hydrator            
     * @param NoteEntity $prototype            
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, NoteEntity $prototype)
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
     * @see \TaskNote\Mapper\NoteMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('task_note');
        
        // client id
        if (array_key_exists('taskId', $filter) && ! empty($filter['taskId'])) {
            $select->where(array(
                'task_note.task_id = ?' => $filter['taskId']
            ));
        }
        
        // join employee
        $select->join('employee', 'task_note.employee_id = employee.employee_id', array(
            'employee_name',
            'employee_title',
            'employee_email',
            'employee_im',
            'employee_image',
            'employee_status'
        ), 'left');
        
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
     * @see \TaskNote\Mapper\NoteMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('task_note');
        
        $select->where(array(
            'task_note.task_note_id = ?' => $id
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
     * @see \TaskNote\Mapper\NoteMapperInterface::save()
     */
    public function save(NoteEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getTaskNoteId()) {
            
            // ID present, it's an Update
            $action = new Update('task_note');
            
            $action->set($postData);
            
            $action->where(array(
                'task_note.task_note_id = ?' => $entity->getTaskNoteId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('task_note');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setTaskNoteId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \TaskNote\Mapper\NoteMapperInterface::delete()
     */
    public function delete(NoteEntity $entity)
    {
        $action = new Delete('task_note');
        
        $action->where(array(
            'task_note.task_note_id = ?' => $entity->getTaskNoteId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}
