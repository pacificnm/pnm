<?php
namespace Ticket\Mapper;

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
use Ticket\Entity\TicketEntity;

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
     * @var TicketEntity
     */
    protected $prototype;
    
    /**
     *
     * @param AdapterInterface $readAdapter
     * @param AdapterInterface $writeAdapter
     * @param HydratorInterface $hydrator
     * @param TicketEntity $prototype
     */
    public function __construct(AdapterInterface $readAdapter, AdapterInterface $writeAdapter, HydratorInterface $hydrator, TicketEntity $prototype)
    {
        $this->readAdapter = $readAdapter;
    
        $this->writeAdapter = $writeAdapter;
    
        $this->hydrator = $hydrator;
    
        $this->prototype = $prototype;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Ticket\Mapper\MysqlMapperInterface::getAll()
     */
    public function getAll($filter)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('ticket');
        
        $select->join('user', 'ticket.user_id = user.user_id', array(
            'location_id',
            'user_status',
            'user_name_first',
            'user_name_last',
            'user_job_title',
            'user_email',
            'user_type'
        ), 'inner');
        
        if(array_key_exists('clientId', $filter)) {
            $select->where(array('ticket.client_id = ?' => $filter['clientId']));
        }
        
        if(array_key_exists('ticketStatus', $filter) && ! empty($filter['ticketStatus'])) {
            if($filter['ticketStatus'] == 'Open') {
                $select->where(array('ticket.ticket_status != ?' => 'Closed'));
            } else {
                $select->where(array('ticket.ticket_status = ?' => $filter['ticketStatus']));
            }
        }
        
        $select->order('ticket.ticket_date_open DESC');
        
        $resultSetPrototype = new HydratingResultSet($this->hydrator, $this->prototype);
        
        $paginatorAdapter = new DbSelect($select, $this->readAdapter, $resultSetPrototype);
        
        $paginator = new Paginator($paginatorAdapter);
        
        return $paginator;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Ticket\Mapper\MysqlMapperInterface::get()
     */
    public function get($id)
    {
        $sql = new Sql($this->readAdapter);
        
        $select = $sql->select('ticket');
        
        $select->where(array(
            'ticket.ticket_id = ?' => $id
        ));
        
        $select->join('user', 'ticket.user_id = user.user_id', array(
            'location_id',
            'user_status',
            'user_name_first',
            'user_name_last',
            'user_job_title',
            'user_email',
            'user_type'
        ), 'inner');
        
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
     * @see \Ticket\Mapper\MysqlMapperInterface::save()
     */
    public function save(TicketEntity $entity)
    {
        
        $postData = $this->hydrator->extract($entity);   
       
        
        if ($entity->getTicketId()) {
        
            // ID present, it's an Update
            $action = new Update('ticket');
        
            $action->set($postData);
        
            $action->where(array(
                'ticket.ticket_id = ?' => $entity->getTicketId()
            ));
        } else {
            // ID NOT present, it's an Insert
            $action = new Insert('ticket');
        
            $action->values($postData);
        }
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        if ($result instanceof ResultInterface) {
            $newId = $result->getGeneratedValue();
        
            if ($newId) {
                // When a value has been generated, set it on the object
                $entity->setTicketId($newId);
            }
        
            return $entity;
        }
        
        throw new \Exception("Database error");
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Ticket\Mapper\MysqlMapperInterface::delete()
     */
    public function delete(TicketEntity $entity)
    {
        $action = new Delete('ticket');
        
        $action->where(array(
            'ticket.ticket_id = ?' => $entity->getTicketId()
        ));
        
        $sql = new Sql($this->writeAdapter);
        
        $stmt = $sql->prepareStatementForSqlObject($action);
        
        $result = $stmt->execute();
        
        return (bool) $result->getAffectedRows();
    }
}

