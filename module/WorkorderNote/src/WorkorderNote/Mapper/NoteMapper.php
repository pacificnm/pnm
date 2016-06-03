<?php
namespace WorkorderNote\Mapper;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Db\ResultSet\ResultSet;
use WorkorderNote\Entity\NoteEntity;

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
     * @see \WorkorderNote\Mapper\NoteMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_notes');
        
        // workorderId
        if (array_key_exists('workorderId', $filter) && ! empty($filter['workorderId'])) {
            $select->where(array(
                'workorder_notes.workorder_id = ?' => $filter['workorderId']
            ));
        }
        
        $select->join('employee', 'employee.employee_id = workorder_notes.employee_id', array(
            'employee_name',
            'employee_title',
            'employee_email',
            'employee_im',
            'employee_image',
            'employee_status'
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
     * {@inheritDoc}
     *
     * @see \WorkorderNote\Mapper\NoteMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('workorder_notes');
        
        $select->where(array(
            'workorder_notes.workorder_notes_id = ?' => $id
        ));
        
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
     * @see \WorkorderNote\Mapper\NoteMapperInterface::save()
     */
    public function save(NoteEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getWorkorderNotesId()) {
            
            // ID present, it's an Update
            $action = new Update('workorder_notes');
            
            $action->set($postData);
            
            $action->where(array(
                'workorder_notes.workorder_notes_id = ?' => $entity->getWorkorderNotesId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('workorder_notes');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setWorkorderNotesId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \WorkorderNote\Mapper\NoteMapperInterface::delete()
     */
    public function delete(NoteEntity $entity)
    {
        $action = new Delete('workorder_notes');
        
        $action->where(array(
            'workorder_notes.workorder_notes_id = ?' => $entity->getWorkorderNotesId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}