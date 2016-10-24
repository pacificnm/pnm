<?php
namespace TicketNote\Mapper;

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
use TicketNote\Entity\NoteEntity;

class MysqlMapper implements MysqlMapperInterface
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
     * @see \TicketNote\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('ticket_note');
        
        $select->join('auth', 'ticket_note.auth_id = auth.auth_id', array(
            'auth_role',
            'auth_email',
            'auth_name',
            'auth_type',
            'employee_id'
        ), 'inner');
        
        // join ticket
        $select->join('ticket', 'ticket_note.ticket_id = ticket.ticket_id', array(
            'client_id',
            'user_id',
            'ticket_title',
            'ticket_status',
            'ticket_date_open',
            'ticket_date_close'
        ), 'inner');
        
        if (array_key_exists('ticketId', $filter)) {
            $select->where(array(
                'ticket_note.ticket_id = ?' => $filter['ticketId']
            ));
        }
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \TicketNote\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('ticket_note');
        
        $select->join('auth', 'ticket_note.auth_id = auth.auth_id', array(
            'auth_role',
            'auth_email',
            'auth_name',
            'auth_type',
            'user_id',
            'employee_id'
        ), 'inner');
        
        $select->where(array(
            'ticket_note.ticket_note_id = ?' => $id
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
     *
     * @see \TicketNote\Mapper\MysqlMapperInterface::save()
     */
    public function save(NoteEntity $entity)
    {
        $postData = $this->hydrator->extract($entity);
        
        if ($entity->getTicketNoteId()) {
            
            // ID present, it's an Update
            $action = new Update('ticket_note');
            
            $action->set($postData);
            
            $action->where(array(
                'ticket_note.ticket_note_id = ?' => $entity->getTicketNoteId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('ticket_note');
            
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
            
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setTicketNoteId($newId);
            }
            
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     *
     * {@inheritDoc}
     *
     * @see \TicketNote\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(NoteEntity $entity)
    {
        $action = new Delete('ticket_note');
        
        $action->where(array(
            'ticket_note.ticket_note_id = ?' => $entity->getTicketNoteId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}

